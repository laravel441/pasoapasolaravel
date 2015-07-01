  <input class="form-control text-info"  name="reg_ctl_id" type="hidden" value="{{$id}}">





                               <div class="form-control-wrapper col-md-3 col-md-offset-0">
                                       <div class="form-group-danger">
                                               <select class="form-control combobox" name="vehi_id" required>
                                                   <option value="" disabled selected >Sel. Movil</option>
                                                    <?php foreach ($vehiculos as $key => $vehiculo): ?>
                                                      <option value="{{ $vehiculo->veh_id }}">{{ $vehiculo->veh_movil }}</option>
                                                    <?php endforeach ?>
                                               </select>
                                          @if($errors -> has('vehi_id'))
                                               <p class="text-danger">{{$errors->first('vehi_id')}} </p>
                                            @endif
                                       </div>


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
                                    <div class="form-group-danger">
                                          <div class="form-control-wrapper">
                                              <p>Aprobación:</p>

                                             <div class="radio" >
                                               <label>
                                                 <input type="radio" name="reg_aprobacion"  value="TRUE" required>
                                                  Si
                                               </label>
                                               <label>
                                              <input type="radio" name="reg_aprobacion" value="FALSE" >
                                                  No
                                            </label>
                                             </div>
                                          </div>
                                      </div><br>


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
                                      <textarea class="form-control" rows="5" id="comment" name="reg_observacion"></textarea>
                                    </div>
                            </div>
                           </div>
                  </div>
                                    <form action="{{route('lavado.update')}}" name="action" method="post" enctype="multipart/form-data">
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

                                                       </form>
