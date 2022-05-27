@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.negotiation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.negotiations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="operator_id">{{ trans('cruds.negotiation.fields.operator') }}</label>
                <select class="form-control select2 {{ $errors->has('operator') ? 'is-invalid' : '' }}" name="operator_id" id="operator_id" required>
                    @foreach($operators as $id => $entry)
                        <option value="{{ $id }}" {{ old('operator_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('operator'))
                    <span class="text-danger">{{ $errors->first('operator') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.negotiation.fields.operator_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="charterer_id">{{ trans('cruds.negotiation.fields.charterer') }}</label>
                <select class="form-control select2 {{ $errors->has('charterer') ? 'is-invalid' : '' }}" name="charterer_id" id="charterer_id">
                    @foreach($charterers as $id => $entry)
                        <option value="{{ $id }}" {{ old('charterer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('charterer'))
                    <span class="text-danger">{{ $errors->first('charterer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.negotiation.fields.charterer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cargo_id">{{ trans('cruds.negotiation.fields.cargo') }}</label>
                <select class="form-control select2 {{ $errors->has('cargo') ? 'is-invalid' : '' }}" name="cargo_id" id="cargo_id">
                    @foreach($cargos as $id => $entry)
                        <option value="{{ $id }}" {{ old('cargo_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('cargo'))
                    <span class="text-danger">{{ $errors->first('cargo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.negotiation.fields.cargo_helper') }}</span>
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