@extends('layouts.app')

@section('title')
{{ __('volunteer.prizes.list.title') }}
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

            <li class="nav-item">
                <a class="nav-link collapsed active" href="#prizes" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="prizes">
                  <i class="fas fa-award text-primary"></i>
                  <span class="nav-link-text">{{ __('volunteer.sidebar.prizes.prizes') }}</span>
                </a>
                <div class="collapse show" id="prizes">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item active">
                      <a href="{{ route('v.prize.list') }}" class="nav-link">
                        <span class="sidenav-normal"> {{ __('volunteer.sidebar.prizes.list') }} </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('v.prize.orders') }}" class="nav-link">
                        <span class="sidenav-normal"> {{ __('volunteer.sidebar.prizes.orders') }} </span>
                      </a>
                    </li>
                  </ul>
                </div>
            </li>
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
                <h6 class="h2 text-white d-inline-block mb-0">{{ __('volunteer.prizes.list.title') }}</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ __('volunteer.prizes.list.title') }}</li>
                    <li class="breadcrumb-item active"><a href="{{ route('v.prize.list') }}">{{ __('volunteer.prizes.list.list') }}</a></li>
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
                            <h4>{{ __('volunteer.prizes.list.available') }}: {{ $prize->quantity }}</h4>
                            <h4 class="text-muted">{{ __('volunteer.prizes.list.category') }}: <i>{{ $prize->prize_translate->category }}</i></h4>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <h1 class="text-center text-danger w-100">{{ __('volunteer.prizes.list.err') }}</h1>
            @endforelse

        </div>

        @include('volunteer.include.footer')
      </div>
  </div>

@endsection
