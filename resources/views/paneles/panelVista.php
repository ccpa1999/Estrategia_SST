<div class="accordion" id="accordionExample">
    <?php $i = 1;
    foreach ($_POST['data'] as $dato) : ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button w-100 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#acordeon<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne">
                    <div class="row w-100">
                        <div class="col-md-3">
                            <?php echo $dato['fecha'] ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $dato['nombre_empresa'] ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo $dato['cedula'] ?>
                        </div>
                    </div>
                </button>
            </h2>
            <div id="acordeon<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div style="height: 400px;" class="accordion-body overflow-scroll">
                    <div class="row">
                        <div class="col-md-1 offset-md-11">
                            <a data-id="<?php echo $dato['id']; ?>" class="pdf btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                    <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b>1.Nombre</b></label><br>
                            <?php echo $dato['nombre_completo'] ?>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b>2.sexo</b></label><br>
                            <?php echo $dato['sexo'] ?>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b>3.Año de nacimiento</b></label><br>
                            <?php echo $dato['anio_nacimiento'] ?>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b>4.Estado Civil</b></label><br>
                            <?php echo $dato['estado_civil'] ?>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b>5.Último nivel de estudios que alcanzó (marque una sola opción)</b></label><br>
                            <?php echo $dato['ultimo_nivel_estudios'] ?>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b>¿Cuál es su ocupación o profesión?</b></label><br>
                            <?php echo $dato['ocupacion_profesion'] ?>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b>7.Lugar residencia actúal</b></label><br>
                            <?php echo $dato['lugar_residencia'] ?>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b>8.Seleccione y marque el estrato de los servicios públicos de su vivienda</b></label><br>
                            <?php echo $dato['estrato'] ?>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b>9.Tipo Vivienda</b></label><br>
                            <?php echo $dato['tipo_vivienda'] ?>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b>10.Número de personas que dependen económicamente de usted (aunque vivan en otro lugar)</b></label><br>
                            <?php echo $dato['cantidad_personas_dependientes'] ?>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b>11.Lugar donde trabaja actualmente</b></label><br>
                            <?php echo $dato['lugar_trabajo'] ?>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b>12.¿Hace cuántos años que trabaja en esta empresa?</b></label><br>
                            <?php echo $dato['antiguedad_empresa'] ?>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b>13.¿Cuál es el nombre del cargo que ocupa en la empresa?</b></label><br>
                            <?php echo $dato['cargo'] ?>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b>14.Seleccione el tipo de cargo que más se parece al que usted desempeña y señalelo en el cuadro correspondiente de la derecha. Si tiene dudas pida apoyo a la persona que le entregó este cuestionario</b></label><br>
                            <?php echo $dato['tipo_cargo'] ?>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b>15.¿Hace cuántos años que desempeña el cargo u oficio actual en esta empresa?</b></label><br>
                            <?php echo $dato['antiguedad_cargo'] ?>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b>16.Escriba el nombre del departamento, área o sección de la empresa en el que trabaja</b></label><br>
                            <?php echo $dato['nombre_area'] ?>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b>17.Seleccione el tipo de contrato que tiene actualmente (marque una sola opción)</b></label><br>
                            <?php echo $dato['tipo_contrato'] ?>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b>18.Indique cuántas horas diarias de trabajo están establecidas habitualmente por la empresa para su cargo</b></label><br>
                            <?php echo $dato['horas_diarias'] ?>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b>19.Seleccione y marque el tipo de salario que recibe (marque una sola opción)</b></label><br>
                            <?php echo $dato['tipo_salario'] ?>
                        </div>
                    </div><br>
                </div>
            </div>
        </div>
    <?php $i++;
    endforeach; ?>
</div>