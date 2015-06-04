
              <table class="table table-hover" data-options="rownumbers:true" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Número Móvil</th>
                            <th>Tanqueo</th>
                            <th>Revisión Externa</th>
                             <th>Revisión Interna</th>
                             <th>Observaciones</th>
                             <th>Fecha de creación</th>
                             <th>Aprobación</th>
                             <th>Acciones</th>
                        </tr>
                    </thead>
             <tbody>

                 @foreach ($regs as $reg)

                           <tr  data-id="{{$reg->reg_id}}" >

                            <td>{{$reg->reg_id}}</td>
                            <td>{{$reg->veh_movil}}</td>
                               @if($reg->reg_tanqueo=='1')
                               <td>Interno</td>
                               @else
                               <td>Externo</td>
                               @endif


                   <td>
                       @foreach ($reg_list as $reg_lis)
                            @if($reg_lis->reg_id == $reg->reg_id and $reg_lis->acc_tipo == '1')

                                    @if($reg_lis->det_acc_estado == '1')
                                    <i class="fa fa-check-circle text-primary" ></i> {{$reg_lis->acc_descripcion}}<br/>
                                    @else
                                    <i class="fa fa-times-circle text-danger"></i> {{$reg_lis->acc_descripcion}}<br/>
                                    @endif
                             @endif

                       @endforeach
                   </td>

                    <td>
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
                            <td>{{$reg->reg_creado_en}}</td>
                            @if($reg->reg_aprobacion=='1')
                               <td>Si</td>
                               @else
                               <td>No</td>
                               @endif
                            <td>
                                <div class="fa-hover ">
                                    <a href="#">
                                    <i class="fa fa-plus fa-2x" title="Agregar Registro"></i></a>
                                    <a href="../icon/user-plus">
                                    <i class="fa fa-pencil fa-2x" title="Editar Control"></i></a>
                                    <a href="#">
                                    <i class="fa fa-eye fa-2x" title="Ver Control"></i></a>
                                    <a href="../icon/user-plus">
                                    <i class="fa fa-trash-o fa-2x" title="Eliminar Control"></i></a>
                                </div>

                            </td>



                    @endforeach
                  </tbody>
            </table>
