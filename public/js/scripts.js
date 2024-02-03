function inicio() {
    $.ajax({
        url: 'app/controllers/administracionController.php',
        type: 'POST',
        data: {
            metodo: 'obtenerCuestionarios',
        }
    }).done(function (data) {
        data = JSON.parse(data);
        $.ajax({
            url: 'resources/views/parts/cuestionarios.html.php',
            type: 'POST',
            data: {
                data
            }
        }).done(function (data) {
            $('#cuestionarios').html(data);
        })
    });
}

function cuestionario() {
    tipo = $('#cuestionario').attr('data-tipo');
    controlador = $('#cuestionario').attr('data-controlador');
    campos = $('#cuestionario').attr('data-campos');
    $.ajax({
        url: "../../../app/controllers/" + controlador + ".php",
        type: 'POST',
        data: {
            metodo: 'obtenerItems',
            tipo: tipo
        }
    }).done(function (data) {
        data = JSON.parse(data);
        $.ajax({
            url: '../../../resources/views/parts/' + campos + '.html.php',
            type: 'POST',
            data: {
                data: data,
                tipo: tipo
            }
        }).done(function (data) {
            $('#cuestionario').html(data);
            if (tipo == 1 || tipo == 2) {
                validarCookieJefe();
                validarCookieAtencion();
                $('#jefe').on('change', function () {
                    validarCookieJefe()
                });
                $('#atencion_cliente').on('change', function () {
                    validarCookieAtencion()
                });
            }
        })
    })
}

function validarCookieJefe() {
    if ($('#jefe').val() == 'SI') {
        $('.jefe').show();
        $.post('../../../app/controllers/cuestionariosController.php', { metodo: 'crearCookie', cookie: 'jefe', valor: '1' });
    } else {
        $('.jefe').hide();
        $.post('../../../app/controllers/cuestionariosController.php', { metodo: 'crearCookie', cookie: 'jefe', valor: '0' });
    }
}

function validarCookieAtencion() {
    if ($('#atencion_cliente').val() == 'SI') {
        $('.atencion').show();
        $.post('../../../app/controllers/cuestionariosController.php', { metodo: 'crearCookie', cookie: 'atencion', valor: '1' });
    } else {
        $('.atencion').hide();
        $.post('../../../app/controllers/cuestionariosController.php', { metodo: 'crearCookie', cookie: 'atencion', valor: '0' });
    }
}

function enviarInformacion() {
    var formData = new FormData(document.getElementById($(this).data('id')));
    var controlador = $(this).data('controlador');
    var tipo = $(this).data('tipo');
    var funcion = $(this).data('funcion');
    formData.append('tipo', tipo);
    $.ajax({
        url: "../../../app/controllers/" + controlador + ".php",
        type: 'POST',
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
    }).done(function (data) {
        if (data[0]) {
            recargaTabla(data);
        } else {
            $.alert({
                title: '¡Bien!',
                type: 'green',
                backgroundDismiss: true,
                columnClass: 'xlarge',
                content: 'Los datos se han almacenado con exito'
            })
        }
    });
}

function panelVista(cedula) {
    $.ajax({
        url: '../../../app/controllers/datosGeneralesController.php',
        type: 'POST',
        data: {
            metodo: 'busquedaCedula',
            cedula: cedula
        }
    }).done(function (data) {
        data = JSON.parse(data);
        $.ajax({
            url: '../../../resources/views/paneles/panelVista.php',
            type: 'POST',
            data: {
                data
            }
        }).done(function (data) {
            $.alert({
                title: 'Panel de vista',
                type: 'green',
                backgroundDismiss: true,
                columnClass: 'xlarge',
                content: data,
                onContentReady: function () {
                    $('.pdf').on('click', function () {
                        $.ajax({
                            url: '../../../app/controllers/informesController.php',
                            type: 'POST',
                            data: {
                                metodo: 'obtenerInformacion',
                                id: $(this).data('id')
                            }
                        }).done(function (result) {
                            result = JSON.parse(result);
                            $.ajax({
                                url: '../../../resources/views/pdf.php',
                                type: 'POST',
                                data: result
                            }).done(function (contenido) {
                                $.ajax({
                                    url: '../../../app/controllers/informesController.php',
                                    type: 'POST',
                                    data: {
                                        plantilla: contenido,
                                        metodo: 'generarPdf'
                                    }
                                }).always(function (ruta) {
                                    window.open('../' + ruta.responseText);
                                })
                            })
                        })
                    });
                }
            })
        });
    });
}

function editarDatoGeneral() {
    var id = $(this).data('id');
    var controlador = $(this).data('controlador')
    $.ajax({
        url: '../../../app/controllers/' + controlador + '.php',
        type: 'POST',
        data: {
            metodo: 'busquedaId',
            id: id
        }
    }).done(function (data) {
        data = JSON.parse(data);
        $.ajax({
            url: '../../../resources/views/paneles/panelEdicion.php',
            type: 'POST',
            data: {
                data
            }
        }).done(function (data) {
            $.alert({
                title: 'Panel de edición',
                type: 'green',
                backgroundDismiss: true,
                columnClass: 'xlarge',
                content: data,
                onContentReady: function () {
                    $('form').on('submit', enviarInformacion);
                },
                buttons: {
                    Guardar: {
                        btnClass: 'invisible'
                    }
                }
            })
        });
    });
}

function eliminarDatoGeneral() {
    var id = $(this).data('id');
    var controlador = $(this).data('controlador')
    $.confirm({
        title: '¿Deseas eliminar?',
        content: '',
        columnClass: 'xlarge',
        buttons: {
            Cancelar: {
                title: 'btn btn-primary',
                action: function () {

                }
            },
            Eliminar: {
                title: 'Eliminar',
                btnClass: 'btn btn-danger',
                action: function () {
                    $.ajax({
                        url: '../../../app/controllers/' + controlador + '.php',
                        type: 'POST',
                        data: {
                            metodo: 'eliminarId',
                            id: id
                        }
                    }).done(function (datos) {
                        panelDatosGenerales();
                    })
                }
            }
        }
    });
}

function panelBusqueda() {
    $.confirm({
        title: 'Busqueda',
        type: 'green',
        content: '<form action="javascript:void(0)" method="POST"><input id="cedula" class="form-control" placeholder="Ingresa la cédula a buscar"></form>',
        draggable: true,
        typeAnimated: true,
        backgroundDismiss: true,
        buttons: {
            Cancelar: {
                title: 'Cancelar',
            },
            Buscar: {
                title: 'Buscar',
                btnClass: 'btn btn-orange',
                action: function () {
                    var cedula = $('#cedula').val();
                    panelVista(cedula);
                }
            }
        }
    })
}

function recargaTabla(datos) {
    $.ajax({
        url: '../../../resources/views/paneles/tablaDatosGenerales.php',
        type: 'POST',
        data: {
            datos
        }
    }).done(function (resultado) {
        $('#tablaDatosGenerales').html(resultado);
        $("#tablaDatosGenerales").dataTable().fnDestroy();
        $('#tablaDatosGenerales').DataTable({ 'order': [0] });
        $('#tablaDatosGenerales').on('click', function () {
            $('.ver').off();
            $('.ver').on('click', function () {
                cedula = $(this).data('cedula');
                panelVista(cedula);
            });
        })
        $('.ver').off();
        $('.ver').on('click', function () {
            cedula = $(this).data('cedula');
            panelVista(cedula);
        });
        $('.editar').off();
        $('.editar').on('click', editarDatoGeneral);
        $('.eliminar').off();
        $('.eliminar').on('click', eliminarDatoGeneral);
        $('#panelBusqueda').off();
        $('#panelBusqueda').on('click', panelBusqueda);
    });
}

function panelFiltros() {
    $.confirm({
        title: 'Panel de personalización de filtros',
        columnClass: 'xlarge',
        type: 'green',
        backgroundDismiss: true,
        content: function () {
            let self = this;
            return $.ajax({
                url: '../../../app/controllers/informesController.php',
                type: 'POST',
                data: {
                    'metodo': 'panelFiltros'
                }
            }).done(function (data) {
                data = JSON.parse(data);
                let contenido = `<form id="formFiltros" style="height: 600px;margin-left:15%" method="POST" class="row overflow-scroll w-75">
                <table class="table table-hover">
                <tr>
                    <th class="col-md-4">Campos</th>
                    <th class="col-md-4">Filtro</th>
                    <th class="col-md-4">Orden</th>
                </tr>`;
                $.each(data, function (i, val) {
                    if (val.Field != 'id' && val.Field != 'fecha') {
                        contenido += `
                        <tr>
                        <td class="col-md-4"> <input name="campos[]" class="form-control" value="` + val.Field + `" readonly></td>
                        <td class="col-md-4">
                            <select name="filtros[]" class="form-control">
                                <option value="">Seleccione</option>
                                <option value="ORDER BY">Orden</option>
                            </select>
                        </td>
                        <td class="col-md-4">
                            <select name="ordenes[]" class="form-control">
                                <option value="">Seleccione</option>
                                <option value="ASC">Ascendente</option>
                                <option value="DESC">Descendente</option>
                            </select>
                        </td>
                        </tr>`;
                    }
                });
                contenido += '<input type="hidden" name="metodo" value="guardarFiltros"></table></form>';
                self.setContent(contenido);
            })
        },
        buttons: {
            GUARDAR: {
                text: 'Guardar',
                action: function () {
                    var formData = new FormData(document.getElementById('formFiltros'));
                    $.ajax({
                        url: '../../../app/controllers/informesController.php',
                        type: 'POST',
                        data: formData,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                    }).done(function (data) {
                        location.reload();
                    })
                }
            }
        }
    })
}

function exportarInforme() {
    var formData = new FormData(document.getElementById('formFiltrar'));
    formData.append('metodo', 'informeMasivo');
    $.ajax({
        url: '../../../app/controllers/informesController.php',
        type: 'POST',
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
    }).done(function (data) {
        window.open('../' + data, 'DOWNLOAD');
    })
}

function panelDatosGenerales() {
    $.ajax({
        url: '../../../app/controllers/datosGeneralesController.php',
        type: 'POST',
        data: {
            metodo: 'panelDatosGenerales'
        }
    }).done(function (data) {
        $('#panelFiltros').on('click', panelFiltros);
        data = JSON.parse(data);
        datos = data['datos'];
        filtros = data['filtros'];
        $.ajax({
            url: '../../../resources/views/paneles/filtros.php',
            type: 'POST',
            data: {
                filtros
            }
        }).done(function (filtros) {
            $('#filtros').html(filtros);
            $('#excel').on('click', function () {
                if ($('#fecha_inicial').val() == '' || $('#fecha_final').val() == '') {
                    $.confirm({
                        title: 'Confirmación!',
                        content: '¿Quieres exportar todo lo que se encuentra en la base de datos?',
                        buttons: {
                            Confirmar: function () {
                                exportarInforme();
                            },
                            cancel: function () {
                            }
                        }
                    });
                } else {
                    exportarInforme();
                }
            });
        });
        recargaTabla(datos);
    });
}

$(document).ready(function () {
    if ($('#datosGenerales').length >= 1) {
        $("#antiguedad_cargo").on('change', () => {
            if ($("#antiguedad_cargo").val() == 'Más de un año') {
                $('#antiguedad_cargo1').removeAttr('disabled')
            } else {
                $("#antiguedad_cargo1").val(""); // Reiniciar el valor si está deshabilitado
                $("#antiguedad_cargo1").attr("disabled", "disabled");
            }
        })
        $("#antiguedad_empresa").on('change', () => {
            if ($("#antiguedad_empresa").val() == 'Más de un año') {
                $('#antiguedad_empresa1').removeAttr('disabled')
            } else {
                $("#antiguedad_empresa1").val(""); // Reiniciar el valor si está deshabilitado
                $("#antiguedad_empresa1").attr("disabled", "disabled");
            }
        })
    }
    $('form').on('submit', enviarInformacion);
    if ($('#inicio').length >= 1) {
        inicio();
    }
    if ($('#tablaDatosGenerales').length >= 1) {
        panelDatosGenerales();
    }
    if ($('#cuestionario').length >= 1) {
        cuestionario();
    }
})