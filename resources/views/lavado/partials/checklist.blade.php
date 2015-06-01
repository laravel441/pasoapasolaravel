div class="col-md-10">

                                        <div class="form-group-danger ">
                                        	<div class="form-control-wrapper col-md-3 col-md-offset-1">
                                        		<input class="form-control" disabled="disabled" name="usr_name" type="text" value="{{$usr_name}}">
                                        		<div class="floating-label">Usuario:</div>
                                        		<span class="material-input"></span>
                                        	</div>
                                        </div>



                                        <div class="form-group-danger ">
                                            <div class="form-control-wrapper col-md-3 col-md-offset-1">
                                                <input class="form-control" disabled="disabled" name="usr_name" type="text" value="{{$ctl->pto_nombre}}">
                                                <div class="floating-label">Terminal:</div>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>

                                        <div class="form-group-danger ">
                                            <div class="form-control-wrapper col-md-3 col-md-offset-1">
                                                <input class="form-control" disabled="disabled" name="usr_name" type="text" value=" <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?>">
                                                <div class="floating-label">Fecha de inicio:</div>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>






                                         <div class="form-group">
                                                 <div class="col-md-0 col-md-offset-5">
                                                 <button type="submit" onclick="return confirm ('Esta seguro de crear el usuario?')"class=" btn btn-danger btn-sm glyphicon glyphicon-floppy-save">
                                                 Crear Registro
                                                 </button>

                                                 </div>
                                         </div>
</div>


                        <script type="text/javascript">
                          $(document).ready(function(){
                            $('.combobox').combobox();
                          });
                        </script>