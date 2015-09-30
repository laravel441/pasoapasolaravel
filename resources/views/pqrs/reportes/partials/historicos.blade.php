  <table class="table table-bordered" data-pagination="true">
    <thead>
      <tr class="success">
       <th><h5>N° Requerimiento</h5></th>
       <th><h5>Fecha de Asignacion</h5></th>
       <th><h5>Tipo</h5></th>
       <th><h5>Incidencia</h5></th>
       <th><h5>Canal</h5></th>
       <th><h5>Fecha del Evento</h5></th>
       <th><h5>Estado</h5></th>
       <th><h5>Prioridad</h5></th>
       <th><h5>Patio</h5></th>
       <th><h5>Ruta</h5></th>
       <th><h5>Placa</h5></th>
       <th><h5>Movil</h5></th>
     </tr>
   </thead>
   <tbody>
    @foreach($filtros as $fechas)
    <tr>
      <td><h6>{{$fechas->no_requerimiento}}</h6></td>
      <td><h6>{{$fechas->fecha_asignacion}}</h6></td>
      <td><h6>{{$fechas->nombre}}</h6></td>
      <td><h6>{{$fechas->incidencia}}</h6></td>
      <td><h6>{{$fechas->canal}}</h6></td>
      <td><h6>{{$fechas->fecha_suceso}}</h6></td>
      <td><h6>{{$fechas->estado}}</h6></td>
      <td><h6>{{$fechas->prioridad}}</h6></td>
      <td><h6>{{$fechas->patio}}</h6></td>
      <td><h6>{{$fechas->ruta}}</h6></td>
      <td><h6>{{$fechas->placa}}</h6></td>
      <td><h6>{{$fechas->movil}}</h6></td>

    </tr>
    @endforeach
  </tbody>
</table>