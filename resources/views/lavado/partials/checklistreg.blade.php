
                            <input class="form-control text-info"  name="ctl_id" type="hidden" value="{{$id}}">

                              <table class="table table-hover" data-options="rownumbers:true" >
                                                  <thead>
                                                      <tr>
                                                          <th> </th>
                                                          <th>Supervisor</th>
                                                          <th>Terminal</th>
                                                          <th>Proveedor</th>
                                                           <th>Fecha de inicio</th>
                                                            <th class="form-group-danger">{!! Form::text('registro',null,['class'=>'form-control floating-label','placeholder'=>'Buscar movil '])!!}

                                                            </th>

                                                      </tr>
                                                  </thead>
                                           <tbody>

                                        <td> <a href="http://swcapital.com/lavado">
                                          <i class="fa fa-arrow-circle-o-left fa-2x text-info" title="Regresar Controles"></i></a></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$usr_name}}"></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$ptoctl->pto_nombre}}"></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$pvectl->pvd_nombre}}"></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$ctls->ctl_fecha_inicio}}"></td>
                                        <td><button type="submit" class="btn btn-danger btn-sm">
                                                                                <span class="glyphicon glyphicon-search "></span> Buscar
                                                                            </button></td>
                                         </tbody>
                                   </table>












@include('lavado.partials.tablereg')


