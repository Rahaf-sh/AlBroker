@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.doneNegotiation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.done-negotiations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="negotiation_id">{{ trans('cruds.doneNegotiation.fields.negotiation') }}</label>
                <select class="form-control select2 {{ $errors->has('negotiation') ? 'is-invalid' : '' }}" name="negotiation_id" id="negotiation_id" required>
                    @foreach($negotiations as $id => $entry)
                        <option value="{{ $id }}" {{ old('negotiation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('negotiation'))
                    <span class="text-danger">{{ $errors->first('negotiation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.doneNegotiation.fields.negotiation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="operator_id">{{ trans('cruds.doneNegotiation.fields.operator') }}</label>
                <select class="form-control select2 {{ $errors->has('operator') ? 'is-invalid' : '' }}" name="operator_id" id="operator_id">
                    @foreach($operators as $id => $entry)
                        <option value="{{ $id }}" {{ old('operator_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('operator'))
                    <span class="text-danger">{{ $errors->first('operator') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.doneNegotiation.fields.operator_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="charterer_id">{{ trans('cruds.doneNegotiation.fields.charterer') }}</label>
                <select class="form-control select2 {{ $errors->has('charterer') ? 'is-invalid' : '' }}" name="charterer_id" id="charterer_id">
                    @foreach($charterers as $id => $entry)
                        <option value="{{ $id }}" {{ old('charterer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('charterer'))
                    <span class="text-danger">{{ $errors->first('charterer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.doneNegotiation.fields.charterer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file">{{ trans('cruds.doneNegotiation.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <span class="text-danger">{{ $errors->first('file') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.doneNegotiation.fields.file_helper') }}</span>
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
    var uploadedFileMap = {}
Dropzone.options.fileDropzone = {
    url: '{{ route('admin.done-negotiations.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">')
      uploadedFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileMap[file.name]
      }
      $('form').find('input[name="file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($doneNegotiation) && $doneNegotiation->file)
          var files =
            {!! json_encode($doneNegotiation->file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file[]" value="' + file.file_name + '">')
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