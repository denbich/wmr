@extends('layouts.app')

@section('title')
{{ __('Nagroda') }}
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
                    <li class="nav-item active">
                      <a href="{{ route('c.prize.list') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('c.prize.orders') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista zamówień </span>
                      </a>
                    </li>
                    <li class="nav-item">
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
              <h6 class="h2 text-white d-inline-block mb-0"></h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="{{ route('c.prize.list') }}">Nagrody</a></li>
                  <li class="breadcrumb-item active">{{ $prize->id }}</li>
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
        <div class="row">
            <div class="col-lg-3 order-lg-2">
              <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Opcje</h3>
                    <form method="post" action="{{ route('c.prize.updatequantity', [$prize->id]) }}">
                        @csrf
                        <span for="quantity">Zmień ilość:</span>
                        <input type="number" name="quantity" id="quantity" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" required>
                        @if($errors->has('quantity'))
                            <div class="text-danger w-100 d-block">
                                {{ $errors->first('quantity') }}
                            </div>
                        @endif
                        <button class="btn btn-primary w-100 my-2" type="submit">Zmień</button>
                    </form>
                    <hr class="my-2">
                    <a href="{{ url('/coordinator/prizes', [$prize->id, 'edit']) }}" class="btn btn-success w-100 my-2 text-white">Edytuj nagrodę</a>
                    <button class="btn btn-danger w-100 my-2" data-toggle="modal" data-target="#deletemodal">Usuń nagrodę</button>
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
                    @if (session('created_prize') == true)
                        @php session()->forget('created_prize'); @endphp
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text"><strong>Sukces!</strong> Nagroda została utworzona pomyślnie!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('update_quantity') == true)
                        @php session()->forget('update_quantity'); @endphp
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text"><strong>Sukces!</strong> Zmiana ilości dostępnych sztuk przebiegła pomyślnie!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row pt-2">
                        <div class="col-md-5 w-100">
                            <img src="{{ $prize->icon_src }}" alt="" class="w-100">
                        </div>
                        <div class="col-md-7">
                                <h2>{{ $prize->prize_translate->title }}</h2>
                                <h4>Ilość dostępnych sztuk: <b>{{ $prize->quantity }}</b></h4>
                                <h4>Wartość punktowa: <b>{{ $prize->points }}</b></h4>
                                <h4>Ilość wolontariuszy, którzy wybrali tę nagrodę: <b>{{ count($orders) }}</b></h4>
                                <h4><i>Kategoria: <b>{{ $prize->prize_translate->category }}</b></i></h4>
                        </div>
                    </div>
                    <h3>Opis</h3>
                    {!! $prize->prize_translate->description !!}
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Lista zamówień </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                @if (count($orders) > 0)
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">Login</th>
                                    <th scope="col">Imię i nazwisko</th>
                                    <th scope="col">Data zamówienia</th>
                                    <th scope="col">status</th>
                                </tr>
                            </thead>
                            <tbody class="list text-center">
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->volunteer->name }}</td>
                                    <td>{{ $order->volunteer->firstname }} {{ $order->volunteer->lastname }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td> @if ($order->condition == 0) Nieodebrane @else Odebrane @endif </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h1 class="text-danger w-100 text-center">Żaden z wolontariuszy nie złożył zamówienia na tą nagrodę!</h1>
                @endif
            </div>
          </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

  <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Usuń nagrodę</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h3 class="w-100 text-wrap text-center">Czy jesteś pewnien, że chcesz usunąć nagrodę "{{ $prize->prize_translate->title }}"?</h3>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
          <form action="{{ url('/coordinator/prizes', [$prize->id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Usuń</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection






