<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVesselRequest;
use App\Http\Requests\StoreVesselRequest;
use App\Http\Requests\UpdateVesselRequest;
use App\Models\User;
use App\Models\Vessel;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VesselController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = Vessel::with(['user'])->select(sprintf('*', (new Vessel())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'vessel_show';
                $editGate = 'vessel_edit';
                $deleteGate = 'vessel_delete';
                $crudRoutePart = 'vessels';

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
            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });

            $table->editColumn('imo_number', function ($row) {
                return $row->imo_number ? $row->imo_number : '';
            });
            $table->editColumn('vessel_name', function ($row) {
                return $row->vessel_name ? $row->vessel_name : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('flag', function ($row) {
                return $row->flag ? $row->flag : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.vessels.index');
    }

    public function create()
    {

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vessels.create', compact('users'));
    }

    public function store(StoreVesselRequest $request)
    {
        $vessel = Vessel::create($request->all());

        if ($request->input('photo', false)) {
            $vessel->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        foreach ($request->input('photo_galley', []) as $file) {
            $vessel->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo_galley');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $vessel->id]);
        }

        return redirect()->route('admin.vessels.index');
    }

    public function edit(Vessel $vessel)
    {
        abort_if(Gate::denies('vessel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vessel->load('user');

        return view('admin.vessels.edit', compact('users', 'vessel'));
    }

    public function update(UpdateVesselRequest $request, Vessel $vessel)
    {
        $vessel->update($request->all());

        if ($request->input('photo', false)) {
            if (!$vessel->photo || $request->input('photo') !== $vessel->photo->file_name) {
                if ($vessel->photo) {
                    $vessel->photo->delete();
                }
                $vessel->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($vessel->photo) {
            $vessel->photo->delete();
        }

        if (count($vessel->photo_galley) > 0) {
            foreach ($vessel->photo_galley as $media) {
                if (!in_array($media->file_name, $request->input('photo_galley', []))) {
                    $media->delete();
                }
            }
        }
        $media = $vessel->photo_galley->pluck('file_name')->toArray();
        foreach ($request->input('photo_galley', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $vessel->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo_galley');
            }
        }

        return redirect()->route('admin.vessels.index');
    }

    public function show(Vessel $vessel)
    {
        abort_if(Gate::denies('vessel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vessel->load('user');

        return view('admin.vessels.show', compact('vessel'));
    }

    public function destroy(Vessel $vessel)
    {
        abort_if(Gate::denies('vessel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vessel->delete();

        return back();
    }

    public function massDestroy(MassDestroyVesselRequest $request)
    {
        Vessel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('vessel_create') && Gate::denies('vessel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Vessel();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}