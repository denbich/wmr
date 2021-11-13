@extends('layouts.app')

@section('title')
{{ __('index.login.title') }}
@endsection

@section('body')
class="bg-default"
@endsection

@section('content')

<!-- Navbar -->

  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-5 py-lg-6 pt-lg-7">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">

            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class=""> <!-- row justify-content-center col-lg-5 col-md-7 -->
          <div class="card bg-secondary border-0 mb-0">
            <div class="row">
                <div class="col-lg-6">
                    <div class="zdjecie-login w-100 h-100" style="margin-left:20px;"></div>
                </div>
                <div class="col-lg-6">
                    <div class="card-header bg-transparent text-center">
                        <a href="{{ route('login') }}"><img src="{{ url('/img/mosir-logo1.svg') }}" class="text-center"></a>
                        <div class="mt-2 h2">{{ __('index.password.email.title') }}</div>
                        <div> {{ __('index.password.email.text') }}</div>
                      </div>
                      <div class="card-body pt-lg-3 pb-lg-4 px-lg-5">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                             </div>
                        @endif
                        <form class="user mt-3" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <label for="email">{{ __('index.password.email.email') }}</label>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('index.password.email.button') }}</button>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-user btn-block">{{ __('index.password.email.login') }}</a>
                        </form>
                      </div>
                </div>
            </div>


          </div>
          <div class="row mt-3">
            <div class="col-6">

            </div>
            <div class="col-6 text-right">

            </div>
          </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  @include('auth.footer')

@endsection



