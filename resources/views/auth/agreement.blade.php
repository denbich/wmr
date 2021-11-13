@extends('layouts.app')

@section('title')
{{ __('index.agreement.title') }}
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
                        <div class="mt-2 h1">{{ __('index.agreement.title') }}</div>
                      </div>
                      <div class="card-body pt-lg-3 pb-lg-4 px-lg-5">
                        <h4>{{ __('index.ageement.text.1') }} <b>{{ __('index.ageement.text.2') }}</b> {{ __('index.ageement.text.3') }} <b>{{ __('index.ageement.text.4') }}</b> {{ __('index.ageement.text.5') }}</h4>
                        <form role="form" method="POST" action="{{ route('new.agreement') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="agreement"> {{ __('index.agreement.label1') }} <br> {{ __('index.agreement.label2') }}
                                    <a href="{{ url('/files/zgoda_wolontariat_pelnoletni.pdf') }}" target="_blank">{{ __('index.agreement.adult') }}</a> |
                                    <a href="{{ url('/files/zgoda_wolontariat_niepelnoletni.pdf') }}" target="_blank">{{ __('index.agreement.minor') }}</a>
                                </label>
                                <input type="file" class="form-control" accept=".pdf" name="agreement" required>
                                <small>{{ __('index.agreement.file') }}: 7MB</small><br>
                                @error('agreement')
                                    <span class="text-danger small" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (session('agreement_err') == true)
                                    <span class="text-danger small" role="alert">
                                        <strong>{{ __('index.agreement.err') }}</strong>
                                    </span>
                                @endif
                            </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3 mb-1 w-100">{{ __('index.agreement.button') }}</button>
                          </div>
                        </form>
                          <div class="w-100 mt-4">
                              <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">{{ __('main.logout') }}</button>
                            </form>
                          </div>
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



