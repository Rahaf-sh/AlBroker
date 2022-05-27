<?php

namespace App\Http\Controllers\Api\Cargo;

use App\Core\Helpers\Utilities;
use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\CargoInterested;
use App\Models\CargoType;
use App\Models\Notification\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CargoController extends BaseApiController
{
    public function types()
    {
        $query = CargoType::query()->where('is_deleted', 0)->with('details')->orderBy('id', 'asc');
         request('with_paginate') == 'yes' ? $data = $query->paginate(8) : $data = $query->get();
                     return $this->sendSuccessResponse($data);

    }

    public function myIndex()
    {
        try {
           
            $query = Cargo::query()->where('is_deleted', 0)
                ->when(request('type_list') == 'main', function ($q) {
                    $q->whereIn('type', ['main','draft'])
                    ->where('working_status', '=', 'new')
                    ->where(auth()->user()->account_type . '_id', auth()->user()->id)
                    ->where(auth()->user()->account_type . '_id', auth()->user()->id)
                    ;
                })

                ->when(request('status') == 'under', function ($q) {
                    $q
                        ->where('type', 'discuss')
                        ->whereNotIn('working_status', ['done'])
                        ->where(auth()->user()->account_type . '_id', auth()->user()->id);;
                })
                ->when(request('status') == 'done', function ($q) {
                    $q
                        ->where('type', 'discuss')
                        ->where('working_status', '=', 'done')
                        ->where(auth()->user()->account_type . '_id', auth()->user()->id);;
                })

                ->when(request('type_list') == 'public', function ($q)  {
                    $q
                        ->where('type', 'main')
            
                        ->where('working_status', '=', 'new');
                })

                ->with(
                    'operator',
                    'charter',
                    'vessel',

                    "landing_port_country",
                    "discharging_port_country",
                    "cargo_type",
                    "cargo_type_details",
                )
                ->orderByDesc('id');

            request('with_paginate') == 'yes' ? $data = $query->paginate(8) : $data = $query->get();
            return $this->sendSuccessResponse($data);
        } catch (\Exception $ex) {

            return $this->sendErrors($ex, 500);
        }
    }

    public function publicIndex()
    {
        try {
            $forbiddenIDS = Cargo::query()->where('type','discuss')
            ->where('operator_id',auth()->user()->id)->pluck('parent_id')->toArray();
            $query = Cargo::query()->where('is_deleted', 0)
                ->whereNotIn('id',$forbiddenIDS)
                ->where('type', 'main')
                ->where('working_status', '=', 'new')





                ->with(
                    'operator',
                    'charter',
                    'vessel',

                    "landing_port_country",
                    "discharging_port_country",
                    "cargo_type",
                    "cargo_type_details",
                )
                ->orderByDesc('id');

            request('with_paginate') == 'yes' ? $data = $query->paginate(8) : $data = $query->get();
            return $this->sendSuccessResponse($data);
        } catch (\Exception $ex) {
         

            return $this->sendErrors($ex, 500);
        }
    }






    public function store(Request $request)
    {
        try {




            $rules = [
                "cargo_type_id" => 'required|exists:cargo_types,id',
                "cargo_type_details_id" => 'nullable|exists:cargo_type_details,id',
                "quantity" => 'required',
                "quantity_unit" => 'required',
                "stowage_factor" => 'required',
                "landing_port_country_id" => 'required|exists:countries,id',
                "landing_port_name" => 'required',
                "discharging_port_country_id" => 'required|exists:countries,id',
                "discharging_port_name" => 'required',
                "lay_can_start_date" => 'required',
                "lay_can_canceling_date" => 'required',
                "try_vessel_date" => 'nullable',
                "loading_rate" => 'required',
                "loading_rate_unit" => 'required',
                "discharging_rate" => 'required',
                "discharging_unit" => 'required',
                "additional_cargo_details" => 'nullable',
                "special_requests" => 'nullable',
                "fright_idea" => 'nullable',
                "fright_idea_unit" => 'nullable',

                "address_commission" => 'required',
                "type" => 'required|in:draft,main',

            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }

            $user = $request->user();
            $data = $request->only(
                "cargo_type_id",
                "quantity",
                "quantity_unit",
                "stowage_factor",
                "landing_port_country_id",
                "landing_port_name",
                "discharging_port_country_id",
                "discharging_port_name",
                "lay_can_start_date",
                "lay_can_canceling_date",
                "try_vessel_date",
                "loading_rate",
                "loading_rate_unit",
                "discharging_rate",
                "discharging_unit",
                "additional_cargo_details",
                "special_requests",
                "fright_idea",
                "fright_idea_unit",
                "working_status",
                "address_commission",
                "cargo_type_id",
                "cargo_type_details_id",
                "type",
            );

            $data['charterer_id'] = $user->id;




            DB::beginTransaction();
            Cargo::query()->create($data);





            DB::commit();


            return  $this->sendSuccessResponse(null, 200, __('custom_messages.general.added'));
        } catch (\Exception $exception) {



            return $this->sendErrors($exception, 500);
        }
    }

    public function storeOperations(Request $request)
    {
        try {




            $rules = [
                "id" => 'required|exists:cargos,id',
                "cargo_type_id" => 'required|exists:cargo_types,id',
                "cargo_type_details_id" => 'nullable|exists:cargo_type_details,id',
                "quantity" => 'required',
                "quantity_unit" => 'required',
                "stowage_factor" => 'required',
                "landing_port_country_id" => 'required|exists:countries,id',
                "landing_port_name" => 'required',
                "discharging_port_country_id" => 'required|exists:countries,id',
                "discharging_port_name" => 'required',
                "lay_can_start_date" => 'required',
                "lay_can_canceling_date" => 'required',
                "try_vessel_date" => 'nullable',
                "loading_rate" => 'required',
                "loading_rate_unit" => 'required',
                "discharging_rate" => 'required',
                "discharging_unit" => 'required',
                "additional_cargo_details" => 'nullable',
                "special_requests" => 'nullable',
                "fright_idea" => 'nullable',
                "fright_idea_unit" => 'nullable',
                "charterer_id" => 'required',
                "vessel_id" => 'nullable',

                "address_commission" => 'required',

            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }

            $user = $request->user();
            $data = $request->only(
                "cargo_type_id",
                "quantity",
                "quantity_unit",
                "stowage_factor",
                "landing_port_country_id",
                "landing_port_name",
                "discharging_port_country_id",
                "discharging_port_name",
                "lay_can_start_date",
                "lay_can_canceling_date",
                "try_vessel_date",
                "loading_rate",
                "loading_rate_unit",
                "discharging_rate",
                "discharging_unit",
                "additional_cargo_details",
                "special_requests",
                "fright_idea",
                "fright_idea_unit",
                "working_status",
                "address_commission",
                "cargo_type_id",
                "cargo_type_details_id",
                "charterer_id",
                "vessel_id",
            );

            $data[$user->account_type . '_id'] = $user->id;
           if(is_null( $request['parent_id'] )) $data['parent_id'] = $request->id; else
            $data['parent_id'] = $request->parent_id;

            $data['type'] = 'discuss';


  


            DB::beginTransaction();
            $cond=[
               'parent_id' =>   $data['parent_id'],
                'charterer_id' => $request->charterer_id,
                'type' => 'discuss',
            ];
            $cond[ $user->account_type . '_id']=$user->id;
           
            

            $cargo = Cargo::query()->where($cond)->count();
            if($cargo > 0){
                    
                    if($user->account_type == "operator"){
                        $data["working_status"]= "pending_charter_confirm";} else {
                    $data["working_status"]="edit_charterer";}
                    $cargo = Cargo::query()->where($cond)->where('id',$request->id)->update($data);
                        $cargo = Cargo::query()->where('id',$request->id)->first();
            } else {
                $data["working_status"]= "pending_charter_confirm";
          
               
                $cargo = Cargo::query()->create($data);
            }
          
             if($user->account_type == "operator"){
           
         
                
                
            CargoInterested::query()
             ->updateOrCreate(
                [
                    "interested_id" => $cargo->charterer_id,
                    "interester_id" => $request->user()->id,
                    "cargo_id" => $cargo->id,
                ],
                [
                    "type" => "add",
                    "interested_id" => $cargo->charterer_id,
                    "interester_id" => $request->user()->id,
                    "cargo_id" => $cargo->id,
                ]); 
            }
            $this->createNotificationByAuthUserType([
                'account_type' => $user->account_type,
                'operator_id' => $cargo['operator_id'],
                'charterer_id' => $request->charterer_id,
                'body_en' => "text cargo   status changed to   $request->new_status   from user   " . $request->user()->name,
                'target_id' => $cargo->id,
                'title_en' => "Al-broker",
                'type' => "cargo",

            ]);

         



            DB::commit();


            return  $this->sendSuccessResponse(["cargo_id"=>$cargo->id], 200, __('custom_messages.general.added'));
        } catch (\Exception $exception) {
         


            return $this->sendErrors($exception->getMessage()." ".$exception->getLine(), 500);
        }
    }









    public function update(Request $request)
    {
        try {




            $rules = [
                "id" => 'required|exists:cargos,id',
                "cargo_type_id" => 'required|exists:cargo_types,id',
                "cargo_type_details_id" => 'nullable|exists:cargo_type_details,id',
                "quantity" => 'required',
                "quantity_unit" => 'required',
                "stowage_factor" => 'required',
                "landing_port_country_id" => 'required|exists:countries,id',
                "landing_port_name" => 'required',
                "discharging_port_country_id" => 'required|exists:countries,id',
                "discharging_port_name" => 'required',
                "lay_can_start_date" => 'required',
                "lay_can_canceling_date" => 'required',
                "try_vessel_date" => 'nullable',
                "loading_rate" => 'required',
                "loading_rate_unit" => 'required',
                "discharging_rate" => 'required',
                "discharging_unit" => 'required',
                "additional_cargo_details" => 'nullable',
                "special_requests" => 'nullable',
                "fright_idea" => 'nullable',
                "fright_idea_unit" => 'nullable',

                "address_commission" => 'required',

            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }

            $user = $request->user();
            $data = $request->only(
                "cargo_type_id",
                "quantity",
                "quantity_unit",
                "stowage_factor",
                "landing_port_country_id",
                "landing_port_name",
                "discharging_port_country_id",
                "discharging_port_name",
                "lay_can_start_date",
                "lay_can_canceling_date",
                "try_vessel_date",
                "loading_rate",
                "loading_rate_unit",
                "discharging_rate",
                "discharging_unit",
                "additional_cargo_details",
                "special_requests",
                "fright_idea",
                "fright_idea_unit",
                "working_status",
                "address_commission",
                "cargo_type_id",
                "cargo_type_details_id",
                "vessel_id",
            );

            $data[$user->account_type . '_id'] = $user->id;
            $data['type'] = "main";







            DB::beginTransaction();
            Cargo::query()->where('id', $request->id)->update($data);





            DB::commit();


            return  $this->sendSuccessResponse(null, 200, __('custom_messages.general.added'));
        } catch (\Exception $exception) {



            return $this->sendErrors($exception, 500);
        }
    }




    public function moveToMain(Request $request)
    {
        try {




            $rules = [
                "id" => 'required|exists:cargos,id',
            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }









            DB::beginTransaction();
         
                Cargo::query()->where('id', $request->id)->update(['type' => "main"]);
            


       


            return  $this->sendSuccessResponse(null, 200, __('custom_messages.general.updated'));
        } catch (\Exception $exception) {



            return $this->sendErrors($exception, 500);
        }
    }
    public function updateStatus(Request $request)
    {
        try {




            $rules = [
                "id" => 'required|exists:cargos,id',
                "new_status" =>
                 'required|in:edit_charterer,rejected_from_charterer,rejected_from_operator,done,cancelled,pending_charter_confirm',


            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }









            DB::beginTransaction();
            $cargo_target = Cargo::find($request->id);
              
            if( $cargo_target->type =='main' && $request->user()->account_type == 'operator'){
                $cargo = $cargo_target->replicate();
                $cargo->created_at = Carbon::now();
               
                    $cargo->created_at = Carbon::now();
                    $cargo->type = 'discuss';
                    $cargo->parent_id = $cargo_target->id;
                    $cargo->operator_id = $request->user()->id;
                
              
                $cargo->save();
                CargoInterested::query()
                 ->updateOrCreate(
                    [
                        "interested_id" => $cargo->charterer_id,
                        "interester_id" => $request->user()->id,
                        "cargo_id" => $cargo->id,
                    ],
                    [
                        "type" => "add",
                        "interested_id" => $cargo->charterer_id,
                        "interester_id" => $request->user()->id,
                        "cargo_id" => $cargo->id,
                    ]); 
                }
             else {
                $cargo = $cargo_target;
            }

            if ($request->new_status == 'done') {
          
                Cargo::query()
                ->where('type','discuss')
                ->where('parent_id', $cargo->parent_id)
                ->where('id', '!=',$cargo->id)
                ->update(['working_status'=>"signed_for_someone_else"]);
               $othersIds = Cargo::query()
                ->where('type','discuss')
                ->where('parent_id', $cargo->parent_id)
                
                ->pluck("operator_id","id")->toArray();

                Cargo::query()->where('id', $cargo->id)->update(['working_status' => "done"]);
                Cargo::query()->where('id', $cargo->parent_id)->update(['working_status' => "done","final_offer_id"=>$request->id]);
                $this->createMultiNotificationByAuthUserType([
                      'account_type' => $request->user()->account_type,
                      'sender_id' => $request->user()->id,
                'receiver_id' => $othersIds,
                'body_en' => "text cargo   status changed to  signed for someone  else " ,
              
                'title_en' => "Al-broker",
                'type' => "cargo",
                ]);

            } else {
                Cargo::query()->where('id', $cargo->id)->update(['working_status' => $request->new_status]);

            }
            DB::commit();


            $this->createNotificationByAuthUserType(   [
                'account_type' => $request->user()->account_type,
                'operator_id' => $request->user()->account_type == 'operator' ?$request->user()->id :$cargo-> operator_id,
                'charterer_id' => $cargo->charterer_id,
                'body_en' => "text cargo   status changed to   $request->new_status   from user   " . $request->user()->name,
                'target_id' => $cargo->id,
                'title_en' => "Al-broker",
                'type' => "cargo",

            ]);


            return  $this->sendSuccessResponse(["cargo_id"=>$cargo->id], 200, __('custom_messages.general.updated'));
            
        } catch (\Exception $exception) {



            return $this->sendErrors($exception->getMessage()."   " . $exception->getline(), 500);
        }
    }
    public function interseted(Request $request)
    {
        try {




            $rules = [
                "id" => 'required|exists:cargos,id'
            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }








            $rcv = Cargo::where('id', $request->id)->first();
         
             DB::beginTransaction();
          
                CargoInterested::query()
          
                ->updateOrCreate(
                    [
                        "interested_id" => $rcv->charterer_id,
                        "interester_id" => $request->user()->id,
                        "cargo_id" => $request->id,
                    ],
                    [
                        "type" => $request->type,
                        "interested_id" => $rcv->charterer_id,
                        "interester_id" => $request->user()->id,
                        "cargo_id" => $request->id,
                    ]);
                    $cargo = Cargo::find($request->id);

                    $this->createNotificationByAuthUserType( 
                          [
                        'account_type' => $request->user()->account_type,
                        'operator_id' => $request->user()->account_type == 'operator' ?$request->user()->id :$cargo-> operator_id,
                        'charterer_id' => $cargo->charterer_id,
                        'body_en' => "interseted on your cargo from user " . $request->user()->name,
                        'target_id' => $cargo->id,
                        'title_en' => "Al-broker",
                        'type' => "cargo",
        
                    ]
                );
                 
                  
              

            
            return  $this->sendSuccessResponse(null, 200, __('custom_messages.general.added'));



            DB::commit();


        } catch (\Exception $exception) {



            return $this->sendErrors($exception->getMessage()."   ".$exception->getLine(), 500);
        }
    }








    public function show($id)
    {
        try {

            $item = Cargo::query()
            ->where('is_deleted',0)
            ->with(
                'operator',
                'charter',
                'vessel',
                "landing_port_country",
                "discharging_port_country",
                "cargo_type",
                  "cargo_type.details",
                "cargo_type_details"
            )
                ->find($id);



            return  $this->sendSuccessResponse($item, 200);
        } catch (\Exception $exception) {
            return $this->sendErrors($exception, 500);
        }
    }



    public function delete(Request $request)
    {
        try {




            $rules = [
                "id" => "required|exists:cargos,id",


            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }

            $user = $request->user();








            DB::beginTransaction();
           $st  = Cargo::query()->where('id', $request->id)
                ->where('charterer_id', $user->id)
                ->update(['is_deleted' => 1]);
                if($st == 0) return $this->sendErrors(__('custom_messages.general.not_found'),400);

                Cargo::query()
                ->where('type','discuss')
                ->where('parent_id', $request->id)
                ->update(['is_deleted'=>1]);
               $othersIds = Cargo::query()
                ->where('type','discuss')
                ->where('parent_id',$request->id)
         
                ->pluck("operator_id","id")->toArray();
                $this->createMultiNotificationByAuthUserType([
                                    'account_type' => $request->user()->account_type,
                                    'sender_id' => $request->user()->id,
                                'receiver_id' => $othersIds,
                                'body_en' => "cargo  deleted   from owner   " . $request->user()->name,
                            
                                'title_en' => "Al-broker",
                                'type' => "cargo",
                                ]);






            DB::commit();
            return  $this->sendSuccessResponse(null, 200, __('custom_messages.general.deleted'));
        } catch (\Exception $exception) {



            return $this->sendErrors($exception, 500);
        }
    }

     public function getPDF($id)
    {
        try {

            $item = Cargo::query()->where('is_deleted', 0)
            ->where(auth('api')->user()->account_type.'_id',auth('api')->user()->id)
            ->where('id',$id)
                ->first();
                
 
                    $pdf = \PDF::loadView('cargo.preview');
                    $name = time() . 'contract.pdf';
                    $path = Storage::disk('public')->put($name,$pdf->output());
                    $path = request()->getSchemeAndHttpHost().'/storage/' . $name;
                    return $this->sendSuccessResponse(["link"=>$path]);
              
               
                
            


 
        } catch (\Exception $exception) {
            return $this->sendErrors($exception->getMessage(), 500);
        }
    }

    public function upload_contract(Request $request)
    {
        try {

            $rules = [
                "id" => 'required|exists:cargos,id',
                "file_type" => 'required|in:final,charter,operator',
                "media_file" => 'required',

            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }
            if($request->file_type== 'charterer')$request->file_type = 'charter';
            $path = Utilities::upload($request->media_file, 'contracts');
            Cargo::where('id', $request->id)->update([
                $request->file_type . '_file' => $path
            ]);




            return  $this->sendSuccessResponse(null, 200, __('custom_messages.general.added'));
        } catch (\Exception $exception) {

            return $this->sendErrors($exception, 500);
        }
    }
    public function createNotificationByAuthUserType(array $data)
    {

        if ($data['account_type'] == 'operator') {
            $receiver_id = $data['charterer_id'];
            $sender_id = $data['operator_id'];
        } else {
            $receiver_id = $data['operator_id'];
            $sender_id = $data['charterer_id'];
        }
        $ntf = [
            'sender_id' => $sender_id,
            'target_id' => $data['target_id'],
            'receiver_id' => $receiver_id,
            'body_en' => $data["body_en"],
            'title_en' => $data["title_en"],
            'type' => "cargo"
        ];
        Notification::create($ntf);
        return true;
    }



 
    public function createMultiNotificationByAuthUserType(array $data)
    {

        $ntf = [];
        foreach ($data["receiver_id"] as $key=> $item) {
            array_push($ntf,
            [
                'sender_id' => $data['sender_id'],
                 'receiver_id' => $item,
                'target_id' => $key,
                'body_en' => $data["body_en"],
                'title_en' => $data["title_en"],
                'type' => "cargo"
            ]);
        }
        Notification::insert($ntf);
        return true;
    }
}
