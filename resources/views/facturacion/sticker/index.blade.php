@extends('layouts.sidebar')

@section('content')

	<div class="row">
		  <div class="col-md-12 col-md-offset-0">
			<div class="panel panel-default">
				 <div class="panel-heading"><h2 align="center">Generación de Sticker
                         </h2><h6 align="center"> {{ Auth::user()->usr_name }}
                           <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?></h6>
                    </div>

				<div class="panel-body">
				<div class="form-group">
                     @if(Session::has('message'))
                     <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                     @endif
                 </div>
					<h3>{{ Auth::user()->usr_name }}</h3>
                        {{--<audio src="audio/sample.mp3" autoplay>--}}
                        {{--</audio>--}}


				</div>

			</div>
		</div>
	</div>
</div>

@endsection