<div class="table-responsive">

              <table class="table table-hover">
                    <thead>
                      <tr>
                            <th>ID</th>
                            <th>Consecutivo</th>
                            <th>Tipo</th>
                            <th># de Documento</th>
                            <th>Empresa</th>
                            <th>Fecha de Recibido</th>
                            <th>Fecha de Radicado</th>
                            <th>Acciones</th>

                      </tr>
                    </thead>
                       <tbody>
                        @foreach ($radicacion as $fac)


                    @if($fac->htc_dtl_id == 5)
                         <tr class="danger" data-id="{{$fac->fac_id}}">
                    @else
                        <tr data-id="{{$fac->fac_id}}">
                    @endif
                                 {{--@endif--}}
                                <td>{{$fac->fac_id}}</td>
                                <td>{{$fac->fac_consecutivo}}</td>
                                <td>{{$fac->tip_nombre}}</td>
                                <td>{{$fac->fac_num_documento}}</td>
                                <td>{{$fac->pvd_nombre}}</td>
                                <td>{{$fac->fac_creado_en}}</td>
                                <td>{{$fac->fac_fecha_rad}}</td>

                               <td align="left">
                                           <button type="button" class="btn btn-danger btn-xs fa fa-thumb-tack fa-9x " data-toggle='modal' data-target='#S{{$fac->fac_id}}'style="margin-top: initial" title="Radicar Factura"></button>
                               </td>
                         </tr>

{!!Form::model(Request::all(),['route'=>['facturacion.radicacion.store'], 'method'=> 'POST','enctype'=>'multipart/form-data'])!!}
<div class="modal fade" id="S{{$fac->fac_id}}" role="dialog" >
                                 <div class="modal-dialog modal-lg">
                                     <div class="modal-content">
                                               <div class="modal-header well-material-grey-300">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                         <h3 class="modal-title text-center">Formulario de Registro</h3>
                                                         <h3 class="modal-title text-center text-primary">{{$fac->fac_consecutivo}}</h3>
                                               </div>
                                        <div class="modal-body">

                                                     <input type="text" class="hidden" name="a" value="{{$fac->fac_id}}">
                                                      <input type="text" class="hidden" name="tip_fac" value="{{$fac->fac_tip_fac}}"></br></br>
                                                     <input type="text" class="hidden" name="con" value="{{$fac->fac_consecutivo}}"></br></br>
                                                        <div class='col-sm-4 col-sm-offset-0'>
                                                             <div class="form-group-danger">
                                                                <div class="form-control-wrapper">
                                                                        <input class="form-control text-primary"  disabled name="compania" type="text" value="{{$fac->comp_nombre}}">
                                                                        <div class="floating-label">Dirigido a:</div>
                                                                        <span class="material-input"></span>
                                                                </div>
                                                             </div></br></br>
                                                             <div class="form-group-danger">
                                                                <div class="form-control-wrapper">
                                                                        <input class="form-control"  name="asunto" type="text" value="" required >
                                                                        <div class="floating-label">Asunto:</div>
                                                                        <span class="material-input"></span>
                                                                </div>
                                                             </div></br></br>

                                                         <div class="form-group-danger">
                                                                  <div class="form-control-wrapper">
                                                                      <select name="provee" class="form-control" required="required">

                                                                              <option  class="text-danger"  value="{{$fac->fac_pvd_an8}}">{{$fac->pvd_nombre}}</option>
                                                                               @foreach ($proveedores as $pvs)
                                                                                 <option value="{{ $pvs->pvd_an8 }}">{{ $pvs->pvd_nombre }}</option>
                                                                               @endforeach
                                                                          </select>

                                                               </div>
                                                           </div>

                                                         </div>

                                                  <div class='col-sm-4'>
                                                          <div class="form-group-danger">
                                                                  <div class="form-control-wrapper">
                                                                          <input class="form-control text-primary"  disabled name="t_doc" type="text" value="{{$fac->tip_nombre}}" required >
                                                                          <div class="floating-label">Tipo de Documento:</div>
                                                                          <span class="material-input"></span>
                                                                  </div>
                                                               </div></br></br>

                                                               <div class="form-group-danger">
                                                                         <div class="form-control-wrapper">
                                                                             <select name="monedas" class="form-control" required="required" >
                                                                                      <option class="text-danger"  value="" disabled selected>Tipo de Moneda</option>
                                                                                      @foreach ($monedas as $mones)
                                                                                        <option value="{{ $mones->tip_id }}">{{ $mones->tip_descripcion }}</option>
                                                                                    @endforeach
                                                                                 </select>
                                                                      
                                                                      </div>
                                                                  </div></br></br>

                                                                 <div class="form-group-danger">
                                                                        <div class="form-control-wrapper">
                                                                                <input class="form-control text-danger"  name="num_doc" type="text" onkeypress="return justNumbers(event);" value="{{$fac->fac_num_documento}}" required="required">
                                                                                <div class="floating-label">Numero de Documento:</div>
                                                                                <span class="material-input"></span>
                                                                        </div>
                                                                     </div>

                                                   </div>
                                                     <div class='col-sm-4'>
                                                         <div class="form-group-danger">
                                                                  <div class="form-control-wrapper">
                                                                          <input class="form-control text-primary"  disabled name="asunto" type="text" value="{{$fac->fac_fecha_rad}}" required >
                                                                          <div class="floating-label">Fecha de Radicado:</div>
                                                                          <span class="material-input"></span>
                                                                  </div>
                                                               </div></br></br>

                                                                <div class="form-group-danger">
                                                                   <div class="form-control-wrapper">
                                                                           <input class="form-control"  name="valor_fac" type="text" onkeypress="return justNumbers(event);" value="" required >
                                                                           <div class="floating-label">Valor de la Factura:</div>
                                                                           <span class="material-input"></span>
                                                                   </div>
                                                                </div>

                                                                  <div class="form-group">
                                                                    <h5 class="text-danger">Adjuntar:</h5>
                                                                              <button type="button"class="btn btn-danger btn btn-xs">


                                                                                     <input name="archivos[]" type="file" required="required"/>

                                                                                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                                                    <input type="hidden" name="action" value="upload" />

                                                                           </button>
                                                                   </div>

                                                  </div>


                                        </div>

                                            <div class="modal-footer">
                                            <div class="col-sm-7 col-sm-offset-0"></br></br>
                                                  <button type="submit" class="btn btn"><span class="text-primary fa fa-check-square-o fa-3x" title="Radicar"></span></button>
                                                  <button type="button" class="btn btn" data-dismiss="modal"><span class="text-danger fa fa-times fa-3x" title="Cancelar"></span></button>
                                         </div>
                                        </div>
                                     </div>
                                 </div>
                             </div>

{!!Form::close()!!}

                       @endforeach
                             </tbody>
                       </table>




<script>
function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;

        if ((keynum == 8) || (keynum == 12))
        return true;

        return /\d/.test(String.fromCharCode(keynum));
        }
</script>
</div>