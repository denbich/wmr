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
                <div class="col-lg-6 zdjecie-login"></div>
                <div class="col-lg-6">
                    <div class="card-header bg-transparent">
                        <div class="text-center mt-2 h1">Witamy!</div>
                        <div class="text-center text-muted mt-2 h4">Zaloguj się do ISOW!</div>
                      </div>
                      <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf
                          <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                              </div>
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('index.login.type-login') }}" autofocus>
                            </div>
                          </div>
                          <div class="mt-2 mb-3">
                            @error('email')
                                <span class="text-danger small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                              </div>
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password" placeholder="{{ __('index.login.type-password') }}">
                            </div>
                          </div>
                          <div class="form-group">
                            @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="custom-control custom-control-alternative custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">
                              <span class="text-muted">Remember me</span>
                            </label>
                          </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary my-4">Zaloguj się</button>
                          </div>
                        </form>

                        <div class="text-center text-muted">
                            <table class="w-100">
                                <tbody><tr>
                                  <td><hr></td>
                                  <td style="width:1px; padding: 0 0px; white-space: nowrap;">LUB</td>
                                  <td><hr></td>
                                </tr>
                              </tbody></table>
                          </div>
                          <div class="btn-wrapper text-center mt-4">
                            <a href="#" class="btn btn-neutral btn-icon">
                              <span class="btn-inner--icon"><img src="../assets/img/icons/common/google.svg"></span>
                              <span class="btn-inner--text">Zaloguj się za pomocą Google</span>
                            </a>
                          </div>
                      </div>
                </div>
            </div>


          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="#" class="text-light"><small>Zapomniałeś hasła?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="#" class="text-light"><small>Utwórz nowe konto</small></a>
            </div>
          </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; {{ date('Y') }} <a href="https://facebook.com/denis.bichler" class="font-weight-bold ml-1" target="_blank">Denis Bichler</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

@endsection


