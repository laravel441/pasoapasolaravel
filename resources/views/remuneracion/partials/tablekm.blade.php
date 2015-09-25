@if(count($data)>0)
<div class="table-responsive well" style="height: 400px">
	<table id="tb" class="table table-hover" data-options="rownumbers:true">
		<thead>
			<tr class="btn-primary">
				<th>Ruta</th>
				<th>Tipo</th>
				<th>Veh&iacute;culo</th>
				<th>Placa</th>
				<th>{{$header[4]}}</th>
				<th>{{$header[5]}}</th>
				<th>{{$header[6]}}</th>
				<th>{{$header[7]}}</th>
				<th>{{$header[8]}}</th>
				<th>{{$header[9]}}</th>
				<th>{{$header[10]}}</th>
				<th style="text-transform: uppercase">{{$header[11]}}</th>

			</tr>		
		</thead>
		<tbody>
			
			@foreach ($data as $row)
			<tr>
				<td class="active">{{$row->$arrayHeader[0]}}</td>
				<td class="active">{{$row->$arrayHeader[1]}}</td>
				<td class="active">{{$row->$arrayHeader[2]}}</td>
				<td class="active">{{$row->$arrayHeader[3]}}</td>
				<td>{{$row->$arrayHeader[4]}}</td>
				<td>{{$row->$arrayHeader[5]}}</td>
				<td>{{$row->$arrayHeader[6]}}</td>
				<td>{{$row->$arrayHeader[7]}}</td>
				<td>{{$row->$arrayHeader[8]}}</td>
				<td>{{$row->$arrayHeader[9]}}</td>
				<td>{{$row->$arrayHeader[10]}}</td>
				<td class="active">{{$row->$arrayHeader[11]}}</td>
			</tr>			
			@endforeach		
			
		</tbody>
	</table>
</div>
@endif