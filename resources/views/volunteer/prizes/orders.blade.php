@extends('layouts.app')

@section('title')
{{ __('volunteer.prizes.order.title') }}
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
                    <li class="nav-item">
                      <a href="{{ route('v.prize.list') }}" class="nav-link">
                        <span class="sidenav-normal"> {{ __('volunteer.sidebar.prizes.list') }} </span>
                      </a>
                    </li>
                    <li class="nav-item active">
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
                <h6 class="h2 text-white d-inline-block mb-0">{{ __('volunteer.prizes.order.title') }}</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('v.prize.list') }}">{{ __('volunteer.sidebar.prizes.prizes') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('v.prize.orders') }}">{{ __('volunteer.prizes.order.orders') }}</a></li>
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
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">{{ __('volunteer.prizes.order.orders') }}</h3>
                </div>
              </div>
            </div>
              <div class="card-body">
                @if (count($orders) > 0)
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th scope="col">{{ __('volunteer.prizes.order.name') }}</th>
                                    <th scope="col">{{ __('volunteer.prizes.order.date') }}</th>
                                    <th scope="col">{{ __('volunteer.prizes.order.info') }}</th>
                                    <th scope="col">{{ __('volunteer.prizes.order.status') }}</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($orders as $order)
                                    <tr class="text-center">
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="{{ route('v.prize', [$order->d_prize->prize_id]) }}" class="avatar rounded-circle mr-3">
                                                <img src="{{ $order->prize->icon_src }}">
                                                </a>
                                                <div class="media-body">
                                                    <a href="{{ route('v.prize', [$order->d_prize->prize_id]) }}"><span class="name mb-0 text-sm">{{ $order->d_prize->title }}</span></a>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="text-center">
                                            <span class="name mb-0 text-sm">{{ $order->created_at }}</span>
                                        </td>
                                        <td class="text-center">{{ $order->info }}</td>
                                        <td class="text-center">@if ($order->condition == 0) {{ __('volunteer.prizes.order.m') }} @else {{ __('volunteer.prizes.order.r') }} @endif</td>
                                    </tr>
                                @empty
                                    <h2 class="text-center text-danger">{{ __('volunteer.prizes.order.err') }}</h2>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h2 class="text-center text-danger">{{ __('volunteer.prizes.order.err') }}!</h2>
                    @endif
              </div>
          </div>

        @include('volunteer.include.footer')
      </div>
  </div>

@endsection
