@extends('......layouts.sidebar')


@section('content')

<div class="container">
 <div class="col-md col-md-offset-0 col-lg">
   <div class="panel panel-default" >
    <div class="panel-heading"><h2 align="center">Solicitudes Pendientes por Respuesta</h2></div>
    <div class="panel-body " >
      @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
      <div class="form-group">
       @if (session('status'))
              <div class="alert alert-info">
                  {{ session('status') }}
              </div>
          @endif
     </div>

   

     <div class="form-group">
       <div class="col-md-0 col-md-offset-0 ">
                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Nueva PQRS</button>
        <div class="modal fade " id="myModal" role="dialog">
          <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <center><h3 class="modal-title">Ingreso de la Solicitud</h3></center>
                     <br>
                    </br>
                </div>

                   <div class="modal-body">
                      {!!Form::model(Request::all(),['route'=>['ingresar'], 'method'=>'POST','enctype'=>'multipart/form-data'])!!}
     @include('pqrs.registros.partials.form')
      <center><button type="submit" class="btn btn-info">Crear</button></center>
     {!!Form::close()!!}
                  </div>
            </div>
      </div>
    </div>
  </div>
</div>


<div class="col-md-0 col-md-offset-0">

  @include('pqrs.registros.partials.tabla')

</div>
</div>
</div>
</div>
</div>
@endsection