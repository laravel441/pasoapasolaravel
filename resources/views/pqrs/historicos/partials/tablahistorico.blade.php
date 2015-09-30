<table class="table-condensed" data-toggle="table" data-search="true" data-search-align="center" data-height="470" data-pagination="true" data-page-list="[5, 10, 20, 50, 100]">
                                      <thead  class="well-material-teal-300">
                                        <tr>
                                             <th><h5>N° Requerimiento</h5></th>
                                             <th><h5>Fecha Asignacion</h5></th>
                                             <th><h5>Tipo</h5></th>
                                             <th><h5>Incidencia</h5></th>
                                             <th><h5>Canal</h5></th>
                                             <th><h5>Fecha y Hora Evento</h5></th>
                                             <th><h5>Lugar</h5></th>
                                             <th><h5>Estado</h5></th>
                                             <th><h5>Prioridad</h5></th>
                                             <th><h5>Area Encargada</h5></th>
                                             <th><h5>Fecha Vencimiento</h5></th>
                                             <th><h5>Patio</h5></th>
                                             <th><h5>N° Ruta</h5></th>
                                             <th><h5>N° Placa</h5></th>
                                             <th><h5>N° SITP</h5></th>
                                             <th><h5>Descargo</h5></th>
                                             <th><h5>Nombre Operador</h5></th>
                                             <th><h5>N° Cedula</h5></th>
                                             <th><h5>An8</h5></th>
                                             <th><h5>Codigo TM</h5></th>
                                             <th><h5>Usuario</h5></th>
                                             <th><h5>Detalles</h5></th>
                                        </tr>
                                      </thead>
                                            <tbody>
                                              @foreach ($historico as $his)
                                                <tr data-id=""  class="well-material-light-green-50">
                                                    <td><h6>{{$his->pqrs_num_requerimiento}}</h6></td>
                                                    <td><h6>{{$his->pqrs_fecha_asignacion}}</h6></td>
                                                    <td><h6>{{$his->typ_nombre}}</h6></td>
                                                    <td><h6>{{$his->inc_nombre}}</h6></td>
                                                    <td><h6>{{$his->can_nombre}}</h6></td>
                                                    <td><h6>{{$his->pqrs_fecha_hora_suceso}}</h6></td>
                                                    <td><h6>{{$his->pqrs_lugar}}</h6></td>
                                                    <td><h6>{{$his->stp_nombre}}</h6></td>
                                                    <td><h6>{{$his->pri_nombre}}</h6></td>
                                                    <td><h6>{{$his->area_nombre}}</h6></td>
                                                    <td><h6>{{$his->pqrs_fecha_vencimiento}}</h6></td>
                                                    <td><h6>{{$his->pto_nombre}}</h6></td>
                                                    <td><h6>{{$his->rut_nombre}}</h6></td>
                                                    <td><h6>{{$his->veh_placa}}</h6></td>
                                                    <td><h6>{{$his->veh_movil}}</h6></td>
                                                    <td><h6>{{$his->desc_descargo =='f'?'TIENE DESCARGO':null}}</h6></td>
                                                    <td><h6>{{$his->nombre}}</h6></td>
                                                    <td><h6>{{$his->emp_identificacion}}</h6></td>
                                                    <td><h6>{{$his->emp_an8}}</h6></td>
                                                    <td><h6>{{$his->emp_cod_tm}}</h6></td>
                                                    <td><h6>{{$his->pqrs_afectado}}</h6></td>
                                                                        <td>
                                                                        <div class="fa-hover">

                                                                         <a href="{{ route('reporte', $his->pqrs_id) }}" style="padding-left:13px ">
                                                                         <i class="glyphicon glyphicon-eye-open fa-9x text-info " title="Ver Detalle"></i></a>
                                                                        </div>
                                                                     </td>
                                                </tr>
                                              @endforeach
                                            </tbody>
                                    </table>

   {!! Html::script('bower_components/bootstrap-table/dist/locale/bootstrap-table-es-SP.min.js') !!}
