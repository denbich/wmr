@extends('layouts.coordinator')

@section('title')
{{ __('Panel koordynatora') }}
@endsection

@section('content')

<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <div class="sidenav-header mt-2 align-items-center w-100">
        <a class="mt-2" href="javascript:void(0)">
          <img src="https://panel.wolontariat.rybnik.pl/assets/img/logo-wmr2.svg" class="h-100" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('c.dashboard') }}">
                <i class="ni ni-tv-2 "></i>
                <span class="nav-link-text">Panel</span>
              </a>
            </li>
        </ul>
        <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Ogólne</span>
        </h6>
          <ul class="navbar-nav">
            @include('coordinator.include.volunteer')
            @include('coordinator.include.chat')
          </ul>
          <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Serwis</span>
        </h6>
          <ul class="navbar-nav">
            @include('coordinator.include.forms')
            @include('coordinator.include.prizes')
            @include('coordinator.include.posts')
          </ul>

          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Inne</span>
          </h6>

          <ul class="navbar-nav mb-md-3">
            @include('coordinator.include.other')
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="main-content" id="panel">

    @include('coordinator.include.nav')

    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Panel koordynatora</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Panel</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral"><i class="fas fa-plus"></i> Nowy formularz</a>
            </div>
          </div>
          <div class="row" style="display: flex;
          flex-wrap: wrap;">
            <div class="col-xl-3 col-md-6 h-100">
              <div class="card card-stats">
                <div class="card-body my-3">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Twoje ID</h5>
                      <span class="h2 font-weight-bold mb-0">{{ Auth::user()->id }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="fas fa-id-card-alt"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 h-100">
              <div class="card card-stats">
                <div class="card-body my-3">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Liczba wolontariuszy</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $count['volunteers'] }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm d-none">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ $count['volunteers_p'] }}</span>
                    <span class="text-nowrap">Od ostatniego miesiąca</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 h-100">
              <div class="card card-stats">
                <div class="card-body my-3">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Wolontariuszy do aktywowania</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $count['volunteers_active'] }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                        <i class="fas fa-user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 h-100">
              <div class="card card-stats">
                <div class="card-body my-3">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Nagrody</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $count['prizes'] }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="fas fa-award"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm d-none">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ $count['prizes_p'] }}</span>
                    <span class="text-nowrap">Od ostatniego miesiąca</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->

    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-8">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">Statystyki rejestracji (beta)</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="signinchart" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">Urodziny wolontariuszy</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="chart overflow-auto">
                  <ul>
                    @foreach ($volunteers as $volunteer)
                    @php
                    $v_birthday = date ('m-d', strtotime($volunteer->birth));
                    $uro0 = date('m-d');
                    $uro1 = date( 'm-d', strtotime( date( 'Y-m-d', strtotime( date( 'Y-m-d') .' +1 day'))));
                    $uro2 = date( 'm-d', strtotime( date( 'Y-m-d', strtotime( date( 'Y-m-d') .' +2 day'))));
                    $uro3 = date( 'm-d', strtotime( date( 'Y-m-d', strtotime( date( 'Y-m-d') .' +3 day'))));
                    $uro4 = date( 'm-d', strtotime( date( 'Y-m-d', strtotime( date( 'Y-m-d') .' +4 day'))));
                    $uro5 = date( 'm-d', strtotime( date( 'Y-m-d', strtotime( date( 'Y-m-d') .' +5 day'))));

                    if ($uro0 == $v_birthday)
                    {
                        $tekst_li = "ma <b class='cz'>dziś</b>";
                    } elseif ($uro1 == $v_birthday) {
                        $tekst_li = "ma<b class='gr'> jutro</b>";
                    }elseif ($uro2 == $v_birthday) {
                        $tekst_li = "ma za<b> 2 dni</b>";
                    }elseif ($uro3 == $v_birthday) {
                        $tekst_li = "ma za<b> 3 dni</b>";
                    }elseif ($uro4 == $v_birthday) {
                        $tekst_li = "ma za<b> 4 dni</b>";
                    }elseif ($uro5 == $v_birthday) {
                        $tekst_li = "ma za<b> 5 dni</b>";
                    }

                    if ($v_birthday >= $uro0 && $v_birthday <= $uro5)
                    {
                        echo "<li><p>".$volunteer->user->firstname." ".$volunteer->user->lastname." (".$volunteer->user->name.") ".$tekst_li." urodziny!</p></li>";
                    }
                    @endphp
                    @endforeach
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Zapełnienie formularzy</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ route('c.form.list') }}" class="btn btn-sm btn-primary">Zobacz formularze</a>
                </div>
              </div>
            </div>
            <div class="card-body">
                @forelse ($forms as $form)
                    <div class="progress-wrapper pt-0">
                        <div class="progress-info">
                        <a href="{{ route('c.form.show', [$form->id]) }}"><span class="badge badge-lg badge-pill badge-primary mb-1">{{ $form->form_translate->title }}</span></a>
                        @php
                            $p_count = 0;
                            foreach($form->formposition as $position)
                            {
                                $p_count = $p_count + $position->max_volunteer;
                            }
                        $a = count($form->signedform)/$p_count;
                        $b = $a * 100;
                        $c = ceil($b);

                        if ($c <= 25)
                        {
                            $class_bar = "bg-danger";

                        } else if ($c <= 55)
                        {
                            $class_bar = "bg-warning";

                        } else if ($c <= 99)
                        {
                            $class_bar = "bg-info";

                        } else if ($c >= 100)
                        {
                            $class_bar = "bg-success";
                        }
                        @endphp
                        <div class="progress-percentage">
                            <span>{{ $c }}%</span>
                        </div>
                        </div>
                        <div class="progress">
                        <div class="progress-bar {{ $class_bar }}" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $c }}%;"></div>
                        </div>
                    </div>
                @empty
                    <h2 class="text-center text-danger">Brak aktywnych formularzy!</h2>
                @endforelse
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Powiadomienia</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class='onesignal-customlink-container'></div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">Pomoc</h3>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                    src="https://panel.wolontariat.rybnik.pl/assets/img/undraw_delivery_address_03n0.svg" alt="">
                  </div>
                <p>Jeśli masz probem, propozycję bądź pytanie to śmiało pisz na adres:
                    <a target="_blank" rel="nofollow" href="mailto:administrator@wolontariat.rybnik.pl">administrator@wolontariat.rybnik.pl</a>
                </p>
                <!--<a target="_blank" rel="nofollow" href="#"><i class="far fa-question-circle"></i> Centrum pomocy</a>-->
              </div>
            </div>
          </div>
      </div>

      <div class="row">
        <div class="col-xl-6">

        </div>

      </div>

      @include('coordinator.include.footer')
    </div>
  </div>

@endsection

@section('script')
<script>

var timeFormat = 'MM/YYYY';

var config = {
    type:    'bar',
    data:    {
        datasets: [
            {
                label: "Liczba rejestracji",

                data: [
                    @foreach ($stats as $stat)
                    {x: "{{ date( 'm/Y', strtotime($stat->created_at)) }}", y: 100},
                    @endforeach
                ],
                fill: true,
                borderColor: 'red'
            },
        ]
    },
    options: {
        responsive: true,
        scales:     {
            xAxes: [{
                type:       "time",

                time:       {
                    unit: 'month',
                    format: timeFormat,
                    tooltipFormat: 'll'
                },
                scaleLabel: {
                    display:     true,
                    labelString: 'Date'
                }
            }],
            yAxes: [{
                scaleLabel: {
                    display:     true,
                    labelString: 'value'
                }
            }]
        }
    }
};

window.onload = function () {
    var ctx = document.getElementById("signinchart").getContext("2d");
    window.myLine = new Chart(ctx, config);
};
    </script>
@endsection

