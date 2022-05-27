@extends('master_layouts.app')

@section('content_head')
    @include('master_layouts.includes.menu_content_head',['title_page'=>__("title_page.$item->key")])
@endsection
@section('content')
    <div class="card card-custom card-sticky" id="kt_page_sticky_card">
        <div class="">
            @include('includes.errors')
        </div>
        <div class="">
            @include('includes.success')
        </div>
        <div class="card-header" style="">
            <div class="card-toolbar row">
                <div class="col-2"></div>
                <div class="col-8 d-flex justify-content-center">
                    <a href=""
                       class="btn btn-label-brand btn-bold font-weight-bold ">
                        <i class="flaticon2-edit icon-sm"></i>{{__('dashboard.button.edit')}}
                    </a>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">
                            <div class="kt-tinymce" style="color: #153758">

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            if (window.location.href === {!! json_encode(url('/')) !!} + "/dashboard/setting/ ") {
                document.getElementById("{{$item->key}}Sidebar").className += " kt-menu__item--active";
                document.getElementById('settingSidebarParent').className += " kt-menu__item--open kt-menu__item--here";

            }
        });
    </script>
    <script src="{{asset('assets/js/user_table.js')}}"></script>
    <script src="{{asset('assets/js/pages/custom/user/edit-user.js')}}"></script>
@endsection

