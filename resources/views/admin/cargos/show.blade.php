@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cargo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('dashboard.cargos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.id') }}
                        </th>
                        <td>
                            {{ $cargo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.user') }}
                        </th>
                        <td>
                            {{ $cargo->charter['email'] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.cargo_type') }}
                        </th>
                        <td>
                            {{ $cargo->cargo_type['name_en'] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.quantity') }}
                        </th>
                        <td>
                            {{ $cargo->quantity }} {{$cargo->quantity_unit}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.stowage_factor') }}
                        </th>
                        <td>
                            {{ $cargo->stowage_factor }} MT/CM
                        </td>
                    </tr>
                 
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.landing_port_country') }}
                        </th>
                        <td>
                            {{ $cargo->landing_port_country['name'] ?? '' }}
                        </td>
                    </tr>
                    
                
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.discharging_port_country') }}
                        </th>
                        <td>
                            {{ $cargo->discharging_port_country['name'] ?? '' }}
                        </td>
                    </tr>
                   
                   
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.start_date') }}
                        </th>
                        <td>
                            {{ $cargo->lay_can_start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.canceling_date') }}
                        </th>
                        <td>
                            {{ $cargo->lay_can_canceling_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.try_vessel_date') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $cargo->try_vessel_date ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.loading_rate_value') }}
                        </th>
                        <td>
                            {{ $cargo->loading_rate }} {{$cargo->loading_rate_unit}}/DAY
                        </td>
                    </tr>
                  
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.discharging_rate_value') }}
                        </th>
                        <td>
                            {{ $cargo->discharging_rate }} {{$cargo->discharging_unit}}/DAY
                        </td>
                    </tr>
                   
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.additional_cargo_details') }}
                        </th>
                        <td>
                            {{ $cargo->additional_cargo_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.special_requests') }}
                        </th>
                        <td>
                            {{ $cargo->special_requests }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.freight_idea') }}
                        </th>
                        <td>
                            {{ $cargo->fright_idea }}    {{ $cargo->fright_idea_unit }}
                        </td>
                    </tr>
                    <!-- <tr>
                         <th>
                            {{ trans('cruds.cargo.fields.operator_freight') }}
                        </th> 
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $cargo->operator_freight ? 'checked' : '' }}>
                        </td> 
                    </tr> -->
                    <tr>
                        <th>
                            {{ trans('cruds.cargo.fields.commission') }}
                        </th>
                        <td>
                            {{ $cargo->address_commission }} %
                        </td>
                    </tr>
                </tbody>
            </table>
           
        </div>
    </div>
</div>



@endsection