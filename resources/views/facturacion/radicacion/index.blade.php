@extends('......layouts.sidebar')

@section('content')

	<div class="row">
		  <div class="col-md-12 col-md-offset-0">
			<div class="panel panel-default">
				 <div class="panel-heading">

                    </div>
                     <div class="form-group">
                         @if(Session::has('message'))
                         <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                         @endif
                     </div>

				<div class="panel-body">




             <ul class="nav nav-pills btn-material-grey-800"style="width: 19%;border-radius: 8%">
               <li class="active" ><a class="text-" style="color: #FFFFff" data-toggle="pill" href="#home">Registro y Radicación</a></li>
               <li><a class="text-" style="color: #FFFFff" data-toggle="pill" href="#menu1">Envio</a></li>
              
             </ul>

             <div class="tab-content">
               <div id="home" class="tab-pane fade in active">

                    @include('facturacion.radicacion.partials.tab1')
                      {{--{!! $radicacion->appends(Request::only(['radicacion']))->render() !!}--}}
              </div>
               <div id="menu1" class="tab-pane fade ">
                    @include('facturacion.radicacion.partials.tab2')

               </div>

             </div>





			</div>
		</div>
	</div>
</div>

@endsection