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
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('v.post.list') }}">
                    <i class="fas fa-newspaper text-primary"></i>
                    <span class="nav-link-text">Aktualności</span>
                </a>
            </li>

            @include('volunteer.include.forms')
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
                <h6 class="h2 text-white d-inline-block mb-0">Post #{{ $post->id }}</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('v.post.list') }}">Posty</a></li>
                    <li class="breadcrumb-item active">{{ $post->id }}</li>
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
                  <h3 class="mb-0">{{ $post->post_translate->title }} </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                    <div>
                        <p class="mb-0 text-sm"><b class="mb-0">Autor: </b>{{ $post->author->name }}
                            <b class="mb-0">Data publikacji: </b>{{ $post->created_at }}
                            <b class="mb-0">Typ postu:</b>
                            @if ($post->form_id == 0)
                            Ogólny</p>
                            @else
                            <a href="{{ route('c.form.show', [$post->form_id]) }}">Do formularza #{{ $post->form_id }}</a></p>
                            @endif
                    </div>
                <hr>
                {!! $post->post_translate->content !!}
            </div>
          </div>


        @include('volunteer.include.footer')
      </div>
  </div>

@endsection
