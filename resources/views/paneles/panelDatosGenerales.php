<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/bootstrap.css">
    <link rel="stylesheet" href="../../../public/css/dataTables.css">
    <script src="../../../public/js/bootstrap.js"></script>
    <script src="../../../public/js/jquery.js" defer></script>
    <script src="../../../public/js/scripts.js" defer></script>
    <script src="../../../public/js/dataTables.js" defer></script>
    <script src="../../../public/js/jquery-confirm.js" defer></script>
    <link href="../../../public/css/jquery-confirm.css" rel='stylesheet' type='text/css' />

    <title>ESTRATEGIA SST</title>
</head>

<body style="background-color: rgba(0, 0, 0, 0.0.2);">
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div id="tab">

            </div>
            <div class="card-header bg-orange text-white text-center">
                <div class="row">
                    <div class="col-md-1"><a class=".home text-white text-decoration-none" href="http://localhost/Estrategia_SST/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                            </svg></a></div>
                    <div class="col-md-11"><b>DATOS E INFORMES</b></div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1 offset-md-10">
                        <input id="panelBusqueda" type="button" value="Buscar" class="btn btn-orange">
                    </div>
                    <div class="col-md-1">
                        <a id="panelFiltros" href="#" class="btn btn-warning">Filtros</a>
                    </div>
                </div><br>
                <form id="formFiltrar" data-id="formFiltrar" data-tipo="" data-controlador="informesController" method="POST" action="javascript:void(0)">
                    <div id="filtros" class="row">

                    </div><br>
                    <div class="row">
                        <div class="col-md-1 offset-md-5">
                            <input type="hidden" name="metodo" value="filtrar">
                            <button class="btn btn-primary">Filtrar</button>
                        </div>
                        <div class="col-md-1">
                            <a id="excel" role="button" class="btn btn-success">Excel</a>
                        </div>
                    </div>
                </form><br>
                <table id="tablaDatosGenerales" class="table">

                </table>
            </div>
        </div>
    </div>
    </div>
</body>

</html>