 <div class="col-sm-12">


                		<div class="form-group">
                			{!! Form::text('first_name',null,['class'=>'form-control floating-label','placeholder'=>'Nombre:','required'])!!}
                			@if($errors -> has('first_name'))
                			    <p class="text-danger">{{$errors->first('first_name')}} </p>
                			@endif
                		</div>

                        <div class="form-group">
                			{!! Form::text('last_name',null,['class'=>'form-control floating-label','placeholder'=>'Apellido:','required'])!!}
                			@if($errors -> has('last_name'))
                			    <p class="text-danger">{{$errors->first('last_name')}} </p>
                			@endif
                		</div>

                		<div class="form-group">
                			{!! Form::text('user_name',null,['class'=>'form-control floating-label','placeholder'=>'Usuario:','required'])!!}
                			@if($errors -> has('user_name'))
                                <p class="text-danger">{{$errors->first('user_name')}} </p>
                            @endif
                		</div>

                        {{--<div style="display: none">--}}
                			{{--{!! Form::hidden('user_name_c',null,['class'=>'form-control floating-label'])!!}--}}

                		{{--</div>--}}

                        <div class="form-group">
                			{!! Form::email('email',null,['class'=>'form-control floating-label','placeholder'=>'Email:','required'])!!}
                        @if($errors -> has('email'))
                                <p class="text-danger">{{$errors->first('email')}} </p>
                            @endif
                		</div>

                        <div class="form-group">
							{!! Form::password('password',['class'=>'form-control floating-label','placeholder'=>'Password:'])!!}
                        @if($errors -> has('password'))
                                <p class="text-danger">{{$errors->first('password')}} </p>
                            @endif
						</div>

                		<div class="form-group">
                			{!! Form::select('type',
                			[''=>'','admin'=>'Admin','user'=>'User'],
                			null,
                			['class'=>'form-control floating-label','placeholder'=>'Seleccione Tipo','required'])!!}
                			@if($errors -> has('type'))
                                <p class="text-danger">{{$errors->first('type')}} </p>
                             @endif
                		</div>


                    </div>{{--/.col-sm-6--}}

