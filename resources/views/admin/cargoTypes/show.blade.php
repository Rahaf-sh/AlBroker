@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cargoType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('dashboard.cargo-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cargoType.fields.id') }}
                        </th>
                        <td>
                            {{ $cargoType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cargoType.fields.name_en') }}
                        </th>
                        <td>
                            {{ $cargoType->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cargoType.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $cargoType->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            USD 
                        </th>
                        <td>
                            [{{ $cargoType->usd['min_'] }} - {{ $cargoType->usd['max_'] }}]
                        </td>
                    </tr>
                    <tr>
                        <th>
                           EURO 
                        </th>
                        <td>
                       [{{ $cargoType->euro['min_'] }} - {{ $cargoType->euro['max_'] }}]

                        </td>
                    </tr>
                    
                  
                </tbody>
            </table>
           
        </div>
    </div>
</div>



@endsection