<div class="table-responsive form-group-danger">

              <table data-toggle="table" class="table table-hover" data-id-field="id" data-click-to-select="true" data-select-item-name="items[]" data-pagination="true" data-search="true" data-height="350">
                                             <thead>
                                                <tr>
                            <th nowrap>ID</th>
                            <th>Número Móvil</th>
                            <th nowrap>Tanqueo</th>
                            <th>Revisión Externa</th>
                             <th>Revisión Interna</th>
                             <th nowrap>Observaciones</th>
                             <th>Archivos Adjuntos</th>
                             <th nowrap>Fecha de creación</th>
                             <th nowrap>Aprobación</th>
                             <th nowrap>Acciones</th>
                        </tr>
                    </thead>
             <tbody>

                 @foreach ($regs as $reg)

                           <tr  data-id="{{$reg->reg_id}}" >

                            <td>{{$reg->reg_id}}</td>
                            <td  nowrap>{{$reg->veh_movil}}</td>
                               @if($reg->reg_tanqueo=='1')
                               <td>Interno</td>
                               @else
                               <td>Externo</td>
                               @endif


                   <td nowrap>
                       @foreach ($reg_list as $reg_lis)
                            @if($reg_lis->reg_id == $reg->reg_id and $reg_lis->acc_tipo == '1')

                                    @if($reg_lis->det_acc_estado == '1')
                                    <i class="fa fa-check-circle text-primary"></i>{{$reg_lis->acc_descripcion}} </span> <br/>
                                    @else
                                    <i class="fa fa-times-circle text-danger"></i>{{$reg_lis->acc_descripcion}}<br/>
                                    @endif
                             @endif

                       @endforeach
                   </td>

                    <td nowrap>
                          @foreach ($reg_list as $reg_lis)
                               @if($reg_lis->reg_id == $reg->reg_id and $reg_lis->acc_tipo == '2')

                                       @if($reg_lis->det_acc_estado == '1')
                                       <i class="fa fa-check-circle text-primary" ></i> {{$reg_lis->acc_descripcion}}<br/>
                                       @else
                                       <i class="fa fa-times-circle text-danger"></i> {{$reg_lis->acc_descripcion}}<br/>
                                       @endif
                                @endif

                          @endforeach
                      </td>


                              <td>{{$reg->reg_observacion}}</td>
                            <td nowrap>
                      			@foreach($adjunto as  $adj)

								@if($reg->reg_id==$adj->adj_reg_id)



                                 <button type="button" class="btn btn-xs btn-block btn-info" data-toggle='modal' data-target='#{{$adj->adj_id}}' style='margin: -8px'>{{$adj->adj_nombre}}</button></br>


                                   <div class="modal fade" id="{{$adj->adj_id}}" role="dialog" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                          <div class="modal-header well-material-grey-300">
                                                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h2 class="modal-title text-center">{{$adj->adj_nombre}}</h2>

                                                          </div>
                                                       <div class="modal-body" align="center"></br>
                                                           <img src="/lavado_adj/{{$reg->reg_id}}/{{$adj->adj_nombre}}" height="300" width="300"> </a>


                                                    </div>
                                                       <div class="modal-footer">
                                                           <div class="col-sm-7 col-sm-offset-0">

                                                                 <button type="button" class="btn btn" data-dismiss="modal"><span class="text-danger fa fa-times fa-3x" title="Cancelar"></span></button>
                                                           </div>
                                                       </div>
                                            </div>
                                        </div>
                                    </div>




                              @endif

                             @endforeach</td>

                            <td>{{$reg->reg_creado_en}}</td>
                            @if($reg->reg_aprobacion=='1')
                               <td>Si</td>
                               @else
                               <td>No</td>
                               @endif
                            <td>

                                        <div class="fa-hover ">
                                            @if($ctls->ctl_fecha_fin == '0001-01-01 00:00:00')

                                            <i class="text-primary">Control Abierto</i>


                                        </div>
                                            @else

                                            <i class="text-info">Control Cerrado</i>

                                            @endif

                            </td>





                    @endforeach
                  </tbody>
            </table>

</div>