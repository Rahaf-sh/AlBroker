
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.cargoType.title_singular') }}
    </div>
    <form method="POST" action="{{ route('dashboard.cargo-types.update', [$cargoType->id]) }}" enctype="multipart/form-data">
    @method('PUT')
            @csrf
        <div class="card-body">
            <h6 class="section-title">Cargo Type info:</h6>
            <div class="cargo-info" style="margin: 0 auto;width:80%;">
                <div class="form-group row">
                    <label class="required col-xl-2 col-lg-2 col-form-label"
                        for="name_en">{{ trans('cruds.cargoType.fields.name_en') }}</label>
                    <input class="form-control col-lg-6 col-xl-6 {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                        type="text" name="name_en" id="name_en" value="{{$cargoType->name_en?$cargoType->name_en:''}}"
                        required>
                    @if($errors->has('name_en'))
                    <span class="text-danger">{{ $errors->first('name_en') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.cargoType.fields.name_helper') }}</span>
                </div>
                <div class="form-group row">
                    <label class="required col-xl-2 col-lg-2 col-form-label"
                        for="name_ar">{{ trans('cruds.cargoType.fields.name_ar') }}</label>
                    <input class="form-control col-lg-6 col-xl-6{{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                        type="text" name="name_ar" id="name_ar" value="{{$cargoType->name_ar?$cargoType->name_ar:''}}" required>
                    @if($errors->has('name_ar'))
                    <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.cargoType.fields.name_helper') }}</span>
                </div>
            </div>
            <h6 class="section-title">Usd:</h6>
            <div class="form-group row">
                <label class="col-1"></label>
                <label class="col-xl-1 col-lg-1 col-form-label">Min</label>
                <div class="col-lg-3 col-xl-3">
                    <input required="" name="min_usd" type="number" class="form-control" value="{{$cargoType->usd['min_']?$cargoType->usd['min_']:''}}">
                </div>
                <label class="col-xl-1 col-lg-1 col-form-label">Max</label>
                <div class="col-lg-3 col-xl-3">
                    <input required="" name="max_usd" type="number" class="form-control" value="{{$cargoType->usd['max_']?$cargoType->usd['max_']:''}}">
                </div>
                <label class="col-xl-3"></label>
            </div>
            <h6 class="section-title">Euro:</h6>
            <div class="form-group row">
                <label class="col-1"></label>
                <label class="col-xl-1 col-lg-1 col-form-label">Min</label>
                <div class="col-lg-3 col-xl-3">
                    <input required="" name="min_euro" type="number" class="form-control" value="{{$cargoType->euro['min_']?$cargoType->euro['min_']:''}}">
                </div>
                <label class="col-xl-1 col-lg-1 col-form-label">Max</label>
                <div class="col-lg-3 col-xl-3">
                    <input required="" name="max_euro" type="number" class="form-control" value="{{$cargoType->euro['max_']?$cargoType->euro['max_']:''}}">
                </div>
                <label class="col-xl-3"></label>
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