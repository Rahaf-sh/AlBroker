<?php

namespace App\Http\Controllers\Api\Vessel;

use App\Core\Helpers\Utilities;
use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Vessel;
use App\Models\VesselMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VesselController extends BaseApiController
{
    public function index()
    {
        try {
            $query = Vessel::query()->where('is_deleted', 0);

            request('with_operator') == 'yes' ? $query->with('operator') : '';
            request('with_paginate') == 'yes' ? $data = $query->paginate(8) : $data = $query->get();
            return $this->sendSuccessResponse($data);
        } catch (\Exception $ex) {
            return $this->sendErrors($ex, 500);
        }
    }


    public function myIndex()
    {
        try {
            $query = Vessel::query()->where('is_deleted', 0)
                ->where('operator_id', auth()->user()->id)
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
                "name" => "required",
                "email" => "required|unique:vessels",
                "imo" => "required|unique:vessels",

                "item_media" => "nullable|array",

            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }

            $user = $request->user();
            $data = $request->only(
                "name",
                "email",
                "imo",

            );

            $data['operator_id'] = $user->id;




            DB::beginTransaction();
            $item = Vessel::query()->create($data);
            if ($request->hasFile('item_media')) {
                foreach ($request->file('item_media') as $k => $data2) {

                    $path = Utilities::upload2($data2, 'items');
                    $data['media_path'] = $path;
                    $data['vessel_id'] = $item->id;
                    if ($k == 0) {
                        $item->main_image = $path;
                        $item->save();
                    }
                    VesselMedia::query()->create($data);
                }
            }




            DB::commit();


            return  $this->sendSuccessResponse(null, 200, __('custom_messages.general.added'));
        } catch (\Exception $exception) {



            return $this->sendErrors($exception, 500);
        }
    }



    public function update(Request $request)
    {
        try {




            $rules = [
                "id" => "required|exists:vessels,id",
                "name" => "required",
                "email" => "required|unique:vessels,id," . $request->id,
                "imo" => "required|unique:vessels,id," . $request->id,
                "item_media" => "nullable|array",
                "item_media_to_delete" => "nullable|array",

            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }

            $user = $request->user();
            $data = $request->only(
                "name",
                "email",

                "imo",


            );

            $data['operator_id'] = $user->id;





            DB::beginTransaction();
            Vessel::query()->where('id', $request->id)->update($data);
            $item = Vessel::query()->where('id', $request->id)->where('operator_id', $data['operator_id'])->first();
            if (is_null($item)) {
                return $this->sendErrors(__('custom_messages.general.not_found'), 400);
            }
            if ($request->hasFile('item_media')) {
                foreach ($request->file('item_media') as $k => $data2) {

                    $path = Utilities::upload2($data2, 'items');
                    $data['media_path'] = $path;
                    $data['vessel_id'] = $item->id;
                    if ($k == 0) {
                        $item->main_image = $path;
                        $item->save();
                    }
                    VesselMedia::query()->create($data);
                }
            }
            VesselMedia::query()->where('vessel_id', $item->id)->whereIn('id', $request->item_media_to_delete ?? [])->delete();
            DB::commit();
            return  $this->sendSuccessResponse($item->load('media'), 200, __('custom_messages.general.updated'));
        } catch (\Exception $exception) {
            dd($exception);


            return $this->sendErrors($exception, 500);
        }
    }



    public function show($id)
    {
        try {

            $item = Vessel::query()->with(
                'media'
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
                "id" => "required|exists:vessels,id" ,


            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }

            $user = $request->user();
 







            DB::beginTransaction();
            Vessel::query()->where('id', $request->id)
                ->where('operator_id', $user->id)
                ->update( ['is_deleted' => 1]);


            DB::commit();
            return  $this->sendSuccessResponse(null, 200, __('custom_messages.general.deleted'));
        } catch (\Exception $exception) {

            dd($exception);

            return $this->sendErrors($exception, 500);
        }
    }
}
