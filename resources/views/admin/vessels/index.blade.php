@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('dashboard.vessels.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.vessel.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.vessel.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Vessel">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.vessel.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.vessel.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.vessel.fields.imo_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.vessel.fields.vessel_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.vessel.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.vessel.fields.flag') }}
                    </th>
                    <th>
                        {{ trans('cruds.vessel.fields.email') }}
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
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('dashboard.vessels.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_email', name: 'user.email' },
{ data: 'imo_number', name: 'imo_number' },
{ data: 'vessel_name', name: 'vessel_name' },
{ data: 'type', name: 'type' },
{ data: 'flag', name: 'flag' },
{ data: 'email', name: 'email' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Vessel').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection