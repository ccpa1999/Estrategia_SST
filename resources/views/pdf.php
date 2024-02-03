<style>
    * {
        font-size: 12px;
    }

    .bg-gray {
        background-color: #bfbfbf;
        padding: 2px;
    }

    .w-100 {
        width: 100%;
    }

    .w-33 {
        width: 33%;
    }

    .w-50 {
        width: 50%;
    }

    .w-66 {
        width: 66%;
    }

    .text-center {
        text-align: center;
    }

    .bordered {
        border: black 1px solid;
    }

    .paginacion {
        color: gray;
        margin-left: 80%;
    }
</style>
<?php $id = $_POST['datos_generales'][0]['id'];

$dimencion_a = $_POST['evaluaciones']['forma_a'][$id]['dimenciones'];
$dominios_a = $_POST['evaluaciones']['forma_a'][$id]['dominios'];
$calificacion_a = $_POST['evaluaciones']['forma_a'][$id]['calificacion'];

$dimencion_b = $_POST['evaluaciones']['forma_b'][$id]['dimenciones'];
$dominios_b = $_POST['evaluaciones']['forma_b'][$id]['dominios'];
$calificacion_b = $_POST['evaluaciones']['forma_b'][$id]['calificacion'];

$dimencion_e = $_POST['evaluaciones']['extralaboral'][$id]['dimenciones'];
$calificacion_e = $_POST['evaluaciones']['extralaboral'][$id];

$calificacion_es = $_POST['evaluaciones']['estres'][$id]['dimenciones'];

function verRiesgo($puntaje, $tipo, $key, $forma)
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
                } elseif ($puntaje >= 37.6 && $puntaje <= 50.0) {
                    $riesgo = "Riesgo Alto";
                } elseif ($puntaje >= 50.1 && $puntaje <= 100) {
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
                if (($forma == 'forma_a' && $puntaje >= 0.0 && $puntaje <= 9.1) || ($forma == 'forma_b' && $puntaje >= 0.0 && $puntaje <= 8.3)) {
                    $riesgo = "Sin riesgo o riesgo despreciable";
                } elseif (($forma == 'forma_a' && $puntaje >= 9.2 && $puntaje <= 17.7) || ($forma == 'forma_b' && $puntaje >= 8.4 && $puntaje <= 17.5)) {
                    $riesgo = "Riesgo bajo";
                } elseif (($forma == 'forma_a' && $puntaje >= 17.8 && $puntaje <= 25.6) || ($forma == 'forma_b' && $puntaje >= 17.6 && $puntaje <= 26.7)) {
                    $riesgo = "Riesgo Medio";
                } elseif (($forma == 'forma_a' && $puntaje >= 25.7 && $puntaje <= 34.8) || ($forma == 'forma_b' && $puntaje >= 26.8 && $puntaje <= 38.3)) {
                    $riesgo = "Riesgo Medio";
                } elseif (($forma == 'forma_a' && $puntaje >= 34.9 && $puntaje <= 100) || ($forma == 'forma_b' && $puntaje >= 38.4 && $puntaje <= 100)) {
                    $riesgo = "Riesgo Medio";
                }
                break;
            case 2:
                if (($forma == 'forma_a' && $puntaje >= 0.0 && $puntaje <= 10.7) || ($forma == 'forma_b' && $puntaje >= 0.0 && $puntaje <= 19.4)) {
                    $riesgo = "Sin riesgo o riesgo despreciable";
                } elseif (($forma == 'forma_a' && $puntaje >= 10.8 && $puntaje <= 19.0) || ($forma == 'forma_b' && $puntaje >= 19.5 && $puntaje <= 26.4)) {
                    $riesgo = "Riesgo bajo";
                } elseif (($forma == 'forma_a' && $puntaje >= 19.1 && $puntaje <= 29.8) || ($forma == 'forma_b' && $puntaje >= 26.5 && $puntaje <= 34.7)) {
                    $riesgo = "Riesgo Medio";
                } elseif (($forma == 'forma_a' && $puntaje >= 29.9 && $puntaje <= 40.5) || ($forma == 'forma_b' && $puntaje >= 34.8 && $puntaje <= 43.1)) {
                    $riesgo = "Riesgo Medio";
                } elseif (($forma == 'forma_a' && $puntaje >= 40.6 && $puntaje <= 100) || ($forma == 'forma_b' && $puntaje >= 43.2 && $puntaje <= 100)) {
                    $riesgo = "Riesgo Medio";
                }
                break;
            case 3:
                if (($forma == 'forma_a' && $puntaje >= 0.0 && $puntaje <= 28.5) || ($forma == 'forma_b' && $puntaje >= 0.0 && $puntaje <= 26.9)) {
                    $riesgo = "Sin riesgo o riesgo despreciable";
                } elseif (($forma == 'forma_a' && $puntaje >= 28.6 && $puntaje <= 35.0) || ($forma == 'forma_b' && $puntaje >= 27.0 && $puntaje <= 33.3)) {
                    $riesgo = "Riesgo bajo";
                } elseif (($forma == 'forma_a' && $puntaje >= 35.1 && $puntaje <= 41.5) || ($forma == 'forma_b' && $puntaje >= 33.4 && $puntaje <= 37.8)) {
                    $riesgo = "Riesgo Medio";
                } elseif (($forma == 'forma_a' && $puntaje >= 41.6 && $puntaje <= 47.5) || ($forma == 'forma_b' && $puntaje >= 37.9 && $puntaje <= 44.2)) {
                    $riesgo = "Riesgo Medio";
                } elseif (($forma == 'forma_a' && $puntaje >= 47.6 && $puntaje <= 100) || ($forma == 'forma_b' && $puntaje >= 44.3 && $puntaje <= 100)) {
                    $riesgo = "Riesgo Medio";
                }
                break;
            case 4:
                if (($forma == 'forma_a' && $puntaje >= 0.0 && $puntaje <= 4.5) || ($forma == 'forma_b' && $puntaje >= 0.0 && $puntaje <= 2.5)) {
                    $riesgo = "Sin riesgo o riesgo despreciable";
                } elseif (($forma == 'forma_a' && $puntaje >= 4.6 && $puntaje <= 11.4) || ($forma == 'forma_b' && $puntaje >= 2.6 && $puntaje <= 10.0)) {
                    $riesgo = "Riesgo bajo";
                } elseif (($forma == 'forma_a' && $puntaje >= 11.5 && $puntaje <= 20.5) || ($forma == 'forma_b' && $puntaje >= 10.1 && $puntaje <= 17.5)) {
                    $riesgo = "Riesgo Medio";
                } elseif (($forma == 'forma_a' && $puntaje >= 20.6 && $puntaje <= 29.5) || ($forma == 'forma_b' && $puntaje >= 17.6 && $puntaje <= 27.5)) {
                    $riesgo = "Riesgo Medio";
                } elseif (($forma == 'forma_a' && $puntaje >= 29.6 && $puntaje <= 100) || ($forma == 'forma_b' && $puntaje >= 27.6 && $puntaje <= 100)) {
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
?>
<?php if ($dimencion_a != null) : ?>
    <div style="width: 90%;margin-left: 5%;font-family: Arial, Helvetica, Verdana;"><br><br><br>
        <h3 class="bg-gray text-center">
            INFORME DE RESULTADOS DEL CUESTIONARIO DE FACTORES DE RIESGO PSICOSOCIAL INTRALABORAL – FORMA A
        </h3><br>
        <p class="bg-gray text-center">
            <b>
                DATOS GENERALES DEL TRABAJADOR
            </b>
        </p>
        <table class="w-100">
            <tr>
                <td class="bg-gray w-50"><b>Nombre del trabajador:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_completo']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Número de identificación (ID):</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cedula']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Cargo:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cargo']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Departamento o sección:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_area']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Edad:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cedula']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Sexo:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['sexo']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Fecha de aplicación del cuestionario:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['fecha']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Nombre de la empresa:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_empresa']; ?></td>
            </tr>
        </table><br><br>
        <p class="bg-gray text-center">
            <b>
                DATOS DEL EVALUADOR
            </b>
        </p>
        <table class="w-100">
            <tr>
                <td class="bg-gray w-50"><b>Nombre del evaluador:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['nombre_completo']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Número de identificación (c.c.):</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cedula']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Profesión:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cargo']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Postgrado:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['nombre_area']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>No Tarjeta profesional*:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cedula']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>No. Licencia en salud ocupacional*:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['sexo']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Fecha de expedición de la licencia en salud ocupacional*:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['fecha']; 
                                                        ?></td>
            </tr>
        </table>
        <p>* Todo informe que carezca de estos datos no será válido.</p>
        <p class="paginacion">Página 1 de 3</p>
        <p style="margin-top: 320px;" class="bg-gray text-center"><b>RESULTADOS DEL CUESTIONARIO</b></p>
        <table class="w-100">
            <tr>
                <td style="width: 20%;" class="text-center bg-gray"><b>Dominios</b></td>
                <td style="width: 50%;" class="text-center bg-gray"><b>Dimensiones</b></td>
                <td style="width: 15%;" class="text-center bg-gray"><b>Puntaje (transformado)</b></td>
                <td style="width: 15%;" class="text-center bg-gray"><b>Nivel de riesgo</b></td>
            </tr>
            <tr>
                <td rowspan="4" style="width: 20%;" class="bg-gray">Liderazgo y relaciones sociales en el trabajo</td>
                <td style="width: 50%;" class="bg-gray">Características del liderazgo</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato1 = number_format(($dimencion_a[0]['id'] == 1) ? $dimencion_a[0]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato1, 'dimencion', 1, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td style="width: 50%;" class="bg-gray">Relaciones sociales en el trabajo</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato2 = number_format(($dimencion_a[1]['id'] == 2) ? $dimencion_a[1]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato2, 'dimencion', 2, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Retroalimentación del desempeño</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato3 = number_format(($dimencion_a[2]['id'] == 3) ? $dimencion_a[2]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato3, 'dimencion', 3, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Relación con los colaboradores (subordinados)</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato4 = number_format(($dimencion_a[3]['id'] == 4) ? $dimencion_a[3]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato4, 'dimencion', 4, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="bg-gray text-center"><b>LIDERAZGO Y RELACIONES SOCIALES EN EL TRABAJO</b></td>
                <td style="width: 15%;" class="bordered"><?php echo $dato5 = number_format(($dominios_a[0]['id'] == 1) ? $dominios_a[0]['puntaje_transformado_dom'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato5, 'dominio', 1, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td rowspan="5" style="width: 20%;" class="bg-gray">Control sobre el trabajo</td>
                <td style="width: 50%;" class="bg-gray">Claridad de rol</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato6 = number_format(($dimencion_a[4]['id'] == 5) ? $dimencion_a[4]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato6, 'dimencion', 5, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td style="width: 50%;" class="bg-gray">Capacitación</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato7 = number_format(($dimencion_a[5]['id'] == 6) ? $dimencion_a[5]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato7, 'dimencion', 6, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Participación y manejo del cambio</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato8 = number_format(($dimencion_a[6]['id'] == 7) ? $dimencion_a[6]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato8, 'dimencion', 7, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Oportunidades para el uso y desarrollo de habilidades y conocimientos</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato9 = number_format(($dimencion_a[7]['id'] == 8) ? $dimencion_a[7]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato9, 'dimencion', 8, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Control y autonomía sobre el trabajo</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato10 = number_format(($dimencion_a[8]['id'] == 9) ? $dimencion_a[8]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato10, 'dimencion', 9, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="bg-gray text-center"><b>CONTROL SOBRE EL TRABAJO</b></td>
                <td style="width: 15%;" class="bordered"><?php echo $dato11 = number_format(($dominios_a[1]['id'] == 2) ? $dominios_a[1]['puntaje_transformado_dom'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato11, 'dominio', 2, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td rowspan="8" style="width: 20%;" class="bg-gray">Demandas del trabajo</td>
                <td style="width: 50%;" class="bg-gray">Demandas ambientales y de esfuerzo físico</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato12 = number_format(($dimencion_a[9]['id'] == 10) ? $dimencion_a[9]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato12, 'dimencion', 10, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td style="width: 50%;" class="bg-gray">Demandas emocionales</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato13 = number_format(($dimencion_a[10]['id'] == 11) ? $dimencion_a[10]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato13, 'dimencion', 11, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Demandas cuantitativas</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato14 = number_format(($dimencion_a[11]['id'] == 12) ? $dimencion_a[11]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato14, 'dimencion', 12, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Influencia del trabajo sobre el entorno extralaboral</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato15 = number_format(($dimencion_a[12]['id'] == 13) ? $dimencion_a[12]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato15, 'dimencion', 13, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Exigencias de responsabilidad del cargo</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato16 = number_format(($dimencion_a[13]['id'] == 14) ? $dimencion_a[13]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato16, 'dimencion', 14, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Demandas de carga mental</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato17 = number_format(($dimencion_a[14]['id'] == 15) ? $dimencion_a[14]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato17, 'dimencion', 15, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Consistencia del rol</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato18 = number_format(($dimencion_a[15]['id'] == 16) ? $dimencion_a[15]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato18, 'dimencion', 16, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Demandas de la jornada de trabajo</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato19 = number_format(($dimencion_a[16]['id'] == 17) ? $dimencion_a[16]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato19, 'dimencion', 17, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="bg-gray text-center"><b>DEMANDAS DEL TRABAJO</b></td>
                <td style="width: 15%;" class="bordered"><?php echo $dato20 = number_format(($dominios_a[2]['id'] == 3) ? $dominios_a[2]['puntaje_transformado_dom'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato20, 'dominio', 3, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td rowspan="2" style="width: 20%;" class="bg-gray">Recompensas</td>
                <td style="width: 50%;" class="bg-gray">Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato21 = number_format(($dimencion_a[17]['id'] == 18) ? $dimencion_a[17]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato21, 'dimencion', 18, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td style="width: 50%;" class="bg-gray">Reconocimiento y compensación</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato22 = number_format(($dimencion_a[18]['id'] == 19) ? $dimencion_a[18]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato22, 'dimencion', 19, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="bg-gray text-center"><b>RECOMPENSAS</b></td>
                <td style="width: 15%;" class="bordered"><?php echo $dato23 = number_format(($dominios_a[3]['id'] == 4) ? $dominios_a[3]['puntaje_transformado_dom'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato21, 'dominio', 4, 'forma_a'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="bg-gray text-center"><b>TOTAL GENERAL FACTORES DE RIESGO <br> PSICOSOCIAL INTRALABORAL</b></td>
                <td style="width: 15%;" class="bordered"><?php echo $dato24 = number_format(($calificacion_a[0]['id'] == 10) ? $calificacion_a[0]['putaje_transformado_calificacion'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato24, 'calificacion', 1, 'forma_a'); ?></td>
            </tr>
        </table>
        <p class="paginacion">Página 2 de 3</p><br>
        <p class="bg-gray text-center"><b>INTERPRETACIÓN GENÉRICA DE LOS NIVELES DE RIESGO</b></p>
        <div style="padding: 9px;" class="bordered w-100">
            " Sin riesgo o riesgo despreciable: ausencia de riesgo o riesgo tan bajo que no amerita desarrollar actividades de
            intervención. Las dimensiones y dominios que se encuentren bajo esta categoría serán objeto de acciones o
            programas de promoción. <br>
            " Riesgo bajo: no se espera que los factores psicosociales que obtengan puntuaciones de este nivel estén
            relacionados con síntomas o respuestas de estrés significativas. Las dimensiones y dominios que se encuentren
            bajo esta categoría serán objeto de acciones o programas de intervención, a fin de mantenerlos en los niveles de
            riesgo más bajos posibles. <br>
            " Riesgo medio: nivel de riesgo en el que se esperaría una respuesta de estrés moderada. Las dimensiones y
            dominios que se encuentren bajo esta categoría ameritan observación y acciones sistemáticas de intervención
            para prevenir efectos perjudiciales en la salud. <br>
            " Riesgo alto: nivel de riesgo que tiene una importante posibilidad de asociación con respuestas de estrés alto y por
            tanto, las dimensiones y dominios que se encuentren bajo esta categoría requieren intervención en el marco de un
            sistema de vigilancia epidemiológica. <br>
            " Riesgo muy alto: nivel de riesgo con amplia posibilidad de asociarse a respuestas muy altas de estrés. Por
            consiguiente las dimensiones y dominios que se encuentren bajo esta categoría requieren intervención inmediata
            en el marco de un sistema de vigilancia epidemiológica.
        </div>
        <p class="bg-gray text-center"><b>OBSERVACIONES Y COMENTARIOS DEL EVALUADOR</b></p>
        <div style="padding: 9px; height: 100px;" class="bordered w-100">

        </div><br>
        <p class="bg-gray text-center"><b>RECOMENDACIONES PARTICULARES</b></p>
        <div style="padding: 9px; height: 100px;" class="bordered w-100">

        </div><br>
        <table class="w-100">
            <tr>
                <td class="bg-gray w-50">Fecha de elaboración del informe:</td>
                <td class="w-50">
                    <table class="w-100">
                        <tr>
                            <td style="height: 25px;" class="w-33 bordered"></td>
                            <td style="height: 25px;" class="w-33 bordered"></td>
                            <td style="height: 25px;" class="w-33 bordered"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="w-50"></td>
                <td class="w-50">
                    <table class="w-100">
                        <tr>
                            <td style="height: 25px; color: gray;" class="w-33 text-center">dd</td>
                            <td style="height: 25px; color: gray;" class="w-33 text-center">mm</td>
                            <td style="height: 25px; color: gray;" class="w-33 text-center">aaaa</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="w-100">
            <tr>
                <td class="bg-gray w-50">Firma del evaluador:</td>
                <td style="height: 25px;" class="bordered w-50"></td>
            </tr>
        </table><br>
        <p class="paginacion">Página 3 de 3</p>
    </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php endif;  ?>
<?php if ($dimencion_b != null) : ?>
    <div style="width: 90%;margin-left: 5%;font-family: Arial, Helvetica, Verdana;"><br><br><br>
        <h3 class="bg-gray text-center">
            INFORME DE RESULTADOS DEL CUESTIONARIO DE FACTORES DE RIESGO PSICOSOCIAL INTRALABORAL – FORMA B
        </h3><br>
        <p class="bg-gray text-center">
            <b>
                DATOS GENERALES DEL TRABAJADOR
            </b>
        </p>
        <table class="w-100">
            <tr>
                <td class="bg-gray w-50"><b>Nombre del trabajador:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_completo']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Número de identificación (ID):</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cedula']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Cargo:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cargo']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Departamento o sección:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_area']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Edad:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cedula']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Sexo:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['sexo']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Fecha de aplicación del cuestionario:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['fecha']; ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Nombre de la empresa:</b></td>
                <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_empresa']; ?></td>
            </tr>
        </table><br><br>
        <p class="bg-gray text-center">
            <b>
                DATOS DEL EVALUADOR
            </b>
        </p>
        <table class="w-100">
            <tr>
                <td class="bg-gray w-50"><b>Nombre del evaluador:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['nombre_completo']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Número de identificación (c.c.):</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cedula']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Profesión:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cargo']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Postgrado:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['nombre_area']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>No Tarjeta profesional*:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cedula']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>No. Licencia en salud ocupacional*:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['sexo']; 
                                                        ?></td>
            </tr>
            <tr>
                <td class="bg-gray w-50"><b>Fecha de expedición de la licencia en salud ocupacional*:</b></td>
                <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['fecha']; 
                                                        ?></td>
            </tr>
        </table>
        <p>* Todo informe que carezca de estos datos no será válido.</p>
        <p class="paginacion">Página 1 de 3</p><br>
        <p style="margin-top: 350px;" class="bg-gray text-center"><b>RESULTADOS DEL CUESTIONARIO</b></p>
        <table class="w-100">
            <tr>
                <td style="width: 20%;" class="text-center bg-gray"><b>Dominios</b></td>
                <td style="width: 50%;" class="text-center bg-gray"><b>Dimensiones</b></td>
                <td style="width: 15%;" class="text-center bg-gray"><b>Puntaje (transformado)</b></td>
                <td style="width: 15%;" class="text-center bg-gray"><b>Nivel de riesgo</b></td>
            </tr>
            <tr>
                <td rowspan="3" style="width: 20%;" class="bg-gray">Liderazgo y relaciones sociales en el trabajo</td>
                <td style="width: 50%;" class="bg-gray">Características del liderazgo</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato1 = number_format(($dimencion_b[0]['id'] == 20) ? $dimencion_b[0]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato1, 'dimencion', 20, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td style="width: 50%;" class="bg-gray">Relaciones sociales en el trabajo</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato2 = number_format(($dimencion_b[1]['id'] == 21) ? $dimencion_b[1]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato2, 'dimencion', 21, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Retroalimentación del desempeño</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato3 = number_format(($dimencion_b[2]['id'] == 22) ? $dimencion_b[2]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato3, 'dimencion', 22, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="bg-gray text-center"><b>LIDERAZGO Y RELACIONES SOCIALES EN EL TRABAJO</b></td>
                <td style="width: 15%;" class="bordered"><?php echo $dato5 = number_format(($dominios_b[0]['id'] == 1) ? $dominios_b[0]['puntaje_transformado_dom'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato5, 'dominio', 1, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td rowspan="5" style="width: 20%;" class="bg-gray">Control sobre el trabajo</td>
                <td style="width: 50%;" class="bg-gray">Claridad de rol</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato6 = number_format(($dimencion_b[3]['id'] == 24) ? $dimencion_b[4]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato6, 'dimencion', 24, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td style="width: 50%;" class="bg-gray">Capacitación</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato7 = number_format(($dimencion_b[4]['id'] == 25) ? $dimencion_b[5]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato7, 'dimencion', 25, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Participación y manejo del cambio</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato8 = number_format(($dimencion_b[5]['id'] == 26) ? $dimencion_b[6]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato8, 'dimencion', 26, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Oportunidades para el uso y desarrollo de habilidades y conocimientos</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato9 = number_format(($dimencion_b[6]['id'] == 27) ? $dimencion_b[7]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato9, 'dimencion', 27, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Control y autonomía sobre el trabajo</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato10 = number_format(($dimencion_b[7]['id'] == 28) ? $dimencion_b[8]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato10, 'dimencion', 28, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="bg-gray text-center"><b>CONTROL SOBRE EL TRABAJO</b></td>
                <td style="width: 15%;" class="bordered"><?php echo $dato11 = number_format(($dominios_b[1]['id'] == 2) ? $dominios_b[1]['puntaje_transformado_dom'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato11, 'dominio', 2, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td rowspan="6" style="width: 20%;" class="bg-gray">Demandas del trabajo</td>
                <td style="width: 50%;" class="bg-gray">Demandas ambientales y de esfuerzo físico</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato12 = number_format(($dimencion_b[8]['id'] == 29) ? $dimencion_b[9]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato12, 'dimencion', 29, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td style="width: 50%;" class="bg-gray">Demandas emocionales</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato13 = number_format(($dimencion_b[9]['id'] == 30) ? $dimencion_b[10]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato13, 'dimencion', 30, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Demandas cuantitativas</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato14 = number_format(($dimencion_b[10]['id'] == 31) ? $dimencion_b[11]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato14, 'dimencion', 31, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Influencia del trabajo sobre el entorno extralaboral</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato15 = number_format(($dimencion_b[11]['id'] == 32) ? $dimencion_b[12]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato15, 'dimencion', 32, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Demandas de carga mental</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato17 = number_format(($dimencion_b[12]['id'] == 34) ? $dimencion_b[14]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato17, 'dimencion', 34, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td class="bg-gray">Demandas de la jornada de trabajo</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato19 = number_format(($dimencion_b[13]['id'] == 36) ? $dimencion_b[16]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato19, 'dimencion', 36, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="bg-gray text-center"><b>DEMANDAS DEL TRABAJO</b></td>
                <td style="width: 15%;" class="bordered"><?php echo $dato20 = number_format(($dominios_b[2]['id'] == 3) ? $dominios_b[2]['puntaje_transformado_dom'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato20, 'dominio', 3, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td rowspan="2" style="width: 20%;" class="bg-gray">Recompensas</td>
                <td style="width: 50%;" class="bg-gray">Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato21 = number_format(($dimencion_b[14]['id'] == 37) ? $dimencion_b[17]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato21, 'dimencion', 37, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td style="width: 50%;" class="bg-gray">Reconocimiento y compensación</td>
                <td style="width: 15%;" class="bordered"><?php echo $dato22 = number_format(($dimencion_b[15]['id'] == 38) ? $dimencion_b[18]['puntaje_transformado_dim'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato22, 'dimencion', 38, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="bg-gray text-center"><b>RECOMPENSAS</b></td>
                <td style="width: 15%;" class="bordered"><?php echo $dato23 = number_format(($dominios_b[3]['id'] == 4) ? $dominios_b[3]['puntaje_transformado_dom'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato21, 'dominio', 4, 'forma_b'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="bg-gray text-center"><b>TOTAL GENERAL FACTORES DE RIESGO <br> PSICOSOCIAL INTRALABORAL</b></td>
                <td style="width: 15%;" class="bordered"><?php echo $dato24 = number_format(($calificacion_b[0]['id'] == 29) ? $calificacion_b[0]['putaje_transformado_calificacion'] : '', 1); ?></td>
                <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato24, 'calificacion', 1, 'forma_b'); ?></td>
            </tr>
        </table>
        <p class="paginacion">Página 2 de 3</p><br>
        <p class="bg-gray text-center"><b>INTERPRETACIÓN GENÉRICA DE LOS NIVELES DE RIESGO</b></p>
        <div style="padding: 9px;" class="bordered w-100">
            " Sin riesgo o riesgo despreciable: ausencia de riesgo o riesgo tan bajo que no amerita desarrollar actividades de
            intervención. Las dimensiones y dominios que se encuentren bajo esta categoría serán objeto de acciones o
            programas de promoción. <br>
            " Riesgo bajo: no se espera que los factores psicosociales que obtengan puntuaciones de este nivel estén
            relacionados con síntomas o respuestas de estrés significativas. Las dimensiones y dominios que se encuentren
            bajo esta categoría serán objeto de acciones o programas de intervención, a fin de mantenerlos en los niveles de
            riesgo más bajos posibles. <br>
            " Riesgo medio: nivel de riesgo en el que se esperaría una respuesta de estrés moderada. Las dimensiones y
            dominios que se encuentren bajo esta categoría ameritan observación y acciones sistemáticas de intervención
            para prevenir efectos perjudiciales en la salud. <br>
            " Riesgo alto: nivel de riesgo que tiene una importante posibilidad de asociación con respuestas de estrés alto y por
            tanto, las dimensiones y dominios que se encuentren bajo esta categoría requieren intervención en el marco de un
            sistema de vigilancia epidemiológica. <br>
            " Riesgo muy alto: nivel de riesgo con amplia posibilidad de asociarse a respuestas muy altas de estrés. Por
            consiguiente las dimensiones y dominios que se encuentren bajo esta categoría requieren intervención inmediata
            en el marco de un sistema de vigilancia epidemiológica.
        </div>
        <p class="bg-gray text-center"><b>OBSERVACIONES Y COMENTARIOS DEL EVALUADOR</b></p>
        <div style="padding: 9px; height: 100px;" class="bordered w-100">

        </div><br>
        <p class="bg-gray text-center"><b>RECOMENDACIONES PARTICULARES</b></p>
        <div style="padding: 9px; height: 100px;" class="bordered w-100">

        </div><br>
        <table class="w-100">
            <tr>
                <td class="bg-gray w-50">Fecha de elaboración del informe:</td>
                <td class="w-50">
                    <table class="w-100">
                        <tr>
                            <td style="height: 25px;" class="w-33 bordered"></td>
                            <td style="height: 25px;" class="w-33 bordered"></td>
                            <td style="height: 25px;" class="w-33 bordered"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="w-50"></td>
                <td class="w-50">
                    <table class="w-100">
                        <tr>
                            <td style="height: 25px; color: gray;" class="w-33 text-center">dd</td>
                            <td style="height: 25px; color: gray;" class="w-33 text-center">mm</td>
                            <td style="height: 25px; color: gray;" class="w-33 text-center">aaaa</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="w-100">
            <tr>
                <td class="bg-gray w-50">Firma del evaluador:</td>
                <td style="height: 25px;" class="bordered w-50"></td>
            </tr>
        </table><br>
        <p class="paginacion">Página 3 de 3</p>
    </div>
<?php endif; ?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div style="width: 90%;margin-left: 5%;font-family: Arial, Helvetica, Verdana;"><br><br><br>
    <h3 class="bg-gray text-center">
        INFORME DE RESULTADOS DEL CUESTIONARIO DE FACTORES DE RIESGO PSICOSOCIAL EXTRALABORAL
    </h3><br>
    <p class="bg-gray text-center">
        <b>
            DATOS GENERALES DEL TRABAJADOR
        </b>
    </p>
    <table class="w-100">
        <tr>
            <td class="bg-gray w-50"><b>Nombre del trabajador:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_completo']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Número de identificación (ID):</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cedula']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Cargo:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cargo']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Departamento o sección:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_area']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Edad:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cedula']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Sexo:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['sexo']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Fecha de aplicación del cuestionario:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['fecha']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Nombre de la empresa:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_empresa']; ?></td>
        </tr>
    </table><br><br>
    <p class="bg-gray text-center">
        <b>
            DATOS DEL EVALUADOR
        </b>
    </p>
    <table class="w-100">
        <tr>
            <td class="bg-gray w-50"><b>Nombre del evaluador:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['nombre_completo']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Número de identificación (c.c.):</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cedula']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Profesión:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cargo']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Postgrado:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['nombre_area']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>No Tarjeta profesional*:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cedula']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>No. Licencia en salud ocupacional*:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['sexo']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Fecha de expedición de la licencia en salud ocupacional*:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['fecha']; 
                                                    ?></td>
        </tr>
    </table>
    <p>* Todo informe que carezca de estos datos no será válido.</p>
    <p class="paginacion">Página 1 de 3</p><br><br><br>
    <p style="margin-top: 350px;" class="bg-gray text-center"><b>RESULTADOS DEL CUESTIONARIO</b></p>
    <table class="w-100">
        <tr>
            <td style="width: 50%;" class="text-center bg-gray"><b>Dimensiones</b></td>
            <td style="width: 15%;" class="text-center bg-gray"><b>Puntaje (transformado)</b></td>
            <td style="width: 15%;" class="text-center bg-gray"><b>Nivel de riesgo</b></td>
        </tr>
        <tr>
            <td style="width: 50%;" class="bg-gray">Tiempo fuera del trabajo</td>
            <td style="width: 15%;" class="bordered"><?php echo $dato25 = number_format(($dimencion_e[0]['id'] == 39) ? $dimencion_e[0]['puntaje_transformado_dim'] : '', 1); ?></td>
            <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato25, 'dimencion', 20, 'extralaboral'); ?></td>
        </tr>
        <tr>
            <td style="width: 50%;" class="bg-gray">Relaciones familiares</td>
            <td style="width: 15%;" class="bordered"><?php echo $dato26 = number_format(($dimencion_e[1]['id'] == 40) ? $dimencion_e[1]['puntaje_transformado_dim'] : '', 1); ?></td>
            <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato26, 'dimencion', 21, 'extralaboral'); ?></td>
        </tr>
        <tr>
            <td class="bg-gray">Comunicación y relaciones interpersonales</td>
            <td style="width: 15%;" class="bordered"><?php echo $dato27 = number_format(($dimencion_e[2]['id'] == 41) ? $dimencion_e[2]['puntaje_transformado_dim'] : '', 1); ?></td>
            <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato27, 'dimencion', 22, 'extralaboral'); ?></td>
        </tr>
        <tr>
            <td style="width: 50%;" class="bg-gray">Situación económica del grupo familiar</td>
            <td style="width: 15%;" class="bordered"><?php echo $dato28 = number_format(($dimencion_e[3]['id'] == 42) ? $dimencion_e[4]['puntaje_transformado_dim'] : '', 1); ?></td>
            <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato28, 'dimencion', 24, 'extralaboral'); ?></td>
        </tr>
        <tr>
            <td style="width: 50%;" class="bg-gray">Características de la vivienda y de su entorno</td>
            <td style="width: 15%;" class="bordered"><?php echo $dato29 = number_format(($dimencion_e[4]['id'] == 43) ? $dimencion_e[5]['puntaje_transformado_dim'] : '', 1); ?></td>
            <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato29, 'dimencion', 25, 'extralaboral'); ?></td>
        </tr>
        <tr>
            <td class="bg-gray">Influencia del entorno extralaboral sobre el trabajo</td>
            <td style="width: 15%;" class="bordered"><?php echo $dato30 = number_format(($dimencion_e[5]['id'] == 44) ? $dimencion_e[6]['puntaje_transformado_dim'] : '', 1); ?></td>
            <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato30, 'dimencion', 26, 'extralaboral'); ?></td>
        </tr>
        <tr>
            <td class="bg-gray">Desplazamiento vivienda – trabajo – vivienda</td>
            <td style="width: 15%;" class="bordered"><?php echo $dato31 = number_format(($dimencion_e[6]['id'] == 45) ? $dimencion_e[7]['puntaje_transformado_dim'] : '', 1); ?></td>
            <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato31, 'dimencion', 27, 'extralaboral'); ?></td>
        </tr>
        <tr>
            <td class="bg-gray text-center"><b>TOTAL GENERAL FACTORES DE RIESGO <br> PSICOSOCIAL EXTRALABORAL</b></td>
            <?php $calificacion_extra = ($dimencion_a != null) ? $calificacion_e['calificacion_a'] : $calificacion_e['calificacion_b']; ?>
            <?php $tipo = ($dimencion_a != null) ? 'extralaboral_a' : 'extralaboral_b'; ?>
            <td style="width: 15%;" class="bordered"><?php echo $dato32 = number_format($calificacion_extra, 1); ?></td>
            <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato32, 'calificacion', 1, $tipo); ?></td>
        </tr>
    </table>
    <p class="paginacion">Página 2 de 3</p>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <p class="bg-gray text-center"><b>INTERPRETACIÓN GENÉRICA DE LOS NIVELES DE RIESGO</b></p>
    <div style="padding: 9px;" class="bordered w-100">
        " Sin riesgo o riesgo despreciable: ausencia de riesgo o riesgo tan bajo que no amerita desarrollar actividades de
        intervención. Las dimensiones y dominios que se encuentren bajo esta categoría serán objeto de acciones o
        programas de promoción. <br>
        " Riesgo bajo: no se espera que los factores psicosociales que obtengan puntuaciones de este nivel estén
        relacionados con síntomas o respuestas de estrés significativas. Las dimensiones y dominios que se encuentren
        bajo esta categoría serán objeto de acciones o programas de intervención, a fin de mantenerlos en los niveles de
        riesgo más bajos posibles. <br>
        " Riesgo medio: nivel de riesgo en el que se esperaría una respuesta de estrés moderada. Las dimensiones y
        dominios que se encuentren bajo esta categoría ameritan observación y acciones sistemáticas de intervención
        para prevenir efectos perjudiciales en la salud. <br>
        " Riesgo alto: nivel de riesgo que tiene una importante posibilidad de asociación con respuestas de estrés alto y por
        tanto, las dimensiones y dominios que se encuentren bajo esta categoría requieren intervención en el marco de un
        sistema de vigilancia epidemiológica. <br>
        " Riesgo muy alto: nivel de riesgo con amplia posibilidad de asociarse a respuestas muy altas de estrés. Por
        consiguiente las dimensiones y dominios que se encuentren bajo esta categoría requieren intervención inmediata
        en el marco de un sistema de vigilancia epidemiológica.
    </div>
    <p class="bg-gray text-center"><b>OBSERVACIONES Y COMENTARIOS DEL EVALUADOR</b></p>
    <div style="padding: 9px; height: 100px;" class="bordered w-100">
    </div><br>
    <p class="bg-gray text-center"><b>RECOMENDACIONES PARTICULARES</b></p>
    <div style="padding: 9px; height: 100px;" class="bordered w-100">

    </div><br>
    <table class="w-100">
        <tr>
            <td class="bg-gray w-50">Fecha de elaboración del informe:</td>
            <td class="w-50">
                <table class="w-100">
                    <tr>
                        <td style="height: 25px;" class="w-33 bordered"></td>
                        <td style="height: 25px;" class="w-33 bordered"></td>
                        <td style="height: 25px;" class="w-33 bordered"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="w-50"></td>
            <td class="w-50">
                <table class="w-100">
                    <tr>
                        <td style="height: 25px; color: gray;" class="w-33 text-center">dd</td>
                        <td style="height: 25px; color: gray;" class="w-33 text-center">mm</td>
                        <td style="height: 25px; color: gray;" class="w-33 text-center">aaaa</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="w-100">
        <tr>
            <td class="bg-gray w-50">Firma del evaluador:</td>
            <td style="height: 25px;" class="bordered w-50"></td>
        </tr>
    </table><br>
    <p class="paginacion">Página 3 de 3</p>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
<div style="width: 90%;margin-left: 5%;font-family: Arial, Helvetica, Verdana;"><br><br><br>
    <h3 class="bg-gray text-center">
        INFORME DE RESULTADOS DEL CUESTIONARIO PARA LA EVALUACIÓN DEL ESTRÉS – TERCERA VERSIÓN
    </h3><br>
    <p class="bg-gray text-center">
        <b>
            DATOS GENERALES DEL TRABAJADOR
        </b>
    </p>
    <table class="w-100">
        <tr>
            <td class="bg-gray w-50"><b>Nombre del trabajador:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_completo']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Número de identificación (ID):</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cedula']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Cargo:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cargo']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Departamento o sección:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_area']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Edad:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['cedula']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Sexo:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['sexo']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Fecha de aplicación del cuestionario:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['fecha']; ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Nombre de la empresa:</b></td>
            <td class="bordered w-50 text-center"><?php echo $_POST['datos_generales'][0]['nombre_empresa']; ?></td>
        </tr>
    </table><br><br>
    <p class="bg-gray text-center">
        <b>
            DATOS DEL EVALUADOR
        </b>
    </p>
    <table class="w-100">
        <tr>
            <td class="bg-gray w-50"><b>Nombre del evaluador:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['nombre_completo']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Número de identificación (c.c.):</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cedula']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Profesión:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cargo']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Postgrado:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['nombre_area']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>No Tarjeta profesional*:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['cedula']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>No. Licencia en salud ocupacional*:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['sexo']; 
                                                    ?></td>
        </tr>
        <tr>
            <td class="bg-gray w-50"><b>Fecha de expedición de la licencia en salud ocupacional*:</b></td>
            <td class="bordered w-50 text-center"><?php //echo $_POST['datos_generales'][0]['fecha']; 
                                                    ?></td>
        </tr>
    </table>
    <p>* Todo informe que carezca de estos datos no será válido.</p><br>
    <p class="paginacion">Página 1 de 3</p><br><br><br>
    <p style="margin-top: 350px;" class="bg-gray text-center"><b>RESULTADOS DEL CUESTIONARIO</b></p>
    <table class="w-100">
        <tr>
            <td></td>
            <td class="bg-gray"><b>Puntaje (transformado)</b></td>
            <td class="bg-gray"><b>Nivel de estrés</b></td>
        </tr>
        <tr>
            <td class="bg-gray text-center"><b>TOTAL GENERAL SÍNTOMAS DE ESTRÉS</b></td>
            <td style="width: 15%;" class="bordered"><?php echo $dato33 = number_format($calificacion_es, 1); ?></td>
            <?php $tipo = ($dimencion_a != null) ? 'estres_a' : 'estres_b'; ?>
            <td style="width: 15%;" class="bordered"><?php echo verRiesgo($dato33, 'calificacion', 1, $tipo); ?></td>
        </tr>
    </table>
    <p class="paginacion">Página 2 de 3</p>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <p class="bg-gray text-center"><b>INTERPRETACIÓN GENÉRICA DE LOS NIVELES DE RIESGO</b></p>
    <div style="padding: 9px;" class="bordered w-100">
        " Sin riesgo o riesgo despreciable: ausencia de riesgo o riesgo tan bajo que no amerita desarrollar actividades de
        intervención. Las dimensiones y dominios que se encuentren bajo esta categoría serán objeto de acciones o
        programas de promoción. <br>
        " Riesgo bajo: no se espera que los factores psicosociales que obtengan puntuaciones de este nivel estén
        relacionados con síntomas o respuestas de estrés significativas. Las dimensiones y dominios que se encuentren
        bajo esta categoría serán objeto de acciones o programas de intervención, a fin de mantenerlos en los niveles de
        riesgo más bajos posibles. <br>
        " Riesgo medio: nivel de riesgo en el que se esperaría una respuesta de estrés moderada. Las dimensiones y
        dominios que se encuentren bajo esta categoría ameritan observación y acciones sistemáticas de intervención
        para prevenir efectos perjudiciales en la salud. <br>
        " Riesgo alto: nivel de riesgo que tiene una importante posibilidad de asociación con respuestas de estrés alto y por
        tanto, las dimensiones y dominios que se encuentren bajo esta categoría requieren intervención en el marco de un
        sistema de vigilancia epidemiológica. <br>
        " Riesgo muy alto: nivel de riesgo con amplia posibilidad de asociarse a respuestas muy altas de estrés. Por
        consiguiente las dimensiones y dominios que se encuentren bajo esta categoría requieren intervención inmediata
        en el marco de un sistema de vigilancia epidemiológica.
    </div>
    <p class="bg-gray text-center"><b>OBSERVACIONES Y COMENTARIOS DEL EVALUADOR</b></p>
    <div style="padding: 9px; height: 100px;" class="bordered w-100">
    </div><br>
    <p class="bg-gray text-center"><b>RECOMENDACIONES PARTICULARES</b></p>
    <div style="padding: 9px; height: 100px;" class="bordered w-100">

    </div><br>
    <table class="w-100">
        <tr>
            <td class="bg-gray w-50">Fecha de elaboración del informe:</td>
            <td class="w-50">
                <table class="w-100">
                    <tr>
                        <td style="height: 25px;" class="w-33 bordered"></td>
                        <td style="height: 25px;" class="w-33 bordered"></td>
                        <td style="height: 25px;" class="w-33 bordered"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="w-50"></td>
            <td class="w-50">
                <table class="w-100">
                    <tr>
                        <td style="height: 25px; color: gray;" class="w-33 text-center">dd</td>
                        <td style="height: 25px; color: gray;" class="w-33 text-center">mm</td>
                        <td style="height: 25px; color: gray;" class="w-33 text-center">aaaa</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="w-100">
        <tr>
            <td class="bg-gray w-50">Firma del evaluador:</td>
            <td style="height: 25px;" class="bordered w-50"></td>
        </tr>
    </table><br>
    <p class="paginacion">Página 3 de 3</p>
</div>