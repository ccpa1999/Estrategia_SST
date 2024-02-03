<?php
include_once '../../config/conect.php';
include_once '../../app/modelos/modeloAdministracion.php';

use League\Csv\Writer;

$datos = (empty($_POST)) ? $_GET : $_POST;
$carteras = new administracionController($datos);

class administracionController
{

    var $claseAdministracion;

    public function __construct($datos)
    {
        $this->claseAdministracion = new modeloAdministracion();
        $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'dashboard';
        $metodo = $datos['metodo'];
        $this->$metodo($datos);
    }

    public function dashboard($datos)
    {
        $data = $this->claseAdministracion->controlador($datos);
        echo json_encode($data);
    }
    
    public function obtenerCuestionarios($datos){
        $data = $this->claseAdministracion->controlador($datos);
        echo json_encode($data);
    }
}
