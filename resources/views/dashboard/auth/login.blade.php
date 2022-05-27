<!DOCTYPE html>
<html lang="en">
<head>
    <base href="../../../">
    <meta charset="utf-8"/>
    <title>{{__('title_page.broker')}} | {{__('title_page.login')}} </title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link href="{{asset('assets/css/pages/login/login-6.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/skins/brand/dark.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/skins/aside/dark.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="{{asset('images/app/logo/Logo_101_S.png')}}"/>
</head>
<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v6 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile d-flex justify-content-center">
            {{--<div class="kt-grid__item kt-grid__item--fluid kt-grid__item--center kt-grid kt-grid--ver kt-login__content"
                 style="background-image: url({{asset('imges/beach1.jpg')}});">
                <div class="kt-login__section">
                    <div class="kt-login__block">
--}}{{--                        <h1 class="text-light font-weight-bold" style="font-family: 'serif'"> Welcome To Rahty</h1>--}}{{--
                    </div>
                </div>
            </div>--}}
            <div class="kt-grid__item  kt-grid__item--order-tablet-and-mobile-2  kt-grid kt-grid--hor kt-login__aside">
                <div class="kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__body">
                            <div class="kt-login__logo">
                                <br>
                                <a href="#">
                                    <img class="" style="width: 300px;"
                                         src="{{asset("images/full-logo-blue.png")}}">
                                </a>
                            </div>
                            <div class="kt-login__signin">
                                <div class="">
                                    @include('includes.errors')
                                </div>

                                <div class="kt-login__form">
                                    <form class="kt-form" role="form" method="POST"
                                          action="{{route('login')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input style="text-align: left;" class="form-control " type="text"
                                                   placeholder="{{__('dashboard.auth.email')}}" name="email"
                                                   autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <input style="text-align: left;" class="form-control form-control-last" type="password"
                                                   placeholder="{{__('dashboard.placeholder.password')}}" name="password"
                                                   required>
                                        </div>
                                        <div class="kt-login__extra float-left">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="remember"> {{__('dashboard.button.remember_me')}}
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-login__actions" style="padding-top: 4rem;">
                                            <button type="submit" id="kt_login_signin_submit"
                                                    class="btn btn-primary btn-pill btn-elevate">{{__('dashboard.button.sign_in')}}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/pages/custom/login/login-general.js')}}" type="text/javascript"></script>
</body>
</html>
