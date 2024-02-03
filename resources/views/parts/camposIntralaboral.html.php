<?php $datos = $_POST['data']; ?>
<?php $tipo = $_POST['tipo']; ?>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="p-4 d-block w-100 text-center"><br><br><br>
                <div class="row">
                    <div class="col-md-12">
                        <h1>
                            BIENVENIDO AL CUESTIONARIO<br><br>
                        </h1>
                    </div>
                </div><br><br><br><br>
            </div>
        </div>
        <?php $count = 0; ?>
        <?php $i = 1;
        foreach ($datos as $key => $items) : ?>
            <div class="carousel-item">
                <table class="w-100 bg-orange text-white">
                    <tr class="row">
                        <td class="col-md-4"><?php echo $key; ?></td>
                        <td class="col-md-1 text-center">Siempre</td>
                        <td class="col-md-2 text-center">Casi siempre</td>
                        <td class="col-md-2 text-center">Algunas veces</td>
                        <td class="col-md-2 text-center">Casi nunca</td>
                        <td class="col-md-1 text-center">Nunca</td>
                    </tr>
                </table>
                <div style="height: 500px;" class="overflow-scroll">
                    <?php if ($tipo == 1 && $key == 'Las siguientes preguntas están relacionadas con la atención a clientes y usuarios.') : ?>
                        <tr class="bg-secondary text-white">
                            <td>En mi trabajo debo brindar servicio a clientes o usuarios:</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control w-100" id="atencion_cliente">
                                            <option <?php echo ($_COOKIE['atencion'] == 0) ? 'selected' : ''; ?> value="NO">NO</option>
                                            <option <?php echo ($_COOKIE['atencion'] == 1) ? 'selected' : ''; ?> value="SI">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <a class="text-decoration-none text-white" title="Si su respuesta fue SI por favor responda las siguientes preguntas. Si su respuesta fue NO pase a las preguntas de la página siguiente" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php elseif ($tipo == 2 && $key == 'Las siguientes preguntas están relacionadas con la atención a clientes y usuarios.') : ?>
                        <tr class="bg-secondary text-white">
                            <td>En mi trabajo debo brindar servicio a clientes o usuarios:</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control w-100" id="atencion_cliente">
                                            <option <?php echo ($_COOKIE['atencion'] == 0) ? 'selected' : ''; ?> value="NO">NO</option>
                                            <option <?php echo ($_COOKIE['atencion'] == 1) ? 'selected' : ''; ?> value="SI">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <a class="text-decoration-none text-white" title="Si su respuesta fue SI por favor responda las siguientes preguntas. Si su respuesta fue NO pase a las preguntas de la página siguiente" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php elseif ($tipo == 1 && $key == 'Las siguientes preguntas están relacionadas con las personas que usted supervisa o dirige.') : ?>
                        <tr class="bg-secondary text-white">
                            <td>Soy jefe de otras personas en mi trabajo:</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control w-100" id="jefe">
                                            <option <?php echo ($_COOKIE['jefe'] == 0) ? 'selected' : ''; ?> value="NO">NO</option>
                                            <option <?php echo ($_COOKIE['jefe'] == 1) ? 'selected' : ''; ?> value="SI">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <a class="text-decoration-none text-white" title="Si su respuesta fue SI por favor responda las siguientes preguntas. Si su respuesta fue NO pase a las preguntas de la siguiente sección: FICHA DE DATOS GENERALES." href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <table style="width: 96%;margin-left: 2%;" class="table table-hover">
                        <?php foreach ($items as $item) :  ?>
                            <?php $clase = ''; ?>
                            <?php $count++; ?>
                            <?php
                            if ($tipo == 1 && ($item['id'] == '106' || $item['id'] == '107' || $item['id'] == '108' || $item['id'] == '109' || $item['id'] == '110' || $item['id'] == '111' || $item['id'] == '112' || $item['id'] == '113' || $item['id'] == '114')) {
                                $clase = 'atencion';
                            } elseif ($tipo == 1 && ($item['id'] == '115' || $item['id'] == '116' || $item['id'] == '117' || $item['id'] == '118' || $item['id'] == '119' || $item['id'] == '120' || $item['id'] == '121' || $item['id'] == '122' || $item['id'] == '123')) {
                                $clase = 'jefe';
                            } elseif ($tipo == 2 && ($item['id'] == '212' || $item['id'] == '213' || $item['id'] == '214' || $item['id'] == '215' || $item['id'] == '216' || $item['id'] == '217' || $item['id'] == '218' || $item['id'] == '219' || $item['id'] == '220')) {
                                $clase = 'atencion';
                            }
                            ?>
                            <tr class="<?php echo $clase; ?> row">
                                <td class="col-md-4"><?php echo $count . '.) ' . $item['item']; ?></td>
                                <?php if ($item['rango'] == '0-4') : ?>
                                    <td class="col-md-1 d-flex justify-content-center"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="0"></td>
                                    <td class="col-md-2 d-flex justify-content-center"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="1"></td>
                                    <td class="col-md-2 d-flex justify-content-center"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="2"></td>
                                    <td class="col-md-2 d-flex justify-content-center"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="3"></td>
                                    <td class="col-md-1 d-flex justify-content-center"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="4"></td>
                                <?php else : ?>
                                    <td class="col-md-1 d-flex justify-content-center"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="4"></td>
                                    <td class="col-md-2 d-flex justify-content-center"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="3"></td>
                                    <td class="col-md-2 d-flex justify-content-center"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="2"></td>
                                    <td class="col-md-2 d-flex justify-content-center"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="1"></td>
                                    <td class="col-md-1 d-flex justify-content-center"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="0"></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php if (count($datos) == $i) : ?>
                    <div class="row justify-content-center">
                        <input type="hidden" name="metodo" value="insertarCuestionario">
                        <button type="submit" class="bg-orange text-white"><b>Guardar</b></button>
                    </div>
                <?php endif; ?>
            </div>
        <?php $i++;
        endforeach; ?>
    </div>
    <button class="carousel-control-next bg-orange position-fixed m-1" style="width: 40px;" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    <button class="carousel-control-prev bg-orange position-fixed m-1" style="width: 40px;" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
</div>