<div class="col-md-10 col-md-offset-1 ">
    <div class="well">

        {!!Form::open(['route'=>['remreportes.store'], 'method'=> 'POST'])!!}
            <div class="form-control-wrapper col-md-3 col-md-offset-0">
                <select class="form-control combobox" name="anio_id" required onchange = "this.form.submit()">
                    @if($year !='')
                        <option value="{{$year}}">{{$year}}</option>
                    @else
                        <option value="" disabled selected>Sel. A&ntildeo</option>
                    @endif
                    <?php foreach ($anios as $key => $anio): ?>
                        @if($anio->anios!=$year)
                            <option value="{{ $anio->anios }}">{{ $anio->anios }}</option>

                        @endif
                    <?php endforeach ?>

                </select>
            </div>
            <div class="form-control-wrapper col-md-3 col-md-offset-0">
                <select class="form-control combobox" name="mes_id" @if(empty($meses)) disabled @endif required onchange = "this.form.submit()">
                    @if(!empty($month))
                        <option value="{{$month}}">{{$month}}</option>
                    @else
                        <option value="" disabled selected>Sel. Mes</option>
                    @endif
                    <?php foreach ($meses as $key => $mes): ?>
                        @if($mes->mes != $month)
                            <option value="{{ $mes->mes }}">{{ $mes->mes }}</option>
                        @endif
                    <?php endforeach ?>
                </select>

                <input type="hidden" name="m" value="{{$month}}">

            </div>
            <div class="form-control-wrapper col-md-4 col-md-offset-0">
                <select class="form-control combobox" name="per_id" required @if(empty($periodo)) disabled @endif onchange = "this.form.submit()">
                    @if(!empty($period))
                        <option value="{{$period}}">{{$period}}</option>
                    @else
                        <option value="" disabled selected>Sel. Per&iacute;odo</option>
                    @endif
                    <?php foreach ($periodo as $key => $per): ?>
                        @if($period != $per->fecha_inicio.' - '.$per->fecha_fin)
                            <option value="{{ $per->fecha_inicio }} - {{$per->fecha_fin}}">{{ $per->fecha_inicio}} - {{$per->fecha_fin}}</option>
                        @endif

                    <?php endforeach ?>
                </select>

                <input type="hidden" name="p" value="{{$period}}">
            </div>
        {!!Form::close()!!}

        {!!Form::open(['route' => ['remreportes.update'], 'method'=> 'PUT'])!!}
        <div class="form-control-wrapper col-md-2 col-md-offset-0">
            <?php $pru = ['anio' => $year , 'mes' => $month,'periodo' => $period,]; ?>
                @foreach($pru as $var)
                    <input type="hidden" name="valores_buscar[]" value="{{$var}}">
                @endforeach
            <button type="submit" class="btn btn-primary" title="Generar Reporte"
                    @if(empty($period))disabled="disabled" @endif>
                Generar
            </button>
        </div>
        {!!Form::close()!!}

        <!-- Modal -->
        {!!Form::open(['route' => ['remreportes.generar'], 'method'=> 'PUT'])!!}
        <div class="modal fade" id="mdTable" role="dialog">
            <div class="modal-dialog modal-lg" style="width: 1250px; top: 200px">
                <div class="modal-content">
                    <div class="modal-header well-material-grey-300'">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
                        <h2 class="modal-title text-center">Generaci&oacute;n Reporte Remuneraci&oacute;n</h2>
                        <h4 class="modal-title text-right"></h4>
                    </div>
                    <div class="modal-body">
                        <!-- Table Km�s -->

                     <input type="hidden" name="p" value="{{$period}}">
                        @include('remuneracion.partials.tableReports')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                        <button type="submit" class="btn btn-primary">Exportar</button>

                    </div>
                </div>
            </div>
        </div>
                {!!Form::close()!!}

        <br/><br/>

        <script type="text/javascript">
            @if (count($rem) > 0)
                $('#mdTable').modal('show');
            @endif
        </script>

    </div>
</div>