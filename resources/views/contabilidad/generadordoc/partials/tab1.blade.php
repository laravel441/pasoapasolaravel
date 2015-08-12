

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
                    @foreach($cuenta_cobro as $cont)
                    <tr>
                   		<td>{{$cont->fac_id}}</td>
                   		<td>{{$cont->fac_consecutivo}}</td>
                    	<td>{{$cont->tip_nombre}}</td>
                    	<td>{{$cont->pvd_nombre}}</td>
                    	<td>{{$cont->fac_asunto }}</td>
                    	<td>{{$cont->fac_modificado_en }}</td>
                    	<td>{{$cont->fac_fecha_rad}}</td>

                         <td align="center"> <a  target="_blank" href="/facturas_adj/{{$cont->fac_consecutivo}}/{{$cont->arc_fac_nombre}}">
                            <i class="fa fa-paperclip fa-9x text-danger " title="Ver Adjunto" style="margin-top: initial"></i></a></td>
                         <td><button type="button" class='btn  btn-xs' data-toggle='modal' data-target='#{{$cont->fac_consecutivo}}' style="margin-top: initial"><span class='text-danger fa fa-list-alt fa-2x'></span></button></td>

                  </tr>
{!! Form::model(Request::all(),['route' => 'contabilidad.generadordoc.store', 'method' => 'POST'])!!}

	<div class='modal fade' id='{{$cont->fac_consecutivo}}' role='dialog' style='top: 120px'>
              <div class='modal-dialog'>
                    <div class='modal-content'>
                                  <div class='modal-header well-material-grey-300'>
                                       <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                       <h2 class='modal-title text-center' align ="center">Documento Equivalente(PDF)</h2>
                                       <h4 class='modal-title text-center text-primary' align ="center">{{$cont->fac_consecutivo}}</h4>
                                       <input class="hidden" type="text" name="id" value="{{$cont->fac_id}}">

                                  </div><br>

                                  <div class='modal-body'>
                                             <div class='col-sm-5 col-sm-offset-1'>
                                               <div class="form-group-danger">
                                                    <div class="floating-label">Valor Factura:</div>
                                                    @if ($cont->fac_tip_mon == 8)
                                                    <input class="form-control text-primary" name="val_factura" type="text" value="COP {{number_format($cont->fac_valor, 2) }}" disabled >
                                                    @elseif($cont->fac_tip_mon == 9)
                                                     <input class="form-control text-primary" name="val_factura" type="text" value="EUR€ {{ number_format($cont->fac_valor, 2) }}" disabled >
                                                     @elseif($cont->fac_tip_mon == 10)
                                                      <input class="form-control text-primary" name="val_factura" type="text" value="US$ {{ number_format($cont->fac_valor, 2) }}" disabled >
                                                     @endif
                                                    <span class="material-input"></span>
                                               </div>
                                             </div>

                                             <div class='col-sm-5 col-sm-offset-1'>
                                                <div class="form-group-danger">
                     	                          <div class="floating-label">Valor IVA:</div>
                                                  <input class="form-control"  name="iva" type="number" min="0" max="100" step="any"  required >
                                                  <span class="material-input"></span>
                     	                        </div>
                                             </div><br>

                                             <div class='col-sm-5 col-sm-offset-1'>
                                                 <div class="form-group-danger">
                                                     <div class="floating-label">Valor Retencion ICA:</div>
                                                     <input class="form-control"  name="ica" type="number" min="0" max="100" step="any"   required >
                                                     <span class="material-input"></span>
                                                 </div>
                                              </div><br>

                                             <div class='col-sm-5 col-sm-offset-1'>
                                                <div class="form-group-danger">
                                                     <div class="floating-label">Valor Retencion en la Fuente:</div>
                                                     <input class="form-control"  name="fuente" type="number" min="0" max="100" step="any"  required >
                                                     <span class="material-input"></span>
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

