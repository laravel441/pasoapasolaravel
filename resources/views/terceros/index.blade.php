

@extends('...app.cc')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>
                      <div class="panel-body">

                      <h1>Terceros Registrados</h1>
                      <p>Hay {{$terceros->total()}} usuarios</p>
                        <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                    <th>#</th>
                                    <th>Nit</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                    <th>Dirección</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Notas</th>
                                    <th>Acciones</th>
                              </tr>
                            </thead>
                               <tbody>
                                    @foreach ($terceros as $tercero)
                                      <tr>
                                        <td>{{$tercero->id}}</td>
                                        <td>{{$tercero->nit}}</td>
                                        <td>{{$tercero->nombre}}</td>
                                        <td>{{$tercero->rol}}</td>
                                        <td>{{$tercero->direccion}}</td>
                                        <td>{{$tercero->telefono}}</td>
                                        <td>{{$tercero->email}}</td>
                                        <td>{{$tercero->notas}}</td>
                                      <td>
                                        <a href="">Editar</a>
                                        <a href="">Eliminar</a>
                                        </td>
                                      </tr>
                                    @endforeach
                              </tbody>
                        </table>
                      {!!$terceros->render()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection



@endsection