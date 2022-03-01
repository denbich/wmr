@extends('layouts.volunteer')

@section('title')
{{ __('volunteer.dashboard.title') }}
@endsection

@section('content')

<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <div class="sidenav-header mt-2 align-items-center w-100">
        <a class="mt-2" href="{{ route('v.dashboard') }}">
          <img src="/img/logo-wmr2.svg" class="h-100" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('v.dashboard') }}">
                <i class="ni ni-tv-2 "></i>
                <span class="nav-link-text">{{ __('volunteer.sidebar.dashboard') }}</span>
              </a>
            </li>
        </ul>
        <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">{{ __('volunteer.sidebar.general') }}</span>
        </h6>
          <ul class="navbar-nav">
            @include('volunteer.include.chat')
            @include('volunteer.include.posts')
            @include('volunteer.include.forms')
            @include('volunteer.include.prizes')

          </ul>

          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">{{ __('volunteer.sidebar.other') }}</span>
          </h6>

          <ul class="navbar-nav mb-md-3">
            @include('volunteer.include.other')
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="main-content" id="panel">

    @include('volunteer.include.nav')

    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">{{ __('volunteer.dashboard.title') }}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ __('volunteer.sidebar.dashboard') }}</li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="row" style="display: flex; flex-wrap: wrap;">
          <div class="col-xl-3 col-md-6 h-100">
            <div class="card card-stats bg-info">
              <div class="card-body my-3">
                <div class="row">
                  <div class="col">
                    <h3 class="card-title text-uppercase text-secondary mb-0 font-weight-900">{{ __('volunteer.dashboard.headerukraine') }}</h3>
                    <span class="h2 font-weight-bold mb-0"><a class="btn btn-primary mt-2" href="{{ route('v.form.show', [4]) }}">{{ __('volunteer.dashboard.textukraine') }}</a></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                        <i class="fas fa-hands-helping"></i>
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
                      <h5 class="card-title text-uppercase text-muted mb-0">{{ __('volunteer.dashboard.id') }}</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $volunteer->id }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
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
                      <h5 class="card-title text-uppercase text-muted mb-0">{{ __('volunteer.dashboard.points') }}</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $volunteer->points }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                        <i class="fas fa-star"></i>
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
                      <h5 class="card-title text-uppercase text-muted mb-0">{{ __('volunteer.dashboard.c-forms') }}</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $count['forms'] }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                        <i class="fas fa-clipboard-list"></i>
                      </div>
                    </div>
                  </div>
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
                  <h5 class="h3 mb-0">{{ __('volunteer.dashboard.posts.title') }}</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="chart overflow-auto">
                    @if (count($posts) > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th scope="col">{{ __('volunteer.dashboard.posts.post-title') }}</th>
                                        <th scope="col">{{ __('volunteer.dashboard.posts.date') }}</th>
                                        <th scope="col">{{ __('volunteer.dashboard.posts.options') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                        @foreach ($posts as $post)
                                        <tr>
                                            <td class="text-center">{{ $post->post_translate->title }}</td>
                                            <td class="text-center">{{ $post->created_at }}</td>
                                            <td class="text-center">
                                                <h4>
                                                    <a class="mx-1" href="{{ route('v.post', [$post->id]) }} "> <!--  -->
                                                        <i class="fas fa-search"></i>
                                                    </a>
                                                </h4>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="w-100 text-center"><h2 class="text-danger">{{ __('volunteer.dashboard.posts.err') }}</h2></div>
                    @endif
                </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">{{ __('volunteer.dashboard.events.title') }}</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="chart overflow-auto">
                @if (count($events) > 0)
                    <ul>
                        @foreach ($events as $event)
                        <li><a href="{{ route('v.form.show', [$event->form_id]) }}">{{ $event->title.": ".$event->start }}</a></li>
                        @endforeach
                    </ul>
                @else
                <div class="w-100 text-center"><h2 class="text-danger">{{ __('volunteer.dashboard.events.err') }}</h2></div>
                @endif
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
                  <h3 class="mb-0">{{ __('volunteer.dashboard.forms.title') }}</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ route('v.form.list') }}" class="btn btn-sm btn-primary">{{ __('volunteer.dashboard.forms.button') }}</a>
                </div>
              </div>
            </div>
            <div class="card-body">
                @forelse ($forms as $form)
                @if (date('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime($form->calendar->end . " + 2 days")))
                <div class="progress-wrapper pt-0">
                    <div class="progress-info">
                    <a href="{{ route('v.form.show', [$form->id]) }}"><span class="badge badge-lg badge-pill badge-primary mb-1">{{ $form->form_translate->title }}</span></a>
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
                @endif

                @empty
                    <h2 class="text-center text-danger">{{ __('volunteer.dashboard.forms.err') }}</h2>
                @endforelse
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">{{ __('volunteer.dashboard.notifications.title') }}</h3>
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
                    <h3 class="mb-0">{{ __('volunteer.dashboard.help.title') }}</h3>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                    src="/img/undraw_delivery_address_03n0.svg" alt="">
                  </div>
                <p>{{ __('volunteer.dashboard.help.text') }}
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

      @include('volunteer.include.footer')
    </div>
  </div>

@endsection

@section('style')
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "{{ env('ONESIGNAL_APP_ID') }}",
      safari_web_id: "{{ env('ONESIGNAL_SAFARI_WEB_ID') }}",
      notifyButton: {
        enable: true,
      },
    });
  });
</script>
@endsection
