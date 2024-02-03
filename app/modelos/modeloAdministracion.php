<?php
include_once '../../config/conect.php';

class modeloAdministracion extends conexion
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

    private function obtenerCuestionarios($datos)
    {
        $query = "SELECT * FROM cuestionario;";
        $resultado = $this->row($query);
        return $resultado;
    }
}
