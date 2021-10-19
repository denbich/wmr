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
                <h6 class="h2 text-white d-inline-block mb-0">Lista postów</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('v.post.list') }}">Posty</a></li>
                    <li class="breadcrumb-item active">Lista</li>
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
            @forelse ($posts as $post)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4 h-100">
                    <a href="{{ route('v.post', [$post->id]) }}">
                        <div class="card">
                            <div class="card-body">
                            <h3 class="card-title text-primary">{{ $post->post_translate->title }}</h3>
                            <h5>{!! Str::limit(strip_tags($post->post_translate->content), 20) !!}</h5>
                            <h4><b>Czytaj dalej...</b></h4>
                            <h4 class="text-muted">Autor: {{ $post->author->name }}</h4>
                            <h4 class="text-muted">{{ $post->created_at }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <h1 class="text-center text-danger w-100">Brak postów!</h1>
            @endforelse

        </div>


        @include('volunteer.include.footer')
      </div>
  </div>

@endsection
