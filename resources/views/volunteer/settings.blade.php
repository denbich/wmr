@extends('layouts.volunteer')

@section('title')
{{ __('Ustawienia') }}
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
            <li class="nav-item">
                <a class="nav-link" href="{{ route('v.calendar') }}">
                    <i class="far fa-calendar text-primary"></i>
                    <span class="nav-link-text">Kalendarz</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="{{ route('v.settings') }}">
                    <i class="fas fa-cog text-primary"></i>
                    <span class="nav-link-text">Ustawienia</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('v.info') }}">
                    <i class="fas fa-info-circle text-primary"></i>
                    <span class="nav-link-text">Informacje</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt text-primary"></i>
                    <span class="nav-link-text">Wyloguj się</span>
                </a>
            </li>

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
              <h6 class="h2 text-white d-inline-block mb-0">Ustawienia</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Ustawienia</li>
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
                  <h5 class="h3 mb-0">Ustawienia</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
                @if (session('change') == true)
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>Sukces!</strong> Zmiana hasła przebiegła pomyślnie!</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (session('password_err') == true)
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>Błąd!</strong> Stare hasło jest nieprawidłowe!</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                <div class="light-style flex-grow-1 container-p-y">

                    <div class=" overflow-hidden">
                      <div class="row no-gutters row-bordered row-border-light">
                        <div class="col-lg-3 pt-0">
                          <div class="list-group list-group-flush account-settings-links border-bottom">
                            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-change-password">Zmień hasło</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-connections">Logowanie</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-notifications">Powiadomienia</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#rodo">RODO</a>
                          </div>
                        </div>
                        <div class="col-lg-9">
                        <form method="post" action="{{ route('v.settings') }}">
                            @csrf
                          <div class="tab-content">

                            <div class="tab-pane fade active show" id="account-change-password">
                                <div class="card-body pb-2">

                                  <div class="form-group">
                                    <label class="form-label">Aktualne hasło</label>
                                    <div class="input-group-alternative">
                                    <input type="password" name="old_password" class="form-control">
                                    </div>
                                    @error('old_password')
                                      <span class="text-danger small" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                  </div>

                                  <div class="form-group">
                                    <label class="form-label">Nowe hasło</label>
                                    <div class="input-group-alternative">
                                    <input type="password" name="password" class="form-control">
                                    </div>
                                    @error('password')
                                      <span class="text-danger small" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                  </div>

                                  <div class="form-group">
                                    <label class="form-label">Powtórz nowe hasło</label>
                                    <div class="input-group-alternative">
                                    <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                  </div>

                                </div>
                              </div>

                            <div class="tab-pane fade" id="account-connections">

                                <div class="card-body pb-2">
                                    <h4>Logowanie dwupoziomowe - <b>Wkrótce!</b></h4>
                                    <a class="btn btn-danger text-white">Połącz konto z google - <b>Wkrótce!</b></a>
                                </div>



                            </div>
                            <div class="tab-pane fade" id="account-notifications">
                              <div class="card-body pb-2">
                                <div class='onesignal-customlink-container'></div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="rodo">
                              <div class="card-body pb-2">
                                  <a class="btn btn-primary" href="">Generuj raport twoich danych w PDF <i>Wkrótce!</i></a>
                                  </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="text-right mt-3">
                      <button type="submit" class="btn btn-primary">Zapisz zmiany</button>&nbsp;
                      </form>
                      <a href="/wolontariusz/d/ustawienia" class="btn btn-danger">Anuluj</a>
                    </div>

                  </div>
            </div>
          </div>
      @include('volunteer.include.footer')
    </div>
  </div>

@endsection
