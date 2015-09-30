@extends('......layouts.sidebar')
@section('content')
   <div class="container">
         <div class="col-md-0 col-lg-15">
              <div class="panel panel-default" >
                  <div class="panel-heading"><h3 align="center">Historico de la PQRS</h3></div>
                     <div class="panel-body " >
                            <div class="form-group">
                                @if(Session::has('message'))
                                <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                                @endif
                            </div>


                             <div class="col-md-0 col-md-offset-0">

                                    @include('pqrs.historicos.partials.tablahistorico')

                             </div>

                     </div>
              </div>
         </div>
   </div>
@endsection
