@extends('layouts.app')

@section('title')
{{ __('lista formularzy') }}
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
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('v.form.list') }}">
                    <i class="fas fa-clipboard-list text-primary"></i>
                    <span class="nav-link-text">Formularze</span>
                </a>
            </li>

            @include('volunteer.include.prizes')

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
              <h6 class="h2 text-white d-inline-block mb-0">Lista formularzy</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">Formularze</li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('v.form.list') }}">Lista</a></li>
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
              <div class="row">
                <div class="col-8">
                  <h3 class="mb-0">Lista formularzy </h3>
                </div>
              </div>
            </div>
              <div class="card-body">
                  <a class="btn btn-icon btn-primary mb-2" href="{{ route('v.form.archive') }}">
                      <span class="btn-inner--icon"><i class="fas fa-archive"></i></span>
                      <span class="btn-inner--text">Archiwum</span>
                  </a>
                  @if (count($forms) > 0)
                  <div class="table-responsive">
                      <table class="table align-items-center table-flush">
                          <thead class="thead-light text-center">
                              <tr>
                                  <th scope="col">Nazwa</th>
                                  <th scope="col">Data wygaśnięcia formularza</th>
                                  <th scope="col">Ilość zapisanych</th>
                                  <th scope="col">Opcje</th>
                              </tr>
                          </thead>
                          <tbody class="list">
                              @forelse ($forms as $form)
                                  <tr>
                                      <th scope="row">
                                          <div class="media align-items-center">
                                              <a href="#" class="avatar rounded-circle mr-3">
                                              <img src="{{ $form->icon_src }}">
                                              </a>
                                              <div class="media-body">
                                                  <span class="name mb-0 text-sm">{{ $form->form_translate->title  }}</span>
                                              </div>
                                          </div>
                                      </th>
                                      <td class="text-center">
                                          <span class="name mb-0 text-sm">{{ $form->expiration }}</span>
                                      </td>
                                      <td class="text-center">
                                          <span class="name mb-0 text-sm badge badge-primary">{{ $form->signed_form_count }}</span>
                                      </td>
                                      <td class="text-center">
                                          <h4>
                                              <a class="mx-1" href="{{ route('v.form.show', [$form->id]) }}">
                                                  <i class="fas fa-search"></i>
                                              </a>
                                          </h4>
                                      </td>
                                  </tr>
                              @empty
                                  <h2 class="text-center text-danger">Brak formularzy!</h2>
                              @endforelse
                          </tbody>
                      </table>
                  </div>
                  @else
                  <h2 class="text-center text-danger">Brak aktywnych formularzy!</h2>
                  @endif
              </div>
          </div>

        @include('volunteer.include.footer')
      </div>
  </div>

@endsection
