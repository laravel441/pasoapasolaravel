

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
                        @foreach ($facsi as $fac)

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
                  </div>
