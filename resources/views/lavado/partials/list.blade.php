  <input class="form-control text-info"  name="reg_ctl_id" type="hidden" value="{{$id}}">






                           <div class=" col-md-3 col-md-offset-0">
                                <div class="form-group-danger">
                                      <input type="text" name="vehi_name" class="form-control floating-label" placeholder="Digite el Movil" required="required" style="text-transform:uppercase">

                            </div></br></br>



                                 <div class="form-group-danger">
                                        <div class="form-control-wrapper">
                                             <p>Tanqueo:</p>

                                               <div class="radio" >
                                                 <label>
                                                   <input type="radio" name="reg_tanqueo"  value="TRUE" required>
                                                    Interno
                                                 </label>
                                                 <label>
                                                <input type="radio" name="reg_tanqueo" value="FALSE" >
                                               Externo
                                              </label>
                                               </div>
                                        </div>
                                    </div><br>



                               </div>
                               </div>






        <div class="form-control-wrapper col-md-3 col-md-offset-0">
            <h4 class="text-center">Revisión Externa</h4>
            <div class="well">


                	        <?php foreach ($acciones as $accion): ?>
                	        @if($accion->acc_tipo == '1')
                	        <span class="button-checkbox">
                            <button type="button" class="btn" data-color="info">{{ $accion->acc_descripcion }}</button>
                            <input type="checkbox" class="hidden" value="{{ $accion->acc_id}}" name="acciones[]"/>
                            <input type="hidden" class="hidden" value="{{ $accion->acc_id}}" name="acciones_bd[]"/>
                            </span>
                            @endif
                             <?php endforeach ?>




            </div>

        </div>




        <div class="form-control-wrapper col-md-3 col-md-offset-0">
            <h4 class="text-center">Revisión Interna</h4>
            <div class="well">


                           <?php foreach ($acciones as $key => $accion): ?>
                            @if($accion->acc_tipo == '2')
                            <span class="button-checkbox">
                               <button type="button" class="btn" data-color="info">{{ $accion->acc_descripcion }}</button>
                               <input type="checkbox" class="hidden" value="{{ $accion->acc_id}}" name="acciones[]"/>
                               <input type="hidden" class="hidden" value="{{ $accion->acc_id}}" name="acciones_bd[]"/>
                                </span>
                               @endif
                               <?php endforeach ?>
            </div>

        </div>
          <div class="form-control-wrapper col-md-3 col-md-offset-0">
                           <div class="form-group-danger">
                            <div class="form-control-wrapper">
                                <div class="form-group">
                                      <label for="comment">Observaciones:</label>
                                      <textarea class="form-control" rows="3" id="comment" name="reg_observacion"></textarea>
                                    </div>
                            </div>
                           </div>
                  </div>

                                        <div class="form-group">
                                                <div class="col-md-3 col-md-offset-5">
                                                        <button type="submit" class=" btn btn-danger btn-sm glyphicon glyphicon-floppy-save" value="Guardar" name="Guardar">
                                                        Guardar
                                                        </button>
                                                     </div>
                                                     </div>

                                                               <div class="form-group">
                                                                   <button type="button"class="btn btn-info btn btn-xs">
                                                                     <i class="fa fa-folder-open">
                                                                          <input name="archivos[]" type="file" multiple="multiple"/>
                                                                          <!--  <input  type="submit" name="Enviar"  value="Enviar"/>-->
                                                                         <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                                         <input type="hidden" name="action" value="upload" />
                                                                      </i>
                                                                </button>
                                                        </div>


