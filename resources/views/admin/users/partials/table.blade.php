
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
                                    @if($user->usr_id != "")
                                    <tr  data-id="{{$user->emp_id}}">
                                        @else
                                     <tr class="warning" data-id="{{$user->emp_id}}">
                                     @endif

                                        <td>{{$user->emp_id}}</td>
                                        <td>{{$user->full_name}}</td>
                                        <td>{{$user->emp_correo}}</td>
                                         @if($user->usr_id != "")
                                         <td>{{$user->usr_name}}</td>
                                        @else
                                        <td></td>
                                         @endif
                                        <td>{{$user->emp_an8}}</td>
                                        <td>{{$user->emp_identificacion}}</td>
                                         @if($user->usr_id != "")
                                        <td><a class="text-primary" href="{{route('admin.users.edit', $user)}}">Ver Empleado</a></td>
                                         @else
                                         <td><a class="text-warning" href="{{route('admin.users.edit', $user)}}">Crear Usuario</a></td>
                                        @endif

                                      </tr>
                                    @endforeach
                              </tbody>
                        </table>