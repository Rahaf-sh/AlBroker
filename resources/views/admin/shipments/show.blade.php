@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.shipment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shipments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.id') }}
                        </th>
                        <td>
                            {{ $shipment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.negotiation') }}
                        </th>
                        <td>
                            {{ $shipment->negotiation->uuid ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.user') }}
                        </th>
                        <td>
                            {{ $shipment->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.cargo') }}
                        </th>
                        <td>
                            {{ $shipment->cargo->quantity ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.discharging_port') }}
                        </th>
                        <td>
                            {{ $shipment->discharging_port->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.date_of_arrival_1') }}
                        </th>
                        <td>
                            {{ $shipment->date_of_arrival_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.date_of_arrival_2') }}
                        </th>
                        <td>
                            {{ $shipment->date_of_arrival_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.loading_rate_value') }}
                        </th>
                        <td>
                            {{ $shipment->loading_rate_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.loading_rate_type') }}
                        </th>
                        <td>
                            {{ App\Models\Shipment::LOADING_RATE_TYPE_RADIO[$shipment->loading_rate_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.discharging_rate_value') }}
                        </th>
                        <td>
                            {{ $shipment->discharging_rate_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.discharging_rate_type') }}
                        </th>
                        <td>
                            {{ App\Models\Shipment::DISCHARGING_RATE_TYPE_RADIO[$shipment->discharging_rate_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.additional_cargo_details') }}
                        </th>
                        <td>
                            {{ $shipment->additional_cargo_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.special_requests') }}
                        </th>
                        <td>
                            {{ $shipment->special_requests }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shipment.fields.freight_idea') }}
                        </th>
                        <td>
                            {{ $shipment->freight_idea }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shipments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection