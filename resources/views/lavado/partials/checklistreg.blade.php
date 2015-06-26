
                                <input class="form-control text-info"  name="ctl_id" type="hidden" value="{{$id}}">
                                         <div class="form-control-wrapper col-md-1 col-md-offset-0">
                                                      <a href="http://swcapital.com/lavado">
                                                      <i class="fa fa-arrow-circle-o-left fa-2x text-info" title="Regresar Controles"></i></a>
                                           </div>

                                        <div class="form-group-danger ">
                                        	<div class="form-control-wrapper col-md-2 col-md-offset-0">
                                        		<input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$usr_name}}">
                                        		<div class="floating-label">Usuario:</div>
                                        		<span class="material-input"></span>
                                        	</div>
                                        </div>




                                        <div class="form-group-danger ">
                                            <div class="form-control-wrapper col-md-2 col-md-offset-0">
                                                <input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$ptoctl->pto_nombre}}">
                                                <div class="floating-label">Terminal:</div>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>

                                        <div class="form-group-danger ">
                                                <div class="form-control-wrapper col-md-2 col-md-offset-0">
                                                    <input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$pvectl->pvd_nombre}}">
                                                    <div class="floating-label">Proveedor:</div>
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>

                                        <div class="form-group-danger">
                                            <div class="form-control-wrapper col-md-2 col-md-offset-0">
                                                <input class="form-control text-info" disabled="disabled" name="usr_name" type="text" value="{{$ctls->ctl_fecha_inicio}}">
                                                <div class="floating-label">Fecha de inicio:</div>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>










@include('lavado.partials.tablereg')


