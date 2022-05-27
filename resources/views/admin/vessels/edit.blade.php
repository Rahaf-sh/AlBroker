@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.vessel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vessels.update", [$vessel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.vessel.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $vessel->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="imo_number">{{ trans('cruds.vessel.fields.imo_number') }}</label>
                <input class="form-control {{ $errors->has('imo_number') ? 'is-invalid' : '' }}" type="text" name="imo_number" id="imo_number" value="{{ old('imo_number', $vessel->imo_number) }}" required>
                @if($errors->has('imo_number'))
                    <span class="text-danger">{{ $errors->first('imo_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.imo_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="vessel_name">{{ trans('cruds.vessel.fields.vessel_name') }}</label>
                <input class="form-control {{ $errors->has('vessel_name') ? 'is-invalid' : '' }}" type="text" name="vessel_name" id="vessel_name" value="{{ old('vessel_name', $vessel->vessel_name) }}" required>
                @if($errors->has('vessel_name'))
                    <span class="text-danger">{{ $errors->first('vessel_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.vessel_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type">{{ trans('cruds.vessel.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', $vessel->type) }}">
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="call_sign">{{ trans('cruds.vessel.fields.call_sign') }}</label>
                <input class="form-control {{ $errors->has('call_sign') ? 'is-invalid' : '' }}" type="text" name="call_sign" id="call_sign" value="{{ old('call_sign', $vessel->call_sign) }}">
                @if($errors->has('call_sign'))
                    <span class="text-danger">{{ $errors->first('call_sign') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.call_sign_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="flag">{{ trans('cruds.vessel.fields.flag') }}</label>
                <input class="form-control {{ $errors->has('flag') ? 'is-invalid' : '' }}" type="text" name="flag" id="flag" value="{{ old('flag', $vessel->flag) }}">
                @if($errors->has('flag'))
                    <span class="text-danger">{{ $errors->first('flag') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.flag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="year_of_built">{{ trans('cruds.vessel.fields.year_of_built') }}</label>
                <input class="form-control {{ $errors->has('year_of_built') ? 'is-invalid' : '' }}" type="text" name="year_of_built" id="year_of_built" value="{{ old('year_of_built', $vessel->year_of_built) }}">
                @if($errors->has('year_of_built'))
                    <span class="text-danger">{{ $errors->first('year_of_built') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.year_of_built_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gross_tonnage">{{ trans('cruds.vessel.fields.gross_tonnage') }}</label>
                <input class="form-control {{ $errors->has('gross_tonnage') ? 'is-invalid' : '' }}" type="text" name="gross_tonnage" id="gross_tonnage" value="{{ old('gross_tonnage', $vessel->gross_tonnage) }}">
                @if($errors->has('gross_tonnage'))
                    <span class="text-danger">{{ $errors->first('gross_tonnage') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.gross_tonnage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dead_weight">{{ trans('cruds.vessel.fields.dead_weight') }}</label>
                <input class="form-control {{ $errors->has('dead_weight') ? 'is-invalid' : '' }}" type="text" name="dead_weight" id="dead_weight" value="{{ old('dead_weight', $vessel->dead_weight) }}">
                @if($errors->has('dead_weight'))
                    <span class="text-danger">{{ $errors->first('dead_weight') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.dead_weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="length">{{ trans('cruds.vessel.fields.length') }}</label>
                <input class="form-control {{ $errors->has('length') ? 'is-invalid' : '' }}" type="text" name="length" id="length" value="{{ old('length', $vessel->length) }}">
                @if($errors->has('length'))
                    <span class="text-danger">{{ $errors->first('length') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.length_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="length_lbp">{{ trans('cruds.vessel.fields.length_lbp') }}</label>
                <input class="form-control {{ $errors->has('length_lbp') ? 'is-invalid' : '' }}" type="text" name="length_lbp" id="length_lbp" value="{{ old('length_lbp', $vessel->length_lbp) }}">
                @if($errors->has('length_lbp'))
                    <span class="text-danger">{{ $errors->first('length_lbp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.length_lbp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="beam">{{ trans('cruds.vessel.fields.beam') }}</label>
                <input class="form-control {{ $errors->has('beam') ? 'is-invalid' : '' }}" type="text" name="beam" id="beam" value="{{ old('beam', $vessel->beam) }}">
                @if($errors->has('beam'))
                    <span class="text-danger">{{ $errors->first('beam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.beam_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="net_tonnage">{{ trans('cruds.vessel.fields.net_tonnage') }}</label>
                <input class="form-control {{ $errors->has('net_tonnage') ? 'is-invalid' : '' }}" type="text" name="net_tonnage" id="net_tonnage" value="{{ old('net_tonnage', $vessel->net_tonnage) }}">
                @if($errors->has('net_tonnage'))
                    <span class="text-danger">{{ $errors->first('net_tonnage') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.net_tonnage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="height">{{ trans('cruds.vessel.fields.height') }}</label>
                <input class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}" type="text" name="height" id="height" value="{{ old('height', $vessel->height) }}">
                @if($errors->has('height'))
                    <span class="text-danger">{{ $errors->first('height') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.height_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="depth">{{ trans('cruds.vessel.fields.depth') }}</label>
                <input class="form-control {{ $errors->has('depth') ? 'is-invalid' : '' }}" type="text" name="depth" id="depth" value="{{ old('depth', $vessel->depth) }}">
                @if($errors->has('depth'))
                    <span class="text-danger">{{ $errors->first('depth') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.depth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location">{{ trans('cruds.vessel.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', $vessel->location) }}">
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.vessel.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $vessel->email) }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vessel.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hire_duration">{{ trans('cruds.vessel.fields.hire_duration') }}</label>
                <input class="form-control {{ $errors->has('hire_duration') ? 'is-invalid' : '' }}" type="text" name="hire_duration" id="hire_duration" value="{{ old('hire_duration', $vessel->hire_duration) }}">
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.vessels.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($vessel) && $vessel->photo)
      var file = {!! json_encode($vessel->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    var uploadedPhotoGalleyMap = {}
Dropzone.options.photoGalleyDropzone = {
    url: '{{ route('admin.vessels.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photo_galley[]" value="' + response.name + '">')
      uploadedPhotoGalleyMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoGalleyMap[file.name]
      }
      $('form').find('input[name="photo_galley[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($vessel) && $vessel->photo_galley)
      var files = {!! json_encode($vessel->photo_galley) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo_galley[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection