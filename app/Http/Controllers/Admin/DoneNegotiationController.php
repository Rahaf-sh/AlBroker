<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDoneNegotiationRequest;
use App\Http\Requests\StoreDoneNegotiationRequest;
use App\Http\Requests\UpdateDoneNegotiationRequest;
use App\Models\DoneNegotiation;
use App\Models\Negotiation;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DoneNegotiationController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('done_negotiation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DoneNegotiation::with(['negotiation', 'operator', 'charterer'])->select(sprintf('%s.*', (new DoneNegotiation())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'done_negotiation_show';
                $editGate = 'done_negotiation_edit';
                $deleteGate = 'done_negotiation_delete';
                $crudRoutePart = 'done-negotiations';

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

            $table->addColumn('operator_email', function ($row) {
                return $row->operator ? $row->operator->email : '';
            });

            $table->addColumn('charterer_email', function ($row) {
                return $row->charterer ? $row->charterer->email : '';
            });

            $table->editColumn('file', function ($row) {
                if (!$row->file) {
                    return '';
                }
                $links = [];
                foreach ($row->file as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'negotiation', 'operator', 'charterer', 'file']);

            return $table->make(true);
        }

        return view('admin.doneNegotiations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('done_negotiation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $negotiations = Negotiation::pluck('uuid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $operators = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $charterers = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.doneNegotiations.create', compact('negotiations', 'operators', 'charterers'));
    }

    public function store(StoreDoneNegotiationRequest $request)
    {
        $doneNegotiation = DoneNegotiation::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $doneNegotiation->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $doneNegotiation->id]);
        }

        return redirect()->route('admin.done-negotiations.index');
    }

    public function edit(DoneNegotiation $doneNegotiation)
    {
        abort_if(Gate::denies('done_negotiation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $negotiations = Negotiation::pluck('uuid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $operators = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $charterers = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doneNegotiation->load('negotiation', 'operator', 'charterer');

        return view('admin.doneNegotiations.edit', compact('negotiations', 'operators', 'charterers', 'doneNegotiation'));
    }

    public function update(UpdateDoneNegotiationRequest $request, DoneNegotiation $doneNegotiation)
    {
        $doneNegotiation->update($request->all());

        if (count($doneNegotiation->file) > 0) {
            foreach ($doneNegotiation->file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $doneNegotiation->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $doneNegotiation->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        return redirect()->route('admin.done-negotiations.index');
    }

    public function show(DoneNegotiation $doneNegotiation)
    {
        abort_if(Gate::denies('done_negotiation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doneNegotiation->load('negotiation', 'operator', 'charterer');

        return view('admin.doneNegotiations.show', compact('doneNegotiation'));
    }

    public function destroy(DoneNegotiation $doneNegotiation)
    {
        abort_if(Gate::denies('done_negotiation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doneNegotiation->delete();

        return back();
    }

    public function massDestroy(MassDestroyDoneNegotiationRequest $request)
    {
        DoneNegotiation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('done_negotiation_create') && Gate::denies('done_negotiation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DoneNegotiation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}