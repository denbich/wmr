@extends('layouts.app')

@section('title')
{{ __('Lista') }}
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
            <li class="nav-item active">
                <a class="nav-link active" href="#volunteer" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="volunteer">
                  <i class="fas fa-user text-primary"></i>
                  <span class="nav-link-text">Wolontariusz</span>
                </a>
                <div class="collapse show" id="volunteer">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                      <a href="{{ route('c.v.search') }}" class="nav-link">
                        <span class="sidenav-normal"> Wyszukaj </span>
                      </a>
                    </li>
                    <li class="nav-item active">
                      <a href="{{ route('c.v.list') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('c.v.active') }}" class="nav-link">
                        <span class="sidenav-normal"> Aktywuj </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('c.v.birthday') }}" class="nav-link">
                        <span class="sidenav-normal"> Urodziny </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
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
              <h6 class="h2 text-white d-inline-block mb-0">Lista wolontariuszy</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Wolontariusz</li>
                  <li class="breadcrumb-item"><a href="{{ route('c.v.list') }}">Lista</a></li>
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
                    <h3 class="mb-0">Lista wolontariuszy </h3>
                  </div>
                  <div class="col-4 text-right">
                    <a href="#generatemodal" data-toggle="modal" data-target="#generatemodal" class="btn btn-sm btn-primary"><i class="fas fa-clipboard-list"></i> Generuj listę</a>
                    <a href="#resetpointsmodal" data-toggle="modal" data-target="#resetpointsmodal" class="btn btn-sm btn-primary"><i class="fas fa-times-circle"></i> Resetuj punkty</a>
                  </div>
                </div>
              </div>
                <div class="card-body">
                  <form action="" method="post">
                      <div class="form-group d-none">
                        <select class="input-group-alternative form-control" name="" id="">
                            <option value="">Generuj listę PDF</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                      <table class="table align-items-center table-flush">
                          <thead class="thead-light">
                              <tr>
                                  <!--<th><input type="checkbox" name="" id="checkAll"></th>-->
                                  <th scope="col" class="sort" data-sort="name">Login</th>
                                  <th scope="col" class="sort" data-sort="firstlastname">Imię i nazwisko</th>
                                  <th scope="col">Numer tel.</th>
                                  <th scope="col">Adres email</th>
                                  <th scope="col" class="sort" data-sort="completion">Punkty</th>
                                  <th scope="col">Opcje</th>
                              </tr>
                          </thead>
                          <tbody class="list">
                              @forelse ($volunteers as $volunteer)
                                  <tr>
                                      <!--<th><input type="checkbox" name="" id=""></th>-->
                                      <th scope="row">
                                          <div class="media align-items-center">
                                              <a href="{{ route('c.v.volunteer', [$volunteer->id]) }}" class="avatar rounded-circle mr-3">
                                              <img alt="Image placeholder" src="{{ $volunteer->user->photo_src }}">
                                              </a>
                                              <div class="media-body">
                                                  <span class="name mb-0 text-sm">{{ $volunteer->user->name }}</span>
                                              </div>
                                          </div>
                                      </th>
                                      <td>{{ $volunteer->user->firstname }} {{ $volunteer->user->lastname }}</td>
                                      <td>{{ $volunteer->user->telephone }}</td>
                                      <td>
                                          <a href="mailto:{{ $volunteer->user->email }}">{{ $volunteer->user->email }}</a>
                                      </td>
                                      <td>
                                          <div class="d-flex align-items-center">
                                              <span class="completion mr-2">{{ $volunteer->points }}</span>
                                          </div>
                                      </td>
                                      <td class="text-center">
                                          <a href="{{ route('c.v.volunteer', [$volunteer->id]) }}">
                                              <i class="fas fa-search"></i>
                                          </a>
                                      </td>
                                  </tr>
                              @empty
                                  <h2 class="text-center text-danger">Brak wolontariuszy!</h2>
                              @endforelse
                          </tbody>
                      </table>
                  </div>
                  </form>
                </div>
            </div>

        @yield('coordinator.include.footer')
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
        <form action="{{ route('c.v.exportlist') }}" method="post">
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

  <div class="modal fade" id="resetpointsmodal" tabindex="-1" role="dialog" aria-labelledby="resetpointsmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="resetpointsmodalLabel">Resetuj punkty</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pt-1">
          <div id="resetpoints-header">
            <h2 class="text-center">Czy jesteś pewien, że chcesz zresetować wszystkim wolontariuszom punkty?</h2>
            <h4 class="text-center text-danger">Tego procesu nie da się cofnąć!</h4>
          </div>

          <div id="resetpoints-progresbar" class="d-none">
            <h2 class="text-center">Trwa resetowanie punktów</h2>
            <h4 class="text-center text-danger">Nie zamykaj okna przeglądarki!</h4>
            <div class="text-center" id="pointprecent">0%</div>
            <div class="progress-wrapper">
                <div class="progress">
                  <div class="progress-bar bg-primary" id="pointprogresbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                </div>
              </div>
              <p class="text-sm text-center">Gdy proces się zakończy strona odświeży się automatycznie</p>
          </div>

        </div>
        <div class="modal-footer" id="modalreset-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          <button id="btn-reset-points" class="btn btn-danger">Resetuj</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script src="/assets/vendor/list.js/dist/list.min.js"></script>

<script>
  $(document).ready(function() {
    $("#checkAll").click(function() {
    $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
  });

  $("input[type=checkbox]").click(function() {
    if (!$(this).prop("checked")) {
      $("#checkAll").prop("checked", false);
    }
  });
});
</script>

<script>


    $('#btn-reset-points').click(function () {
        $('#resetpoints-header').addClass('d-none');
        $('#modalreset-footer').addClass('d-none');
        $('#resetpoints-progresbar').removeClass('d-none');

        var vcount = {{ count($volunteers) }};
        var precentpoint = 100 / vcount;
        var precent = 0;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        for (var i = 1; i <= vcount; i++) {
            precent = precent + precentpoint;
            $.ajax({
                url: '{{ route("c.v.reset_points") }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, vid: i},
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $("#pointprogresbar").css({ width: precent+'%' });
                    $('#pointprecent').html(Math.floor(precent)+"%");
                }
            });
        }
});
</script>
@endsection
