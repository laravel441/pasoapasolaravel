
               <div  class="form-group-danger">
               <div id="filter-bar"> </div>
                     <table data-toggle="table"
                      class="table table-hover"
                      id="idp" data-id-field="id"
                      data-click-to-select="true"
                      data-select-item-name="items[]"
                      data-pagination="true"
                      data-height="380"
                      {{--data-show-toggle="true"--}}
                      data-toolbar="#filter-bar"
                      data-show-columns="true"
                      data-show-filter="true"
                      data-show-export="true"
                      data-export-types="['excel']"
                      {{--data-export-types="['json', 'xml', 'csv',  'sql', 'excel','pdf']"--}}
                      data-search="true"
                      >
                   <thead>
                      <tr>
                            <th class="bs-checkbox" data-checkbox="true"> <input name="all_items" type="checkbox"></th>
                             <th data-field="id" data-visible="false" data-switchable="false" class="hidden">ID</th>
                            <th>ID</th>
                            <th class="info" nowrap>Estado</th>
                            <th nowrap data-field="mes" data-sortable="true">Mes</th>
                            <th nowrap data-sortable="true">Semana</th>
                            <th data-visible="false">Fecha Radicado</th>
                            <th data-visible="false">Compañia</th>
                            <th data-visible="false">Radica</th>
                            <th data-visible="false">Tipo</th>
                            <th data-visible="false">Consecutivo Documento</th>
                            <th data-visible="false">Asunto</th>
                            <th data-visible="false">Fecha Documento</th>
                            <th data-visible="false">Valor</th>
                            <th data-visible="false">An8</th>
                            <th data-visible="false">Empresa</th>
                            <th data-visible="false">NIT</th>
                            <th class="">Fecha Envio</th>
                            <th class="">Fecha Revisión</th>
                            <th class="">Envio Devolución</th>
                            <th class="">Respuesta</th>
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
                                <td nowrap>{{$fac->dtl_nombre}}</td>
                                <td nowrap>
                                        <?php
                                            $mes= date('m',strtotime($fac->fac_fecha_rad));
                                                    switch ($mes) {
                                                                case ($mes == 1):
                                                                    echo 'ENERO';
                                                                    break;
                                                                case ($mes == 2):
                                                                    echo 'FEBRERO';
                                                                    break;
                                                                case ($mes == 3):
                                                                   echo 'MARZO';
                                                                    break;
                                                                case ($mes == 4):
                                                                    echo 'ABRIL';
                                                                    break;
                                                                case ($mes == 5):
                                                                    echo 'MAYO';
                                                                    break;
                                                                case ($mes == 6):
                                                                    echo 'JUNIO';
                                                                    break;
                                                                case ($mes == 7):
                                                                    echo 'JULIO';
                                                                    break;
                                                                case ($mes == 8):
                                                                    echo 'AGOSTO';
                                                                    break;
                                                                case ($mes == 9):
                                                                    echo 'SEPTIEMBRE';
                                                                    break;
                                                                case ($mes == 10):
                                                                    echo 'OCTUBRE';
                                                                    break;
                                                                case ($mes == 11):
                                                                    echo 'NOVIEMBRE';
                                                                    break;
                                                                case ($mes == 12):
                                                                    echo 'DICIEMBRE';
                                                                    break;
                                                            }
                                            ?>

                                </td>
                                  <td nowrap>
                                    <?php
                                         $dia = date  ('j',strtotime($fac->fac_fecha_rad));
                                                switch ($dia) {
                                                    case ($dia <= 7):
                                                        echo 'Semana 1';
                                                        break;
                                                    case (  8 <= $dia  && $dia <= 14):
                                                       echo 'Semana 2';
                                                        break;
                                                    case (15 <= $dia  && $dia <= 21):
                                                        echo 'Semana 3';
                                                        break;
                                                    case (22 <= $dia  && $dia <= 31):
                                                        echo 'Semana 4';
                                                        break;
                                                }
                                        ?>

                                </td>
                                <td nowrap>{{$fac->fac_creado_en}}</td>
                                <td nowrap>{{$fac->comp_nombre}}</td>
                                <td nowrap>{{$fac->fac_modificado_por}}</td>
                                <td nowrap>{{$fac->tip_nombre}}</td>
                                <td nowrap>{{$fac->fac_num_documento}}</td>
                                <td nowrap>{{$fac->fac_asunto}}</td>
                                <td nowrap>{{$fac->fac_fecha_rad}}</td>
                                @if ($fac->fac_tip_mon == 8)
                               <td nowrap>COP {{$fac->fac_valor}}</td>
                                @elseif($fac->fac_tip_mon == 9)
                                <td nowrap>EUR€ {{$fac->fac_valor}}</td>
                                 @elseif($fac->fac_tip_mon == 10)
                               <td nowrap>US$ {{$fac->fac_valor}}</td>
                               @else
                                <td nowrap>0</td>
                                 @endif

                                <td nowrap>{{$fac->fac_pvd_an8}}</td>
                                <td nowrap>{{$fac->pvd_nombre}}</td>
                                <td nowrap>{{$fac->pvd_identificacion}}</td>
                                <td>Fecha Envio</td>
                                <td>Fecha Revisión</td>
                                <td>Envio Devolución</td>
                                <td>Respuesta</td>
                                 <td align="center"> <a  target="_blank" href="/facturas_adj/{{$fac->fac_consecutivo}}/{{$fac->arc_fac_nombre}}">
                                                                    <i class="fa  fa-paperclip fa-9x text-danger " title="Ver Adjunto"></i></a></td>
                                                                {{--@if($ctl->ctl_fecha_fin == '0001-01-01 00:00:00')--}}
                                        <td><?php $x=0;?>
                                        @foreach($cuenta5 as $op)
                                            @if($fac->fac_id == $op->fac_id and $x ==0)
                                                  {{$op->op_consecutivo}}
                                                  <?php $x=1;?>
                                            @endif
                                        @endforeach</td>
                                         <td align="center">
                                             @foreach($cuenta5 as $ops)
                                                 @if($fac->fac_id == $ops->fac_id)
                                                    <a  target="_blank" href="/facturas_adj/{{$ops->fac_consecutivo}}/OP/{{$ops->op_nombre_adjunto}}">
                                                     <i class="fa fa fa-file-text-o fa-9x text-danger " title="Ver Documento Equivalente"></i></a>
                                                 @endif
                                              @endforeach
                                        </td>
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



                                  {{--<div class='col-sm-offset-5'>--}}
                                            {{--<button type="button" class="btn btn-primary btn-sm fa fa-check fa-2x " data-toggle='modal' data-target='#Si' title="Aprobar Factura (s)"></button>--}}
                                            {{--<button type="button" class="btn btn-danger btn-sm fa fa-times fa-2x " data-toggle='modal' data-target='#No' title="No Aprobar Factura (s)" ></button>--}}
                                   {{--</div>--}}

                                {{--<div class="modal fade" id="Si" role="dialog" style='top: 180px'>--}}
                                     {{--<div class="modal-dialog">--}}
                                         {{--<div class="modal-content">--}}
                                                       {{--<div class="modal-header well-material-grey-300">--}}
                                                            {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                                                 {{--<h2 class="modal-title text-center">Aprobar Documento(s)</h2>--}}

                                                       {{--</div>--}}
                                                    {{--<div class="modal-body"></br>--}}
                                                        {{--<h5 class="modal-title text-center text-primary">Los documentos seleccionados se aprobarán.</h5>--}}
                                                            {{--<label class="hidden"><input type="radio" name="optradio" value="1" CHECKED>RADICACIÓN</label>--}}
                                                            {{--<label class="hidden"><input type="radio" name="optradio" value="2">ABASTECIMIENTO</label>--}}
                                                            {{--<textarea class="hidden" rows="4" id="comment" name="observaciones" required="required">XXXX</textarea>--}}

                                                 {{--</div>--}}
                                                    {{--<div class="modal-footer">--}}
                                                        {{--<div class="col-sm-8 col-sm-offset-0">--}}
                                                              {{--<button type="submit" name="submit" value="1" class="btn btn"><span class="text-primary fa fa-check-square-o fa-3x" title="Aprobar"></span></button>--}}
                                                              {{--<button type="button" class="btn btn" data-dismiss="modal"><span class="text-danger fa fa-times fa-3x" title="Cancelar"></span></button>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                         {{--</div>--}}
                                     {{--</div>--}}
                                 {{--</div>--}}




                                 {{--<div class="modal fade" id="No" role="dialog" style='top: 180px'>--}}
                                     {{--<div class="modal-dialog">--}}
                                         {{--<div class="modal-content">--}}
                                                       {{--<div class="modal-header well-material-grey-300">--}}
                                                            {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                                                 {{--<h2 class="modal-title text-center">No Aprobar Documento(s)</h2>--}}

                                                       {{--</div>--}}
                                                    {{--<div class="modal-body"></br>--}}
                                                    {{--<h5 class="modal-title text-center text-primary">Los documentos seleccionados no se aprobaran.</h5></br>--}}
                                                               {{--<div class='col-sm-7 col-sm-offset-3'>--}}
                                                                    {{--<label for="comment">Enviar a:</label>--}}
                                                                    {{--<div class="form-control-wrapper">--}}

                                                                       {{--<label class="radio-inline "><input type="radio" name="optradio" value="1" CHECKED>RADICACIÓN</label>--}}
                                                                       {{--<label class="radio-inline "><input type="radio" name="optradio" value="2">ABASTECIMIENTO</label>--}}
                                                                    {{--</div>--}}

                                                               {{--</div>--}}


                                                                    {{--<div class="form-group-danger">--}}
                                                                      {{--<label for="comment">Observaciones:</label>--}}
                                                                      {{--<textarea class="form-control" rows="4" id="comment" name="observaciones" required="required">NO APROBADO(S)</textarea>--}}
                                                                   {{--</div>--}}



                                                      {{--</div>--}}
                                                    {{--<div class="modal-footer">--}}
                                                        {{--<div class="col-sm-8 col-sm-offset-0">--}}
                                                              {{--<button type="submit" name="submit" value="2" class="btn btn"><span class="text-primary fa fa-check-square-o fa-3x" title="Si"></span></button>--}}
                                                              {{--<button type="button" class="btn btn" data-dismiss="modal"><span class="text-danger fa fa-times fa-3x" title="Cancelar"></span></button>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                         {{--</div>--}}
                                     {{--</div>--}}
                                 {{--</div>--}}


      </div>
