@extends('layouts.volunteer')

@section('title')
{{ __('volunteer.sidebar.info') }}
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
                @include('coordinator.include.dashboard')
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
                <a class="nav-link" href="{{ route('v.settings') }}">
                    <i class="fas fa-cog text-primary"></i>
                    <span class="nav-link-text">{{ __('volunteer.menu.dropdown.settings') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('v.info') }}">
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
              <h6 class="h2 text-white d-inline-block mb-0">{{ __('volunteer.sidebar.info') }}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ __('volunteer.sidebar.info') }}</li>
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
                  <h5 class="h3 mb-0">COVID-19</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
                <h2 class="text-danger">{{ __('volunteer.info.covid.text1') }}</h3>
                <h3>{{ __('volunteer.info.covid.text2') }}</h3>
            </div>
          </div>
      @include('volunteer.include.footer')
    </div>
  </div>

@endsection
