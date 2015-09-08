
                            <input class="form-control text-info"  name="ctl_id" type="hidden" value="{{$id}}">

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

                                        <td> <a href="http://swcapital.com/lav/admin">
                                          <i class="fa fa-arrow-circle-o-left fa-2x text-info" title="Regresar Controles"></i></a></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$usr_name}}"></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$ptoctl->pto_nombre}}"></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$pvectl->pvd_nombre}}"></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$ctls->ctl_fecha_inicio}}"></td>

                                         </tbody>
                                   </table>












@include('lavado.admin.partials.tablereg')


