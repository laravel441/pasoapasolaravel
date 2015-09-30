<div class="form-group-danger">
    <table data-toggle="table" class="table table-hover" data-id-field="id" data-click-to-select="true" data-select-item-name="items[]" data-pagination="true" data-search="true" data-height="470">
        <thead>
            <tr>
                <th data-sortable="true">No. Requerimiento</th>
                <th data-sortable="true">Canal</th>
                <th data-sortable="true">Tipo</th>
                <th >Incidencia</th>
                <th data-sortable="true">Prioridad</th>
                <th data-sortable="true">Fecha Asignación</th>
                <th data-sortable="true">Fecha Vencimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registros as $reg)
            @if( $reg->pqrs_creado_en >= date($reg->pqrs_fecha_vencimiento))
            <tr data-id="{{$reg->pqrs_num_requerimiento}}" class="danger">
                <td>{{ $reg->pqrs_num_requerimiento }}</td><td>{{ $reg->can_nombre }}</td>
                <td>{{ $reg->typ_nombre }}</td>
                <td>{{ $reg->inc_nombre }}</td>
                <td>{{ $reg->pri_nombre }}</td>
                <td>{{ $reg->pqrs_fecha_asignacion}}</td>
                <td>{{ $reg->pqrs_fecha_vencimiento }}</td>
                <td>
                    <div class="fa-hover ">
                        <a href="{{ route('registros-id', $reg->pqrs_id) }}" id="accion">
                            <i class="fa fa-plus fa-9x text-info" title="Agregar Respuesta"></i></a>
                            <a href="{{route('editar-id', $reg->pqrs_id)}}" id="accion">
                                <i class="fa fa-pencil fa-9x text-danger" title="Editar Solicitud"></i></a>
                            </div>
                        </td>
                    </tr>
                    @else
                    <tr data-id="{{$reg->pqrs_num_requerimiento}}"  class="success">
                        <td>{{ $reg->pqrs_num_requerimiento }}</td>
                        <td>{{ $reg->can_nombre }}</td>
                        <td>{{ $reg->typ_nombre }}</td>
                        <td>{{ $reg->inc_nombre }}</td>
                        <td>{{ $reg->pri_nombre }}</td>
                        <td>{{ $reg->pqrs_fecha_asignacion}}</td>
                        <td>{{ $reg->pqrs_fecha_vencimiento }}</td>
                        <td>
                            <div class="fa-hover ">
                                <a href="{{ route('registros-id', $reg->pqrs_id) }}" id="accion">
                                    <i class="fa fa-plus fa-9x text-info" title="Agregar Respuesta"></i></a></li>
                                    <a href="{{route('editar-id', $reg->pqrs_id)}}" id="accion">
                                        <i class="fa fa-pencil fa-9x text-danger" title="Editar Solicitud"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <style type="text/css">
                #accion{
                    margin-left: 8px;
                }
                #accion:last-child{
                    margin-left: 5px;
                }
                </style>