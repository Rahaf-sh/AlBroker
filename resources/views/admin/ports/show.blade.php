@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.port.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('dashboard.ports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.port.fields.id') }}
                        </th>
                        <td>
                            {{ $port->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.port.fields.country') }}
                        </th>
                        <td>
                            {{ $port->country->name ?? '' }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            {{ trans('cruds.port.fields.name') }}
                        </th>
                        <td>
                            {{ $port->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
       
        </div>
    </div>
</div>



@endsection