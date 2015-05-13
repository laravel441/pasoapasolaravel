@extends('app')

@section('content')
<div class="container-fluid">
  <div class="row">

      <div class="panel panel-default">
        <div class="panel-heading">Nuevo Empleado</div>
        <div class="panel-body">
          @if (count($errors) > 0)
            <div class="alert alert-danger" text-center>
              <strong>Oops!</strong> Ocurrio algun problema con su Ingreso.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {!!Form::open(['route'=>'admin.emps.store', 'method'=> 'POST'])!!}
                @include('admin.emps.partials.fieldsusr')


            <div class="form-group">
              <div class="col-md-2 col-md-offset-10">
                <button type="submit" class="btn btn-primary">
                  Crear Empleado
                </button>
              </div>
            </div>


          {!!Form::close()!!}




      </div>
    </div>
  </div>
</div>
@endsection
