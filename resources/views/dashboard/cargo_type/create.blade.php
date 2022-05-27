@extends('master_layouts.app')

@section('content_head')
    @include('master_layouts.includes.menu_content_head',['title_page'=>__('title_page.cargo_type')])
@endsection
@section('content')
    <div class="card card-custom card-sticky" id="kt_page_sticky_card">
        <div class="">
            @include('includes.errors')
        </div>
        <div class="">
            @include('includes.success')
        </div>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                            <form enctype="multipart/form-data" class="form" id="kt_form" method="POST"
                                  action="{{route('cargo_type.store')}}">
                                @csrf
                                <div class="kt-form kt-form--label-right">
                                    <div class="kt-form__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="form-group row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">{{__('dashboard.cargo_type.info')}}
                                                            :</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-1"></div>
                                                    <label
                                                        class="col-xl-2 col-lg-2 col-form-label">{{__('dashboard.cargo_type.name_en')}}</label>
                                                    <div class="col-lg-6 col-xl-6">
                                                        <input required
                                                               name="name_en"
                                                               class="form-control" type="text"
                                                               value="">
                                                    </div>
                                                    <label class="col-xl-3"></label>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-1"></div>
                                                    <label
                                                        class="col-xl-2 col-lg-2 col-form-label">{{__('dashboard.cargo_type.name_ar')}}</label>
                                                    <div class="col-lg-6 col-xl-6">
                                                        <input required
                                                               name="name_ar"
                                                               class="form-control" type="text"
                                                               value="">
                                                    </div>
                                                    <label class="col-xl-3"></label>
                                                </div>
                                                <div class="kt-section__body group">
                                                    <div class="form-group row">
                                                        <label class="col-xl-3"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-sm">{{__('dashboard.cargo_type_details.usd')}}
                                                                :</h3>
                                                        </div>
                                                    </div>
                                                    <div class=" row">
                                                        <label class="col-1"></label>
                                                        <label
                                                            class="col-xl-1 col-lg-1 col-form-label">{{__('dashboard.cargo_type_details.min')}}</label>
                                                        <div class="col-lg-3 col-xl-3">
                                                            <input required
                                                                   name="min_usd" onkeypress="return onlyNumberKey(event)"
                                                                   type="number"
                                                                   class="form-control" type="text"
                                                                   value="">
                                                        </div>
                                                        <label
                                                            class="col-xl-1 col-lg-1 col-form-label">{{__('dashboard.cargo_type_details.max')}}</label>
                                                        <div class="col-lg-3 col-xl-3">
                                                            <input required
                                                                   name="max_usd" onkeypress="return onlyNumberKey(event)"
                                                                   type="number"
                                                                   class="form-control" type="text"
                                                                   value="">
                                                        </div>
                                                        <label class="col-xl-3"></label>
                                                    </div>
                                                </div>
                                                <div class="kt-section__body group">
                                                    <div class="form-group row">
                                                        <label class="col-xl-3"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-sm">{{__('dashboard.cargo_type_details.euro')}}
                                                                :</h3>
                                                        </div>
                                                    </div>
                                                    <div class=" row">
                                                        <label class="col-1"></label>
                                                        <label
                                                            class="col-xl-1 col-lg-1 col-form-label">{{__('dashboard.cargo_type_details.min')}}</label>
                                                        <div class="col-lg-3 col-xl-3">
                                                            <input required
                                                                   name="min_euro" onkeypress="return onlyNumberKey(event)"
                                                                   type="number"
                                                                   class="form-control" type="text"
                                                                   value="">
                                                        </div>
                                                        <label
                                                            class="col-xl-1 col-lg-1 col-form-label">{{__('dashboard.cargo_type_details.max')}}</label>
                                                        <div class="col-lg-3 col-xl-3">
                                                            <input required
                                                                   name="max_euro" onkeypress="return onlyNumberKey(event)"
                                                                   type="number"
                                                                   class="form-control" type="text"
                                                                   value="">
                                                        </div>
                                                        <label class="col-xl-3"></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                                            <div class="kt-form__actions">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-xl-3"></div>
                                                    <div class="col-lg-6 col-xl-6">
                                                        <a href="javascript:history.back()"
                                                           class="btn btn-clean btn-bold">
                                                            <i class="ki ki-long-arrow-back icon-sm"></i>{{__('dashboard.button.back')}}
                                                        </a>
                                                        <button type="submit"
                                                                class="btn btn-label-brand btn-bold font-weight-bold ">
                                                            <i class="ki ki-check icon-sm"></i>{{__('dashboard.add')}}
                                                        </button>
                                                    </div>

                                                    <label class="col-xl-3"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
            if (window.location.href === {!! json_encode(url('/')) !!} + "/dashboard/{{$route}}/create" || window.location.href === {!! json_encode(url('/')) !!} + "/dashboard/{{$route}}/create/") {
                document.getElementById("{{$route}}AddSidebar").className += " kt-menu__item--active";
                document.getElementById("{{$route}}SidebarParent").className += " kt-menu__item--open kt-menu__item--here";
            }
        });

        function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
    </script>
    <script src="{{asset('assets/js/user_table.js')}}"></script>
    <script src="{{asset('assets/js/pages/custom/user/edit-user.js')}}"></script>
@endsection

