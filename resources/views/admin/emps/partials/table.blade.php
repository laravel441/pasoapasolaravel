                        <table class="table table-hover">
                            <thead>
                              <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Email</th>
                                    <th>AN8</th>
                                    <th>CC</th>
                                    <th>Acciones</th>
                              </tr>
                            </thead>
                               <tbody>
                                    @foreach ($emps as $emp)
                                      <tr data-id="{{$emp->emp_id}}">
                                        <td>{{$emp->emp_id}}</td>
                                        <td>{{$emp->emp_nombre}}</td>
                                        <td>{{$emp->emp_apellido}}</td>
                                        <td>{{$emp->emp_correo}}</td>
                                        <td>{{$emp->emp_an8}}</td>
                                        <td>{{$emp->emp_identificacion}}</td>
                                        <td>
                                        <a href="{{route('admin.emps.edit', $emp)}}">Editar</a>
                                        <a href="#!" class="btn-delete">Eliminar</a>
                                        </td>
                                      </tr>
                                    @endforeach
                              </tbody>
                        </table>