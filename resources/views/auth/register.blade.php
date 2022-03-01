@extends('layouts.app')

@section('title')
{{ __('main.signin') }}
@endsection

@section('body')
class="bg-default"
@endsection

@section('content')

<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container text-primary">
        <div class="navbar-brand">
            <a class="" href="{{ route('home') }}">
                <img class="h-25" style="max-height: 110px" src="{{ url('/img/logowmrwhite.svg') }}">
              </a>
              <a class="" href="https://pomagamukrainie.gov.pl/" target="_blank" rel="noopener noreferrer">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/49/Flag_of_Ukraine.svg" alt="">
              </a>
        </div>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-8 collapse-brand text-center mx-auto">
              <a href="{{ route('home') }}">
                <img class="h-100" style="max-height: 110px; min-height:100px;" src="{{ url('/img/logowmr1.svg') }}" alt="wmr logo">

              </a>
              <a href="https://pomagamukrainie.gov.pl/" class="w-100 text-center mx-auto" target="_blank" rel="noopener noreferrer">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/49/Flag_of_Ukraine.svg" class="text-center mx-auto my-2" alt="Ukraine flag">
            </a>
            </div>
            <div class="col-4 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link text-center">
                <span class="nav-link-inner--text">{{ __('home.title') }}</span>
              </a>
            </li>
            <li class="nav-item">
                <li class="nav-item text-center">
                    <div class="dropdown">
                      <a class="nav-link dropdown-toggle text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('home.socialmedia.title')}}</a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item d-none" href=""><i class="fas fa-info-circle"></i> O nas</a>
                        <a class="dropdown-item" href="https://facebook.com/wolontariat.rybnik" target="_blank"><i class="fab fa-facebook-square"></i> {{ __('home.socialmedia.facebook') }}</a>
                        <a class="dropdown-item" href="https://instagram.com/wolontariat.rybnik" target="_blank"><i class="fab fa-instagram"></i> {{ __('home.socialmedia.instagram') }}</a>
                      </div>
                    </div>
                  </li>
            </li>
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link text-center">
                    <span class="nav-link-inner--text">{{ __('main.login') }}</span>
                </a>
            </li>

          </ul>
        <hr class="d-lg-none" />
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          @include('include.lang')

          <li class="nav-item d-lg-block ml-lg-4 text-center">
            <a href="{{ route('register') }}" class="btn btn-neutral btn-icon text-center">
              <span class="btn-inner--icon">
                <i class="fas fa-handshake mr-2"></i>
              </span>
              <span class="nav-link-inner--text">{{ __('main.signin') }}</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="main-content">
    <div class="header bg-gradient-primary py-8 py-lg-8 pt-lg-9">
        <div class="container">
          <div class="header-body text-center mb-6">
            <div class="row justify-content-center">
              <div class="col-xl-8 col-lg-8 col-md-8 px-5">
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
      <div class="row justify-content-center">
        <div class="col-lg-7 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-header bg-transparent pb-3 text-center">
                <a href="{{ route('login') }}"><img src="{{ url('/img/mosir-logo1.svg') }}" class="text-center"></a>
                <div class="mt-2 h1">{{ __('index.register.title') }}</div>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <form method="post" action="{{ route('register') }}" role="form" id="register-form" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('index.register.firstname') }}" type="text" name="firstname" value="{{ old('firstname', '') }}" max="255" required>
                  </div>
                @error('firstname')
                    <span class="text-danger small" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
                      </div>
                      <input class="form-control" placeholder="{{ __('index.register.lastname') }}" type="text" name="lastname" value="{{ old('lastname', '') }}" max="255" required>
                    </div>
                    @error('lastname')
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
                    <input class="form-control" placeholder="{{ __('index.register.password') }}" type="password" name="password" max="255" required>
                  </div>
                  @error('password')
                    <span class="text-danger small" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="text-muted font-italic d-none">
                    <small>password strength: <span class="text-success font-weight-700">strong</span></small>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="{{ __('index.register.c-password') }}" type="password" name="password_confirmation" max="255" required>
                    </div>
                    @error('repeat_password')
                    <span class="text-danger small" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  </div>

                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                      </div>
                      <input class="form-control" placeholder="{{ __('index.register.email') }}" type="email" name="email" value="{{ old('email', '') }}" max="255" >
                    </div>
                    @error('email')
                    <span class="text-danger small" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                      </div>
                      <input class="form-control" placeholder="{{ __('index.register.phone') }}" type="tel" name="telephone" value="{{ old('telephone', '') }}" max="255" required>
                    </div>
                    @error('telephone')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                      </div>
                      <input class="form-control" placeholder="{{ __('index.register.school') }}" type="text" name="school" value="{{ old('school', '') }}" max="255" required>
                    </div>
                    <p class="text-center"><small>{{ __('index.register.i-school') }}</small></p>
                    @error('school')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                      </div>
                      <input class="form-control" placeholder="{{ __('index.register.ice') }}" type="tel" name="ice" value="{{ old('ice', '') }}" max="255" >
                    </div>
                    <p class="text-center"><small>{{ __('index.register.i-ice') }}</small></p>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-6">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                          <input class="form-control" placeholder="{{ __('index.register.street') }}" type="text" name="street" value="{{ old('street', '') }}" max="255" required>
                        </div>
                        @error('street')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                      </div>
                      <div class="form-group col-lg-6">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                          <input class="form-control" placeholder="{{ __('index.register.number') }}" type="text" name="house_number" value="{{ old('house_number', '') }}" max="255" required>
                        </div>
                        @error('house_number')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                      </div>
                      <input class="form-control" placeholder="{{ __('index.register.city') }}" type="text" name="city" value="{{ old('city', '') }}" max="255" required>
                    </div>
                    @error('city')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="tshirt_size">{{ __('index.register.tshirt') }}</label>
                      <div class="input-group input-group-merge input-group-alternative mb-3">
                        <select class="form-control" id="tshirt_size" name="tshirt_size" required>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                      </div>
                      @error('tshirt_size')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="birth">{{ __('index.register.birth') }}</label>
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                        <input type="date" class="form-control" name="birth" value="{{ old('birth', '') }}" required>
                      </div>
                      @error('birth')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Gender">{{ __('index.register.gender') }}</label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="gender_f" name="gender" class="custom-control-input" value="f" required>
                        <label class="custom-control-label" for="gender_f">{{ __('index.register.gender-f') }}</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="gender_m" name="gender" class="custom-control-input" value="m" required>
                        <label class="custom-control-label" for="gender_m">{{ __('index.register.gender-m') }}</label>
                      </div>
                </div>
                <div class="form-group">
                    @error('gender')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="upload_image" class="w-100">
                        <a class="btn btn-info text-dark btn-icon w-100">
                            <span class="btn-inner--icon"><i class="fas fa-camera"></i></span>
                            <span class="btn-inner--text">{{ __('index.register.profile.button') }}</span>
                        </a>
                        <input type="file" name="image" class="image d-none" id="upload_image" accept="image/*">
                        <input type="hidden" name="profile" id="profile_photo" value="" required>
                    </label>
                    <p class="text-success text-center" id="text-photo"></p>
                    @error('profile')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="agreement">{{ __('index.register.agreement.text1') }} <br>
                        {{ __('index.register.agreement.text2') }}:
                        <a href="{{ url('/files/zgoda_wolontariat_pelnoletni.pdf') }}" target="_blank">{{ __('index.register.agreement.adult') }}</a> |
                        <a href="{{ url('/files/zgoda_wolontariat_niepelnoletni.pdf') }}" target="_blank">{{ __('index.register.agreement.minor') }}</a>
                    </label>
                    <input type="file" class="form-control" accept=".pdf" name="agreement" required>
                    <small>{{ __('index.register.agreement.size') }}: 7MB</small><br>
                    @error('agreement')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row mt-3 mb-1">
                  <div class="col-12">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="customCheckRegister" type="checkbox" name="terms" required>
                      <label class="custom-control-label" for="customCheckRegister">
                        <span class="text-muted">{{ __('index.register.accept') }} <a href="https://wolontariat.rybnik.pl/pliki/regulamin_wolontariatu_MOSiR_Rybnik.pdf" target="_blank">{{ __('index.register.accept-r') }}</a> {{ __('main.and') }} <a href="https://wolontariat.rybnik.pl/pliki/kodeks_wolontariuszy_MOSiR_Rybnik.pdf" target="_blank">{{ __('index.register.accept-c') }}</a></span>
                      </label>
                    </div>
                  </div>
                  @error('terms')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-center mt-4">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                    @error('g-recaptcha-response')
                        <span class="text-danger small text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-4 w-100">{{ __('main.signin') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  @include('auth.footer')

  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('index.register.profile.modal-h') }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="img-container">
                  <div class="row">
                      <div class="col-md-8">
                          <img src="" id="sample_image" class="img-crop"/>
                      </div>
                      <div class="col-md-4">
                          <div class="preview"></div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop" class="btn btn-info text-dark">{{ __('index.register.profile.modal-crop') }}</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('index.register.profile.modal-c') }}</button>
            </div>
      </div>
    </div>
</div>

@endsection

@section('style')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>

<style>

    .image_area {
      position: relative;
    }

    .img-crop {
          display: block;
          max-width: 100%;
    }

    .preview {
          overflow: hidden;
          width: 160px;
          height: 160px;
          margin: 10px;
          border: 1px solid red;
    }

    .modal-lg{
          max-width: 1000px !important;
    }

    .overlay {
      position: absolute;
      bottom: 10px;
      left: 0;
      right: 0;
      background-color: rgba(255, 255, 255, 0.5);
      overflow: hidden;
      height: 0;
      transition: .5s ease;
      width: 100%;
    }

    .image_area:hover .overlay {
      height: 50%;
      cursor: pointer;
    }

    .text {
      color: #333;
      font-size: 20px;
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      text-align: center;
    }


</style>
@endsection

@section('script')

<script>
    $(document).ready(function(){

    $("#submitBtn").click(function(){
            //document.getElementById("toggle_div").style.display="block";
           //document.getElementById("loader").innerHTML = "<div class='loader'></div>";
        });

	var $modal = $('#modal');
	var image = document.getElementById('sample_image');
	var cropper;
	$('#upload_image').change(function(event){
		var files = event.target.files;
		var done = function(url){
			image.src = url;
			$modal.modal('show');
		};
		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});
	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 3,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});
	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:500,
			height:500
		});
		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				const time = setInterval(() => {
                    document.getElementById("profile_photo").value = base64data;
                }, 1);
				document.getElementById("profile_photo").value = base64data;
				document.getElementById("text-photo").innerHTML = "{{ __('index.register.profile.info') }}";
				$modal.modal('hide');
			};
		});
	});

});
</script>

@endsection





