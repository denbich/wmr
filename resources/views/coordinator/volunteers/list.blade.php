@extends('layouts.app')

@section('title')
{{ __('Lista') }}
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
              <h6 class="h2 text-white d-inline-block mb-0">Lista wolontariuszy</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Wolontariusz</li>
                  <li class="breadcrumb-item"><a href="{{ route('c.v.list') }}">Lista</a></li>
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
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">Lista wolontariuszy </h3>
                  </div>
                </div>
              </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Login</th>
                                    <th scope="col" class="sort" data-sort="firstlastname">Imię i nazwisko</th>
                                    <th scope="col">Numer tel.</th>
                                    <th scope="col">Adres email</th>
                                    <th scope="col" class="sort" data-sort="completion">Punkty</th>
                                    <th scope="col">Opcje</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($volunteers as $volunteer)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3">
                                                <img alt="Image placeholder" src="{{ $volunteer->user->photo_src }}">
                                                </a>
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $volunteer->user->name }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td>{{ $volunteer->user->firstname }} {{ $volunteer->user->lastname }}</td>
                                        <td>{{ $volunteer->user->telephone }}</td>
                                        <td>
                                            <a href="mailto:{{ $volunteer->user->email }}">{{ $volunteer->user->email }}</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="completion mr-2">{{ $volunteer->points }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="/coordinator/volunteer/id/{{ $volunteer->id }}">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <h2 class="text-center text-danger">Brak wolontariuszy!</h2>
                                @endforelse
                            </tbody>
                        </table>
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
