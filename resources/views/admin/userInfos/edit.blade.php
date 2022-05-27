@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userInfo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-infos.update", [$userInfo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.userInfo.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $userInfo->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userInfo.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="icc_imo">{{ trans('cruds.userInfo.fields.icc_imo') }}</label>
                <input class="form-control {{ $errors->has('icc_imo') ? 'is-invalid' : '' }}" type="text" name="icc_imo" id="icc_imo" value="{{ old('icc_imo', $userInfo->icc_imo) }}" required>
                @if($errors->has('icc_imo'))
                    <span class="text-danger">{{ $errors->first('icc_imo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userInfo.fields.icc_imo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nationality_id">{{ trans('cruds.userInfo.fields.nationality') }}</label>
                <select class="form-control select2 {{ $errors->has('nationality') ? 'is-invalid' : '' }}" name="nationality_id" id="nationality_id" required>
                    @foreach($nationalities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('nationality_id') ? old('nationality_id') : $userInfo->nationality->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nationality'))
                    <span class="text-danger">{{ $errors->first('nationality') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userInfo.fields.nationality_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.userInfo.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $userInfo->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userInfo.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.userInfo.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $userInfo->phone_number) }}" required>
                @if($errors->has('phone_number'))
                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userInfo.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mobile_number">{{ trans('cruds.userInfo.fields.mobile_number') }}</label>
                <input class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}" type="text" name="mobile_number" id="mobile_number" value="{{ old('mobile_number', $userInfo->mobile_number) }}" required>
                @if($errors->has('mobile_number'))
                    <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userInfo.fields.mobile_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.userInfo.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $userInfo->address) }}" required>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userInfo.fields.address_helper') }}</span>
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