@extends('layouts.app')

@section('title')
{{ __('Email verify') }}
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
                                    <img src="https://panel.wolontariat.rybnik.pl/assets/img/mosir-logo1.svg" class="text-center">
                                  <h1 class="h4 text-gray-900 mb-3 mt-3">{{ __('Verify email') }}</h1>
                                </div>
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif
                                <div class="my-4">
                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }},
                                </div>
                                <form class="user mt-3" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('click here to request another') }}</button>
                                </form>
                                <form class="user mt-3" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('log out') }}</button>
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


