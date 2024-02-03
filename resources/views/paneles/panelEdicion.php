<p><?php $datos = $_POST['data'][0]; ?></p>
<div class="accordion" id="accordionExample">
    <div class="container">
        <div style="height: 500px;" class="card-body mt-n2 shadow overflow-scroll">
            <form id="datosGenerales" data-id="datosGenerales" data-controlador="datosGeneralesController" action="javascript:void(0);">
                <div class="row">
                    <div class="offset-md-6 col-md-6">
                        <label for="cedula" class="form-label">Fecha de aplicación</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg>
                            </span>
                            <input type="date" class="form-control" id="fecha" value="<?php echo $datos['fecha'] ?>" name="fecha">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="cedula" class="form-label">Cédula</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">CC</span>
                            <input type="number" class="form-control" id="cedula" placeholder="Ingrese cédula" value="<?php echo $datos['cedula'] ?>" name="cedula">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="cedula" class="form-label">Nombre de la empresa</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                                    <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                                </svg>
                            </span>
                            <input type="text" class="form-control" id="nombre_empresa" placeholder="Nombre de la empresa" value="<?php echo $datos['nombre_empresa'] ?>" name="nombre_empresa">
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <label for="nombre_completo" class="form-label">Nombre completo</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">1</span>
                            <input type="text" class="form-control" id="nombre_completo" placeholder="Ingrese nombre completo" value="<?php echo $datos['nombre_completo'] ?>" name="nombre_completo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="cedula" class="form-label">Sexo</label><br>
                        <div class="input-group mb-3 border">
                            <span class="input-group-text" id="basic-assddon1">2</span>
                            <div class="p-1">
                                <label for="M" class="form-label">Masculino</label>
                                <input type="radio" <?php echo ($datos['sexo'] == 'M') ? 'checked' : '' ?> name="sexo" value="M" id="M" required>
                                <label for="F" class="form-label ms-4">Femenino</label>
                                <input type="radio" <?php echo ($datos['sexo'] == 'F') ? 'checked' : '' ?> name="sexo" value="F" id="F">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="nombre_completo" class="form-label">Año de nacimiento</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">3</span>
                            <input type="number" class="form-control" id="anio_nacimiento" placeholder="Ingrese el año de nacimiento" value="<?php echo $datos['anio_nacimiento'] ?>" name="anio_nacimiento">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre_completo" class="form-label">Estado civil</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">4</span>
                            <select class="form-control" value="<?php echo $datos['estado_civil'] ?>" name="estado_civil" id="estado_civil">
                                <option <?php echo ($datos['estado_civil'] == 'Soltero (a)') ? 'selected' : ''; ?> value="Soltero (a)">Soltero (a)</option>
                                <option <?php echo ($datos['estado_civil'] == 'Casado (a)') ? 'selected' : ''; ?> value="Casado (a)">Casado (a)</option>
                                <option <?php echo ($datos['estado_civil'] == 'Unión libre') ? 'selected' : ''; ?> value="Unión libre">Unión libre</option>
                                <option <?php echo ($datos['estado_civil'] == 'Separado (a)') ? 'selected' : ''; ?> value="Separado (a)">Separado (a)</option>
                                <option <?php echo ($datos['estado_civil'] == 'Divorciado (a)>') ? 'selected' : ''; ?> value="Divorciado (a)">Divorciado (a)</option>
                                <option <?php echo ($datos['estado_civil'] == 'Viudo (a)>') ? 'selected' : ''; ?> value="Viudo (a)">Viudo (a)</option>
                                <option <?php echo ($datos['estado_civil'] == 'Sacerdote / Monja') ? 'selected' : ''; ?> value="Sacerdote / Monja">Sacerdote / Monja</option>
                            </select>
                        </div>
                        <!-- <input type="text" class="form-control" id="nombre_completo" placeholder="Ingrese el año de nacimiento" value="<?php echo $datos['nombre_completo'] ?>" name="nombre_completo"> -->
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <label for="nombre_completo" class="form-label">Último nivel de estudios que alcanzó(marque una sola opción)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">5</span>
                            <select class="form-control" value="<?php echo $datos['ultimo_nivel_estudios'] ?>" name="ultimo_nivel_estudios" id="ultimo_nivel_estudios">
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Ninguno' ? 'selected' : ''); ?> value="Ninguno">Ninguno</option>
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Primaria incompleta' ? 'selected' : ''); ?> value="Primaria incompleta">Primaria incompleta</option>
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Primaria completa' ? 'selected' : ''); ?> value="Primaria completa">Primaria completa</option>
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Bachillerato incompleto' ? 'selected' : ''); ?> value="Bachillerato incompleto">Bachillerato incompleto</option>
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Bachillerato completo' ? 'selected' : ''); ?> value="Bachillerato completo">Bachillerato completo</option>
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Técnico / tecnológico incompleto' ? 'selected' : ''); ?> value="Técnico / tecnológico incompleto">Técnico / tecnológico incompleto</option>
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Técnico / tecnológico completo' ? 'selected' : ''); ?> value="Técnico / tecnológico completo">Técnico / tecnológico completo</option>
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Profesional incompleto' ? 'selected' : ''); ?> value="Profesional incompleto">Profesional incompleto</option>
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Profesional completo' ? 'selected' : ''); ?> value="Profesional completo">Profesional completo</option>
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Carrera militar / policía' ? 'selected' : ''); ?> value="Carrera militar / policía">Carrera militar / policía</option>
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Post-grado incompleto' ? 'selected' : ''); ?> value="Post-grado incompleto">Post-grado incompleto</option>
                                <option <?php echo ($datos['ultimo_nivel_estudios'] == 'Post-grado completo' ? 'selected' : ''); ?> value="Post-grado completo">Post-grado completo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="ocupacion_profesion" class="form-label">¿Cuál es su ocupación o profesión?</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">6</span>
                            <input type="text" class="form-control" value="<?php echo $datos['ocupacion_profesion'] ?>" name="ocupacion_profesion" id="ocupacion_profesion" placeholder="¿Cuál es su ocupación o profesión?">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="row">
                            <label for="" class="form-label">Lugar de residencia actual:</label>
                            <div class="input-group mb-3 w-full">
                                <span class="input-group-text" id="basic-addon1">7</span>
                                <div class="col-md-5">
                                    <input class="form-control" placeholder="Ciudad / municipio" type="text" value="<?php $vive = explode('-', $datos['lugar_residencia']);
                                                                                                                    echo $vive[0] ?>" name="ciudad_vive" id="ciudad">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" placeholder="Departamento" type="text" value="<?php $vive = explode('-', $datos['lugar_residencia']);
                                                                                                                echo $vive[1] ?>" name="departamento_vive" id="departamento">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Seleccione y marque el estrato de los servicios públicos de su vivienda</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">8</span>
                            <select class="form-control" value="<?php echo $datos['estrato'] ?>" name="estrato" id="estrato">
                                <option <?php echo ($datos['estrato'] == '1') ? 'selected' : ''; ?> value="1">1</option>
                                <option <?php echo ($datos['estrato'] == '2') ? 'selected' : ''; ?> value="2">2</option>
                                <option <?php echo ($datos['estrato'] == '3') ? 'selected' : ''; ?> value="3">3</option>
                                <option <?php echo ($datos['estrato'] == '4') ? 'selected' : ''; ?> value="4">4</option>
                                <option <?php echo ($datos['estrato'] == '5') ? 'selected' : ''; ?> value="5">5</option>
                                <option <?php echo ($datos['estrato'] == '6') ? 'selected' : ''; ?> value="6">6</option>
                                <option <?php echo ($datos['estrato'] == 'Finca') ? 'selected' : ''; ?> value="Finca">Finca</option>
                                <option <?php echo ($datos['estrato'] == 'No sé') ? 'selected' : ''; ?> value="No sé">No sé</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"><br>
                        <label for="" class="form-label">Tipo de vivienda</label><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">9</span>
                            <select value="<?php echo $datos['tipo_vivienda'] ?>" name="tipo_vivienda" id="" class="form-control">
                                <option <?php echo ($datos['tipo_vivienda'] == 'Propia') ? 'selected' : '' ?> value="Propia">Propia</option>
                                <option <?php echo ($datos['tipo_vivienda'] == 'En Arriendo') ? 'selected' : '' ?> value="En Arriendo">En Arriendo</option>
                                <option <?php echo ($datos['tipo_vivienda'] == 'Familiar') ? 'selected' : '' ?> value="Familiar">Familiar</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Número de personas que dependen economicamente de usted(aunque vivan en otro lugar)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">10</span>
                            <input class="form-control" value="<?php echo $datos['cantidad_personas_dependientes'] ?>" name="cantidad_personas_dependientes" placeholder="Número de personas que dependen económicamente de usted" type="number">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="row">
                            <label for="" class="form-label">Lugar donde trabaja actualmente</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">11</span>
                                <div class="col-md-5">
                                    <input class="form-control" placeholder="Ciudad / municipio" type="text" value="<?php $trabaja = explode('-', $datos['lugar_trabajo']);
                                                                                                                    echo $trabaja[0]; ?>" name="ciudad_labora" id="ciudad">
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" placeholder="Departamento" type="text" value="<?php $trabaja = explode('-', $datos['lugar_trabajo']);
                                                                                                                echo $trabaja[1]; ?>" name="departamento_labora" id="departamento">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">¿Hace cuántos años que trabaja en esta empresa?</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">12</span>
                            <select value="<?php echo $datos['antiguedad_empresa'] ?>" name="antiguedad_empresa" id="antiguedad_empresa" class="form-control">
                                <option <?php ($datos['antiguedad_empresa'] == 'Menos de un año') ? 'selected' : ''; ?> value="Menos de un año">Menos de un año</option>
                                <option <?php ($datos['antiguedad_empresa'] == 'Más de un año') ? 'selected' : ''; ?> value="Más de un año">Más de un año</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><br>
                        <label for="" class="form-label">¿Cuál es el nombre del cargo que ocupa en la empresa?</label><br><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">13</span>
                            <input class="form-control" value="<?php echo $datos['cargo'] ?>" name="cargo" placeholder="¿Cuál es el nombre del cargo que ocupa en la empresa?" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label for="" class="form-label">Seleccione el tipo de cargo que más se parece al que usted desempeña y señalelo en el
                                cuadro correspondiente de la derecha. Si tiene dudas pida apoyo a la persona que le
                                entregó este cuestionario</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">14</span>
                                <select class="form-control" value="<?php echo $datos['tipo_cargo'] ?>" name="tipo_cargo" id="tipo_cargo">
                                    <option <?php echo ($datos['tipo_cargo'] == 'Jefatura - tiene personal a cargo">') ? 'selected' : '' ?> value="Jefatura - tiene personal a cargo">Jefatura - tiene personal a cargo</option>
                                    <option <?php echo ($datos['tipo_cargo'] == 'Profesional, analista, técnico, tecnólogo') ? 'selected' : '' ?> value="Profesional, analista, técnico, tecnólogo">Profesional, analista, técnico, tecnólogo</option>
                                    <option <?php echo ($datos['tipo_cargo'] == 'Auxiliar, asistente administrativo, asistente técnico') ? 'selected' : '' ?> value="Auxiliar, asistente administrativo, asistente técnico">Auxiliar, asistente administrativo, asistente técnico</option>
                                    <option <?php echo ($datos['tipo_cargo'] == 'Operario, operador, ayudante, servicios generales') ? 'selected' : '' ?> value="Operario, operador, ayudante, servicios generales">Operario, operador, ayudante, servicios generales</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">¿Hace cuántos años que desempeña el cargo u oficio actual en esta empresa?</label><br><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">15</span>
                            <select value="<?php echo $datos['antiguedad_cargo'] ?>" name="antiguedad_cargo" id="antiguedad_cargo" class="form-control">
                                <option <?php echo ($datos['antiguedad_cargo'] == 'Menos de un año') ? 'selected' : ''; ?> value="Menos de un año">Menos de un año</option>
                                <option <?php echo ($datos['antiguedad_cargo'] == 'Más de un año') ? 'selected' : ''; ?> value="Más de un año">Más de un año</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Escriba el nombre del departamento, área o sección de la empresa en el que trabaja</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">16</span>
                            <input class="form-control" value="<?php echo $datos['nombre_area'] ?>" name="nombre_area" placeholder="Escriba el nombre del departamento, área o sección de la empresa en el que trabaja" type="text">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><br>
                        <div class="row">
                            <label for="" class="form-label">Seleccione el tipo de contrato que tiene actualmente (marque una sola opción)</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">17</span>
                                <select class="form-control" value="<?php echo $datos['tipo_contrato'] ?>" name="tipo_contrato" id="tipo_contrato">
                                    <option <?php echo ($datos['tipo_contrato'] == 'Temporal de menos de 1 año') ? 'selected' : ''; ?> value="Temporal de menos de 1 año">Temporal de menos de 1 año</option>
                                    <option <?php echo ($datos['tipo_contrato'] == 'Temporal de 1 año o más') ? 'selected' : ''; ?> value="Temporal de 1 año o más">Temporal de 1 año o más</option>
                                    <option <?php echo ($datos['tipo_contrato'] == 'Término indefinido') ? 'selected' : ''; ?> value="Término indefinido">Término indefinido</option>
                                    <option <?php echo ($datos['tipo_contrato'] == 'Cooperado (cooperativa)') ? 'selected' : ''; ?> value="Cooperado (cooperativa)">Cooperado (cooperativa)</option>
                                    <option <?php echo ($datos['tipo_contrato'] == 'Prestación de servicios') ? 'selected' : ''; ?> value="Prestación de servicios">Prestación de servicios</option>
                                    <option <?php echo ($datos['tipo_contrato'] == 'No sé') ? 'selected' : ''; ?> value="No sé">No sé</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Indique cuántas horas diarias de trabajo están establecidas habitualmente por la empresa para su cargo</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">18</span>
                            <input class="form-control" value="<?php echo $datos['horas_diarias'] ?>" name="horas_diarias" placeholder="Indique cuántas horas diarias de trabajo están establecidas por la empresa para su cargo" type="number">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="" class="form-label">Seleccione y marque el tipo de salario que recibe (marque una sola opción)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">19</span>
                            <select value="<?php echo $datos['tipo_salario'] ?>" name="tipo_salario" id="tipo_salario" class="form-control">
                                <option <?php echo ($datos['tipo_salario'] == 'Fijo (diario, semanal, quincenal o mensual)') ? 'selected' : ''; ?> value="Fijo (diario, semanal, quincenal o mensual)">Fijo (diario, semanal, quincenal o mensual)</option>
                                <option <?php echo ($datos['tipo_salario'] == 'Una parte fija y otra variable') ? 'selected' : ''; ?> value="Una parte fija y otra variable">Una parte fija y otra variable</option>
                                <option <?php echo ($datos['tipo_salario'] == 'Todo variable (a destajo, por producción, por comisión)') ? 'selected' : ''; ?> value="Todo variable (a destajo, por producción, por comisión)">Todo variable (a destajo, por producción, por comisión)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 offset-md-6">
                        <input type="hidden" name="metodo" value="insertarDatosGenerales">
                        <input type="hidden" value="<?php echo $datos['id'] ?>" name="id">
                        <button type="submit" class="mb-3 btn btn-orange">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>