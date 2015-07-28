@extends('layouts.sidebar')

@section('content')

    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Roles</div>

                    @if(Session::has('message'))
                    <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                    @endif
                @if(Session::has('messages'))
                <p class="alert alert-info" text-center>{{Session::get('messages')}}</p>
                @endif

                @if($errors->any())
                <div class="alert alert-danger" role="danger">
                    <p>Por favor corrija los siguientes errores </p>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="panel-body">
                    <!--<h3>Bienvenido {{ Auth::user()->usr_name }}</h3>-->
                    <div class="form-group-danger col-md-4 col-md-offset-4">
                            {!! Form::open( [ 'route' => 'admin.roles.store' , 'method' => 'POST' ] ) !!}
                               {!!  Form::text('rol_nombre' ,null, ['class'=> 'form-control floating-label text-center','placeholder' => 'Digite el nombre del rol','required' , 'style' => 'text-transform:uppercase', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'] ) !!}


                           <button type="submit" class="btn btn-danger btn-sm" >
                                Crear nuevo rol

                            </button>
                                {!! Form::close() !!}
                    </div>


                            <div class="col-md-8 col-md-offset-2"  style="height: 380px; overflow-y: scroll">

                            <table class="table table-hover " >
                                <thead>
                                <tr>

                                    <th>Nombre rol</th>

                                    <th>Acciones</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($roles as $rol)
                                <tr class="active">

                                    <td> {{ $rol->rol_nombre }}</td>

                                    <td>

                                        <a  href="{{ route('admin.roles.edit', $rol) }}" title="Editar rol" >
                                            <span class="fa fa-pencil fa-9x text-danger" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('admin.roles.show', $rol) }}" title="Asignar modulos" >
                                            <span class="fa fa-th-list fa-9x text-info" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('rol.verpermisos', $rol) }}" title="Asignar permisos" >
                                            <span class="fa fa-lock fa-9x text-succes" aria-hidden="true"></span>
                                        </a>

                                        <a  onclick="return confirm('¿Esta seguro que desea eliminar este registro?')" href="{{ route ('rol.destroy', $rol) }}" title="Eliminar rol">
                                            <span class="fa fa-trash-o fa-9x text-danger" aria-hidden="true"></span>
                                        </a>


                                    </td>

                                </tr>
                                @endforeach
                                </tbody>

                            </table>
                            </div>


            </div>
        </div>
    </div>

        <script>
            ...
            //Una instancia para el formulario de envío de datos
            var miForm = null;
            ...
            //Carga de la página, donde creamos formularios emergentes
            window.onload = function() {
                ...
                // EJEMPLO DEL FORMULARIO PARA ENVIO DE DATOS -----
                //Creamos otro emergente para envío de datos
                miForm = new formEmerge("miForm", "Enviar datos",
                    true, 3, "marco", "miform.php", "post");
                //Componemos un literal HTML para la primera pestaña
                var html1 = "<label>Nombre:<input type='text' name='nombre' value='' " +
                    "size='35' class='fuente-mi-form' />" +
                    "</label><br />" +
                    "<label>Dirección:<input type='text' name='direccion' value='' " +
                    "size='35' class='fuente-mi-form' />" +
                    "</label><br />" +
                    "<label>E-mail:<input type='text' name='email' value='' " +
                    "size='35' class='fuente-mi-form' />" +
                    "</label><br />" +
                    "<label>Cuestión:<br /><textarea name='cuestion' rows='7' cols='40' "+
                    "class='fuente-mi-form'></textarea>" +
                    "</label>";
                //Componemos otro literal para la segunda pestaña
                var html2 = "<label>Edad:<input type='text' name='edad' value='' " +
                    "size='10' class='fuente-mi-form' />" +
                    "</label><br />" +
                    "<label>Profesión:<input type='text' name='profesion' value='' " +
                    "size='35' class='fuente-mi-form' />" +
                    "</label><br />" +
                    "<label>Aficiones:<input type='text' name='aficiones' value='' " +
                    "size='35' class='fuente-mi-form' />" +
                    "</label><br />";
                //Llenamos un array con los nombres de las pestañas
                var arrayPestanyas = new Array("Personales", "Otros datos");
                // Llenamos una array con los contenidos
                var arrayHtmls = new Array(html1, html2);
                // Creamos las pestañas con esos dos array y les damos
                //ancho, alto y "auto" para la propiedad overflow
                miForm.creaTabs(arrayPestanyas, arrayHtmls, "23em", "14em", "auto");
                ...
            }
        </script>

</div>
@endsection

