                        <table class="table table-hover">
                            <thead>
                              <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                     <th>Usuario</th>
                                       <th>Acciones</th>
                              </tr>
                            </thead>
                               <tbody>
                                    @foreach ($users as $user)
                                      <tr data-id="{{$user->emp_id}}">
                                        <td>{{$user->emp_id}}</td>
                                        <td>{{$user->emp_nombre}}</td>
                                        <td>{{$user->emp_apellido}}</td>
                                        <td>{{$user->usr_name}}</td>

                                        <td>
                                        <a href="{{route('admin.users.edit', $user)}}">Crear Usuario</a>
                                        <a href="#!" class="btn-delete">Eliminar</a>
                                        </td>
                                      </tr>
                                    @endforeach
                              </tbody>
                        </table>