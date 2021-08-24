@extends('layouts.app')

@section('title')
{{ __('index.register.title') }}
@endsection

@section('style')

    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/dropzone"></script>
	<script src="https://unpkg.com/cropperjs"></script>
<style>
    .form-control::-webkit-input-placeholder {
          color: #4a4c55;
        }

        body {
            color: #4a4c55;
        }

        label {
            color: #4a4c55;
        }

        textarea.form-control::-webkit-input-placeholder {
          color: #6e707e;
          font-size:13px;
        }

        textarea.form-control {
            font-size:13px;
        }

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

@section('body')
class="bg-gradient-primary"
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="p-4">
                                <div class="text-center">
                                    <a href="{{ route('login') }}"><img src="https://panel.wolontariat.rybnik.pl/assets/img/mosir-logo1.svg" class="text-center w-50"></a>
                                  <h1 class="h4 text-gray-900 mb-3 mt-3">Rejestracja</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-group">
                                        <input id="firstname" type="text" class="form-control form-control-user @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" placeholder="Imię" autofocus>

                                        @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input id="lastname" type="text" class="form-control form-control-user @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" placeholder="Nazwisko">

                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                            <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <input id="phone" type="tel" placeholder="Numer telefonu" class="form-control form-control-user @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone">
                                        <input type="hidden" name="prefix" id="prefix" value="">
                                        <p id="prefix-old">{{ old('prefix') }}</p>
                                        @error('telephone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                    <div class="form-group">
                                            <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                            <input id="password-confirm" type="password" class="form-control form-control-user" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="form-group">
                                        <input id="address" type="text" class="form-control form-control-user @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" placeholder="Adres Zamieszkania (Ulica, numer domu/mieszkania, miasto)">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user @error('school') is-invalid @enderror" id="school" name="school" placeholder="Nazwa szkoły" value='{{ old('school') }}' autocomplete="school">
                                        @error('school')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <p class="pt-2 text-center text-secondary" style="font-size: 0.7rem;">Jeśli jesteś osobą pracującą/niepracującą, to pozostaw puste pole</p>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user @error('ice_number') is-invalid @enderror" id="address" name="address" placeholder="Adres zamieszkania" value='{{ old('address') }}' required>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                      <div class="form-group">
                                        <input type="tel" class="form-control form-control-user @error('ice_number') is-invalid @enderror" id="ice_number" name="ice_number" placeholder="ice_number" value='{{ old('ice_number') }}'>
                                        <p class="pt-2 text-center text-secondary" style="font-size: 0.7rem;">ICE to skrót informujący, do kogo powinno się zadzwonić w razie nagłego wypadku.</p>
                                        @error('ice_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                      </div>

                                    <div class="form-group">
                                        <label for="tshirt_size">Rozmiar koszulki</label>
                                        <select name="tshirt_size" id="sthirt_size" class="form-control @error('tshirt_size') is-invalid @enderror" required>
                                            <option value="XS">XS</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="birth">Data urodzenia</label>
                                        <input id="birth" type="date" class="form-control @error('birth') is-invalid @enderror" name="birth" value="{{ old('birth') }}" required autocomplete="birth"
                                        style="border-top: none; border-left: none; border-right: none; background-color: transparent; font-size: 1.2rem; line-height: 1.9; outline: transparent;">

                                        @error('birth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="agreement">Zgoda na uczestnicwo w wolontariacie (plik PDF) <br> Znajdziesz je tutaj:
                                            <a href="https://wolontariat.rybnik.pl/pliki/zgoda_wolontariat_pelnoletni.pdf" target="_blank">pełnoletni</a> |
                                            <a href="https://wolontariat.rybnik.pl/pliki/zgoda_wolontariat_niepelnoletni.pdf" target="_blank">niepełnoletni</a>
                                        </label>
                                        <input type="file" name="agreement" id="agreement" accept=".pdf" class="form-control-file border" required/>
                                        <p style="padding-top:1vh; font-size: 0.8rem; color: #888888;">Maksymalny rozmiar pliku: 5MB</p>

                                        @error('agreement')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="plec">Płeć</label><br>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="gender" value="k" required>Kobieta
                                        </label>
                                        </div>
                                        <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="gender" value="m" required>Mężczyzna
                                        </label>
                                        </div>

                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mx-3">
                                        <div class="image_area">
                                            <label for="upload_image" class="w-100">
                                                <a class="btn btn-secondary w-100" style="color:white">Dodaj Zdjęcie profilowe</a>
                                                <input type="file" name="image" class="image" id="upload_image" style="display:none" accept="image/*"/>
                                                <input type="hidden" name="profile" id="profile" value="">
                                            </label>
                                            <p class="text-success text-center" id="profile-text"></p>
                                        </div>
                                        @error('profile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label style="margin-left:1.5rem;" class="form-check-label" for="terms">
                                        <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                        Akceptuję
                                        <a href="" target="_blank">Regulamin</a> i
                                        <a href="" target="_blank">Politykę prywatności</a>

                                        @error('terms')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">Zarejestuj się</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Masz już konto? Zaloguj się</a> |
                                    @if (Route::has('password.request'))
                                    <a class="small" href="{{ route('password.request') }}">{{ __('index.login.rememberpwd') }}</a>
                                    @endif


                                </div>
                                <div class="text-center">
                                    <a class="small" target="_blank" href="">{{ __('index.login.regulations') }}</a> |
                                    <a class="small" target="_blank" href="">{{ __('index.login.terms') }}</a> |
                                    <a class="small" target="_blank" href="">{{ __('index.login.privacypolicy') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Wytnij zdjęcie</h5>
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
                <button type="button" id="crop" class="btn btn-primary">Wytnij</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
            </div>
      </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){

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
                    document.getElementById("profile").value = base64data;
                }, 1);
				document.getElementById("profile").value = base64data;
				document.getElementById("profile-text").innerHTML = "Zdjęcie zostało załadowane";
				$modal.modal('hide');
			};
		});
	});

});
</script>
@endsection
