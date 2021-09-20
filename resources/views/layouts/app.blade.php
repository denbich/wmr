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
  <script src="{{ asset('js/main.js') }}"></script>

  <!--<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth'
      });
      calendar.render();
    });

  </script>


  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "53874050-4d70-4fc0-8007-320a36fca218",
    });
  });

</script>-->

<style>
    .zdjecie-login{
    background: url("https://panel.wolontariat.rybnik.pl/assets/img/logo-wmr2.svg");
    background-position: center;
    background-repeat:no-repeat;
    background-size: contain;
    }
</style>

@yield('style')

</head>

<body @yield('body')>

    <div id="main">
        @yield('content')
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>

  <script src="../assets/js/argon.js?v=1.2.0"></script>

  @yield('script')

</body>
</html>
