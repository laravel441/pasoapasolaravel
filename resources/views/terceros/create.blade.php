@extends ('app')

@section('content')

<h1 class="col-md-8 col-md-offset-2">Registrar Tercero</h1>

{!! Form::open(['route'=>'terceros.store'])!!}

	@include('terceros.partials.form')
	
	<div class="form-group col-md-offset-5">
		{!! Form::button('Guardar',['type'=>'submit','class'=>'btn btn-primary'])!!}
	</div>

{!! Form::close()!!}

@endsection