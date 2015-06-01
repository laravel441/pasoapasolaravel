@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">Iniciar Sesión</div>
				<div class="panel-body">



					@if (count($errors) > 0)
						<div class="alert alert-danger text-center">
							<strong>Oops!</strong> Ocurrio algun problema con su Ingreso.<br><br>
                            <ul>
                            		@foreach ($errors->all() as $error)
                            		<li>{{ $error }}</li>
                            		@endforeach
                            </ul>
						</div>
					@endif

					{!! Form::open(['url'=> 'auth/login','role'=>'form','class'=>'form-horizontal'])!!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

						{{--<div class="form-group">--}}
							{{--{!! Form::label('user_name','Usuario:', ['class'=>'col-md-4 control-label'])!!}--}}
							{{--<div class="col-md-6">--}}
								{{--{!! Form::text('user_name', old('user_name'),--}}
								{{--['class'=>'form-control', 'placeholder'=>'nombre.apellido']--}}
								{{--)!!}--}}
							{{--</div>--}}
						{{--</div>--}}
                        <div>
                        	{!! Form::label('usr_name','Usuario:', ['class'=>'col-md-4 control-label'])!!}
					       	<div class="form-group-danger col-md-6">
                        			{!! Form::text('usr_name',null,['class'=>'form-control floating-label ','placeholder'=>'nombre.apellido','required'])!!}
                                </div>
                        </div>

						<div>
							{!! Form::label('password','Password:',['class'=> 'col-md-4 control-label' ])!!}
							<div class="form-group-danger col-md-6">
								{!!Form::password('password',['class'=>'form-control'])!!}
							</div>
						</div>

                        <div class="form-group">
                        	<div class="col-md-6 col-md-offset-4">
                        	    <div class="checkbox">
                        			<label>
                        				<input type="checkbox" name="remember"> Recuérdame
                        		    </label>
                        		</div>
                        	</div>
                        </div>






						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-danger">Entrar</button>

								<a href="{{action ('ResetController@recuperar')}}" class="text-danger"> ¿Olvidaste tu Password? </a>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection