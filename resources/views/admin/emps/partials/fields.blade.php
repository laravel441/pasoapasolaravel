

<div class="col-sm-6">



                		<div class="form-group">
                			{!! Form::text('emp_nombre',null,['class'=>'form-control floating-label','placeholder'=>'Primer Nombre:','required'])!!}
                			@if($errors -> has('emp_nombre'))
                			    <p class="text-danger">{{$errors->first('emp_nombre')}} </p>
                			@endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_nombre2',null,['class'=>'form-control floating-label','placeholder'=>'Segundo Nombre:'])!!}
                			@if($errors -> has('emp_nombre2'))
                			    <p class="text-danger">{{$errors->first('emp_nombre2')}} </p>
                			@endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_apellido',null,['class'=>'form-control floating-label','placeholder'=>'Primer Apellido:','required'])!!}
                			@if($errors -> has('emp_apellido'))
                			    <p class="text-danger">{{$errors->first('emp_apellido')}} </p>
                			@endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_apellido2',null,['class'=>'form-control floating-label','placeholder'=>'Segundo Apellido:'])!!}
                			@if($errors -> has('emp_apellido2'))
                			    <p class="text-danger">{{$errors->first('emp_apellido2')}} </p>
                			@endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_identificacion',null,['class'=>'form-control floating-label','placeholder'=>'Identificación:','required'])!!}
                        @if($errors -> has('emp_identificacion'))
                                <p class="text-danger">{{$errors->first('emp_identificacion')}} </p>
                            @endif
                		</div>


                        <div class="form-group">
                			{!! Form::text('emp_an8',null,['class'=>'form-control floating-label','placeholder'=>'AN8:','required'])!!}
                        @if($errors -> has('emp_an8'))
                                <p class="text-danger">{{$errors->first('emp_an8')}} </p>
                            @endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_cod_tm',null,['class'=>'form-control floating-label','placeholder'=>'Codigo Transmilenio:'])!!}
                        @if($errors -> has('emp_cod_tm'))
                                <p class="text-danger">{{$errors->first('emp_cod_tm')}} </p>
                            @endif
                		</div>

                		<div class="form-group">
                        {!! Form::email('emp_correo',null,['class'=>'form-control floating-label','placeholder'=>'Email:','required'])!!}
                        @if($errors -> has('emp_correo'))
                                <p class="text-danger">{{$errors->first('emp_correo')}} </p>
                            @endif
                		</div>


  </div>{{--/.col-sm-6--}}

   <div class="col-sm-6">




                        <div class="form-group">
                 			{!! Form::text('emp_direccion',null,['class'=>'form-control floating-label','placeholder'=>'Dirección:'])!!}
                         @if($errors -> has('emp_identificacion'))
                                 <p class="text-danger">{{$errors->first('emp_identificacion')}} </p>
                             @endif
                 		</div>

                         <div class="form-group">
                 			{!! Form::text('emp_telefono',null,['class'=>'form-control floating-label','placeholder'=>'Telefono:'])!!}
                         @if($errors -> has('emp_telefono'))
                                 <p class="text-danger">{{$errors->first('emp_telefono')}} </p>
                             @endif
                 		</div>

                        <div class="form-group">
                			{!! Form::text('emp_celular',null,['class'=>'form-control floating-label','placeholder'=>'Celular:'])!!}
                        @if($errors -> has('emp_celular'))
                                <p class="text-danger">{{$errors->first('emp_celular')}} </p>
                            @endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_fecha_nacimiento',null,['class'=>'form-control floating-label','placeholder'=>'Fecha de Nacimiento:'])!!}
                        @if($errors -> has('emp_fecha_nacimiento'))
                                <p class="text-danger">{{$errors->first('emp_fecha_nacimiento')}} </p>
                            @endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('emp_fecha_ingreso',null,['class'=>'form-control floating-label','placeholder'=>'Fecha de Ingreso:'])!!}
                        @if($errors -> has('emp_fecha_ingreso'))
                                <p class="text-danger">{{$errors->first('emp_fecha_ingreso')}} </p>
                            @endif
                		</div>

                		<div class="form-group">
                			{!! Form::select('emp_area_id',
                			config('options.emp_area_id'),
                			null,
                			['class'=>'form-control floating-label','placeholder'=>'','required'])!!}
                			@if($errors -> has('emp_area_id'))
                                <p class="text-danger">{{$errors->first('emp_area_id')}} </p>
                             @endif
                		</div>


 </div>{{--/.col-sm-6--}}














