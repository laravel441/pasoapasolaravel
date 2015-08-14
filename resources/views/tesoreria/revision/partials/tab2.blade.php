<table class="table table-hover" style="height: 15px;width: 500px" align="center" >
                    <thead class="center">
                      <tr>
                            <th class="danger"></th>
                            <th><h4 class="text-center" style="margin-top: 3px;margin-bottom:3px; ">Rechazado por Tesorería</h4></th>
                    </tr>
                    </thead>
                    </table>

                 <div class="table-responsive form-group-danger">
                                                        <table data-toggle="table" class="table table-hover" data-id-field="id" data-click-to-select="true" data-select-item-name="items[]" data-pagination="true" data-search="true" data-height="340">
                                                      <thead>
                                                         <tr>

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

                                                           @foreach ($revision as $fac)

                                                                       {{--@else--}}
                                                                    @if ($fac->htc_dtl_id == 12)
                                                                      <tr class="danger" data-id="{{$fac->fac_id}}">

                                                                     @else
                                                                      <tr data-id="{{$fac->fac_id}}">
                                                                     @endif
                                                                    {{--@endif--}}

                                                                   <td>{{$fac->fac_id}}</td>
                                                                   <td>{{$fac->fac_id}}</td>
                                                                   <td>{{$fac->fac_consecutivo}}</td>
                                                                   <td>{{$fac->tip_nombre}}</td>
                                                                   <td>{{$fac->pvd_nombre}}</td>
                                                                   <td>
                                                                   <?php $x=0;?>
                                                                   @foreach($cuenta5 as $op)
                                                                       @if($fac->fac_id == $op->fac_id and $x ==0)
                                                                             {{$op->op_consecutivo}}
                                                                             <?php $x=1;?>
                                                                       @endif
                                                                   @endforeach

                                                                   </td>

                                                                   <td align="center">
                                                                        @foreach($cuenta5 as $ops)
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
                  </div>
