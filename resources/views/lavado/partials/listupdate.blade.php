





                        <input class="form-control text-info"  name="vehi_id_original" type="hidden" value="{{$reg->reg_veh_id}}">



                           <div class=" col-md-3 col-md-offset-0">
                                <div class="form-group-danger">
                                      <input type="text" name="vehi_name" class="form-control floating-label text-info" placeholder="Digite el Movil" required="required" style="text-transform: uppercase" value="{{$veh_nombre->veh_movil}}" >

                            </div></br></br>







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


                                    <div class="form-control-wrapper col-md-3 col-md-offset-0">
                                             <div class="form-group-danger">

                                                    @foreach($adjunto as $adj)
                                                          @if($reg->reg_id==$adj->adj_reg_id)


                                                          <i class="fa fa-picture-o text-info" name="Archivos Adjuntos" value ="{{$adj->adj_nombre}}"></i> {{$adj->adj_nombre}}<br/>


                                                          @endif
                                                          @endforeach


                                              </div>
                                    </div>

                <div class="form-group">
                                                <div class="col-md-3 col-md-offset-5">
                                                <button type="submit" class=" btn btn-danger btn-sm glyphicon glyphicon-floppy-save">
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



