@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Permisos Modulo</div>

                <div class="panel-body">
                    <div class="form-group">
                        @if(Session::has('message'))
                        <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                        @endif
                    </div>
                    <!-- <h3>Bienvenido {{ Auth::user()->usr_name }}</h3>-->

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
                    <div class="col-md-7 col-md-offset-2 ">
                    {!! Form::model( $obrol , [ 'route' => ['rol.permisos', $obrol ], 'method' => 'POST' ] ) !!}


                        <table class="table table-hover" >
                            <thead>
                            <tr>

                                <th>Crear</th>
                                <th>Consultar</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($permisosModulo as $permiso)
                            <input type="hidden" class="hidden" value="{{ $permiso->mxr_flag_crear }}" name="estado_crear"/>
                            <input type="hidden" class="hidden" value="{{ $permiso->mxr_flag_consultar }}" name="estado_consultar"/>
                            <input type="hidden" class="hidden" value="{{ $permiso->mxr_flag_modificar }}" name="estado_modificar"/>
                            <input type="hidden" class="hidden" value="{{ $permiso->mxr_flag_eliminar }}" name="estado_eliminar"/>
                            <input type="hidden" class="hidden" value="{{ $permiso->mxr_mod_id }}" name="modulo_id"/>
                            <input type="hidden" class="hidden" value="{{ $permiso->mxr_rol_id }}" name="rol_id"/>
                            <tr class="active">
                                @if($permiso->mxr_flag_crear == true )

                                <td>
                                    <div class="container; btn-block btn-xs" >
                                        <span class="button-checkbox-au btn-xs">
                                            <button type="button" class="btn btn-block btn-xs" data-color="info"></button>
                                            <input type="checkbox" name="crear" value="{{$permiso->mxr_flag_crear}}" class="hidden" checked />

                                        </span>
                                    </div>

                                </td>
                                @else($permiso->mxr_flag_crear == false)

                                <td>
                                    <div class="container; btn-block btn-xs" >
                                        <span class="button-checkbox-au btn-xs">
                                            <button type="button" class="btn btn-block btn-xs" data-color="info">{{$permiso->mxr_flag_crear}}</button>
                                            <input type="checkbox" name="crear" value="{{$permiso->mxr_flag_crear}}" class="hidden"/>

                                        </span>
                                    </div>

                                </td>
                                @endif

                                @if($permiso->mxr_flag_consultar == true )

                                <td>
                                    <div class="container; btn-block btn-xs" >
                                        <span class="button-checkbox-au btn-xs">
                                            <button type="button" class="btn btn-block btn-xs" data-color="info"></button>
                                            <input type="checkbox" name="consultar" value="{{$permiso->mxr_flag_consultar}}" class="hidden" checked />

                                        </span>
                                    </div>

                                </td>
                                @else($permiso->mxr_flag_consultar == false)

                                <td>
                                    <div class="container; btn-block btn-xs" >
                                        <span class="button-checkbox-au btn-xs">
                                            <button type="button" class="btn btn-block btn-xs" data-color="info">{{$permiso->mxr_flag_consultar}}</button>
                                            <input type="checkbox" name="consultar" value="{{$permiso->mxr_flag_consultar}}" class="hidden"/>

                                        </span>
                                    </div>

                                </td>
                                @endif

                                @if($permiso->mxr_flag_modificar == true )

                                <td>
                                    <div class="container; btn-block btn-xs" >
                                        <span class="button-checkbox-au btn-xs">
                                            <button type="button" class="btn btn-block btn-xs" data-color="info"></button>
                                            <input type="checkbox" name="modificar" value="{{$permiso->mxr_flag_modificar}}" class="hidden" checked />

                                        </span>
                                    </div>

                                </td>
                                @else($permiso->mxr_flag_modificar == false)

                                <td>
                                    <div class="container; btn-block btn-xs" >
                                        <span class="button-checkbox-au btn-xs">
                                            <button type="button" class="btn btn-block btn-xs" data-color="info">{{$permiso->mxr_flag_modificar}}</button>
                                            <input type="checkbox" name="modificar" value="{{$permiso->mxr_flag_modificar}}" class="hidden"/>

                                        </span>
                                    </div>

                                </td>
                                @endif

                                @if($permiso->mxr_flag_eliminar == true )

                                <td>
                                    <div class="container; btn-block btn-xs" >
                                        <span class="button-checkbox-au btn-xs">
                                            <button type="button" class="btn btn-block btn-xs" data-color="info"></button>
                                            <input type="checkbox" name="eliminar" value="{{$permiso->mxr_flag_eliminar}}" class="hidden" checked />

                                        </span>
                                    </div>

                                </td>
                                @else($permiso->mxr_flag_eliminar == false)

                                <td>
                                    <div class="container; btn-block btn-xs" >
                                        <span class="button-checkbox-au btn-xs">
                                            <button type="button" class="btn btn-block btn-xs" data-color="info">{{$permiso->mxr_flag_eliminar}}</button>
                                            <input type="checkbox" name="eliminar" value="{{$permiso->mxr_flag_eliminar}}" class="hidden"/>

                                        </span>
                                    </div>

                                </td>
                                @endif

                            </tr>

                            </tbody>
                        </table>

                    <button type="submit" class="btn btn-danger btn-xs"  >
                        <span class="glyphicon glyphicon-pencil"></span> Asignar permisos
                    </button>
                    <br>

                    @endforeach
                    {!! Form::close() !!}
                        <a class="btn btn-primary btn-xs" style="margin-top: -7px; margin-left: 1px" href="{{ route('rol.verpermisos',$permiso->mxr_rol_id ) }}" >
                            <span class="glyphicon glyphicon-arrow-left" ></span> Volver
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection

