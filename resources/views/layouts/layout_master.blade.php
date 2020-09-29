    <!doctype html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <title>Үндэсний аюулгүй байдлын зөвлөл</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
            <meta content="Themesbrand" name="author" />
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <!-- App favicon -->
             <link rel="shortcut icon" href="{{url("public/images/uabz_icon.ico")}}">

             <link href="{{url("public/uaBCssJs/sweet-alert/sweetalert2.min.css")}}" id="bootstrap-dark" rel="stylesheet" type="text/css" />


            {{-- <link href="{{url("public/uaBCssJs/dist/sweetalert.css")}}" id="bootstrap-dark" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="{{url("public/uaBCssJs/dist/sweetalert.min.js")}}"></script>
            <script type="text/javascript" src="{{url("public/uaBCssJs/dist/sweetalert.js")}}"></script> --}}
            <!-- App css -->
            <link href="{{url("public/uaBCssJs/css/bootstrap-dark.min.css")}}" id="bootstrap-dark" rel="stylesheet" type="text/css" />
            <link href="{{url("public/uaBCssJs/css/bootstrap.min.css")}}" id="bootstrap-light" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="{{url("/public/uaBCssJs/css/icons.min.css")}}">
            <link href="{{url("public/uaBCssJs/css/app-rtl.min.css")}}" id="app-rtl" rel="stylesheet" type="text/css" disbaled="" />
            <link href="{{url("public/uaBCssJs/css/app-dark.min.css")}}" id="app-dark" rel="stylesheet" type="text/css" />
            <link href="{{url("public/uaBCssJs/css/app.min.css")}}" id="app-light" rel="stylesheet" type="text/css" />


            <!--Zagvarlag alert-->
            <link rel="stylesheet" href="{{ asset('public/z-alert/css/alertify.core.css') }}" />
            <link rel="stylesheet" href="{{ asset('public/z-alert/css/alertify.default.css') }}" />
            <script src="{{ asset('public/z-alert/js/alertify.min.js') }}"></script>
            <!--Zagvarlag alert-->
            @yield('css')

            <style media="screen">
              #headerID{
                background-image: url({{url("public/assets/images/bg_img.jpg")}});
                background-size: 100% 100%;
                background-repeat: no-repeat;
              }
            </style>


          </head>



        <body data-sidebar="dark">
                <div id="preloader">
            <div id="status">
                <div class="spinner-chase">
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                </div>
            </div>
        </div>
              <!-- Begin page -->
              <div id="layout-wrapper">
                <header id="page-topbar">
                    <div class="navbar-header" id="headerID">

                        <div class="d-flex">
                            <!-- LOGO -->
                            <div class="navbar-brand-box">
                                <a href="index" class="logo logo-dark">
                                    <span class="logo-sm">
                                      <img src="{{url("public/assets/images/logo.svg")}}" alt="" height="22">
                                    </span>
                                    <span class="logo-lg">
                                        <img src="{{url("public/assets/images/logo-dark.png")}}" alt="" height="30">
                                    </span>
                                </a>

                                <a href="index" class="logo logo-light">
                                    <span class="logo-sm">
                                        <img src="{{url("public/assets/images/logo-sm.png")}}" alt="" height="22">
                                    </span>
                                    <span class="logo-lg">
                                        <img src="{{url("public/assets/images/logo-light.png")}}" alt="" height="30">
                                    </span>
                                </a>
                            </div>
                            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </div>

                        <div class="d-flex">
                              <!-- App Search-->
                            <div class="dropdown d-none d-lg-inline-block">
                                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                    <i class="mdi mdi-fullscreen"></i>
                                </button>
                            </div>



                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="rounded-circle header-profile-user" src="{{url("public/assets/images/users/user-4.jpg")}}"
                                        alt="Header Avatar">
                                </button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i>
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                </div>
                            </div>
                            <div class="d-inline-block">
                              <button type="button" disabled class="btn header-item waves-effect">
                                  <h4>{{ Auth::user()->name }}</h4>
                                  {{-- <h4>davaanyam</h4> --}}
                              </button>
                            </div>

                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                    <i class="mdi mdi-settings-outline"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </header>            <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Үндсэн хэсэг</li>

                <li>
                    <a href="{{url("/mongolia/maps")}}" class="waves-effect">
                        <i class="ti-location-pin"></i>
                        {{-- <span class="badge badge-pill badge-primary float-right">2</span> --}}
                        <span>Монгол Улс</span>
                    </a>
                </li>
                <li>
                    <a href="{{url("/foodReserve")}}" class="waves-effect">
                        <i class="ti-package"></i>
                        {{-- <span class="badge badge-pill badge-primary float-right">2</span> --}}
                        <span>Хүнсний нөөц</span>
                    </a>
                </li>
                <li>
                    <a href="{{url("/reports")}}" class="waves-effect">
                        <i class="ti-bar-chart"></i>
                        {{-- <span class="badge badge-pill badge-primary float-right">2</span> --}}
                        <span>Тайлан</span>
                    </a>
                </li>

                <li class="menu-title">Бүртгэлийн хэсэг</li>

                <li>
                <a href="{{url("/survey/list")}}" >
                    <i class="dripicons-to-do"></i>
                    <span>Судалгаа</span>
                </a>

            </li>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ti-map-alt"></i>
                <span>Бүсчлэл</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{url("/sector/show")}}">Бүс</a></li>
                <li><a href="{{url("/province/show")}}">Аймаг</a></li>
                <li><a href="{{url("/sym/show")}}">Сум</a></li>
                <li><a href="{{url("/pop/show")}}">Хүн ам</a></li>
            </ul>
            </li>

            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ti-package"></i>
                <span>Мах</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{url("/cattle/show")}}">Малын төрөл</a></li>
                <li><a href="{{url("/cattleQntt/show")}}">Малын тоо толгой</a></li>
            </ul>
            </li>

            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ti-package"></i>
                <span>Хүнс</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{url("/foodProducts/show")}}">Гол нэрийн бүтээгдэхүүн</a></li>
                <li><a href="{{url("/subProducts/show")}}">Орлуулах хүнсний бүтээгдэхүүн</a></li>

            </ul>
            </li>

            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ti-pencil-alt"></i>
                <span>Төлөвлөгөө</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{url("/org/show")}}">Товчилсон нэрийн тайлбар</a></li>
                <li><a href="{{url("/axax/show")}}">Авч хэрэгжүүлэх арга хэмжээ</a></li>
            </ul>
            </li>

            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ti-widget"></i>
                <span>Туслах сан</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{url("/norm/show")}}">Хүнсний норм</a></li>
                <li><a href="{{url("/status/show")}}">Төлөв</a></li>
                <li><a href="{{url("/level/show")}}">Зэрэгүүд</a></li>
            </ul>
            </li>

            @if(Auth::user()->permission == 1)
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ti-user"></i>
                <span>Админ хэрэглэгч</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{url("/register")}}">Админ хэрэглэгч нэмэх</a></li>
                <li><a href="{{url("/show/users")}}">Админ хэрэглэгч засах</a></li>
            </ul>
            </li>
            @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    </div>
    <!-- Left Sidebar End -->            <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content">
                  <div class="page-content">
                    <div class="container-fluid">
                      @yield("content")
                    </div>
                  </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    © <script>document.write(new Date().getFullYear())</script> <span class="d-none d-sm-inline-block"> Зэвсэгт хүчний Программ хангамжын төв <i class="mdi text-danger">Лого</i></span>
                </div>
            </div>
        </div>
    </footer>            </div>
                <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <!-- Right Sidebar -->
            <div class="right-bar">
                <div data-simplebar class="h-100">
                    <div class="rightbar-title px-3 py-4">
                        <a href="javascript:void(0);" class="right-bar-toggle float-right">
                            <i class="mdi mdi-close noti-icon"></i>
                        </a>
                        <h5 class="m-0">Settings</h5>
                    </div>

                    <!-- Settings -->
                    <hr class="mt-0" />
                    <h6 class="text-center">Choose Layouts</h6>

                    <div class="p-4">
                        <div class="mb-2">
                            <img src="{{url("public/assets/images/layouts/layout-1.jpg")}}" class="img-fluid img-thumbnail" alt="">
                        </div>
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                            <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
                        </div>

                        <div class="mb-2">
                            <img src="{{url("public/assets/images/layouts/layout-2.jpg")}}" class="img-fluid img-thumbnail" alt="">
                        </div>
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css"
                                data-appStyle="{{url("public/uaBCssJs/css/app-dark.min.css")}}" />
                            <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
                        </div>

                        <div class="mb-2">
                            <img src="{{url("public/assets/images/layouts/layout-3.jpg")}}" class="img-fluid img-thumbnail" alt="">
                        </div>
                        <div class="custom-control custom-switch mb-5">
                            <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css" />
                            <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
                        </div>

                        <a href="https://1.envato.market/grNDB" class="btn btn-primary btn-block mt-3" target="_blank"><i class="mdi mdi-cart mr-1"></i> Purchase Now</a>

                    </div>

                </div> <!-- end slimscroll-menu-->
            </div>
            <!-- /Right-bar -->    <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        {{-- <!-- JAVASCRIPT --> --}}
            <script src="{{url("public/uaBCssJs/js/jquery.min.js")}}"></script>
            <script src="{{url("public/uaBCssJs/js/bootstrap.min.js")}}"></script>
            <script src="{{url("public/uaBCssJs/js/metismenu.min.js")}}"></script>
            <script src="{{url("public/uaBCssJs/js/simplebar.min.js")}}"></script>
            <script src="{{url("public/uaBCssJs/js/node-waves.min.js")}}"></script>

            <script src="{{url("public/uaBCssJs/sweet-alert/sweetalert2.min.js")}}"></script>
            <script src="{{url("public/uaBCssJs/sweet-alert/sweet-alerts.init.js")}}"></script>

            <script src="{{url("public/uaBCssJs/js/app.min.js")}}"></script>
              @yield('js')
        </body>
    </html>
