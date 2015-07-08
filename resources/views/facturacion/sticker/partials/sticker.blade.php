                                         <input type="hidden" class="text-primary" id="mas" name="consecutivomas" value="{{$x}}">
                                          <input type="hidden" class="text-primary" id="mub" name="consecutivomub" value="{{$y}}">
                                           <input type="hidden" class="text-primary" id="mai" name="consecutivomai" value="{{$z}}">




                                         <input type="hidden" class="text-primary" id="s6" name="usr_name" value="{{ Auth::user()->usr_name }}">
                                         <input type="hidden" class="text-primary" id="s7" name="fecha_radicacion" value="<?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?>">
                                         <div class="form-group-danger">
                                        <div class="col-md-2 col-md-offset-1">
                                                <select class="form-control combobox" name="num_identi" required id="s1">
                                                    <option value="" data-value="" disabled selected># de identificación</option>
                                                     <?php foreach ($proveedores as $key => $provee): ?>
                                                       <option value ="{{ $provee->pvd_nombre}}" data-value={{"$provee->pvd_an8"}}>{{ $provee->pvd_nombre }}</option>
                                                    <?php endforeach ?>
                                                </select>
                                           @if($errors -> has('usr_caducidad'))
                                                <p class="text-danger">{{$errors->first('usr_caducidad')}} </p>
                                             @endif
                                        </div>
                                        </div>

                                          <div class="form-group-danger">
                                            <div class="col-md-2 col-md-offset-0">
                                                    <select class="form-control combobox" name="tipo_doc"  id="s2" >
                                                        <option value="" disabled selected>Tipo de documento</option>
                                                         <?php foreach ($tipos_facturas as $key => $factus): ?>
                                                           <option value="{{ $factus->tip_id }}">{{ $factus->tip_nombre }}</option>
                                                         <?php endforeach ?>
                                                    </select>
                                               @if($errors -> has('usr_caducidad'))
                                                    <p class="text-danger">{{$errors->first('usr_caducidad')}} </p>
                                                 @endif
                                            </div>
                                            </div>

                                     <div class="form-group-danger">
                                        <div class="col-md-2 col-md-offset-0">
                                            <div class="form-control-wrapper">
                                                <input class="form-control"  name="num_doc" type="text" id="s3"   onkeypress="return justNumbers(event);" value="" required >
                                                <div class="floating-label">Número de documento:</div>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>
                                    </div>


                                        <div class="form-group-danger" id="dateRangeForm">
                                             <div class="col-md-2 col-md-offset-0">
                                                 <div class="form-control-wrapper">
                                                    <div class="input-group input-append date" id="dateRangePicker">
                                                        <input type="text" class="form-control" name="date_doc" id="s4" required >
                                                        <div class="floating-label">Fecha de documento:</div>
                                                        <span class="input-group-addon add-on"><span class="text-danger fa fa-calendar fa-9x"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>





                                         <div class="form-group-danger">
                                            <div class="col-md-2 col-md-offset-0">
                                                   <select class="form-control combobox" name="dirigido_a" required id="s5">
                                                           <option value="" disabled selected>Dirigido a</option>
                                                            <?php foreach ($companias as $key => $compas): ?>
                                                              <option value="{{ $compas->comp_nombre }}">{{ $compas->comp_nombre }}</option>
                                                            <?php endforeach ?>
                                                       </select>
                                               @if($errors -> has('usr_caducidad'))
                                                    <p class="text-danger">{{$errors->first('usr_caducidad')}} </p>
                                                 @endif
                                            </div>
                                        </div>



<div class="col-md-5 col-md-offset-5">
<button type="button" class='btn btn-danger' data-toggle='modal' data-target='#myModal' value="obtener el nombre" onclick="capturar()">Generar</button>
 </div>
                    <div id="resultado"></div>



<script>
$(document).ready(function() {
    $('#dateRangePicker')
        .datepicker({
            format: 'yyyy/mm/dd',
            language: 'es',
            orientation: 'top left',
             startDate: '2010/01/01',
             endDate: '2020/01/01'

        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#dateRangeForm').formValidation('revalidateField', 'date');
        });

    $('#dateRangeForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            date: {
                validators: {
                    notEmpty: {
                        message: 'La fecha es requerida'
                    },
                    date: {
                        format: 'YYYY/MM/DD',
                        min: '2010/01/01',
                       max: '2020/01/01',
                        message: 'La fecha no es valida'
                    }
                }
            }
        }
    });
});
function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;

        if ((keynum == 8) || (keynum == 12))
        return true;

        return /\d/.test(String.fromCharCode(keynum));
        }
//function justId(e)
//    {
//    var porId2=document.getElementById("s2").value;
//    if ((porId2 == 2) )
//    return true;
//        document.getElementById("s3").disabled = true;
//
//    }
//function justId(e)
//        {
//        var keynum = window.event ? window.event.keyCode : e.which;
//         var porId2=document.getElementById("s2").value;
//        if ((porId2 == 2)
//        return true;
//        document.getElementById("s3").disabled = true;
//        return /\d/.test(String.fromCharCode(keynum));
//        }


 function capturar()
                    {
                        // obtenemos e valor por el numero de elemento
                        //var porElementos=document.forms["form1"].elements[0].value;
                        // Obtenemos el valor por el id
                        //var porId0=document.getElementById("s0").value;
                         var porId1=document.getElementById("s1").value;
                         var porId2=document.getElementById("s2").value;
                         var porId3=document.getElementById("s3").value;
                         var porId4=document.getElementById("s4").value;
                         var porId5=document.getElementById("s5").value;
                         var mas=document.getElementById("mas").value;
                         var mub=document.getElementById("mub").value;
                         var mai=document.getElementById("mai").value;
                          if (porId5 == ""){
                          var porId9 = "NULL"
                          }
                         if (porId5 == "MASIVO"){
                         var porId9 = mas
                         }
                         if(porId5 == "MUBET"){
                         var porId9 = mub
                         }
                         if(porId5 == "MAI MASIVO INVERSIONES"){
                         var porId9 = mai
                         }
                         var porId6=document.getElementById("s6").value;
                         var porId7=document.getElementById("s7").value;
                        // Obtenemos el valor por el Nombre
                        //var porNombre=document.getElementsByName("nombre")[0].value;
                        // Obtenemos el valor por el tipo de tag
                        //var porTagName=document.getElementsByTagName("input")[0].value;
                        // Obtenemos el valor por el nombre de la clase
                        //var porClassName=document.getElementsByClassName("formulario")[0].value;

    document.getElementById("resultado").innerHTML= "<div class='modal fade' id='myModal' role='dialog' style='top: 300px'>\
                                                         <div class='modal-dialog'>\
                                                             <div class='modal-content'>\
                                                                       <div class='modal-header well-material-grey-300'>\
                                                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>\
                                                                                 <h2 class='modal-title text-center'>Generación Sticker (PDF)</h2>\
                                                                       </div><br>\
                                                                <div class='modal-body'>\
                                                                      <div class='col-sm-5 col-sm-offset-2'>\
                                                                               <h5 class='control-label'>Número de Radicado:</h5>\
                                                                               <h5 class='control-label'>Fecha de Radicado: </h5>\
                                                                               <h5 class='control-label'>Empresa Emisora:</h5>\
                                                                               <h5 class='control-label'>Empresa que Recibe:</h5>\
                                                                               <h5 class='control-label'>Recibido por:</h5>\
                                                                      </div>\
                                                                     <div class='col-sm-4'>\
                                                                             <input type='text' class='text-primary' disabled name='a' value='"+porId9+"'><br>\
                                                                             <input type='text' class='text-primary' disabled name='b' value='"+porId7+"'><br>\
                                                                             <input type='text' class='text-primary' disabled name='c' value='"+porId1+"'><br>\
                                                                             <input type='text' class='text-primary' disabled name='d' value='"+porId5+"'><br>\
                                                                             <input type='text' class='text-primary' disabled name='e' value='"+porId6+"'><br>\
                                                                             <input type='text' class='hidden' name='consecutivo' value='"+porId9+"'>\
                                                                      </div>\
                                                                </div>\
                                                                    <div class='modal-footer'>\
                                                                    <div class='col-sm-8 col-sm-offset-0'>\
                                                                          <button type='submit' class='btn btn'><span class='text-primary fa fa-check-square-o fa-3x'></span></button>\
                                                                          <button type='button' class='btn btn' data-dismiss='modal'><span class='text-danger fa fa-times fa-3x'></span></button>\
                                                                 </div>\
                                                                </div>\
                                                             </div>\
                                                         </div>\
                                                     </div>";

                    }
</script>
