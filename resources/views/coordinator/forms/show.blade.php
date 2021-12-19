@extends('layouts.app')

@section('title')
{{ __('Formularz') }}
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
                      <a class="nav-link active" href="{{ route('c.form.list') }}">
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
              <h6 class="h2 text-white d-inline-block mb-0">{{ $form->form_translate->title }}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="{{ route('c.form.list') }}">Formularze</a></li>
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
        <div class="row">
            <div class="col-lg-3 order-lg-2">
              <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Opcje</h3>
                    @if ($form->expiration <= date('Y-m-d H:i:s'))
                        @if ($count['z'] > 0)
                            <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#Modalstart">Wznów zapisy</button>
                            <a href="{{ route('c.form.positions', [$form->id]) }}" class="btn btn-primary w-100 my-2">Przydziel stanowiska</a>
                        @else
                            @if ($count['o'] > 0)
                                <a href="{{ route('c.form.positions', [$form->id]) }}" class="btn btn-primary w-100 my-2">Przydziel stanowiska</a>
                                <a href="{{ route('c.form.presence', [$form->id]) }}" class="btn btn-primary w-100 my-2">Przydziel obecność</a>
                                <a href="{{ route('c.form.sign', [$form->id]) }}" class="btn btn-primary w-100 my-2">Zapisz obecność (BETA)</a>
                            @else
                            <a href="{{ route('c.form.viewpresence', [$form->id]) }}" class="btn btn-primary w-100 my-2">Sprawdź obecność</a>
                            @endif
                        @endif
                    @else
                            <button type="submit" class="btn btn-success w-100 my-2" data-toggle="modal" data-target="#stopmodal">Zakończ zapisy</button>
                    @endif
                    <hr class="my-2">
                    <a href="{{ route('c.post.create') }}" class="btn btn-primary w-100 my-2">Utwórz post</a>
                    <button class="btn btn-primary w-100 my-2" data-toggle="modal" data-target="#idmodal" >Generator identyfikatorów</button>
                    <a href="#generatemodal" data-toggle="modal" data-target="#generatemodal" class="btn btn-primary w-100 my-2">Generuj listę wolontariuszy</a>
                    <hr class="my-2">
                    <a href="{{ url('/coordinator/forms', [$form->id, 'edit']) }}" class="btn btn-success w-100 my-2 text-white">Edytuj formularz</a>
                    <button class="btn btn-danger w-100 my-2" data-toggle="modal" data-target="#deletemodal">Usuń formularz</button>
                </div>
              </div>
            </div>
            <div class="col-lg-9 h-100 order-lg-1">
              <div class="card">
                <div class="card-header">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h3 class="mb-0">Podstawowe informacje </h3>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <div id="alerts">
                        @error('end')
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>Błąd!</strong> {{ $message }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @enderror
                    @if (session('succes_start'))
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-text"><strong>Sukces!</strong> Zapisy zostały wznowione!</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (session('succes_stop'))
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-text"><strong>Sukces!</strong> Zapisy zostały zakończone!</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (session('succes_presence'))
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-text"><strong>Sukces!</strong> Obecność została zapisana!</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    </div>
                    <div class="row pt-2">
                        <div class="col-md-3 w-100">
                            <img src="{{ $form->icon_src }}" alt="" class="w-100">
                        </div>
                        <div class="col-md-4">
                            <h4>Opis stanowisk:</h4>
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
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Lista stanowisk </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">Nazwa stanowiska</th>
                                <th scope="col">Ilość punktów</th>
                                <th scope="col">Zapotrzebowanie</th>
                                <th scope="col">Ilość zapisanych</th>
                            </tr>
                        </thead>
                        <tbody class="list text-center">
                            @foreach ($form_positions as $position)
                            <tr>
                                <td>{{ $position->translate_form_position->title }}</td>
                                <td>{{ $position->points }}</td>
                                <td>{{ $position->max_volunteer }}</td>
                                <td>{{ $position->signed_form_count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Lista zapisanych wolontariuszy </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                @if (count($signed_volunteers) > 0)
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">Login</th>
                                    <th scope="col">Imię</th>
                                    <th scope="col">Nazwisko</th>
                                    <th scope="col">Numer telefonu</th>
                                    <th scope="col">Stanowisko</th>
                                </tr>
                            </thead>
                            <tbody class="list text-center">
                                @foreach ($signed_volunteers as $volunteer)
                                <tr>
                                    <td>{{ $volunteer->volunteer->name }}</td>
                                    <td>{{ $volunteer->volunteer->firstname }}</td>
                                    <td>{{ $volunteer->volunteer->lastname }}</td>
                                    <td>{{ $volunteer->volunteer->telephone }}</td>
                                    <td>{{ $volunteer->position->title }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h1 class="text-danger w-100 text-center">Żaden z wolontariuszy nie zapisał się!</h1>
                @endif
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Miejsce imprezy </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div id="map" style="width: 100%; height: 500px"></div>
            </div>
          </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

  <div class="modal fade" id="Modalstart" tabindex="-1" role="dialog" aria-labelledby="startModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <form action="{{ route('c.form.startsign', [$form->id]) }}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="startModalLabel">Wznów zapisy</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <label for="end">Wybierz datę do kiedy mają trwać zapisy</label>
                <div class="input-group input-group-merge input-group-alternative mb-3">
                    <input type="datetime-local" id="end" class="form-control" name="end" required>
                  </div>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          <button type="submit" class="btn btn-primary">Zatwierdź</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="stopmodal" tabindex="-1" role="dialog" aria-labelledby="stopModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="stopModalLabel">Kończenie zapisów</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h3 class="w-100 text-wrap text-center">Czy jesteś pewnien, że chcesz zakończyć zapisy?</h3>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
          <form action="{{ url('/coordinator/forms/stop-sign', [$form->id]) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-danger">Zakończ</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Usuń formularz</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h3 class="w-100 text-wrap text-center">Czy jesteś pewnien, że chcesz usunąć formularz "{{ $form->form_translate->title  }}"?</h3>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
          <form action="{{ url('/coordinator/forms', [$form->id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Usuń</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="idmodal" tabindex="-1" role="dialog" aria-labelledby="idModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <form action="{{ route('c.form.id', [$form->id]) }}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="idModalLabel">Generuj indentyfikatory - BETA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pt-0">
            <div class="form-group">
                <h2 class="text-center">Motyw</h3>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="themelight" name="theme" value="l" class="custom-control-input" checked>
                            <label class="custom-control-label" for="themelight">Jasny</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="themedark" name="theme" value="d" class="custom-control-input" disabled>
                            <label class="custom-control-label" for="themedark">Ciemny</label>
                          </div>
                    </div>

                  <h2 class="text-center">Logo</h3>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="logowmr" class="custom-control-input" id="logowmr" checked disabled>
                            <label class="custom-control-label" for="logowmr">Logo WMR</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="logomosir" class="custom-control-input" id="logomosir" checked disabled>
                            <label class="custom-control-label" for="logomosir">Logo MOSiR</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="logocustom" class="custom-control-input" id="logocustom" disabled>
                            <label class="custom-control-label" for="logocustom">Dodatkowe logo</label>
                          </div>
                    </div>
                    <h2 class="text-center">Kod QR</h2>
                    <div class="form-group">
                        <label class="custom-toggle">
                            <input type="checkbox" name="qr" checked disabled>
                            <span class="custom-toggle-slider rounded-circle" data-label-off="Nie" data-label-on="Tak"></span>
                        </label>
                    </div>
                    <h2 class="text-center">Inne opcje</h3>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="showlogin" class="custom-control-input" id="showlogin" disabled>
                                <label class="custom-control-label" for="showlogin">Pokaż login</label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="showid" class="custom-control-input" id="showid" disabled>
                                <label class="custom-control-label" for="showid">Pokaż ID</label>
                              </div>
                        </div>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          <button type="submit" class="btn btn-primary">Generuj</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="generatemodal" tabindex="-1" role="dialog" aria-labelledby="generatemodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="generatemodalLabel">Generuj listę wolontariuszy</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('c.form.volunteers', [$form->id]) }}" method="post">
        <div class="modal-body pt-1">
          <h2 class="text-center mb-5">Wybierz typ pliku</h2>
              @csrf
              <div class="form-group">
                  <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="pdftype" name="filetype" value="pdf" class="custom-control-input" checked>
                        <label class="custom-control-label" for="pdftype">Plik PDF (.pdf)</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="exceltype" name="filetype" value="excel" class="custom-control-input">
                        <label class="custom-control-label" for="exceltype">Excel (.xlsx)</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="htmltype" name="filetype" value="html" class="custom-control-input">
                        <label class="custom-control-label" for="htmltype">HTML (.html)</label>
                      </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          <button type="submit" class="btn btn-primary">Generuj</button>
        </div>
        </form>
      </div>
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

@endsection






