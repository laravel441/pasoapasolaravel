@extends('......layouts.sidebar')

@section('content')

	<div class="row">
		  <div class="col-md-12 col-md-offset-0">
			<div class="panel panel-default">
				 <div class="panel-heading"><h2 align="center">Generación de Sticker
                         </h2><h6 align="center"> {{ Auth::user()->usr_name }}
                           <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?></h6>
                    </div>

				<div class="panel-body">
				ascript - Obtener el valor de un input type=text de varias maneras</title>




                    <h1>Obtener el valor de un input type=text de varias maneras</h1>

                        Nombre:<br><input type="text" name="nombre" value="" id="nombre" class="formulario"><br>
                            Apellido:<br><input type="text" name="nombre" value="" id="nombre2" class="formulario"><br>
                           Fecha:<br><input type="text" name="nombre" value="" id="nombre3" class="formulario"><br>
                            Compañia:<br><input type="date" name="nombre" value="" id="nombre4" class="formulario"><br>




                    <button type="button" class='btn btn-danger' data-toggle='modal' data-target='#myModal' value="obtener el nombre" onclick="capturar()">Generar</button>

                    <div id="resultado"></div>





				</div>

			</div>
		</div>
	</div>
</div>

@endsection
<script>
                    function capturar()
                    {
                        // obtenemos e valor por el numero de elemento
                       // var porElementos=document.forms["form1"].elements[0].value;
                        // Obtenemos el valor por el id
                        var porId=document.getElementById("nombre").value;
                         var porId2=document.getElementById("nombre2").value;
                         var porId3=document.getElementById("nombre3").value;
                         var porId4=document.getElementById("nombre4").value;
                        // Obtenemos el valor por el Nombre
                        //var porNombre=document.getElementsByName("nombre")[0].value;
                        // Obtenemos el valor por el tipo de tag
                        //var porTagName=document.getElementsByTagName("input")[0].value;
                        // Obtenemos el valor por el nombre de la clase
                        //var porClassName=document.getElementsByClassName("formulario")[0].value;

                document.getElementById("resultado").innerHTML= "<div class='form-group'> \
                              <div class='col-md-5 col-md-offset-5'>\
                              <div class='modal fade' id='myModal' role='dialog'>\
                         <div class='modal-dialog'>\
                         <div class='modal-content'>\
                                         <div class='modal-header'>\
                                             <button type='button' class='close' data-dismiss='modal'>&times;</button>\
                                               <h3 class='modal-title'>Generación Sticker (PDF)</h3>\
                                          </div>\
                              <div class='modal-body'>\
                             <input type='text' disabled name='nombre' value='"+porId+"'><br>\
                             <input type='text' name='nombre' value='"+porId2+"'><br>\
                             <input type='text' name='nombre' value='"+porId3+"'><br>\
                             <input type='text' name='nombre' value='"+porId4+"'><br>\
                                                                                 </div>\
                             <div class='modal-footer'>\
                                 <button type='submit' class='btn btn'><span class='text-danger fa fa-file-pdf-o fa-9x'></span></button>\
                                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>\
                              </div>\
                           </div>\
                            </div>\
                       </div>\
                     </div>\
             </div>\
                ";




                    }
                    </script>


