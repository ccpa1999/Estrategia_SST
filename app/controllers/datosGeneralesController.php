<?php
include_once '../../config/conect.php';
include_once '../../app/modelos/modeloDatosGenerales.php';

use League\Csv\Writer;

$datos = (empty($_POST)) ? $_GET : $_POST;
$carteras = new datosPersonalesController($datos);

class datosPersonalesController
{

    var $claseDatosGenerales;

    public function __construct($datos)
    {
        $this->claseDatosGenerales = new modeloDatosPersonales();
        $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'dashboard';
        $metodo = $datos['metodo'];
        $this->$metodo($datos);
    }

    public function dashboard($datos)
    {
        $data = $this->claseDatosGenerales->controlador($datos);
        echo json_encode($data);
    }

    public function insertarDatosGenerales($datos)
    {
        $data = $this->claseDatosGenerales->controlador($datos);
        echo $data;
    }

    public function panelDatosGenerales($datos)
    {
        $data = $this->claseDatosGenerales->controlador($datos);
        echo json_encode($data);
    }

    public function busquedaCedula($datos){
        $data = $this->claseDatosGenerales->controlador($datos);
        echo json_encode($data);
    }

    public function busquedaId($datos){
        $data = $this->claseDatosGenerales->controlador($datos);
        echo json_encode($data);
    }

    public function eliminarId($datos){
        $data = $this->claseDatosGenerales->controlador($datos);
        echo json_encode($data);
    }
}
