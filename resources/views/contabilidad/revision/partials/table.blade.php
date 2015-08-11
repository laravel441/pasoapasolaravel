
{!!Form::model(Request::all(),['route'=>['contabilidad.revision.store'], 'method'=> 'POST'])!!}
               <div class="table-responsive form-group-danger">
                     <table data-toggle="table" class="table table-hover" data-id-field="id" data-click-to-select="true" data-select-item-name="items[]" data-pagination="true" data-search="true" data-height="360">
                   <thead>
                      <tr>
                            <th class="bs-checkbox" data-checkbox="true"> <input name="all_items" type="checkbox"></th>
                             <th data-field="id" data-visible="false" data-switchable="false" class="hidden">ID</th>
                            <th>ID</th>
                            <th>Consecutivo</th>
                            <th>Tipo</th>
                            <th># de Documento</th>
                            <th>Empresa</th>
                            <th>Asunto</th>
                            <th>Fecha de Recibido</th>
                            <th>Fecha de Radicado</th>
                            <th>Adjunto</th>


                      </tr>
                    </thead>
                       <tbody>
                        @foreach ($facs as $fac)

                                    {{--@else--}}
                                 <tr data-id="{{$fac->fac_id}}">
                                 {{--@endif--}}
                                <td class="bs-checkbox" name="items[]" value="{{$fac->fac_id}}"><input data-index="0" data-select-item-name="items[]" type="checkbox"  ></td>
                                <td>{{$fac->fac_id}}</td>
                                <td>{{$fac->fac_id}}</td>
                                <td>{{$fac->fac_consecutivo}}</td>
                                <td>{{$fac->tip_nombre}}</td>
                                <td>{{$fac->fac_num_documento}}</td>
                                <td>{{$fac->comp_nombre}}</td>
                                {{--@if($ctl->ctl_fecha_fin == '0001-01-01 00:00:00')--}}
                                <td>{{$fac->fac_asunto}}</td>
                                <td>{{$fac->fac_creado_en}}</td>
                                {{--@else--}}
                                <td>{{$fac->fac_fecha_rad}}</td>
                                <td align="center"> <a  target="_blank" href="/facturas_adj/{{$fac->fac_consecutivo}}/{{$fac->arc_fac_nombre}}">
                                    <i class="fa fa fa-paperclip fa-9x text-danger " title="Ver Adjunto"></i></a></td>

                                {{--@endif--}}
                            </tr>
                                @endforeach
                                </tbody>
                          </table>
                                  <div class='col-sm-offset-5'>
                                            <button type="button" class="btn btn-primary btn-sm fa fa-check fa-2x " data-toggle='modal' data-target='#Si' title="Aprobar Factura (s)"></button>
                                            <button type="button" class="btn btn-danger btn-sm fa fa-times fa-2x " data-toggle='modal' data-target='#No' title="No Aprobar Factura (s)" ></button>
                                   </div>

                                <div class="modal fade" id="Si" role="dialog" style='top: 180px'>
                                     <div class="modal-dialog">
                                         <div class="modal-content">
                                                       <div class="modal-header well-material-grey-300">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                 <h2 class="modal-title text-center">Aprobar Documento(s)</h2>

                                                       </div>
                                                    <div class="modal-body"></br>
                                                        <h5 class="modal-title text-center text-primary">Los documentos seleccionados se aprobarán.</h5>
                                                            <label class="hidden"><input type="radio" name="optradio" value="1" CHECKED>RADICACIÓN</label>
                                                            <label class="hidden"><input type="radio" name="optradio" value="2">ABASTECIMIENTO</label>
                                                            <textarea class="hidden" rows="4" id="comment" name="observaciones" required="required">XXXX</textarea>

                                                 </div>
                                                    <div class="modal-footer">
                                                        <div class="col-sm-8 col-sm-offset-0">
                                                              <button type="submit" name="submit" value="1" class="btn btn"><span class="text-primary fa fa-check-square-o fa-3x" title="Aprobar"></span></button>
                                                              <button type="button" class="btn btn" data-dismiss="modal"><span class="text-danger fa fa-times fa-3x" title="Cancelar"></span></button>
                                                        </div>
                                                    </div>
                                         </div>
                                     </div>
                                 </div>




                                 <div class="modal fade" id="No" role="dialog" style='top: 180px'>
                                     <div class="modal-dialog">
                                         <div class="modal-content">
                                                       <div class="modal-header well-material-grey-300">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                 <h2 class="modal-title text-center">No Aprobar Documento(s)</h2>

                                                       </div>
                                                    <div class="modal-body"></br>
                                                    <h5 class="modal-title text-center text-primary">Los documentos seleccionados no se aprobaran.</h5></br>
                                                               <div class='col-sm-7 col-sm-offset-3'>
                                                                    <label for="comment">Enviar a:</label>
                                                                    <div class="form-control-wrapper">

                                                                       <label class="radio-inline "><input type="radio" name="optradio" value="1" CHECKED>RADICACIÓN</label>
                                                                       <label class="radio-inline "><input type="radio" name="optradio" value="2">ABASTECIMIENTO</label>
                                                                    </div>

                                                               </div>


                                                                    <div class="form-group-danger">
                                                                      <label for="comment">Observaciones:</label>
                                                                      <textarea class="form-control" rows="4" id="comment" name="observaciones" required="required">NO APROBADO(S)</textarea>
                                                                   </div>



                                                      </div>
                                                    <div class="modal-footer">
                                                        <div class="col-sm-8 col-sm-offset-0">
                                                              <button type="submit" name="submit" value="2" class="btn btn"><span class="text-primary fa fa-check-square-o fa-3x" title="Si"></span></button>
                                                              <button type="button" class="btn btn" data-dismiss="modal"><span class="text-danger fa fa-times fa-3x" title="Cancelar"></span></button>
                                                        </div>
                                                    </div>
                                         </div>
                                     </div>
                                 </div>


      </div>

{!!Form::close()!!}

