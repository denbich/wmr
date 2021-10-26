@extends('layouts.app')

@section('title')
{{ __('Edycja nagrody') }}
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
                    <li class="nav-item">
                      <a href="{{ route('c.prize.orders') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista zamówień </span>
                      </a>
                    </li>
                    <li class="nav-item active">
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
              <h6 class="h2 text-white d-inline-block mb-0">Edycja nagrody</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="{{ route('c.prize.list') }}">Nagrody</a></li>
                  <li class="breadcrumb-item">edycja</li>
                  <li class="breadcrumb-item active"><a href="{{ route('c.prize.show', [$prize->id]) }}">{{ $prize->id }}</a></li>
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
                    <h3 class="mb-0">Edytuj nagrodę </h3>
                  </div>
                </div>
              </div>
                <div class="card-body">
                    @if (session('edit_prize') == true)
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-text"><strong>Sukces!</strong> Edycja nagrody przebiegła pomyślnie!</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div id="form">
                        <form action="{{ route('c.prize.update', [$prize->id]) }}" method="post" role="form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="locale" value="pl">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="w-100 text-center mt-2">Podstawowe informacje</h2>
                                    <div class="card-body pb-0" id="polish-form">
                                        <div class="form-group">
                                            <label class="required" for="title">Tytuł</label>
                                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" maxlength="255" type="text" name="title" id="title" value="{{ $prize->prize_translate->title }}" required>
                                            @if($errors->has('title'))
                                                <div class="text-danger w-100 d-block">
                                                    {{ $errors->first('title') }}
                                                </div>
                                            @endif
                                            <p id="counter_title" class="text-sm">0 / 255 znaków</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Opis</label>
                                            <textarea name="description" id="description"></textarea>
                                            @if($errors->has('description'))
                                                <div class="text-danger w-100 d-block">
                                                    {{ $errors->first('description') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="category">Kategoria</label>
                                            <input class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" maxlength="255" type="text" name="category" id="category" value="{{ $prize->prize_translate->category }}" required>
                                            @if($errors->has('category'))
                                                <div class="text-danger w-100 d-block">
                                                    {{ $errors->first('category') }}
                                                </div>
                                            @endif
                                            <p id="counter_category" class="text-sm">0 / 255 znaków</p>
                                        </div>

                                        <div class="form-group">
                                            <label class="required" for="points">Wartość punktowa</label>
                                            <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ $prize->points }}" required>
                                            @if($errors->has('points'))
                                                <div class="text-danger w-100 d-block">
                                                    {{ $errors->first('points') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="required" for="quantity">Ilość sztuk</label>
                                            <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ $prize->quantity }}" required>
                                            @if($errors->has('quantity'))
                                                <div class="text-danger w-100 d-block">
                                                    {{ $errors->first('quantity') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group px-4 d-none">
                                        <h2 class="w-100 text-center">Ikona</h2>
                                        <a class="btn btn-icon btn-primary w-100 text-white">
                                            <i class="far fa-images"></i>
                                            <span class="ml-1">Zmień ikonę nagrody</span>
                                        </a>
                                    <input type="file" name="image" class="image d-none" id="upload_image" accept="image/*">
                                    </div>
                                    <hr>
                                    <div class="form-group px-4 w-100">
                                        <button type="submit" class="btn btn-primary w-100">Edytuj nagrodę</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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

    var chars = $('#category').val().length;
    $('#counter_category').html(chars +' / 255 znaków');

    $(document).ready(function() {

            $('#title').on('keyup propertychange paste', function(){
                var chars = $('#title').val().length;
                $('#counter_title').html(chars +' / 255 znaków');
            });

            $('#category').on('keyup propertychange paste', function(){
                var chars = $('#category').val().length;
                $('#counter_category').html(chars +' / 255 znaków');
            });
    });

</script>

@endsection

@section('style')
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE') }}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
      selector: 'textarea#description',
      skin: 'bootstrap',
      plugins: 'lists, link, image, media',
      toolbar: 'undo redo | styleselect | h1 h2 bold italic | alignleft aligncenter alignright | bullist numlist | image link removeformat',
      menubar: false,
      font_formats: "Nunito-nunito",
      setup: function (editor) {
      editor.on('init', function (e) {
        editor.setContent("{!! str_replace('"', "'", str_replace(PHP_EOL, '', $prize->prize_translate->description)) !!}");
      });
    }
    });

    //str_replace('"', "'", str_replace(PHP_EOL, '', old('description', ''))

  </script>

@endsection







