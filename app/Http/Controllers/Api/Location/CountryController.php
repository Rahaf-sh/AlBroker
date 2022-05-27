<?php

namespace App\Http\Controllers\Api\Location;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Traits\GeneralFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    use GeneralFunction;
    public function __construct()
    {
        $this->changeLang(request()->header('lang-app'));
    }

    public function index()
    {
        try {
            $countires = Country::query()->where('is_deleted',0);
                        request('with_paginate')== 'yes' ? $countires = $countires->paginate(8) : $countires = $countires->get();

            return $this->sendSuccessResponse($countires);

        } catch (\Exception $ex) {
            dd($ex);
            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }

    public function getById($id)
    {
        try {
            $country = Country::query()->with('citties')->where('is_deleted',0)->where('id',$id)->first();
            return $this->sendSuccessResponse($country);

        } catch (\Exception $ex) {
            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }
    public function store(Request $request)
    {
        $rules =[
            'name'=>'required|unique:countries',
            'name_ar'=>'required|unique:countries',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) return response()->json(['status'=>false,'message'=>$validator->getMessageBag()],400);
        try {
            $country = Country::query()->create($request->only(['name','name_ar']));
            return response()->json(['status'=>true,'data'=>$country->load('citties')],200);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function update($id,Request $request)
    {
        $rules =[
            'name'=>'required|unique:countries,id,'.$id,
            'name_ar'=>'required|unique:countries,id,'.$id,
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) return response()->json(['status'=>false,'message'=>$validator->getMessageBag()],400);
        try {
            $country = Country::query()->find($id);
            if (is_null($country))return response()->json(['status'=>false,'message'=>__('custom_messages.general.not_found')],404);
            $data= $request->only(['name','name_ar']);
            $country->update($data);
            return response()->json(['status'=>true,'data'=>$country->load('citties')],200);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $country = Country::query()->where('is_deleted',0)->where('id',$id)->first();
            if (is_null($country))return response()->json(['status'=>false,'message'=>__('custom_messages.general.not_found')],404);
            $country->is_deleted = true;
            $country->save();
            return response()->json(['status'=>true,'message'=>__('custom_messages.general.deleted')],200);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }
}
