@extends ('app')

@section('content')

<h1>Prueba</h1>

{!! Form::open(['route'=>'pruebas.store'])!!}

  @include('pruebas.partials.form')
  
  <div class="form-group">
    {!! Form::button('Guardar',['type'=>'submit','class'=>'btn btn-primary'])!!}
  </div>

{!! Form::close()!!}

@endsection

