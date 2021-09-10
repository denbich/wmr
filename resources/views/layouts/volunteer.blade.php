<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="isow polska">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">

    @yield('style')

</head>
<body id="page-top" @yield('body')>

    <body id="page-top">

        <div id="wrapper">

            @yield('sidebar')

            <div id="content-wrapper" class="d-flex flex-column">

                <div id="content">
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="{{ __('admin.main.navbar.search') }}"
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="{{ __('admin.main.navbar.search') }}" aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <span class="badge badge-danger badge-counter">0
                                    </span>
                                </a>
                                <div class="dropdown-list  dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header bg-primary" style="border: 0;">
                                        {{ __('admin.main.navbar.alerts_center') }}
                                    </h6>
                                        <a class="text-decoration-none" href="">
                                            <input type="hidden" name="alert_id" value="">
                                            <button class="dropdown-item d-flex align-items-center" type="submit">
                                                <div class="mr-3">
                                                    <div class="icon-circle ">
                                                        <i class="fas  text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="small text-gray-500"></div>
                                                    <span class=""></span>
                                                </div>
                                            </button>
                                        </a>

                                    <a class="dropdown-item text-center small text-gray-500" href="">{{ __('admin.main.navbar.s_aletrs') }}</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-envelope fa-fw"></i>
                                  <span class="badge badge-danger badge-counter">0
                                    </span>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in " aria-labelledby="messagesDropdown">
                                  <h6 class="dropdown-header bg-primary" style="border: 0;">
                                    {{ __('admin.main.navbar.messages_center') }}
                                  </h6>

                                    <form method='post' action=''>
                                        @csrf
                                        <input type='hidden' name='id' value=''>
                                        <button type='submit' class='dropdown-item d-flex align-items-center'>
                                            <div class='dropdown-list-image mr-3'>
                                                <img src="" alt="">
                                            </div>
                                                <div class='@if (0==0) {{ "font-weight-bold" }} @endif'>
                                                    <div class="small text-gray-500"></div>
                                                    <div class='text-gray-500' style="font-size: 80%"></div>
                                                    <div class='text-truncate'></div>
                                                </div>
                                        </button>
                                    </form>

                                  <a class="dropdown-item text-center small text-gray-500" href="">{{ __('admin.main.navbar.r_messages') }}</a>
                                </div>
                              </li>

                              <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-globe fa-fw"></i>
                                  <span class="badge badge-danger badge-counter text-uppercase">
                                    {{ session('locale') }}PL
                                  </span>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in " aria-labelledby="messagesDropdown">
                                  <h6 class="dropdown-header bg-primary" style="border: 0;">
                                    {{ __('admin.main.navbar.lang') }}
                                  </h6>
                                  <a href="/language/pl" class='dropdown-item d-flex align-items-center'>
                                    <div class='dropdown-list-image mr-3'>
                                        <img src="/img/165-poland.svg" alt="">
                                    </div>
                                        <div class="Large text-gray-500 font-weight-bold text-dark">Polish (Polski)</div>
                                    </a>

                                    <a href="/language/en" class='dropdown-item d-flex align-items-center'>
                                        <div class='dropdown-list-image mr-3'>
                                            <img src="/img/110-united%20kingdom.svg" alt="">
                                        </div>
                                            <div class="Large text-gray-500 text-dark">English</div>
                                    </a>

                                    <a href="/language/ua" class='dropdown-item d-flex align-items-center'>
                                        <div class='dropdown-list-image mr-3'>
                                            <img src="/img/198-ukraine.svg" alt="">
                                        </div>
                                            <div class="Large text-gray-500 text-dark">Ukrainian (Українська)</div>
                                    </a>

                                  <a class="dropdown-item text-center small text-gray-500" href="">{{ __('admin.main.navbar.more_lang') }}</a>
                                </div>
                              </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                                    <img class="img-profile rounded-circle" src="{{ Auth::user()->photo_src }}">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="">
                                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                      {{ __('admin.main.navbar.profile') }}
                                    </a>
                                    <a class="dropdown-item" href="">
                                      <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                      {{ __('admin.main.navbar.settings') }}
                                    </a>
                                </a>
                                <a class="dropdown-item" href="">
                                  <i class="fas fa-virus fa-sm fa-fw mr-2 text-gray-400"></i>
                                  COVID-19
                                </a>
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-info fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('admin.main.navbar.info') }}
                                  </a>
                                  <a class="dropdown-item" href="">
                                    <i class="fas fa-bell fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('admin.main.navbar.alerts') }}
                                  </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('admin.main.navbar.logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                  </div>
                            </li>
                        </ul>
                    </nav>

                    @yield('content')

                </div>

                <footer class="sticky-footer bg-white @yield('class')">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Denis Bichler for MOSiR Rybnik {{ date('Y') }}</span>
                        </div>
                    </div>
                </footer>

            </div>
        </div>



        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <div class="alert alert-dismissible text-center cookiealert" role="alert">
            <div class="cookiealert-container">
                <b>{{ __('index.cookies.text1') }}</b> &#x1F36A; {{ __('index.cookies.text2') }}

                <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
                    {{ __('index.cookies.btn-a') }}
                </button>
          <a href="#" target="_blank" style="text-decoration:none;" class="btn btn-primary btn-sm acceptcookies">{{ __('index.cookies.btn-p') }}</a>
            </div>
          </div>

      @yield('scripts')

    </body>

    <div class="alert alert-dismissible text-center cookiealert" role="alert">
        <div class="cookiealert-container">
            <b>{{ __('index.cookies.text1') }}</b> &#x1F36A; {{ __('index.cookies.text2') }}

            <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
                {{ __('index.cookies.btn-a') }}
            </button>
      <a href="#" target="_blank" style="text-decoration:none;" class="btn btn-primary btn-sm acceptcookies">{{ __('index.cookies.btn-p') }}</a>
        </div>
      </div>

    <script src="{{ URL::asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ URL::asset('js/cookie-alert.js') }}"></script>
    <script src="https://panel.wolontariat.rybnik.pl/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script>

      @yield('script')

</body>
</html>

