@extends('layouts.app')

@section('title')
{{ __('Lista postów') }}
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

            <li class="nav-item">
                <a class="nav-link collapsed active" href="#prizes" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="prizes">
                  <i class="fas fa-award text-primary"></i>
                  <span class="nav-link-text">Nagrody</span>
                </a>
                <div class="collapse show" id="prizes">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item active">
                      <a href="{{ route('v.prize.list') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('v.prize.orders') }}" class="nav-link">
                        <span class="sidenav-normal"> Twoje zamówienia </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>


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
                <h6 class="h2 text-white d-inline-block mb-0">Lista nagród</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page">Nagrody</li>
                    <li class="breadcrumb-item active"><a href="{{ route('v.prize.list') }}">Lista</a></li>
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
                            <h4>Dostępnych sztuk: {{ $prize->quantity }}</h4>
                            <h4 class="text-muted">Kategoria: <i>{{ $prize->prize_translate->category }}</i></h4>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <h1 class="text-center text-danger w-100">Brak nagród!</h1>
            @endforelse

        </div>

        @include('volunteer.include.footer')
      </div>
  </div>

@endsection
