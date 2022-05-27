@extends('master_layouts.app')

@section('content_head')
    @include('master_layouts.includes.menu_content_head',['title_page'=>__('title_page.brands_management')])
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
                                  action="{{route('brand.store')}}">
                                @csrf
                                <div class="kt-form kt-form--label-right">
                                    <div class="kt-form__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">

                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-7 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">{{__('dashboard.brand.brand_info')}}
                                                            :</h3>
                                                    </div>
                                                    <label class="col-xl-2"></label>
                                                </div>
                                                {{--image--}}
                                                <div class="form-group row">
                                                    <label class="col-1"></label>
                                                    <label
                                                        class="col-xl-2 col-lg-2 col-form-label">{{__('dashboard.brand.image')}}</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-avatar kt-avatar--outline"  style="width: 250px !important;"
                                                             id="kt_user_edit_avatar">
                                                            <div class="kt-avatar__holder"
                                                                 style="background-image: url('{{asset('assets/media/company-logos/logo.png')}}');background-size: contain; ;background-size:cover;width: 250px !important"
                                                            ></div>
                                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip"
                                                                   title="" data-original-title="Change image">
                                                                <i class="fa fa-pen"></i>
                                                                <input type="file" name="image"
                                                                       accept=".png, .jpg, .jpeg">
                                                            </label>
                                                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip"
                                                                  title="" data-original-title="Cancel image">
																				<i class="fa fa-times"></i>
																			</span>
                                                        </div>
                                                    </div>
                                                    <label class="col-xl-2"></label>
                                                </div>
                                                {{--English Name--}}
                                                <div class="form-group row">
                                                    <label class="col-1"></label>
                                                    <label
                                                        class="col-xl-2 col-lg-2 col-form-label">{{__('dashboard.en_name')}}</label>
                                                    <div class="col-lg-6 col-xl-6">
                                                        <input required
                                                               placeholder="{{__('dashboard.brand.placeholder.name')}}"
                                                               name="name_en"
                                                               class="form-control" type="text" value="">
                                                    </div>
                                                    <label class="col-xl-3"></label>
                                                </div>
                                                {{--Arabic Name--}}
                                                <div class="form-group row">
                                                    <label class="col-1"></label>
                                                    <label
                                                        class="col-xl-2 col-lg-2 col-form-label">{{__('dashboard.ar_name')}}</label>
                                                    <div class="col-lg-6 col-xl-6">
                                                        <input required
                                                               placeholder="{{__('dashboard.brand.placeholder.name_ar')}}"
                                                               name="name_ar"
                                                               class="form-control" type="text" value="">
                                                    </div>
                                                    <label class="col-xl-3"></label>
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
                                                            <i class="ki ki-long-arrow-back icon-sm"></i>{{__('dashboard.back')}}
                                                        </a>
                                                        <button type="submit"
                                                                class="btn btn-label-brand btn-bold font-weight-bold ">
                                                            <i class="ki ki-check icon-sm"></i>{{__('dashboard.brand.add')}}
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
    <script src="{{asset('wjez/js/user_table.js')}}"></script>
    <script src="{{asset('assets/js/pages/custom/user/edit-user.js')}}"></script>
@endsection

