@extends('layouts.app')

@section('title')
{{ __('Szukaj nagród') }}
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
            @include('coordinator.include.dashboard')
        </ul>
        <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Ogólne</span>
        </h6>
          <ul class="navbar-nav">
            @include('coordinator.include.volunteer')
            @include('coordinator.include.chat')
          </ul>
          <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Serwis</span>
        </h6>
          <ul class="navbar-nav">
            @include('coordinator.include.forms')
            <li class="nav-item active">
                <a class="nav-link active" href="#prizes" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="prizes">
                  <i class="fas fa-award text-primary"></i>
                  <span class="nav-link-text">Nagrody</span>
                </a>
                <div class="collapse show" id="prizes">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item active">
                      <a href="{{ route('c.prize.search') }}" class="nav-link">
                        <span class="sidenav-normal"> Wyszukaj </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('c.prize.list') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('c.prize.orders') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista zamówień </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('c.prize.create') }}" class="nav-link">
                        <span class="sidenav-normal"> Utwórz nową </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
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
              <h6 class="h2 text-white d-inline-block mb-0">Szukaj nagrody</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page">Nagrody</li>
                  <li class="breadcrumb-item active"><a href="{{ route('c.prize.search') }}">Szukaj</a></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{ route('c.form.create') }}" class="btn btn-sm btn-neutral"><i class="fas fa-plus"></i> Nowy formularz</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content style="width: 18rem;" -->

    <div class="container-fluid mt--6">
        <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Wyszukiwarka </h3>
                </div>
              </div>
            </div>
              <div class="card-body">
                  <div class="row justify-content-center">
                      <div class="col-lg-7">
                          <form action="{{ route('c.prize.search') }}" method="get">
                              <div class="input-group mb-3">
                                  <input type="text" class="form-control" name="q" placeholder="Szukaj nagrody" aria-label="Szukaj nagrody" aria-describedby="button-addon2" value="@isset($_GET['q']){{ $_GET['q'] }}@endisset">
                                  <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                                      <i class="fas fa-search"></i>
                                    </button>
                                  </div>
                                </div>
                          </form>
                          @isset($prizes) <h2 class="text-center">Ilość znalezionych nagród: {{ count($prizes) }}</h2> @endisset
                      </div>
                  </div>
              </div>
          </div>
        <div class="row">
            @isset($_GET['q'])
                  @if (empty($_GET['q']))
                      <h3 class="text-center text-danger">Wyszukanie nie może być puste!</h3>
                  @else
                  @forelse ($prizes as $prize)
                  <div class="col-xl-3 col-lg-4 col-md-6 mb-4 h-100">
                      <a href="{{ route('c.prize.show', [$prize->id]) }}">
                          <div class="card">
                              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                  <img class="w-100 h-auto" src="{{ $prize->icon_src }}" alt="Card image cap">
                              </div>

                              <div class="card-body">
                              <h3 class="card-title text-primary">{{ $prize->prize_translate->title }}</h3>
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
                  @endif
                  @endisset

        </div>



        @yield('coordinator.include.footer')
      </div>
  </div>

@endsection






