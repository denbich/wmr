@extends('layouts.app')

@section('title')
{{ __('Powy post') }}
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
                    <li class="nav-item">
                      <a href="{{ route('c.post.list') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item active">
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
              <h6 class="h2 text-white d-inline-block mb-0">Nowy post</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="{{ route('c.post.list') }}">Posty</a></li>
                  <li class="breadcrumb-item active"><a href="{{ route('c.post.create') }}">Nowy</a></li>
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
                      <h3 class="mb-0">Nowy post </h3>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('c.post.store') }}" method="post" role="form">
                        @csrf
                        <input type="hidden" name="locale" value="pl">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label class="required" for="title">Tytuł</label>
                                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" maxlength="255" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                                    @if($errors->has('title'))
                                        <div class="text-danger w-100 d-block">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                    <p id="counter_title" class="text-sm">0 / 255 znaków</p>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="post_type">Typ postu</label><br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="type_general" name="post_type" class="custom-control-input" value="type_general" checked>
                                        <label class="custom-control-label" for="type_general">Ogólny</label>
                                      </div>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="type_form" name="post_type" class="custom-control-input" value="type_form">
                                        <label class="custom-control-label" for="type_form">Do formularza</label>
                                      </div>
                                    <select name="form_select" id="form_select" class="form-control mt-3 {{ $errors->has('form_select') ? 'is-invalid' : '' }} d-none">
                                        @forelse ($forms as $form)
                                            <option value="{{ $form->id }}">{{ $form->form_translate->title }} (#{{ $form->id }})</option>
                                        @empty
                                            <option value="0">Brak formularzy</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="content">Zawartość</label>
                                    <textarea name="content" id="content"></textarea>
                                    @if($errors->has('content'))
                                        <div class="text-danger w-100 d-block">
                                            {{ $errors->first('content') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary w-100">Stwórz post</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
              </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

@endsection

@section('script')

<script>

    var chars = $('#title').val().length;
    $('#counter_title').html(chars +' / 255 znaków');

    $(document).ready(function() {
        $('#title').on('keyup propertychange paste', function(){
            var chars = $('#title').val().length;
            $('#counter_title').html(chars +' / 255 znaków');
        });

        $('input:radio[name="post_type"]').change( function(){
                if ($(this).is(':checked') && $(this).val() == 'type_general') {
                    $('#form_select').addClass('d-none');
                } else {
                    $('#form_select').removeClass('d-none');
                }
    });


    });

</script>

@endsection

@section('style')
<script src="https://cdn.tiny.cloud/1/d3kpibmpyvl6vumytfhhsj052p2i3op69hki3vyeqclmdec5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

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
        editor.setContent("{!! str_replace('"', "'", str_replace(PHP_EOL, '', old('content', ''))) !!}");
      });
    }
    });
  </script>

@endsection






