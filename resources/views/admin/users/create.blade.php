@extends('......app.cc')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">Nuevo Usuario</div>
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




                            @include('admin.users.partials.fieldsusr')
                                 <div class="form-group">
                                 <div class="col-md-0 col-md-offset-3">
                                 <button type="submit" onclick="return confirm ('Esta seguro de crear el usuario?')"class="btn btn-primary">
                                 Crear Usuario
                                 </button>
                                 </div>
                                 </div>




        </div>
      </div>
    </div>
  </div>
</div>
@endsection
