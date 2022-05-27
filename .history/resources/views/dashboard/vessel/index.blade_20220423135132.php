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
 

        <div class="kt-portlet">
            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                <div class="kt-portlet__body kt-portlet__body--fit ">
                    <div class="  row">
                        <div class="col-md-12 col-sm-12 mt-5 ">
                            <div id="kt_subheader_search">
                                <form id="kt_subheader_search_form">
                                    <div class="kt-input-icon kt-input-icon--left kt-subheader__search">
                                        <input type="text" class="form-control" placeholder="Search..."
                                               id="generalSearch">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
													<span>
														<svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                             height="24px" viewBox="0 0 24 24" version="1.1"
                                                             class="kt-svg-icon">
															<g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24"></rect>
																<path
                                                                    d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    opacity="0.3"></path>
																<path
                                                                    d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                                    fill="#000000" fill-rule="nonzero"></path>
															</g>
														</svg>
                                                        <!--<i class="flaticon2-search-1"></i>-->
													</span>
												</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                        <div class="kt-portlet__body kt-portlet__body--fit">

                            <table class="kt-datatable" id="kt-datatable" width="100%"></table>
                            {{-- <table class="kt-datatable" id="kt-datatable" width="100%">
                                <thead>
                                <tr>
                                    <th>{{__('dashboard.name')}}</th>

                                    <th style="width: 50%">{{__('dashboard.image')}}</th>

                                    <th>{{__('dashboard.controls')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $datum)
                                    <tr>
                                        <td style="text-align: center !important;">
                                            <div class="kt-user-card-v2 overflow-hidden">
                                                <div class="kt-user-card-v2__details">
                                                    <a class="kt-user-card-v2__name" href="#">
                                                    
                                                         
                                                            {{$datum->name}}
                                                     
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                        <td style="text-align: center !important;" style="width: 50%">

                                                @if(!is_null($datum->main_image))
                                                    <img width="75px" src="{{asset('storage/'.$datum->main_image)}}" alt="image"   data-toggle="popover-hover" data-img="{{storage_path($datum->main_image)}}">
                                                @else
                                                    <img width="75px" src="{{asset('images/full-logo-blue.png')}}" alt="image"  data-toggle="popover-hover" data-img="{{asset('assets/media/company-logos/logo.png')}}">
                                                @endif

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
                                                               href="{{route($route.'.edit',$datum->id)}}"
                                                               title="   ">

                                                                <i class="kt-nav__link-icon flaticon-edit"></i>
                                                                <span
                                                                    class="kt-nav__link-text">{{__('dashboard.edit')}}</span>
                                                            </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a id="delete_user" class=" kt-nav__link"
                                                               style="cursor: pointer "
                                                                                                                      href="{{route($route.'.destroy',$datum->id)}}"
                                                               title="   ">
                                                                <i class=" kt-nav__link-icon flaticon-delete"></i>
                                                                <span
                                                                    class="kt-nav__link-text">{{__('dashboard.delete')}}</span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                @endforeach
                            
                                </tbody>
                            </table> --}}
           
                        </div>
                      
                    </div>
                </div>
            </div>
  
            @endsection
            @section('js')
            <script !src="">
                "use strict";
                // Class definition
                let url ="{{request()->getSchemeAndHttpHost()}}/api/public/vessel/all";
                var KTDatatableRemoteAjaxDemo = function () {
                    // Private functions
        
                    // basic demo
                    var demo = function () {
        
                        var datatable = $('.kt-datatable').KTDatatable({
                            // datasource definition
                            data: {
                                type: 'remote',
                                source: {
                                    read: {
                                        url: url,
                                        // sample custom headers
                                        headers: {
                                            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                                        },
                                        method: 'get',
        
                                        map: function (raw) {
                                            // sample data mapping
                                            var dataSet = raw;
                                            console.log(raw);
                                            if (typeof raw.data !== 'undefined') {
                                                dataSet = raw.data;
                                            }
        
                                            return dataSet;
                                        },
                                    },
                                },
                                pageSize: 10,
                                serverPaging: true,
                                serverFiltering: true,
                                serverSorting: true,
                            },
        
        
                            // layout definition
                            layout: {
                                scroll: false,
                                footer: false,
                            },
        
                            // column sorting
                            sortable: true,
        
                            pagination: true,
        
                            search: {
                                input: $('#generalSearch'),
                                delay : 1000
                            },
        
                            // columns definition
                            columns: [
        
                                {
                                    field: 'image',
                                    title: 'Image',
                                    width:50,
                                    overflow: 'visible',
                                    autoHide: false,
                                    template: function (row)
                                    {
                                        return '<img class="" style=";width:60px;height: 60px" src=/storage/"'+row.main_image+'" id="'+row.id+'">' ;
                                    },
                                    width: 100
                                    },
        
        
                                {
        
        
                                    field: 'name',
                                    title: 'Name',
                                    width:100,
                                    overflow: 'visible',
                                    autoHide: false,
                                    template: function (row)
                                    {
                                        return '<span id="'+row.id+'">' + row.name  + '</span>';
                                    }},
                                {
        
                                    field: 'email',
                                    title: 'Email',
                                    width:200,
                                    overflow: 'visible',
                                    autoHide: false,
                                    template: function (row)
                                    {
                                        return '<span id="'+row.id+'">' + row.email + '</span>';
                                    }},
                                {
        
        
                                    field: 'status',
                                    title: 'Status',
                                    width:80,
                                    overflow: 'visible',
                                    autoHide: false,
                                    template: function (row)
                                    {
                                        if (row.status === 'active') {q
                                            return '<span class="kt-badge ' + 'kt-badge--brand'+ ' kt-badge--inline kt-badge--pill">' + row.status + '</span>';
        
                                        }
        
                                        if (row.status === 'pending') { 
                                            return '<span class="kt-badge ' + 'kt-badge--danger' + ' kt-badge--inline kt-badge--pill">' + row.status + '</span>';
        
                                        }


                                        return row.status;
        
                                    
                                      
                                       
        
        
        
                                      
        
                                      
                                    }},
    
                                {
        
                                    field: 'created_at',
                                    title: 'Creation Date',
                                    width:100,
                                    overflow: 'visible',
                                    autoHide: false,
                                    template: function (row)
                                    {
                                        return '<span id="create'+row.id+'">' + row.created_at.split(' ')[0] + '</span>';
                                    }},
                        
                                {
                                    field: 'Controls',
                                    title: '',
                                    sortable: false,
                                    width: 70,
                                    overflow: 'visible',
                                    autoHide: false,
                                    template: function (row) {
                                        console.log(row);
                                        var route = "/publisher/website/tags/" + row.id;
                                        var id_tag = row.id;
        
                             
                                          return '\
                                    \
                                    <a href="#" data-href="/reseller/publisher/'+row.id+'/websites"  class="btn btn-sm btn-clean btn-icon btn-icon-sm btn-view openInNewTap" data-id="'+row.id +'" title="View">\
                                        <i class="fa fa-eye"></i>\
                                    </a>\
                                    \
                                                <a href="#" data-href="/reseller/publisher/'+row.id+'/profile" data-id = "'+row.id+'"  class="btn btn-sm btn-clean btn-icon btn-icon-sm btn-edit openInNewTap"\
                                                  title="Edit">\
                                        <i class="fa fa-edit"></i>\
                                        </a>\
                                ';
                         
                                      
                                   
                                      
                                    },
                                    
                                }
                     
                            ],
        
                        });
                            //
                        $('#kt_form_status').on('change', function () {
        
                            datatable.search($(this).val().toLowerCase(), 'status');
                        });
                        $('#kt_form_name').on('change', function () {
        
                            datatable.search($(this).val().toLowerCase(), 'name');
                        });
        
                        $('#kt_form_status,#kt_form_name').selectpicker();
        
        
                       return {
                           reload : function () {
                               return datatable.reload();
                           }
                       }
        
                    };
        
                    return {
                        // public functions
                        init: function () {
                            demo();
                        },
                        reload: function () {
                            return demo().reload();
                        }
                    };
                }();
        
                jQuery(document).ready(function () {
                    KTDatatableRemoteAjaxDemo.init();
        
                    
                   
                    $(document).on('click','.suspendAccount',function () {
        
                     $('#target-account').val($(this).data('id'));
                     $('#userSusbend').modal('show');
                    });
                $(document).on('click','.resumeAccount',function () {
                     $('#target-account2').val($(this).data('id'));
                     $('#resumeUser').modal('show');
                    });
        
        
                    $('#kt_form_status,#kt_form_name').change(function () {
                        $('.kt-datatable').KTDatatable('reload');
                    });
                  
                     
        
        
        
        
                });
            </script>
           
                @endsection

