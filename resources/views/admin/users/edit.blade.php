@extends('app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">

                                    @if(Session::has('message'))
                                        <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                                    @endif

        <div class="panel-heading">Editar Usuario: <h2>{{$user->usr_name}}</h2></div>

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


            <div class="form-group">
              <div class="col-md-7 col-md-offset-0">
                <button type="submit" class="btn btn-primary">
                  Actualizar usuario
                </button>
              </div>
            </div>


          {!!Form::close()!!}
              @include('admin.users.partials.delete')


        </div>
      </div>
    </div>
  </div>
</div>
@endsection