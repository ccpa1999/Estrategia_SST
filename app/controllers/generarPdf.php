<?php 
require '../../vendor/autoload.php';

use Dompdf\Dompdf;


class GenerarPDF
{

    var $dompdf;

    public function __construct($plantilla)
    {
        $this->dompdf = new Dompdf;
        echo $this->formatoUnitario($plantilla);
    }

    /**
     * Funcion crea el certificado de un usuario en un pdf
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $ruta: Devuelve un string con la ruta de descarga del certificado
     */

    public function formatoUnitario($plantilla)
    {
        $this->dompdf->loadHtml($plantilla);
        $this->dompdf->setPaper(array(0, 5, 600, 800), 'portrait');
        $this->dompdf->render();
        $ruta = '../../public/archivos/informes/Individual.pdf';

        $salida = $this->dompdf->output();
        file_put_contents($ruta, $salida);
        return $ruta;
    }
}
