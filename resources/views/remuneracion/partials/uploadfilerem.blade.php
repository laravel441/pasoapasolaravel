<div class="col-md-6 col-md-offset-0 ">
    <h4 class="text-center">Informe Remuneraciones</h4>
    <div class="well">
        {!!Form::open(['route'=>['carguekm.rem'], 'method'=> 'POST','enctype'=>'multipart/form-data'])!!}
        <input id="input-42" name="remuneracion[]" type="file" class="file"  >
        {!!Form::close()!!}
        <div id="errorBlock42" class="help-block"></div>
        <script>
            $("#input-42").fileinput({
                showPreview: false,
                allowedFileExtensions: ["xls", "csv", "xlsx"],
                elErrorContainer: "#errorBlock42"
                // you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
            });
        </script>
        {!!Form::open(['route' => ['carguekm.carguerem'], 'method'=> 'PUT'])!!}
        <button id="REM" type="button" class="btn btn-primary" title="Visualizar" data-toggle="modal" data-target="#mdTableRem"
                @if($disBtnRem == 1)disabled="disabled"@endif>
            Ver
        </button>

        @if(count($data)>0)
            <input type="hidden" name="rowsRem" value="{{$data}}">
            @for($x = 4; $x <=11; $x++)
                <input type="hidden" name="firtsRowRem[]" value="{{$arrayHeader[$x]}}">
            @endfor
        @endif

        <!-- Modal -->

        <div class="modal modal-wide fade" id="mdTableRem" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header well-material-grey-300'">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
                        <h2 class="modal-title text-center">Informe de Remuneraciones @if(count($data)>0) {{$data->getTitle()}} @endif</h2>
                        <h4 class="modal-title text-right">Cantidad de registros: {{count($data)}}</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Table Remuneraciones -->
                        @include('remuneracion.partials.tablerem')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Cargar</button>
                    </div>
                </div>
            </div>
        </div>
        {!!Form::close()!!}
        <!-- End Modal -->

        <!-- Table Rem Values -->
        <h5 style="font-weight: bold">Se utilizar&aacute;n los siguientes valores para realizar los c&aacute;lculos</h5>
        @include('remuneracion.partials.tableRemValues')
        <!-- End Table Rem Values -->
    </div>
</div>
