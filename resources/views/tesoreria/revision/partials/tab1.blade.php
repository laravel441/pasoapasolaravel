
{!!Form::model(Request::all(),['route'=>['tesoreria.revision.store'], 'method'=> 'POST'])!!}
               <div class="form-group-danger">
                     <table data-toggle="table" class="table table-hover" data-id-field="id" data-click-to-select="true" data-select-item-name="items[]" data-search="true" data-height="360">
                   <thead>
                      <tr>
                            <th class="bs-checkbox" data-checkbox="true"> <input name="all_items" type="checkbox"></th>
                             <th data-field="id" data-visible="false" data-switchable="false" class="hidden">ID</th>
                            <th>ID</th>
                            <th>Consecutivo</th>
                            <th>Tipo</th>
                            <th>Empresa</th>
                            <th>Adjunto</th>
                            <th>Consecutivo Orden de Pago</th>
                            <th>Orden de Pago</th>
                            <th>Documento Equivalente</th>



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
                                <td>{{$fac->pvd_nombre}}</td>
                                 <td align="center"> <a  target="_blank" href="/facturas_adj/{{$fac->fac_consecutivo}}/{{$fac->arc_fac_nombre}}">
                                    <i class="fa  fa-paperclip fa-9x text-danger " title="Ver Adjunto"></i></a></td>
                                {{--@if($ctl->ctl_fecha_fin == '0001-01-01 00:00:00')--}}
                                <td>{{$fac->op_consecutivo}}</td>
                                <td align="center"> <a  target="_blank" href="/facturas_adj/{{$fac->fac_consecutivo}}/OP/{{$fac->op_nombre_adjunto}}">
                                    <i  class="fa fa-paperclip fa-9x text-primary fa-align-center" title="Ver Adjunto"></i></a></td>
                                {{--@else--}}
                                @if(is_null($fac->doc_equi_id))
                                 <td align="center"><i>No Aplica</i></td>

                                 @else
                                  <td align="center"> <a  target="_blank" href="/facturas_adj/{{$fac->fac_consecutivo}}/DE/{{$fac->doc_equi_nombre_archivo}}">
                                                                     <i class="fa fa-file-pdf-o fa-9x text-danger " title="Ver Adjunto"></i></a></td>
                                 @endif

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

                                                                                  <div class="form-group-danger">
                                                                                    <label for="comment">Observaciones:</label>
                                                                                    <textarea class="form-control" rows="4" id="comment" name="observaciones_1">APROBADO(S)</textarea>
                                                                                 </div>

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




                                                                                            <div class="form-group-danger">
                                                                                              <label for="comment">Razón o Motivo:</label>
                                                                                              <textarea class="form-control" rows="4" id="comment" name="observaciones_2">NO APROBADO(S)</textarea>
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

