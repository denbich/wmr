@extends('layouts.app')

@section('title')
{{ __('profil') }}
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
              <a class="nav-link" href="{{ route('v.dashboard') }}">
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

    @include('volunteer.include.nav')

    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Profil wolontariusza</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
              </nav>
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
              <img src="../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
              <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                  <div class="card-profile-image">
                    <a href="#">
                      <img src="{{ Auth::user()->photo_src }}" class="rounded-circle">
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-between">
                  <a href="#" class="btn btn-sm btn-info mr-4 ">Połącz konta</a>
                </div>
              </div>
              <div class="card-body pt-0">
                <div class="text-center">
                  <h5 class="h3">
                    {{  Auth::user()->firstname}} {{ Auth::user()->lastname }}<span class="font-weight-light">, 16</span>
                  </h5>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i>{{ $volunteer->city }}, Polska
                  </div>
                  <div class="h5 mt-4">
                    <i class="ni business_briefcase-24 mr-2"></i>Wolontariusz
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
                    <h3 class="mb-0">Edytuj profil </h3>
                  </div>
                  <div class="col-4 text-right">
                    <a href="#!" class="btn btn-sm btn-primary">Ustawienia</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form method="POST" action="">
                    @csrf
                  <h6 class="heading-small text-muted mb-4">Podstawowe informacje</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Imię</label>
                            <input type="text" id="input-first-name" class="form-control" placeholder="First name" name="firstname" value="{{ Auth::user()->firstname }}">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-last-name">Nazwisko</label>
                            <input type="text" id="input-last-name" class="form-control" placeholder="Last name" name="lastname" value="{{ Auth::user()->lastname }}">
                          </div>
                        </div>
                      </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-telephone">Numer telefonu</label>
                          <input type="text" id="input-telephone" class="form-control" placeholder="telephone" name="telephone" value="{{ Auth::user()->telephone }}">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-email">Adres email</label>
                          <input type="email" id="input-email" class="form-control" placeholder="{{ Auth::user()->email }}">
                        </div>
                      </div>
                    </div>

                  </div>
                  <hr class="my-4" />
                  <!-- Address -->
                  <h6 class="heading-small text-muted mb-4">Adres zamieszkania</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-address">Ulica</label>
                          <input id="input-address" class="form-control" placeholder="Home Address" value="{{ $volunteer->street }}" type="text">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-country">Numer domu / mieszkania</label>
                          <input type="text" id="input-postal-code" class="form-control" value="{{ $volunteer->house_number }}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-city">Miasto</label>
                          <input type="text" id="input-city" class="form-control" placeholder="City" value="{{ $volunteer->city }}">
                        </div>
                      </div>

                    </div>
                  </div>
                  <hr class="my-4" />
                  <!-- Description -->
                  <h6 class="heading-small text-muted mb-4">O mnie</h6>
                  <div class="pl-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">O mnie</label>
                      <textarea rows="4" class="form-control" placeholder="A few words about you ...">

                      </textarea>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        @yield('volunteer.include.footer')
      </div>
  </div>

@endsection
