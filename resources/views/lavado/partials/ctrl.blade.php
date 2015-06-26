
                                        <div class="form-group-danger">
                                        	<div class="form-control-wrapper">
                                        		<input class="form-control" disabled="disabled" name="usr_name" type="text" value="{{$usr_name}}">
                                        		<div class="floating-label">Usuario:</div>
                                        		<span class="material-input"></span>
                                        	</div>
                                        </div>


                                         <div class="form-group-danger">

                                                <select class="form-control combobox" name="pto_id">
                                                    <option value="" disabled selected>Sel. Terminal</option>
                                                     <?php foreach ($patios as $key => $patio): ?>
                                                       <option value="{{ $patio->pto_id }}">{{ $patio->pto_nombre }}</option>
                                                     <?php endforeach ?>
                                                </select>
                                           @if($errors -> has('usr_caducidad'))
                                                <p class="text-danger">{{$errors->first('usr_caducidad')}} </p>
                                             @endif
                                        </div>


                                        <div class="form-group-danger">

                                                <select class="form-control combobox" name="prove_id">
                                                    <option value="" disabled selected>Sel. Proveedor</option>
                                                     <?php foreach ($proveedores as $key => $provee): ?>
                                                       <option value="{{ $provee->pvd_an8 }}">{{ $provee->pvd_nombre }}</option>
                                                     <?php endforeach ?>
                                                </select>
                                           @if($errors -> has('usr_caducidad'))
                                                <p class="text-danger">{{$errors->first('usr_caducidad')}} </p>
                                             @endif
                                        </div>



                                         <div class="form-group">
                                                 <div class="col-md-0 col-md-offset-0">
                                                 <button type="submit" class=" btn btn-danger btn-sm glyphicon glyphicon-floppy-save">
                                                 Crear Control
                                                 </button>

                                                 </div>
                                         </div>

