@extends('layouts.app')

@section('title')
{{ __('volunteer.prizes.prize.title') }}
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
            @include('volunteer.include.forms')

            <li class="nav-item">
                <a class="nav-link collapsed active" href="#prizes" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="prizes">
                  <i class="fas fa-award text-primary"></i>
                  <span class="nav-link-text">{{ __('volunteer.sidebar.prizes.prizes') }}</span>
                </a>
                <div class="collapse show" id="prizes">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item active">
                      <a href="{{ route('v.prize.list') }}" class="nav-link">
                        <span class="sidenav-normal"> {{ __('volunteer.sidebar.prizes.list') }} </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('v.prize.orders') }}" class="nav-link">
                        <span class="sidenav-normal"> {{ __('volunteer.sidebar.prizes.orders') }} </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
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
                <h6 class="h2 text-white d-inline-block mb-0">{{ __('volunteer.prizes.prize.title') }}</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ __('volunteer.sidebar.prizes.prizes') }}</li>
                    <li class="breadcrumb-item active">{{ $prize->id }}</li>
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
                  <h3 class="mb-0">{{ __('volunteer.prizes.prize.basic') }}</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div>
                    @if (session('order') == true)
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>{{ __('main.success') }}!</strong> {{ __('volunteer.prizes.prize.alert') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (session('points_order') == true)
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>{{ __('main.error') }}!</strong> {{ __('volunteer.prizes.prize.err1') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    @endif
                    @if($errors->has('info'))
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-text"><strong>{{ __('main.error') }}!</strong> {{ $errors->first('info') }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row pt-2">
                    <div class="col-md-6 w-100">
                        <img src="{{ $prize->icon_src }}" alt="" class="w-100">
                    </div>
                    <div class="col-md-6">
                            <h2 class="w-100 text-center">{{ $prize->prize_translate->title }}</h2>
                            {!! $prize->prize_translate->description !!}
                            <hr class="my-2">
                            <h4>{{ __('volunteer.prizes.prize.count') }}: <b>{{ $prize->quantity }}</b></h4>
                            <h4>{{ __('volunteer.prizes.prize.points') }}: <b>{{ $prize->points }}</b></h4>
                            <h4><i>{{ __('volunteer.prizes.prize.category') }}: <b>{{ $prize->prize_translate->category }}</b></i></h4>
                            <div class="w-100 text-center my-3">
                                @if ($prize->quantity > 0)
                                    @if ($prize->points <= $points)
                                        <b class="text-success">{{ __('volunteer.prizes.prize.text1') }}</b><br>
                                        <button type="button" class="btn btn-primary my-2 mt-3" data-toggle="modal" data-target="#prizemodal">
                                            {{ __('volunteer.prizes.prize.button') }}
                                        </button>
                                            <div class="modal fade" id="prizemodal" tabindex="-1" role="dialog" aria-labelledby="prizemodalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('v.prize.get', [$prize->id]) }}" method="post">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="prizemodalLabel">{{ __('volunteer.prizes.prize.modal.title') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <p>{{ __('volunteer.prizes.prize.modal.name') }}: <b>{{ $prize->prize_translate->title }}</b></p>
                                                                <p>{{ __('volunteer.prizes.prize.modal.points') }}: <b>{{ $points - $prize->points }}</b></p>
                                                                <label for="info">{{ __('volunteer.prizes.prize.modal.info') }}</label>
                                                                <textarea id="info" class="form-control" style="resize: none;" name="info" cols="50" rows="3" maxlength="255"></textarea>
                                                                <p id="info_count" class="text-sm">0 / 255 {{ __('volunteer.prizes.prize.modal.char') }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.cancel') }}</button>
                                                                <button type="submit" class="btn btn-primary">{{ __('volunteer.prizes.prize.modal.collect') }}</button>
                                                            </div>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>

                                    @else
                                    <b class="text-danger">{{ __('volunteer.prizes.prize.text2') }}</b>
                                    @endif
                                @else
                                    <b class="text-danger">{{ __('volunteer.prizes.prize.text3') }}</b>
                                @endif
                            </div>

                            <hr class="my-2">
                            <p class="w-100 text-center">{{ __('volunteer.prizes.prize.info') }}</p>
                    </div>
                </div>
            </div>
          </div>

        @include('volunteer.include.footer')
      </div>
  </div>

@endsection

@section('script')
@if ($prize->quantity > 0 && $prize->points <= $points)

<script>
    $(document).ready(function() {

        $('#info').on('keyup propertychange paste', function(){
            var chars = $('#info').val().length;
            $('#info_count').html(chars +" / 255 {{ __('volunteer.prizes.prize.modal.char') }}");
        });
        });
</script>

@endif
@endsection
