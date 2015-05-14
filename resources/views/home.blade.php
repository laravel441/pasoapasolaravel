@extends('layouts.sidebar')

@section('content')
<div class="container">
	<div class="row">
		  <div class="col-md-14 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<h3>Bienvenido {{ Auth::user()->usr_name }}</h3>
                        {{--<audio src="audio/sample.mp3" autoplay>--}}
                        {{--</audio>--}}

				</div>

			</div>
		</div>
	</div>
</div>
@endsection