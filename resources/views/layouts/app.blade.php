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

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">

    @yield('style')

</head>
<body id="page-top" @yield('body')>

    <div id="app">
        @yield('content')
    </div>

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
    <script src="https://panel.wolontariat.rybnik.pl/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script>

      @yield('script')

</body>
</html>
