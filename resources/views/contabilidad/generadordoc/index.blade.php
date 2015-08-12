@extends('......layouts.sidebar')

@section('content')

	<div class="row">
		  <div class="col-md-12 col-md-offset-0">
			<div class="panel panel-default">
				 <div class="panel-heading">

                    </div>
                     <div class="form-group">
                          @if(Session::has('message'))
                             <p class="alert alert-primary" text-center>{{Session::get('message')}} </p>
                             @endif
                             @if(Session::has('message2'))
                             <p class="alert alert-info" text-center>{{Session::get('message2')}} </p>
                              @endif
                             @if(Session::has('message3'))
                             <p class="alert alert-danger" text-center>{{Session::get('message3')}} </p>
                              @endif
                      </div>

				<div class="panel-body">

{{--{!! Form::model(Request::all(),['route' => 'contabilidad.revision.index', 'method' => 'GET', 'class'=>'navbar-form navbar-left pull-right', 'role' =>'search']) !!}--}}
        <ul class="nav nav-pills btn-material-grey-800">
               <li class="active" ><a class="text-" style="color: #FFFFff" data-toggle="pill" href="#home">Generar Documentos Equivalentes</a></li>
               <li><a class="text-" style="color: #FFFFff" data-toggle="pill" href="#menu1">Generar Ordenes de Pago</a></li>
               <li><a class="text-" style="color: #FFFFff" data-toggle="pill" href="#menu2">Documentos para Envio a Tesoreria</a></li>

             </ul>

             <div class="tab-content">
               <div id="home" class="tab-pane fade in active">


                                                       @include('contabilidad.generadordoc.partials.tab1')


                      {{--{!! $radicacion->appends(Request::only(['radicacion']))->render() !!}--}}
              </div>
               <div id="menu1" class="tab-pane fade ">
                    {!! Form::model(Request::all(),['route' => 'contabilidad.generadordoc.update', 'method' => 'PUT','enctype'=>'multipart/form-data']) !!}
                                                          @include('contabilidad.generadordoc.partials.tab2')
                                                       {!!Form::close()!!}

               </div>

               <div id="menu2" class="tab-pane fade ">
                                   {!! Form::model(Request::all(),['route' => 'contabilidad.generadordoc.show', 'method' => 'GET'])!!}
                                                                       @include('contabilidad.generadordoc.partials.tab3')
                                                                       {!!Form::close()!!}
              </div>

             </div>


                                                                    {{--{!! Form::text('factus',null,['class'=>'form-control floating-label','placeholder'=>'Buscar factura '])!!}--}}
                                                                      {{--</div>--}}

                                                                       {{--<button type="submit" class="btn btn-danger btn-sm">--}}
                                                                             {{--<span class="glyphicon glyphicon-search "></span> Buscar--}}

                                                                        {{--</button>--}}
                                                                        {{--</div>--}}




				</div>

			</div>
		</div>
	</div>
</div>

@endsection