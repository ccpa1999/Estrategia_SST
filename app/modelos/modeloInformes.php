<?php
include_once '../../config/conect.php';

class modeloInformes extends conexion
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

    // private function generarInformes($datos)
    // {
    //     switch ($datos['tipo']) {
    //         case 'datosGenerales':
    //             $resultado = $this->informeDatosGenerales($datos);
    //             break;
    //     }
    //     return $resultado;
    // }

    private function panelFiltros($datos)
    {
        $query = "SELECT * FROM filtros";
        $resultado = $this->row($query);
        if (!isset($result[0])) {
            $query = "SHOW COLUMNS FROM datos_generales";
            $resultado = $this->row($query);
        }
        return $resultado;
    }

    private function filtrar($datos)
    {
        $fechas = "fecha BETWEEN '$datos[fecha_inicial]' AND '$datos[fecha_final]' AND ";
        unset($datos['tipo'], $datos['metodo'], $datos['fecha_inicial'], $datos['fecha_final']);
        $query = "SELECT * FROM datos_generales WHERE $fechas";
        foreach ($datos as $key => $dato) {
            if ($dato != '') {
                $query .= " $key = '$dato' AND ";
            }
        }
        $query = substr($query, 0, -5);
        $resultado = $this->row($query);
        return $resultado;
    }

    private function guardarFiltros($datos)
    {
        foreach ($datos['campos'] as $key => $campo) {
            $query = "INSERT INTO filtros (campo, filtro, orden) 
            VALUES('" . $datos['campos'][$key] . "', '" . $datos['filtros'][$key] . "', '" . $datos['ordenes'][$key] . "')
            ON DUPLICATE KEY UPDATE filtro = '" . $datos['filtros'][$key] . "', orden = '" . $datos['ordenes'][$key] . "';";
            $resultado = $this->ejecutar($query);
        }
        return $resultado;
    }

    private function obtenerInformacion($datos)
    {
        $query = "SELECT * FROM datos_generales WHERE id = '$datos[id]'";
        $data['datos_generales'] = $this->row($query);
        $data['evaluaciones'] = $this->datosInformeMasivo($datos['id']);
        return $data;
    }

    private function datosInformeMasivo($id)
    {
        // $query = "SELECT dim.id, d.dominio, dim.dimencion, (SUM(r.peso_item) / dim.factor) * 100 puntaje_transformado_dim
        // FROM datos_generales dg 
        // INNER JOIN respuestas r ON dg.id = r.datos_personales_id
        // INNER JOIN cuestionario c ON r.cuestionario_id = c.id
        // INNER JOIN cuestionario_dimencion_dominio cdd ON c.id = cdd.cuestionario_id
        // INNER JOIN dominios d ON cdd.dominio_id = d.id
        // INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id
        // INNER JOIN dimencion_item di ON dim.id = di.dimencion_id
        // INNER JOIN items i ON di.item_id = i.id
        // WHERE dg.id = $id AND c.id = 1 AND cdd.cuestionario_id = 1 AND dim.cuestionario_id = 1
        // GROUP BY dim.dimencion
        // ORDER BY dim.id ASC;";
        $query = "SELECT dim.id, dom.dominio, dim.dimencion, (SUM(res.peso_item) / dim.factor) * 100 puntaje_transformado_dim
        FROM datos_generales dg
        INNER JOIN respuestas res ON dg.id = res.datos_personales_id
        INNER JOIN cuestionario c ON c.id = res.cuestionario_id
        INNER JOIN cuestionario_dimencion_dominio cdd ON cdd.cuestionario_id = c.id
        INNER JOIN dominios dom ON dom.id = cdd.dominio_id 
        INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id 
        INNER JOIN dimencion_item di ON dim.id = di.dimencion_id 
        INNER JOIN items i ON i.id = di.item_id AND i.id = res.item_id
        WHERE dg.id = $id AND c.id = 1 AND cdd.cuestionario_id = 1 AND dim.cuestionario_id = 1
        GROUP BY dim.id;";
        $result['forma_a'][$id]['dimenciones'] = $this->row($query);

        // $query = "SELECT d.id, d.dominio, dim.dimencion, (SUM(r.peso_item) / d.forma_a) * 100 puntaje_transformado_dom
        // FROM datos_generales dg 
        // INNER JOIN respuestas r ON dg.id = r.datos_personales_id
        // INNER JOIN cuestionario c ON r.cuestionario_id = c.id
        // INNER JOIN cuestionario_dimencion_dominio cdd ON c.id = cdd.cuestionario_id
        // INNER JOIN dominios d ON cdd.dominio_id = d.id
        // INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id
        // INNER JOIN dimencion_item di ON dim.id = di.dimencion_id
        // INNER JOIN items i ON di.item_id = i.id
        // WHERE dg.id = $id AND c.id = 1 AND cdd.cuestionario_id = 1 AND dim.cuestionario_id = 1
        // GROUP BY dim.dimencion
        // ORDER BY d.id ASC;";
        $query = "SELECT dom.id, dom.dominio, (SUM(res.peso_item) / dom.forma_a) * 100 puntaje_transformado_dom
        FROM datos_generales dg
        INNER JOIN respuestas res ON dg.id = res.datos_personales_id
        INNER JOIN cuestionario c ON c.id = res.cuestionario_id
        INNER JOIN cuestionario_dimencion_dominio cdd ON cdd.cuestionario_id = c.id
        INNER JOIN dominios dom ON dom.id = cdd.dominio_id 
        INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id 
        INNER JOIN dimencion_item di ON dim.id = di.dimencion_id 
        INNER JOIN items i ON i.id = di.item_id AND i.id = res.item_id
        WHERE dg.id = $id AND c.id = 1 AND cdd.cuestionario_id = 1 AND dim.cuestionario_id = 1
        GROUP BY dom.dominio ORDER BY dom.id ASC;";
        $result['forma_a'][$id]['dominios'] = $this->row($query);

        // $query = "SELECT dim.id, d.dominio, dim.dimencion, (SUM(r.peso_item) / dim.factor) * 100 puntaje_transformado_dim, (SUM(r.peso_item) / c.factor_a) * 100 putaje_transformado_calificacion
        // FROM datos_generales dg 
        // INNER JOIN respuestas r ON dg.id = r.datos_personales_id
        // INNER JOIN cuestionario c ON r.cuestionario_id = c.id
        // INNER JOIN cuestionario_dimencion_dominio cdd ON c.id = cdd.cuestionario_id
        // INNER JOIN dominios d ON cdd.dominio_id = d.id
        // INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id
        // INNER JOIN dimencion_item di ON dim.id = di.dimencion_id
        // INNER JOIN items i ON di.item_id = i.id
        // WHERE dg.id = $id AND c.id = 1 AND cdd.cuestionario_id = 1 AND dim.cuestionario_id = 1
        // GROUP BY dim.dimencion;";
        $query = "SELECT dim.id, dom.dominio, dim.dimencion, (SUM(res.peso_item) / dim.factor) * 100 puntaje_transformado_dim, (SUM(res.peso_item) / c.factor_a) * 100 putaje_transformado_calificacion
        FROM datos_generales dg
        INNER JOIN respuestas res ON dg.id = res.datos_personales_id
        INNER JOIN cuestionario c ON c.id = res.cuestionario_id
        INNER JOIN cuestionario_dimencion_dominio cdd ON cdd.cuestionario_id = c.id
        INNER JOIN dominios dom ON dom.id = cdd.dominio_id 
        INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id 
        INNER JOIN dimencion_item di ON dim.id = di.dimencion_id 
        INNER JOIN items i ON i.id = di.item_id AND i.id = res.item_id
        WHERE dg.id = $id AND c.id = 1 AND cdd.cuestionario_id = 1 AND dim.cuestionario_id = 1
        GROUP BY c.id;";
        $result['forma_a'][$id]['calificacion'] = $this->row($query);

        // $query = "SELECT dim.id, d.dominio, dim.dimencion, (SUM(r.peso_item) / dim.factor) * 100 puntaje_transformado_dim
        // FROM datos_generales dg 
        // INNER JOIN respuestas r ON dg.id = r.datos_personales_id
        // INNER JOIN cuestionario c ON r.cuestionario_id = c.id
        // INNER JOIN cuestionario_dimencion_dominio cdd ON c.id = cdd.cuestionario_id
        // INNER JOIN dominios d ON cdd.dominio_id = d.id
        // INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id
        // INNER JOIN dimencion_item di ON dim.id = di.dimencion_id
        // INNER JOIN items i ON di.item_id = i.id
        // WHERE dg.id = $id AND c.id = 2 AND cdd.cuestionario_id = 2 AND dim.cuestionario_id = 2
        // GROUP BY dim.dimencion
        // ORDER BY dim.id ASC;";
        $query = "SELECT dim.id, dom.dominio, dim.dimencion, (SUM(res.peso_item) / dim.factor) * 100 puntaje_transformado_dim
        FROM datos_generales dg
        INNER JOIN respuestas res ON dg.id = res.datos_personales_id
        INNER JOIN cuestionario c ON c.id = res.cuestionario_id
        INNER JOIN cuestionario_dimencion_dominio cdd ON cdd.cuestionario_id = c.id
        INNER JOIN dominios dom ON dom.id = cdd.dominio_id 
        INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id 
        INNER JOIN dimencion_item di ON dim.id = di.dimencion_id 
        INNER JOIN items i ON i.id = di.item_id AND i.id = res.item_id
        WHERE dg.id = $id AND c.id = 2 AND cdd.cuestionario_id = 2 AND dim.cuestionario_id = 2
        GROUP BY dim.id;";
        $result['forma_b'][$id]['dimenciones'] = $this->row($query);

        // $query = "SELECT dim.id, d.dominio, dim.dimencion, (SUM(r.peso_item) / d.forma_b) * 100 puntaje_transformado_dom
        // FROM datos_generales dg 
        // INNER JOIN respuestas r ON dg.id = r.datos_personales_id
        // INNER JOIN cuestionario c ON r.cuestionario_id = c.id
        // INNER JOIN cuestionario_dimencion_dominio cdd ON c.id = cdd.cuestionario_id
        // INNER JOIN dominios d ON cdd.dominio_id = d.id
        // INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id
        // INNER JOIN dimencion_item di ON dim.id = di.dimencion_id
        // INNER JOIN items i ON di.item_id = i.id
        // WHERE dg.id = $id AND c.id = 2 AND cdd.cuestionario_id = 2 AND dim.cuestionario_id = 2
        // GROUP BY dim.dimencion;";
        $query = "SELECT dom.id, dom.dominio, (SUM(res.peso_item) / dom.forma_b) * 100 puntaje_transformado_dom
        FROM datos_generales dg
        INNER JOIN respuestas res ON dg.id = res.datos_personales_id
        INNER JOIN cuestionario c ON c.id = res.cuestionario_id
        INNER JOIN cuestionario_dimencion_dominio cdd ON cdd.cuestionario_id = c.id
        INNER JOIN dominios dom ON dom.id = cdd.dominio_id 
        INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id 
        INNER JOIN dimencion_item di ON dim.id = di.dimencion_id 
        INNER JOIN items i ON i.id = di.item_id AND i.id = res.item_id
        WHERE dg.id = $id AND c.id = 2 AND cdd.cuestionario_id = 2 AND dim.cuestionario_id = 2
        GROUP BY dom.dominio ORDER BY dom.id ASC";
        $result['forma_b'][$id]['dominios'] = $this->row($query);

        // $query = "SELECT dim.id, d.dominio, dim.dimencion, (SUM(r.peso_item) / dim.factor) * 100 puntaje_transformado_dim, (SUM(r.peso_item) / c.factor_b) * 100 putaje_transformado_calificacion
        // FROM datos_generales dg 
        // INNER JOIN respuestas r ON dg.id = r.datos_personales_id
        // INNER JOIN cuestionario c ON r.cuestionario_id = c.id
        // INNER JOIN cuestionario_dimencion_dominio cdd ON c.id = cdd.cuestionario_id
        // INNER JOIN dominios d ON cdd.dominio_id = d.id
        // INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id
        // INNER JOIN dimencion_item di ON dim.id = di.dimencion_id
        // INNER JOIN items i ON di.item_id = i.id
        // WHERE dg.id = $id AND c.id = 2 AND cdd.cuestionario_id = 2 AND dim.cuestionario_id = 2
        // GROUP BY dim.dimencion;";
        $query = "SELECT dim.id, dom.dominio, dim.dimencion, (SUM(res.peso_item) / dim.factor) * 100 puntaje_transformado_dim, (SUM(res.peso_item) / c.factor_b) * 100 putaje_transformado_calificacion
        FROM datos_generales dg
        INNER JOIN respuestas res ON dg.id = res.datos_personales_id
        INNER JOIN cuestionario c ON c.id = res.cuestionario_id
        INNER JOIN cuestionario_dimencion_dominio cdd ON cdd.cuestionario_id = c.id
        INNER JOIN dominios dom ON dom.id = cdd.dominio_id 
        INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id 
        INNER JOIN dimencion_item di ON dim.id = di.dimencion_id 
        INNER JOIN items i ON i.id = di.item_id AND i.id = res.item_id
        WHERE dg.id = $id AND c.id = 2 AND cdd.cuestionario_id = 2 AND dim.cuestionario_id = 2
        GROUP BY c.id;";
        $result['forma_b'][$id]['calificacion'] = $this->row($query);

        $query = "SELECT dim.id, dim.dimencion, (SUM(res.peso_item) / dim.factor) * 100 puntaje_transformado_dim
        FROM datos_generales dg
        INNER JOIN respuestas res ON dg.id = res.datos_personales_id
        INNER JOIN cuestionario c ON c.id = res.cuestionario_id
        INNER JOIN cuestionario_dimencion_dominio cdd ON cdd.cuestionario_id = c.id
        INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id 
        INNER JOIN dimencion_item di ON dim.id = di.dimencion_id 
        INNER JOIN items i ON i.id = di.item_id AND i.id = res.item_id
        WHERE dg.id = $id AND c.id = 3 AND cdd.cuestionario_id = 3 AND dim.cuestionario_id = 3
        GROUP BY dim.id";
        $result['extralaboral'][$id]['dimenciones'] = $this->row($query);

        // $query = "SELECT c.id,c.cuestionario, SUM(res.peso_item) bruto, c.factor_a
        // FROM datos_generales dg
        // INNER JOIN respuestas res ON dg.id = res.datos_personales_id
        // INNER JOIN cuestionario c ON c.id = res.cuestionario_id
        // INNER JOIN cuestionario_dimencion_dominio cdd ON cdd.cuestionario_id = c.id
        // INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id 
        // INNER JOIN dimencion_item di ON dim.id = di.dimencion_id 
        // INNER JOIN items i ON i.id = di.item_id AND i.id = res.item_id
        // WHERE dg.id = $id AND c.id in(1,3) AND cdd.cuestionario_id in(1,3) AND dim.cuestionario_id in(1,3)
        // GROUP BY c.id";
        $query = "SELECT SUM(peso_item) total FROM respuestas where cuestionario_id in(1,3) and datos_personales_id = $id GROUP BY cuestionario_id;";
        $result['extralaboral'][$id]['a'] = $this->row($query);
        if ($result['extralaboral'][$id]['a'][1] != null) {
            $suma = 0;
            foreach ($result['extralaboral'][$id]['a'] as $extrataboral_a) {
                $suma += (int)$extrataboral_a['total'];
            }
            $result['extralaboral'][$id]['calificacion_a'] = ($suma / 616) * 100;
            //$result['extralaboral'][$id]['calificacion_a'] = $result['extralaboral'][$id]['a'][0]['total'];
        } else {
            $result['extralaboral'][$id]['calificacion_a'] = 0;
        }
        // $query = "SELECT c.id,c.cuestionario, SUM(res.peso_item) bruto, c.factor_b
        // FROM datos_generales dg
        // INNER JOIN respuestas res ON dg.id = res.datos_personales_id
        // INNER JOIN cuestionario c ON c.id = res.cuestionario_id
        // INNER JOIN cuestionario_dimencion_dominio cdd ON cdd.cuestionario_id = c.id
        // INNER JOIN dimenciones dim ON dim.id = cdd.dimencion_id 
        // INNER JOIN dimencion_item di ON dim.id = di.dimencion_id 
        // INNER JOIN items i ON i.id = di.item_id AND i.id = res.item_id
        // WHERE dg.id = $id AND c.id in(2,3) AND cdd.cuestionario_id in(2,3) AND dim.cuestionario_id in(2,3)
        // GROUP BY c.id";
        $query = "SELECT SUM(peso_item) total FROM respuestas where cuestionario_id in(2, 3) and datos_personales_id = $id GROUP BY cuestionario_id;";
        $result['extralaboral'][$id]['b'] = $this->row($query);
        if ($result['extralaboral'][$id]['b'][1] != null ) {
            $result['extralaboral'][$id]['calificacion_b'] = $result['extralaboral'][$id]['b'][0]['total'];
            foreach ($result['extralaboral'][$id]['b'] as $extrataboral_b) {
                $suma += (int)$extrataboral_b['total'];
            }
            $result['extralaboral'][$id]['calificacion_b'] = ($suma / 512) * 100;
        } else {
            $result['extralaboral'][$id]['calificacion_b'] = 0;
        }

        $query = "SELECT AVG(peso_item) * 4 promedio FROM respuestas WHERE cuestionario_id = '4' AND datos_personales_id = $id AND item_id BETWEEN '252' AND '259';";
        $estres1 = $this->row($query)[0]['promedio'];
        $query = "SELECT AVG(peso_item) * 3 promedio FROM respuestas WHERE cuestionario_id = '4' AND datos_personales_id = $id AND item_id BETWEEN '260' AND '263';";
        $estres2 = $this->row($query)[0]['promedio'];
        $query = "SELECT AVG(peso_item) * 2 promedio FROM respuestas WHERE cuestionario_id = '4' AND datos_personales_id = $id AND item_id BETWEEN '264' AND '273';";
        $estres3 = $this->row($query)[0]['promedio'];
        $query = "SELECT AVG(peso_item) promedio FROM respuestas WHERE cuestionario_id = '4' AND datos_personales_id = $id AND item_id BETWEEN '274' AND '282';";
        $estres4 = $this->row($query)[0]['promedio'];
        $result['estres'][$id]['dimenciones'] = (($estres1 + $estres2 + $estres3 + $estres4) / 61.16) * 100;
        return $result;
    }

    private function verRiesgo($puntaje, $tipo, $key, $forma)
    {
        if ($tipo == 'dimencion') {
            switch ($key) {
                case 1:
                    if ($puntaje >= 0.0 && $puntaje <= 3.8) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 3.9 && $puntaje <= 15.4) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 15.5 && $puntaje <= 30.8) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 30.9 && $puntaje <= 46.2) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 46.3 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 2:
                    if ($puntaje >= 0.0 && $puntaje <= 5.4) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 5.5 && $puntaje <= 16.1) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 16.2 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 37.5) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 37.6 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 3:
                    if ($puntaje >= 0.0 && $puntaje <= 10.0) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 10.1 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 40.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 40.1 && $puntaje <= 55.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 55.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 4:
                    if ($puntaje >= 0.0 && $puntaje <= 13.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 14.0 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 33.3) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 33.4 && $puntaje <= 47.2) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 47.3 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 5:
                    if ($puntaje >= 0.0 && $puntaje <= 0.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 1.0 && $puntaje <= 10.7) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 10.8 && $puntaje <= 21.4) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 21.5 && $puntaje <= 39.3) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 39.4 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 6:
                    if ($puntaje >= 0.0 && $puntaje <= 0.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 1.0 && $puntaje <= 16.7) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 16.8 && $puntaje <= 33.3) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 33.4 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 7:
                    if ($puntaje >= 0.0 && $puntaje <= 12.5) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 12.6 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 37.5) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 37.6 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 8:
                    if ($puntaje >= 0.0 && $puntaje <= 0.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 1.0 && $puntaje <= 6.3) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 6.4 && $puntaje <= 18.8) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 18.9 && $puntaje <= 31.3) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 31.4 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 9:
                    if ($puntaje >= 0.0 && $puntaje <= 8.3) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 8.4 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 41.7) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 41.8 && $puntaje <= 58.3) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 58.4 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 10:
                    if ($puntaje >= 0.0 && $puntaje <= 14.6) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 14.7 && $puntaje <= 22.9) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 23.0 && $puntaje <= 31.3) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 31.4 && $puntaje <= 39.6) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 39.7 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 11:
                    if ($puntaje >= 0.0 && $puntaje <= 16.7) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 16.8 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 33.3) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 33.4 && $puntaje <= 47.2) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 47.3 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 12:
                    if ($puntaje >= 0.0 && $puntaje <= 25.0) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 33.3) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 33.4 && $puntaje <= 45.8) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 45.9 && $puntaje <= 54.2) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 54.3 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 13:
                    if ($puntaje >= 0.0 && $puntaje <= 18.8) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 18.9 && $puntaje <= 31.3) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 31.4 && $puntaje <= 43.8) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 43.9 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 14:
                    if ($puntaje >= 0.0 && $puntaje <= 37.5) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 37.6 && $puntaje <= 54.2) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 54.3 && $puntaje <= 66.7) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 66.8 && $puntaje <= 79.2) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 79.3 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 15:
                    if ($puntaje >= 0.0 && $puntaje <= 60.0) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 60.1 && $puntaje <= 70.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 70.1 && $puntaje <= 80.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 80.1 && $puntaje <= 90.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 90.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 16:
                    if ($puntaje >= 0.0 && $puntaje <= 15.0) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 15.1 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 35.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 35.1 && $puntaje <= 45.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 45.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 17:
                    if ($puntaje >= 0.0 && $puntaje <= 8.3) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 8.4 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 33.3) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 33.4 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 18:
                    if ($puntaje >= 0.0 && $puntaje <= 0.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 1.0 && $puntaje <= 5.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 5.1 && $puntaje <= 10.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 10.1 && $puntaje <= 20.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 20.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 19:
                    if ($puntaje >= 0.0 && $puntaje <= 4.2) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 4.3 && $puntaje <= 16.7) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 16.8 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 37.5) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 37.6 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 20:
                    if ($puntaje >= 0.0 && $puntaje <= 3.8) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 3.9 && $puntaje <= 13.5) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 13.6 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 38.5) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 38.6 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 21:
                    if ($puntaje >= 0.0 && $puntaje <= 6.3) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 6.4 && $puntaje <= 14.6) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 14.7 && $puntaje <= 27.1) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 27.2 && $puntaje <= 37.5) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 37.6 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 22:
                    if ($puntaje >= 0.0 && $puntaje <= 5.0) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 5.1 && $puntaje <= 20.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 20.1 && $puntaje <= 30.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 30.1 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 24:
                    if ($puntaje >= 0.0 && $puntaje <= 0.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 1.0 && $puntaje <= 5.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 5.1 && $puntaje <= 15.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 15.1 && $puntaje <= 30.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 30.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 25:
                    if ($puntaje >= 0.0 && $puntaje <= 0.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 1.0 && $puntaje <= 16.7) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 16.8 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 26:
                    if ($puntaje >= 0.0 && $puntaje <= 16.7) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 16.8 && $puntaje <= 33.3) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 33.4 && $puntaje <= 41.7) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 41.8 && $puntaje <= 58.3) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 58.4 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 27:
                    if ($puntaje >= 0.0 && $puntaje <= 12.5) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 12.6 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 37.5) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 37.6 && $puntaje <= 56.3) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 56.4 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 28:
                    if ($puntaje >= 0.0 && $puntaje <= 33.3) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 33.4 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 66.7) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 66.8 && $puntaje <= 75.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 75.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 29:
                    if ($puntaje >= 0.0 && $puntaje <= 22.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 23.0 && $puntaje <= 31.3) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 31.4 && $puntaje <= 39.6) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 39.7 && $puntaje <= 47.9) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 48.0 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 30:
                    if ($puntaje >= 0.0 && $puntaje <= 19.4) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 19.5 && $puntaje <= 27.8) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 27.9 && $puntaje <= 38.9) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 39.0 && $puntaje <= 47.2) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 47.3 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 31:
                    if ($puntaje >= 0.0 && $puntaje <= 16.7) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 16.8 && $puntaje <= 33.3) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 33.4 && $puntaje <= 41.7) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 41.8 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 32:
                    if ($puntaje >= 0.0 && $puntaje <= 12.5) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 12.6 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 31.3) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 31.4 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 34:
                    if ($puntaje >= 0.0 && $puntaje <= 50.0) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 65.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 65.1 && $puntaje <= 75.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 75.1 && $puntaje <= 85.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 85.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 36:
                    if ($puntaje >= 0.0 && $puntaje <= 25.0) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 37.5) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 37.6 && $puntaje <= 45.8) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 45.9 && $puntaje <= 58.3) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 58.4 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 37:
                    if ($puntaje >= 0.0 && $puntaje <= 0.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 1.0 && $puntaje <= 6.3) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 6.4 && $puntaje <= 12.5) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 12.6 && $puntaje <= 18.8) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 18.9 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 38:
                    if ($puntaje >= 0.0 && $puntaje <= 0.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 1.0 && $puntaje <= 12.5) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 12.6 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 37.5) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 37.6 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 39:
                    if ($puntaje >= 0.0 && $puntaje <= 6.3) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 6.4 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 37.5) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 37.6 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 40:
                    if ($puntaje >= 0.0 && $puntaje <= 8.3) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 8.4 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 33.3) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 33.4 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 41:
                    if ($puntaje >= 0.0 && $puntaje <= 0.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 1.0 && $puntaje <= 10.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 10.1 && $puntaje <= 20.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 20.1 && $puntaje <= 30.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 30.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 42:
                    if ($puntaje >= 0.0 && $puntaje <= 8.3) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 8.4 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 33.3) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 33.4 && $puntaje <= 50.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 43:
                    if ($puntaje >= 0.0 && $puntaje <= 5.6) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 5.7 && $puntaje <= 11.1) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 11.2 && $puntaje <= 13.9) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 14.0 && $puntaje <= 22.2) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 22.3 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 44:
                    if ($puntaje >= 0.0 && $puntaje <= 8.3) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 8.4 && $puntaje <= 16.7) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 16.8 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 41.7) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 41.8 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
                case 45:
                    if ($puntaje >= 0.0 && $puntaje <= 0.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 1.0 && $puntaje <= 12.5) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 12.6 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 43.8) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 43.9 && $puntaje <= 100) {
                        $riesgo = "Riesgo Muy Alto";
                    }
                    break;
            }
        } elseif ($tipo == 'dominio') {
            switch ($key) {
                case 1:
                    if ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 0.0 && $puntaje <= 9.1))) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 9.2 && $puntaje <= 17.7))) {
                        $riesgo = "Riesgo bajo";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 17.8 && $puntaje <= 25.6))) {
                        $riesgo = "Riesgo Medio";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 25.7 && $puntaje <= 34.8))) {
                        $riesgo = "Riesgo Medio";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 34.9 && $puntaje <= 100))) {
                        $riesgo = "Riesgo Medio";
                    }
                    break;
                case 2:
                    if ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 0.0 && $puntaje <= 10.7))) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 10.8 && $puntaje <= 19.0))) {
                        $riesgo = "Riesgo bajo";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 19.1 && $puntaje <= 29.8))) {
                        $riesgo = "Riesgo Medio";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 29.9 && $puntaje <= 40.5))) {
                        $riesgo = "Riesgo Medio";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 40.6 && $puntaje <= 100))) {
                        $riesgo = "Riesgo Medio";
                    }
                    break;
                case 3:
                    if ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 0.0 && $puntaje <= 28.5))) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 28.6 && $puntaje <= 35.0))) {
                        $riesgo = "Riesgo bajo";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 35.1 && $puntaje <= 41.5))) {
                        $riesgo = "Riesgo Medio";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 41.6 && $puntaje <= 47.5))) {
                        $riesgo = "Riesgo Medio";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 47.6 && $puntaje <= 100))) {
                        $riesgo = "Riesgo Medio";
                    }
                    break;
                case 4:
                    if ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 0.0 && $puntaje <= 4.5))) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 4.6 && $puntaje <= 11.4))) {
                        $riesgo = "Riesgo bajo";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 11.5 && $puntaje <= 20.5))) {
                        $riesgo = "Riesgo Medio";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 20.6 && $puntaje <= 29.5))) {
                        $riesgo = "Riesgo Medio";
                    } elseif ((($forma == 'forma_a' || $forma == 'forma_b') && ($puntaje >= 29.6 && $puntaje <= 100))) {
                        $riesgo = "Riesgo Medio";
                    }
                    break;
            }
        } elseif ($tipo == 'calificacion') {
            switch ($forma) {
                case 'forma_a':
                    if ($puntaje >= 0.0 && $puntaje <= 19.7) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 19.8 && $puntaje <= 25.8) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 25.9 && $puntaje <= 31.5) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 31.6 && $puntaje <= 38.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 38.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Alto";
                    }
                    break;
                case 'forma_b':
                    if ($puntaje >= 0.0 && $puntaje <= 20.6) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 20.7 && $puntaje <= 26.0) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 26.1 && $puntaje <= 31.2) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 31.3 && $puntaje <= 38.7) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 38.8 && $puntaje <= 100) {
                        $riesgo = "Riesgo Alto";
                    }
                    break;
                case 'extralaboral_a':
                    if ($puntaje >= 0.0 && $puntaje <= 18.8) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 18.9 && $puntaje <= 24.4) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 24.5 && $puntaje <= 29.5) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 29.6 && $puntaje <= 35.4) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 35.5 && $puntaje <= 100) {
                        $riesgo = "Riesgo Alto";
                    }
                    break;
                case 'extralaboral_b':
                    if ($puntaje >= 0.0 && $puntaje <= 19.9) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 20.0 && $puntaje <= 24.8) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 24.9 && $puntaje <= 29.5) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 29.6 && $puntaje <= 35.4) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 35.5 && $puntaje <= 100) {
                        $riesgo = "Riesgo Alto";
                    }
                    break;
                case 'estres_a':
                    if ($puntaje >= 0.0 && $puntaje <= 7.8) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 7.9 && $puntaje <= 12.6) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 12.7 && $puntaje <= 17.7) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 17.8 && $puntaje <= 25.0) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 25.1 && $puntaje <= 100) {
                        $riesgo = "Riesgo Alto";
                    }
                    break;
                case 'estres_b':
                    if ($puntaje >= 0.0 && $puntaje <= 6.5) {
                        $riesgo = "Sin riesgo o riesgo despreciable";
                    } elseif ($puntaje >= 6.6 && $puntaje <= 11.8) {
                        $riesgo = "Riesgo Bajo";
                    } elseif ($puntaje >= 11.9 && $puntaje <= 17.0) {
                        $riesgo = "Riesgo Medio";
                    } elseif ($puntaje >= 17.1 && $puntaje <= 23.4) {
                        $riesgo = "Riesgo Alto";
                    } elseif ($puntaje >= 23.5 && $puntaje <= 100) {
                        $riesgo = "Riesgo Alto";
                    }
                    break;
            }
        }
        return $riesgo;
    }

    private function informeMasivo($datos)
    {
        $fechas = ($datos['fecha_inicial'] != '' && $datos['fecha_final'] != '') ? "WHERE fecha BETWEEN '" . $datos['fecha_inicial'] . "' AND '" . $datos['fecha_final'] . "' ": '';
        $query = "SELECT * FROM datos_generales $fechas ";
        unset($datos['metodo'], $datos['fecha_inicial'], $datos['fecha_final']);
        foreach ($datos as $key => $dato) {
            if ($dato != '') {
                $query .= "AND $key = '$dato' ";
            }
        }
        substr($query, 3, 0);
        $resultado['datos_generales'] = $this->row($query);
        $cabeceras = $this->cabeceras();
        $ruta = '../../public/archivos/informes/masivo.csv';
        $fp = fopen($ruta, 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado['datos_generales'] as $campos) {
            $datosInforme = $this->datosInformeMasivo($campos['id']);
            $array[1] = $campos['fecha'];
            $array[2] = explode('-', $array[1])[0];
            $array[3] = $campos['cedula'];
            $array[4] = $campos['nombre_completo'];
            $array[5] = ($campos['sexo'] == 'M') ? 'Masculino' : 'Femenino';
            $array[6] = $campos['anio_nacimiento'];
            $array[7] = $campos['estado_civil'];
            $array[8] = $campos['ultimo_nivel_estudios'];
            $array[9] = $campos['ocupacion_profesion'];
            $array[10] = explode('-', $campos['lugar_residencia'])[0];
            $array[11] = explode('-', $campos['lugar_residencia'])[1];
            $array[12] = $campos['estrato'];
            $array[13] = $campos['tipo_vivienda'];
            $array[14] = $campos['cantidad_personas_dependientes'];
            $array[15] = explode('-', $campos['lugar_trabajo'])[0];
            $array[16] = explode('-', $campos['lugar_trabajo'])[1];
            $array[17] = $campos['antiguedad_empresa'];
            $array[18] = $campos['cargo'];
            $array[19] = $campos['tipo_cargo'];
            $array[20] = $campos['antiguedad_cargo'];
            $array[21] = $campos['nombre_area'];
            $array[22] = $campos['tipo_contrato'];
            $array[23] = $campos['horas_diarias'];
            $array[24] = $campos['tipo_salario'];
            if (isset($datosInforme['forma_a'][$campos['id']]['dimenciones'][0])) {
                $item = 24;
                $contador = 24;
                $atencion = 18;
                foreach ($datosInforme['forma_a'][$campos['id']]['dimenciones'] as $key  => $dimencion) {
                    $array[++$item.'forma_a' . $dimencion['dimencion']] = number_format($dimencion['puntaje_transformado_dim'], 1);
                    ++$contador;
                    $array[++$item.'forma_a' . $dimencion['dimencion']] = $this->verRiesgo(number_format($dimencion['puntaje_transformado_dim'], 1), 'dimencion', $dimencion['id'], 'forma_a', 'sin');
                    ++$contador;
                    if((($contador == 31) && ($datosInforme['forma_a'][$campos['id']]['dimenciones'][3]['dimencion'] != 'Relaci\u00f3n con los colaboradores (subordinados)')) || (($contador == 48) && ($datosInforme['forma_a'][$campos['id']]['dimenciones'][10]['dimencion'] != 'Demandas emocionales'))){
                        $array[++$item.'forma_a'.(($contador != 30) ? 'Demandas emocionales' : 'Relación con los colaboradores')] = '';
                        ++$contador;
                        $array[++$item.'forma_a'.(($contador != 30) ? 'Demandas emocionales' : 'Relación con los colaboradores')] = '';
                        ++$contador;
                        $atencion = 15;
                    }
                    foreach ($datosInforme['forma_a'][$campos['id']]['dominios'] as $dominio) {
                        if (($key == 3 || $key == 8 || $key == 16 || $key == $atencion) && ($dominio['dominio'] == $dimencion['dominio'])) {
                            $array[++$item.'num_forma_a' . $dominio['dominio']] = number_format($dominio['puntaje_transformado_dom'], 1);
                            ++$contador;
                            $array[++$item.'ries_forma_a' . $dominio['dominio']] = $this->verRiesgo(number_format($dominio['puntaje_transformado_dom'], 1), 'dominio', $dominio['id'], 'forma_a', 'sin');
                            ++$contador;
                        }
                    }
                }
                $array[++$item.'calificacion_a'] = number_format($datosInforme['forma_a'][$campos['id']]['calificacion'][0]['putaje_transformado_calificacion'], 1);
                $array[++$item.'riesgo_a'] = $this->verRiesgo(number_format($datosInforme['forma_a'][$campos['id']]['calificacion'][0]['putaje_transformado_calificacion'], 1), 'calificacion', $key, 'forma_a', 'sin');
            } else {
                for ($i = 25; $i <= 72; $i++) {
                    $array[$i.'forma_a'] = '';
                }
            }
            if (isset($datosInforme['forma_b'][$campos['id']]['dimenciones'][0])) {
                $item = 72;
                $contador = 72;
                $atencion = 15;
                foreach ($datosInforme['forma_b'][$campos['id']]['dimenciones'] as $key  => $dimencion) {
                    $array[++$item.'forma_b' . $dimencion['dimencion']] = number_format($dimencion['puntaje_transformado_dim'], 1);
                    ++$contador;
                    $array[++$item.'forma_b' . $dimencion['dimencion']] = $this->verRiesgo(number_format($dimencion['puntaje_transformado_dim'], 1), 'dimencion', $dimencion['id'], 'forma_b', 'sin');
                    ++$contador;
                    if((($item == 95) && ($datosInforme['forma_b'][$campos['id']]['dimenciones'][10]['dimencion'] != 'Demandas emocionales'))){
                        $array[++$item.'forma_bDemandas emocionales'.$contador] = '';
                        ++$contador;
                        $array[++$item.'forma_bDemandas emocionales'.$contador] = '';
                        ++$contador;
                        $atencion = 15;
                    }
                    foreach ($datosInforme['forma_b'][$campos['id']]['dominios'] as $dominio) {
                        if (($key == 2 || $key == 7 || $key == 13 || $key == $atencion) && ($dominio['dominio'] == $datosInforme['forma_b'][$campos['id']]['dimenciones'][$key - 1]['dominio'])) {
                            $array[++$item.'num_forma_b' . $dominio['dominio']] = number_format($dominio['puntaje_transformado_dom'], 1);
                            ++$contador;
                            $array[++$item.'ries_forma_b' . $dominio['dominio']] = $this->verRiesgo(number_format($dominio['puntaje_transformado_dom'], 1), 'dominio', $dominio['id'], 'forma_b', 'sin');
                            ++$contador;
                        }
                    }
                }
                $array[++$item.'calificacion_b'] = number_format($datosInforme['forma_b'][$campos['id']]['calificacion'][0]['putaje_transformado_calificacion'], 1);
                $array[++$item.'riesgo_b'] = $this->verRiesgo(number_format($datosInforme['forma_b'][$campos['id']]['calificacion'][0]['putaje_transformado_calificacion'], 1), 'calificacion', $key, 'forma_b', 'sin');
            } else {
                for ($i = 73; $i <= 114; $i++) {
                    $array['forma_b' . $i] = '';
                }
            }
            if (isset($datosInforme['extralaboral'][$campos['id']]['dimenciones'][0])) {
                $item = 114;
                foreach ($datosInforme['extralaboral'][$campos['id']]['dimenciones'] as $key  => $dimencion) {
                    $array[++$item.'extralaboral'.$dimencion['dimencion']] = number_format($dimencion['puntaje_transformado_dim'], 1);
                    $array[++$item.'extralaboral'.$dimencion['dimencion']] = $this->verRiesgo(number_format($dimencion['puntaje_transformado_dim'], 1), 'dimencion', $dimencion['id'], 'extralaboral', 'sin');
                }
                if ($datosInforme['extralaboral'][$campos['id']]['calificacion_a'] != 0) {
                    $array[++$item.'extra_a'] = substr($datosInforme['extralaboral'][$campos['id']]['calificacion_a'], 0, strpos($datosInforme['extralaboral'][$campos['id']]['calificacion_a'], '.') + 2);
                    $array[++$item.'extra_a'] = $this->verRiesgo(substr($datosInforme['extralaboral'][$campos['id']]['calificacion_a'], 0, strpos($datosInforme['extralaboral'][$campos['id']]['calificacion_a'], '.') + 2), 'calificacion', $key, 'extralaboral_a', 'sin');
                    if ($datosInforme['estres'][$campos['id']]['dimenciones'] != null) {
                        $array[131] = substr($datosInforme['estres'][$campos['id']]['dimenciones'], 0, strpos($datosInforme['estres'][$campos['id']]['dimenciones'], '.') + 2);
                        $array[132] = $this->verRiesgo(substr($datosInforme['estres'][$campos['id']]['dimenciones'], 0, strpos($datosInforme['estres'][$campos['id']]['dimenciones'], '.') + 2), 'calificacion', $key, 'estres_a', 'sin');
                    }
                } else {
                    $array[++$item.'extra_b'] = substr($datosInforme['extralaboral'][$campos['id']]['calificacion_b'], 0, strpos($datosInforme['extralaboral'][$campos['id']]['calificacion_b'], '.') + 2);
                    $array[++$item.'extra_b'] = $this->verRiesgo(substr($datosInforme['extralaboral'][$campos['id']]['calificacion_b'], 0, strpos($datosInforme['extralaboral'][$campos['id']]['calificacion_b'], '.') + 2), 'calificacion', $key, 'extralaboral_b', 'sin');
                    if ($datosInforme['estres'][$campos['id']]['dimenciones'] != null) {
                        $array[131] = substr($datosInforme['estres'][$campos['id']]['dimenciones'], 0, strpos($datosInforme['estres'][$campos['id']]['dimenciones'], '.') + 2);
                        $array[132] = $this->verRiesgo(substr($datosInforme['estres'][$campos['id']]['dimenciones'], 0, strpos($datosInforme['estres'][$campos['id']]['dimenciones'], '.') + 2), 'calificacion', $key, 'estres_b', 'sin');
                    }
                }
            } else {
                for ($i = 115; $i <= 130; $i++) {
                    $array[$i] = '';
                }
            }
            if ($datosInforme['estres'][$campos['id']]['dimenciones'] == null) {
                $array[131] = '';
                $array[132] = '';
            }
            // ksort($array);
            fputcsv($fp, $array, ';');
            $array = array();
        }
        fclose($fp);
        return $ruta;
    }

    private function cabeceras()
    {
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
        return $cabeceras;
    }
}
