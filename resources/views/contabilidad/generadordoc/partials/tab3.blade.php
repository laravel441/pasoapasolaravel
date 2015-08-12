
  		<div class="table-responsive">
  				<table class="table table-hover table-striped table-condensed table-scrollable">
                          <thead>
                        	<tr >
                           <th><input type="checkbox" name="enviar"value="false"></th>
                           <th>ID</th>
                           <th>Consecutivo<br></th>
                           <th>Tipo<br></th>
                           <th>Empresa<br></th>
                           <th>Orden de Pago<br></th>
                           <th>Consecutivo Orden de Pago<br></th>
                           <th>Adjunto<br></th>
                           <th>Documento Equivalente<br></th>
                           <th>Envio<br></th>
                       </tr>
                       </thead>
                        <?php foreach($cuenta3 as $cont){?>
                    <tbody>
                    <tr>
                   		<td><input type="checkbox" name="enviar"value="false"></td>
                   		<td><input type="hidden" name="id_fac" value="{{$cont->fac_id}}">{{$cont->fac_id}}</td>
                   		<td><input type="hidden" name="cons" value="{{$cont->fac_consecutivo}}">{{ $cont->fac_consecutivo }}</td>
                    	<td><input type="hidden" name="tipo" value="{{$cont->tip_nombre}}">{{ $cont->tip_nombre }}</td>
                    	<td><input type="hidden" name="empresa" value="{{$cont->pvd_nombre}}">{{ $cont->pvd_nombre }}</td>
                    	<?php
                  			 if ($cont->op_op_id =="11")
									$cont->op_op_id= "PD";
							elseif($cont->op_op_id =="12")
									$cont->op_op_id= "PZ";
							if ($cont->op_op_id=="13")
									$cont->op_op_id= "PV";
						?>

                    	<td><input type="hidden" value="{{$cont->op_op_id}}" name="op_id">{{$cont->op_op_id}}</td>
                    	<td><input type="hidden" value="{{$cont->op_consecutivo}}" name="op_consecutivo">{{$cont->op_consecutivo}}</td>
                    	<td><button type="button" class='btn btn-xs' value="" title="Adjunto"><span class='text-danger fa fa-paperclip fa-2x'></span></button></td>
                    	<td><button type="button" class='btn btn-xs' value="" title="PDF Generado"><span class='text-danger fa fa-file-pdf-o fa-2x'></span></button></td>
                    	<td><button type='submit' class='btn btn' title="Enviar"><span class='text-danger fa fa-check-circle fa-2x'></span></button></td>
                   </tr>
                    </tbody>
                    <?php }?>
                    </table>
  				  </div>
