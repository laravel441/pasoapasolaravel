{!!Form::model(Request::all(),['route'=>['facturacion.radicacion.update'], 'method'=> 'PUT'])!!}
               <div class="table-responsive form-group-danger" >
                     <table data-toggle="table" class="table table-hover" data-id-field="id" data-click-to-select="true" data-select-item-name="items[]" data-pagination="true" data-search="true" data-height="360">
                   <thead >
                      <tr>
                            <th class="bs-checkbox" data-checkbox="true"> <input name="all_items" type="checkbox"></th>
                             <th data-field="id" data-visible="false" data-switchable="false" class="hidden">ID</th>
                            <th>ID</th>
                            <th>Consecutivo</th>
                            <th>Tipo</th>
                            <th># de Documento</th>
                            <th>Empresa</th>
                            <th>Fecha de Recibido</th>
                            <th>Fecha de Radicado</th>


                      </tr>
                    </thead>

                       <tbody>

                        @foreach ($envio as $fac)


                         <tr data-id="{{$fac->fac_id}}">
                                 {{--@endif--}}
                                <td class="bs-checkbox" name="items[]" value="{{$fac->fac_id}}"><input data-index="0" data-select-item-name="items[]" type="checkbox"  ></td>
                                <td>{{$fac->fac_id}}</td>
                                <td>{{$fac->fac_id}}</td>
                                <td >{{$fac->fac_consecutivo}}</td>
                                <td>{{$fac->tip_nombre}}</td>
                                <td>{{$fac->fac_num_documento}}</td>
                                <td>{{$fac->pvd_nombre}}</td>
                                <td>{{$fac->fac_creado_en}}</td>
                                <td>{{$fac->fac_fecha_rad}}</td>




                         </tr>
                           @endforeach
                      </tbody>
                </table>
                @if($envi == 1)
                 <div class='col-sm-offset-5'>
                <button type="button" class="btn btn-danger btn-sm fa fa-envelope-o fa-2x " data-toggle='modal' data-target='#E' title="Enviar Factura" disabled></button>
                </div>
                @else
                <div class='col-sm-offset-5'>
               <button type="button" class="btn btn-danger btn-sm fa fa-envelope-o fa-2x " data-toggle='modal' data-target='#E' title="Enviar Factura"></button>
                </div>



                @endif

  </div>

<div class="modal fade" id="E" role="dialog" >
                                 <div class="modal-dialog">
                                     <div class="modal-content">
                                               <div class="modal-header well-material-grey-300">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                         <h2 class="modal-title text-center">Enviar Factura(s) a:</h2>
                                                         <h3 class="modal-title text-center text-primary"></h3>
                                               </div>
                                        <div class="modal-body"></br></br>
                                                      <div class='col-sm-8 col-sm-offset-3'>
                                                        <div class="form-group-danger">
                                                               <select class="form-control combobox" name="usr_asignado" required>
                                                                   <option value="" disabled selected >Seleccione Usuario</option>
                                                                    <?php foreach ($users_contabilidad as $key => $vehiculo): ?>
                                                                      <option value="{{ $vehiculo->usr_id }}">{{ $vehiculo->emp_nombre.' '.$vehiculo->emp_nombre2.' '.$vehiculo->emp_apellido }}</option>
                                                                    <?php endforeach ?>
                                                               </select>

                                                       </div>
                                                   </div>
                                        </div>


                                            <div class="modal-footer">
                                            <div class="col-sm-7 col-sm-offset-1"></br></br>
                                                  <button type="submit" class="btn btn"><span class="text-primary fa fa-check-square-o fa-3x" title="Enviar"></span></button>
                                                  <button type="button" class="btn btn" data-dismiss="modal"><span class="text-danger fa fa-times fa-3x" title="Cancelar"></span></button>
                                         </div>
                                        </div>
                                     </div>
                                 </div>
                             </div>

{!!Form::close()!!}


