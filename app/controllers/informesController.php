<?php
include_once '../../config/conect.php';
include_once '../../app/modelos/modeloInformes.php';
include_once 'generarPdf.php';

use Dompdf\Dompdf;
use League\Csv\Writer;

$datos = (empty($_POST)) ? $_GET : $_POST;
$carteras = new informesController($datos);

class informesController
{

    var $claseInformes;

    public function __construct($datos)
    {
        $this->claseInformes = new modeloInformes();
        $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'dashboard';
        $metodo = $datos['metodo'];
        $this->$metodo($datos);
    }

    public function generarInformes($datos)
    {
        $resultado['ruta'] = $this->claseInformes->controlador($datos);
        echo json_encode($resultado);
    }

    public function panelFiltros($datos)
    {
        $resultado = $this->claseInformes->controlador($datos);
        echo json_encode($resultado);
    }

    public function guardarFiltros($datos)
    {
        $resultado = $this->claseInformes->controlador($datos);
        echo json_encode($resultado);
    }

    public function filtrar($datos)
    {
        $resultado = $this->claseInformes->controlador($datos);
        echo json_encode($resultado);
    }

    public function informeMasivo($datos)
    {
        $resultado = $this->claseInformes->controlador($datos);
        echo json_encode($resultado);
    }

    public function obtenerInformacion($datos)
    {
        $resultado = $this->claseInformes->controlador($datos);
        echo json_encode($resultado);
    }

    public function generarPdf($datos)
    {
        $pdf = new GenerarPDF($datos['plantilla']);
        $ruta = $pdf->formatoUnitario($datos['plantilla']);
        echo $ruta;
    }
}
