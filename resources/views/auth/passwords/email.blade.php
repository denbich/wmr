@extends('layouts.app')

@section('title')
{{ __('index.password.email.title') }}
@endsection

@section('style')
    <style>
      .zdjecie-login{
      background: url("https://panel.wolontariat.rybnik.pl/assets/img/logo-wmr2.svg");
      background-position: center;
      background-repeat:no-repeat;
      background-size: contain;
      }

    </style>
@endsection

@section('body')
class="bg-gradient-primary"
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block zdjecie-login"></div>
                        <div class="col-lg-6">
                            <div class="p-4">
                                <div class="text-center">
                                    <a href="{{ route('login') }}"><img src="https://panel.wolontariat.rybnik.pl/assets/img/mosir-logo1.svg" class="text-center"></a>
                                  <h1 class="h4 text-gray-900 mb-3 mt-3">{{ __('index.password.email.title') }}</h1>
                                </div>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="my-4">
                                    {{ __('index.password.email.text') }}
                                </div>
                                <form class="user mt-3" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <label for="email">{{ __('index.password.email.email') }}</label>
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
            </div>
        </div>
    </div>
</div>

@endsection


