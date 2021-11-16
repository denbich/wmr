@extends('layouts.volunteer')

@section('title')
{{ __('volunteer.menu.dropdown.settings') }}
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
            <li class="nav-item">
                <a class="nav-link" href="{{ route('v.calendar') }}">
                    <i class="far fa-calendar text-primary"></i>
                    <span class="nav-link-text">{{ __('volunteer.sidebar.calendar') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="{{ route('v.settings') }}">
                    <i class="fas fa-cog text-primary"></i>
                    <span class="nav-link-text">{{ __('volunteer.menu.dropdown.settings') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('v.info') }}">
                    <i class="fas fa-info-circle text-primary"></i>
                    <span class="nav-link-text">{{ __('volunteer.sidebar.info') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt text-primary"></i>
                    <span class="nav-link-text">{{ __('main.logout') }}</span>
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
              <h6 class="h2 text-white d-inline-block mb-0">{{ __('volunteer.menu.dropdown.settings') }}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ __('volunteer.menu.dropdown.settings') }}</li>
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
                  <h5 class="h3 mb-0">{{ __('volunteer.menu.dropdown.settings') }}</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
                @if (session('change') == true)
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>{{ __('main.success') }}!</strong> {{ __('volunteer.settings.alert1') }}</span>
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
                                    <span class="alert-text"><strong>{{ __('main.error') }}!</strong> {{ __('volunteer.settings.err1') }}</span>
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
                            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-change-password">{{ __('volunteer.settings.change-pwd.title') }}</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-connections">{{ __('volunteer.settings.login.title') }}</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-notifications">{{ __('volunteer.settings.notifications') }}</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#rodo">{{ __('volunteer.settings.gdpr.title') }}</a>
                          </div>
                        </div>
                        <div class="col-lg-9">
                        <form method="post" action="{{ route('v.settings') }}">
                            @csrf
                          <div class="tab-content">

                            <div class="tab-pane fade active show" id="account-change-password">
                                <div class="card-body pb-2">

                                  <div class="form-group">
                                    <label class="form-label">{{ __('volunteer.settings.change-pwd.current') }}</label>
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
                                    <label class="form-label">{{ __('volunteer.settings.change-pwd.new') }}</label>
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
                                    <label class="form-label">{{ __('volunteer.settings.change-pwd.repeat') }}</label>
                                    <div class="input-group-alternative">
                                    <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                  </div>

                                </div>
                              </div>

                            <div class="tab-pane fade" id="account-connections">

                                <div class="card-body pb-2">
                                    <h4>{{ __('volunteer.settings.login.two-step') }}</h4>
                                    <a class="btn btn-danger text-white">{{ __('volunteer.settings.login.google') }}</a>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="account-notifications">
                              <div class="card-body pb-2">
                                <div class='onesignal-customlink-container'></div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="rodo">
                              <div class="card-body pb-2">
                                  <button class="btn btn-primary" href="" disabled>{{ __('volunteer.settings.gdpr.button') }}</button>
                                  </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="text-right mt-3">
                      <button type="submit" class="btn btn-primary">{{ __('volunteer.settings.save') }}</button>&nbsp;
                      </form>
                      <a href="{{ route('v.settings') }}" class="btn btn-danger">{{ __('main.cancel') }}</a>
                    </div>

                  </div>
            </div>
          </div>
      @include('volunteer.include.footer')
    </div>
  </div>

@endsection
