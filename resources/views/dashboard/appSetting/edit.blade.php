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
        <div class="kt-portlet">
            <h3 class="kt-portlet__body">
                <form action="{{route('setting.update')}}" method="post">
                    @csrf
                    <div class="kt-tinymce">
                        <textarea id="setting" name="content" class="tox-target">
                            {{$item->content}}
                        </textarea>
                    </div>
                    <input type="hidden" name="key" value="{{$item->key}}">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8 d-flex justify-content-center">
                                <button type="submit"
                                        class="btn btn-label-brand btn-bold font-weight-bold ">
                                    <i class="ki ki-check icon-sm"></i>{{__('dashboard.button.save_change')}}
                                </button>
                                <a href="{{route('setting.index',$item->key)}}"
                                   class="btn btn-clean btn-bold">{{__('dashboard.button.cancel')}}</a>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>
                </form>
            </h3>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            if (window.location.href === {!! json_encode(url('/')) !!} + "/dashboard/setting/{{$item->key}}/edit") {
                document.getElementById("{{$item->key}}Sidebar").className += " kt-menu__item--active";
                document.getElementById('settingSidebarParent').className += " kt-menu__item--open kt-menu__item--here";

            }
        });
    </script>
    <script src="{{asset('wjez/js/user_table.js')}}"></script>
    <script src="{{asset('assets/js/pages/custom/user/edit-user.js')}}"></script>
    <script src="{{asset('assets/plugins/custom/tinymce/tinymce.bundle.js')}}" type="text/javascript"></script>
    <script !src>
        "use strict";
        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea#setting',
                height: '100%',
                menubar: false,

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor print preview ',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount',

                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat ' + 'anchor print preview',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });
        });
    </script>
@endsection

