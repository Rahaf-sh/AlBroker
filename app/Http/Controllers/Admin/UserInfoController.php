<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserInfoRequest;
use App\Http\Requests\StoreUserInfoRequest;
use App\Http\Requests\UpdateUserInfoRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\UserInfo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserInfoController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserInfo::with(['user', 'nationality', 'city'])->select(sprintf('%s.*', (new UserInfo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_info_show';
                $editGate = 'user_info_edit';
                $deleteGate = 'user_info_delete';
                $crudRoutePart = 'user-infos';

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

            $table->editColumn('icc_imo', function ($row) {
                return $row->icc_imo ? $row->icc_imo : '';
            });
            $table->addColumn('nationality_name', function ($row) {
                return $row->nationality ? $row->nationality->name : '';
            });

            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('mobile_number', function ($row) {
                return $row->mobile_number ? $row->mobile_number : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'nationality', 'city']);

            return $table->make(true);
        }

        return view('admin.userInfos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nationalities = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userInfos.create', compact('users', 'nationalities', 'cities'));
    }

    public function store(StoreUserInfoRequest $request)
    {
        $userInfo = UserInfo::create($request->all());

        return redirect()->route('admin.user-infos.index');
    }

    public function edit(UserInfo $userInfo)
    {
        abort_if(Gate::denies('user_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nationalities = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userInfo->load('user', 'nationality', 'city');

        return view('admin.userInfos.edit', compact('users', 'nationalities', 'cities', 'userInfo'));
    }

    public function update(UpdateUserInfoRequest $request, UserInfo $userInfo)
    {
        $userInfo->update($request->all());

        return redirect()->route('admin.user-infos.index');
    }

    public function show(UserInfo $userInfo)
    {
        abort_if(Gate::denies('user_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userInfo->load('user', 'nationality', 'city');

        return view('admin.userInfos.show', compact('userInfo'));
    }

    public function destroy(UserInfo $userInfo)
    {
        abort_if(Gate::denies('user_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userInfo->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserInfoRequest $request)
    {
        UserInfo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
