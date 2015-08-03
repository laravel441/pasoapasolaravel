@extends('layouts.sidebar_lavado')


@section('content')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                               <div class="panel-heading"><h3 align="center">Control de calidad y planilla de servicio de lavado
                                           [#{{$ctls->ctl_id}}] </h3><h6 align="center"> {{ Auth::user()->usr_name }}
                                           <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?></h6>
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



                                {{--<div class="col-md-6 col-md-offset-0 form-group-danger">--}}
                                      {{--{!! Form::text('registro',null,['class'=>'form-control floating-label','placeholder'=>'Buscar movil '])!!}--}}
                                  {{--</div>--}}

                                   {{--<button type="submit" class="btn btn-danger btn-sm">--}}
                                        {{--<span class="glyphicon glyphicon-search "></span> Buscar--}}
                                    {{--</button>--}}


                                </div>
                                 {!! Form::model(Request::all(),['route' => 'registro.index', 'method' => 'GET', 'class'=>'', 'role' =>'search']) !!}
                                @include('lavado.partials.checklistreg')
                                {!!Form::close()!!}


                    @if($ctls->ctl_fecha_fin == '0001-01-01 00:00:00')
                              {!!Form::open(['route'=>['reporte.store'], 'method'=> 'POST'])!!}


                                   <input class="form-control text-info"  name="ctl_id" type="hidden" value="{{$id}}">
                                        <div class="form-control-wrapper form-group-danger col-md-10 col-md-offset-1">


                                                 <label  for="comment">Observaciones del Control:</label>
                                                      <textarea class="form-control text-justify" rows="2" id="comment" name="ctl_observacion" value="{{$ctls->ctl_observacion}}">{{$ctls->ctl_observacion}}</textarea>

                                                             <button type="submit"
                                                                class=" btn btn-info btn-sm glyphicon glyphicon-lock">
                                                                Guardar Observación
                                                                </button>


                                                 </div>



                                            {!!Form::close()!!}



                           {!!Form::open(['route'=>['registro.update'], 'method'=> 'PUT'])!!}


                            <input class="form-control text-info"  name="ctl_id" type="hidden" value="{{$id}}">
                            <input class="form-control text-info"  name="ctl_observacion" type="hidden" value="{{$ctls->ctl_observacion}}">

                                            <div class="form-group">
                                                        <div class="col-md-0 col-md-offset-5">
                                                                <button type="submit"
                                                                class=" btn btn-danger btn-sm glyphicon glyphicon-lock">
                                                                Cerrar Control
                                                                </button>
                                                        </div>
                                              </div>

                                     {!!Form::close()!!}

                             @else
                           <div class="form-group">
                                       <div class="col-md-0 col-md-offset-1">
                                              <label  for="comment">Observaciones del Control:</label>
                                              <textarea class="form-control text-info text-justify"  rows=2" id="comment" disabled="disabled" name="ctl_observacion" value="{{$ctls->ctl_observacion}}">{{$ctls->ctl_observacion}}</textarea>

                                       </div>
                             </div>






                             @endif


                        {!! $regs->appends(Request::only(['registro']))->render() !!}


             </div>
         </div>
    </div>

@endsection

