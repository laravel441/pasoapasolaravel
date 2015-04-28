                        <table class="table table-hover">
                            <thead>
                              <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                              </tr>
                            </thead>
                               <tbody>
                                    @foreach ($users as $user)
                                      <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->full_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->type}}</td>
                                        <td>
                                        <a href="{{route('admin.users.edit', $user)}}">Editar</a>
                                        <a href="">Eliminar</a>
                                        </td>
                                      </tr>
                                    @endforeach
                              </tbody>
                        </table>