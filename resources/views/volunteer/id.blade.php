@extends('layouts.volunteer')

@section('title')
{{ __('volunteer.id.title') }}
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
                @include('volunteer.include.dashboard')
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
              <h6 class="h2 text-white d-inline-block mb-0">{{ __('volunteer.menu.dropdown.id') }}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="route('v.id')">{{ __('volunteer.menu.dropdown.id') }}</a></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->

    <div class="container-fluid mt--6">

        <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">{{ __('volunteer.menu.dropdown.id') }}</h5>
                </div>
              </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-6 align-content-center">
                        @php
                            $code = substr(Auth::user()->firstname, 0, 1).substr(Auth::user()->lastname, 0, 1).date('dm', strtotime(Auth::user()->created_at)).Auth::user()->gender.date('dm', strtotime(Auth::user()->agreement_date)).Auth::user()->id;
                        @endphp
                        <img class='w-75 align-content-center m-auto d-block' src='https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=https://wolontariat.rybnik.pl/volunteer-id/{{ $code }}'>
                    </div>
                    <div class="col-lg-6">
                        <div class="w-100">
                            <img class="align-content-center m-auto d-block w-100" style="max-height:250px; max-width:250px" src="{{ Auth::user()->photo_src }}">
                        </div>
                        <div>
                            <h3>{{ __('volunteer.id.data') }}:</h3>
                            <p><b>{{ __('volunteer.id.firstname') }}: </b>{{ Auth::user()->firstname }}</p>
                            <p><b>{{ __('volunteer.id.lastname') }}: </b>{{ Auth::user()->lastname }}</p>
                            <p><b>ID: </b>{{ Auth::user()->id }}</p>
                            <h3>{{ __('volunteer.id.today') }} <br> ({{ date('d-m-Y'); }}):</h3>
                            @php $i = 0 @endphp
                            @if (count($events) > 0)
                            <ul>
                                @foreach ($events as $event)
                                @if (date('Y-m-d') == date('Y-m-d', strtotime($event->start)) || date('Y-m-d') == date('Y-m-d', strtotime($event->end)))
                                    <li>{{ $event->title }}</li>
                                    @php $i++ @endphp
                                @endif
                                @endforeach
                            </ul>
                            @if ($i == 0)
                                <div class="w-100">
                                    <h3 class="text-danger">{{ __('volunteer.id.err') }}</h3>
                                </div>
                            @endif
                            @else
                            <div class="w-100">
                                <h3 class="text-danger">{{ __('volunteer.id.err') }}</h3>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
          </div>
      @include('volunteer.include.footer')
    </div>
  </div>

@endsection
