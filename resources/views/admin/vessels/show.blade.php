@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.vessel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vessels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.id') }}
                        </th>
                        <td>
                            {{ $vessel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.user') }}
                        </th>
                        <td>
                            {{ $vessel->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.imo_number') }}
                        </th>
                        <td>
                            {{ $vessel->imo_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.vessel_name') }}
                        </th>
                        <td>
                            {{ $vessel->vessel_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.type') }}
                        </th>
                        <td>
                            {{ $vessel->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.call_sign') }}
                        </th>
                        <td>
                            {{ $vessel->call_sign }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.flag') }}
                        </th>
                        <td>
                            {{ $vessel->flag }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.year_of_built') }}
                        </th>
                        <td>
                            {{ $vessel->year_of_built }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.gross_tonnage') }}
                        </th>
                        <td>
                            {{ $vessel->gross_tonnage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.dead_weight') }}
                        </th>
                        <td>
                            {{ $vessel->dead_weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.length') }}
                        </th>
                        <td>
                            {{ $vessel->length }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.length_lbp') }}
                        </th>
                        <td>
                            {{ $vessel->length_lbp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.beam') }}
                        </th>
                        <td>
                            {{ $vessel->beam }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.net_tonnage') }}
                        </th>
                        <td>
                            {{ $vessel->net_tonnage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.height') }}
                        </th>
                        <td>
                            {{ $vessel->height }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.depth') }}
                        </th>
                        <td>
                            {{ $vessel->depth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.location') }}
                        </th>
                        <td>
                            {{ $vessel->location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.email') }}
                        </th>
                        <td>
                            {{ $vessel->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.hire_duration') }}
                        </th>
                        <td>
                            {{ $vessel->hire_duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.photo') }}
                        </th>
                        <td>
                            @if($vessel->photo)
                                <a href="{{ $vessel->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $vessel->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vessel.fields.photo_galley') }}
                        </th>
                        <td>
                            @foreach($vessel->photo_galley as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vessels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection