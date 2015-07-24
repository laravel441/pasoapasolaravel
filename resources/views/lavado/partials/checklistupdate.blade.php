 <input class="form-control text-info"  name="reg_ctl_id" type="hidden" value="{{$id}}">


                                    <table class="table table-hover" data-options="rownumbers:true" >
                                                               <thead>
                                                                   <tr>
                                                                       <th> </th>
                                                                       <th>Usuario</th>
                                                                       <th>            </th>
                                                                       <th>Terminal</th>
                                                                       <th>            </th>
                                                                       <th>Proveedor</th>
                                                                       <th>            </th>
                                                                        <th>Fecha de inicio</th>


                                                                   </tr>
                                                               </thead>
                                                        <tbody>

                                                     <td>   <a href="http://swcapital.com/lavado">
                                                    <i class="fa fa-arrow-circle-o-left fa-2x text-info" title="Regresar Controles"></i></a></td>
                                                     <td><input class="text-info" disabled="disabled" name="usr_name" type="text" value="{{$usr_name}}"></td>
                                                     <td>           </td>
                                                     <td class="form-group-danger "><select class="form-control combobox text-info" name="pto_id" required="required">
                                                             <option value="{{$ctl->ctl_pto_id}}" >{{$pto_nombre->pto_nombre}}</option>
                                                              <?php foreach ($patios as $key => $patio): ?>
                                                                <option value="{{ $patio->pto_id }}">{{ $patio->pto_nombre }}</option>
                                                              <?php endforeach ?>
                                                         </select></td>
                                                         <td>           </td>
                                                     <td class="form-group-danger"> <select class="form-control combobox text-info" name="prove_id" required="required">
                                                   <option value="{{$ctl->ctl_pve_an8}}" >{{$pvd_nombre->pvd_nombre}}</option>
                                                    <?php foreach ($proveedores as $key => $provee): ?>
                                                      <option value="{{ $provee->pvd_an8 }}">{{ $provee->pvd_nombre }}</option>
                                                    <?php endforeach ?>
                                               </select></td>
                                               <td>           </td>
                                                     <td class="form-group-danger "><input class="text-info" disabled="disabled" name="usr_name" type="text" value="{{$ctl->ctl_fecha_inicio}}"></td>

                                                      </tbody>
                                        </table>

                                  <br>



                                 <div class="form-group">
                                                 <div class="col-md-0 col-md-offset-5">
                                                 <button type="submit" class=" btn btn-danger btn-sm glyphicon glyphicon-floppy-save">
                                                 Actualizar Control
                                                 </button>

                                                 </div>
                                         </div>






