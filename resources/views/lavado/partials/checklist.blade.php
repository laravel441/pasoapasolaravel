
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

                                        <td> <a href="{{route('registro.show', $id)}}">
                                           <i class="fa fa-arrow-circle-o-left fa-2x text-info" title="Regresar Controles"></i></a></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$usr_name}}"></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$pto_nombre->pto_nombre}}"></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$pvd_nombre->pvd_nombre}}"></td>
                                        <td><input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="<?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?>"></td>

                                         </tbody>
                                   </table>











  {!! Form::model(Request::all(),['route' => 'lavado.update', 'method' => 'PUT','enctype'=>'multipart/form-data']) !!}

                            @include('lavado.partials.list')
                            {!!Form::close()!!}



