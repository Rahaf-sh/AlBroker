@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.vessel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("dashboard.vessels.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.vessel.fields.user') }}</label>
                <select class="form-control {{ $errors->has('user') ? 'is-invalid' : '' }}" name="operator_id" id="operator_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="imo_number">{{ trans('cruds.vessel.fields.imo_number') }}</label>
                <input class="form-control {{ $errors->has('imo_number') ? 'is-invalid' : '' }}" type="text" name="imo_number" id="imo_number" value="{{ old('imo_number', '') }}" required>
                @if($errors->has('imo_number'))
                    <span class="text-danger">{{ $errors->first('imo_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.imo_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.vessel.fields.vessel_name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.vessel_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.vessel.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type">{{ trans('cruds.vessel.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}">
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="call_sign">{{ trans('cruds.vessel.fields.call_sign') }}</label>
                <input class="form-control {{ $errors->has('call_sign') ? 'is-invalid' : '' }}" type="text" name="call_sign" id="call_sign" value="{{ old('call_sign', '') }}">
                @if($errors->has('call_sign'))
                    <span class="text-danger">{{ $errors->first('call_sign') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.call_sign_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="flag">{{ trans('cruds.vessel.fields.flag') }}</label>
                <input class="form-control {{ $errors->has('flag') ? 'is-invalid' : '' }}" type="text" name="flag" id="flag" value="{{ old('flag', '') }}">
                @if($errors->has('flag'))
                    <span class="text-danger">{{ $errors->first('flag') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.flag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="year_of_bulid">{{ trans('cruds.vessel.fields.year_of_bulid') }}</label>
                <input class="form-control {{ $errors->has('year_of_bulid') ? 'is-invalid' : '' }}" type="text" name="year_of_bulid" id="year_of_bulid" value="{{ old('year_of_bulid', '') }}">
                @if($errors->has('year_of_bulid'))
                    <span class="text-danger">{{ $errors->first('year_of_bulid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.year_of_built_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gross_tonnage">{{ trans('cruds.vessel.fields.gross_tonnage') }}</label>
                <input class="form-control {{ $errors->has('gross_tonnage') ? 'is-invalid' : '' }}" type="text" name="gross_tonnage" id="gross_tonnage" value="{{ old('gross_tonnage', '') }}">
                @if($errors->has('gross_tonnage'))
                    <span class="text-danger">{{ $errors->first('gross_tonnage') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.gross_tonnage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dead_weight">{{ trans('cruds.vessel.fields.dead_weight') }}</label>
                <input class="form-control {{ $errors->has('dead_weight') ? 'is-invalid' : '' }}" type="text" name="dead_weight" id="dead_weight" value="{{ old('dead_weight', '') }}">
                @if($errors->has('dead_weight'))
                    <span class="text-danger">{{ $errors->first('dead_weight') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.dead_weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="length">{{ trans('cruds.vessel.fields.length') }}</label>
                <input class="form-control {{ $errors->has('length') ? 'is-invalid' : '' }}" type="text" name="length" id="length" value="{{ old('length', '') }}">
                @if($errors->has('length'))
                    <span class="text-danger">{{ $errors->first('length') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.length_helper') }}</span>
            </div>
          
            <div class="form-group">
                <label for="beam">{{ trans('cruds.vessel.fields.beam') }}</label>
                <input class="form-control {{ $errors->has('beam') ? 'is-invalid' : '' }}" type="text" name="beam" id="beam" value="{{ old('beam', '') }}">
                @if($errors->has('beam'))
                    <span class="text-danger">{{ $errors->first('beam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.beam_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="net_tonnage">{{ trans('cruds.vessel.fields.net_tonnage') }}</label>
                <input class="form-control {{ $errors->has('net_tonnage') ? 'is-invalid' : '' }}" type="text" name="net_tonnage" id="net_tonnage" value="{{ old('net_tonnage', '') }}">
                @if($errors->has('net_tonnage'))
                    <span class="text-danger">{{ $errors->first('net_tonnage') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.net_tonnage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="height">{{ trans('cruds.vessel.fields.height') }}</label>
                <input class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}" type="text" name="height" id="height" value="{{ old('height', '') }}">
                @if($errors->has('height'))
                    <span class="text-danger">{{ $errors->first('height') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.height_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="depth">{{ trans('cruds.vessel.fields.depth') }}</label>
                <input class="form-control {{ $errors->has('depth') ? 'is-invalid' : '' }}" type="text" name="depth" id="depth" value="{{ old('depth', '') }}">
                @if($errors->has('depth'))
                    <span class="text-danger">{{ $errors->first('depth') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.depth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location">{{ trans('cruds.vessel.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', '') }}">
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.location_helper') }}</span>
            </div>
           
            <div class="form-group">
                <label for="hire_duration">{{ trans('cruds.vessel.fields.hire_duration') }}</label>
                <input class="form-control {{ $errors->has('hire_duration') ? 'is-invalid' : '' }}" type="text" name="hire_duration" id="hire_duration" value="{{ old('hire_duration', '') }}">
                @if($errors->has('hire_duration'))
                    <span class="text-danger">{{ $errors->first('hire_duration') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.hire_duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.vessel.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo_galley">{{ trans('cruds.vessel.fields.photo_galley') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo_galley') ? 'is-invalid' : '' }}" id="photo_galley-dropzone">
                </div>
                @if($errors->has('photo_galley'))
                    <span class="text-danger">{{ $errors->first('photo_galley') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.photo_galley_helper') }}</span>
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
