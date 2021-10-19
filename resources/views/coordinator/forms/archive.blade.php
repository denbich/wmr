@extends('layouts.app')

@section('title')
{{ __('Archiwum') }}
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
            <li class="nav-item active">
                <a class="nav-link" href="#forms" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="forms">
                  <i class="fas fa-clipboard-list text-primary"></i>
                  <span class="nav-link-text">Formularze</span>
                </a>
                <div class="collapse show" id="forms">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                      <a class="nav-link active" href="{{ route('c.form.list') }}">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('c.form.create') }}">
                        <span class="sidenav-normal"> Utwórz nowy </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
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
              <h6 class="h2 text-white d-inline-block mb-0">Archiwum</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page">Formularze</li>
                  <li class="breadcrumb-item active"><a href="{{ route('c.form.list') }}">Archiwum</a></li>
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
                <div class="row">
                  <div class="col-8">
                    <h3 class="mb-0">Lista formularzy </h3>
                  </div>
                </div>
              </div>
                <div class="card-body">
                    <a class="btn btn-icon btn-primary mb-2" href="{{ route('c.form.list') }}">
                        <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="btn-inner--text">Powrót</span>
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
                                                    <span class="name mb-0 text-sm">{{ $form->form_translate->first()->title  }}</span>
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
                                                <a class="mx-1" href="{{ url('/coordinator/forms', [$form->id]) }}">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                                <a class="mx-1" href="{{ url('/coordinator/forms', [$form->id, 'edit']) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a class="mx-1" href="#deletemodal{{ $form->id }}" data-toggle="modal" data-target="#deletemodal{{ $form->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </h4>
                                            <div class="modal fade" id="deletemodal{{ $form->id }}" tabindex="-1" role="dialog" aria-labelledby="Modal{{ $form->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="Modal{{ $form->id }}Label">Usuń formularz</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <h3 class="w-100 text-wrap">Czy jesteś pewnien, że chcesz usunąć formularz "{{ $form->form_translate->first()->title  }}"?</h3>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                                      <form action="{{ url('/coordinator/forms/', [$form->id]) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">Usuń</button>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                        </td>
                                    </tr>
                                @empty
                                    <h2 class="text-center text-danger">Brak aktywnych formularzy!</h2>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h2 class="text-center text-danger">Brak aktywnych formularzy!</h2>
                    @endif
                </div>
            </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

@endsection






