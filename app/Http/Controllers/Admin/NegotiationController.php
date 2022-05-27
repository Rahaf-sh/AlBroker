<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNegotiationRequest;
use App\Http\Requests\StoreNegotiationRequest;
use App\Http\Requests\UpdateNegotiationRequest;
use App\Models\Cargo;
use App\Models\Negotiation;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NegotiationController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('negotiation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Negotiation::with(['operator', 'charterer', 'cargo'])->select(sprintf('%s.*', (new Negotiation())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'negotiation_show';
                $editGate = 'negotiation_edit';
                $deleteGate = 'negotiation_delete';
                $crudRoutePart = 'negotiations';

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
            $table->addColumn('operator_email', function ($row) {
                return $row->operator ? $row->operator->email : '';
            });

            $table->addColumn('charterer_email', function ($row) {
                return $row->charterer ? $row->charterer->email : '';
            });

            $table->addColumn('cargo_quantity', function ($row) {
                return $row->cargo ? $row->cargo->quantity : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'operator', 'charterer', 'cargo']);

            return $table->make(true);
        }

        return view('admin.negotiations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('negotiation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operators = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $charterers = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cargos = Cargo::pluck('quantity', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.negotiations.create', compact('operators', 'charterers', 'cargos'));
    }

    public function store(StoreNegotiationRequest $request)
    {
        $negotiation = Negotiation::create($request->all());

        return redirect()->route('admin.negotiations.index');
    }

    public function edit(Negotiation $negotiation)
    {
        abort_if(Gate::denies('negotiation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operators = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $charterers = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cargos = Cargo::pluck('quantity', 'id')->prepend(trans('global.pleaseSelect'), '');

        $negotiation->load('operator', 'charterer', 'cargo');

        return view('admin.negotiations.edit', compact('operators', 'charterers', 'cargos', 'negotiation'));
    }

    public function update(UpdateNegotiationRequest $request, Negotiation $negotiation)
    {
        $negotiation->update($request->all());

        return redirect()->route('admin.negotiations.index');
    }

    public function show(Negotiation $negotiation)
    {
        abort_if(Gate::denies('negotiation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $negotiation->load('operator', 'charterer', 'cargo');

        return view('admin.negotiations.show', compact('negotiation'));
    }

    public function destroy(Negotiation $negotiation)
    {
        abort_if(Gate::denies('negotiation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $negotiation->delete();

        return back();
    }

    public function massDestroy(MassDestroyNegotiationRequest $request)
    {
        Negotiation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}