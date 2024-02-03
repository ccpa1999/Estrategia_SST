<?php foreach ($_POST['filtros'] as $key => $filtro) : ?>
    <div class="col-md-3">
        <label class="w-100" for=""><b><?php echo $key; ?></b>
            <select name="<?php echo $key ?>" id="" class="form-control w-100">
                <option value="">..Seleccionar..</option>
                <?php foreach ($filtro as $datos) : ?>
                    <option value="<?php echo $datos[$key] ?>"><?php echo $datos[$key] ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </div>
<?php endforeach; ?>
<div class="col-md-3">
    <label class="w-100" for=""><b>Fecha Inicial</b>
        <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control w-100" required>
    </label>
</div>
<div class="col-md-3">
    <label class="w-100" for=""><b>Fecha Final</b>
        <input type="date" id="fecha_final" name="fecha_final" class="form-control w-100" required>
    </label>
</div>