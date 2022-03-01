@extends('layouts.volunteer')

@section('title')
{{ __('informacje') }}
@endsection

@section('content')

<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <div class="sidenav-header mt-2 align-items-center w-100">
        <a class="mt-2" href="javascript:void(0)">
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
            <span class="docs-normal">Ogólne</span>
        </h6>
          <ul class="navbar-nav">
            @include('volunteer.include.chat')
            @include('volunteer.include.posts')
            @include('volunteer.include.forms')
            @include('volunteer.include.prizes')

          </ul>

          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Inne</span>
          </h6>

          <ul class="navbar-nav mb-md-3">
            @include('volunteer.include.other')
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="main-content" id="panel">

    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" method="GET" action="{{ route('v.search') }}">
              <div class="form-group mb-0">
                <div class="input-group input-group-alternative input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                  </div>
                  <input class="form-control" placeholder="Szukaj" type="text" name="q" value="@isset($_GET['q']){!! $_GET['q'] !!}@endisset">
                </div>
              </div>
              <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </form>
            <ul class="navbar-nav align-items-center  ml-md-auto ">
              <li class="nav-item d-xl-none">
                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                  </div>
                </div>
              </li>
              <li class="nav-item d-sm-none">
                <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                  <i class="ni ni-zoom-split-in"></i>
                </a>
              </li>

              @include('include.lang')

              <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="ni ni-ungroup"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg  dropdown-menu-right  py-0 overflow-hidden">
                  <div class="w-100 text-center mt-2">
                      <span class="h4 text-center text-dark w-100">Skróty</span>
                  </div>
                  <div class="row shortcuts px-4 py-2">
                    <a href="{{ route('v.calendar') }}" class="col-4 my-2 shortcut-item text-center">
                      <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                      <small>Kalendarz</small>
                    </a>
                    <a href="{{ route('v.maps') }}" class="col-4 my-2 shortcut-item text-center">
                        <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <small>Mapa</small>
                      </a>
                    <a href="{{ route('v.chat') }}" class="col-4 my-2 shortcut-item text-center">
                      <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                        <i class="fas fa-comments"></i>
                      </span>
                      <small>Czat</small>
                    </a>
                  </div>
                </div>
              </li>
            </ul>
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
              <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                      <img alt="Image placeholder" src="{{ Auth::user()->photo_src }}">
                    </span>
                    <div class="media-body  ml-2  d-none d-lg-block">
                      <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right ">
                  <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Witaj!</h6>
                  </div>
                  <a href="{{ route('v.profile') }}" class="dropdown-item">
                    <i class="ni ni-single-02"></i>
                    <span>Profil</span>
                  </a>
                  <a href="{{ route('v.settings') }}" class="dropdown-item">
                    <i class="fas fa-cog"></i>
                    <span>Ustawienia</span>
                  </a>
                  <a href="{{ route('v.id') }}" class="dropdown-item">
                    <i class="fas fa-id-card"></i>
                    <span>Identyfikator</span>
                  </a>
                  <a href="{{ route('v.info') }}" class="dropdown-item">
                    <i class="fas fa-info-circle"></i>
                    <span>Informacje</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Wyloguj się</span>
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>


    <div class="header bg-primary pb-2">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Szukaj</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Szukaj</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->

    <div class="container-fluid mt--6">

        <div class="mt-7">
            <h1 class="w-100 text-center">Formularze</h1>
            <div class="row">
                @forelse ($forms as $form)
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4 h-100">
                                <a href="{{ route('v.form.show', [$form->id]) }}">
                                    <div class="card">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <img class="w-100 h-auto" src="{{ $form->icon_src }}" alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                        <h3 class="card-title text-primary mb-1">{{ $form->form_translate->title }}</h3>
                                        <h4>Data wygaśnięcia formularza: <br> {{ $form->expiration }}</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>

                @empty
                <h3 class="w-100 text-center text-danger">Brak formularzy</h3>
                @endforelse
            </div>
            <hr>

            <div class="d-none">
                <h1 class="w-100 text-center">Posty</h1>
            <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 h-100">
                        <a href="">
                            <div class="card">
                                <div class="card-body">
                                <h3 class="card-title text-primary"></h3>
                                <h5></h5>
                                <h4><b>Czytaj dalej...</b></h4>
                                <h4 class="text-muted">Autor: </h4>
                                <h4 class="text-muted"></h4>
                                </div>
                            </div>
                        </a>
                    </div>
            </div>
            <hr>
            </div>
            <h1 class="w-100 text-center">Nagrody</h1>
            <div class="row">
                @forelse ($prizes as $prize)
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4 h-100">
                                <a href="{{ route('v.prize', [$prize->id]) }}">
                                    <div class="card">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <img class="w-100 h-auto" src="{{ $prize->icon_src }}" alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                        <h3 class="card-title text-primary mb-1">{{ $prize->prize_translate->title }}</h3>
                                        <h4><i class="fas fa-star"></i> {{ $prize->points }}</h4>
                                        <h4>Dostępnych sztuk: {{ $prize->quantity }}</h4>
                                        <h4 class="text-muted">Kategoria: <i>{{ $prize->prize_translate->category }}</i></h4>
                                        </div>
                                    </div>
                                </a>
                            </div>

                @empty
                <h3 class="w-100 text-center text-danger">Brak nagród</h3>
                @endforelse
            </div>
            <hr>
        </div>

      @include('volunteer.include.footer')
    </div>
  </div>

@endsection
