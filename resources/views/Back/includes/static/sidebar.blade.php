<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{Route("home")}}" class="brand-link">
        <img src="{{asset("assets")}}/dist/img/alomasterLogo.svg" alt="Alo Master Logo"
             class="brand-image img-circle elevation-4">
        <span class="brand-text font-weight-light">Alo Master</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset("assets")}}/dist/img/alomasterLogo.svg" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Str::upper(Auth::user()->full_name)}}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item menu-open">
                    <span href="#" class="nav-link active">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            ANBAR ƏMƏLİYYATLARI
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </span>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{Route("stock-in.index")}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'stock-in.') ? 'active' : '' }}">
                                <i class="fas fa-arrow-circle-down"></i> <i class="fas fa-box-open"></i>
                                <p>
                                    Anbar Giriş
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{Route("stock-out.index")}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'stock-out.') ? 'active' : '' }}">
                                <i class="fas fa-arrow-circle-up"></i> <i class="fas fa-box-open"></i>
                                <p>
                                    Anbar Çıxış
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ Route::currentRouteName() === '#' ? 'active' : '' }}">

                                <i class="fas fa-calculator"> </i>
                                <p>
                                    Anbar Hesabatı
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ Route::currentRouteName() === '#' ? 'active' : '' }}">


                                <i class="fas fa-balance-scale"> </i>
                                <p>
                                    Mənfəət/Zərər
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{Route("categories.index")}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'categories.') ? 'active' : '' }}">
                                <i class="fas fa-tags"></i>
                                <p>
                                    Kategoria
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{Route("models.index")}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'models.') ? 'active' : '' }}">
                                <i class="fas fa-solid fa-robot"></i>
                                <p>
                                    Modellər
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{Route('products.index')}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'products.') ? 'active' : '' }}">
                                <i class="fas fa-cubes"></i>
                                <p>
                                    Mehsullar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{Route('warehouse.index')}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'warehouse.') ? 'active' : '' }}">
                                <i class="fas fa-warehouse"></i>
                                <p>
                                    Anbarlar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{Route('units.index')}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'units.') ? 'active' : '' }}">
                                <i class="fas fa-ruler-combined"></i>
                                <p>
                                    Vahid
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{Route('customers.index')}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'customers.') ? 'active' : '' }}">
                                <i class="fas fa-address-card"></i>
                                <p>
                                    Müştərilər
                                </p>
                            </a>
                        </li>
                        @role('Admin')
                        <li class="nav-item">
                            <a href="{{Route('suppliers.index')}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'suppliers.') ? 'active' : '' }}">
                                <i class="fas fa-truck"></i>
                                <p>
                                    Tədarükçülər
                                </p>
                            </a>
                        </li>
                        @endrole
                        <li class="nav-item">
                            <a href="{{Route('roles.index')}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'roles.') ? 'active' : '' }}">
                                <i class="fas fa-user-tag text-primary"></i>
                                <p>
                                    Role
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{Route('permissions.index')}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'permissions.') ? 'active' : '' }}">
                                <i class="fas fa-lock text-danger"></i>
                                <p>
                                    Səlahiyyətlər
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{Route('users.index')}}"
                               class="nav-link {{ Str::startsWith(Route::currentRouteName(),'users.') ? 'active' : '' }}">
                                <i class="fas fa-user"></i>
                                <p>
                                     İstifadəçilər
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <span class="nav-link active">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            SAYT ƏMƏLİYYATLARI
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </span>

                    <ul class="nav nav-treeview">
                        {{--                        <li class="nav-item ">--}}
                        {{--                            <a href="#" class="nav-link">--}}
                        {{--                                <i class="fas fa-arrow-circle-down"></i> <i class="fas fa-box-open"></i>--}}
                        {{--                                <p>--}}
                        {{--                                    Anbar Giriş--}}
                        {{--                                </p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="#" class="nav-link">--}}
                        {{--                                <i class="fas fa-arrow-circle-up"></i> <i class="fas fa-box-open"></i>--}}
                        {{--                                <p>--}}
                        {{--                                    Anbar Çıxış--}}
                        {{--                                </p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="#" class="nav-link">--}}

                        {{--                                <i class="fas fa-calculator"> </i>--}}
                        {{--                                <p>--}}
                        {{--                                    Anbar Hesabatı--}}
                        {{--                                </p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="#" class="nav-link">--}}


                        {{--                                <i class="fas fa-balance-scale"> </i>--}}
                        {{--                                <p>--}}
                        {{--                                    Mənfəət/Zərər--}}
                        {{--                                </p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="#" class="nav-link">--}}
                        {{--                                <i class="fas fa-tags"></i>--}}
                        {{--                                <p>--}}
                        {{--                                    Kategoria--}}
                        {{--                                </p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="#" class="nav-link">--}}
                        {{--                                <i class="fas fa-cubes"></i>--}}
                        {{--                                <p>--}}
                        {{--                                    Mehsullar--}}
                        {{--                                </p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="#" class="nav-link">--}}
                        {{--                                <i class="fas fa-barcode"></i>--}}
                        {{--                                <p>--}}
                        {{--                                    Mehsul Kodları--}}
                        {{--                                </p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
