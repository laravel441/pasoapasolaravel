 <table class="table table-bordered" >
   <thead>
     <tr>
       <th class="danger"><h5 style="font-weight:bolder">Incidencia</h5></th>
       <th class="danger"><h5 style="font-weight:bolder">Cantidad</h5></th>
     </tr>
   </thead>
   <tbody>
     @foreach ($data as $tm)
     <tr>
      <td><h6>{{$tm->inc_nombre}}</h6></td>
      <td><h6>{{$tm->cantidad}}</h6></td>
    </tr>
    @endforeach
  </tbody>
</table>