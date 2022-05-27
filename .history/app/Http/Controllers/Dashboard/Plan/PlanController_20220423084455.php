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

    
}
