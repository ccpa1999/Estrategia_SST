<?php
class conexion extends mysqli{

    var $mysqli;

    function __construct()
    {
        $this->conexion();
    }

    function conexion() {

        // $servidor = "127.0.0.1:3307";
        $servidor = "127.0.0.1";
        $usuario = "root";
        $clave = "";
        $database = "biefrp";

        /*$usuario = "contac";
        $clave = "";
        $database = "fianza_produccion";*/

        $this->conectar($servidor, $usuario, $clave, $database);
    }

    function conectar($servidor, $usuario, $clave, $database) {
        $this->mysqli = new mysqli($servidor, $usuario, $clave, $database);
        @mysqli_query($this->mysqli,"SET NAMES 'utf8'");
        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

    public function ejecutar($sentencia) {
        // try {
            $ejecuta = $this->mysqli->query($sentencia);
        // } catch (Exception $e) {
        //     $ejecuta = "false";
        // }
        return $ejecuta;
    }

    public function ejecutar2($sentencia) {
        $ejecuta = $this->ejecutar($sentencia);
        $resultado = $this->mysqli->affected_rows;
        return $resultado;
        $this->cerrar($ejecuta);

    }

     public function ejecutar3($sentencia) {
        $ejecuta = $this->mysqli->multi_query($sentencia) or die($this->mysqli->error());
        $resultado = $this->mysqli->affected_rows;
        return $resultado;
        $this->cerrar($ejecuta);
    }

    public function obtenerId($sentencia) {
        $ejecuta = $this->ejecutar($sentencia) or die($this->mysqli->error());
        $resultado = mysqli_insert_id($this->mysqli);
        return $resultado;
        $this->cerrar($ejecuta);
    }


    function exec($sentencia, $params = Array()) {
        $array = array();
        $ejecuta = $this->ejecutar2($sentencia);
        $i = 0;
        while ($fila = $ejecuta->fetch_assoc()) {
            $array[$i] = $fila;
            $i++;
        }
        return $array;
    }

    public function row($sentencia) {
        $array = array();
        $ejecuta = $this->ejecutar($sentencia);
        $i = 0;
        while ($fila = $ejecuta->fetch_assoc()) {
            $array[$i] = $fila;
            $i++;
        }
        return $array;
    }

    public function rowNumerico($sentencia) {
        $array = array();
        $ejecuta = $this->ejecutar($sentencia);
        while ($fila = $ejecuta->fetch_array()) {
            $array = $fila;
        }
        return $array;
    }

    function totalizar($sentencia) {
        $ejecuta = $this->ejecutar($sentencia);
        $total = $ejecuta->num_rows();
        return $total;
    }

    function obtenerUltimoId() {
        $id = $this->mysqli->insert_id;
        return $id;
    }

    function ImportarExcel($tbl, $archivo) {
        try {
            $sentencia = "LOAD DATA INFILE '" . $archivo . "'
					  INTO TABLE " . $tbl . "
					  FIELDS TERMINATED BY ';'
					  LINES TERMINATED BY '\r\n'
					  IGNORE 1 LINES";
            $this->ejecutar($sentencia);
            return 1;
        } catch (Exception $e) {
            throw $e;
            return 0;
        }
    }

    function cerrar($ejecuta) {
        $ejecuta->free();
        $this->mysqli->close();
    }

    public function getConexion() {
        return $this->mysqli->insert_id;
    }

}
