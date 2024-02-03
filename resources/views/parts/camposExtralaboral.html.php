<?php $datos = $_POST['data']; ?>
<?php $tipo = $_POST['tipo']; ?>
<div id="carouselExampleIndicators" class="carousel slide h-100" data-bs-touch="false" data-bs-interval="false">
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
        <?php $i = $j = 1;
        foreach ($datos as $key => $items) : ?>
            <div class="carousel-item">
                <table class="w-100 bg-orange text-white">
                    <tr class="row">
                        <td class="col-md-4"><?php echo $key ?></td>
                        <td class="col-md-1 text-center">Siempre</td>
                        <td class="col-md-2 text-center">Casi siempre</td>
                        <td class="col-md-2 text-center">Algunas veces</td>
                        <td class="col-md-2 text-center">Casi nunca</td>
                        <td class="col-md-1 text-center">Nunca</td>
                        </td>
                    </tr>
                </table>
                <div style="height: 500px;" class="overflow-scroll">
                    <table style="width: 96%;margin-left: 2%;" class="table table-hover">
                        <?php foreach ($items as $item) :  ?>
                            <?php $clase = ''; ?>
                            <?php
                            if ($tipo == 1 && ($item['id'] == '106' || $item['id'] == '107' || $item['id'] == '108' || $item['id'] == '109' || $item['id'] == '110' || $item['id'] == '111' || $item['id'] == '112' || $item['id'] == '113' || $item['id'] == '114')) {
                                $clase = 'atencion';
                            } elseif ($tipo == 1 && ($item['id'] == '115' || $item['id'] == '116' || $item['id'] == '117' || $item['id'] == '118' || $item['id'] == '119' || $item['id'] == '120' || $item['id'] == '121' || $item['id'] == '122' || $item['id'] == '123')) {
                                $clase = 'jefe';
                            } elseif ($tipo == 2 && ($item['id'] == '89' || $item['id'] == '90' || $item['id'] == '91' || $item['id'] == '92' || $item['id'] == '93' || $item['id'] == '94' || $item['id'] == '95' || $item['id'] == '96' || $item['id'] == '97')) {
                                $clase = 'atencion';
                            }
                            ?>
                            <tr class="<?php echo $clase; ?> row">
                                <td class="col-md-4"><?php echo $i . '.) ' . $item['item']; ?></td>
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
                        <?php $i++;
                        endforeach; ?>
                    </table>
                </div>
                <?php if (count($datos) == $j) : ?>
                    <div class="row justify-content-center">
                        <input type="hidden" name="metodo" value="insertarCuestionario">
                        <button type="submit" class="bg-orange text-white"><b>Guardar</b></button>
                    </div>
                <?php endif; ?>
            </div>
        <?php $j++;
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