<?php

namespace App\Http\Controllers\Dashboard\Plan;

use App\Core\Helpers\Utilities;
use App\Http\Controllers\BaseApiController;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends BaseApiController
{
    public function index($key)
    {
        try {
            $items = Plan::query()->where('is_deleted', false)->get();
            return view("dashboard.plan.index", compact('items'));
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function edit($key)
    {
        try {
            $item = Plan::query()->where('key', $key)->first();

            return \view("dashboard.plan.edit", compact('item'));
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
            $obj = Plan::query()->updateOrCreate(['key' => $data["key"]], $data);

            return redirect(route('setting.index', $obj->key))->withStatus(__('custom_messages.general.updated'));
        } catch (\Exception $ex) {
            return redirect(route('setting.index', $obj->key))->withErrors($ex->getMessage());
        }
    }
}
