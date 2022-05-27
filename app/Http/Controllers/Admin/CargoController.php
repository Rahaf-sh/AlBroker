<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCargoRequest;
use App\Http\Requests\StoreCargoRequest;
use App\Http\Requests\UpdateCargoRequest;
use App\Models\Cargo;
use App\Models\City;
use App\Models\Country;
use App\Models\CargoType;
use App\Models\Port;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CargoController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = Cargo::with(['cargo_type', 'landing_port_country', 'discharging_port_country'])->select(sprintf('*', (new Cargo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'cargo_show';
                $editGate = 'cargo_edit';
                $deleteGate = 'cargo_delete';
                $crudRoutePart = 'cargos';

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
            $table->addColumn('cargo_type_name', function ($row) {
                return $row->cargo_type ? $row->cargo_type->name_en : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->addColumn('landing_port_country', function ($row) {
                return $row->landing_port_country ? $row->landing_port_country->name : '';
            });

            $table->addColumn('discharging_port_country_name', function ($row) {
                return $row->discharging_port_country ? $row->discharging_port_country->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'cargo_type', 'landing_port_country', 'loading_port_city', 'loading_port_port', 'discharging_port_country', 'discharging_port_city']);

            return $table->make(true);
        }

        return view('admin.cargos.index');
    }

    public function create()
    {

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cargo_types = CargoType::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $loading_port_countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $loading_port_cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $loading_port_ports = Port::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $discharging_port_countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $discharging_port_cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $discharging_ports = Port::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cargos.create', compact('users','cargo_types', 'loading_port_countries', 'loading_port_cities',  'discharging_port_countries', 'discharging_port_cities'));
    }

    public function store(Request $request)
    {
        $cargo = Cargo::create($request->all());
        session()->flash('message','Cargo'.' '.trans('custom_messages.general.saved'));
        return redirect()->route('dashboard.cargos.index');
    }

    public function edit(Cargo $cargo)
    {

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cargo_types = CargoType::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $loading_port_countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $loading_port_cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $loading_port_ports = Port::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $discharging_port_countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $discharging_port_cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $discharging_ports = Port::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cargo->load('charter','cargo_type', 'landing_port_country',  'discharging_port_country');

        return view('admin.cargos.edit', compact('users','cargo_types', 'loading_port_countries','discharging_port_countries', 'cargo'));
    }

    public function update(Request $request, Cargo $cargo)
    {
        $cargo->update($request->all());
        session()->flash('message','Cargo'.' '.trans('custom_messages.general.updated'));
        return redirect()->route('dashboard.cargos.index');
    }

    public function show(Cargo $cargo)
    {

        $cargo->load('charter','cargo_type', 'landing_port_country' ,'discharging_port_country');

        return view('admin.cargos.show', compact('cargo'));
    }

    public function destroy(Cargo $cargo)
    {

        $cargo->delete();
        session()->flash('message','Cargo'.' '.trans('custom_messages.general.deleted'));
        return redirect()->route('dashboard.cargos.index');
    }

    public function massDestroy(MassDestroyCargoRequest $request)
    {
        Cargo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
