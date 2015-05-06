@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 col-md-offset--2">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<h3>Bienvenido {{ Auth::user()->full_name }}</h3>

					<!doctype html>
                    <html lang=''>
                    <head>
                    <meta charset='utf-8'>
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
                    {!! Html::style('bower_components/menus/css/styles.css') !!}

                    {!! Html::script('bower_components/menus/js/script.js') !!}



                    <title>SW CAPITAL</title>
                    </head>
                    <body>
                    {{--<div id='cabecera'>--}}
                     {{--@include('admin.menus.header')--}}
                    {{--</div>--}}
                    <div id='cssmenu'>
                    <ul>
                    <li class='has-sub'><a href ='#'><span>Menu</span></a>

                    <li class='has-sub'><a href='#'><span>Soporte</span></a>
                    <ul>
                    <li><a href='consulta.php'><span>Asignar Requerimientos</span></a></li>
                    <li><a href='datgrd2.php'><span>Bandeja de Requerimientos</span></a></li>
                    <li class='last'><a href='prueba.php'><span>Requerimientos asignados</span></a></li>
                    </ul>
                    </li>
                    <li class='has-sub'><a href='#'><span>Correspondencia</span></a>
                    <ul>
                    <li><a href='prueba.php'><span>Radicacion</span></a></li>
                    <li><a href='consulta.php'><span>Asignacion</span></a></li>
                    <li><a href='datgrd2.php'><span>Bandeja de Entrada</span></a></li>
                    <li><a href='#'><span>Control correspondencia</span></a></li>
                    <li class='last'><a href='#'><span>Control de Salida</span></a></li>
                    </ul>
                    </li>
                    <li class='has-sub'><a href='#'><span>Facturacion</span></a>
                    <ul>
                    <li><a href='#'><span>Control de Radicacion</span></a></li>
                    <li><a href='#'><span>Generador de Sticker</span></a></li>
                    <li class='last'><a href='#'><span>Historico de Facturas</span></a></li>
                    </ul>
                    </li>
                    <li class='has-sub'><a href='#'><span>Contabilidad</span></a>
                    <ul>
                    </li>
                    <li><a href='#'><span>Revision</span></a></li>
                    </ul>
                    <li class='last'><a href='#'><span>Generador de Documentos</span></a>
                    <ul>
                    	<li><a href='#'><span>Documentos Nomina</span></a></li>
                    	<li><a href='#'><span>Documentos Facturacion</span></a></li>
                    </ul>
                    </li>

                    <li class='has-sub'><a href='#'><span>Seguridad</span></a>
                    <ul>
                    <li><a href='#'><span>Creacion de Usuarios</span></a></li>
                    <li><a href='#'><span>Actualizacion de Usuarios</span></a></li>
                    <li class='last'><a href='#'><span>Configuracion de Roles</span></a></li>
                    </ul>
                    </li>
                    <li class='last'><a href='#'><span>Perfil</span></a>
                    <ul>
                    <li><a href='#'><span>Cambiar Contraseña</span></a></li>
                    </ul>
                    </li>
                    <li class='last'><a href='#'><span>Aplicaciones</span></a>
                    <ul>
                    <li><a href='http://192.168.46.39/glpi/?usuario={{ base64_encode(Auth::user()->user_name) }}&password={{ base64_encode(Auth::user()->password) }}&valido=<?php echo base64_encode('T')?>' target="_blank"><span>Mesa de Ayuda</span></a></li>
                    </ul>
                    </li>
                    </ul>
                    </ul>
                    </div>
                    </body>
                    {{--<div id ='pie'>--}}

                     {{--@include('admin.menus.footer')--}}
                    {{--<a href ="login.php"> {!! Html::image('bower_components/menus/img/boton_salir.gif') !!}--}}


                    {{--</div>--}}

                    <html>

				</div>

			</div>
		</div>
	</div>
</div>
@endsection