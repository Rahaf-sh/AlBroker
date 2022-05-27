<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu"
             class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
        </div>
    </div>

    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        <!--begin: Language bar -->
    
    <div class="kt-header__topbar-item kt-header__topbar-item--langs">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                <span class="kt-header__topbar-icon">
                                        <img class="" src="{{asset('assets/media/flags/226-united-states.svg')}}"
                                             alt=""/>
                                </span>
        </div>


        <div
            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
            <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">

                <form method="post" id="changeLangToArabic" action="">
                    @csrf
                    <li class="kt-nav__item">
                        <a href="#" onclick="switchLang('changeLangToEnglish');" class="kt-nav__link">
                                    <span class="kt-nav__link-icon"><img
                                            src="{{asset('assets/media/flags/226-united-states.svg')}}"
                                            alt=""/></span>
                                            <span class="kt-nav__link-text">__('dashboard.lang.english')</span>
                                        </a>
                    </li>

                    <li class="kt-nav__item">
                        <a href="#" onclick="switchLang('changeLangToArabic');" class="kt-nav__link">
                                    <span class="kt-nav__link-icon"><img
                                            src="{{asset('assets/media/flags/226-united-states.svg')}}"
                                            alt=""/></span>
                            <span class="kt-nav__link-text">__('dashboard.lang.arabic')</span>
                        </a>
                    </li>

                    <input type="text" value="ar" name="lang_name" hidden>
                </form>
            </ul>
        </div>

    </div>

    <!--end: Language bar -->

        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{auth()->user()->name}}</span>

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span
                        class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"><a
                            class="flaticon2-settings"></a></span>
                </div>
            </div>
            <div
                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                     style="background-image: url({{asset('assets/media/bg/450.jpg')}})">

                    <div class="kt-user-card__name font-weight-bold">
                        {{auth()->user()->name}}
                    </div>

                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">

                    <div class="kt-notification__custom kt-space-between">
                        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           target="_blank"
                           class="btn btn-label btn-label-brand btn-sm btn-bold">{{__('title_page.sign_out')}}</a>

                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                        @csrf
                    </form>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>
