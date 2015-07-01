
                                         <div class="form-group-danger">
                                        <div class="col-md-2 col-md-offset-1">
                                                <select class="form-control combobox" name="prove_id" required>
                                                    <option value="" disabled selected># de identificación</option>
                                                     <?php foreach ($proveedores as $key => $provee): ?>
                                                       <option value="{{ $provee->pvd_an8 }}">{{ $provee->pvd_nombre }}</option>
                                                     <?php endforeach ?>
                                                </select>
                                           @if($errors -> has('usr_caducidad'))
                                                <p class="text-danger">{{$errors->first('usr_caducidad')}} </p>
                                             @endif
                                        </div>
                                        </div>

                                          <div class="form-group-danger">
                                            <div class="col-md-2 col-md-offset-0">
                                                    <select class="form-control combobox" name="prove_id" required>
                                                        <option value="" disabled selected>Tipo de documento</option>
                                                         <?php foreach ($proveedores as $key => $provee): ?>
                                                           <option value="{{ $provee->pvd_an8 }}">{{ $provee->pvd_nombre }}</option>
                                                         <?php endforeach ?>
                                                    </select>
                                               @if($errors -> has('usr_caducidad'))
                                                    <p class="text-danger">{{$errors->first('usr_caducidad')}} </p>
                                                 @endif
                                            </div>
                                            </div>

                                             <div class="form-group-danger">
                                        <div class="col-md-2 col-md-offset-0">
                                            <div class="form-control-wrapper">
                                                <input class="form-control"  name="usr_name" type="text">
                                                <div class="floating-label">Número de documento:</div>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>
                                        </div>


                                            <div class="form-group-danger" id="dateRangeForm">
                                             <div class="col-md-2 col-md-offset-0">
                                                 <div class="form-control-wrapper">
                                                    <div class="input-group input-append date" id="dateRangePicker">
                                                        <input type="text" class="form-control" name="date" >
                                                        <div class="floating-label">Fecha de documento:</div>
                                                        <span class="input-group-addon add-on"><span class="text-danger fa fa-calendar fa-9x"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>





                                             <div class="form-group-danger">
                                            <div class="col-md-2 col-md-offset-0">
                                                    <select class="form-control combobox" name="prove_id" required>
                                                        <option value="" disabled selected>Dirigido a</option>
                                                         <?php foreach ($proveedores as $key => $provee): ?>
                                                           <option value="{{ $provee->pvd_an8 }}">{{ $provee->pvd_nombre }}</option>
                                                         <?php endforeach ?>
                                                    </select>
                                               @if($errors -> has('usr_caducidad'))
                                                    <p class="text-danger">{{$errors->first('usr_caducidad')}} </p>
                                                 @endif
                                            </div>
                                            </div>

                                    </div>
                                      <div class="form-group">
                                             <div class="col-md-5 col-md-offset-5">
                                                <span class="text-danger fa fa-save fa-9x"></span></span>
                                                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Generar</button>

                                             </div>
                                     </div>

                @if(empty($newsticker))

                @else
 <span class="text-danger fa fa-save fa-9x"></span></span>
                <span class="text-info fa fa-calendar fa-9x"></span></span>

                @endif


                              <!-- Modal -->



                              <!-- Trigger the modal with a button -->


<script>
$(document).ready(function() {
    $('#dateRangePicker')
        .datepicker({
            format: 'dd/mm/yyyy',
            language: 'es',
            orientation: 'top left',
             startDate: '01/01/2010',
             endDate: '12/30/2020'

        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#dateRangeForm').formValidation('revalidateField', 'date');
        });

    $('#dateRangeForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            date: {
                validators: {
                    notEmpty: {
                        message: 'La fecha es requerida'
                    },
                    date: {
                        format: 'DD/MM/YYYY',
                        min: '01/01/2010',
                       max: '12/30/2020',
                        message: 'La fecha no es valida'
                    }
                }
            }
        }
    });
});
</script>
