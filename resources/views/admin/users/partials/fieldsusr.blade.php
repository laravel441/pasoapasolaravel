
<div class="col-sm-4">



                		<div class="form-group">
                			{!! Form::text('emp_nombre',null,['class'=>'form-control floating-label','placeholder'=>'Primer Nombre:','disabled'])!!}
                			@if($errors -> has('emp_nombre'))
                			    <p class="text-danger">{{$errors->first('emp_nombre')}} </p>
                			@endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_nombre2',null,['class'=>'form-control floating-label','placeholder'=>'Segundo Nombre:','disabled'])!!}
                			@if($errors -> has('emp_nombre2'))
                			    <p class="text-danger">{{$errors->first('emp_nombre2')}} </p>
                			@endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_apellido',null,['class'=>'form-control floating-label','placeholder'=>'Primer Apellido:','disabled'])!!}
                			@if($errors -> has('emp_apellido'))
                			    <p class="text-danger">{{$errors->first('emp_apellido')}} </p>
                			@endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_apellido2',null,['class'=>'form-control floating-label','placeholder'=>'Segundo Apellido:','disabled'])!!}
                			@if($errors -> has('emp_apellido2'))
                			    <p class="text-danger">{{$errors->first('emp_apellido2')}} </p>
                			@endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_identificacion',null,['class'=>'form-control floating-label','placeholder'=>'Identificación:','disabled'])!!}
                        @if($errors -> has('emp_identificacion'))
                                <p class="text-danger">{{$errors->first('emp_identificacion')}} </p>
                            @endif
                		</div>


                        <div class="form-group">
                			{!! Form::text('emp_an8',null,['class'=>'form-control floating-label','placeholder'=>'AN8:','disabled'])!!}
                        @if($errors -> has('emp_an8'))
                                <p class="text-danger">{{$errors->first('emp_an8')}} </p>
                            @endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_cod_tm',null,['class'=>'form-control floating-label','placeholder'=>'Codigo Transmilenio:','disabled'])!!}
                        @if($errors -> has('emp_cod_tm'))
                                <p class="text-danger">{{$errors->first('emp_cod_tm')}} </p>
                            @endif
                		</div>

                		<div class="form-group">
                        {!! Form::email('emp_correo',null,['class'=>'form-control floating-label','placeholder'=>'Email:','disabled'])!!}
                        @if($errors -> has('emp_correo'))
                                <p class="text-danger">{{$errors->first('emp_correo')}} </p>
                            @endif
                		</div>


  </div>{{--/.col-sm-6--}}

   <div class="col-sm-4">




                        <div class="form-group">
                 			{!! Form::text('emp_direccion',null,['class'=>'form-control floating-label','placeholder'=>'Dirección:','disabled'])!!}
                         @if($errors -> has('emp_identificacion'))
                                 <p class="text-danger">{{$errors->first('emp_identificacion')}} </p>
                             @endif
                 		</div>

                         <div class="form-group">
                 			{!! Form::text('emp_telefono',null,['class'=>'form-control floating-label','placeholder'=>'Telefono:','disabled'])!!}
                         @if($errors -> has('emp_telefono'))
                                 <p class="text-danger">{{$errors->first('emp_telefono')}} </p>
                             @endif
                 		</div>

                        <div class="form-group">
                			{!! Form::text('emp_celular',null,['class'=>'form-control floating-label','placeholder'=>'Celular:','disabled'])!!}
                        @if($errors -> has('emp_celular'))
                                <p class="text-danger">{{$errors->first('emp_celular')}} </p>
                            @endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_fecha_nacimiento',null,['class'=>'form-control floating-label','placeholder'=>'Fecha de Nacimiento:','disabled'])!!}
                        @if($errors -> has('emp_fecha_nacimiento'))
                                <p class="text-danger">{{$errors->first('emp_fecha_nacimiento')}} </p>
                            @endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_fecha_ingreso',null,['class'=>'form-control floating-label','placeholder'=>'Fecha de Ingreso:','disabled'])!!}
                        @if($errors -> has('emp_fecha_ingreso'))
                                <p class="text-danger">{{$errors->first('emp_fecha_ingreso')}} </p>
                            @endif
                		</div>

                		<div class="form-group">
                			{!! Form::select('emp_area_id',
                			config('options.emp_area_id'),
                			null,
                			['class'=>'form-control floating-label','placeholder'=>'Área','disabled'])!!}
                			@if($errors -> has('emp_area_id'))
                                <p class="text-danger">{{$errors->first('emp_area_id')}} </p>
                             @endif
                		</div>


 </div>{{--/.col-sm-6--}}

   <div class="col-sm-4">



                        @if ($user->usr_id != "")
                 		<div class="form-group">
                 			{!! Form::text('usr_name',null,['class'=>'form-control floating-label','placeholder'=>'Usuario:','disabled'])!!}
                 			@if($errors -> has('usr_name'))
                                 <p class="text-danger">{{$errors->first('usr_name')}} </p>
                             @endif
                         @else
                            <div class="form-group">
                 			{!! Form::text('usr_name',null,['class'=>'form-control floating-label','placeholder'=>'Usuario:',])!!}
                 			@if($errors -> has('usr_name'))
                                 <p class="text-danger">{{$errors->first('usr_name')}} </p>
                             @endif
                             @endif

                        <div class="form-group">
                        {!! Form::hidden('password',null,['class'=>'form-control floating-label','placeholder'=>''])!!}
                        @if($errors -> has('password'))
                                <p class="text-danger">{{$errors->first('password')}} </p>
                            @endif
                		</div>



                        <div class="form-group">
                			{!! Form::select('usr_caducidad',
                			config('options.usr_caducidad'),
                			null,
                			['class'=>'form-control floating-label','placeholder'=>'Caducidad contraseña',])!!}
                			@if($errors -> has('usr_caducidad'))
                                <p class="text-danger">{{$errors->first('usr_caducidad')}} </p>
                             @endif
                		</div>






                @if ($user->usr_id != "")
                {!!Form::open(['route'=>['admin.users.edit',$user], 'method'=> 'PUT'])!!}

                                   <div class="form-group">
                                           <div class="col-md-0 col-md-offset-3">
                                       <button type="submit" onclick="return confirm ('Esta seguro de actualizar el usuario?')"class="btn btn-info">
                                        Actualizar Usuario
                                       </button>
                                     </div>
                                   </div>

                                 {!!Form::close()!!}
                @else
                            {!!Form::open(['route'=>['admin.users.store',$user], 'method'=> 'POST'])!!}

                                   <div class="form-group">
                                           <div class="col-md-0 col-md-offset-3">
                                       <button type="submit" onclick="return confirm ('Esta seguro de actualizar el usuario?')"class="btn btn-primary">
                                       Crear Usuario
                                       </button>
                                     </div>
                                   </div>

                                 {!!Form::close()!!}

                @endif




                     </div>{{--/.col-sm-6--}}











