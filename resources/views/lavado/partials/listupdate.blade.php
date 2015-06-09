





                               <div class="form-control-wrapper col-md-3 col-md-offset-0">
                                     <div class="form-group-danger">
                                            <select class="form-control combobox" name="pto_id" required="required">
                                                <option value="{{$reg->reg_veh_id}}" >{{$veh_nombre->veh_movil}}</option>
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
                                               @if ($reg->reg_tanqueo == '1')
                                               <div class="radio" >
                                                <label>
                                                   <input type="radio" name="reg_tanqueo"  value="TRUE" checked>
                                                    Interno
                                                 </label>
                                                 <label>
                                                <input type="radio" name="reg_tanqueo" value="FALSE" >
                                               Externo
                                              </label>
                                               </div>
                                               @else
                                               <div class="radio" >
                                                   <label>
                                                      <input type="radio" name="reg_tanqueo"  value="TRUE" >
                                                       Interno
                                                    </label>
                                                    <label>
                                                   <input type="radio" name="reg_tanqueo" value="FALSE" checked>
                                                  Externo
                                                 </label>
                                                  </div>

                                               @endif
                                        </div>
                                    </div><br>

                                    <div class="form-group-danger">
                                          <div class="form-control-wrapper">
                                              <p>Aprobación:</p>
                                            @if($reg->reg_aprobacion == '1')
                                             <div class="radio" >
                                               <label>
                                                 <input type="radio" name="reg_aprobacion"  value="TRUE" checked>
                                                  Si
                                               </label>
                                               <label>
                                                 <input type="radio" name="reg_aprobacion" value="FALSE" >
                                                  No
                                            </label>
                                             </div>
                                                 @else
                                               <div class="radio" >
                                                     <label>
                                                       <input type="radio" name="reg_aprobacion"  value="TRUE" >
                                                        Si
                                                     </label>
                                                     <label>
                                                       <input type="radio" name="reg_aprobacion" value="FALSE" checked>
                                                        No
                                                  </label>
                                                   </div>
                                             @endif

                                          </div>
                                      </div><br>


                               </div>






        <div class="form-control-wrapper col-md-3 col-md-offset-0">
            <h4 class="text-center">Revisión Externa</h4>
            <div class="well">


             @foreach ($reg_list as $reg_lis)
                        @if($reg_lis->acc_tipo == '1')
                               @if($reg_lis->det_acc_estado == '1')
                                          <span class="button-checkbox">
                                           <button type="button" class="btn btn-sm btn-block" data-color="info">{{ $reg_lis->acc_descripcion }}</button>
                                           <input type="checkbox" class="hidden btn-sm btn-block " value="{{ $reg_lis->acc_id}}" name="acciones[]" checked/>
                                           <input type="hidden" class="hidden" value="{{ $reg_lis->acc_id}}" name="acciones_bd[]"/>
                                           </span>
                                    @else
                                     <span class="button-checkbox">
                                           <button type="button" class="btn" data-color="info">{{ $reg_lis->acc_descripcion }}</button>
                                           <input type="checkbox" class="hidden" value="{{ $reg_lis->acc_id}}" name="acciones[]" />
                                           <input type="hidden" class="hidden" value="{{ $reg_lis->acc_id}}" name="acciones_bd[]"/>
                                           </span>
                                     @endif
                        @else

                        @endif



                        @endforeach










            </div>

        </div>




        <div class="form-control-wrapper col-md-3 col-md-offset-0">
            <h4 class="text-center">Revisión Interna</h4>
            <div class="well">


                                  @foreach ($reg_list as $reg_lis)
                                      @if($reg_lis->acc_tipo == '2')
                                             @if($reg_lis->det_acc_estado == '2')
                                                    <span class="button-checkbox">
                                                     <button type="button" class="btn btn-sm btn-block" data-color="info">{{ $reg_lis->acc_descripcion }}</button>
                                                     <input type="checkbox" class="hidden btn-sm btn-block " value="{{ $reg_lis->acc_id}}" name="acciones[]" checked/>
                                                     <input type="hidden" class="hidden" value="{{ $reg_lis->acc_id}}" name="acciones_bd[]"/>
                                                     </span>
                                                  @else
                                                   <span class="button-checkbox">
                                                     <button type="button" class="btn" data-color="info">{{ $reg_lis->acc_descripcion }}</button>
                                                     <input type="checkbox" class="hidden" value="{{ $reg_lis->acc_id}}" name="acciones[]" />
                                                     <input type="hidden" class="hidden" value="{{ $reg_lis->acc_id}}" name="acciones_bd[]"/>
                                                     </span>
                                                   @endif
                                                  @else

                                                  @endif



                                                  @endforeach


            </div>

        </div>
          <div class="form-control-wrapper col-md-3 col-md-offset-0">
                           <div class="form-group-danger">
                            <div class="form-control-wrapper">

                                      <label  for="comment">Observaciones:</label>
                                      <textarea class="form-control " rows="8" id="comment" name="reg_observacion" value="{{$reg->reg_observacion}}">{{$reg->reg_observacion}}</textarea>

                            </div>
                           </div>
                  </div>





                 <div class="form-group">
                                                <div class="col-md-3 col-md-offset-5">
                                                <button type="submit" class=" btn btn-danger btn-sm glyphicon glyphicon-floppy-save">
                                                Guardar
                                                </button>

                                                </div>
                                        </div>




