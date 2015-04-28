@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>
                      <div class="panel-body">
                           <div class="form-group">
                           	<div class="col-md-8 col-md-offset-4">
                           <a href="{{route('admin.users.create')}}" class="btn btn-primary btn-lg active" role="button">Nuevo Usuario</a>
                               </div>
                               </div>

                        <p>Hay {{$users->total()}} usuarios</p>

                            @include('admin.users.partials.table')
                      {!!$users->render()!!}

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection