@extends('......layouts.sidebar')

@section('content')

	<div class="row">
		  <div class="col-md-12 col-md-offset-0">
			<div class="panel panel-default">
				 <div class="panel-heading"><h2 align="center">Revisión de facturas y/o cuentas de cobro
                         </h2><h6 align="center"> {{ Auth::user()->usr_name }}
                           <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?></h6>

                    </div>
                     <div class="form-group">
                         @if(Session::has('message'))
                         <p class="alert alert-danger" text-center>{{Session::get('message')}}</p>
                         @endif
                         @if(Session::has('message2'))
                          <p class="alert alert-info" text-center>{{Session::get('message2')}}</p>
                          @endif
                          @if(Session::has('message3'))
                            <p class="alert alert-primary" text-center>{{Session::get('message3')}}</p>
                            @endif
                     </div>

				<div class="panel-body">

{{--{!! Form::model(Request::all(),['route' => 'contabilidad.revision.index', 'method' => 'GET', 'class'=>'navbar-form navbar-left pull-right', 'role' =>'search']) !!}--}}

<style>
.camcontent{
  display: block;
  position: relative;
  overflow: hidden;
  height: 480px;
  margin: auto;
  }
.cambuttons button {
  border-radius: 15px;
  font-size: 18px;
  }
.cambuttons button:hover {
  cursor: pointer;
  border-radius: 15px;
  background: #00dd00 ;    /* green */
  }
 </style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
        // Put event listeners into place
        window.addEventListener("DOMContentLoaded", function() {
            // Grab elements, create settings, etc.
            var canvas = document.getElementById("canvas"),
                context = canvas.getContext("2d"),
                video = document.getElementById("video"),
                videoObj = { "video": true },
                image_format= "jpeg",
                jpeg_quality= 85,
                errBack = function(error) {
                    console.log("Video capture error: ", error.code);
                };


            // Put video listeners into place
            if(navigator.getUserMedia) { // Standard
                navigator.getUserMedia(videoObj, function(stream) {
                    video.src = stream;
                    video.play();
                    $("#snap").show();
                }, errBack);
            } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
                navigator.webkitGetUserMedia(videoObj, function(stream){
                    video.src = window.webkitURL.createObjectURL(stream);
                    video.play();
                    $("#snap").show();
                }, errBack);
            } else if(navigator.mozGetUserMedia) { // moz-prefixed
                navigator.mozGetUserMedia(videoObj, function(stream){
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                    $("#snap").show();
                }, errBack);
            }
                  // video.play();       these 2 lines must be repeated above 3 times
                  // $("#snap").show();  rather than here once, to keep "capture" hidden
                  //                     until after the webcam has been activated.

            // Get-Save Snapshot - image
            document.getElementById("snap").addEventListener("click", function() {
                context.drawImage(video, 0, 0, 640, 480);
                // the fade only works on firefox?
                $("#video").fadeOut("slow");
                $("#canvas").fadeIn("slow");
                $("#snap").hide();
                $("#reset").show();
                $("#upload").show();
            });
            // reset - clear - to Capture New Photo
            document.getElementById("reset").addEventListener("click", function() {
                $("#video").fadeIn("slow");
                $("#canvas").fadeOut("slow");
                $("#snap").show();
                $("#reset").hide();
                $("#upload").hide();
            });
            // Upload image to sever
            document.getElementById("upload").addEventListener("click", function(){
                var dataUrl = canvas.toDataURL("image/jpeg", 0.85);
                $("#uploading").show();
                $.ajax({
                  type: "POST",
                  url: "",
                  data: {
                     imgBase64: dataUrl,
                     user: "Joe",
                     userid: 25
                  }
                }).done(function(msg) {
                  console.log("saved");
                  $("#uploading").hide();
                  $("#uploaded").show();
                });
            });
        }, false);

   </script>


<div class="camcontent">
    <video id="video" autoplay></video>
    <canvas id="canvas" width="640" height="480">
</div>
<div class="cambuttons">
    <button id="snap" style="display:none;">  Capture </button>
    <button id="reset" style="display:none;">  Reset  </button>
    <button id="upload" style="display:none;"> Upload </button>
    <br> <span id=uploading style="display:none;"> Uploading has begun . . .  </span>
         <span id=uploaded  style="display:none;"> Success, your photo has been uploaded!
                <a href="javascript:history.go(-1)"> Return </a> </span>
 </div>
                                                                      {{--<div class="col-md-6 col-md-offset-0 form-group-danger">--}}
                               {{--<div class="contentarea">--}}
                               	{{--<h1>--}}
                               		{{--MDN - WebRTC: Still photo capture demo--}}
                               	{{--</h1>--}}
                               	{{--<p>--}}
                               		{{--This example demonstrates how to set up a media stream using your built-in webcam, fetch an image from that stream, and create a PNG using that image.--}}
                               	{{--</p>--}}
                                 {{--<div class="camera">--}}
                                   {{--<video id="video">Video stream not available.</video>--}}
                                   {{--<button id="startbutton">Take photo</button>--}}
                                 {{--</div>--}}
                                 {{--<canvas id="canvas" class="hidden">--}}
                                 {{--</canvas>--}}
                                 {{--<div class="output">--}}
                                   {{--<img id="photo" name= "img" type="file" alt="The screen capture will appear in this box.">--}}

                                 {{--</div>--}}
                                {{--<button class="submit">:)</button>--}}
                               {{--</div>--}}

				{{--</div>--}}
{{--{!!Form::close()!!}--}}

	{{--<script>--}}

	{{--(function() {--}}
      {{--// The width and height of the captured photo. We will set the--}}
      {{--// width to the value defined here, but the height will be--}}
      {{--// calculated based on the aspect ratio of the input stream.--}}

      {{--var width = 320;    // We will scale the photo width to this--}}
      {{--var height = 0;     // This will be computed based on the input stream--}}

      {{--// |streaming| indicates whether or not we're currently streaming--}}
      {{--// video from the camera. Obviously, we start at false.--}}

      {{--var streaming = false;--}}

      {{--// The various HTML elements we need to configure or control. These--}}
      {{--// will be set by the startup() function.--}}

      {{--var video = null;--}}
      {{--var canvas = null;--}}
      {{--var photo = null;--}}
      {{--var startbutton = null;--}}

      {{--function startup() {--}}
        {{--video = document.getElementById('video');--}}
        {{--canvas = document.getElementById('canvas');--}}
        {{--photo = document.getElementById('photo');--}}
        {{--startbutton = document.getElementById('startbutton');--}}

        {{--navigator.getMedia = ( navigator.getUserMedia ||--}}
                               {{--navigator.webkitGetUserMedia ||--}}
                               {{--navigator.mozGetUserMedia ||--}}
                               {{--navigator.msGetUserMedia);--}}

        {{--navigator.getMedia(--}}
          {{--{--}}
            {{--video: true,--}}
            {{--audio: false--}}
          {{--},--}}
          {{--function(stream) {--}}
            {{--if (navigator.mozGetUserMedia) {--}}
              {{--video.mozSrcObject = stream;--}}
            {{--} else {--}}
              {{--var vendorURL = window.URL || window.webkitURL;--}}
              {{--video.src = vendorURL.createObjectURL(stream);--}}
            {{--}--}}
            {{--video.play();--}}
          {{--},--}}
          {{--function(err) {--}}
            {{--console.log("An error occured! " + err);--}}
          {{--}--}}
        {{--);--}}

        {{--video.addEventListener('canplay', function(ev){--}}
          {{--if (!streaming) {--}}
            {{--height = video.videoHeight / (video.videoWidth/width);--}}

            {{--// Firefox currently has a bug where the height can't be read from--}}
            {{--// the video, so we will make assumptions if this happens.--}}

            {{--if (isNaN(height)) {--}}
              {{--height = width / (4/3);--}}
            {{--}--}}

            {{--video.setAttribute('width', width);--}}
            {{--video.setAttribute('height', height);--}}
            {{--canvas.setAttribute('width', width);--}}
            {{--canvas.setAttribute('height', height);--}}
            {{--streaming = true;--}}
          {{--}--}}
        {{--}, false);--}}

        {{--startbutton.addEventListener('click', function(ev){--}}
          {{--takepicture();--}}
          {{--ev.preventDefault();--}}
        {{--}, false);--}}

        {{--clearphoto();--}}
      {{--}--}}

      {{--// Fill the photo with an indication that none has been--}}
      {{--// captured.--}}

      {{--function clearphoto() {--}}
        {{--var context = canvas.getContext('2d');--}}
        {{--context.fillStyle = "#AAA";--}}
        {{--context.fillRect(0, 0, canvas.width, canvas.height);--}}

        {{--var data = canvas.toDataURL('image/png');--}}
        {{--photo.setAttribute('src', data);--}}
      {{--}--}}

      {{--// Capture a photo by fetching the current contents of the video--}}
      {{--// and drawing it into a canvas, then converting that to a PNG--}}
      {{--// format data URL. By drawing it on an offscreen canvas and then--}}
      {{--// drawing that to the screen, we can change its size and/or apply--}}
      {{--// other changes before drawing it.--}}

      {{--function takepicture() {--}}
        {{--var context = canvas.getContext('2d');--}}
        {{--if (width && height) {--}}
          {{--canvas.width = width;--}}
          {{--canvas.height = height;--}}
          {{--context.drawImage(video, 0, 0, width, height);--}}

          {{--var data = canvas.toDataURL('image/png');--}}
          {{--photo.setAttribute('src', data);--}}
        {{--} else {--}}
          {{--clearphoto();--}}
        {{--}--}}
      {{--}--}}

      {{--// Set up our event listener to run the startup process--}}
      {{--// once loading is complete.--}}
      {{--window.addEventListener('load', startup, false);--}}
    {{--})();--}}
	{{--</script>--}}

			</div>
		</div>
	</div>
</div>

@endsection