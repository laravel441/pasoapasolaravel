@extends('layouts.sidebar')

@section('content')

    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Asignar o quitar permisos a modulos</div>

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
                    <div class="col-md-8 col-md-offset-2">
                    {!! Form::model( $obrol , [ 'route' => ['rol.modulos', $obrol ], 'method' => 'POST' ] ) !!}
                    <a class="btn btn-primary btn-xs" style="margin-top: -10px" href="{{ route('admin.roles.index')  }}" >
                        <span class="glyphicon glyphicon-arrow-left" ></span> Volver
                    </a>




                        @if($modulosVacio == true)
                        <h4 style="color: red">Este rol no tiene modulos asignados</h4>
                        <br>
                        @else

                        <h4> Modulos asignados para el rol{{" "}} <strong style="color:#00b0ff "> {{ $obrol->rol_nombre }}</strong>{{ " " }} </h4>
                        @endif

                        <table class="table table-hover" style="margin: -10px;width: 270px" >
                            <thead>
                            <tr>
                                <th>Modulo</th>
                                <th>Permisos</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($modulosRol as $modulo)
                            <input type="hidden" class="hidden " value="{{ $modulo->mod_id }}" name="lista_todos_modulos[]"/>
                            <tr class="active" style="margin: 1px;width: 4px">
                                @if($modulo->mxr_mod_id != null)
                                <td>
                                    <div class="container; btn-block" >
                                        <span class="button-checkbox">
                                            <label class="btn btn-block disabled btn-xs" data-color="info">{{$modulo->mod_proyecto}}</label>
                                            <input type="checkbox" name="modulos_seleccionados[]" value="{{ $modulo->mod_id }}" class="hidden" checked />

                                        </span>
                                    </div>


                                </td>
                                <td>
                                    <a class="btn btn-primary btn-xs btn-block" href="{{ route('rol.permisos', [$obrol->rol_id ,$modulo->mod_id] ) }}" >
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Asignar permisos
                                    </a>
                                </td>



                            </tr>


                            @endif
                            @endforeach

                            </tbody>

                        </table>




                    {!! Form::close() !!}





                </div>

            </div>
        </div>
    </div>
</div>


@endsection

