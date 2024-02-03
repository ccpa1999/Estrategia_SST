<?php
include_once '../../config/conect.php';

class modeloCuestionarios extends conexion
{
    function __construct()
    {
        $this->conexion();
    }

    function controlador($datos)
    {
        if (isset($datos['metodo'])) {
            $metodo = $datos['metodo'];
            $resultado = $this->$metodo($datos);
        }
        return $resultado;
    }

    private function obtenerItems($datos)
    {
        switch ((int)$datos['tipo']) {
            case 1:
                $query = "SELECT i.id,dom.dominio, dim.dimencion, i.item, r.rango FROM `cuestionario` c 
                          INNER JOIN cuestionario_dimencion_dominio cdd ON cdd.cuestionario_id = c.id 
                          INNER JOIN dominios dom ON dom.id = cdd.dominio_id 
                          INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id 
                          INNER JOIN dimencion_item di ON dim.id = di.dimencion_id 
                          INNER JOIN items i ON i.id = di.item_id 
                          INNER JOIN rangos r ON r.item_id = i.id 
                          WHERE c.id = 1 AND r.cuestionario_id = 1 GROUP by i.id order by i.id asc";
                break;
            case 2:
                // $query = "SELECT i.id,dom.dominio, dim.dimencion, i.item, r.rango FROM `cuestionario` c 
                //           INNER JOIN cuestionario_dimencion_dominio cdd ON cdd.cuestionario_id = c.id 
                //           INNER JOIN dominios dom ON dom.id = cdd.dominio_id 
                //           INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id 
                //           INNER JOIN dimencion_item di ON dim.id = di.dimencion_id 
                //           INNER JOIN items i ON i.id = di.item_id 
                //           INNER JOIN rangos r ON r.item_id = i.id 
                //           WHERE c.id = 2 AND r.cuestionario_id = 2 GROUP by i.id order by i.id asc";
                $query = "SELECT i.id,dom.dominio, dim.dimencion, i.item, r.rango FROM cuestionario c
                INNER JOIN cuestionario_dimencion_dominio cdd ON c.id = cdd.cuestionario_id
                INNER JOIN dominios dom ON cdd.dominio_id = dom.id
                INNER JOIN dimenciones dim ON cdd.dimencion_id = dim.id
                INNER JOIN dimencion_item di ON dim.id = di.dimencion_id
                INNER JOIN items i ON di.item_id = i.id
                INNER JOIN rangos r ON r.item_id = i.id 
                WHERE c.id = 2  
                ORDER BY `i`.`id` ASC;";
                break;
            case 3:
                $query = "SELECT i.id,dim.dimencion, i.item, r.rango FROM `cuestionario` c 
                          INNER JOIN dimenciones dim ON dim.cuestionario_id = c.id 
                          INNER JOIN dimencion_item di ON di.dimencion_id = dim.id 
                          INNER JOIN items i ON di.item_id = i.id 
                          INNER JOIN rangos r ON r.item_id = i.id 
                          WHERE c.id = 3 GROUP by i.id order by i.id asc";
                break;
            case 4:
                $query = "SELECT i.id,i.item, r.rango FROM `cuestionario` c 
                          INNER JOIN rangos r ON r.cuestionario_id = c.id 
                          INNER JOIN items i ON i.id = r.item_id 
                          WHERE c.id = 4 GROUP by i.id order by i.id asc;";
                break;
        }
        $resultado = $this->row($query);
        return $resultado;
    }

    private function insertarCuestionario($datos)
    {
        $cuestionario = (int)$datos['tipo'];
        unset($datos['tipo'], $datos['metodo']);
        $query = '';
        foreach ($datos['items'] as $key => $item) {
            $query .= "INSERT INTO respuestas(item_id, cuestionario_id, peso_item, datos_personales_id)
            VALUES ($key, $cuestionario, $item, $_COOKIE[id]) ON DUPLICATE KEY UPDATE item_id = $key;";
        }
        $resultado = $this->ejecutar3($query);
        return $resultado;
    }

    private function generarInformes($datos)
    {
        switch ($datos['tipo']) {
            case 'datosGenerales':
                $resultado = $this->informeDatosGenerales($datos);
                break;
        }
    }

    private function informeDatosGenerales($datos)
    {
        $array = array();
        $tipo = 0;
        $query = "SELECT * FROM datos_generales";
        $resultado = $this->row($query);
        $cabeceras = array(
            'FECHA DE APLICACIÓN (dd/mm)', 'AÑO DE APLICACIÓN', 'ID', 'NOMBRE COMPLETO', 'SEXO', 'AÑO DE NACIMIENTO', 'ESTADO CIVIL', 'ESCOLARIDAD  (Último nivel de estudios)',
            'OCUPACIÓN O PROFESIÓN', 'CIUDAD / MUNICIPIO DE RESIDENCIA', 'DEPARTAMENTO DEL PAÍS DONDE RESIDE', 'ESTRATO SERVICIOS PÚBLICOS', 'TIPO DE VIVIENDA',
            'NÚMERO DE PERSONAS ECONÓMICAMENTE A CARGO', 'CIUDAD / MUNICIPIO DONDE TRABAJA', 'DEPARTAMENTO DEL PAÍS DONDE TRABAJA', 'ANTIGÜEDAD EN LA EMPRESA', 'NOMBRE DEL CARGO',
            'TIPO DE CARGO', 'ANTIGÜEDAD EN EL CARGO', 'DEPARTAMENTO O SECCIÓN DE LA EMPRESA DONDE TRABAJA', 'TIPO DE CONTRATO',
            'HORAS DIARIAS DE TRABAJO ESTABLECIDAS CONTRACTUALMENTE', 'TIPO DE SALARIO', 'Dimensión: Características del liderazgo - Forma A (puntaje transformado)',
            'Dimensión: Características del liderazgo - Forma A (nivel de riesgo)', 'Dimensión: Relaciones sociales en el trabajo - Forma A (puntaje transformado)',
            'Dimensión: Relaciones sociales en el trabajo - Forma A (nivel de riesgo)', 'Dimensión: Retroalimentación del desempeño - Forma A (puntaje transformado)',
            'Dimensión: Retroalimentación del desempeño - Forma A (nivel de riesgo)', 'Dimensión: Relación con los colaboradores - Forma A (puntaje transformado)',
            'Dimensión: Relación con los colaboradores - Forma A (nivel de riesgo)', 'DOMINIO: Liderazgo y relaciones sociales en el trabajo - Forma A (puntaje transformado)',
            'DOMINIO: Liderazgo y relaciones sociales en el trabajo  - Forma A (nivel de riesgo)', 'Dimensión: Claridad de rol - Forma A (puntaje transformado)',
            'Dimensión: Claridad de rol  - Forma A (nivel de riesgo)', 'Dimensión: Capacitación - Forma A (puntaje transformado)',
            'Dimensión: Capacitación  - Forma A (nivel de riesgo)', 'Dimensión: Participación y manejo del cambio - Forma A (puntaje transformado)',
            'Dimensión: Participación y manejo del cambio - Forma A (nivel de riesgo)', 'Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma A (puntaje transformado)',
            'Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma A (nivel de riesgo)', 'Dimensión: Control y autonomía sobre el trabajo - Forma A (puntaje transformado)',
            'Dimensión: Control y autonomía sobre el trabajo - Forma A (nivel de riesgo)', 'DOMINIO Control sobre el trabajo - Forma A (puntaje transformado)',
            'DOMINIO Control sobre el trabajo - Forma A (nivel de riesgo)', 'Dimensión: Demandas ambientales y de esfuerzo físico - Forma A (puntaje transformado)',
            'Dimensión: Demandas ambientales y de esfuerzo físico - Forma A (nivel de riesgo)', 'Dimensión: Demandas emocionales - Forma A (puntaje transformado)',
            'Dimensión: Demandas emocionales - Forma A (nivel de riesgo)', 'Dimensión: Demandas cuantitativas - Forma A (puntaje transformado)',
            'Dimensión: Demandas cuantitativas - Forma A (nivel de riesgo)', 'Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma A (puntaje transformado)',
            'Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma A (nivel de riesgo)', 'Dimensión: Exigencias de responsabilidad del cargo - Forma A (puntaje transformado)',
            'Dimensión: Exigencias de responsabilidad del cargo - Forma A (nivel de riesgo)', 'Dimensión: Demandas de carga mental - Forma A (puntaje transformado)',
            'Dimensión: Demandas de carga mental - Forma A (nivel de riesgo)', 'Dimensión: Consistencia del rol - Forma A (puntaje transformado)',
            'Dimensión: Consistencia del rol - Forma A (nivel de riesgo)', 'Dimensión: Demandas de la jornada de trabajo - Forma A (puntaje transformado)',
            'Dimensión: Demandas de la jornada de trabajo - Forma A (nivel de riesgo)', 'DOMINIO: Demandas del trabajo - Forma A (puntaje transformado)',
            'DOMINIO: Demandas del trabajo - Forma A (nivel de riesgo)', 'Dimensión: Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza - Forma A (puntaje transformado)',
            'Dimensión: Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza - Forma A (nivel de riesgo)',
            'Dimensión: Reconocimiento y compensación - Forma A (puntaje transformado)', 'Dimensión: Reconocimiento y compensación - Forma A (nivel de riesgo)',
            'DOMINIO: Recompensas - Forma A (puntaje transformado)', 'DOMINIO: Recompensas - Forma A (nivel de riesgo)',
            'PUNTAJE TOTAL del cuestionario de factores de riesgo psicosocial intralaboral - Forma A (puntaje transformado)',
            'PUNTAJE TOTAL del cuestionario de factores de riesgo psicosocial intralaboral - Forma A (nivel de riesgo)',
            'Dimensión: Características del liderazgo - Forma B (puntaje transformado)', 'Dimensión: Características del liderazgo - Forma B (nivel de riesgo)',
            'Dimensión: Relaciones sociales en el trabajo - Forma B (puntaje transformado)', 'Dimensión: Relaciones sociales en el trabajo - Forma B (nivel de riesgo)',
            'Dimensión: Retroalimentación del desempeño - Forma B (puntaje transformado)', 'Dimensión: Retroalimentación del desempeño - Forma B (nivel de riesgo)',
            'DOMINIO: Liderazgo y relaciones sociales en el trabajo - Forma B (puntaje transformado)', 'DOMINIO: Liderazgo y relaciones sociales en el trabajo - Forma B (nivel de riesgo)',
            'Dimensión: Claridad de rol - Forma B (puntaje transformado)', 'Dimensión: Claridad de rol - Forma B (nivel de riesgo)', 'Dimensión: Capacitación - Forma B (puntaje transformado)',
            'Dimensión: Capacitación - Forma B (nivel de riesgo)', 'Dimensión: Participación y manejo del cambio - Forma B (puntaje transformado)',
            'Dimensión: Participación y manejo del cambio - Forma B (nivel de riesgo)',
            'Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma B (puntaje transformado)',
            'Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma B (nivel de riesgo)',
            'Dimensión: Control y autonomía sobre el trabajo - Forma B (puntaje transformado)', 'Dimensión: Control y autonomía sobre el trabajo - Forma B (nivel de riesgo)',
            'DOMINIO: Control sobre el trabajo - Forma B (puntaje transformado)', 'DOMINIO: Control sobre el trabajo - Forma B (nivel de riesgo)',
            'Dimensión: Demandas ambientales y de esfuerzo físico - Forma B (puntaje transformado)', 'Dimensión: Demandas ambientales y de esfuerzo físico - Forma B (nivel de riesgo)',
            'Dimensión: Demandas emocionales - Forma B (puntaje transformado)', 'Dimensión: Demandas emocionales - Forma B (nivel de riesgo)',
            'Dimensión: Demandas cuantitativas - Forma B (puntaje transformado)', 'Dimensión: Demandas cuantitativas - Forma B (nivel de riesgo)',
            'Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma B (puntaje transformado)',
            'Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma B (nivel de riesgo)', 'Dimensión: Demandas de carga mental - Forma B (puntaje transformado)',
            'Dimensión: Demandas de carga mental - Forma B (nivel de riesgo)', 'Dimensión: Demandas de la jornada de trabajo - Forma B (puntaje transformado)',
            'Dimensión: Demandas de la jornada de trabajo - Forma B (nivel de riesgo)', 'DOMINIO: Demandas del trabajo - Forma B (puntaje transformado)',
            'DOMINIO: Demandas del trabajo - Forma B (nivel de riesgo)', 'Dimensión: Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza - Forma B (puntaje transformado)',
            'Dimensión: Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza - Forma B (nivel de riesgo)',
            'Dimensión: Reconocimiento y compensación - Forma B (puntaje transformado)', 'Dimensión: Reconocimiento y compensación - Forma B (nivel de riesgo)',
            'DOMINIO: Recompensas - Forma B (puntaje transformado)', 'DOMINIO: Recompensas - Forma B (nivel de riesgo)',
            'PUNTAJE TOTAL del cuestionario de factores de riesgo psicosocial intralaboral - Forma B (puntaje transformado)',
            'PUNTAJE TOTAL del cuestionario de factores de riesgo psicosocial intralaboral - Forma B (nivel de riesgo)',
            'Dimensión: Tiempo fuera del trabajo - Extralaboral (puntaje transformado)', 'Dimensión: Tiempo fuera del trabajo - Extralaboral (nivel de riesgo)',
            'Dimensión: Relaciones familiares - Extralaboral (puntaje transformado)', 'Dimensión: Relaciones familiares - Extralaboral (nivel de riesgo)',
            'Dimensión: Comunicación y relaciones interpersonales - Extralaboral (puntaje transformado)',
            'Dimensión: Comunicación y relaciones interpersonales - Extralaboral (nivel de riesgo)', 'Dimensión: Situación económica del grupo familiar - Extralaboral (puntaje transformado)',
            'Dimensión: Situación económica del grupo familiar - Extralaboral (nivel de riesgo)', 'Dimensión: Características de la vivienda y de su entorno - Extralaboral (puntaje transformado)',
            'Dimensión: Características de la vivienda y de su entorno - Extralaboral (nivel de riesgo)',
            'Dimensión: Influencia del entorno extralaboral sobre el trabajo - Extralaboral (puntaje transformado)',
            'Dimensión: Influencia del entorno extralaboral sobre el trabajo - Extralaboral (nivel de riesgo)', 'Dimensión: Desplazamiento vivienda - trabajo - vivienda - Extralaboral (puntaje transformado)',
            'Dimensión: Desplazamiento vivienda - trabajo - vivienda - Extralaboral (nivel de riesgo)', 'PUNTAJE TOTAL del cuestionario de factores de riesgo psicosocial extralaboral (puntaje transformado)',
            'PUNTAJE TOTAL del cuestionario de factores de riesgo psicosocial extralaboral (nivel de riesgo)', 'Puntaje total evaluación de estrés (puntaje transformado)',
            'Puntaje total evaluación de estrés (nivel de riesgo)'
        );
        $fp = fopen('../../public/archivos/informes/' . $tipo . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        return $resultado;
    }
}
