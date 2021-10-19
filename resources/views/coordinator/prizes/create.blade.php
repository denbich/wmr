@extends('layouts.app')

@section('title')
{{ __('Nowa nagroda') }}
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
                <a class="nav-link" href="#prizes" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="prizes">
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
                <h6 class="h2 text-white d-inline-block mb-0">Nowa nagroda</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('c.prize.list') }}">Nagrody</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('c.prize.create') }}">Nowa</a></li>
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
                  <h3 class="mb-0">Nowa nagroda </h3>
                </div>
              </div>
            </div>
              <div class="card-body">
                  <div id="form">
                      <form action="{{ route('c.prize.store') }}" method="post" role="form">
                          @csrf
                          <input type="hidden" name="locale" value="pl">
                          <div class="row justify-content-center">
                              <div class="col-lg-8">
                                  <h2 class="w-100 text-center mt-2">Podstawowe informacje</h2>
                                  <div class="card-body pb-0" id="polish-form">
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
                                          <input class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" maxlength="255" type="text" name="category" id="category" value="{{ old('category', '') }}" required>
                                          @if($errors->has('category'))
                                              <div class="text-danger w-100 d-block">
                                                  {{ $errors->first('category') }}
                                              </div>
                                          @endif
                                          <p id="counter_category" class="text-sm">0 / 255 znaków</p>
                                      </div>

                                      <div class="form-group">
                                          <label class="required" for="points">Wartość punktowa</label>
                                          <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ old('points', '') }}" required>
                                          @if($errors->has('points'))
                                              <div class="text-danger w-100 d-block">
                                                  {{ $errors->first('points') }}
                                              </div>
                                          @endif
                                      </div>

                                      <div class="form-group">
                                          <label class="required" for="quantity">Ilość sztuk</label>
                                          <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" required>
                                          @if($errors->has('quantity'))
                                              <div class="text-danger w-100 d-block">
                                                  {{ $errors->first('quantity') }}
                                              </div>
                                          @endif
                                      </div>
                                  </div>
                                  <hr>
                                  <div class="form-group px-4">
                                      <h2 class="w-100 text-center">Ikona</h2>
                                      <label for="upload_image" class="w-100">
                                          <a class="btn btn-primary btn-icon w-100 text-white">
                                              <span class="btn-inner--icon"><i class="far fa-images"></i></span>
                                              <span class="btn-inner--text">Dodaj ikonę nagrody</span>
                                          </a>
                                          <input type="file" name="image" class="image d-none" id="upload_image" accept="image/*">
                                          <input type="hidden" name="icon" id="icon_photo" value="">
                                      </label>
                                      <p class="text-success text-center" id="text-photo"></p>
                                      @if($errors->has('icon'))
                                          <div class="text-danger w-100 d-block">
                                              {{ $errors->first('icon') }}
                                          </div>
                                       @endif

                                  </div>
                                  <hr>
                                  <div class="form-group px-4 w-100">
                                      <button type="submit" class="btn btn-primary w-100">Stwórz nagrodę</button>
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

  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Wytnij zdjęcie</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="img-container">
                  <div class="row">
                      <div class="col-md-8">
                          <img src="" id="sample_image" class="img-crop"/>
                      </div>
                      <div class="col-md-4">
                          <div class="preview"></div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop" class="btn btn-primary">Wytnij</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
            </div>
      </div>
    </div>
</div>

@endsection

@section('style')

<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>

<style>

    .image_area {
      position: relative;
    }

    .img-crop {
          display: block;
          max-width: 100%;
    }

    .preview {
          overflow: hidden;
          width: 160px;
          height: 160px;
          margin: 10px;
          border: 1px solid red;
    }

    .modal-lg{
          max-width: 1000px !important;
    }

    .overlay {
      position: absolute;
      bottom: 10px;
      left: 0;
      right: 0;
      background-color: rgba(255, 255, 255, 0.5);
      overflow: hidden;
      height: 0;
      transition: .5s ease;
      width: 100%;
    }

    .image_area:hover .overlay {
      height: 50%;
      cursor: pointer;
    }

    .text {
      color: #333;
      font-size: 20px;
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      text-align: center;
    }


</style>

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
        editor.setContent("{!! str_replace('"', "'", str_replace(PHP_EOL, '', old('description', ''))) !!}");
      });
    }
    });

  </script>


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


<script>
    $(document).ready(function(){

    $("#submitBtn").click(function(){
            //document.getElementById("toggle_div").style.display="block";
           //document.getElementById("loader").innerHTML = "<div class='loader'></div>";
        });

	var $modal = $('#modal');
	var image = document.getElementById('sample_image');
	var cropper;
	$('#upload_image').change(function(event){
		var files = event.target.files;
		var done = function(url){
			image.src = url;
			$modal.modal('show');
		};
		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});
	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 3,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});
	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:500,
			height:500
		});
		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				const time = setInterval(() => {
                    document.getElementById("icon_photo").value = base64data;
                }, 1);
				document.getElementById("icon_photo").value = base64data;
				document.getElementById("text-photo").innerHTML = "Zdjęcie zostało załadowane";
				$modal.modal('hide');
			};
		});
	});

});
</script>

@endsection






