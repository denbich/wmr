@extends('layouts.app')

@section('title')
{{ __('volunteer.sidebar.forms') }}
@endsection

@section('content')

<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <div class="sidenav-header mt-2 align-items-center w-100">
        <a class="mt-2" href="{{ route('v.dashboard') }}">
          <img src="/img/logo-wmr2.svg" class="h-100" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          @include('volunteer.include.dashboard')
        </ul>
        <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">{{ __('volunteer.sidebar.general') }}</span>
        </h6>
          <ul class="navbar-nav">
            @include('volunteer.include.chat')
            @include('volunteer.include.posts')
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('v.form.list') }}">
                    <i class="fas fa-clipboard-list text-primary"></i>
                    <span class="nav-link-text">{{ __('volunteer.sidebar.forms') }}</span>
                </a>
            </li>
            @include('volunteer.include.prizes')
          </ul>

          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">{{ __('volunteer.sidebar.other') }}</span>
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
                <h6 class="h2 text-white d-inline-block mb-0">{{ $form->form_translate->title }}</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('v.form.list') }}">{{ __('volunteer.sidebar.forms') }}</a></li>
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
                  <h3 class="mb-0">{{ __('volunteer.form.form.main') }}</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                @if(session('signed_form') == true)
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>{{ __('main.success') }}!</strong> {{ __('volunteer.form.form.info1') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                @if(session('delete_sign') == true)
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>{{ __('main.success') }}!</strong> {{ __('volunteer.form.form.info2') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                <h2 class="text-center">{{ date("d.m.Y H:i", strtotime($form->calendar->start)) }} - {{ date("d.m.Y H:i", strtotime($form->calendar->end)) }}</h2>
                <div class="row pt-2">
                    <div class="col-md-3 w-100">
                        <img src="{{ $form->icon_src }}" alt="" class="w-100">
                    </div>
                    <div class="col-md-4">
                        <h4>{{ __('volunteer.form.form.d-positions') }}:</h4>
                        @foreach ($form_positions as $position)

                        <p><b>{{ $position->translate_form_position->title }}:</b><br>{{ $position->translate_form_position->description }}</p>

                        @endforeach
                    </div>
                    <div class="col-md-5">
                        {!! $form->form_translate->description !!}
                    </div>
                </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0"> @if ($signed_volunteer == null) {{ __('volunteer.form.form.title1') }} @else {{ __('volunteer.form.form.title2') }} @endif </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                @if ($signed_volunteer == null)
                 @if ($form->expiration <= date('Y-m-d H:i:s'))
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="alert alert-danger text-center" role="alert">
                                <span class="alert-icon"><i class="far fa-frown"></i></span>
                                <span class="alert-text"><strong>{{ __('main.alert') }}!</strong> {{ __('volunteer.form.form.sign.alert') }} </span>
                            </div>
                        </div>
                    </div>
                 @else
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">{{ __('volunteer.form.form.positions.name') }}</th>
                                    <th scope="col">{{ __('volunteer.form.form.positions.points') }}</th>
                                    <th scope="col">{{ __('volunteer.form.form.positions.demand') }}</th>
                                    <th scope="col">{{ __('volunteer.form.form.positions.count') }}</th>
                                    <th>{{ __('volunteer.form.form.positions.options') }}</th>
                                </tr>
                            </thead>
                            <tbody class="list text-center">
                                @foreach ($form_positions as $position)
                                <tr>
                                    <td>{{ $position->translate_form_position->title }}</td>
                                    <td>{{ $position->points }}</td>
                                    <td>{{ $position->max_volunteer }}</td>
                                    <td>{{ $position->signed_form_count }}</td>
                                    <td>
                                        <form action="{{ route('v.form.show', [$form->id]) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="position" value="{{ $position->id }}">
                                            <button class="btn btn-primary">{{ __('volunteer.form.form.positions.button') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                 @endif
                @else
                @switch($signed_volunteer->condition)
                    @case(0)
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="text-center">
                                <span class="h2"><strong>{{ __('volunteer.form.form.sign.0.text1') }}:</strong> {{ $signed_volunteer->trans_position->title }}</span>
                                <p><b>{{ __('volunteer.form.form.sign.0.text2') }}*: </b>{{ $signed_volunteer->post_form->points }}</p>
                                <p>{{ __('volunteer.form.form.sign.0.text3') }}</p>
                                <p class="text-sm">* - {{ __('volunteer.form.form.sign.0.text4') }}</p>
                            </div>
                            @if ($form->expiration > date('Y-m-d H:i'))
                            <form action="{{ route('v.form.unsign', [$form->id]) }}" method="post">
                                @csrf
                                <input type="hidden" name="position" value="{{ $signed_volunteer->id }}">
                                <button type="submit" class="btn btn-danger w-100">{{ __('volunteer.form.form.sign.0.button') }}</button>
                            </form>
                            @endif
                        </div>
                    </div>
                        @break

                    @case(1)
                        <div class="text-center">
                            <h1 class="text-success">{{ __('volunteer.form.form.sign.1.header') }}</h1>
                            <span class="h3">
                                @if (Auth::user()->gender == 'm')
                                    <b>{{ __('volunteer.form.form.sign.1.text-m') }}:</b>
                                @elseif (Auth::user()->gender == 'f')
                                    <b>{{ __('volunteer.form.form.sign.1.text-f') }}:</b>
                                @endif
                                {{ $signed_volunteer->trans_position->title }}
                            </span>
                            <p><b>{{ __('volunteer.form.form.sign.1.text1') }}*: </b>{{ $signed_volunteer->post_form->points }}</p>
                            <p class="text-sm">* - {{ __('volunteer.form.form.sign.1.text2') }}</p>
                        </div>
                        @break

                    @case(2)
                        <div class="text-center">
                            @if (Auth::user()->gender == 'm')
                                <h2 class="text-danger">{{ __('volunteer.form.form.sign.2.header-m') }} :(</h2>
                                <p>{{ __('volunteer.form.form.sign.2.text-m') }}</p>
                            @elseif (Auth::user()->gender == 'f')
                                <h2 class="text-danger">{{ __('volunteer.form.form.sign.2.header-f') }} :(</h2>
                                <p>{{ __('volunteer.form.form.sign.2.text-f') }}</p>
                            @endif
                        </div>
                        @break

                    @case(3)
                    @if(session('feedback') == true)
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-text"><strong>{{ __('main.success') }}!</strong> {{ __('volunteer.form.form.sign.3.alert') }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                        <div class="text-center">
                            <h2>{{ __('volunteer.form.form.sign.3.header') }}</h2>
                            @if (Auth::user()->gender == 'm')
                                <h3 class="text-success">{{ __('volunteer.form.form.sign.3.text-m') }}</h3>
                            @elseif (Auth::user()->gender == 'f')
                                <h3 class="text-success">{{ __('volunteer.form.form.sign.3.text-f') }}</h3>
                            @endif

                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <form action="{{ route('v.form.certificate') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="form" value="{{ $form->id }}">
                                    <button type="submit" class="btn btn-primary w-100">{{ __('volunteer.form.form.sign.3.cert') }}</button>
                                </form>
                                @if ($signed_volunteer->feedback == null)
                            <button type="button" class="btn btn-primary my-2 w-100" data-toggle="modal" data-target="#feedbackmodal">
                                {{ __('volunteer.form.form.sign.3.button') }}
                              </button>

                              <div class="modal fade" id="feedbackmodal" tabindex="-1" role="dialog" aria-labelledby="feedbackLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <form action="{{ route('v.form.feedback', [$form->id]) }}" method="post">
                                      @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="feedbackLabel">{{ __('volunteer.form.form.sign.3.modal.title') }} {{ $form->form_translate->title }}</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <h3 class="text-center">{{ __('volunteer.form.form.sign.3.modal.text') }}</h3>
                                          <textarea id="info" class="form-control" style="resize: none;" name="info" cols="50" rows="3" maxlength="255" required></textarea>
                                            <p id="info_count" class="text-sm">0 / 255 {{ __('volunteer.form.form.sign.3.modal.count') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.cancel') }}</button>
                                          <button type="submit" class="btn btn-primary">{{ __('volunteer.form.form.sign.3.modal.send') }}</button>
                                        </div>
                                      </div>
                                  </form>
                                </div>
                              </div>
                            @endif
                            </div>
                        </div>
                        @break
                    @endswitch
                @endif
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">{{ __('volunteer.form.form.map') }}</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div id="map" style="width: 100%; height: 500px"></div>
            </div>
          </div>


        @include('volunteer.include.footer')
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
    draggable:false, });

}
</script>

<script>
    $(document).ready(function() {

        $('#info').on('keyup propertychange paste', function(){
            var chars = $('#info').val().length;
            $('#info_count').html(chars +" / 255 {{ __('volunteer.form.form.sign.3.modal.count') }}");
        });
        });
</script>

@endsection
