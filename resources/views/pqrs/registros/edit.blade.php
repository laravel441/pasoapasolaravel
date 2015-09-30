@extends('......layouts.sidebar')


@section('content')

<div class="container">
 <div class="col-md-20 col-md-offset-0">
   <div class="panel panel-default" >
    <div class="panel-heading"><div class="col-md-1"><button type="button" class="btn btn-danger text-center" onClick="history.go(-1);return true;"><span class="glyphicon glyphicon-chevron-left text-center"></span></buttton></div><h3 class="text-center" id="title">Editar Solicitud</h3></div>
    <div class="panel-body " >
      <div class="form-group">
        
       @if(Session::has('message'))
       <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
       @endif
     </div>

     {!!Form::model(Request::all(),['route'=>['actualizar-id'], 'method'=>'POST','enctype'=>'multipart/form-data'])!!} 
     @include('pqrs.registros.partials.fields')
     <center><button type="submit" class="btn btn-info">Actualizar PQRS</button></center>
     {!!Form::close()!!}
   </div>
 </div>
</div>
</div>
@endsection
<style type="text/css">
#title{
  color: black;
}
</style>