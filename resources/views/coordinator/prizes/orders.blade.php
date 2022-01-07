@extends('layouts.app')

@section('title')
{{ __('Lista zamówień') }}
@endsection

@section('content')

<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <div class="sidenav-header mt-2 align-items-center w-100">
        <a class="mt-2" href="{{ route('c.dashboard') }}">
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
                    <li class="nav-item">
                      <a href="{{ route('c.prize.search') }}" class="nav-link">
                        <span class="sidenav-normal"> Wyszukaj </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('c.prize.list') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item active">
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
              <h6 class="h2 text-white d-inline-block mb-0">Lista zamówień</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page">Nagrody</li>
                  <li class="breadcrumb-item">Zamówienia</li>
                  <li class="breadcrumb-item active"><a href="{{ route('c.prize.orders') }}">lista</a></li>
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

    <!-- Page content -->

    <div class="container-fluid mt--6">
        <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Zamówienia </h3>
                </div>
              </div>
            </div>
              <div class="card-body">
                @if (count($orders) > 0)
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Imię i nazwisko (login)</th>
                                    <th scope="col">Nazwa nagrody</th>
                                    <th scope="col">Data zamówienia</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Opcje</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($orders as $order)
                                    <tr class="text-center">
                                        <td class="text-center">
                                            <span class="name mb-0 text-sm">#{{ $order->id }}</span>
                                        </td>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3">
                                                <img src="{{ $order->prize->icon_src }}">
                                                </a>
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $order->volunteer->firstname." ".$order->volunteer->lastname." (".$order->volunteer->name.")" }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="text-center">
                                            <span class="name mb-0 text-sm">{{ $order->d_prize->title }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="name mb-0 text-sm">{{ $order->created_at }}</span>
                                        </td>
                                        <td class="text-center">
                                            <b> @if ($order->condition == 0) Nieodebrane @else Odebrane @endif </b>
                                        </td>
                                        <td class="text-center">
                                            <h4>
                                                <a class="mx-1" href="{{ url('/coordinator/prizes/orders', [$order->id]) }}">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </h4>
                                        </td>
                                    </tr>
                                @empty
                                    <h2 class="text-center text-danger">Brak zamówień!</h2>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h2 class="text-center text-danger">Brak zamówień!</h2>
                    @endif
              </div>
          </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

@endsection






