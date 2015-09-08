
                                <input class="form-control text-info"  name="reg_id" type="hidden" value="{{$id}}">
                                <input class="form-control text-info"  name="reg_ctl_id" type="hidden" value="{{$idctl}}">

                              <table class="table table-hover" data-options="rownumbers:true" >
                                                                   <thead>
                                                                       <tr>
                                                                           <th> </th>
                                                                           <th>Supervisor</th>
                                                                           <th>Terminal</th>
                                                                           <th>Proveedor</th>
                                                                            <th>Fecha de inicio</th>


                                                                       </tr>
                                                                   </thead>
                                                            <tbody>

                                                         <td> <a href="{{route('registro.show', $idctl)}}">
                                                        <i class="fa fa-arrow-circle-o-left fa-2x text-info" title="Regresar Controles"></i></a></td>
                                                         <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$usr_name}}"></td>
                                                         <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$pto_nombre->pto_nombre}}"></td>
                                                         <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$pvd_nombre->pvd_nombre}}"></td>
                                                         <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$ctl->ctl_fecha_inicio}}"></td>

                                                          </tbody>
                                                    </table>












                            @include('lavado.partials.listupdate')





