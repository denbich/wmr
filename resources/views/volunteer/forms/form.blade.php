@extends('layouts.app')

@section('title')
{{ __('lista formularzy') }}
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
            <li class="nav-item">
              <a class="nav-link" href="{{ route('v.dashboard') }}">
                <i class="ni ni-tv-2 "></i>
                <span class="nav-link-text">Panel</span>
              </a>
            </li>
        </ul>
        <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Ogólne</span>
        </h6>
          <ul class="navbar-nav">
            @include('volunteer.include.chat')
            @include('volunteer.include.posts')
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('v.form.list') }}">
                    <i class="fas fa-clipboard-list text-primary"></i>
                    <span class="nav-link-text">Formularze</span>
                </a>
            </li>

            @include('volunteer.include.prizes')

          </ul>

          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Inne</span>
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
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('v.form.list') }}">Formularze</a></li>
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
                  <h3 class="mb-0">Podstawowe informacje </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                @if(session('signed_form') == true)
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>Sukces!</strong> Zapisanie się przebiegło pomyślnie!</span>
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
                            <span class="alert-text"><strong>Sukces!</strong> Wypisanie się przebiegło pomyślnie!</span>
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

          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Zapisz się </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                @if ($form->expiration <= date('Y-m-d H:i:s'))
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="alert alert-danger text-center" role="alert">
                            <span class="alert-icon"><i class="far fa-frown"></i></span>
                            <span class="alert-text"><strong>Alert!</strong> Zapisy zostały zamknięte!</span>
                        </div>
                    </div>
                </div>
                @else
                    @if ($signed_volunteer == null)
                        <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">Nazwa stanowiska</th>
                                    <th scope="col">Ilość punktów</th>
                                    <th scope="col">Zapotrzebowanie</th>
                                    <th scope="col">Ilość zapisanych</th>
                                    <th>Opcje</th>
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
                                            <button class="btn btn-primary">Zapisz się</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        @switch($signed_volunteer->condition)
                            @case(0)
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="text-center">
                                        <span class="h2"><strong>Zapisałeś się na stanowisko:</strong> {{ $signed_volunteer->trans_position->title }}</span>
                                        <p><b>Otrzymasz tyle punktów*: </b>{{ $signed_volunteer->post_form->points }}</p>
                                        <p>Czekaj na wiadomość o przydzieleniu stanowiska (dostaniesz maila lub sprawdzaj co jakiś czas).</p>
                                        <p class="text-sm">* - Jeśli będziesz uczestniczyć w tej akcji.</p>
                                    </div>
                                    <form action="{{ route('v.form.unsign', [$form->id]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="position" value="{{ $signed_volunteer->id }}">
                                        <button type="submit" class="btn btn-danger w-100">Wypisz się</button>
                                    </form>
                                </div>
                            </div>
                                @break

                            @case(1)
                                <div class="text-center">
                                    <h1 class="text-success">Stanowiska zostały przydzielone przez koordynatora</h1>
                                    <span class="h3"> 
                                        @if (Auth::user()->gender == 'm')
                                            <b>Zostałeś przydzielony na stanowisko:</b>
                                        @elseif (Auth::user()->gender == 'f')
                                            <b>Zostałaś przydzielony na stanowisko:</b>
                                        @endif
                                        {{ $signed_volunteer->trans_position->title }}
                                    </span>
                                    <p><b>Otrzymasz tyle punktów*: </b>{{ $signed_volunteer->post_form->points }}</p>
                                    <p class="text-sm">* - Jeśli będziesz uczestniczyć w tej akcji.</p>
                                </div>
                                @break

                            @case(2)
                                <div class="text-center">
                                    @if (Auth::user()->gender == 'm')
                                        <h2>Dziękujemy za twoją obecność!</h2>
                                        <h3 class="text-success">Otrzymałeś punkty za tą akcję!</h3>
                                    @elseif (Auth::user()->gender == 'f')
                                        <h2>Dziękujemy za twoją obecność!</h2>
                                        <h3 class="text-success">Otrzymałaś punkty za tą akcję!</h3>
                                    @endif
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <form action="{{ route('v.form.certificate') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="form" value="{{ $form->id }}">
                                            <button type="submit" class="btn btn-primary w-100">Generuj zaświadczenie</button>
                                        </form>
                                    </div>
                                </div>
                                @break

                            @case(3)
                                <div class="text-center">
                                    @if (Auth::user()->gender == 'm')
                                        <h2 class="text-danger">Nie byłeś obecny, więc nie otrzymasz punktów :(</h2>
                                        <p>Jeśli jednak uczesticzyłeś, to zgłoś ten fakt koordynatorowi bądź administratorowi!</p>
                                    @elseif (Auth::user()->gender == 'f')
                                        <h2 class="text-danger">Nie byłaś obecna, więc nie otrzymasz punktów :(</h2>
                                        <p>Jeśli jednak uczesticzyłaś, to zgłoś ten fakt koordynatorowi bądź administratorowi!</p>
                                    @endif
                                </div>
                                @break
                            
                                
                        @endswitch
                    @endif
                
                @endif
            </div>
          </div>


        @include('volunteer.include.footer')
      </div>
  </div>

@endsection
