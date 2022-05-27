@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.shipment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.shipments.update", [$shipment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="negotiation_id">{{ trans('cruds.shipment.fields.negotiation') }}</label>
                <select class="form-control select2 {{ $errors->has('negotiation') ? 'is-invalid' : '' }}" name="negotiation_id" id="negotiation_id" required>
                    @foreach($negotiations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('negotiation_id') ? old('negotiation_id') : $shipment->negotiation->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('negotiation'))
                    <span class="text-danger">{{ $errors->first('negotiation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.negotiation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.shipment.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $shipment->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cargo_id">{{ trans('cruds.shipment.fields.cargo') }}</label>
                <select class="form-control select2 {{ $errors->has('cargo') ? 'is-invalid' : '' }}" name="cargo_id" id="cargo_id" required>
                    @foreach($cargos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('cargo_id') ? old('cargo_id') : $shipment->cargo->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('cargo'))
                    <span class="text-danger">{{ $errors->first('cargo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.cargo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discharging_port_id">{{ trans('cruds.shipment.fields.discharging_port') }}</label>
                <select class="form-control select2 {{ $errors->has('discharging_port') ? 'is-invalid' : '' }}" name="discharging_port_id" id="discharging_port_id">
                    @foreach($discharging_ports as $id => $entry)
                        <option value="{{ $id }}" {{ (old('discharging_port_id') ? old('discharging_port_id') : $shipment->discharging_port->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('discharging_port'))
                    <span class="text-danger">{{ $errors->first('discharging_port') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.discharging_port_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_arrival_1">{{ trans('cruds.shipment.fields.date_of_arrival_1') }}</label>
                <input class="form-control date {{ $errors->has('date_of_arrival_1') ? 'is-invalid' : '' }}" type="text" name="date_of_arrival_1" id="date_of_arrival_1" value="{{ old('date_of_arrival_1', $shipment->date_of_arrival_1) }}">
                @if($errors->has('date_of_arrival_1'))
                    <span class="text-danger">{{ $errors->first('date_of_arrival_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.date_of_arrival_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_arrival_2">{{ trans('cruds.shipment.fields.date_of_arrival_2') }}</label>
                <input class="form-control date {{ $errors->has('date_of_arrival_2') ? 'is-invalid' : '' }}" type="text" name="date_of_arrival_2" id="date_of_arrival_2" value="{{ old('date_of_arrival_2', $shipment->date_of_arrival_2) }}">
                @if($errors->has('date_of_arrival_2'))
                    <span class="text-danger">{{ $errors->first('date_of_arrival_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.date_of_arrival_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="loading_rate_value">{{ trans('cruds.shipment.fields.loading_rate_value') }}</label>
                <input class="form-control {{ $errors->has('loading_rate_value') ? 'is-invalid' : '' }}" type="text" name="loading_rate_value" id="loading_rate_value" value="{{ old('loading_rate_value', $shipment->loading_rate_value) }}">
                @if($errors->has('loading_rate_value'))
                    <span class="text-danger">{{ $errors->first('loading_rate_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.loading_rate_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.shipment.fields.loading_rate_type') }}</label>
                @foreach(App\Models\Shipment::LOADING_RATE_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('loading_rate_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="loading_rate_type_{{ $key }}" name="loading_rate_type" value="{{ $key }}" {{ old('loading_rate_type', $shipment->loading_rate_type) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="loading_rate_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('loading_rate_type'))
                    <span class="text-danger">{{ $errors->first('loading_rate_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.loading_rate_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discharging_rate_value">{{ trans('cruds.shipment.fields.discharging_rate_value') }}</label>
                <input class="form-control {{ $errors->has('discharging_rate_value') ? 'is-invalid' : '' }}" type="text" name="discharging_rate_value" id="discharging_rate_value" value="{{ old('discharging_rate_value', $shipment->discharging_rate_value) }}">
                @if($errors->has('discharging_rate_value'))
                    <span class="text-danger">{{ $errors->first('discharging_rate_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.discharging_rate_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.shipment.fields.discharging_rate_type') }}</label>
                @foreach(App\Models\Shipment::DISCHARGING_RATE_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('discharging_rate_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="discharging_rate_type_{{ $key }}" name="discharging_rate_type" value="{{ $key }}" {{ old('discharging_rate_type', $shipment->discharging_rate_type) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="discharging_rate_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('discharging_rate_type'))
                    <span class="text-danger">{{ $errors->first('discharging_rate_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.discharging_rate_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="additional_cargo_details">{{ trans('cruds.shipment.fields.additional_cargo_details') }}</label>
                <textarea class="form-control {{ $errors->has('additional_cargo_details') ? 'is-invalid' : '' }}" name="additional_cargo_details" id="additional_cargo_details">{{ old('additional_cargo_details', $shipment->additional_cargo_details) }}</textarea>
                @if($errors->has('additional_cargo_details'))
                    <span class="text-danger">{{ $errors->first('additional_cargo_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.additional_cargo_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="special_requests">{{ trans('cruds.shipment.fields.special_requests') }}</label>
                <textarea class="form-control {{ $errors->has('special_requests') ? 'is-invalid' : '' }}" name="special_requests" id="special_requests">{{ old('special_requests', $shipment->special_requests) }}</textarea>
                @if($errors->has('special_requests'))
                    <span class="text-danger">{{ $errors->first('special_requests') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.special_requests_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="freight_idea">{{ trans('cruds.shipment.fields.freight_idea') }}</label>
                <input class="form-control {{ $errors->has('freight_idea') ? 'is-invalid' : '' }}" type="text" name="freight_idea" id="freight_idea" value="{{ old('freight_idea', $shipment->freight_idea) }}">
                @if($errors->has('freight_idea'))
                    <span class="text-danger">{{ $errors->first('freight_idea') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shipment.fields.freight_idea_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection