@extends('layouts.sidebar')

@section('content')

    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Roles</div>

                <div class="panel-body">
                    <div class="form-group">
                        @if(Session::has('message'))
                        <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                        @endif
                    </div>
                   <!-- <h3>Bienvenido {{ Auth::user()->usr_name }}</h3>-->
                    <br><br>
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


                    <div class="center-block" style="width: 400px">
                        {!! Form::model( $obrol , [ 'route' => ['admin.roles.update', $obrol ], 'method' => 'PUT' ] ) !!}
                        <div class="form-group-danger">
                          <!--  <input type="text" name="rol_nombre" class="form-control floating-label"  " placeholder="Digite el nombre del rol"  style="text-transform:uppercase"   >-->
                            {!!  Form::text('rol_nombre' ,null, ['class'=> 'form-control floating-label','placeholder' => 'Digite el nombre del rol','required' , 'style' => 'text-transform:uppercase', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase()' ] ) !!}
                        </div>

                        <br/>
                  <button type="submit" class="btn btn-danger btn-xs"  >
                            <span class="glyphicon glyphicon-repeat"></span> Actualizar rol</button>

                        {!! Form::close() !!}
                    </div>
                        <a class="btn btn-primary btn-xs" href="{{ route('admin.roles.index')  }}" >
                            <span class="glyphicon glyphicon-arrow-left" ></span> Volver
                        </a>




                </div>

            </div>
        </div>
    </div>



@endsection

