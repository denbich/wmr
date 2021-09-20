@extends('layouts.app')

@section('title')
{{ __('Chat') }}
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
            @include('coordinator.include.dashboard')
        </ul>
        <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Ogólne</span>
        </h6>
          <ul class="navbar-nav">
            @include('coordinator.include.volunteer')
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('c.chat') }}">
                    <i class="fas fa-comments text-primary"></i>
                    <span class="nav-link-text">Czat</span>
                </a>
            </li>
          </ul>
          <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Serwis</span>
        </h6>
          <ul class="navbar-nav">
            @include('coordinator.include.forms')
            @include('coordinator.include.prizes')
            @include('coordinator.include.posts')
          </ul>

          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Inne</span>
          </h6>

          <ul class="navbar-nav mb-md-3">
            @include('coordinator.include.other')
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="main-content" id="panel">

    @include('coordinator.include.nav')

    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Czat</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Czat</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral"><i class="fas fa-plus"></i> Nowy formularz</a>
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
                    <h3 class="mb-0">Czat </h3>
                  </div>
                </div>
              </div>
                <div class="card-body">
                        <div class="row no-gutters">
                          <div class="col-md-4 border-right" >
                            <div class="settings-tray">
                              <img class="profile-image" src="{{ Auth::user()->photo_src }}" alt="Profile img">
                              <span class="name">Denis Bichler</span>
                            </div>
                            <div class="search-box">
                              <div class="input-wrapper">
                                <i class="fas fa-search"></i>
                                <input placeholder="Search here" type="text">
                              </div>
                            </div>
                            <div style="max-height: 600px; min-height: 600px; overflow-y: auto; overflow-x: hidden;">
                                @foreach ($users as $user)
                                <div class="friend-drawer friend-drawer--onhover userclass" id="{{ $user->id }}">

                                    <img class="profile-image" src="{{ $user->photo_src }}" alt="">
                                    <div class="text">
                                      <h6>{{ $user->firstname }} {{ $user->lastname }}</h6>
                                      <p class="text-muted">Latest message</p>
                                    </div>
                                    <span class="time text-muted small">13:21</span>
                                  </div>
                                  <hr>
                                @endforeach
                                <div class="friend-drawer friend-drawer--onhover">
                                    <img class="profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/robocop.jpg" alt="">
                                    <div class="text">
                                      <h6>Robo Cop</h6>
                                      <p class="text-muted">Hey, you're arrested!</p>
                                    </div>
                                    <span class="time text-muted small">13:21</span>
                                  </div>
                                  <hr>
                                  <div class="friend-drawer friend-drawer--onhover">
                                    <img class="profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                                    <div class="text">
                                      <h6>Optimus</h6>
                                      <p class="text-muted">Wanna grab a beer?</p>
                                    </div>
                                    <span class="time text-muted small">00:32</span>
                                  </div>
                                  <hr>
                                  <div class="friend-drawer friend-drawer--onhover ">
                                    <img class="profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/real-terminator.png" alt="">
                                    <div class="text">
                                      <h6>Skynet</h6>
                                      <p class="text-muted">Seen that canned piece of s?</p>
                                    </div>
                                    <span class="time text-muted small">13:21</span>
                                  </div>
                                  <hr>
                                  <div class="friend-drawer friend-drawer--onhover">
                                    <img class="profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/termy.jpg" alt="">
                                    <div class="text">
                                      <h6>Termy</h6>
                                      <p class="text-muted">Im studying spanish...</p>
                                    </div>
                                    <span class="time text-muted small">13:21</span>
                                  </div>
                                  <hr>
                                  <div class="friend-drawer friend-drawer--onhover">
                                    <img class="profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/rick.jpg" alt="">
                                    <div class="text">
                                      <h6>Richard</h6>
                                      <p class="text-muted">I'm not sure...</p>
                                    </div>
                                    <span class="time text-muted small">13:21</span>
                                  </div>
                                  <hr>
                                  <div class="friend-drawer friend-drawer--onhover">
                                    <img class="profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/rachel.jpeg" alt="">
                                    <div class="text">
                                      <h6>XXXXX</h6>
                                      <p class="text-muted">Hi, wanna see something?</p>
                                    </div>
                                    <span class="time text-muted small">13:21</span>
                                  </div>
                            </div>

                          </div>
                          <div class="col-md-8">
                            <div id="messagebox">
                                @csrf
                            </div>
                          </div>
                        </div>
                </div>
            </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

@endsection

@section('script')

<script>

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.userclass').click(function () {
                $('.userclass').removeClass('activeuser');
                $(this).addClass('activeuser');
                receiver_id = $(this).attr('id');
                $.ajax({
                type:'POST',
                url: "/coordinator/chat/getmessages",
                data: {
                    'receiver_id': receiver_id
                },
                success:function(data) {
                    $('#messagebox').html(data);
                    scrollToBottomFunc();
                    $( ".messagediv" ).removeClass("d-none")
                }
                });
            });
        });

                window.setInterval(function(){
                    $.ajax({
                        type:'POST',
                        url: "/coordinator/chat/getmessages",
                        data: {
                            'receiver_id': receiver_id
                        },
                        success:function(data) {
                            //$('#messagebox').html(data);
                            //scrollToBottomFunc();
                        }
                        });
                }, 10000);

                function scrollToBottomFunc() {
                    $('.messagediv').animate({
                        scrollTop: $('.messagediv').get(0).scrollHeight
                    }, 50);
                    //$( ".messagediv").append(data);
                }

</script>



@endsection

@section('style')

    <style>

        body {
	 -webkit-font-smoothing: antialiased;
	 -moz-osx-font-smoothing: grayscale;
	 text-rendering: optimizeLegibility;
}
 .container {
	 margin: 60px auto;
	 background: #fff;
	 padding: 0;
	 border-radius: 7px;
}
 .profile-image {
	 width: 50px;
	 height: 50px;
	 border-radius: 40px;
}
 .settings-tray {
	 background: #eee;
	 padding: 10px 15px;
	 border-radius: 7px;
}
 .settings-tray .no-gutters {
	 padding: 0;
}
 .settings-tray--right {
	 float: right;
}
 .settings-tray--right i {
	 margin-top: 10px;
	 font-size: 25px;
	 color: grey;
	 margin-left: 14px;
	 transition: 0.3s;
}
 .settings-tray--right i:hover {
	 color: #74b9ff;
	 cursor: pointer;
}
 .search-box {
	 background: #fafafa;
	 padding: 10px 13px;
}
 .search-box .input-wrapper {
	 background: #fff;
	 border-radius: 40px;
}
 .search-box .input-wrapper i {
	 color: grey;
	 margin-left: 7px;
	 vertical-align: middle;
}
 input {
	 border: none;
	 border-radius: 30px;
	 width: 80%;
}
 input::placeholder {
	 color: #e3e3e3;
	 font-weight: 300;
	 margin-left: 20px;
}
 input:focus {
	 outline: none;
}
 .friend-drawer {
	 padding: 10px 15px;
	 display: flex;
	 vertical-align: baseline;
	 background: #fff;
	 transition: 0.3s ease;
}
 .friend-drawer--grey {
	 background: #eee;
}
 .friend-drawer .text {
	 margin-left: 12px;
	 width: 70%;
}
 .friend-drawer .text h6 {
	 margin-top: 6px;
	 margin-bottom: 0;
}
 .friend-drawer .text p {
	 margin: 0;
}
 .friend-drawer .time {
	 color: grey;
}
 .friend-drawer--onhover:hover {
	 background: #5e72e4;
	 cursor: pointer;
}
 .friend-drawer--onhover:hover p, .friend-drawer--onhover:hover h6, .friend-drawer--onhover:hover .time {
	 color: #fff !important;
}
 hr {
	 margin: 5px auto;
	 width: 60%;
}
 .chat-bubble {
	 padding: 10px 14px;
	 background: #eee;
	 margin: 10px 30px;
	 border-radius: 9px;
	 position: relative;
}
 .chat-bubble:after {
	 content: '';
	 position: absolute;
	 top: 50%;
	 width: 0;
	 height: 0;
	 border: 20px solid transparent;
	 border-bottom: 0;
	 margin-top: -10px;
}
 .chat-bubble--left:after {
	 left: 0;
	 border-right-color: #eee;
	 border-left: 0;
	 margin-left: -20px;
}
 .chat-bubble--right:after {
	 right: 0;
	 border-left-color: #5e72e4;
	 border-right: 0;
	 margin-right: -20px;
}
 @keyframes fadeIn {
	 0% {
		 opacity: 0;
	}
	 100% {
		 opacity: 1;
	}
}
 .offset-md-9 .chat-bubble {
	 background: #5e72e4;
	 color: #fff;
}
 .chat-box-tray {
	 background: #eee;
	 display: flex;
	 align-items: baseline;
	 padding: 10px 15px;
	 align-items: center;
	 margin-top: 19px;
	 bottom: 0;
}
 .chat-box-tray input {
	 margin: 0 10px;
	 padding: 6px 2px;
}
 .chat-box-tray i {
	 color: grey;
	 font-size: 30px;
	 vertical-align: middle;
}
 .chat-box-tray i:last-of-type {
	 margin-left: 25px;
}

.activeuser {
	 background: #5e72e4;
	 cursor: pointer;
}
.activeuser p, .activeuser h6, .activeuser .time {
	 color: #fff !important;
}

.messagediv::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
}

.messagediv::-webkit-scrollbar
{
	width: 8px;
	background-color: #F5F5F5;
}

.messagediv::-webkit-scrollbar-thumb
{
	background-color: #555555;
	border: 2px solid #555555;
}

    </style>
@endsection
