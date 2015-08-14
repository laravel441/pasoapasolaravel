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


                                </div>
                                 {!! Form::model(Request::all(),['route' => 'registro.index', 'method' => 'GET', 'class'=>'', 'role' =>'search']) !!}
                                @include('lavado.partials.checklistreg')
                                {!!Form::close()!!}


                    @if($ctls->ctl_fecha_fin == '0001-01-01 00:00:00')
                              {!!Form::open(['route'=>['reporte.store'], 'method'=> 'POST'])!!}


                                   <input class="form-control text-info"  name="ctl_id" type="hidden" value="{{$id}}">




                                                 <div class="form-group-danger">
                                                                  <div class="col-md-7 col-md-offset-2">
                                                                         <label  for="comment">Observaciones del Control:</label>
                                                                        <textarea class="form-control text-justify" rows="2" id="comment" name="ctl_observacion" value="{{$ctls->ctl_observacion}}">{{$ctls->ctl_observacion}}</textarea>

                                                                  </div><br>
                                                    </div><br><br><br>

                                                      <div class="col-md-offset-2">
                                                             <button type="submit" class=" btn btn-info btn-sm glyphicon glyphicon-lock">
                                                                Guardar Observación
                                                                </button>
                                                                <div class="col-md-0 col-md-offset-4">
                                                                          <button type="button" class="btn btn-danger btn-lg fa fa-lock fa-2x " data-toggle='modal' data-target='#Si' title="Cerrar Control"></button>
                                                                 </div>
                                                      </div>







                                            {!!Form::close()!!}



                           {!!Form::open(['route'=>['registro.update'], 'method'=> 'PUT'])!!}


                            <input class="form-control text-info"  name="ctl_id" type="hidden" value="{{$id}}">
                            <input class="form-control text-info"  name="ctl_observacion" type="hidden" value="{{$ctls->ctl_observacion}}">








                                                                         <div class="modal fade" id="Si" role="dialog" style='top: 180px'>
                                                                                   <div class="modal-dialog">
                                                                                       <div class="modal-content">
                                                                                                             <div class="modal-header well-material-grey-300">
                                                                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                   <h2 class="modal-title text-center">Cerrar Control</h2>
                                                                                                              </div>
                                                                                                  <div class="modal-body"></br>
                                                                                                      <h5 class="modal-title text-center text-primary">El control {{$id}} se cerrara</h5>
                                                                                                  </div>
                                                                                                  <div class="modal-footer">
                                                                                                      <div class="col-sm-8 col-sm-offset-0">
                                                                                                            <button type="submit" name="submit" value="1" class="btn btn"><span class="text-primary fa fa-check-square-o fa-3x" title="Cerrar Control"></span></button>
                                                                                                            <button type="button" class="btn btn" data-dismiss="modal"><span class="text-danger fa fa-times fa-3x" title="Cancelar"></span></button>
                                                                                                      </div>
                                                                                                  </div>
                                                                                       </div>
                                                                                   </div>
                                                                         </div>



                                     {!!Form::close()!!}

                             @else
                           <div class="form-group col-md-0   col-md-offset-1">
                                       <div class="col-md-0 col-md-offset-2">
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

