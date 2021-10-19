@extends('layouts.app')

@section('title')
{{ __('Post') }}
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
            @include('coordinator.include.prizes')
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#posts" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="posts">
                  <i class="fas fa-table text-primary"></i>
                  <span class="nav-link-text">Posty</span>
                </a>
                <div class="collapse show" id="posts">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item active">
                      <a href="{{ route('c.post.list') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('c.post.create') }}" class="nav-link">
                        <span class="sidenav-normal"> Utwórz nowy </span>
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
              <h6 class="h2 text-white d-inline-block mb-0">Post #{{ $post->id }}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="{{ route('c.post.list') }}">Posty</a></li>
                  <li class="breadcrumb-item active">{{ $post->id }}</li>
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
        <div class="row">
            <div class="col-lg-3 order-lg-2">
              <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Informacje</h3>
                    <b class="mb-0">Autor:</b>
                    <p>{{ $post->author->name }}</p>
                    <div class="my-2"></div>
                    <b class="mb-0">Data publikacji:</b>
                    <p>{{ $post->created_at }}</p>
                    <div class="my-2"></div>
                    <b class="mb-0">Data aktualizacji:</b>
                    <p>{{ $post->post_translate->updated_at }}</p>
                    <div class="my-2"></div>
                    <b class="mb-0">Typ postu:</b>
                    @if ($post->form_id == 0)
                    <p>Ogólny</p>
                    @else
                    <p><a href="{{ route('c.form.show', [$post->form_id]) }}">Do formularza #{{ $post->form_id }}</a></p>
                    @endif
                    <hr class="my-2">
                    <h3 class="text-center">Opcje</h3>
                    <a href="{{ route('c.post.edit', [$post->id]) }}" class="btn btn-success w-100 my-2 text-white">Edytuj post</a>
                    <button class="btn btn-danger w-100 my-2" data-toggle="modal" data-target="#deletemodal">Usuń post</button>
                </div>
              </div>
            </div>
            <div class="col-lg-9 h-100 order-lg-1">
              <div class="card">
                <div class="card-header">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h3 class="mb-0">{{ $post->post_translate->title }} </h3>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    @if (session('created_post') == true)
                        @php session()->forget('created_post'); @endphp
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text"><strong>Sukces!</strong> Post został utworzony pomyślnie!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row pt-2">
                        {!! $post->post_translate->content !!}
                    </div>
                </div>
              </div>
            </div>
          </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

  <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Usuń nagrodę</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h3 class="w-100 text-wrap text-center">Czy jesteś pewnien, że chcesz usunąć post #{{ $post->id}}?</h3>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
          <form action="{{ route('c.post.destroy', [$post->id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Usuń</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection






