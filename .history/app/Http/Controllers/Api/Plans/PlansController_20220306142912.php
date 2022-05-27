<?php

namespace App\Http\Controllers\Api\Plans;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\UserPlan;
use App\Models\Vessel;
use App\Traits\GeneralFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PlansController extends BaseApiController
{
    use GeneralFunction;
    public function __construct()
    {
        $this->changeLang(request()->header('lang-app'));

    }
    public function index()
    {
        try {
            $query = Plan::query()->where('is_deleted',0)->orderBy('price','desc')
            ->whereNull('parent_id')
            ->with('plans')
            ->when(request()->has('type'),function($q){
                return $q->where('type',request('type'));
            });
            request('with_paginate')== 'yes' ? $data = $query->paginate(8) : $data = $query->get();
            return $this->sendSuccessResponse($data);

        } catch (\Exception $ex) {
           
            return $this->sendErrors($ex,500);

        }
    }


    public function viewPayment(Request $request)
    {
        $secure_code = $request->secure_code;
        $uplan = UserPlan::query()->where('secure_code',$secure_code)->where('secure_code_status',1)
        ->whereHas('plan')
        ->with('plan')
        ->first();
        if(is_null($uplan)){
            return redirect(route('api.plan.resultView')."?payment_status=faild");
        }
      

        return view('payment.paymentView',compact('uplan'));
       
    }
    
    public function payPlan(Request $request)
    {
        try {
            $rules = [
                'plan_id' => 'required|exists:plans,id'
            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }
       
            $plan = Plan::query()->where('is_deleted',0)->find($request->plan_id);
            if(is_null($plan)){
                return $this->sendErrors(__('custom_messages.general.not_found'), 400);
            }

            $type = $request->user()->account_type == 'charterer' ? 1 :0;;
            if($plan->type!=$type){
                return $this->sendErrors(__('custom_messages.general.not_found'), 400);
            }
            $data['secure_code'] = Crypt::encrypt( uniqid('br_'.mt_rand(1,9999)).time().\Str::random(99));
            $data['price'] = $plan->price;
            $data['user_id'] = $request->user()->id;
            $data['plan_id'] = $plan->id;
     
            UserPlan::query()->create($data);

            $payment_url = route('api.plan.paymentview')."?secure_code=".  $data['secure_code'];
            
            return $this->sendSuccessResponse(["payment_url"=>$payment_url]);

        } catch (\Exception $ex) {
          
            return $this->sendErrors($ex,500);

        }
    }

    public function paymentForm(Request $request)
    {
        $status= $request->payment_status = 'success' ?'success' :'faild';
        $secure_code = $request->secure_code;
        $uplan = UserPlan::query()->where('secure_code',$secure_code)->where('secure_code_status',1)
        ->whereHas('plan')
        ->with('plan')
        ->first();

        if(is_null($uplan)){
            return redirect(route('api.plan.resultView')."?payment_status=faild");
        }

        

        if( $status == 'success'){

            $uplan->is_active = 1;
            $uplan->working_status = 1;
            $uplan->expire_at  = now()->addMonth(  $uplan->plan->period_per_month??0)->format('Y-m-d');
            UserPlan::query()->where('user_id',$uplan->user_id)->where('id','!=',$uplan->id)->update(['is_active'=>0,'working_status'=>0]);
        }

        $uplan->secure_code_status = 0;
        $uplan->save();

        return redirect(route('api.plan.resultView')."?payment_status=".$status);
    }





    public function resultView(Request $request)
    {
       
            return view('payment.result');
       
    }


    public function activePlan()
    {
        try {
            $data['plan'] =$this->getActivePlan(auth()->user()->id);
 
            $data['is_allowed'] = 0;
            if(!is_null($data['plan'])){
                     $subs =  $data['plan'];
                     $data['plan'] =  $data['plan']->plan;
                if(auth()->user()->account_type == 'operator'){
                       
                $max =   $data['plan'] ->to_ ?? 0;
                $countVessel = Vessel::query()->where('is_deleted', 0)
                ->where('operator_id', auth()->user()->id)->count() ?? 0;
                $countVessel >= $max ?   $data['is_allowed'] =2:   $data['is_allowed'] = 1;
                } else {
                    $data['is_allowed'] = (int)  $subs->working_status ;
                }
             
               

            }

            return $this->sendSuccessResponse($data);

        } catch (\Exception $ex) {
           
           
            return $this->sendErrors($ex,500);

        }
    }
}