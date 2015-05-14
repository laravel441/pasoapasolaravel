@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>
                             <div class="form-group">
                                 @if(Session::has('message'))
                                 <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                                 @endif
                                </div>
                      <div class="panel-body">


                           {{--<a href="{{route('admin.users.create')}}" class="btn btn-primary col-md-0 " role="button">Nuevo Usuario</a>--}}

                            {!! Form::model(Request::all(),['route' => 'admin.users.index', 'method' => 'GET', 'class'=>'navbar-form navbar-left pull-right', 'role' =>'search']) !!}
<p class="help-block text-info col-md-5 col-md-offset-4"><i>Nombre, AN8 o Identificación</i></p>
                           <div class="col-md-4 col-md-offset-4 form-group-danger">
                           {!! Form::text('an8',null,['class'=>'form-control floating-label','placeholder'=>'Buscar empleado '])!!}

                           </div>


                           <button type="submit" class="btn btn-danger">Buscar</button>

                          </div>






                            {{--{!! Form::close()!!}--}}

                        <p class="help-block text-info  col-md-4 col-md-offset-0"><i>Hay {{$users->total()}} registros</i></p>

                            @include('admin.users.partials.table')

                        {!! $users->appends(Request::only(['an8']))->render() !!}



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
