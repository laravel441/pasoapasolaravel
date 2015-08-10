@extends('layouts.sidebar_lavado')


@section('content')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                            <div class="panel-heading"><h3>Registro de Lavado de Vehículos (Controles-Administrador) </h3><h6 align="left">{{ Auth::user()->usr_name }}
                                <?php $date = new DateTime();  echo date_format($date, '    d-m-Y (H:i)');?></h6>
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
                         <div>




                                {{--{!! Form::model(Request::all(),['route' => 'lavado.index', 'method' => 'GET', 'class'=>'navbar-form navbar-left pull-right', 'role' =>'search']) !!}--}}

                                         {{--<div class="col-md-6 col-md-offset-0 form-group-danger">--}}
                                             {{--{!! Form::text('control',null,['class'=>'form-control floating-label','placeholder'=>'Buscar control '])!!}--}}
                                         {{--</div>--}}

                                          {{--<button type="submit" class="btn btn-danger btn-sm">--}}
                                                {{--<span class="glyphicon glyphicon-search "></span> Buscar--}}

                                           {{--</button>--}}


                                    {{--</div>--}}





@include('lavado.admin.partials.table')


                       {{--{!! $ctls->appends(Request::only(['control']))->render() !!}--}}
</div>

                </div>
            </div>
        </div>



@endsection
