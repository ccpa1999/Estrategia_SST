<?php
include_once '../../config/conect.php';

class modeloDatosPersonales extends conexion
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

    private function obtenerDatosGenerales($datos)
    {
        $query = "SELECT * FROM datos_generales;";
        $result = $this->row($query);
        return $result;
    }

    private function insertarDatosGenerales($datos)
    {
        $id = (isset($datos['id']) && $datos['id'] != '') ? $datos['id'] : 'NULL';
        $query = "INSERT INTO datos_generales(id,cedula, nombre_empresa, fecha, nombre_completo, sexo, anio_nacimiento, estado_civil, ultimo_nivel_estudios, ocupacion_profesion, lugar_residencia, 
        estrato, tipo_vivienda, cantidad_personas_dependientes, lugar_trabajo, antiguedad_empresa, cargo, tipo_cargo, antiguedad_cargo, nombre_area, tipo_contrato, 
        horas_diarias, tipo_salario)"
            . "VALUES($id,$datos[cedula], '$datos[nombre_empresa]','$datos[fecha]','$datos[nombre_completo]', '$datos[sexo]', '$datos[anio_nacimiento]', '$datos[estado_civil]', '$datos[ultimo_nivel_estudios]', '$datos[ocupacion_profesion]', '" . $datos['ciudad_vive'] . '-' . $datos['departamento_vive'] . "',"
            . "'$datos[estrato]', '$datos[tipo_vivienda]', '$datos[cantidad_personas_dependientes]', '" . $datos['ciudad_labora'] . '-' . $datos['departamento_labora'] . "', '$datos[antiguedad_empresa]', '$datos[cargo]', '$datos[tipo_cargo]', '$datos[antiguedad_cargo]', '$datos[nombre_area]', '$datos[tipo_contrato]', '$datos[horas_diarias]', '$datos[tipo_salario]')"
            . "ON DUPLICATE KEY UPDATE fecha = '$datos[fecha]', nombre_empresa = '$datos[nombre_empresa]', nombre_completo = '$datos[nombre_completo]', sexo = '$datos[sexo]', anio_nacimiento = '$datos[anio_nacimiento]', estado_civil = '$datos[estado_civil]', ultimo_nivel_estudios = '$datos[ultimo_nivel_estudios]', ocupacion_profesion = '$datos[ocupacion_profesion]', lugar_residencia = '" . $datos['ciudad_vive'] . '-' . $datos['departamento_vive'] . "', 
            estrato = '$datos[estrato]', tipo_vivienda = '$datos[tipo_vivienda]', cantidad_personas_dependientes = '$datos[cantidad_personas_dependientes]', lugar_trabajo = '" . $datos['ciudad_labora'] . '-' . $datos['departamento_labora'] . "', antiguedad_empresa = '$datos[antiguedad_empresa]', cargo = '$datos[cargo]', tipo_cargo = '$datos[tipo_cargo]', antiguedad_cargo = '$datos[antiguedad_cargo]', nombre_area = '$datos[nombre_area]', tipo_contrato = '$datos[tipo_contrato]', 
            horas_diarias = '$datos[horas_diarias]', tipo_salario = '$datos[tipo_salario]';";
        $result = $this->ejecutar2($query);
        setcookie('id', $this->obtenerUltimoId());
        return $result;
    }

    private function panelDatosGenerales($datos)
    {
        $query = "SELECT * FROM datos_generales ORDER BY fecha DESC;";
        $resultado['datos'] = $this->row($query);
        $query = "SELECT * FROM filtros WHERE filtro != ''";
        $filtros = $this->row($query);
        foreach ($filtros as $filtro) {
            $query = "SELECT $filtro[campo] FROM datos_generales GROUP BY $filtro[campo] $filtro[filtro] $filtro[campo] $filtro[orden];";
            $resultado['filtros'][$filtro['campo']] = $this->row($query);
        }
        return $resultado;
    }

    private function busquedaCedula($datos)
    {
        $query = "SELECT * FROM datos_generales WHERE cedula = $datos[cedula]";
        $resultado = $this->row($query);
        return $resultado;
    }

    private function busquedaId($datos)
    {
        $query = "SELECT * FROM datos_generales WHERE id = $datos[id]";
        $resultado = $this->row($query);
        return $resultado;
    }

    private function eliminarId($datos)
    {
        $query = "DELETE FROM datos_generales WHERE id = $datos[id]";
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }
}
