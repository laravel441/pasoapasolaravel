    @extends('layouts.default')

    @section('content')
    <div class="container">
        <div class="row"><br>
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Cambiar contraseña</h3></div>
                    <div class="form-group">
                        @if(Session::has('message'))
                        <p class="alert alert-danger" text-center>{{Session::get('message')}}</p>
                        @endif
                    </div>
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


                        {!! Form::open([ 'url' => 'admin/users/cambio'])  !!}
                        <div class="form-group-danger">

                            {!! Form::password('passwordActual', ['class'=> 'form-control floating-label','placeholder'=>'Digite su contraseña actual','required']) !!}
                        </div>
                            <br>
                        <div class="form-group-danger">

                            {!! Form::password('password', ['class'=> 'form-control floating-label', 'placeholder'=>'Digite su contraseña nueva','required']) !!}
                        </div>
                            <br>
                        <div class="form-group-danger">

                            {!! Form::password('password_confirmation', ['class'=> 'form-control floating-label', 'placeholder'=>'Confirme su contraseña nueva','required']) !!}
                        </div>
                            <br>
                        <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-danger" >Cambiar contraseña</button>
                        </div>
                        {!! Form::close() !!}



                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    @endsection


