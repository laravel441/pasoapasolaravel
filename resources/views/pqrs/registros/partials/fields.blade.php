                  <!-- Include Required Prerequisites -->
                  {!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
                  {!! Html::script('bower_components/calendario/moment.min.js') !!}
                  {!! Html::script('bower_components/calendario/daterangepicker.js') !!}
                  {!! Html::style('bower_components/calendario/daterangepicker.css') !!}

                  <!--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css" />-->
                  <!-- Include Date Range Picker -->


                  <input class="hidden"  name="pqrs_id" type="text" value="{{ $regis->pqrs_id}}">
                  <div class="form-group-danger">
                    <div class="col-md-3 col-md-offset-1">
                      <div class="form-control-wrapper">
                        <input class="form-control" disabled="disabled" name="pqrs_num_requerimiento" type="text" value="{{ $regis->pqrs_num_requerimiento}}">
                        <div class="floating-label">Numero pqrs_num_requerimiento:</div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group-danger">
                    <div class="col-md-3 col-md-offset-0">
                     <select class="form-control combobox" name="pqrs_can">
                      <option value="{{$regis->pqrs_can_id}}">{{$canal_nombre->can_nombre}}</option>
                      <?php foreach ($canalesp as $key => $canalespqrs): ?>
                      <option value="{{ $canalespqrs->can_id }}">{{ $canalespqrs->can_nombre }}</option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>

              <div class="form-group-danger" id="dateRangeFormDate">
               <div class="col-md-3 col-md-offset-1">
                 <div class="form-control-wrapper">
                  <div class="input-group input-append date">
                    <input type="text" class="form-control" name="pqrs_fecha_asignacion" id="dateRangePicker" placeholder="{{ $regis->pqrs_fecha_asignacion}}">
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
             <select class="form-control combobox" name="pqrs_typ_id">
              <option value="{{$regis->pqrs_typ_id}}">{{$tipo_nombre->typ_nombre}}</option>
              <?php foreach ($tiposp as $key => $tipospqrs): ?>
              <option value="{{ $tipospqrs->typ_id }}">{{ $tipospqrs->typ_nombre }}</option>
            <?php endforeach ?>
          </select>
        </div>
      </div>

      <div class="form-group-danger">
        <div class="col-md-3 col-md-offset-0">
          <select class="form-control combobox" name="pqrs_inc_id">
            <option value="{{$regis->pqrs_inc_id}}">{{$incidenc_nombre->inc_nombre}}</option>
            <?php foreach ($incidenciasp as $key => $incidenciapqrs): ?>
            <option value="{{ $incidenciapqrs->inc_id }}">{{ $incidenciapqrs->inc_nombre }}</option>
          <?php endforeach ?>
        </select>
      </div>
    </div>

    <div class="form-group-danger">
     <div class="col-md-3 col-md-offset-1">
       <div class="form-control-wrapper">
        <div class="input-group input-append date">
          <input type="text" class="form-control" name="pqrs_fecha_hora_suceso" id="datetimepicker" placeholder="{{ $regis->pqrs_fecha_hora_suceso}}">
          <div class="floating-label">Fecha y Hora del Suceso:</div>
          <span class="input-group-addon add-on">
            <span class="text-danger fa fa-calendar fa-9x"></span>
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
      <input class="form-control"  name="pqrs_lugar" type="text" value="{{ $regis->pqrs_lugar}}">
      <div class="floating-label">Lugar del Suceso:</div>
    </div>
  </div>
</div>

<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-0">
   <select class="form-control combobox" name="pqrs_stp_id">
    <option value="{{$regis->pqrs_stp_id}}">{{$estado_nombre->stp_nombre}}</option>
    <?php foreach ($estadosp as $key => $estadospqrs): ?>
    <option value="{{ $estadospqrs->stp_id }}">{{ $estadospqrs->stp_nombre }}</option>
  <?php endforeach ?>
</select>
</div>
</div>
<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">
   <select class="form-control combobox" name="pqrs_pri_id">
    <option value="{{$regis->pqrs_pri_id}}">{{$prioridad_nombre->pri_nombre}}</option>
    <?php foreach ($prioridadesp as $key => $prioridadespqrs): ?>
    <option value="{{ $prioridadespqrs->pri_id }}">{{ $prioridadespqrs->pri_nombre }}</option>
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
      <input class="form-control" name="pqrs_afectado" type="text" value="{{ $regis->pqrs_afectado}}">
      <div class="floating-label">Nombre del Usuario:</div>
    </div>
  </div>
</div>

<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-0">
    <div class="form-control-wrapper">
      <input class="form-control"  name="pqrs_num_celuar_afectado" type="text" value="{{ $regis->pqrs_num_celuar_afectado}}">
      <div class="floating-label">N° Celular del Usuario:</div>
    </div>
  </div>
</div>

<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">
    <div class="form-control-wrapper">
      <input class="form-control"  name="pqrs_num_correo_afectado" type="text" value="{{ $regis->pqrs_num_correo_afectado}}">
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
   <select class="form-control combobox" name="pqrs_rut_id">
    <?php if ($regis->pqrs_rut_id==0) {?>
      <option value="{{$regis->pqrs_rut_id}}">Ruta:</option>
      <?php } else { ?>
      <option value="{{$regis->pqrs_rut_id}}">{{$ruta_r->rut_nombre}}</option>
      <?php }?>
    <?php foreach ($rutasp as $key => $rutaspqrs):?>
    <option value="{{ $rutaspqrs->rut_id }}">{{ $rutaspqrs->rut_nombre }}</option>
  <?php endforeach ?>
  <div class="floating-label">Ruta:</div>
</select>
</div>
</div>
<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-0">
   <select class="form-control combobox" name="pqrs_veh_id" id="placa">
    @if($regis->pqrs_veh_id==0)
    <option value="{{$regis->pqrs_veh_id}}">Placa:</option>
    @else
    <option value="{{$regis->pqrs_veh_id}}">{{$placa_r->veh_placa}}</option>
    @endif
    <?php foreach ($vehiculosp as $key => $placaspqrs):?>
    <option value="{{ $placaspqrs->veh_id }}">{{ $placaspqrs->veh_placa }}</option>
  <?php endforeach ?>
</select>
</div>
</div>

<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-1">

   <select class="form-control combobox" name="pqrs_veh_id" id="sitp">
     @if($regis->pqrs_veh_id==0)

    <option value="{{$regis->pqrs_veh_id}}">N° SITP:</option>
     @else
     <option value="{{$regis->pqrs_veh_id}}">{{$placa_r->veh_movil}}</option>
      @endif
    <?php foreach ($vehiculosp as $key => $sitpqrs): ?>
    <option value="{{ $sitpqrs->veh_id }}">{{ $sitpqrs->veh_movil }}</option>
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
   <select class="form-control combobox" name="pqrs_pto_id">
    @if($regis->pqrs_pto_id==0)
    <option value="{{$regis->pqrs_pto_id}}" selected>Patio:</option>
    @else
    <option value="{{$regis->pqrs_pto_id}}" selected>{{$patio_r->pto_nombre}}</option>
    @endif
    <?php foreach ($patiosp as $key => $patiospqrs): ?>
    <option value="{{ $patiospqrs->pto_id }}">{{ $patiospqrs->pto_descripcion }}</option>
  <?php endforeach ?>
</select>
</div>
</div>

<div class="form-group-danger">
  <div class="col-md-3 col-md-offset-0">
   <select class="form-control combobox" name="pqrs_area_id">
    @if($regis->pqrs_area_id==0)
    <option value="{{$regis->pqrs_area_id}}">Proceso Asignado:</option>
    @else
    <option value="{{$regis->pqrs_area_id}}">{{$area_r->area_nombre}}</option>
    @endif
    <?php foreach ($areasp as $key => $areaspqrs): ?>
    <option value="{{ $areaspqrs->area_id }}">{{ $areaspqrs->area_nombre }}</option>
  <?php endforeach ?>
</select>
</div>
</div>

<div class="form-group-danger" id="dateVenciForm">
 <div class="col-md-3 col-md-offset-1">
   <div class="form-control-wrapper">
    <div class="input-group input-append date">
      <input type="text" class="form-control" name="pqrs_fecha_vencimiento" id="dateRangePicker2"  placeholder="{{ $regis->pqrs_fecha_vencimiento}}">
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
<textarea class="form-control" rows="4" maxlength="10000" placeholder="Digite lo Sucedido..." name="pqrs_descripcion">{{ $regis->pqrs_descripcion}}</textarea>
<h6>Cantidad maxima de caracteres 10.000</h6>
</div>
</div>


<div class="form-group">


  <ul id="list" class="adj">

    @foreach($adj_pqrs as $key => $adjuntos)

                @if($formato[$key][1]=='jpg'||$formato[$key][1]=='bmp'||$formato[$key][1]=='jpeg'||$formato[$key][1]=='gif'||$formato[$key][1]=='png')
                <li>
                    <a class="thumb" href="#" data-image-id="" data-toggle="modal" data-title="{{ $adjuntos->nombre }}"  data-image="/pqrs_adjuntos/{{$regis->pqrs_id}}/{{ $adjuntos->nombre }}" data-target="#image-gallery"> <img src="/pqrs_adjuntos/{{$regis->pqrs_id}}/{{ $adjuntos->nombre }}" class="thumb"></a>
                </li>
              @endif

    @endforeach



</ul>
<ul  id="list" class="adj" >
@foreach($adj_pqrs as $key => $adjuntos)
      @if($formato[$key][1]=='doc'||$formato[$key][1]=='docx')
                 <div class="fa fa-file-word-o"><a class="media" href="/pqrs_adjuntos/{{$regis->pqrs_id}}/{{ $adjuntos->nombre }}">   {{ $adjuntos->nombre }}</a> </div><br><br>
      @endif
      @if($formato[$key][1]=='xls'||$formato[$key][1]=='xlsx')
                  <div class="fa fa-file-excel-o"><a class="media" href="/pqrs_adjuntos/{{$regis->pqrs_id}}/{{ $adjuntos->nombre }}">   {{ $adjuntos->nombre }}</a> </div><br><br>
      @endif
      @if($formato[$key][1]=='pdf')
                   <div class="fa fa-file-pdf-o"><a class="media" href="/pqrs_adjuntos/{{$regis->pqrs_id}}/{{ $adjuntos->nombre }}">   {{ $adjuntos->nombre }}</a> </div><br>
      @endif

   @endforeach
   </ul>

<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title" id="image-gallery-title"></h4>
            </div>
            <div class="modal-body">
                <center><img id="image-gallery-image" class="img-responsive" src=""></center>
            </div>
            <div class="modal-footer">

                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="show-previous-image"><span class="glyphicon glyphicon-chevron-left"></span>Ant.</button>
                </div>

                <div class="col-md-8 text-justify" id="image-gallery-caption">
                </div>

                <div class="col-md-2">
                    <button type="button" id="show-next-image" class="btn btn-primary">Sig.<span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<br>
</br>

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

$( "#placa" ).change(function() {
  var sitp = $(this).val();
  $("#sitp").val(sitp);
});

$( "#sitp" ).change(function() {
  var sitp = $(this).val();
  $("#placa").val(sitp);
});

$(document).ready(function() {
  $('#files').click(function(){ // The $ is not necessary - you already have it
       $('#list').empty();
       $("#files").val("");
    });
});



$(document).ready(function(){

    loadGallery(true, 'a.thumb');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current){
        $('#show-previous-image, #show-next-image').show();
        if(counter_max == counter_current){
            $('#show-next-image').hide();
        } else if (counter_current == 1){
            $('#show-previous-image').hide();
        }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr){
        var current_image,
            selector,
            counter = 0;

        $('#show-next-image, #show-previous-image').click(function(){
            if($(this).attr('id') == 'show-previous-image'){
                current_image--;
            } else {
                current_image++;
            }

            selector = $('[data-image-id="' + current_image + '"]');
            updateGallery(selector);
        });


        function updateGallery(selector) {
            var $sel = selector;
            prueba = $sel.data('image');
            prueba2 = prueba.split('.').pop();
            current_image = $sel.data('image-id');
            if(prueba2=='jpg'||prueba2=='png'||prueba2=='jpeg'||prueba2=='gif'||prueba2=='bmp'){
                $('#image-gallery-caption').text($sel.data('caption'));
                $('#image-gallery-title').text($sel.data('title'));
                $('#image-gallery-image').attr('src', $sel.data('image'));
                disableButtons(counter, $sel.data('image-id'));

            }else if(prueba2=='xlsx'||prueba2=='xls'){

                $('#archivo').attr('class', 'fa fa-file-excel-o fa-4x');
                $('#image-gallery-title').text($sel.data('title'));

                $('#image-gallery-image').attr('src','');
                disableButtons(counter, $sel.data('image-id'));

            }else if(prueba2=='doc'||prueba2=='docx'){

                $('#archivo').attr('class', 'fa fa-file-word-o fa-4x');
                $('#image-gallery-title').text($sel.data('title'));

                $('#image-gallery-image').attr('src','');
                disableButtons(counter, $sel.data('image-id'));
            }else if(prueba2=='pdf'){

                $('#archivo').attr('class', 'fa fa-file-pdf-o fa-4x');
                $('#image-gallery-title').text($sel.data('title'));

                $('#image-gallery-image').attr('src','');
                disableButtons(counter, $sel.data('image-id'));
            }

        }

        if(setIDs == true){
            $('[data-image-id]').each(function(){
                counter++;
                $(this).attr('data-image-id',counter);
            });
        }
        $(setClickAttr).on('click',function(){
            updateGallery($(this));
        });
    }
});
</script>

<!--///////////////////////////////////////////////////////////////////////////////////-->

<style>
.thumb {
  height:75px;
  margin: 5px 5px 0 0;;
}
.adj{
  list-style: none;
  padding-bottom: 20px;
}
.adj li
{
  display: inline-block;
  padding-bottom: 20px;
}

.adj li img
{
  display: block;

}
</style>

