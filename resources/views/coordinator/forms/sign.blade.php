@extends('layouts.app')

@section('title')
{{ __('Zapisz obecność (BETA)') }}
@endsection

@section('content')

<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <div class="sidenav-header mt-2 align-items-center w-100">
        <a class="mt-2" href="javascript:void(0)">
          <img src="/img/logo-wmr2.svg" class="h-100" alt="...">
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
            @include('coordinator.include.chat')
          </ul>
          <hr class="my-3">
        <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Serwis</span>
        </h6>
          <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link active" href="#forms" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="forms">
                  <i class="fas fa-clipboard-list text-primary"></i>
                  <span class="nav-link-text">Formularze</span>
                </a>
                <div class="collapse show" id="forms">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                      <a class="nav-link active" href="{{ route('c.form.list') }}">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('c.form.create') }}">
                        <span class="sidenav-normal"> Utwórz nowy </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
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
              <h6 class="h2 text-white d-inline-block mb-0">{{ $form->form_translate->title }}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('c.dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="{{ route('c.form.list') }}">Formularze</a></li>
                  <li class="breadcrumb-item active">{{ $form->id }}</li>
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
                  <h3 class="mb-0">Zapisz obecność (BETA)</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div id="sidebar">
                    <div class="toolsButtons" id="toolsButtons">
                        <h3>Tools</h3>
                        <button id="clear" class="btn btn-danger"> <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></button>
                    </div>
                </div>
                <canvas id="canvas" width="600" height="300" style="z-index: 8; position: absolute; border: 1px solid;"></canvas>
                <form action="{{ route('c.form.presence', [$form->id]) }}" method="post">
                    @csrf
                    <div class="text-right w-100 mb-3">
                        <button type="submit" class="btn btn-primary">Zatwierdź</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">Login</th>
                                    <th scope="col">Imię i Nazwisko</th>
                                    <th scope="col">Zapisane stanowisko</th>
                                    <th scope="col">Obecność</th>
                                </tr>
                            </thead>
                            <tbody class="list text-center">
                                @foreach ($signed_volunteers as $sign)
                                <tr>
                                    <td>{{ $sign->volunteer->name }}</td>
                                    <td>{{ $sign->volunteer->firstname }} {{ $sign->volunteer->lastname }}</td>
                                    <td>{{ $sign->position->title }}</td>
                                    <td>
                                        <a href="#signmodal{{ $sign->id }}" data-toggle="modal" data-target="#signmodal{{ $sign->id }}" class="btn btn-primary">Podpis</a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="signmodal{{ $sign->id }}" tabindex="-1" role="dialog" aria-labelledby="signmodal{{ $sign->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="signmodal{{ $sign->id }}Label">Podpis</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <h2>Podpis</h2>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                                          <button type="button" class="btn btn-primary">Zatwierdź</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
          </div>

        @yield('coordinator.include.footer')
      </div>
  </div>

  <script>
    // SETTING ALL VARIABLES

  var isMouseDown=false;
  var canvas = document.createElement('canvas');
  var body = document.getElementById("toolsButtons");
  //var body = document.getElementsByTagName("body")[0];
  var ctx = canvas.getContext('2d');
  var linesArray = [];
  currentSize = 3;
  var currentColor = "rgb(0,0,0)";
  var currentBg = "white";

  // INITIAL LAUNCH

  createCanvas();

  // BUTTON EVENT HANDLERS

  document.getElementById('clear').addEventListener('click', createCanvas);

  // REDRAW

  function redraw() {
          for (var i = 1; i < linesArray.length; i++) {
              ctx.beginPath();
              ctx.moveTo(linesArray[i-1].x, linesArray[i-1].y);
              ctx.lineWidth  = linesArray[i].size;
              ctx.lineCap = "round";
              ctx.strokeStyle = linesArray[i].color;
              ctx.lineTo(linesArray[i].x, linesArray[i].y);
              ctx.stroke();
          }
  }

  // DRAWING EVENT HANDLERS

  canvas.addEventListener('mousedown', function() {mousedown(canvas, event);});
  canvas.addEventListener('mousemove',function() {mousemove(canvas, event);});
  canvas.addEventListener('mouseup',mouseup);

  // CREATE CANVAS

  function createCanvas() {
      canvas.id = "canvas";
      canvas.width = 600;
      canvas.height = 300;
      canvas.style.zIndex = 8;
      canvas.style.position = "absolute";
      canvas.style.border = "1px solid";
      ctx.fillStyle = currentBg;
      ctx.fillRect(0, 0, canvas.width, canvas.height);
      //body.appendChild(canvas);
      body.appendChild(canvas);
  }

  // GET MOUSE POSITION

  function getMousePos(canvas, evt) {
      var rect = canvas.getBoundingClientRect();
      return {
          x: evt.clientX - rect.left,
          y: evt.clientY - rect.top
      };
  }

  // ON MOUSE DOWN

  function mousedown(canvas, evt) {
      var mousePos = getMousePos(canvas, evt);
      isMouseDown=true
      var currentPosition = getMousePos(canvas, evt);
      ctx.moveTo(currentPosition.x, currentPosition.y)
      ctx.beginPath();
      ctx.lineWidth  = currentSize;
      ctx.lineCap = "round";
      ctx.strokeStyle = currentColor;

  }

  // ON MOUSE MOVE

  function mousemove(canvas, evt) {

      if(isMouseDown){
          var currentPosition = getMousePos(canvas, evt);
          ctx.lineTo(currentPosition.x, currentPosition.y)
          ctx.stroke();
          store(currentPosition.x, currentPosition.y, currentSize, currentColor);
      }
  }

  // ON MOUSE UP

  function mouseup() {
      isMouseDown=false
      store()
  }
</script>

@endsection






