<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyShipmentRequest;
use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Cargo;
use App\Models\Negotiation;
use App\Models\Port;
use App\Models\Shipment;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('shipment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Shipment::with(['negotiation', 'user', 'cargo', 'discharging_port'])->select(sprintf('%s.*', (new Shipment())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'shipment_show';
                $editGate = 'shipment_edit';
                $deleteGate = 'shipment_delete';
                $crudRoutePart = 'shipments';

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
            $table->addColumn('negotiation_uuid', function ($row) {
                return $row->negotiation ? $row->negotiation->uuid : '';
            });

            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });

            $table->addColumn('cargo_quantity', function ($row) {
                return $row->cargo ? $row->cargo->quantity : '';
            });

            $table->addColumn('discharging_port_name', function ($row) {
                return $row->discharging_port ? $row->discharging_port->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'negotiation', 'user', 'cargo', 'discharging_port']);

            return $table->make(true);
        }

        return view('admin.shipments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('shipment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $negotiations = Negotiation::pluck('uuid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cargos = Cargo::pluck('quantity', 'id')->prepend(trans('global.pleaseSelect'), '');

        $discharging_ports = Port::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.shipments.create', compact('negotiations', 'users', 'cargos', 'discharging_ports'));
    }

    public function store(StoreShipmentRequest $request)
    {
        $shipment = Shipment::create($request->all());

        return redirect()->route('admin.shipments.index');
    }

    public function edit(Shipment $shipment)
    {
        abort_if(Gate::denies('shipment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $negotiations = Negotiation::pluck('uuid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cargos = Cargo::pluck('quantity', 'id')->prepend(trans('global.pleaseSelect'), '');

        $discharging_ports = Port::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipment->load('negotiation', 'user', 'cargo', 'discharging_port');

        return view('admin.shipments.edit', compact('negotiations', 'users', 'cargos', 'discharging_ports', 'shipment'));
    }

    public function update(UpdateShipmentRequest $request, Shipment $shipment)
    {
        $shipment->update($request->all());

        return redirect()->route('admin.shipments.index');
    }

    public function show(Shipment $shipment)
    {
        abort_if(Gate::denies('shipment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shipment->load('negotiation', 'user', 'cargo', 'discharging_port');

        return view('admin.shipments.show', compact('shipment'));
    }

    public function destroy(Shipment $shipment)
    {
        abort_if(Gate::denies('shipment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shipment->delete();

        return back();
    }

    public function massDestroy(MassDestroyShipmentRequest $request)
    {
        Shipment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}