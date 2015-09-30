@extends('......layouts.sidebar')


@section('content')

   <div class="container">
         <div class="col-md-20 col-md-offset-0">
          	  <div class="panel panel-default" >
          		    <div class="panel-heading"><div class="col-md-4"><button type="button" class="btn btn-danger" onClick="history.go(-1);return true;"><span class="glyphicon glyphicon-chevron-left"></span></buttton></div><h3 align="left">Diligenciamiento de la Respuesta</h3></div>
          		    <div class="panel-body " >
                         <div class="form-group">
                               @if(Session::has('message'))
                               <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                               @endif
                         </div>

                                       @include('pqrs.registros.partials.respuestareg')

       			    </div>
          	     </div>
             </div>
         </div>
    </div>
@endsection