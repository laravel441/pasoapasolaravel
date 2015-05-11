
              <table class="table table-hover">
                            <thead>
                              <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                     <th>Usuario</th>
                                     <th>AN8</th>
                                     <th>Identificación</th>
                                       <th>Acciones</th>
                              </tr>
                            </thead>
                               <tbody>
                                    @foreach ($users as $user)
                                      <tr data-id="{{$user->emp_id}}">
                                        <td>{{$user->emp_id}}</td>
                                        <td>{{$user->full_name}}</td>
                                        <td>{{$user->emp_correo}}</td>
                                        <td>{{$user->usr_name}}</td>
                                        <td>{{$user->emp_an8}}</td>
                                        <td>{{$user->emp_identificacion}}</td>

                                        <td>
                                        <a href="{{route('admin.users.edit', $user)}}">Crear Usuario</a>
                                        {{--<a href="#!" class="btn-delete">Eliminar</a>--}}
                                        </td>
                                      </tr>
                                    @endforeach
                              </tbody>
                        </table>