@extends('layouts.app')

@section('title')
{{ __('volunteer.form.list.button') }}
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
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('v.form.list') }}">
                    <i class="fas fa-clipboard-list text-primary"></i>
                    <span class="nav-link-text">{{ __('volunteer.sidebar.forms') }}</span>
                </a>
            </li>
            @include('volunteer.include.prizes')
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
              <h6 class="h2 text-white d-inline-block mb-0">{{ __('volunteer.form.list.button') }}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">{{ __('volunteer.sidebar.forms') }}</li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('v.form.archive') }}">{{ __('volunteer.form.list.button') }}</a></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <a href="{{ route('v.form.list') }}" class="btn btn-icon btn-neutral"><span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span><span class="btn-inner--text">{{ __('volunteer.form.archive.button') }}</span></a>
              </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->

    <div class="container-fluid mt--6">
        @php $formcount = 0; @endphp
                    @foreach ($forms as $form)
                        @if (date('Y-m-d H:i:s') > date('Y-m-d H:i:s', strtotime($form->calendar->end . " + 7 days"))) @php $formcount++; @endphp @endif
                    @endforeach
                  @if (count($forms) > 0 && $formcount > 0)
                  <div class="row">
                    @forelse ($forms as $form)
                    @if (date('Y-m-d H:i:s') > date('Y-m-d H:i:s', strtotime($form->calendar->end . " + 7 days")))

                      <div class="col-xl-3 col-lg-4 col-md-6 mb-4 h-100">
                          <a href="{{ route('v.form.show', [$form->id]) }}">
                              <div class="card">
                                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                      <img class="w-100 h-auto" src="{{ $form->icon_src }}" alt="Card image cap">
                                  </div>

                                  <div class="card-body">
                                  <h3 class="card-title text-primary mb-1">{{ $form->form_translate->title }}</h3>
                                  <h4><i class="fas fa-users"></i> <span class="name mb-0 text-sm badge badge-primary">{{ $form->signed_form_count }}</span></h4>
                                  <h4>{{ __('volunteer.form.list.date') }}: {{ $form->expiration }}</h4>
                                  <h4 class="text-muted text-center">
                                    @switch(Auth::user()->gender)
                                        @case('f')
                                            @if (empty($form->signed_form->condition) != true)
                                                @switch($form->signed_form->condition)
                                                @case(0)
                                                <span class="text-success">{{ __('volunteer.form.list.options.f.saved') }}</span>
                                                    @break
                                                @case(1)
                                                {{ __('volunteer.form.list.options.positions') }}
                                                @break
                                                @case(2)
                                                <span class="text-success">{{ __('volunteer.form.list.options.present') }}</span>
                                                @break
                                                @case(3)
                                                <span class="text-danger">{{ __('volunteer.form.list.f.absent') }}</span>
                                                @break
                                                @default
                                                {{ __('volunteer.form.list.options.f.unsaved') }}
                                                @endswitch
                                            @else
                                                {{ __('volunteer.form.list.options.f.unsaved') }}
                                            @endif
                                        @break

                                        @case('m')
                                        @if (empty($form->signed_form->condition) != true)
                                                @switch($form->signed_form->condition)
                                                @case(0)
                                                <span class="text-success">{{ __('volunteer.form.list.options.m.saved') }}</span>
                                                    @break
                                                @case(1)
                                                {{ __('volunteer.form.list.options.positions') }}
                                                @break
                                                @case(2)
                                                <span class="text-success">{{ __('volunteer.form.list.options.present') }}</span>
                                                @break
                                                @case(3)
                                                <span class="text-danger">{{ __('volunteer.form.list.options.m.absent') }}</span>
                                                @break
                                                @default
                                                {{ __('volunteer.form.list.options.m.unsaved') }}
                                                @endswitch
                                                @else
                                                {{ __('volunteer.form.list.options.m.unsaved') }}
                                                @endif
                                            @break
                                    @endswitch

                                </h4>
                                  </div>
                              </div>
                          </a>
                      </div>
                    @endif

                    @empty <h2 class="text-center text-danger">{{ __('volunteer.form.list.err') }}</h2> @endforelse
        </div>

                  @else
                  <h2 class="text-center text-danger">Brak aktywnych formularzy!</h2>
                  @endif

        @include('volunteer.include.footer')
      </div>
  </div>

@endsection
