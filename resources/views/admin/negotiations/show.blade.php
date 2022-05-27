@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.negotiation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.negotiations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.negotiation.fields.id') }}
                        </th>
                        <td>
                            {{ $negotiation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.negotiation.fields.operator') }}
                        </th>
                        <td>
                            {{ $negotiation->operator->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.negotiation.fields.charterer') }}
                        </th>
                        <td>
                            {{ $negotiation->charterer->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.negotiation.fields.cargo') }}
                        </th>
                        <td>
                            {{ $negotiation->cargo->quantity ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.negotiations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection