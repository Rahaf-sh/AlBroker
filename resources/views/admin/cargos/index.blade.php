@extends('layouts.admin')
@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('dashboard.cargos.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.cargo.title_singular') }}
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.cargo.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Cargo">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.cargo.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.cargo.fields.cargo_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.cargo.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.cargo.fields.landing_port_country') }}
                    </th>
                    <th>
                        {{ trans('cruds.cargo.fields.discharging_port_country') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
<script type="text/javascript">
$(function() {

    var table = $('.datatable-Cargo').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.cargos.index') }}",
        columns: [{
                data: 'placeholder',
                name: 'placeholder'
            },
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'cargo_type_name',
                name: 'cargo_type.name'
            },
            {
                data: 'quantity',
                name: 'quantity'
            },
            {
                data: 'landing_port_country',
                name: 'landing_port_country.name'
            },
            {
                data: 'discharging_port_country_name',
                name: 'discharging_port_country.name'
            },
            {
                data: 'actions',
                name: '{{ trans('global.actions ') }}'
            }
        ]
    });

});
</script>
@endsection