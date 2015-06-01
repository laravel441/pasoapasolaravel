<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>@section('title')Swcapital @show</title>

	{!! Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}
	{!! Html::style('bower_components/bootstrap-material-design/dist/css/material-fullpalette.min.css') !!}
	{!! Html::style('bower_components/bootstrap-material-design/dist/css/material.min.css') !!}
	{!! Html::style('bower_components/bootstrap-material-design/dist/css/ripples.min.css') !!}
	{!! Html::style('bower_components/bootstrap-material-design/dist/css/roboto.min.css') !!}



	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css' />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>

	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Swcapital</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{!! url('/') !!}">Inicio</a></li>


				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())

					@elseif((Auth::user()->type !='admin'))
                   <li><a href="{{route('admin.users.index')}}">Empleados</a></li>

                    <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->usr_name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{!! url('/auth/change_pass') !!}">Cambiar Contraseña</a></li>
                                <li><a href="{!! url('/auth/logout') !!}">Cerrar Sesión</a></li>

                                </ul>
                        </li>

						@else
						 <li><a href="{{route('admin.users.index')}}">Empleados</a></li>

                                                 {{--<li><a href="{!! url('/buscar_usuario/index') !!}">Buscarme</a></li>--}}
                        						<li class="dropdown">

                        							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->usr_name }} <span class="caret"></span></a>
                        							<ul class="dropdown-menu" role="menu">

                        								<li><a href="{!! url('/auth/logout') !!}">Cerrar Sesión</a></li>

                        							</ul>
                        						</li>


					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		@yield('content')
	</div>
	
	{!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
	{!! Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}
	{!! Html::script('bower_components/bootstrap-material-design/dist/js/material.min.js') !!}
	{!! Html::script('bower_components/bootstrap-material-design/dist/js/ripples.min.js') !!}
	{!! Html::script(js/list.js') !!}


@yield('scripts')

{{--los voy hacer en el Index de Admin/Users(Van los de bootstrap--}}
<script type="text/javascript">
		$(document).on('ready', function(){
			$.material.init();
		});
</script>

</body>
</html>