@extends('layouts.sidebar')

@section('content')

<div class="row">
    <div class="col-md-7 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Asignar modulos a rol</div>

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
                {!! Form::model( $obrol , [ 'route' => ['rol.modulos', $obrol ], 'method' => 'POST' ] ) !!}

                <h4> Modulos asignados para el rol{{" "}} <strong style="color:#00b0ff "> {{ $obrol->rol_nombre }}</strong>{{ " " }} </h4>
                <div class="col-md-4 col-md-offset-3" >



                    @foreach ($modulosRol as $modulo)
                    <input type="hidden" class="hidden" value="{{ $modulo->mod_id }}" name="lista_todos_modulos[]"/>

                    @if($modulo->mxr_mod_id != null)


                        <span class="button-checkbox-au btn-xs" style="padding: -1px;margin: -7px">
                            <button type="button" class="btn btn-block btn-xs" style="padding: -1px;margin: -7px; text-align: left" data-color="info">{{$modulo->mod_proyecto}}</button>
                            <input type="checkbox" name="modulos_seleccionados[]" value="{{ $modulo->mod_id }}" class="hidden" style="padding: -1px;margin: -4px" checked />

                        </span>

                    <input type="hidden" name="modulos_asignados[]" value="{{ $modulo->mod_id  }}" checked class="pull-right">



                    @else


                        <span class="button-checkbox-au btn-xs" style="padding: -1px;margin: -4px">
                            <button type="button" class="btn btn-block btn-xs" style="padding: -1px;margin: -4px; text-align: left" data-color="info">{{$modulo->mod_proyecto}}</button>
                            <input type="checkbox" name="modulos_seleccionados[]" value="{{ $modulo->mod_id }}" class="hidden" style="padding: -1px;margin: -4px"  />

                        </span>




                    @endif

                    @endforeach


                </div>
                <button type="submit" class="btn btn-danger btn-xs"  >
                    <span class="glyphicon glyphicon-plus"></span> Asignar modulos
                </button>

                {!! Form::close() !!}


                <a class="btn btn-primary btn-xs" style="margin-top: -7px; margin-left: 1px" href="{{ route('admin.roles.index')  }}" >
                    <span class="glyphicon glyphicon-arrow-left" ></span> Volver
                </a>




            </div>

        </div>
    </div>
</div>



@endsection

