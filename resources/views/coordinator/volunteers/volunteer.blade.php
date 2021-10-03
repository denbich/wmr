@extends('layouts.app')

@section('title')
{{ __('Profil') }} {{ $volunteer->user->name }}
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
            @include('coordinator.include.dashboard')
        </ul>
        <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Ogólne</span>
        </h6>
          <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#volunteer" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="volunteer">
                  <i class="fas fa-user text-primary"></i>
                  <span class="nav-link-text">Wolontariusz</span>
                </a>
                <div class="collapse show" id="volunteer">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                      <a href="{{ route('c.v.search') }}" class="nav-link">
                        <span class="sidenav-normal"> Wyszukaj </span>
                      </a>
                    </li>
                    <li class="nav-item active">
                      <a href="{{ route('c.v.list') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('c.v.active') }}" class="nav-link">
                        <span class="sidenav-normal"> Aktywuj </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('c.v.birthday') }}" class="nav-link">
                        <span class="sidenav-normal"> Urodziny </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
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
              <h6 class="h2 text-white d-inline-block mb-0">{{ $volunteer->user->firstname }} {{ $volunteer->user->lastname }}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="{{ route('c.v.list') }}">Wolontariusz</a></li>
                  <li class="breadcrumb-item active">Profil</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral"><i class="fas fa-plus"></i> Nowy formularz</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->

    <div class="container-fluid mt--6">
        <div class="row">
          <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">
              <img src="/assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
              <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                  <div class="card-profile-image">
                    <a href="#">
                      <img src="{{ $volunteer->user->photo_src }}" class="rounded-circle">
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center">
                      <div>
                        <span class="heading">0</span>
                        <span class="description">Ilość akcji</span>
                      </div>
                      <div>
                        <span class="heading">{{ $volunteer->points }}</span>
                        <span class="description">Ilość punktów</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <h5 class="h3">
                    {{ $volunteer->user->firstname }} {{ $volunteer->user->lastname }}<span class="font-weight-light">, 16</span>
                  </h5>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i>{{ $volunteer->city }}, Polska
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-8 order-xl-1">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">Profil wolontariusza </h3>
                  </div>
                </div>
              </div>
              <div class="card-body">
                  <h6 class="heading-small text-muted mb-4">Podstawowe informacje</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label">Imię</label>
                            <p>{{ $volunteer->user->firstname }}</p>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label">Nazwisko</label>
                            <p>{{ $volunteer->user->lastname }}</p>
                          </div>
                        </div>
                      </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label">Numer telefonu</label>
                          <p>{{ $volunteer->user->telephone }}</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label">Adres email</label>
                          <p>{{ $volunteer->user->email }}</p>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label">Numer ICE</label>
                            <p>{{ $volunteer->ice }}</p>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label">Płeć</label>
                            <p>
                                @switch($volunteer->user->gender)
                                    @case('m')
                                    {{ "Mężczyzna" }}
                                        @break
                                    @case('f')
                                    {{ "Kobieta" }}
                                        @break

                                @endswitch
                            </p>
                          </div>
                        </div>
                      </div>

                  </div>
                  <hr class="my-4" />
                  <!-- Address -->
                  <h6 class="heading-small text-muted mb-4">Adres zamieszkania i szkoła</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Ulica i numer domu/mieszkania</label>
                            <p>{{ $volunteer->street }} {{ $volunteer->house_number }}</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Miasto</label>
                            <p>{{ $volunteer->city }}</p>
                        </div>
                      </div>
                    </div>
                    <label class="form-control-label">Szkoła</label>
                    <p>{{ $volunteer->school }}</p>
                  </div>
                  <hr class="my-4" />
                  <!-- Description -->
                  <h6 class="heading-small text-muted mb-4">O mnie</h6>
                  <div class="pl-lg-4">
                      <p>{{ $volunteer->description }}</p>
                  </div>
              </div>
            </div>
          </div>
        </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

@endsection

@section('script')
<script src="/assets/vendor/list.js/dist/list.min.js"></script>
@endsection

