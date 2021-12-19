<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        .colorButtons {
			display: block;
			margin: 20px 0;
		}

		canvas {
			cursor: crosshair;
		}

		div#sidebar {
			position: absolute;
			left: 0;
			width: 150px;
			padding: 20px 20px;
			top: 0;
		}

		canvas#canvas {
			left: 150px;
			top: 45px;
		}

		.btn {
			margin-bottom: 10px;
			width: 100%;
		}
		input {
			width: 100%;
			margin-bottom: 10px;
		}

		.input-group {
			margin-bottom: 10px;
		}

		.toolsButtons .btn {
			width: 48%;
		}

		.sizeButtons .btn {
			width: 48%;
		}

		.colorpicker {
			background: transparent;
			height: 40px;
		}
    </style>
</head>
<body>
	<div id="sidebar">
		<div class="toolsButtons">
			<h3>Tools</h3>
			<button id="clear" class="btn btn-danger"> <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></button>
		</div>
	</div>
  </body>

  <script>
      	// SETTING ALL VARIABLES

		var isMouseDown=false;
		var canvas = document.createElement('canvas');
		var body = document.getElementsByTagName("body")[0];
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
</html>
