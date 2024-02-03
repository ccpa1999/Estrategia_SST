<?php
include_once '../../config/conect.php';
include_once '../../app/modelos/modeloCuestionarios.php';

use League\Csv\Writer;

$datos = (empty($_POST)) ? $_GET : $_POST;
$carteras = new cuestionariosController($datos);

class cuestionariosController
{

    var $claseCuestionarios;

    public function __construct($datos)
    {
        $this->claseCuestionarios = new modeloCuestionarios();
        $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'dashboard';
        $metodo = $datos['metodo'];
        $this->$metodo($datos);
    }

    public function obtenerItems($datos)
    {
        $data = $this->claseCuestionarios->controlador($datos);
        if ((int)$datos['tipo'] == 1) {
            $datos = $this->ordenarIntralaboralesA($data);
        } elseif ((int)$datos['tipo'] == 2) {
            $datos = $this->ordenarIntralaboralesB($data);
        } elseif ((int)$datos['tipo'] == 3) {
            $datos = $this->ordenarExtralaborales($data);
        } elseif ((int)$datos['tipo'] == 4) {
            $datos = $this->ordenarEstres($data);
        }
        echo json_encode($datos);
    }

    public function ordenarIntralaboralesA($datos)
    {
        foreach ($datos as $dato) {
            if ($dato['id'] >= 0 && $dato['id'] <= 12) {
                $result['Las siguientes preguntas están relacionadas con las condiciones ambientales del(los) sitio(s) o lugar(es) donde habitualmente realiza su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 13 && $dato['id'] <= 15) {
                $result['Para responder a las siguientes preguntas piense en la cantidad de trabajo que usted tiene a cargo.'][] = $dato;
            } elseif ($dato['id'] >= 16 && $dato['id'] <= 21) {
                $result['Las siguientes preguntas están relacionadas con el esfuerzo mental que le exige su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 22 && $dato['id'] <= 30) {
                $result['Las siguientes preguntas están relacionadas con las responsabilidades y actividades que usted debe hacer en su trabajo'][] = $dato;
            } elseif ($dato['id'] >= 31 && $dato['id'] <= 38) {
                $result['Las siguientes preguntas están relacionadas con la jornada de trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 39 && $dato['id'] <= 47) {
                $result['Las siguientes preguntas están relacionadas con las decisiones y el control que le permite su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 48 && $dato['id'] <= 52) {
                $result['Las siguientes preguntas están relacionadas con cualquier tipo de cambio que ocurra en su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 53 && $dato['id'] <= 59) {
                $result['Las siguientes preguntas están relacionadas con la información que la empresa le ha dado sobre su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 60 && $dato['id'] <= 62) {
                $result['Las siguientes preguntas están relacionadas con la formación y capacitación que la empresa le facilita para hacer su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 63 && $dato['id'] <= 75) {
                $result['Las siguientes preguntas están relacionadas con el o los jefes con quien tenga más contacto.'][] = $dato;
            } elseif ($dato['id'] >= 76 && $dato['id'] <= 89) {
                $result['Las siguientes preguntas indagan sobre las relaciones con otras personas y el apoyo entre las personas de su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 90 && $dato['id'] <= 94) {
                $result['Las siguientes preguntas están relacionadas con la información que usted recibe sobre su rendimiento en el trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 95 && $dato['id'] <= 105) {
                $result['Las siguientes preguntas están relacionadas con la satisfacción, reconocimiento y la seguridad que le ofrece su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 106 && $dato['id'] <= 114) {
                $result['Las siguientes preguntas están relacionadas con la atención a clientes y usuarios.'][] = $dato;
            } elseif ($dato['id'] >= 115 && $dato['id'] <= 123) {
                $result['Las siguientes preguntas están relacionadas con las personas que usted supervisa o dirige.'][] = $dato;
            }
        }
        return $result;
    }

    public function ordenarIntralaboralesB($datos)
    {
        foreach ($datos as $dato) {
            if ($dato['id'] >= 124 && $dato['id'] <= 135) {
                $result['Las siguiente s preguntas están relacionadas con las condiciones ambientales del(los) sitio(s) o lugar(es) donde habitualmente realiza su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 136 && $dato['id'] <= 138) {
                $result['Para responder a las siguientes preguntas piense en la cantidad de trabajo que usted tiene a cargo.'][] = $dato;
            } elseif ($dato['id'] >= 139 && $dato['id'] <= 143) {//4
                $result['Las siguientes preguntas están relacionadas con el esfuerzo mental que le exige su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 144 && $dato['id'] <= 151) {//7
                $result['Las siguientes preguntas están relacionadas con la jornada de trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 152 && $dato['id'] <= 160) {//8
                $result['Las siguientes preguntas están relacionadas con las decisiones y el control que le permite su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 161 && $dato['id'] <= 163) {//2
                $result['Las siguientes preguntas están relacionadas con cualquier tipo de cambio que ocurra en su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 164 && $dato['id'] <= 168) {//4
                $result['Las siguientes preguntas están relacionadas con la información que la empresa le ha dado sobre su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 169 && $dato['id'] <= 171) {//2
                $result['Las siguientes preguntas están relacionadas con la formación y capacitación que la empresa le facilita para hacer su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 172 && $dato['id'] <= 184) {//12
                $result['Las siguientes preguntas están relacionadas con el o los jefes con quien tenga más contacto.'][] = $dato;
            } elseif ($dato['id'] >= 185 && $dato['id'] <= 196) {//11
                $result['Las siguientes preguntas indagan sobre las relaciones con otras personas y el apoyo entre las personas de su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 197 && $dato['id'] <= 201) {//4
                $result['Las siguientes preguntas están relacionadas con la información que usted recibe sobre su rendimiento en el trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 202 && $dato['id'] <= 211) {//9
                $result['Las siguientes preguntas están relacionadas con la satisfacción, reconocimiento y la seguridad que le ofrece su trabajo.'][] = $dato;
            } elseif ($dato['id'] >= 212 && $dato['id'] <= 220) {//8
                $result['Las siguientes preguntas están relacionadas con la atención a clientes y usuarios.'][] = $dato;
            }
        }
        return $result;
    }

    public function ordenarExtralaborales($datos)
    {
        foreach ($datos as $dato) {
            if ($dato['id'] >= 221 && $dato['id'] <= 233) {
                $result['Las siguientes preguntas están relacionadas con varias condiciones de la zona donde usted vive:'][] = $dato;
            } elseif ($dato['id'] >= 234 && $dato['id'] <= 251) {
                $result['Las siguientes preguntas están relacionadas con su vida fuera del trabajo:'][] = $dato;
            }
        }
        return $result;
    }

    public function ordenarEstres($datos){
        return $datos;
    }

    // public function ordenarIntralaborales($datos)
    // {
    //     foreach ($datos as $dato) {
    //         $result[$dato['dominio']][$dato['dimencion']][$dato['id']] = $dato;
    //     }
    //     return $result;
    // }

    public function insertarCuestionario($datos)
    {
        $data = $this->claseCuestionarios->controlador($datos);
        echo $data;
    }

    private function crearCookie($datos)
    {
        setcookie($datos['cookie'], $datos['valor'], [
            'expires' => time() + 86400,
            'path' => '/',
            'secure' => true,
            'samesite' => 'None',
        ]);
        echo $_COOKIE['aa'];
    }
}
