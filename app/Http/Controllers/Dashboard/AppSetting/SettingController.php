<?php

namespace App\Http\Controllers\Dashboard\AppSetting;

use App\Core\Helpers\Utilities;
use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\GeneralText;
use Illuminate\Http\Request;

class SettingController extends BaseApiController
{
    public function index($key)
    {
        try {
            $item = GeneralText::query()->where('key', $key)->first();
            return view("dashboard.appSetting.index", compact('item'));
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function edit($key)
    {
        try {
            $item = GeneralText::query()->where('key', $key)->first();

            return \view("dashboard.appSetting.edit", compact('item'));
        } catch (\Exception $ex) {
            return redirect(route('setting.index', $key))->withErrors($ex->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $rules = [
                'content' => 'required',
                'key' => 'required',
            ];
            $res_validate = $this->validateRequest($request, $rules);
            if ($res_validate['status'] === false) {
                return redirect(route('setting.index', $request->key))->withErrors($res_validate['errors']);
            }
            $data = $request->only(
                'key',
                'title',
                'title_ar',
                'content',
                'content_ar',
                'email'
            );
            if ($request->hasFile('media_file')) {
                $data['media_path'] = Utilities::upload2($request->media_file, 'generalText');
            }
            $obj = GeneralText::query()->updateOrCreate(['key' => $data["key"]], $data);
            GeneralText::query()
                ->where('key', '=', $data["key"])
                ->where('id', '!=', $obj->id)
                ->delete();

            return redirect(route('setting.index', $obj->key))->withStatus(__('custom_messages.general.updated'));
        } catch (\Exception $ex) {
            return redirect(route('setting.index', $obj->key))->withErrors($ex->getMessage());
        }
    }
}
