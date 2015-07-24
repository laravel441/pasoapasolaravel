@extends('layouts.sidebar')

@section('content')

<div class="row">
    <div class="col-md-5 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">Quitar usuarios de roles</div>

            @if(Session::has('messages'))
            <p class="alert alert-info" text-center>{{Session::get('messages')}}</p>
            @endif
            @if(Session::has('messagesl'))
            <p class="alert alert-danger" text-center>{{Session::get('messagesl')}}</p>
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
                        @foreach ($borrar_roles as $rol)
                        @endforeach
                 <div class="col-md-6 col-md-offset-4">
                         <a class="btn btn-danger btn-sm" onclick="return confirm('Este proceso quitara todos los usuarios asignados a este rol ¿Esta seguro de continuar?')" href="{{ route ('rol.borrar', $rol->uxr_rol_id) }}" title="Eliminar rol">
                           <span class="" aria-hidden="true"></span>Quitar usuarios
                       </a>
                       </div>
                <div class="col-md-8 col-md-offset-2"style="height: 300px; overflow-y: scroll" >

                    <table class="table table-hover "  >
                        <thead>
                             <tr>
                                    <th>Nombre usuario</th>
                             </tr>
                        </thead>
                        <tbody>
                             @foreach ($users as $user)
                                  <tr class="active">
                                    <td> {{ $user->usr_name }}</td>
                                 </tr>
                            @endforeach
                        </tbody>



                    </table>
                </div>
                     <div class="col-md-6 col-md-offset-0">
                    <a class="btn btn-primary btn-sm"  href="{{ route('admin.roles.index')  }}" >
                        <span class="glyphicon glyphicon-arrow-left" ></span> Volver
                    </a>
                    </div>

            </div>
        </div>
    </div>

</div>
@endsection

