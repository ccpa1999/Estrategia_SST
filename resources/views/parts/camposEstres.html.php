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
        <div class="carousel-item">
            <table class="w-100 bg-orange text-white">
                <tr class="row">
                    <td class="col-md-3 p-2"></td>
                    <td class="col-md-2 text-center">Siempre</td>
                    <td class="col-md-3 text-center">Casi siempre</td>
                    <td class="col-md-3 text-center">A veces</td>
                    <td class="col-md-1 text-center">Nunca</td>
                </tr>
            </table>
            <div style="height: 500px;" class="overflow-scroll">
                <table style="width: 96%;margin-left: 2%;" class="table table-hover">
                    <tbody>
                        <?php foreach ($datos as $key => $item) :  ?>
                            <tr class="row">
                                <td class="col-md-3"><?php echo $item['item']; ?></td>
                                <?php if ($item['rango'] == '9-0') : ?>
                                    <td class="col-md-2 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="9"></td>
                                    <td class="col-md-3 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="6"></td>
                                    <td class="col-md-3 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="3"></td>
                                    <td class="col-md-1 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="0"></td>
                                <?php elseif ($item['rango'] == '6-0') : ?>
                                    <td class="col-md-2 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="6"></td>
                                    <td class="col-md-3 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="4"></td>
                                    <td class="col-md-3 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="2"></td>
                                    <td class="col-md-1 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="0"></td>
                                <?php elseif ($item['rango'] == '3-0') : ?>
                                    <td class="col-md-2 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="3"></td>
                                    <td class="col-md-3 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="2"></td>
                                    <td class="col-md-3 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="1"></td>
                                    <td class="col-md-1 d-flex justify-content-center p-4"><input type="radio" name="items[<?php echo $item['id']; ?>]" value="0"></td>
                                <?php endif; ?>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if (count($datos) == $i) : ?>
                <div class="row justify-content-center">
                    <input type="hidden" name="metodo" value="insertarCuestionario">
                    <button type="submit" class="bg-orange text-white"><b>Guardar</b></button>
                </div>
            <?php endif; ?>
        </div>
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