

	<div class="table-responsive">
 					 <table class="table table-hover">
 					     <thead>
                       <tr >

                        	<th>ID</th>
                            <th>Consecutivo<br></th>
                            <th>Tipo<br></th>
                            <th>Empresa<br></th>
                            <th>Asunto<br></th>
                             <th>Fecha Recibido<br></th>
                             <th>Fecha Radicado<br></th>
                             <th>Acciones<br></th>
                       </tr>
                       </thead>
                   <?php foreach($cuenta2 as $cont){?>
                   <tbody>
                    <tr>
                  		<td><input type="hidden" value="{{$cont->fac_id}}" name="fac_id">{{$cont->fac_id}}</td>
                  		<td><input type="hidden" value="{{$cont->fac_consecutivo}}" name="consecutivo">{{$cont->fac_consecutivo}}</td>
                    	<td><input type="hidden" value="{{$cont->tip_nombre }}" name="tipo">{{$cont->tip_nombre }}</td>
                    	<td><input type="hidden" value="{{$cont->pvd_nombre }}" name="empresa">{{$cont->pvd_nombre }}</td>
                    	<td><input type="hidden" value="{{$cont->fac_asunto }}" name="asunto">{{$cont->fac_asunto }}</td>
                    	<td><input type="hidden" value="{{$cont->htc_modificado_en}}" name="modificado">{{$cont->htc_modificado_en}}</td>
                    	<td><input type="hidden" value="{{$cont->fac_fecha_rad}}" name="fecha_rad">{{$cont->fac_fecha_rad}}</td>
                    	<td><button type="button" class='btn  btn-xs' data-toggle='modal' data-target='#ordenpago' value="Orden de Pago" onclick="diligenciar()" title="Orden de Pago"><span class='text-danger fa fa-list-ul fa-2x'></span></button></td>
                   	</tr>
                   </tbody>
                   <?php }?>
                    </table>

  			<div class='modal fade' id='ordenpago' role='dialog' style='top: 150px'>
                     <div class='modal-dialog'>
                         <div class='modal-content'>
                            <div class='modal-header well-material-grey-300'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h2 class='modal-title text-center'>Generar Orden de Pago
                              <input class="form-control" disabled name="usr_name" value="{{ Auth::user()->usr_name }}" align="center">
                			  <input class="form-control" name="fecha_radicacion" disabled value="<?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?>" align="center"></h2>
                         	</div><br>

                     <div class='modal-body'>
                     <div class='col-sm-5 col-sm-offset-3'>
                     <div class="form-group-danger">

                         <select class="form-control combobox" name="tipo_orden">
                         <option value="" disabled selected>Sel. Tipo</option>
                         <?php foreach ($tipo as $tip){ ?>
                         <option value="{{ $tip->tip_nombre }}">{{ $tip->tip_nombre }}</option>
                         <?php } ?>
                         </select>
                     </div>

                        <div class="form-group-danger">
                       		 <div class="floating-label">Consecutivo Orden de Pago:</div>
                             <input class="form-control"  name="Cons_OP" type="text" id="o2" value="" required >
                             <span class="material-input"></span>
                        </div>

                        <div class="form-group-danger">
                            <button type="button"class="btn btn-danger btn btn-xs">
                            <input name="archivos[]" type="file" multiple="multiple"/>
                            <input type="hidden" name="action" value="upload"/>
                            </button>
                        </div>

                         <?php foreach($cuenta2 as $cont){?>
                      <input type="hidden" value="{{$cont->fac_id}}" name="fac_id">
                      <input type="hidden" value="{{$cont->fac_consecutivo}}" name="consecutivo">
                      <input type="hidden" value="{{$cont->tip_nombre }}" name="tipo">
                      <input type="hidden" value="{{$cont->pvd_nombre }}" name="empresa">
                      <?php }?>

                          </div>

                       <div class='modal-footer'>
                          <div class='col-sm-8 col-sm-offset-0'>
                          <button type='submit' class='btn btn'><span class='text-primary fa fa-check-square-o fa-2x'></span></button>
                          <button type='button' class='btn btn' data-dismiss='modal'><span class='text-danger fa fa-times fa-2x'></span></button>
                      	  </div>
                      </div>

                    </div>
                </div>
            </div>
        </div><br>
    </div>
