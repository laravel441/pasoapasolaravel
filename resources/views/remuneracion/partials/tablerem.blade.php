@if(count($data)>0 && array_key_exists(12, $arrayHeader))
    <div class="table-responsive well" style="height: 400px">
        <table id="tb" class="table table-hover" data-options="rownumbers:true">
            <thead>
            <tr class="btn-primary">
                <th>Tipo</th>
                <th>Subtipo</th>
                <th>Zona</th>
                <th>Ruta</th>
                <th>Lunes <br/> {{$data[0]->lunes}}</th>
                <th>Martes <br/> {{$data[0]->martes}}</th>
                <th>Mi&eacute;rcoles <br/> {{$data[0]->miercoles}}</th>
                <th>Jueves <br/> {{$data[0]->jueves}}</th>
                <th>Viernes <br/> {{$data[0]->viernes}}</th>
                <th>S&aacute;bado <br/> {{$data[0]->sabado}}</th>
                <th>Domingo <br/> {{$data[0]->domingo}}</th>
                <th>Total <br/> {{$data[0]->lunes}} - {{$data[0]->domingo}}</th>

            </tr>
            </thead>
            <tbody>

            @foreach ($data as $row)
                @if($row->tipo != "DIA")
                <tr @if($row->tipo == "IXV" || $row->tipo == "IXK" || $row->tipo == "IXP")
                        style="color: #EB0034"
                    @elseif($row->tipo == "RVD" || $row->tipo == "RKD" || $row->tipo == "RPD")
                    style="color: #0033DD"
                    @elseif($row->tipo == "RZ" || $row->tipo == "RZF" || $row->tipo == "DFR" || $row->tipo == "MUL" || $row->tipo == "RZN")
                        style="font-weight: bold"
                    @endif>
                    <td class="active">{{$row->tipo}}</td>
                    <td class="active">{{$row->subtipo}}</td>
                    <td class="active">{{$row->zona}}</td>
                    <td>{{$row->ruta}}</td>
                    <td>{{$row->lunes}}</td>
                    <td>{{$row->martes}}</td>
                    <td>{{$row->miercoles}}</td>
                    <td>{{$row->jueves}}</td>
                    <td>{{$row->viernes}}</td>
                    <td>{{$row->sabado}}</td>
                    <td>{{$row->domingo}}</td>
                    <td>{{$row->$arrayHeader[12]}}</td>

                </tr>
                @endif
            @endforeach

            </tbody>
        </table>
    </div>
@endif