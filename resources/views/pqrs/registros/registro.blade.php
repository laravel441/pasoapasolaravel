@extends('......layouts.sidebar')


@section('content')


<div class="container">
 <div class="col-md-12 col-md-offset-0">
   <div class="panel panel-default" >
    <div class="panel-heading"><h3 align="center">Solicitudes Pendientes por Respuesta</h3></div>
    <div class="panel-body " >
      <div class="form-group">
       @if(Session::has('message'))
       <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
       @endif
     </div>
     {!!Form::model(Request::all(),['route'=>['ingresar'], 'method'=>'POST','enctype'=>'multipart/form-data'])!!}
     @include('pqrs.registros.partials.form')
      <center><button type="submit" class="btn btn-info">Crear</button></center>
     {!!Form::close()!!}
   </div>
 </div>
</div>
</div>

@endsection


