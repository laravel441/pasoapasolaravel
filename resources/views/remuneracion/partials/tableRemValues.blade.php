<div class="table-responsive" style="height: 190px">
    <table id="tbRemVal" class="table table-bordered table-hover table-condensed    ">
        <thead>
            <tr class="active">
                <th>Tipo</th>
                <th>Descripci&oacute;n</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($valuesRem as $key => $rowRem)
            <tr>
                <td class="active" style="font-weight: bold">{{$rowRem->tip_nombre}}</td>
                <td>{{$rowRem->tip_descripcion}}</td>
                <td style="color: #EB0034">{{ number_format($rowRem->tip_valor * 100 / 1, 3, ',', ',')}}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>