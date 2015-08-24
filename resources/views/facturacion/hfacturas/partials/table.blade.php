

<div  class="form-group-danger">
                    <div class="panel panel-danger filterable">


                            <div class="pull-left">
                                <button class="btn btn-info btn-sm btn-filter"><span class="fa fa-filter fa-9x"></span> Filtro</button>
                            </div>

                        <table data-toggle="table"
                                              class="table table-hover"
                                              id="idp"
                                              data-id-field="id"
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
                                <tr class="filters">


                                                        <th data-visible="false" data-switchable="false" class="hidden">ID</th>
                                                       <th>ID</th>
                                                       <th class="info" nowrap>Estado</th>
                                                       <th nowrap><input type="text" class=" text-info" placeholder="Mes" style="text-transform: uppercase" disabled></th>
                                                       <th nowrap><input type="text" class=" text-info" placeholder="Semana" style="text-transform: uppercase" disabled></th>
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
                    </div>

</div>
<script type="text/javascript">
                               $(document).ready(function(){
                                   $('.filterable .btn-filter').click(function(){
                                       var $panel = $(this).parents('.filterable'),
                                       $filters = $panel.find('.filters input'),
                                       $tbody = $panel.find('.table tbody');
                                       if ($filters.prop('disabled') == true) {
                                           $filters.prop('disabled', false);
                                           $filters.first().focus();
                                       } else {
                                           $filters.val('').prop('disabled', true);
                                           $tbody.find('.no-result').remove();
                                           $tbody.find('tr').show();
                                       }
                                   });

                                   $('.filterable .filters input').keyup(function(e){
                                       /* Ignore tab key */
                                       var code = e.keyCode || e.which;
                                       if (code == '9') return;
                                       /* Useful DOM data and selectors */
                                       var $input = $(this),
                                       inputContent = $input.val().toLowerCase(),
                                       $panel = $input.parents('.filterable'),
                                       column = $panel.find('.filters th').index($input.parents('th')),
                                       $table = $panel.find('.table'),
                                       $rows = $table.find('tbody tr');
                                       /* Dirtiest filter function ever ;) */
                                       var $filteredRows = $rows.filter(function(){
                                           var value = $(this).find('td').eq(column).text().toLowerCase();
                                           return value.indexOf(inputContent) === -1;
                                       });
                                       /* Clean previous no-result if exist */
                                       $table.find('tbody .no-result').remove();
                                       /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                                       $rows.show();
                                       $filteredRows.hide();
                                       /* Prepend no-result row if all rows are filtered */
                                       if ($filteredRows.length === $rows.length) {
                                           $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No se han encontrado registros.</td></tr>'));
                                       }
                                   });
                               });
                                                          </script>
                                                          <script type="text/css">
                                                          .filterable {
                                                              margin-top: 15px;
                                                          }
                                                          .filterable .panel-heading .pull-right {
                                                              margin-top: -20px;
                                                          }
                                                          .filterable .filters input[disabled] {
                                                              background-color: transparent;
                                                              border: none;
                                                              cursor: auto;
                                                              box-shadow: none;
                                                              padding: 0;
                                                              height: auto;
                                                          }
                                                          .filterable .filters input[disabled]::-webkit-input-placeholder {
                                                              color: #333;
                                                          }
                                                          .filterable .filters input[disabled]::-moz-placeholder {
                                                              color: #333;
                                                          }
                                                          .filterable .filters input[disabled]:-ms-input-placeholder {
                                                              color: #333;
                                                          }

                                                          </script>
