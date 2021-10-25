@extends('layouts.app')

@section('title')
{{ __('Nowy formularz') }}
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
                <a class="nav-link active" href="#forms" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="forms">
                  <i class="fas fa-clipboard-list text-primary"></i>
                  <span class="nav-link-text">Formularze</span>
                </a>
                <div class="collapse show" id="forms">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('c.form.list') }}">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="{{ route('c.form.create') }}">
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
              <h6 class="h2 text-white d-inline-block mb-0">Edytuj formularz</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="{{ route('c.form.list') }}">Formularze</a></li>
                  <li class="breadcrumb-item active"><a href="{{ route('c.form.create') }}">Nowy</a></li>
                </ol>
              </nav>
            </div>
          </div>
        </div><
      </div>
    </div>

    <!-- Page content -->

    <div class="container-fluid mt--6">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">Nowy formularz </h3>
                  </div>
                </div>
              </div>
                <div class="card-body">
                        <div class="d-none">
                            <label for="switch-lang">Z wersją angielską:</label>
                            <label class="custom-toggle">
                                <input type="checkbox" id="switch-lang">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="Nie" data-label-on="Tak"></span>
                            </label>
                        </div>
                    <div id="form-pl">
                        <form action="{{ route('c.form.store') }}" method="post" id="new_form">
                            @csrf
                            <input type="hidden" name="locale" value="pl">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="w-100 text-center mt-2">Podstawowe informacje</h2>
                                    <div class="card-body pb-0" id="polish-form">
                                        <div class="form-group">
                                            <label class="required" for="title">Tytuł</label>
                                            <input class="form-control {{ $errors->has('pl_title') ? 'is-invalid' : '' }}" maxlength="255" type="text" name="pl_title" id="pl_title_pl" value="{{ old('pl_title', '') }}" required>
                                            @if($errors->has('pl_title'))
                                                <div class="text-danger w-100 d-block">
                                                    {{ $errors->first('pl_title') }}
                                                </div>
                                            @endif
                                            <p id="counter_pl_title_pol" class="text-sm">0 / 255 znaków</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="pl_description">Opis</label>
                                            <textarea name="pl_description" id="pl_description_pol"></textarea>
                                            @if($errors->has('pl_description'))
                                                <div class="text-danger w-100 d-block">
                                                    {{ $errors->first('pl_description') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group px-4">
                                        <h2 class="w-100 text-center">Daty</h2>
                                        <label for="expiration">Data wygaśnięcia formularza</label>
                                        <input class="form-control" type="datetime-local" name="expiration" id="expiration"  value="{{ old('expiration') }}"required>
                                        @if($errors->has('expiration'))
                                            <div class="text-danger w-100 d-block">
                                                {{ $errors->first('expiration') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group px-4">
                                        <label for="start">Data rozpoczęcia imprezy</label>
                                        <input class="form-control" type="datetime-local" name="start" id="start" value="{{ old('start') }}" required>
                                        @if($errors->has('start'))
                                            <div class="text-danger w-100 d-block">
                                                {{ $errors->first('start') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group px-4">
                                        <label for="stop">Data zakończenia imprezy</label>
                                        <input class="form-control" type="datetime-local" name="stop" id="stop" value="{{ old('stop') }}" required>
                                        @if($errors->has('stop'))
                                            <div class="text-danger w-100 d-block">
                                                {{ $errors->first('stop') }}
                                            </div>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="form-group px-4">
                                        <h2 class="w-100 text-center">Ikona</h2>

                                        <label for="upload_image" class="w-100">
                                            <a class="btn btn-primary btn-icon w-100 text-white">
                                                <span class="btn-inner--icon"><i class="far fa-images"></i></span>
                                                <span class="btn-inner--text">Dodaj ikonę formularza</span>
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
                                    <div class="form-group px-4">
                                        <h2 class="w-100 text-center">Miejsce imprezy</h2>
                                        <input type="hidden" name="place_longitude_pol" value="50.1076061">
                                        <input type="hidden" name="place_latitude_pol" value="18.5471027">
                                      <div id="map_pl" style="width: 100%; height: 350px;"></div>
                                    </div>
                                    <hr>
                                    <div class="form-group px-4">
                                        <h2 class="w-100 text-center">Stanowiska <span id="count_h2_pol">0</span> / 20</h2>
                                        <button class="btn btn-icon btn-primary w-100 mb-2" type="button" id="add_position_pol">
                                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                            <span class="btn-inner--text">Dodaj stanowisko</span>
                                        </button>
                                        <input type="hidden" name="positions_count" id="positions_count_pol" value="0">
                                        @if($errors->has('positions_count'))
                                            <div class="text-danger w-100 d-block">
                                                {{ $errors->first('positions_count') }}
                                            </div>
                                         @endif
                                        <div id="positions_pol">
                                        </div>
                                        @php $iserror = false; @endphp
                                        @for ($i = 0; $i <= 20; $i++)
                                            @if($errors->has('name_position_pol'.$i))
                                                @php $iserror = true; @endphp
                                            @endif
                                            @if($errors->has('desc_position_pol'.$i))
                                                @php $iserror = true; @endphp
                                            @endif
                                            @if($errors->has('points_position_pol'.$i))
                                                @php $iserror = true; @endphp
                                            @endif
                                            @if($errors->has('max_position_pol'.$i))
                                                @php $iserror = true; @endphp
                                            @endif
                                        @endfor
                                        @if ($iserror == true)

                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Problemy z stanowiskami: </strong>
                                                <span class="alert-text">
                                                    <ul>
                                                        @for ($i = 0; $i <= 20; $i++)
                                                            @if($errors->has('name_position_pol'.$i))
                                                                <li>{{ $errors->first('name_position_pol'.$i) }}</li>
                                                            @endif
                                                            @if($errors->has('desc_position_pol'.$i))
                                                                <li>{{ $errors->first('desc_position_pol'.$i) }}</li>
                                                            @endif
                                                            @if($errors->has('points_position_pol'.$i))
                                                                <li>{{ $errors->first('points_position_pol'.$i) }}</li>
                                                            @endif
                                                            @if($errors->has('max_position_pol'.$i))
                                                                <li>{{ $errors->first('max_position_pol'.$i) }}</li>
                                                            @endif
                                                        @endfor
                                                    </ul>
                                                </span>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                        @endif
                                    </div>
                                    <hr>
                                    <div class="form-group px-4 w-100">
                                        <button type="submit" class="btn btn-primary w-100">Stwórz formularz</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="form-en" class="d-none">
                        <form action="{{ route('c.form.store') }}" method="post" id="new_form">
                            @csrf
                            <input type="hidden" name="locale" value="en">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link bg-aqua-active active" href="#" id="polish-link">Polski (Polish)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" id="english-link">English</a>
                                </li>
                             </ul>
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="w-100 text-center mt-2">Podstawowe informacje</h2>
                                    <div class="card-body pb-0" id="polish-form">
                                        <div class="form-group">
                                            <label class="required" for="title">Tytuł (PL)</label>
                                            <input class="form-control {{ $errors->has('pl_title') ? 'is-invalid' : '' }}" maxlength="255" type="text" name="pl_title" id="pl_title" value="{{ old('pl_title', '') }}" required>
                                            @if($errors->has('pl_title'))
                                                <div class="text-danger w-100 d-block">
                                                    {{ $errors->first('pl_title') }}
                                                </div>
                                            @endif
                                            <p id="counter_pl_title" class="text-sm">0 / 255 znaków</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="pl_description">Opis (PL)</label>
                                            <textarea class="form-control {{ $errors->has('pl_description') ? 'is-invalid' : '' }}" maxlength="255" name="pl_description" id="pl_description" required>{{ old('pl_description') }}</textarea>
                                            @if($errors->has('pl_description'))
                                                <div class="text-danger w-100 d-block">
                                                    {{ $errors->first('pl_description') }}
                                                </div>
                                            @endif
                                            <p id="counter_pl_description" class="text-sm">0 / 255 znaków</p>
                                        </div>
                                    </div>

                                    <div class="card-body d-none pb-0" id="english-form">
                                        <div class="form-group">
                                            <label class="required" for="title">Tytuł (EN)</label>
                                            <input class="form-control {{ $errors->has('en_title') ? 'is-invalid' : '' }}" maxlength="255" type="text" name="en_title" id="en_title" value="{{ old('en_title', '') }}" required>
                                            @if($errors->has('en_title'))
                                                <div class="text-danger w-100 d-block">
                                                    {{ $errors->first('en_title') }}
                                                </div>
                                            @endif
                                            <p id="counter_en_title" class="text-sm">0 / 255 znaków</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="en_description">Opis (EN)</label>
                                            <textarea class="form-control {{ $errors->has('en_description') ? 'is-invalid' : '' }}" maxlength="255" name="en_description" id="en_description" required>{{ old('en_description') }}</textarea>
                                            @if($errors->has('en_description'))
                                                <div class="text-danger w-100 d-block">
                                                    {{ $errors->first('en_description') }}
                                                </div>
                                            @endif
                                            <p id="counter_en_description" class="text-sm">0 / 255 znaków</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group px-4">
                                        <h2 class="w-100 text-center">Daty</h2>
                                        <label for="expiration">Data wygaśnięcia formularza</label>
                                        <input class="form-control" type="datetime-local" name="expiration" id="expiration" required>
                                    </div>
                                    <div class="form-group px-4">
                                        <label for="start">Data rozpoczęcia imprezy</label>
                                        <input class="form-control" type="datetime-local" name="start" id="start" required>
                                    </div>
                                    <div class="form-group px-4">
                                        <label for="stop">Data zakończenia imprezy</label>
                                        <input class="form-control" type="datetime-local" name="stop" id="stop" required>
                                    </div>
                                    <hr>
                                    <div class="form-group px-4">
                                        <h2 class="w-100 text-center">Miejsce imprezy</h2>
                                        <input type="hidden" name="place_longitude" value="">
                                        <input type="hidden" name="place_latitude" value="">
                                      <div id="map_en" style="width: 100%; height: 350px;"></div>
                                    </div>
                                    <hr>
                                    <div class="form-group px-4">
                                        <h2 class="w-100 text-center">Stanowiska</h2>
                                        <button class="btn btn-icon btn-primary w-100 mb-2" type="button" id="add_position">
                                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                            <span class="btn-inner--text">Dodaj stanowisko</span>
                                        </button>
                                        <input type="hidden" name="positions_count" id="positions_count" value="0">
                                        <div id="positions">

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group px-4 w-100">
                                        <button type="submit" class="btn btn-primary w-100">Stwórz formularz</button>
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
      selector: 'textarea#pl_description_pol',
      skin: 'bootstrap',
      plugins: 'lists, link, image, media',
      toolbar: 'undo redo | styleselect | h1 h2 bold italic | alignleft aligncenter alignright | bullist numlist | image link removeformat',
      menubar: false,
      font_formats: "Nunito-nunito"
      //setup: function (editor) {
      //editor.on('init', function (e) {
        //editor.setContent("{!! str_replace('"', "'", str_replace(PHP_EOL, '', old('pl_description_pol', ''))) !!}");
      //});
    //}
    });
  </script>
@endsection

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cABC" async defer></script>

<script>
    //switch-lang
    $("#switch-lang").change(function(){
    if($(this).is(':checked') === true) {
        $("#form-pl").addClass('d-none');
        $("#form-en").removeClass('d-none');
    }
    else {
        $("#form-pl").removeClass('d-none');
        $("#form-en").addClass('d-none');
    }
});
</script>

<script>
  "use strict";

function initMap() {
  var myLatlng = new google.maps.LatLng(50.1076061,18.5471027);
var mapOptions = {
    zoom: 13,
    center: myLatlng,
    mapTypeControl: false,
    fullscreenControl: false,
    zoomControl: true,
    streetViewControl: false
}
var map_pl = new google.maps.Map(document.getElementById("map_pl"), mapOptions);
var map_en = new google.maps.Map(document.getElementById("map_en"), mapOptions);

// Place a draggable marker on the map
var marker_pl = new google.maps.Marker({
    position: myLatlng,
    map: map_pl,
    draggable:true,
    //title:"Weź mnie!"
});

var marker_en = new google.maps.Marker({
    position: myLatlng,
    map: map_en,
    draggable:true,
    //title:"Weź mnie!"
});

window.setInterval(function() {
    $("[name='place_longitude_pol']").val(marker_pl.getPosition().lat());
    $("[name='place_latitude_pol']").val(marker_pl.getPosition().lng());
}, 5);

window.setInterval(function() {
    $("[name='place_longitude']").val(marker_en.getPosition().lat());
    $("[name='place_latitude']").val(marker_en.getPosition().lng());
}, 5);


}

</script>

<script>
    var $englishForm = $('#english-form');
   var $polishForm = $('#polish-form');
   var $englishLink = $('#english-link');
   var $polishLink = $('#polish-link');

   //$('#english-form-position"+newnount+"').toggleClass('d-none'); $('#english-link-position"+newnount+"').toggleClass('active'); $('#polish-link-position"+newnount+"').toggleClass('active'); $('#polish-form-position"+newnount+"').toggleClass('d-none');

   $polishLink.click(function() {
     $englishLink.removeClass('active');
     $englishForm.addClass('d-none');
     $polishLink.addClass('active');
     $polishForm.removeClass('d-none');
   });

   $englishLink.click(function() {
     $englishLink.addClass('active');
     $englishForm.removeClass('d-none');
     $polishLink.removeClass('active');
     $polishForm.addClass('d-none');
   });

    $(document).ready(function() {
        $('#add_position').click(function() {
            var count = $('#positions_count').val();
            if (count < 20)
            {
                $('#buttonposition1').remove();
                $('#positions_count').val(+count + +1);
                var newnount = +count + +1;

                $('#positions').append("<div id='position_pl"+newnount+"' positionid='"+newnount+"'><div class='' id='divposition"+newnount+"'><div class='w-100 text-right' id='buttonposition"+newnount+"'><button class='btn btn-icon btn-danger btn-sm text-right' type='button' onclick='"+'$("#position'+newnount+'").remove(); $("#positions_count").val(+$("#positions_count").val() - +1); $("#divposition'+count+'").removeClass("d-none"); clearInterval(interval);'+"'><span class='btn-inner--icon'><i class='fas fa-trash-alt'></i></span></button></div></div> <ul class='nav nav-tabs'><li class='nav-item'><a class='nav-link bg-aqua-active active' href='#' id='polish-link-position"+newnount+"' onclick='"+'$("#english-form-position'+newnount+'").toggleClass("d-none"); $("#english-link-position'+newnount+'").toggleClass("active"); $("#polish-link-position'+newnount+'").toggleClass("active"); $("#polish-form-position'+newnount+'").toggleClass("d-none");'+"'>Polski (Polish)</a></li><li class='nav-item'><a class='nav-link' href='#' id='english-link-position"+newnount+"' onclick='"+'$("#english-form-position'+newnount+'").toggleClass("d-none"); $("#english-link-position'+newnount+'").toggleClass("active"); $("#polish-link-position'+newnount+'").toggleClass("active"); $("#polish-form-position'+newnount+'").toggleClass("d-none");'+"'>English</a></li> </ul><div class='card-body pb-0' id='polish-form-position"+newnount+"'><label for='name_position_pl"+newnount+"' class='mt-1'>Nazwa stanowiska "+newnount+" (PL):</label><input type='text' class='form-control' maxlength='255' id='name_position_pl"+newnount+"' name='name_position_pl"+newnount+"' onkeyup = '(counter_name_position_pl("+newnount+"))' required><p id='counter_name_position_pl"+newnount+"' class='text-sm'>0 / 255 znaków</p><label>Opis stanowiska (PL):</label><textarea class='form-control mt-1' rows='2' maxlength='255' id='desc_position_pl"+newnount+"' style='resize: none;' name='desc_position_pl"+newnount+"' onkeyup = '(counter_desc_position_pl("+newnount+"))' required></textarea><p id='counter_desc_position_pl"+newnount+"' class='text-sm'>0 / 255 znaków</p></div><div class='card-body d-none pb-0' id='english-form-position"+newnount+"'><label for='name_position_en"+newnount+"' class='mt-1'>Nazwa stanowiska (EN) "+newnount+":</label><input type='text' class='form-control' maxlength='255' id='name_position_en"+newnount+"' name='name_position_en"+newnount+"' onkeyup = '(counter_name_position_en("+newnount+"))' required><p id='counter_name_position_en"+newnount+"' class='text-sm'>0 / 255 znaków</p><label>Opis stanowiska (EN):</label><textarea class='form-control mt-1' rows='2' maxlength='255' id='desc_position_en"+newnount+"' style='resize: none;' name='desc_position_en"+newnount+"' onkeyup = '(counter_desc_position_en("+newnount+"))' required></textarea><p id='counter_desc_position_en"+newnount+"' class='text-sm'>0 / 255 znaków</p></div> <div class='row'><div class='col'><label for='points_position"+newnount+"'>Wartość punktowa:</label><input type='number' class='form-control' id='points_position"+newnount+"' name='points_position"+newnount+"' required></div><div class='col'><label for='max_position"+newnount+"'>Max. ilość wolontariuszy:</label><input type='number' class='form-control' id='max_position"+newnount+"' name='max_position"+newnount+"' required></div></div><hr class='w-100 text-center ml-0' style='color: #707070'></div>");
                $("#divposition"+count).addClass("d-none");
                $("#divposition"+newnount).removeClass("d-none");
            }

    });

    $('#add_position_pol').click(function() {
            var count = $('#positions_count_pol').val();
            if (count < 20)
            {
                var newnount = +count + +1;
                $('#buttonposition_pol1').remove();
                $('#positions_count_pol').val(+count + +1);//count_h2_pol
                $('#count_h2_pol').html(newnount);

                $("#count_h2_pol").html(newnount);

                $('#positions_pol').append("<div id='position_pol"+newnount+"'><div id='divposition_pol"+newnount+"'><div class='w-100 text-right' id='buttonposition_pol"+newnount+"'><button class='btn btn-icon btn-danger btn-sm text-right' type='button' onclick='"+'$("#position_pol'+newnount+'").remove(); $("#positions_count_pol").val(+$("#positions_count_pol").val() - +1); $("#count_h2_pol").html('+count+'); $("#divposition'+count+'").removeClass("d-none"); clearInterval(interval); '+"'><span class='btn-inner--icon'><i class='fas fa-trash-alt'></i></span></button></div></div>  <div class='pb-0' id='polish-form-position_pol"+newnount+"'><label for='name_position_pl_pol"+newnount+"' class='mt-1'>Nazwa stanowiska "+newnount+":</label><input type='text' class='form-control' maxlength='255' id='name_position_pl_pol"+newnount+"' name='name_position_pol"+newnount+"' onkeyup = '(counter_name_position_pl_pol("+newnount+"))' required><p id='counter_name_position_pl_pol"+newnount+"' class='text-sm'>0 / 255 znaków</p><label>Opis stanowiska:</label><textarea class='form-control mt-1' rows='2' maxlength='255' id='desc_position_pl_pol"+newnount+"' style='resize: none;' name='desc_position_pol"+newnount+"' onkeyup = '(counter_desc_position_pl_pol("+newnount+"))' required></textarea><p id='counter_desc_position_pl_pol"+newnount+"' class='text-sm'>0 / 255 znaków</p></div> <div class='row'><div class='col'><label for='points_position_pol"+newnount+"'>Wartość punktowa:</label><input type='number' class='form-control' id='points_position_pol"+newnount+"' name='points_position_pol"+newnount+"' required></div><div class='col'><label for='max_position_pol"+newnount+"'>Max. ilość wolontariuszy:</label><input type='number' class='form-control' id='max_position_pol"+newnount+"' name='max_position_pol"+newnount+"' required></div></div><hr class='w-100 text-center ml-0' style='color: #707070'></div>");
                $("#divposition"+count).addClass("d-none");
                $("#divposition"+newnount).removeClass("d-none");
            }

    });

    });

    $('#pl_description').on('keyup propertychange paste', function(){
        var chars = $('#pl_description').val().length;
        $('#counter_pl_description').html(chars +' / 255 znaków');
    });

    $('#pl_title').on('keyup propertychange paste', function(){
        var chars = $('#pl_title').val().length;
        $('#counter_pl_title').html(chars +' / 255 znaków');
    });


    $('#en_description').on('keyup propertychange paste', function(){
        var chars = $('#en_description').val().length;
        $('#counter_en_description').html(chars +' / 255 znaków');
    });

    $('#en_title').on('keyup propertychange paste', function(){
        var chars = $('#en_title').val().length;
        $('#counter_en_title').html(chars +' / 255 znaków');
    });

    $('#pl_description_pol').on('keyup propertychange paste', function(){
        var chars = $('#pl_description_pol').val().length;
        $('#counter_pl_description_pol').html(chars +' / 255 znaków');
    });

    $('#pl_title_pl').on('keyup propertychange paste', function(){
        var chars = $('#pl_title_pl').val().length;
        $('#counter_pl_title_pol').html(chars +' / 255 znaków');
    });

function change_counter(count)
{
    var interval = window.setInterval(function() {}, 10);

}
//onkeyup = '(counter_name_position("+newnount+"))'
function counter_name_position_pl(count)
{
    var chars = $('#name_position_pl'+count).val().length;
    $("#counter_name_position_pl"+count).html(chars +" / 255 znaków");
}

function counter_desc_position_pl(count)
{
    var chars = $("#desc_position_pl"+count).val().length;
    $("#counter_desc_position_pl"+count).html(chars +" / 255 znaków");
}


function counter_name_position_en(count)
{
    var chars = $('#name_position_en'+count).val().length;
    $("#counter_name_position_en"+count).html(chars +" / 255 znaków");
}

function counter_desc_position_en(count)
{
    var chars = $("#desc_position_en"+count).val().length;
    $("#counter_desc_position_en"+count).html(chars +" / 255 znaków");
}


function counter_name_position_pl_pol(count)
{
    var chars = $('#name_position_pl_pol'+count).val().length;
    $("#counter_name_position_pl_pol"+count).html(chars +" / 255 znaków");
}

function counter_desc_position_pl_pol(count)
{
    var chars = $("#desc_position_pl_pol"+count).val().length;
    $("#counter_desc_position_pl_pol"+count).html(chars +" / 255 znaków");
}
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






