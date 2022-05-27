@extends('master_layouts.app')

@section('content_head')
    @include('master_layouts.includes.menu_content_head',['title_page'=>__('title_page.'.$route)])
@endsection
@section('content')
    <div class="">
        @include('includes.errors')
    </div>
    <div class="">
        @include('includes.success')
    </div>
    <div class="col-12">
        <div class="card-header" style="">
            <div class="btn-group">
                <div class="card-toolbar row">
                    <a href="javascript:history.back()" class="btn btn-light-primary font-weight-bolder mr-2">
                        <i class="flaticon2-back icon-sm"></i>{{__('dashboard.button.back')}}</a>
                </div>
                <div class="card-toolbar ml-5 mr-5">
                    <a href="{{route('cargo_type.create')}}"
                       class="btn btn-primary font-weight-bolder font-weight-lighter ">
                        <i class="flaticon2-add-1 icon-sm"></i>{{__('dashboard.button.add')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                <div class="kt-portlet__body kt-portlet__body--fit ">
                    <div class=" row">
                        <div class="col-md-4 col-sm-12 mt-5 ">
                            <div id="kt_subheader_search mt-2">
                                <form id="kt_subheader_search_form">
                                    <div class="kt-input-icon kt-input-icon--left kt-subheader__search">
                                        <input type="text" class="form-control"
                                               placeholder="{{__('dashboard.placeholder.search')}}"
                                               id="generalSearch">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span>
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="kt-datatable overflow-auto" id="kt-datatable" width="100%">
                        <thead>
                        <tr>
                            {{-- name_ar --}}
                            <th class=" kt-datatable__cell--sort">
                                <span style="width: 200px !important"> {{__('dashboard.cargo_type.name_ar')}}</span>
                            </th>
                            {{-- name_en --}}
                            <th class=" kt-datatable__cell--sort">
                                <span style="width: 200px !important"> {{__('dashboard.cargo_type.name_en')}}</span>
                            </th>
                            {{-- Controls --}}
                            <th data-field="{{__('dashboard.button.controls')}}"
                                class="kt-datatable__cell kt-datatable__cell--sort">
                                <span
                                    style="width: 100px; text-align: center">{{__('dashboard.button.controls')}}</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr id="item{{$item->id}}">
                                {{--Name--}}
                                <td class="kt-datatable__cell">
                                    <div class="kt-user-card-v2">
                                        <div class="kt-user-card-v2__details">
                                                <span class="kt-user-card-v2__name" style="width: 150%;">
                                                    {{$item->name_ar}}
                                                </span>
                                        </div>
                                    </div>
                                </td>
                                {{--Name En--}}
                                <td class="kt-datatable__cell">
                                    <div class="kt-user-card-v2">
                                        <div class="kt-user-card-v2__details">
                                                <span class="kt-user-card-v2__name" style="width: 150%;">
                                                    {{$item->name_en}}
                                                </span>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align: center !important;">
                                    <div class="dropdown ">
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                           data-toggle="dropdown">
                                            <i class="flaticon-more-1"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                <li class="kt-nav__item">
                                                    <a class=" kt-nav__link" style="cursor: pointer "
                                                       href="{{route('cargo_type.show',$item->id)}}"
                                                       title="more info">
                                                        <i class="flaticon-eye kt-nav__link-icon inf"></i>
                                                        <span
                                                            class="kt-nav__link-text">{{__('dashboard.show')}}</span>
                                                    </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a class=" kt-nav__link" style="cursor: pointer "
                                                       href="{{route('cargo_type.edit',$item->id)}}"
                                                       title="edit">
                                                        <i class="kt-nav__link-icon flaticon-edit"></i>
                                                        <span
                                                            class="kt-nav__link-text">{{__('dashboard.button.edit')}}</span>
                                                    </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a class="userDeleteButton kt-nav__link"
                                                       style="cursor: pointer " onclick="deleteItem({{$item->id}})"
                                                       title="delete">
                                                        <i class=" kt-nav__link-icon flaticon-delete"></i>
                                                        <span
                                                            class="kt-nav__link-text">{{__('dashboard.button.delete')}}</span>
                                                    </a>

                                                    <form id="deleteForm" method="GET"
                                                          action=""></form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            if (window.location.href === {!! json_encode(url('/')) !!} + "/dashboard/{{$route}}" || window.location.href === {!! json_encode(url('/')) !!} + "/dashboard/{{$route}}/") {
                document.getElementById("{{$route}}Sidebar").className += " kt-menu__item--active";
                document.getElementById("{{$route}}SidebarParent").className += " kt-menu__item--open kt-menu__item--here";
            }
        });
    </script>
    <script src="{{asset('assets/js/user_table.js')}}"></script>
    <script src="{{asset('assets/js/pages/custom/user/edit-user.js')}}"></script>
@endsection

