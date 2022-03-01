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

  <link rel="stylesheet" href="/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/round-flag-icons/css/round-flag-icons.min.css">

  <link rel="stylesheet" href="{{ asset('css/calendar.css') }}" type="text/css">
  <script src="{{ asset('js/main.js') }}"></script>

<style>
    .zdjecie-login{
    background: url("https://panel.wolontariat.rybnik.pl/assets/img/logo-wmr2.svg");
    background-position: center;
    background-repeat:no-repeat;
    background-size: contain;
    }
</style>

<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{{ env('GOOGLE_ANALYTICS_KEY') }}');
  </script>

@yield('style')

</head>

<body @yield('body')>

    <div id="main">
        @yield('content')
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

    @include('coordinator.include.script')

  @yield('script')

</body>
</html>
