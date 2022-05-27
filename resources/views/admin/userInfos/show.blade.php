@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userInfo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-infos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userInfo.fields.id') }}
                        </th>
                        <td>
                            {{ $userInfo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userInfo.fields.user') }}
                        </th>
                        <td>
                            {{ $userInfo->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userInfo.fields.icc_imo') }}
                        </th>
                        <td>
                            {{ $userInfo->icc_imo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userInfo.fields.nationality') }}
                        </th>
                        <td>
                            {{ $userInfo->nationality->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userInfo.fields.city') }}
                        </th>
                        <td>
                            {{ $userInfo->city->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userInfo.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $userInfo->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userInfo.fields.mobile_number') }}
                        </th>
                        <td>
                            {{ $userInfo->mobile_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userInfo.fields.address') }}
                        </th>
                        <td>
                            {{ $userInfo->address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-infos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection