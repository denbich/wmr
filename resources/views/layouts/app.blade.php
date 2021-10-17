<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Internetowy System Obsługi Wolontariatu">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="author" content="Denis Bichler">

  <title>@yield('title') | WMR</title>

  <link rel="shortcut icon" href="https://mosir.rybnik.pl/typo3conf/ext/dqtemplate/Resources/Public/Icons/favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

  <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

  <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/round-flag-icons/css/round-flag-icons.min.css">

  <link rel="stylesheet" href="{{ asset('css/calendar.css') }}" type="text/css">
  <script src="/js/maps.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>


<style>
    .zdjecie-login{
    background: url("/img/logowmr.svg");
    background-position: center;
    background-repeat:no-repeat;
    background-size: contain;
    width: 100%;
    }
</style>

@yield('style')

</head>

<body @yield('body')>

    <div id="main">
        @yield('content')
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1Axw_0zQzlqetfe__sATl4CC_cd78B-0&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cABC" async defer></script>
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="/assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="/assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="/assets/js/argon.js"></script> <!-- ?v=1.2.0 -->



    @yield('script')

</body>
</html>
