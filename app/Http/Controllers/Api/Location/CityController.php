<?php

namespace App\Http\Controllers\Api\Location;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Traits\GeneralFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    use GeneralFunction;
    public function __construct()
    {
        $this->changeLang(request()->header('lang-app'));
    }

    public function index()
    {
        try {
            $citties = City::query()->where('is_deleted',0);
                  request('with_paginate')== 'yes' ? $citties = $citties->paginate(8) : $citties = $citties->get();
            return response()->json(['status'=>true,'data'=>$citties],200);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function getById($id)
    {
        try {
            $city = City::query()->where('is_deleted',0)->where('id',$id)->first();
            if (is_null($city))return response()->json(['status'=>false,'message'=>__('custom_messages.general.not_found')],404);
            return response()->json(['status'=>true,'data'=>$city],200);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        $rules =[
            'name'=>'required|unique:cities',
            'name_ar'=>'required|unique:cities',
            'country_id'=>'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) return response()->json(['status'=>false,'message'=>$validator->getMessageBag()],400);
        try {
            $city = City::query()->create($request->only(['name','name_ar','country_id']));
            return response()->json(['status'=>true,'data'=>$city],200);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function update($id,Request $request)
    {
        $rules =[
            'name'=>'required|unique:cities,id,'.$id,
            'name_ar'=>'required|unique:cities,id,'.$id,
            'country_id'=>'required',

        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) return response()->json(['status'=>false,'message'=>$validator->getMessageBag()],400);
        try {
            $city = City::query()->find($id);
            if (is_null($city))return response()->json(['status'=>false,'message'=>__('custom_messages.general.not_found')],404);
            $data= $request->only(['name','name_ar','country_id']);
            $city->update($data);
            return response()->json(['status'=>true,'data'=>$city],200);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $city = City::query()->where('is_deleted',0)->where('id',$id)->first();
            if (is_null($city))return response()->json(['status'=>false,'message'=>__('custom_messages.general.not_found')],404);
            $city->is_deleted = true;
            $city->save();
            return response()->json(['status'=>true,'message'=>__('custom_messages.general.deleted')],200);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }
}
