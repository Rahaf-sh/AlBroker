<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- <li>
                    <select class="searchable-field form-control">

                    </select>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("dashboard.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
           
                    <li class="nav-item has-treeview">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-shield-alt">

                            </i>
                            <p>
                                {{ trans('cruds.shipmentManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                       
                                <li class="nav-item">
                                    <a href="{{ route("dashboard.negotiations.index") }}" class="nav-link">
                                        <i class="fa-fw nav-icon fas fa-american-sign-language-interpreting">

                                        </i>
                                        <p>
                                            {{ trans('cruds.negotiation.title') }}
                                        </p>
                                    </a>
                                </li>
                           
                    
                                <li class="nav-item">
                                    <a href="{{ route("dashboard.shipments.index") }}" class="nav-link">
                                        <i class="fa-fw nav-icon fas fa-shield-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.shipment.title') }}
                                        </p>
                                    </a>
                                </li>
                          
                                <li class="nav-item">
                                    <a href="{{ route("dashboard.done-negotiations.index") }}" class="nav-link">
                                        <i class="fa-fw nav-icon fas fa-check-double">

                                        </i>
                                        <p>
                                            {{ trans('cruds.doneNegotiation.title') }}
                                        </p>
                                    </a>
                                </li>
                         
                        </ul>
                    </li>
            
                    <li class="nav-item">
                        <a href="{{ route("dashboard.cargos.index") }}" class="nav-link">
                            <i class="fa-fw nav-icon fab fa-product-hunt">

                            </i>
                            <p>
                                {{ trans('cruds.cargo.title') }}
                            </p>
                        </a>
                    </li>
             
                    <li class="nav-item">
                        <a href="{{ route("dashboard.vessels.index") }}" class="nav-link">
                            <i class="fa-fw nav-icon fas fa-ship">

                            </i>
                            <p>
                                {{ trans('cruds.vessel.title') }}
                            </p>
                        </a>
                    </li>
            
                    <li class="nav-item has-treeview">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.groupsManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                           
                                <li class="nav-item">
                                    <a href="{{ route("dashboard.countries.index") }}" class="nav-link">
                                        <i class="fa-fw nav-icon fas fa-globe">

                                        </i>
                                        <p>
                                            {{ trans('cruds.country.title') }}
                                        </p>
                                    </a>
                                </li>
                          
                                <li class="nav-item">
                                    <a href="{{ route("dashboard.cities.index") }}" class="nav-link">
                                        <i class="fa-fw nav-icon fas fa-globe-africa">

                                        </i>
                                        <p>
                                            {{ trans('cruds.city.title') }}
                                        </p>
                                    </a>
                                </li>
                         
                                <li class="nav-item">
                                    <a href="{{ route("dashboard.cargo-types.index") }}" class="nav-link">
                                        <i class="fa-fw nav-icon fas fa-thumbtack">

                                        </i>
                                        <p>
                                            {{ trans('cruds.cargoType.title') }}
                                        </p>
                                    </a>
                                </li>
                          
                                <li class="nav-item">
                                    <a href="{{ route("dashboard.ports.index") }}" class="nav-link">
                                        <i class="fa-fw nav-icon fab fa-audible">

                                        </i>
                                        <p>
                                            {{ trans('cruds.port.title') }}
                                        </p>
                                    </a>
                                </li>
                           
                        </ul>
                    </li>
             
                    <li class="nav-item has-treeview">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route("dashboard.users.index") }}" class="nav-link">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                        </ul>
                    </li>
           
                    <li class="nav-item has-treeview">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-question">

                            </i>
                            <p>
                                {{ trans('cruds.faqManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route("dashboard.faq-categories.index") }}" class="nav-link">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                          
                                <li class="nav-item">
                                    <a href="{{ route("dashboard.faq-questions.index") }}" class="nav-link">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqQuestion.title') }}
                                        </p>
                                    </a>
                                </li>
                        </ul>
                    </li>
               
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                   
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>