<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use DataTables;
use App\Models\CargoType;
use App\Models\CargoTypeDetails;

class CargoTypeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = CargoType::query()->select(sprintf('*', (new CargoType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'cargo_type_show';
                $editGate = 'cargo_type_edit';
                $deleteGate = 'cargo_type_delete';
                $crudRoutePart = 'cargo-types';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name_en', function ($row) {
                return $row->name_en ? $row->name_en : '';
            });
            $table->editColumn('name_ar', function ($row) {
                return $row->name_ar ? $row->name_ar : '';
            });
           
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.cargoTypes.index');
    }

    public function create()
    {
        return view('admin.cargoTypes.create');
    }

    public function store(Request $request)
    {
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
        $data = new CargoType();
        $data->name_ar = $request->name_ar;
        $data->name_en = $request->name_en;
        $data->save();
        CargoTypeDetails::create([
            "unit" => 'usd',
            "min_" => $request->min_usd,
            "max_" => $request->max_usd,
            "cargo_type_id" => $data->id,
        ]);
        CargoTypeDetails::create([
            "unit" => 'euro',
            "min_" => $request->min_euro,
            "max_" => $request->max_euro,
            "cargo_type_id" => $data->id,
        ]);
        session()->flash('message','Cargo Type'.' '.trans('custom_messages.general.saved'));
        return redirect()->route('dashboard.cargo-types.index');
    }

    public function edit(cargoType $cargoType)
    {
        return view('admin.cargoTypes.edit', compact('cargoType'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data =  CargoType::find($id);
            $data->name_ar = $request->name_ar;
            $data->name_en = $request->name_en;
            $data->save();
            if (is_null($request->usd_id)) {
                CargoTypeDetails::create([
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
                CargoTypeDetails::create([
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
            session()->flash('message','Cargo Type'.' '.trans('custom_messages.general.updated'));
            return redirect()->route('dashboard.cargo-types.index');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function show(cargoType $cargoType)
    {
        return view('admin.cargoTypes.show', compact('cargoType'));
    }

    public function destroy(cargoType $cargoType)
    {
        $cargoType->delete();
        session()->flash('message','Cargo Type'.' '.trans('custom_messages.general.deleted'));
        return redirect()->route('dashboard.cargo-types.index');
    }

    public function massDestroy(MassDestroycargoTypeRequest $request)
    {
        cargoType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
