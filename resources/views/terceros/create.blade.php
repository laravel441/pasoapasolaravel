@extends ('app')

@section('content')

<h1>Registrar Tercero</h1>

{!! Form::open(['route'=>'terceros.store'])!!}

	@include('terceros.partials.form')
	
	<div class="form-group">
		{!! Form::button('Guardar',['type'=>'submit','class'=>'btn btn-primary'])!!}
	</div>

{!! Form::close()!!}

@endsection