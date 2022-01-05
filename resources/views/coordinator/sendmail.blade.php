@extends('layouts.app')

@section('title')
{{ __('Wyślij maila') }}
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
            @include('coordinator.include.posts')
          </ul>

          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Inne</span>
          </h6>

          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('c.mail') }}">
                    <i class="fas fa-paper-plane text-primary"></i>
                    <span class="nav-link-text">Wyślij maila</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('c.calendar') }}">
                    <i class="far fa-calendar text-primary"></i>
                    <span class="nav-link-text">Kalendarz</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('c.settings') }}">
                    <i class="fas fa-cog text-primary"></i>
                    <span class="nav-link-text">Ustawienia</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('c.info') }}">
                    <i class="fas fa-info-circle text-primary"></i>
                    <span class="nav-link-text">Informacje</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt text-primary"></i>
                    <span class="nav-link-text">Wyloguj się</span>
                </a>
            </li>

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
              <h6 class="h2 text-white d-inline-block mb-0">Wyślij maila</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Wyślij maila</li>
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
                    <h3 class="mb-0">Wyślij maila </h3>
                  </div>
                </div>
              </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            @if (session('succes'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>Sukces!</strong> Mail został wysłany!</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                            <form action="{{ route('c.mail') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <span for="title-mail">Odbiorca</span>
                                    <select name="recivier" class="form-control">
                                        <option value="all">Wszyscy wolontariusze</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span for="title-mail">Tytuł maila</span>
                                    <input type="text" name="title" id="title-mail" class="form-control" maxlength="255" required>
                                    <p id="counter_title" class="text-sm">0 / 255 znaków</p>
                                    @if($errors->has('title'))
                                        <div class="text-danger w-100 d-block">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <span for="content-mail">Treść</span>
                                    <textarea name="content" id="content"></textarea>
                                    @if($errors->has('content'))
                                        <div class="text-danger w-100 d-block">
                                            {{ $errors->first('content') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group d-none">
                                    <span for="content-mail">Załączniki</span>
                                    <input type="file" name="files" id="file-mail" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-100">Wyślij</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

@endsection

@section('script')

<script>

    var chars = $('#title-mail').val().length;
    $('#counter_title').html(chars +' / 255 znaków');

    $(document).ready(function() {
        $('#title-mail').on('keyup propertychange paste', function(){
            var chars = $('#title-mail').val().length;
            $('#counter_title').html(chars +' / 255 znaków');
        });
    });

</script>

@endsection

@section('style')
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE') }}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
      selector: 'textarea#content',
      skin: 'bootstrap',
      plugins: 'lists, link, image, media',
      toolbar: 'undo redo | styleselect | h1 h2 bold italic | alignleft aligncenter alignright | bullist numlist | image link removeformat',
      menubar: false,
      font_formats: "Nunito-nunito",
      setup: function (editor) {
      editor.on('init', function (e) {
        editor.setContent("{!! str_replace('"', "'", str_replace('\r\n', '', old('content', ''))) !!}");
      });
    }
    });
  </script>

@endsection
