@extends('app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 col-md-offset-0">
      <div class="panel panel-default">

                                    @if(Session::has('message'))
                                        <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                                    @endif

            <div class="panel-heading"> <h1>{{$user->full_name}}</h1></div>

             <div class="col-md-8 col-md-offset-0"><h3>Datos del Empleado</h3></div>
             <div class="col-md-4 col-md-offset-0"><h3>Usuario</h3></div>
        <div class="panel-body">


          @if (count($errors) > 0)
            <div class="alert alert-danger" text-center>
              <strong>Oops!</strong> Ocurrio algun problema con su Ingreso.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {!!Form::model($user,['route'=>['admin.users.update',$user], 'method'=> 'PUT'])!!}
                @include('admin.users.partials.fields')







          {!!Form::close()!!}



        </div>
@include('admin.users.partials.delete')

      </div>

    </div>
  </div>
</div>
@endsection