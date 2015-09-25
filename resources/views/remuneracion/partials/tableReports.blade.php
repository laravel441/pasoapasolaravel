<div class="table-responsive well" style="width: 1200px">
    <table id="tbRemVal" class="table table-hover">
        <thead>
            <tr class="active">
                <th>Zona</th>
                <th>Per&iacute;odo</th>
                <th>GMF</th>
                <th>Renta</th>
                <th>ICA</th>
                <th>CREE</th>
                <th>Total Retenciones</th>
                <th>Total Recaudo</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rem as $key => $r)
            <tr>
                <td class="active" style="font-weight: bold; color: #EB0034">{{$r->zon_nombre}}</td>
                <td>{{$r->fecha_inicio}} - {{$r->fecha_final}}</td>
                <td>{{$r->valor_gravamen}}</td>
                <td>{{$r->valor_renta}}</td>
                <td>{{$r->valor_ica}}</td>
                <td>{{$r->valor_cree}}</td>
                <td>{{$r->valor_total}}</td>
                <td>{{$r->total_recaudo}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>