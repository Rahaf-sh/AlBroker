@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('dashboard.cargo-types.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cargoType.title_singular') }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.cargoType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-cargoType">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.cargoType.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.cargoType.fields.name_en') }}
                    </th>
                    <th>
                        {{ trans('cruds.cargoType.fields.name_ar') }}
                    </th>
                    <th width="100px">Actions</th>

                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(function () {
    
    var table = $('.datatable-cargoType').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.cargo-types.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name_en', name: 'name_en'},
            {data: 'name_ar', name: 'name_ar'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endsection