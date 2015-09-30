                  <!-- Include Required Prerequisites -->
                  {!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
                  {!! Html::script('bower_components/calendario/moment.min.js') !!}
                  {!! Html::script('bower_components/calendario/daterangepicker.js') !!}
                  {!! Html::style('bower_components/calendario/daterangepicker.css') !!}



<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">
   <select class="form-control combobox" name="canal_id" id="canal_id" required>
    <option value="" disabled selected>Canal</option>
    <?php foreach ($canales as $key => $cann): ?>
    <option value="{{ $cann->can_id }}" class="{{ $cann->can_tipo }}">{{ $cann->can_nombre }}</option>
  <?php endforeach ?>
</select>
</div>
</div>
<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-0">
    <div class="form-control-wrapper">
      <input  class="form-control"  name="pqrs_num_requerimiento" id="pqrs_num_requerimiento" type="text" required>
      <input type='hidden' name="consecutivo" value="{{$num}}">
      <div class="floating-label">Número Requerimiento:</div>
    </div>
  </div>
</div>
<div class="form-group-danger" id="dateRangeFormDate">
 <div class="col-md-3 col-md-offset-1">
   <div class="form-control-wrapper">
    <div class="input-group input-append date">
      <input type="text" class="form-control" name="fecha_asignacion" id="dateRangePicker" required>
      <div class="floating-label">Fecha de Asignacion:</div>
      <span class="input-group-addon add-on">
        <span class="text-danger fa fa-calendar fa-9x"></span></span>
      </div>
    </div>
  </div>
</div>
<br>
</br>
<br>
</br>
<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">
   <select class="form-control combobox" name="typo_id" required>
    <option value="" disabled selected>Tipo:</option>
    <?php foreach ($tipos as $key => $type): ?>
    <option value="{{ $type->typ_id }}">{{ $type->typ_nombre }}</option>
  <?php endforeach ?>
</select>
</div>
</div>

<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-0">
    <select class="form-control combobox" name="inciden_id" required>
      <option value="" disabled selected>Incidencia:</option>
      <?php foreach ($incidencias as $key => $inciden): ?>
      <option value="{{ $inciden->inc_id }}">{{ $inciden->inc_nombre }}</option>
    <?php endforeach ?>
  </select>
</div>
</div>


<div class="form-group-danger">
 <div class="col-md-3 col-md-offset-1">
   <div class="form-control-wrapper">
    <div class="input-group input-append date">
      <input type="text" class="form-control" name="hora_fecha" id="datetimepicker" required>
      <div class="floating-label">Fecha y Hora del Suceso:</div>
      <span class="input-group-addon add-on">
        <span class="text-danger fa fa-calendar fa-9x"></span></span>
      </span>
    </div>
  </div>
</div>
</div>
<br>
</br>
<br>
</br>
<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">
    <div class="form-control-wrapper">
      <input class="form-control"  name="lugar" type="text" required>
      <div class="floating-label">Lugar del Suceso:</div>
    </div>
  </div>
</div>

<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-0">
   <select class="form-control combobox" name="estap_id" required>
    <option value="" disabled selected>Estado:</option>
    <?php foreach ($estados as $key => $estad): ?>
    <option value="{{ $estad->stp_id }}">{{ $estad->stp_nombre }}</option>
  <?php endforeach ?>
</select>
</div>
</div>
<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">
   <select class="form-control combobox" name="priorid_id" required>
    <option value="" disabled selected>Prioridad:</option>
    <?php foreach ($prioridad as $key => $prio): ?>
    <option value="{{ $prio->pri_id }}">{{ $prio->pri_nombre }}</option>
  <?php endforeach ?>
</select>
</div>
</div>
<br>
</br>
<br>
</br>
<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">
    <div class="form-control-wrapper">
      <input class="form-control" name="afectado" type="text" required>
      <div class="floating-label">Nombre del Usuario:</div>
    </div>
  </div>
</div>

<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-0">
    <div class="form-control-wrapper">
      <input type="number" class="form-control"  name="celuar_afectado" type="text" required>
      <div class="floating-label">N° Celular del Usuario:</div>
    </div>
  </div>
</div>

<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">
    <div class="form-control-wrapper">
      <input type="email" class="form-control"  name="correo_afectado" type="text" required>
      <div class="floating-label">Correo del Usuario:</div>
    </div>
  </div>
</div>
<br>
</br>
<br>
</br>
<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">
   <select class="form-control combobox" name="ruta_id" required>
    <option value="" disabled selected>Ruta:</option>
    <?php foreach ($rutas as $key => $ruta): ?>
    <option value="{{ $ruta->rut_id }}">{{ $ruta->rut_nombre }}</option>
  <?php endforeach ?>
</select>
</div>
</div>


<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-0">
   <select class="form-control combobox" name="vehic_id" id="vehic_id" required>
    <option value="" id="plaka" disabled selected>Placa:</option>
    <?php foreach ($vehiculos as $plak):?>
    <option value="{{ $plak->veh_id }}">{{ $plak->veh_placa }}</option>
  <?php endforeach ?>
</select>
</div>
</div>

<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">
   <select class="form-control combobox" name="sitp_id" id="sitp" required>
    <option value="" id="nsitp" disabled selected>N° SITP:</option>
    <?php foreach ($vehiculos as  $sitp): ?>
    <option value="{{ $sitp->veh_id }}">{{ $sitp->veh_movil }}</option>
  <?php endforeach ?>
</select>
</div>
</div>
<br>
</br>
<br>
</br>
<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">
   <select class="form-control combobox" name="patio_id" required>
    <option value="" disabled selected>Patio:</option>
    <?php foreach ($patios as $key => $ptio): ?>
    <option value="{{ $ptio->pto_id }}">{{ $ptio->pto_descripcion }}</option>
  <?php endforeach ?>
</select>
</div>
</div>

<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-0">
   <select class="form-control combobox" name="area_id" required>
    <option value="" disabled selected>Proceso Asignado:</option>
    <?php foreach ($areass as $key => $area): ?>
    <option value="{{ $area->area_id }}">{{ $area->area_nombre }}</option>
  <?php endforeach ?>
</select>
</div>
</div>

<div class="form-group-danger" id="dateVenciForm">
 <div class="col-md-3 col-md-offset-1">
   <div class="form-control-wrapper">
    <div class="input-group input-append date">
      <input type="text" class="form-control" name="fecha_asignacion" id="dateRangePicker2" required>
      <div class="floating-label">Fecha de Vencimiento:</div>
      <span class="input-group-addon add-on">
        <span class="text-danger fa fa-calendar fa-9x"></span></span>
      </div>
    </div>
  </div>
</div>
<br>
</br>
<br>
</br>
<div class="bs-example" data-example-id="textarea-form-control">
 <div class="col-md-18 col-md-offset-0">
  <div class="floating-label">Descripción:</div>
</br>
<textarea class="form-control" rows="4" maxlength="10000" placeholder="Digite lo Sucedido..." name="descrip" ></textarea>
<h6>Cantidad maxima de caracteres 10.000</h6>
</div>
</div>

<div class="form-group">
    <ul class="adj" id="list">
    </ul>
  <i class="fa fa-folder-open"></i>
  <input type="file" name="archivos[]" id="files" multiple="multiple"/>
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  <input type="hidden" name="action" value="upload" />
</div>
<br>
</br>
<input type="hidden" name="validacion">


<script>
$(document).ready(function() {
  $('#dateRangePicker').daterangepicker({
   singleDatePicker: true,
   timePicker: false,
   timePickerIncrement: 1,
   showDropdowns: true,
   locale: {
    format: 'MM/DD/YYYY'
  }
});
});

$(document).ready(function() {
  $('#datetimepicker').daterangepicker({
    singleDatePicker: true,
    timePicker: true,
    timePickerIncrement: 1,
    showDropdowns: true,
    locale: {
      format: 'MM/DD/YYYY h:mm A'
    }
  });
});

$(document).ready(function() {
  $('#dateRangePicker2').daterangepicker({
    singleDatePicker: true,
    timePicker: false,
    timePickerIncrement: 1,
    showDropdowns: true,
    locale: {
      format: 'MM/DD/YYYY'
    }
  });
});
$( "#canal_id" ).change(function() {
  var canal = $("option:selected",this).attr("class");
  if(canal == 1){
    $( "#pqrs_num_requerimiento" ).val("MC-"+{{$num}});
    //$("#pqrs_num_requerimiento").prop('disabled', true);
  }
  else if(canal== 2){
    $( "#pqrs_num_requerimiento" ).val('');
    //$("#pqrs_num_requerimiento").prop('disabled', false);
  }
});

$( "#vehic_id" ).change(function() {
  var sitp = $(this).val();
  $("#sitp").val(sitp);
});

$( "#sitp" ).change(function() {
  var sitp = $(this).val();
  $("#vehic_id").val(sitp);
});


$(document).ready(function() {
  $('#files').click(function(){ // The $ is not necessary - you already have it

       $('#list').empty();  
       $("#files").val("");
    });
});



   
</script>

<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<script type="text/javascript">

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {
      // Only process image files.
      if (f.type.match('image/jpeg')||f.type.match('image/gif')||f.type.match('image/bmp')||f.type.match('image/png')) {


      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('li');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
    else{
    alert('Formato de archivo no permitido');
    $('#list').empty();  
    $("#files").val("");
    return;
  }
  }
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);



</script>


<style>
.thumb {
  height:75px;
  margin: 5px 5px 0 0;;
}
.remove_thumb {
  position:relative;
  top:-30px;
  right:11px;
  background:#9E9E9E;
  color:white;
  border-radius:50px;
  font-size:0.9em;
  padding: 0 0.3em 0;
  text-align:center;
  cursor:pointer;
}
.remove_thumb:before {
  content: "×";
}



#server{
  background:#666;
  padding:10px;
}
#server img{
  max-width:100px;
  max-height:100px;
}
.adj{
  list-style: none;
}
.adj li{
  display: inline-block;
}
</style>
<script>

</script>
