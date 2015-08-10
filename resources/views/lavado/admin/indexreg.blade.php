@extends('layouts.sidebar_lavado')


@section('content')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                               <div class="panel-heading"><h3 align="center">Control de calidad y planilla de servicio de lavado (Registros-Administrador)
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

                                @include('lavado.admin.partials.checklistreg')






                           <div class="form-group">
                                       <div class="col-md-0 col-md-offset-1">
                                              <label  for="comment">Observaciones del Control:</label>
                                              <textarea class="form-control text-info text-justify"  rows=2" id="comment" disabled="disabled" name="ctl_observacion" value="{{$ctls->ctl_observacion}}">{{$ctls->ctl_observacion}}</textarea>

                                       </div>
                             </div>











             </div>
         </div>
    </div>

@endsection

