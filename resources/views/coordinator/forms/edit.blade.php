@extends('layouts.app')

@section('title')
{{ __('Edycja formularza') }}
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
                    <li class="nav-item active">
                      <a class="nav-link" href="{{ route('c.form.list') }}">
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
              <h6 class="h2 text-white d-inline-block mb-0">Edycja formularza</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="{{ route('c.form.list') }}">Formularze</a></li>
                  <li class="breadcrumb-item">edycja</li>
                  <li class="breadcrumb-item active">{{ $form->id }}</li>
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
                    <h3 class="mb-0">Edycja formularza </h3>
                  </div>
                </div>
              </div>
                <div class="card-body">
                    @if (session('edit_form') == true)
                    @php session()->forget('edit_form'); @endphp
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-text"><strong>Sukces!</strong> Edycja formularza przebiegła pomyślnie!</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    <form action="{{ route('c.form.update', [$form->id]) }}" method="post" role="form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="locale" value="pl">
                        <input type="hidden" name="positions_number" value="{{ count($form_positions) }}">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="required" for="title">Tytuł</label>
                                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" maxlength="255" type="text" name="title" id="title" value="{{ $form->form_translate->title }}" required>
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
                                    <hr>
                                    <h2 class="w-100 text-center">Daty</h2>
                                    <div class="form-group px-4">
                                        <label for="start">Data rozpoczęcia imprezy</label>
                                        <input class="form-control" type="datetime-local" name="start" id="start" value="{{strftime('%Y-%m-%dT%H:%M:%S', strtotime($form->calendar->start)) }}" required>
                                        @if($errors->has('start'))
                                            <div class="text-danger w-100 d-block">
                                                {{ $errors->first('start') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group px-4">
                                        <label for="stop">Data zakończenia imprezy</label>
                                        <input class="form-control" type="datetime-local" name="stop" id="stop" value="{{strftime('%Y-%m-%dT%H:%M:%S', strtotime($form->calendar->end)) }}" required>
                                        @if($errors->has('stop'))
                                            <div class="text-danger w-100 d-block">
                                                {{ $errors->first('stop') }}
                                            </div>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <h2 class="w-100 text-center">Miejsce imprezy</h2>
                                        <input type="hidden" name="place_longitude" value="{{ $form->place_longitude }}">
                                        <input type="hidden" name="place_latitude" value="{{ $form->place_latitude }}">
                                      <div id="map" style="width: 100%; height: 350px;"></div>
                                    </div>
                                    <hr>
                                    <div>
                                    <h2 class="w-100 text-center">Stanowiska</h2>
                                    @foreach ($form_positions as $position)
                                            <input type="hidden" name="position_{{ $loop->iteration }}" value="{{ $position->id }}">
                                            <div class="form-group">
                                                <label for="name_position{{ $loop->iteration }}" class="mt-1">Nazwa stanowiska {{ $loop->iteration }}:</label>
                                                <input type="text" class="form-control {{ $errors->has('name_position'.$loop->iteration) ? 'is-invalid' : '' }}" maxlength="255" id="name_position{{ $loop->iteration }}" name="name_position{{ $loop->iteration }}" onkeyup="(counter_name_position({{ $loop->iteration }}))" value="{{ $position->translate_form_position->title }}" required>
                                                <p id="counter_name_position{{ $loop->iteration }}" class="text-sm">0 / 255 znaków</p>
                                                @if($errors->has('name_position'.$loop->iteration))
                                                    <div class="text-danger w-100 d-block">
                                                        {{ $errors->first('name_position'.$loop->iteration) }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="desc_position{{ $loop->iteration }}">Opis stanowiska:</label>
                                                <textarea class="form-control mt-1 {{ $errors->has('desc_position'.$loop->iteration) ? 'is-invalid' : '' }}" rows="3" maxlength="255" id="desc_position{{ $loop->iteration }}" style="resize: none;" name="desc_position{{ $loop->iteration }}" onkeyup="(counter_desc_position({{ $loop->iteration }}))" required>{{ $position->translate_form_position->description }}</textarea>
                                                <p id="counter_desc_position{{ $loop->iteration }}" class="text-sm">0 / 255 znaków</p>
                                                @if($errors->has('desc_position'.$loop->iteration))
                                                    <div class="text-danger w-100 d-block">
                                                        {{ $errors->first('desc_position'.$loop->iteration) }}
                                                    </div>
                                                @endif
                                            </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="points_position{{ $loop->iteration }}">Wartość punktowa:</label>
                                                            <input type="number" class="form-control" id="points_position{{ $loop->iteration }}" name="points_position{{ $loop->iteration }}" value="{{ $position->points }}" required>
                                                            @if($errors->has('points_position'.$loop->iteration))
                                                                <div class="text-danger w-100 d-block">
                                                                    {{ $errors->first('points_position'.$loop->iteration) }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="max_position{{ $loop->iteration }}">Max. ilość wolontariuszy:</label>
                                                            <input type="number" class="form-control" id="max_position{{ $loop->iteration }}" name="max_position{{ $loop->iteration }}" value="{{ $position->max_volunteer }}" required>
                                                            @if($errors->has('max_position'.$loop->iteration))
                                                                <div class="text-danger w-100 d-block">
                                                                    {{ $errors->first('max_position'.$loop->iteration) }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                    @endforeach
                                </div>
                                    <button type="submit" class="btn btn-primary w-100">Zaaktualizuj formularz</button>
                                </div>
                            </div>
                        <div class="form-group"></div>

                    </form>
                </div>
            </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

@endsection

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cABC" async defer></script>

<script>
    "use strict";

  function initMap() {
    var myLatlng = new google.maps.LatLng({!! $form->place_longitude !!}, {!! $form->place_latitude !!});
  var mapOptions = {
      zoom: 13,
      center: myLatlng,
      mapTypeControl: false,
      fullscreenControl: false,
      zoomControl: true,
      streetViewControl: false
  }
  var map = new google.maps.Map(document.getElementById("map"), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      draggable:true,
  });

  window.setInterval(function() {
      $("[name='place_longitude']").val(marker.getPosition().lat());
      $("[name='place_latitude']").val(marker.getPosition().lng());
  }, 5);
  }

  </script>

<script>

    var chars = $('#title').val().length;
    $('#counter_title').html(chars +' / 255 znaków');
    $(document).ready(function() {
            $('#title').on('keyup propertychange paste', function(){
            var chars = $('#title').val().length;
            $('#counter_title').html(chars +' / 255 znaków');
        });
    });

    for (var i = 1; i <= {{ count($form_positions) }}; i++)
    {
        var chars = $('#name_position'+i).val().length;
        $("#counter_name_position"+i).html(chars +" / 255 znaków");

        var chars = $("#desc_position"+i).val().length;
        $("#counter_desc_position"+i).html(chars +" / 255 znaków");
    }

    function counter_name_position(count)
    {
        var chars = $('#name_position'+count).val().length;
        $("#counter_name_position"+count).html(chars +" / 255 znaków");
    }

    function counter_desc_position(count)
    {
        var chars = $("#desc_position"+count).val().length;
        $("#counter_desc_position"+count).html(chars +" / 255 znaków");
    }
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
        editor.setContent("{!!str_replace('"', "'", str_replace(PHP_EOL, '', $form->form_translate->description)) !!}");
      });
    }
    });

  </script>


@endsection







