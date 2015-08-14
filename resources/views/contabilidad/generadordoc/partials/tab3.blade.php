
  		{!!Form::model(Request::all(),['route'=>['contabilidad.generadordoc.show'], 'method'=> 'GET'])!!}
                       <div class="table-responsive form-group-danger">
                             <table data-toggle="table" class="table table-hover" data-id-field="id" data-click-to-select="true" data-select-item-name="items[]" data-pagination="true" data-search="true" data-height="340">
                           <thead>
                              <tr>
                                    <th class="bs-checkbox" data-checkbox="true"> <input name="all_items" type="checkbox"></th>
                                     <th data-field="id" data-visible="false" data-switchable="false" class="hidden">ID</th>
                                    <th>ID</th>
                                    <th>Consecutivo</th>
                                    <th>Tipo</th>
                                    <th>Empresa</th>
                                    <th>Consecutivo Orden de Pago</th>
                                    <th>Adjunto(s)(OP) </th>
                                    <th>Adjunto (Documento Equivalente)</th>
                                    <th>Adjunto (Radicado)</th>

                              </tr>
                            </thead>
                               <tbody>

                                @foreach ($cuenta3 as $fac)


                                          <tr data-id="{{$fac->fac_id}}">

                                         {{--@endif--}}
                                        <td class="bs-checkbox" name="items[]" value="{{$fac->fac_id}}"><input data-index="0" data-select-item-name="items[]" type="checkbox"  ></td>
                                        <td>{{$fac->fac_id}}</td>
                                        <td>{{$fac->fac_id}}</td>
                                        <td>{{$fac->fac_consecutivo}}</td>
                                        <td>{{$fac->tip_nombre}}</td>
                                        <td>{{$fac->pvd_nombre}}</td>
                                        <td>
                                        <?php $x=0;?>
                                        @foreach($cuenta4 as $op)
                                            @if($fac->fac_id == $op->fac_id and $x ==0)
                                                  {{$op->op_consecutivo}}
                                                  <?php $x=1;?>
                                            @endif
                                        @endforeach

                                        </td>

                                        <td align="center">
                                             @foreach($cuenta4 as $ops)
                                                 @if($fac->fac_id == $ops->fac_id)
                                                    <a  target="_blank" href="/facturas_adj/{{$ops->fac_consecutivo}}/OP/{{$ops->op_nombre_adjunto}}">
                                                     <i class="fa fa fa-file-text-o fa-9x text-danger " title="Ver Documento Equivalente"></i></a>
                                                 @endif
                                              @endforeach
                                        </td>

                                        @if(empty($fac->doc_equi_nombre_archivo))
                                        <td><i class="text-primary">NA</i></td>
                                        @else
                                         <td align="center"> <a  target="_blank" href="/facturas_adj/{{$fac->fac_consecutivo}}/DE/{{$fac->doc_equi_nombre_archivo}}">
                                                        <i class="fa fa fa-file-pdf-o fa-9x text-danger " title="Ver Documento Equivalente"></i></a></td>
                                        @endif

                                        <td align="center"> <a  target="_blank" href="/facturas_adj/{{$fac->fac_consecutivo}}/{{$fac->arc_fac_nombre}}">
                                            <i class="fa fa fa-paperclip fa-9x text-danger " title="Ver Adjunto"></i></a></td>

                                        {{--@endif--}}
                                    </tr>
                                        @endforeach
                                        </tbody>
                                  </table>
                                          @if($envi == 1)
                                          <div class='col-sm-offset-5'>
                                         <button type="button" class="btn btn-danger btn-sm fa fa-envelope-o fa-2x " data-toggle='modal' data-target='#Si' title="Enviar Factura" disabled></button>
                                         </div>
                                         @else
                                         <div class='col-sm-offset-5'>
                                        <button type="button" class="btn btn-danger btn-sm fa fa-envelope-o fa-2x " data-toggle='modal' data-target='#Si' title="Enviar Factura"></button>
                                         </div>



                                         @endif

                                        <div class="modal fade" id="Si" role="dialog" style='top: 180px'>
                                             <div class="modal-dialog">
                                                 <div class="modal-content">
                                                               <div class="modal-header well-material-grey-300">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                         <h2 class="modal-title text-center">Enviar a Tesorería</h2>

                                                               </div>
                                                            <div class="modal-body"></br>
                                                                <h5 class="modal-title text-center text-primary">Los documentos seleccionados se enviaran a Tesorería.</h5>


                                                         </div>
                                                            <div class="modal-footer">
                                                                <div class="col-sm-8 col-sm-offset-0">
                                                                      <button type="submit" name="submit" value="1" class="btn btn"><span class="text-primary fa fa-check-square-o fa-3x" title="Enviar"></span></button>
                                                                      <button type="button" class="btn btn" data-dismiss="modal"><span class="text-danger fa fa-times fa-3x" title="Cancelar"></span></button>
                                                                </div>
                                                            </div>
                                                 </div>
                                             </div>
                                         </div>






              </div>

        {!!Form::close()!!}

