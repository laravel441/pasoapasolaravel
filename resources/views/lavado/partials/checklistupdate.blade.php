 <input class="form-control text-info"  name="reg_ctl_id" type="hidden" value="{{$id}}">


                                       <div class="form-control-wrapper col-md-1 col-md-offset-0">
                                                  <a href="http://swcapital.com/lavado">
                                                  <i class="fa fa-arrow-circle-o-left fa-2x text-info" title="Regresar Controles"></i></a>
                                       </div>
                                        <div class="form-group-danger ">
                                        	<div class="form-control-wrapper col-md-3 col-md-offset-0">
                                        		<input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$usr_name}}">
                                        		<div class="floating-label">Usuario:</div>
                                        		<span class="material-input"></span>
                                        	</div>
                                        </div>



                                        <div class="form-group-danger">
                                            <div class="form-control-wrapper col-md-3 col-md-offset-0">
                                                <select class="form-control combobox text-info" name="pto_id" required="required">
                                                    <option value="{{$ctl->ctl_pto_id}}" >{{$pto_nombre->pto_nombre}}</option>
                                                     <?php foreach ($patios as $key => $patio): ?>
                                                       <option value="{{ $patio->pto_id }}">{{ $patio->pto_nombre }}</option>
                                                     <?php endforeach ?>
                                                </select>
                                          </div>
                                        </div>



                                        <div class="form-group-danger">
                                            <div class="form-control-wrapper col-md-3 col-md-offset-0">
                                                <select class="form-control combobox text-info" name="prove_id" required="required">
                                                    <option value="{{$ctl->ctl_pve_an8}}" >{{$pvd_nombre->pvd_nombre}}</option>
                                                     <?php foreach ($proveedores as $key => $provee): ?>
                                                       <option value="{{ $provee->pvd_an8 }}">{{ $provee->pvd_nombre }}</option>
                                                     <?php endforeach ?>
                                                </select>
                                          </div>
                                        </div>

                                        <div class="form-group-danger">
                                            <div class="form-control-wrapper col-md-2 col-md-offset-0">
                                                <input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$ctl->ctl_fecha_inicio}}">
                                                <div class="floating-label">Fecha de inicio:</div>
                                                <span class="material-input"></span>
                                            </div>
                                        </div><br><br><br>



                                 <div class="form-group">
                                                 <div class="col-md-0 col-md-offset-5">
                                                 <button type="submit" class=" btn btn-danger btn-sm glyphicon glyphicon-floppy-save">
                                                 Actualizar Control
                                                 </button>

                                                 </div>
                                         </div>






