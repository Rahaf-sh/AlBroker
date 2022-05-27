@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.doneNegotiation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.done-negotiations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.doneNegotiation.fields.id') }}
                        </th>
                        <td>
                            {{ $doneNegotiation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doneNegotiation.fields.negotiation') }}
                        </th>
                        <td>
                            {{ $doneNegotiation->negotiation->uuid ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doneNegotiation.fields.operator') }}
                        </th>
                        <td>
                            {{ $doneNegotiation->operator->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doneNegotiation.fields.charterer') }}
                        </th>
                        <td>
                            {{ $doneNegotiation->charterer->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doneNegotiation.fields.file') }}
                        </th>
                        <td>
                            @foreach($doneNegotiation->file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.done-negotiations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection