@extends('layouts.app')

@section('title')
{{ __('volunteer.profile.title') }}
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
            @include('volunteer.include.prizes')

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
              <h6 class="h2 text-white d-inline-block mb-0">{{ __('volunteer.profile.title') }}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('v.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ __('index.register.profile.modal-h') }}</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->

    <div class="container-fluid mt--6">
        <div class="row">
          <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">
              <img src="../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
              <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                  <div class="card-profile-image">
                    <a href="#">
                      <img src="{{ Auth::user()->photo_src }}" class="rounded-circle">
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4"></div>
              <div class="card-body pt-0">
                <div class="text-center mt-4 mb-3">
                    <form action="{{ route('v.change.profile') }}" method="post" id="changeprofilephotoform">
                        @csrf
                        <label for="upload_image" class="w-100">
                            <a class="btn btn-sm btn-primary btn-icon w-100 text-white">
                                <span class="btn-inner--icon"><i class="fas fa-exchange-alt"></i></span>
                                <span class="btn-inner--text">{{ __('volunteer.profile.change-profile') }}</span>
                            </a>
                            <input type="file" name="image" class="image d-none" id="upload_image" accept="image/*">
                            <input type="hidden" name="profile" id="profile_photo" value="" required>
                        </label>
                    </form>
                    @error('profile')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  <a href="#" class="btn btn-sm btn-primary d-none"><i class="fas fa-camera"></i> Zr??b zdj??cie profilowe</a>
                </div>
                <div class="text-center">
                  <h5 class="h3">
                    {{  Auth::user()->firstname}} {{ Auth::user()->lastname }}<span class="font-weight-light">, 16</span>
                  </h5>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i>{{ $volunteer->city }}, {{ __('volunteer.profile.poland') }}
                  </div>
                  <div class="h5 mt-4">
                    <i class="ni business_briefcase-24 mr-2"></i>{{ __('volunteer.profile.volunteer') }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-8 order-xl-1">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">{{ __('volunteer.profile.edit') }} </h3>
                  </div>
                  <div class="col-4 text-right">
                    <a href="{{ route('v.settings') }}" class="btn btn-sm btn-primary">{{ __('volunteer.menu.dropdown.settings') }}</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                @if (session('change') == true)
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text"><strong>{{ __('main.success') }}!</strong> {{ __('volunteer.profile.alert1') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                @if (session('change_profile') == true)
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text"><strong>{{ __('main.success') }}!</strong> {{ __('volunteer.profile.alert2') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                <form method="POST" action="{{ route('v.profile') }}">
                    @csrf
                  <h6 class="heading-small text-muted mb-4">{{ __('volunteer.profile.main') }}</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">{{ __('volunteer.profile.options.firstname') }}</label>
                            <input type="text" id="input-first-name" class="form-control" placeholder="First name" name="firstname" value="{{ Auth::user()->firstname }}" required>
                            @error('firstname')
                                      <span class="text-danger small" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-last-name">{{ __('volunteer.profile.options.lastname') }}</label>
                            <input type="text" id="input-last-name" class="form-control" placeholder="Last name" name="lastname" value="{{ Auth::user()->lastname }}" required>
                            @error('lastname')
                                      <span class="text-danger small" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                          </div>
                        </div>
                      </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-telephone">{{ __('volunteer.profile.options.telephone') }}</label>
                          <input type="text" id="input-telephone" class="form-control" placeholder="telephone" name="telephone" value="{{ Auth::user()->telephone }}" required>
                          @error('telephone')
                                      <span class="text-danger small" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-email">{{ __('volunteer.profile.options.email') }}</label>
                            <input type="email" id="input-email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                            @error('email')
                                          <span class="text-danger small" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-ice">{{ __('volunteer.profile.options.ice') }}</label>
                              <input type="tel" id="input-ice" class="form-control" name="ice" value="{{ $volunteer->ice }}" required>
                              @error('ice')
                                          <span class="text-danger small" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-school">{{ __('volunteer.profile.options.school') }}</label>
                              <input type="text" id="input-school" class="form-control" name="school" value="{{ $volunteer->school }}" required>
                              @error('school')
                                          <span class="text-danger small" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-school">{{ __('volunteer.profile.options.tshirst') }}</label>
                        <select class="form-control" id="tshirt_size" name="tshirt_size" required>
                            <option value="XS" @if ($volunteer->tshirt_size == "XS") selected @endif>XS</option>
                            <option value="S" @if ($volunteer->tshirt_size == "S") selected @endif>S</option>
                            <option value="M" @if ($volunteer->tshirt_size == "M") selected @endif>M</option>
                            <option value="L" @if ($volunteer->tshirt_size == "L") selected @endif>L</option>
                            <option value="XL" @if ($volunteer->tshirt_size == "XL") selected @endif>XL</option>
                            <option value="XXL" @if ($volunteer->tshirt_size == "XXL") selected @endif>XXL</option>
                        </select>
                            @error('tshirt_size')
                                <span class="text-danger small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
                    </div>
                </div>
                  <hr class="my-4" />
                  <!-- Address -->
                  <h6 class="heading-small text-muted mb-4">{{ __('volunteer.profile.options.tshirst') }}</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-address">{{ __('volunteer.profile.options.street') }}</label>
                          <input id="input-address" class="form-control" placeholder="Home Address" name="street" value="{{ $volunteer->street }}" type="text" required>
                          @error('street')
                                      <span class="text-danger small" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-house-number">{{ __('volunteer.profile.options.number') }}</label>
                          <input type="text" id="input-house-number" class="form-control" name="house_number" value="{{ $volunteer->house_number }}" required>
                          @error('house_number')
                                      <span class="text-danger small" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-city">{{ __('volunteer.profile.options.city') }}</label>
                          <input type="text" id="input-city" class="form-control" placeholder="City" name="city" value="{{ $volunteer->city }}" required>
                          @error('city')
                                      <span class="text-danger small" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <button type="submit" class="btn btn-primary w-100">{{ __('volunteer.profile.save') }}</button>
                    </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        @yield('volunteer.include.footer')
      </div>
  </div>

  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('volunteer.profile.modal.cut') }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">??</span>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.cancel') }}</button>
                <button type="button" id="crop" class="btn btn-primary">{{ __('volunteer.profile.modal.cut') }}</button>
            </div>
      </div>
    </div>
</div>

@endsection

@section('style')
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
				$modal.modal('hide');
                $( "#changeprofilephotoform" ).submit();

			};
		});
	});

});
</script>

@endsection
