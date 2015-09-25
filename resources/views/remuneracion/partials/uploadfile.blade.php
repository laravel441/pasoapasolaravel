<div class="col-md-6 col-md-offset-0 ">
	<h4 class="text-center">Informe Kil&oacute;metros</h4>
	<div class="well">		
		{!!Form::open(['route'=>['carguekm.store'], 'method'=> 'POST','enctype'=>'multipart/form-data'])!!}
		<input id="input-43" name="rem[]" type="file" class="file"  >
		{!!Form::close()!!}
		<div id="errorBlock43" class="help-block"></div>
		<script>
			$("#input-43").fileinput({
			    showPreview: false,
			    allowedFileExtensions: ["xls", "csv", "xlsx"],
			    elErrorContainer: "#errorBlock43"
			    // you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
			});
		</script>
		{!!Form::open(['route' => ['carguekm.update'], 'method'=> 'PUT'])!!}
		<button id="pru" type="button" class="btn btn-primary" title="Visualizar" data-toggle="modal" data-target="#mdTable"
				@if($disBtn == 1)disabled="disabled"@endif>
  			Ver
		</button>

		@if(count($data)>0)
			<input type="hidden" name="rows" value="{{$data}}">

			@for($x = 4; $x <=11; $x++)
				<input type="hidden" name="firstrow[]" value="{{$arrayHeader[$x]}}">
       		@endfor

       		@foreach($arreglob as $fechas)
       		<input type="hidden" name="fechas[]" value="{{$fechas}}">


       		@endforeach

		@endif

		<!-- Modal -->
		
		<div class="modal modal-wide fade" id="mdTable" role="dialog">
			<div class="modal-dialog">
		    	<div class="modal-content">
		      		<div class="modal-header well-material-grey-300'">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
				        <h2 class="modal-title text-center">Informe de Kil&oacute;metros:  @if(count($data)>0) <b style="text-transform: uppercase">{{ $header[11]}}</b> @endif</h2>
						<h4 class="modal-title text-right">Cantidad de registros: {{count($data)}}</h4>
		      		</div>
				    <div class="modal-body">
				    	<!-- Table Km�s -->

				        @include('remuneracion.partials.tablekm')				        
				    </div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        		
		        		<button type="submit" class="btn btn-primary">Cargar</button>
						
		      		</div>
		    	</div>
		  	</div>
		</div>
		{!!Form::close()!!}
        <div>
            <div class="table-responsive well">
                <table class="table" style="text-align: center">
                    <thead>
                    <tr>
                        <th style="text-align: center">Formato Kil&oacute;metros</th>
                        <th style="text-align: center">Formato Remuneraciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {!!Form::open(['route' => ['carguekm.desc'], 'method'=> 'GET'])!!}
                                <button type="submit" class="btn btn-default" title="Descargar formato Kil&oacute;metros">
                                    <span class="fa fa-file-excel-o fa-4x" style="color: #009688"></span>
                                </button>
                                 {!!Form::close()!!}
                            </td>
                            <td>
                                {!!Form::open(['route' => ['carguekm.descrem'], 'method'=> 'GET'])!!}
                                <button type="submit" class="btn btn-default" title="Descargar formato Remuneraciones">
                                    <span class="fa fa-file-excel-o fa-4x" style="color: #0FB2FC"></span>
                                </button>
                                {!!Form::close()!!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
		<style>
			.modal.modal-wide .modal-dialog {
			  width: 90%;
			}
		</style>
	</div>
</div>