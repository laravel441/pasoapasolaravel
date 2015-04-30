@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>
                     <div class="form-group">
                        @if(Session::has('message'))
                            <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                        @endif
                     </div>
                      <div class="panel-body">


                           <a href="{{route('admin.users.create')}}" class="btn btn-primary col-md-2.5 " role="button">Nuevo Usuario</a>

                            {!! Form::model(Request::all(),['route' => 'admin.users.index', 'method' => 'GET', 'class'=>'navbar-form navbar-left pull-right', 'role' =>'search']) !!}

                            <div class="form-group">
                           {!! Form::text('name',null,['class'=>'form-control floating-label','placeholder'=>'Buscar Usuario'])!!}
                              </div>
                              <div class="form-group">

                            {!! Form::select('type',config('options.types'),null, ['class'=>'form-control'])!!}
                            {{--creo un archivo (options.php) dentro del folder config y le cargo el array--}}

                              </div>


                                 <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>



                            {!! Form::close()!!}

                        <p class="col-md-12 col-md-offset-0">Hay {{$users->total()}} registros</p>

                            @include('admin.users.partials.table')


                      {!! $users->appends(Request::only(['name', 'type']))->render() !!}
                        </div>
                     </div>
                  </div>

            </div>
        </div>

 {!! Form::open(['route' => ['admin.users.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
 {!! Form::close() !!}

@endsection
@section('scripts')

<script>
$(document).ready(function () {
    $('.btn-delete').click(function (e) {
        e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':USER_ID', id);
        var data = form.serialize();
        row.fadeOut();
        $.post(url, data, function (result) {
            alert(result.message);
        }).fail(function () {
            alert('El usuario no fue eliminado');
            row.show();
        });
    });
}); //Jquery que funciona con cualquier framework Backend
</script>
@endsection
