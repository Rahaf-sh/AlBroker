@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cargo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.cargos.store') }}" enctype="multipart/form-data">
            @csrf
            <div>

                <div class="form-group row">
                    <label class="required col-xl-2 col-lg-2 col-form-label"
                        for="user_id">{{ trans('cruds.vessel.fields.user') }}</label>
                    <select class="form-control col-lg-6 col-xl-6 {{ $errors->has('user') ? 'is-invalid' : '' }}"
                        name="charterer_id" id="charterer_id" required>
                        @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.vessel.fields.user_helper') }}</span>
                </div>

                <div class="form-group row">
                    <label class="required col-xl-2 col-lg-2 col-form-label"
                        for="cargo_type_id">{{ trans('cruds.cargo.fields.cargo_type') }}</label>
                    <select
                        class="form-control  col-lg-6 col-xl-6  {{ $errors->has('cargo_type') ? 'is-invalid' : '' }}"
                        name="cargo_type_id" id="cargo_type_id" required>
                        @foreach($cargo_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('cargo_type_id') == $id ? 'selected' : '' }}>{{ $entry }}
                        </option>
                        @endforeach
                    </select>
                    @if($errors->has('cargo_type'))
                    <span class="text-danger">{{ $errors->first('cargo_type') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.cargo.fields.cargo_type_helper') }}</span>
                </div>
                <h6 class="section-title">Quantity:</h6>
                <div class="form-group row">
                    <label class="col-1"></label>
                    <label class="col-xl-2 col-lg-2 col-form-label">Quantity</label>
                    <div class="col-lg-4 col-xl-4">
                        <input class="form-control{{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text"
                            name="quantity" id="quantity" value="{{ old('quantity', '') }}" required>
                        @if($errors->has('quantity'))
                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>
                    <div class="col-lg-5 col-xl-5">
                        <div class="form-check {{ $errors->has('quantity_unit') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="quantity_unit" name="quantity_unit"
                                value="MT" required>
                            <label class="form-check-label" for="quantity_unit" style="padding-right: 50px;">MT</label>
                            <input class="form-check-input" type="radio" id="quantity_unit" name="quantity_unit"
                                value="CM" required>
                            <label class="form-check-label" for="quantity_unit">CM</label>
                        </div>
                    </div>
                    <label class="col-xl-3"></label>
                </div>
                <h6 class="section-title">Stowage Factor:</h6>
                <div class="form-group row">
                    <label class="col-1"></label>
                    <label class="col-xl-2 col-lg-2 col-form-label">Stowage Factor</label>
                    <div class="col-lg-4 col-xl-4">
                        <input class="form-control{{ $errors->has('stowage_factor') ? 'is-invalid' : '' }}" type="text"
                            name="stowage_factor" id="stowage_factor" value="{{ old('stowage_factor', '') }}" required>
                        @if($errors->has('stowage_factor'))
                        <span class="text-danger">{{ $errors->first('stowage_factor') }}</span>
                        @endif
                    </div>
                    <div class="col-lg-5 col-xl-5">
                        <div class="form-check {{ $errors->has('quantity_type') ? 'is-invalid' : '' }}">
                        <label class="col-xl-4 col-lg-4 col-form-label">MT/CM</label>
                        </div>
                    </div>
                    <label class="col-xl-3"></label>
                </div>
            </div>
            <div class="card-footer-border">
                <h6 class="section-title">Loading Port:</h6>

                <div class="form-group row">
                    <label class="col-1"></label>
                    <label class="required col-xl-1 col-lg-1"
                        for="loading_port_country_id">{{ trans('cruds.cargo.fields.country') }}</label>
                    <select
                        class="form-control col-lg-4 col-xl-4 {{ $errors->has('loading_port_country') ? 'is-invalid' : '' }}"
                        name="landing_port_country_id" id="landing_port_country_id" required>
                        @foreach($loading_port_countries as $id => $entry)
                        <option value="{{ $id }}" {{ old('loading_port_country_id') == $id ? 'selected' : '' }}>
                            {{ $entry }}
                        </option>
                        @endforeach
                    </select>
                    @if($errors->has('loading_port_country'))
                    <span class="text-danger">{{ $errors->first('loading_port_country') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.cargo.fields.loading_port_country_helper') }}</span>
                    <label class="required col-xl-1 col-lg-1"
                        for="loading_port_country_id">{{ trans('cruds.cargo.fields.port') }}</label>
                    <input class="form-control col-lg-4 col-xl-4" type="text" id="landing_port_name" name="landing_port_name"
                        required>

                </div>

                <h6 class="section-title">Discharging Port:</h6>

                <div class="form-group row">
                    <label class="col-1"></label>
                    <label class="required col-xl-1 col-lg-1"
                        for="discharging_port_country_id">{{ trans('cruds.cargo.fields.country') }}</label>
                    <select
                        class="form-control col-lg-4 col-xl-4 {{ $errors->has('discharging_port_country') ? 'is-invalid' : '' }}"
                        name="discharging_port_country_id" id="discharging_port_country_id" required>
                        @foreach($discharging_port_countries as $id => $entry)
                        <option value="{{ $id }}" {{ old('discharging_port_country_id') == $id ? 'selected' : '' }}>
                            {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('discharging_port_country'))
                    <span class="text-danger">{{ $errors->first('discharging_port_country') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.cargo.fields.discharging_port_country_helper') }}</span>
                    <label class="required col-xl-1 col-lg-1"
                        for="discharging_port_country_id">{{ trans('cruds.cargo.fields.port') }}</label>
                    <input class="form-control col-lg-4 col-xl-4" type="text" id="discharging_port_name"
                        name="discharging_port_name" required>

                </div>
            </div>
            <div class="card-footer-border" >

                <h6 class="section-title">Lay Can:</h6>

                <div class="form-group row">
                    <label class="required col-xl-2 col-lg-2"
                        for="start_date">{{ trans('cruds.cargo.fields.start_date') }}</label>
                    <input
                        class="form-control date col-lg-4 col-xl-4 {{ $errors->has('lay_can_start_date') ? 'is-invalid' : '' }}"
                        type="text" name="lay_can_start_date" id="lay_can_start_date" value="{{ old('lay_can_start_date') }}" required>
                    @if($errors->has('lay_can_start_date'))
                    <span class="text-danger">{{ $errors->first('lay_can_start_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.cargo.fields.start_date_helper') }}</span>
                    <label class="required col-xl-2 col-lg-2"
                        for="canceling_date">{{ trans('cruds.cargo.fields.canceling_date') }}</label>
                    <input
                        class="form-control date col-lg-4 col-xl-4 {{ $errors->has('lay_can_canceling_date') ? 'is-invalid' : '' }}"
                        type="text" name="lay_can_canceling_date" id="lay_can_canceling_date" value="{{ old('lay_can_canceling_date') }}"
                        required>
                    @if($errors->has('lay_can_canceling_date'))
                    <span class="text-danger">{{ $errors->first('lay_can_canceling_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.cargo.fields.canceling_date_helper') }}</span>

                </div>
                <div class="form-group">
                    <div class="form-check {{ $errors->has('try_vessel_date') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="try_vessel_date" value="0">
                        <input class="form-check-input" type="checkbox" name="try_vessel_date" id="try_vessel_date"
                            value="1" {{ old('try_vessel_date', 0) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label"
                            for="try_vessel_date">{{ trans('cruds.cargo.fields.try_vessel_date') }}</label>
                    </div>
                    @if($errors->has('try_vessel_date'))
                    <span class="text-danger">{{ $errors->first('try_vessel_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.cargo.fields.try_vessel_date_helper') }}</span>
                </div>
            </div>
            <div class="card-footer-border">

                <h6 class="section-title">Loading Rate Value:</h6>
                <div class="form-group row">
                    <label class="col-1"></label>
                    <label class="col-xl-2 col-lg-2 col-form-label">Loading Rate Value</label>
                    <div class="col-lg-4 col-xl-4">
                        <input class="form-control{{ $errors->has('loading_rate') ? 'is-invalid' : '' }}"
                            type="text" name="loading_rate" id="loading_rate"
                            value="{{ old('loading_rate', '') }}" required>
                        @if($errors->has('loading_rate'))
                        <span class="text-danger">{{ $errors->first('loading_rate') }}</span>
                        @endif
                    </div>
                    <div class="col-lg-3 col-xl-3">
                        <div class="form-check {{ $errors->has('loading_rate_unit') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="loading_rate_unit"
                                name="loading_rate_unit" value="MT" required>
                            <label class="form-check-label" for="loading_rate_unit"
                                style="padding-right: 50px;">MT/DAY</label>
                            <input class="form-check-input" type="radio" id="loading_rate_unit"
                                name="loading_rate_unit" value="CM" required>
                            <label class="form-check-label" for="loading_rate_unit">CM/DAY</label>
                        </div>
                    </div>
                    <label class="col-xl-3"></label>
                </div>

                <h6 class="section-title">Discharging Rate Value:</h6>
                <div class="form-group row">
                    <label class="col-1"></label>
                    <label class="col-xl-2 col-lg-2 col-form-label">Discharging  Rate Value</label>
                    <div class="col-lg-4 col-xl-4">
                        <input class="form-control{{ $errors->has('discharging_rate') ? 'is-invalid' : '' }}"
                            type="text" name="discharging_rate" id="discharging_rate"
                            value="{{ old('discharging_rate', '') }}" required>
                        @if($errors->has('discharging_rate'))
                        <span class="text-danger">{{ $errors->first('discharging_rate') }}</span>
                        @endif
                    </div>
                    <div class="col-lg-3 col-xl-3">
                        <div class="form-check {{ $errors->has('discharging_unit') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="discharging_unit"
                                name="discharging_unit" value="MT" required>
                            <label class="form-check-label" for="discharging_unit"
                                style="padding-right: 50px;">MT/DAY</label>
                            <input class="form-check-input" type="radio" id="discharging_unit"
                                name="discharging_unit" value="CM" required>
                            <label class="form-check-label" for="discharging_unit">CM/DAY</label>
                        </div>
                    </div>
                    <label class="col-xl-3"></label>
                </div>

            </div>
            <div class="card-footer-border">

                <div class="form-group">
                    <label 
                        for="additional_cargo_details">{{ trans('cruds.cargo.fields.additional_cargo_details') }}</label>
                    <textarea class="form-control {{ $errors->has('additional_cargo_details') ? 'is-invalid' : '' }}"
                        name="additional_cargo_details" id="additional_cargo_details"
                        >{{ old('additional_cargo_details') }}</textarea>
                    @if($errors->has('additional_cargo_details'))
                    <span class="text-danger">{{ $errors->first('additional_cargo_details') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.cargo.fields.additional_cargo_details_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="special_requests">{{ trans('cruds.cargo.fields.special_requests') }}</label>
                    <textarea class="form-control {{ $errors->has('special_requests') ? 'is-invalid' : '' }}"
                        name="special_requests" id="special_requests">{{ old('special_requests') }}</textarea>
                    @if($errors->has('special_requests'))
                    <span class="text-danger">{{ $errors->first('special_requests') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.cargo.fields.special_requests_helper') }}</span>
                </div>
                <h6 class="section-title">Freight Idea:</h6>
                <div class="form-group row">
                    <label class="col-1"></label>
                    <label class="col-xl-2 col-lg-2 col-form-label">Freight Idea</label>
                    <div class="col-lg-3 col-xl-3">
                        <input class="form-control{{ $errors->has('fright_idea') ? 'is-invalid' : '' }}" type="text"
                            name="fright_idea" id="fright_idea" value="{{ old('fright_idea', '') }}" required>
                        @if($errors->has('fright_idea'))
                        <span class="text-danger">{{ $errors->first('fright_idea') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.cargo.fields.freight_idea_helper') }}</span>

                    </div>
                    <div class="col-lg-3 col-xl-3">
                        <div class="form-check {{ $errors->has('fright_idea_unit') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="fright_idea_unit" name="fright_idea_unit"
                                value="$" required>
                            <label class="form-check-label" for="fright_idea_unit"
                                style="padding-right: 50px;">$</label>
                            <input class="form-check-input" type="radio" id="fright_idea_unit" name="fright_idea_unit"
                                value="€" required>
                            <label class="form-check-label" for="fright_idea_unit">€</label>
                        </div>
                    </div>
                    <label class="col-xl-3"></label>
                </div>

                <!-- <div class="form-group">
                    <div class="form-check {{ $errors->has('operator_freight') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="operator_freight" value="0">
                        <input class="form-check-input" type="checkbox" name="operator_freight" id="operator_freight"
                            value="1" {{ old('operator_freight', 0) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label"
                            for="operator_freight">{{ trans('cruds.cargo.fields.operator_freight') }}</label>
                    </div>
                    @if($errors->has('operator_freight'))
                    <span class="text-danger">{{ $errors->first('operator_freight') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.cargo.fields.operator_freight_helper') }}</span>
                </div> -->
                <h6 class="section-title">Commission:</h6>
                <div class="form-group row">
                    <label class="col-1"></label>
                    <label class="col-xl-2 col-lg-2 col-form-label">Commission</label>
                    <div class="col-lg-3 col-xl-3">
                        <input class="form-control{{ $errors->has('address_commission') ? 'is-invalid' : '' }}" type="text"
                            name="address_commission" id="address_commission" value="{{ old('address_commission', '') }}" required>
                        @if($errors->has('address_commission'))
                        <span class="text-danger">{{ $errors->first('address_commission') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.cargo.fields.commission_helper') }}</span>

                    </div>
                    <div class="col-lg-3 col-xl-3">
                        <div class="form-check {{ $errors->has('commissio_type') ? 'is-invalid' : '' }}">
                            <label class="col-xl-2 col-lg-2 col-form-label">%</label>
                        </div>
                    </div>
                    <label class="col-xl-3"></label>
                </div>

            </div>
            <div class="card-footer-border">
                <div class="form-group row d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection