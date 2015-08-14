<table class="table table-hover" style="height: 15px;width: 500px" align="center" >
                    <thead class="center">
                      <tr>
                            <th class="info"></th>
                            <th><h4 class="text-center" style="margin-top: 3px;margin-bottom:3px ">Documento Equivalente ya generado</h4></th>
                    </tr>
                    </thead>
                    </table>
    <div class="table-responsive">
 					 <table class="table table-hover">
 					     <thead>
                       <tr >

                            <th>ID</th>
                            <th>Consecutivo<br></th>
                            <th>Tipo<br></th>
                            <th>Empresa<br></th>
                            <th>Asunto</th>
                            <th>Fecha Recibido<br></th>
                            <th>Fecha Radicado</th>
                            <th>Adjunto</th>
                            <th>Acciones</th>

                       </tr>
                       </thead>

                   <tbody>
                    @foreach($cuenta2 as $cont)
                    @if($cont->htc_dtl_id == 7 and $cont->htc_bandera == 't')
                       <tr class="info" data-id="{{$cont->fac_id}}">
                    @else
                       <tr data-id="{{$cont->fac_id}}">
                    @endif
                   		<td>{{$cont->fac_id}}</td>
                   		<td>{{$cont->fac_consecutivo}}</td>
                    	<td>{{$cont->tip_nombre}}</td>
                    	<td>{{$cont->pvd_nombre}}</td>
                    	<td>{{$cont->fac_asunto }}</td>
                    	<td>{{$cont->fac_modificado_en }}</td>
                    	<td>{{$cont->fac_fecha_rad}}</td>

                         <td align="center"> <a  target="_blank" href="/facturas_adj/{{$cont->fac_consecutivo}}/{{$cont->arc_fac_nombre}}">
                            <i class="fa fa-paperclip fa-9x text-danger " title="Ver Adjunto" style="margin-top: initial"></i></a></td>
                         <td><button type="button" class='btn  btn-xs' data-toggle='modal' data-target='#{{$cont->fac_id}}' style="margin-top: initial;padding: 0px"><span class='text-danger fa fa-list-alt fa-2x'></span></button></td>

                  </tr>

{!! Form::model(Request::all(),['route' => 'contabilidad.generadordoc.update', 'method' => 'PUT','enctype'=>'multipart/form-data']) !!}
  			<div class='modal fade' id='{{$cont->fac_id}}' role='dialog' style='top: 120px'>
                     <div class='modal-dialog'>
                         <div class='modal-content'>
                                    <div class='modal-header well-material-grey-300'>
                                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                      <h2 class='modal-title text-center'>Generar Orden de Pago</h2>
                                       <h4 class='modal-title text-center text-primary' align ="center">{{$cont->fac_consecutivo}}</h4>
                                       <input class="hidden" type="text" name="idf" value="{{$cont->fac_id}}">
                                       <input class="hidden" type="text" name="idh" value="{{$cont->htc_id}}">
                                       <input class="hidden" type="text" name="he" value="{{$cont->htc_dtl_id}}">
                                    </div><br>

                         <div class='modal-body'>
                                <div class='col-sm-4 col-sm-offset-1'>
                                     <div class="form-group-danger">
                                           <div class="form-control-wrapper">
                                               <select name="tipo_orden" class="form-control" required="required">
                                                       <option  class="text-danger"  value="">Sel. Tipo</option>
                                                          @foreach ($tipo as $tip)
                                                        <option value="{{ $tip->tip_id }}">{{ $tip->tip_nombre }}</option>
                                                        @endforeach
                                                   </select>

                                        </div>
                                    </div>

                                </div>

                           <div class='col-sm-6'>

                                 <div class="form-group-danger">
                                    <div class="form-control-wrapper">
                                            <input class="form-control"  name="cons_op" type="text" min="8" max="8" maxlength="8" required >
                                            <div class="floating-label">Consecutivo Orden de Pago:</div>
                                            <span class="material-input"></span>
                                    </div>
                       		      </div>
                           </div></br></br>

                            <div class='col-sm-6 col-sm-offset-3'>

                                    <div class="form-group-danger">
                                        <button type="button"class="btn btn-danger btn btn-sm">
                                        <input name="archivos[]" type="file" multiple="multiple" required="required"/>
                                        <input type="hidden" name="action" value="upload"/>
                                        </button>
                                    </div>
                            </div>

                       <div class='modal-footer'>
                          <div class='col-sm-8 col-sm-offset-0'>
                          <button type='submit' class='btn btn'><span class='text-primary fa fa-check-square-o fa-3x'></span></button>
                          <button type='button' class='btn btn' data-dismiss='modal'><span class='text-danger fa fa-times fa-3x'></span></button>
                      	  </div>
                      </div>

                    </div>
                </div>
            </div>
        </div>

{!!Form::close()!!}
             @endforeach
             </tbody>
                 </table>
</div>
