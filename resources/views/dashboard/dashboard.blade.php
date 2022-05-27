@extends('master_layouts.app')

@section('content_head')
    @include('master_layouts.includes.menu_content_head',['title_page'=>__('title_page.broker')])
@endsection
@section('content')
    <div class="">
        @include('includes.errors')
    </div>
    <div class="">
        @include('includes.success')
    </div>

    <div class="kt-portlet span3 wow bounceInRight">
        <div class="kt-portlet__body">
            <div class="kt-widget kt-widget--user-profile-3">
                <div class="kt-widget__top">
                    <div class="kt-widget__content">
                        <div class="kt-widget__head d-flex">
                            <div class="kt-widget__info kt-padding-0 kt-margin-l-15">
                                <div class="kt-widget__media kt-widget__media--m">
                                <span class="kt-media kt-media--md kt-media--circle kt-hidden-">
                                    <img src="{{asset('assets/media/users/default.jpg')}}" alt="image">
                                </span>
                                </div>
                                <a href="#" class="kt-widget__title ml-3 mr-3 ">{{__('dashboard.statistics.hello')}}
                                    , {{auth()->user()->name}} </a>
                            </div>
                            <div class="kt-widget__action float-right">
                                <div class="kt-widget__item">
                                    <div class="kt-widget__label">
                                        <span
                                            class="btn btn-label-brand btn-sm btn-bold btn-upper">{{now()->format('d - F - Y')}}</span>
                                    </div>
                                </div>

                            </div>
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
            if (window.location.href === {!! json_encode(url('/')) !!} + '' || window.location.href === {!! json_encode(url('/')) !!} + '/') {
                document.getElementById('dashboardSidebarParent').className += " kt-menu__item--active";
            }
        });
    </script>
    @if(session()->has('showToastr'))
        <script !src="">$(document).ready(function () {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-bottom-left",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.success("You are logged in!", "Information");
            });
        </script>
        @php
            session()->remove('showToastr')
        @endphp
    @endif
@endsection
