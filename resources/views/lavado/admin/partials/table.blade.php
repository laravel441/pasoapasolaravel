
             <div class="form-group-danger">
                          <table data-toggle="table" class="table table-hover" data-id-field="id" data-click-to-select="true" data-select-item-name="items[]" data-pagination="true" data-search="true" data-height="470">
                               <thead>
                                  <tr>
                            <th>ID</th>
                            <th>Auxiliar</th>
                            <th>Patio</th>
                            <th>Proveedor</th>
                             <th>Fecha Inicio</th>
                             <th>Fecha Fin</th>
                               <th>Acciones</th>
                      </tr>
                    </thead>
                       <tbody>
                        @foreach ($ctls as $ctl)



                                @if($ctl->ctl_fecha_fin == '0001-01-01 00:00:00')
                                <tr  data-id="{{$ctl->usr_id}}">
                                    @else
                                 <tr class="well-material-grey-300" data-id="{{$ctl->usr_id}}">
                                 @endif
                                <td>{{$ctl->ctl_id}}</td>
                                <td>{{$ctl->usr_name}}</td>
                                <td>{{$ctl->pto_nombre}}</td>
                                <td>{{$ctl->pvd_nombre}}</td>
                                <td>{{$ctl->ctl_fecha_inicio}}</td>
                                @if($ctl->ctl_fecha_fin == '0001-01-01 00:00:00')
                                <td><i class="text-primary">Control Abierto</i></td>
                                @else
                                <td>{{$ctl->ctl_fecha_fin}}</td>
                                @endif


                                <td>

                                            <div class="fa-hover ">
                                                @if($ctl->ctl_fecha_fin == '0001-01-01 00:00:00')
                                                {{--<a href="{{route('lavado.edit', $ctl->ctl_id)}}">--}}
                                                {{--<i class="fa fa-plus fa-9x text-info" title="Agregar Registro"></i></a>--}}
                                                {{--<a href="{{route('registro.edit', $ctl->ctl_id)}}">--}}
                                                {{--<i class="fa fa-pencil fa-9x text-danger" title="Editar Control"></i></a>--}}
                                                <a href="{{route('lav.admin.show', $ctl->ctl_id)}}">
                                                <i class="fa fa-eye fa-9x text-primary" title="Ver Control"></i></a>

                                            </div>
                                                @else
                                                <a href="{{route('lav.admin.show', $ctl->ctl_id)}}">
                                                <i class="fa fa-eye fa-9x text-primary" title="Ver Control"></i></a>
                                                <a  target='_blank' href="{{route('lav.admin.edit', $ctl->ctl_id)}}">
                                                <i class="fa fa-file-pdf-o fa-9x text-danger" title="Generar Reporte"  target='_blank'></i></a>

                                                @endif

                                </td>
                              </tr>
                            @endforeach
                      </tbody>
                </table>
</div>