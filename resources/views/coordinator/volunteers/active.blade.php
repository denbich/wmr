@extends('layouts.app')

@section('title')
{{ __('Aktywuj wolontariuszy') }}
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
                <a class="nav-link" href="#volunteer" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="volunteer">
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
                    <li class="nav-item">
                      <a href="{{ route('c.v.list') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item active">
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
              <h6 class="h2 text-white d-inline-block mb-0">Aktywuj wolontariusza</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page">Wolontariusz</li>
                  <li class="breadcrumb-item active"><a href="{{ route('c.v.search') }}">Aktywuj</a></li>
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
                    <h3 class="mb-0">Lista do aktywacji </h3>
                  </div>
                </div>
              </div>
                <div class="card-body">
                    @if (session('activation') == true)
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>Sukces!</strong> Wolontariusz został aktywowany!</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (session('deactivation') == true)
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>Sukces!</strong> Wolontariusz został odrzucony!</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                    @error('date')
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>Błąd!</strong> {{ $message }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @enderror
                    @if (count($volunteers) > 0)
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Login</th>
                                    <th scope="col">Imię i nazwisko</th>
                                    <th scope="col">Numer tel.</th>
                                    <th scope="col">Adres email</th>
                                    <th scope="col">Zgoda</th>
                                    <th scope="col">Opcje</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($volunteers as $volunteer)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3">
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
                                        <td class="text-center">
                                            @php
                                                $code = substr($volunteer->user->firstname, 0, 1).substr($volunteer->user->lastname, 0, 1).date('dm', strtotime($volunteer->user->created_at)).$volunteer->user->gender.date('dm', strtotime($volunteer->user->agreement_date)).$volunteer->user->id;
                                            @endphp
                                            <a href="{{ route('c.v.agreement', [$code]) }}"><i class="fas fa-search"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="#activemodal{{ $volunteer->id }}" class="text-success" data-toggle="modal" data-target="#activemodal{{ $volunteer->id }}">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                    <div class="modal fade" id="activemodal{{ $volunteer->id }}" tabindex="-1" role="dialog" aria-labelledby="activeModalLabel{{ $volunteer->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title" id="activeModalLabel{{ $volunteer->id }}">Aktywuj wolontariusza</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                            </div>
                                                            <form action="{{ route('c.v.active') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $volunteer->user->id }}">
                                                                <div class="modal-body">
                                                                    <h3>Uzupełnij datę wygaśnięcia zgody:</h3>
                                                                    <div class="form-group">
                                                                        <div class="input-group input-group-merge input-group-alternative">
                                                                            <input type="date" name="date" id="" class="form-control" required>
                                                                        </div>
                                                                      </div>
                                                                      <a href="{{ route('c.v.agreement', [$code]) }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">Zobacz zgodę</a>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                                                                    <button type="submit" class="btn btn-primary">Zatwierdź</button>
                                                                  </div>
                                                            </form>
                                                          </div>
                                                        </div>
                                                      </div>
                                                </div>
                                                <div class="col">
                                                    <a href="#dactivemodal{{ $volunteer->id }}" class="text-danger" data-toggle="modal" data-target="#dactivemodal{{ $volunteer->id }}">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                    <div class="modal fade" id="dactivemodal{{ $volunteer->id }}" tabindex="-1" role="dialog" aria-labelledby="dactiveModalLabel{{ $volunteer->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title" id="dactiveModalLabel{{ $volunteer->id }}">Odrzuć wolontariusza</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                            </div>
                                                            <form action="{{ route('c.v.dactive') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $volunteer->user->id }}">
                                                                <div class="modal-body">
                                                                    <h3>Wybierz powód odrzucenia:</h3>
                                                                    <div class="form-group">
                                                                        <div class="input-group input-group-merge input-group-alternative">
                                                                            <select name="reason" id="" class="form-control">
                                                                                <option value="1">Brak przedziału od kiedy można wykonywać wolontariat</option>
                                                                                <option value="2">Wysłany plik to nie jest wypełniona zgoda</option>
                                                                                <option value="3">Zgoda jest niewyraźna</option>
                                                                                <option value="4">Brak podpisu rodzica/opiekuna prawnego</option>
                                                                                <option value="5">Źle wypełniona zgoda</option>

                                                                            </select>
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
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </div>
                    @else
                    <h1 class="text-center text-danger">Brak wolontariuszy do aktywowania!</h1>
                    @endif
                </div>
            </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

@endsection


