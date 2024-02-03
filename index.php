<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/bootstrap.css">
    <link rel="stylesheet" href="public/css/dataTables.css">
    <script src="public/js/bootstrap.js"></script>
    <script src="public/js/jquery.js" defer></script>
    <script src="public/js/scripts.js" defer></script>
    <script src="public/js/dataTables.js" defer></script>
    <title>ESTRATEGIA SST</title>
</head>

<body style="background-color: rgba(0, 0, 0, 0.0.2);">
    <div class="container" style="margin-top: 1%;">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-center">
                        <img id="inicio" height="150px" width="150px" src="public/images/logo_ministerio.png" alt="logo ministerio">
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="text-orange mt-5">
                            <h3>BIENVENIDO A ESTRATEGIA SST</h3>
                            <p>Batería de instrumentos para la evaluación de factores de riesgo psicosocial</p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center">
                        <img height="150px" width="150px" src="public/images/logo_universidad.png" alt="logo universidad">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5>¿Qué deseas hacer?</h5>
                    </div>
                </div><br>
                <div class="row mb-3">
                    <div class="col-md-12 d-flex justify-content-center">
                        <a href="resources/views/paneles/panelDatosGenerales.php" class="btn btn-orange col-md-6 p-1 p-1">
                            <b>Veamos Datos</b>
                        </a>
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <div class="col-md-12 d-flex justify-content-center">
                        <a href="resources/views/paneles/panelInformes.php" class="btn btn-orange col-md-6 p-1">
                            <b>Panel de informes</b>
                        </a>
                    </div>
                </div> -->
                <div class="row mb-3">
                    <div class="col-md-12 d-flex justify-content-center">
                        <a href="resources/views/formularios/datosGenerales.php" class="btn btn-orange col-md-6 p-1">
                            <b>Datos Generales</b>
                        </a>
                    </div>
                </div>
                <div id="cuestionarios">
                    
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>