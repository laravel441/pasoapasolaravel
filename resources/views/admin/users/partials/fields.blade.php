
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
                            </div>

                        <div class="form-group-danger">
                            {!! Form::select('usr_caducidad',
                            config('options.usr_caducidad'),
                            null,
                            ['class'=>'form-control floating-label','placeholder'=>'Caducidad contraseña',])!!}
                            @if($errors -> has('usr_caducidad'))
                                <p class="text-danger">{{$errors->first('usr_caducidad')}} </p>
                             @endif
                        </div>
                        <div class="form-group">

                        </div>

                        <div class="form-group-danger">
                            {!! Form::select('usr_stu_id',
                            config('options.usr_stu_id'),
                            null,
                            ['class'=>'form-control floating-label','placeholder'=>'Estado Usuario',])!!}
                            @if($errors -> has('usr_stu_id'))
                                <p class="text-danger">{{$errors->first('usr_stu_id')}} </p>
                             @endif
                        </div>
                        <h4>Roles del usuario</h4>
                            <div class="col-md-12 col-md-offset-0" style="height: 170px; overflow-y: scroll">

                                    @foreach ($rolestabla as $rol)
                            <div class="col-md-6">

                                        <input type="hidden" class="hidden" value="{{ $rol->rol_id }}" name="lista_todos_roles[]"/>

                                            @if($rol->uxr_id != null)
                                                <span class="button-checkbox-au btn-xs" style="padding: -1px;margin: -15px">
                                                <button type="button" class="btn btn-block btn-xs" style="padding: -20px;margin: -7px;text-align: left" data-color="info">{{$rol->rol_nombre}}</button>
                                                <input type="checkbox" name="roles_seleccionados[]" value="{{ $rol->rol_id  }}" class="hidden" style="padding: -20px;margin: -10px" checked />
                                                </span>
                                                <input type="hidden" name="roles_asignados[]" value="{{ $rol->rol_id  }}" checked class="pull-right">

                                            @else
                                                <span class="button-checkbox-au btn-xs" style="padding: -1px;margin: -15px">
                                                <button type="button" class="btn btn-block btn-xs" style="padding: -20px;margin: -7px;text-align: left" data-color="info">{{ $rol->rol_nombre }}</button>
                                                <input type="checkbox" name="roles_seleccionados[]" value="{{ $rol->rol_id }}" class="hidden" style="padding: -1px;margin: -4px"  />
                                                </span>
                                            @endif
                                             </div>
                                    @endforeach

                            </div>
                            <br>
                            <br>


                            <div class="col-md-6 col-md-offset-0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="contrasenia" value="1"> Cambiar Contraseña
                                    </label>
                                </div>
                            </div>
                             {{--@if ($user->usr_flag_pass == "TRUE")--}}
                             {{--<div class="col-md-6 col-md-offset-0">--}}
                                 {{--<div class="checkbox">--}}
                                     {{--<label>--}}
                                       {{--<input type="checkbox" name="usr_flag_pass" value="0" checked> Usuario sin ingresar--}}
                                     {{--</label>--}}
                                 {{--</div>--}}
                             {{--</div>--}}
                             {{--@else--}}
                            {{--<div class="col-md-6 col-md-offset-0">--}}
                                  {{--<div class="checkbox">--}}
                                      {{--<label>--}}
                                        {{--<input type="checkbox" name="usr_flag_pass" value="1" > Cambiar contraseña--}}
                                      {{--</label>--}}
                                  {{--</div>--}}
                            {{--</div>--}}
                            {{--@endif--}}


                           <div class="form-group">
                              <div class="col-md-0 col-md-offset-3">
                                <button type="submit" onclick="return confirm ('Esta seguro de actualizar el usuario?')"class="btn btn-info">
                                         Actualizar Usuario
                                </button>
                              </div>
                           </div>



              @else
                        <div class="form-group">
                        {!! Form::text('usr_name',null,['class'=>'form-control floating-label','placeholder'=>'Usuario:',''])!!}
                        @if($errors -> has('usr_name'))
                             <p class="text-danger">{{$errors->first('usr_name')}} </p>
                        @endif
                        </div>

                        <div class="form-group">
                            {!! Form::hidden('usr_emp_an8',null,['class'=>'form-control floating-label','placeholder'=>'Usuario:',''])!!}
                            @if($errors -> has('usr_emp_an8'))
                                 <p class="text-danger">{{$errors->first('usr_emp_an8')}} </p>
                            @endif
                        </div>

                        <div class="form-group-danger">
                            {!! Form::select('usr_caducidad',
                            config('options.usr_caducidad'),
                            null,
                            ['class'=>'form-control floating-label','placeholder'=>'Caducidad contraseña',])!!}
                            @if($errors -> has('usr_caducidad'))
                                <p class="text-danger">{{$errors->first('usr_caducidad')}} </p>
                             @endif
                        </div>

                        <div class="form-group">

                        </div>

                        <div class="form-group-danger">
                        {!! Form::select('usr_stu_id',
                        config('options.usr_stu_id'),
                        null,
                        ['class'=>'form-control floating-label','placeholder'=>'Estado Usuario',])!!}
                        @if($errors -> has('usr_stu_id'))
                            <p class="text-danger">{{$errors->first('usr_stu_id')}} </p>
                         @endif
                        </div>





                            <div class="form-group">
                                <div class="col-md-0 col-md-offset-3">
                                    <button type="submit" onclick="return confirm ('Esta seguro de crear el usuario?')"class="btn btn-info">
                                        Crear Usuario
                                     </button>
                                </div>
                            </div>


            @endif












    </div>{{--/.col-sm-6--}}











