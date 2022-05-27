<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPortRequest;
use App\Http\Requests\StorePortRequest;
use App\Http\Requests\UpdatePortRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Port;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PortController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = Port::with(['country', 'city'])->select(sprintf('*', (new Port())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'port_show';
                $editGate = 'port_edit';
                $deleteGate = 'port_delete';
                $crudRoutePart = 'ports';

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
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'country', 'city','name']);

            return $table->make(true);
        }

        return view('admin.ports.index');
    }

    public function create()
    {

        $countries = Country::orderBy('name')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ports.create', compact('countries', 'cities'));
    }

    public function store(Request $request)
    {
        $port = Port::create($request->all());
        session()->flash('message','Port'.' '.trans('custom_messages.general.saved'));
        return redirect()->route('dashboard.ports.index');
    }

    public function edit(Port $port)
    {

        $countries = Country::orderBy('name')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $port->load('country', 'city');

        return view('admin.ports.edit', compact('countries', 'cities', 'port'));
    }

    public function update(Request $request, Port $port)
    {
        $port->update($request->all());
        session()->flash('message','Port'.' '.trans('custom_messages.general.updated'));
        return redirect()->route('dashboard.ports.index');
    }

    public function show(Port $port)
    {

        $port->load('country', 'city');

        return view('admin.ports.show', compact('port'));
    }

    public function destroy(Port $port)
    {
        $port->delete();
        session()->flash('message','Port'.' '.trans('custom_messages.general.deleted'));
        return redirect()->route('dashboard.ports.index');

       
    }

    public function massDestroy(MassDestroyPortRequest $request)
    {
        Port::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
