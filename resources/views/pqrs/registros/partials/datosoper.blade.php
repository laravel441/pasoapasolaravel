
<div><h4 align="center">Datos del Operador</h4></div>
<div class="floating-label">

    <br>
    <div class="floating-label">
        <div class="col-md-5 col-md-offset-1">
            <select type="text" class="form-control combobox" name="nombre" id="nombre">
                <option value="" disabled selected>Nombre Operador:</option>
                <?php foreach ($operador as $key => $opr): ?>
                <option value="{{ $opr->emp_an8 }}">{{ $opr->nombre }}</option>
            <?php endforeach ?>
            <ajax ></ajax>
        </select>
    </div>
</div>

<div class="floating-label">
    <div class="col-md-5 col-md-offset-1">
        <select type="text" class="form-control combobox" name="emp_identificacion" id="identificacion">
            <option value="" disabled selected>N° Identificacion:</option>
            <?php foreach ($operador as $key => $opr): ?>
            <option value="{{ $opr->emp_an8 }}">{{ $opr->emp_identificacion }}</option>
        <?php endforeach ?>
    </select>
</div>
</div>
<br>
<br>
<br>
<div class="floating-label">
    <div class="col-md-5 col-md-offset-1">
        <select type="text" class="form-control combobox" name="emp_an8" id="codAN8">
            <option value="" disabled selected>Codigo An8:</option>
            <?php foreach ($operador as $key => $opr): ?>
            <option value="{{ $opr->emp_an8 }}">{{ $opr->emp_an8 }}</option>
        <?php endforeach ?>
    </select>
</div>
</div>

<div class="floating-label">
    <div class="col-md-5 col-md-offset-1">
        <select type="text" class="form-control combobox" name="emp_cod_tm" id="codTM">
            <option value="" disabled selected>Codigo TM:</option>
            <?php foreach ($operador as $key => $opr): ?>
            <option value="{{ $opr->emp_an8 }}">{{ $opr->emp_cod_tm }}</option>
        <?php endforeach ?>
    </select>
</div>
</div>
<br>
<br>
<br>
<center> <button type="button" class="btn btn-info " data-dismiss="modal">Aceptar</button></center>

</div>

<script type="text/javascript">
$( "#nombre" ).change(function() {
    var id = $(this).val();
    $("#identificacion").val(id);
    $("#codTM").val(id);
    $("#codAN8").val(id);
});

$( "#identificacion" ).change(function() {
    var id = $(this).val();
    $("#codTM").val(id);
    $("#nombre").val(id);
    $("#codAN8").val(id);
});

$( "#codAN8" ).change(function() {
    var id = $(this).val();
    $("#identificacion").val(id);
    $("#codTM").val(id);
    $("#nombre").val(id);

});

$( "#codTM" ).change(function() {
    var id = $(this).val();
    $("#identificacion").val(id);
    $("#nombre").val(id);
    $("#codAN8").val(id);
});

</script>

