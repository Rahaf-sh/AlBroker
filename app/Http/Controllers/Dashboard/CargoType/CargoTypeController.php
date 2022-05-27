<?php

namespace App\Http\Controllers\Dashboard\CargoType;

use App\Http\Controllers\Controller;
use App\Models\CargoType;
use App\Models\CargoTypeDetails;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CargoTypeController extends Controller
{

    private $view_index = 'dashboard.cargo_type.index';
    private $view_edit = 'dashboard.cargo_type.edit';
    private $view_show = 'dashboard.cargo_type.show';
    private $view_create = 'dashboard.cargo_type.create';
    private $route = 'cargo_type';
    private $model = CargoType::class;
    private $pageTitle = 'Cargo type';

    public function index()
    {
        $paginate = request('paginate_count') > 0 ? request('paginate_count') : 8;

        $data = $this->model::query()
            ->where('is_deleted', 0)
            ->when(request('date'), function ($q) {
                $q->whereDate('created_at', request('date'));
            })
            ->paginate($paginate);
        $route = $this->route;
        return view($this->view_index, compact('data', 'route'));
    }

    public function create()
    {
        try {
            $route = $this->route;
            return view($this->view_create, compact('route'));
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'name_en' => 'required',
                'name_ar' => 'required',
                'min_usd' => 'required|numeric',
                'max_usd' => 'required|numeric',
                'min_euro' => 'required|numeric',
                'max_euro' => 'required|numeric',
            ];
            $credentials = $request->all();
            $validator = Validator::make($credentials, $rules);
            if ($validator->fails()) return redirect()->back()->withErrors($validator->getMessageBag());
            DB::beginTransaction();
            $data = new CargoType();
            $data->name_ar = $request->name_ar;
            $data->name_en = $request->name_en;
            $data->save();
            CargoTypeDetails::query()->create([
                "unit" => 'usd',
                "min_" => $request->min_usd,
                "max_" => $request->max_usd,
                "cargo_type_id" => $data->id,
            ]);
            CargoTypeDetails::query()->create([
                "unit" => 'euro',
                "min_" => $request->min_euro,
                "max_" => $request->max_euro,
                "cargo_type_id" => $data->id,
            ]);
            DB::commit();
            return redirect()->route('cargo_type.index')->withStatus(__('category.created_successfully'));
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data = $this->model::query()->find($id);
            $route = $this->route;
            return view($this->view_show, compact('data', 'route'));
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $data = $this->model::query()->find($id);
            $route = $this->route;
            return view($this->view_edit, compact('data', 'route'));
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $this->model::query()->find($id);
            $data->name_ar = $request->name_ar;
            $data->name_en = $request->name_en;
            $data->save();
            if (is_null($request->usd_id)) {
                CargoTypeDetails::query()->create([
                    "unit" => 'usd',
                    "min_" => $request->min_usd,
                    "max_" => $request->max_usd,
                    "cargo_type_id" => $id,
                ]);
            } else {
                $data->usd->min_ = $request->min_usd;
                $data->usd->max_ = $request->max_usd;
                $data->usd->save();
            }
            if (is_null($request->euro_id)) {
                CargoTypeDetails::query()->create([
                    "unit" => 'euro',
                    "min_" => $request->min_euro,
                    "max_" => $request->max_euro,
                    "cargo_type_id" => $id,
                ]);
            } else {
                $data->euro->min_ = $request->min_euro;
                $data->euro->max_ = $request->max_euro;
                $data->euro->save();
            }
            return redirect()->route('cargo_type.index');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
