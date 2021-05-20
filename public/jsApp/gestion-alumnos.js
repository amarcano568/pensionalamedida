$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var dt_table_estudiantes = "";
    var dt_table_trabajos_imputados = "";

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $("#filtro").chosen(ConfigChosen());

    $(document).on("change", "#filtro", function (event) {
        listarEstudiantes($(this).val());
    });

    $(".chosen-select").chosen(ConfigChosen());

    $("#migas-pan").html(
        '<ol class="breadcrumb border-0 m-0">' +
            '<li class="breadcrumb-item">Home</li>' +
            '<li class="breadcrumb-item">' +
            '<a href="#">Configuración</a></li>' +
            '<li class="breadcrumb-item active">Gestión de alumnos</li>' +
            "</ol>"
    );

    listarEstudiantes(1);

    function listarEstudiantes(status) {
        destroy_existing_data_table("#table-estudiantes");
        $.fn.dataTable.ext.pager.numbers_length = 4;
        dt_table_estudiantes = $("#table-estudiantes").DataTable({
            order: [[1, "asc"]],
            dom: "lfrtip",
            processing: true,
            serverSide: true,
            // responsive: true,
            paginationType: "input",
            sPaginationType: "full_numbers",
            language: {
                buttons: {
                    copyTitle: "Copiado al portapapeles.",
                    copySuccess: {
                        _: "Copiados %d Estudiantes.",
                        1: "Copiado 1 Estudiante."
                    }
                },
                searchPlaceholder: "Buscar",
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ Estudiantes",
                sZeroRecords:
                    "No se encontró ningun Estudiante con la Condición del Filtro",
                sEmptyTable: "Ningun Estudiante Agregado aún...",
                sInfo: "Del _START_ al _END_ de un total de _TOTAL_ Estudiantes",
                sInfoEmpty: "De 0 al 0 de un total de 0 Estudiante",
                sInfoFiltered: "(filtrado de un total de _MAX_ Estudiantes)",
                sInfoPostFix: "",
                sSearch: "",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: loadingUI(
                    "Cargando listado de Estudiantes...",
                    "white"
                ),
                oPaginate: {
                    sFirst: '<i class="fas fa-angle-double-left"></i>',
                    sLast: '<i class="fas fa-angle-double-right"></i>',
                    sNext: '<i class="fas fa-angle-right"></i>',
                    sPrevious: '<i class="fas fa-angle-left"></i>'
                },
                oAria: {
                    sSortAscending:
                        ": Activar para ordenar la columna de manera ascendente",
                    sSortDescending:
                        ": Activar para ordenar la columna de manera descendente"
                }
            },
            lengthMenu: [
                [5, 10, 20, 25, 50, -1],
                [5, 10, 20, 25, 50, "Todos"]
            ],
            iDisplayLength: 10,
            ajax: {
                method: "post",
                url: "listar-estudiantes",
                data: {
                    _token: "{{ csrf_token() }}",
                    filtro: status
                }
            },
            initComplete: function(settings, json) {
                $.unblockUI();
                $('[data-toggle="popover"]').popover();
            },
            columns: [
                {
                    className: "celda_de_descripcion",
                    orderable: false,
                    data: null,
                    defaultContent:
                        '<a class="botonesGraficos" href=""><i style="font-size: 20px;" class="fa fa-plus-circle text-success" aria-hidden="true"></i></a>',
                },
                {
                    data: "numIdAlumno",                  
                },
                {
                    data: "strNombre"
                },
                {
                    data: "strApellidos"
                },
                {
                    data: "strTelefono1"
                },
                {
                    data: "strEMail"
                },
                {
                    data: "strCodigoExpediente"
                },
                {
                    data: "blnVigente",
                    render: function(data) {
                        estadoLabel = "";
                        if (data == 1) {
                            estadoLabel =
                                '<span class="badge badge-success">Activo</span>';
                        } else if (data == 0) {
                            estadoLabel =
                                '<span class="badge badge-warning">Inactivo</span>';
                        }
                        return estadoLabel;
                    }
                },
                {
                    data: "action"
                },{
                    data: "detalle"
                },
            ],
            columnDefs: [
                {
                    width: "2.5%",
                    targets: 0
                },
                {
                    width: "5%",
                    targets: 1,
                    orderable: false
                },
                {
                    width: "20%",
                    targets: 2
                },
                {
                    width: "20%",
                    targets: 3
                },
                {
                    width: "10%",
                    targets: 4
                },
                {
                    width: "10%",
                    targets: 5,
                    className: "dt-body-center"
                },
                {
                    width: "5%",
                    targets: 6,
                    className: "dt-body-right"
                }
            ]
        });
    }

    var detailRows = [];

    $("#body-estudiantes").on("click", "td.celda_de_descripcion", function (event) {
        event.preventDefault();

        var filaDeLaTabla = $(this).closest("tr");
        var filaComplementaria = dt_table_estudiantes.row(filaDeLaTabla);
        var celdaDeIcono = $(this).closest("td.celda_de_descripcion");

        var tr = $(this).closest("tr");
        //console.log(tr);
        var row = dt_table_estudiantes.row(tr);
        var idx = $.inArray(tr.attr("id"), detailRows);

        if (filaComplementaria.child.isShown()) {
            detailRows.splice(idx, 1);
            // La fila complementaria está abierta y se cierra.
            filaComplementaria.child.hide();
            celdaDeIcono.html(
                '<a style="font-size: 20px;"  class="botonesGraficos" href=""><i class="fa fa-plus-circle text-success" aria-hidden="true"></i></a>'
            );
        } else {
            // Add to the 'open' array
            if (idx === -1) {
                detailRows.push(tr.attr("id"));
            }
            // La fila complementaria está cerrada y se abre.
            filaComplementaria
                .child(
                    formatearSalidaDeDatosComplementarios(
                        filaComplementaria.data(),
                        2
                    )
                )
                .show();
            celdaDeIcono.html(
                '<a style="font-size: 20px;" class="botonesGraficos" href=""><i class="fa fa-minus-circle text-danger" aria-hidden="true"></i></a>'
            );
        }
    });

    // On each draw, loop over the `detailRows` array and show any child rows
    dt_table_estudiantes.on("draw", function () {
        console.log(detailRows);
        $.each(detailRows, function (i, id) {
            //alert("open");
            $("#" + id + " td.celda_de_descripcion").trigger("click");
        });
        dt_table_estudiantes.columns(9).visible(false);
    });

    function formatearSalidaDeDatosComplementarios(filaDelDataSet, columna) {
        var cadenaDeRetorno = "";

        cadenaDeRetorno += '<div class="row" style="padding-top: 0;">';
        cadenaDeRetorno +=
            '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 0;">';
        cadenaDeRetorno += filaDelDataSet["detalle"];
        cadenaDeRetorno += "</div>";

        return cadenaDeRetorno;
    }

    $("body").on("click", "#body-estudiantes a", function(e) {
        e.preventDefault();

        accion_ok = $(this).attr("data-accion");
        idAlumno = $(this).data("id-alumno");
        nombre = $(this).data("nombre");

        switch (accion_ok) {
            case 'imputar-trabajo': //eliminar-trabajo
                listarTrabajosRealizados(idAlumno)
                $("#modal-imputar").modal('show')
                $("#id_alumno_trabajo").val(idAlumno);
                break;      
            case 'asignar-habitacion': //asignar-habitacion
                $("#form-hospedaje").each(function() {
                    this.reset();
                });
                uuid = $(this).data('uuid-habitacion');   
                $.ajax({
                    url: "ver-hospedaje-alumno",
                    type: "post",
                    datatype: "json",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        uuid: uuid
                    },
                    beforeSend: function() {
                        loadingUI("Obteniendo información del hospedaje del alumno.");
                    }
                })
                    .fail(function(statusCode, errorThrown) {
                        console.log(statusCode + " " + errorThrown);
                    })
                    .done(function(response) {
                        console.log(response.data);
                        $("#modal-asignar-habitacion").modal('show')
                        $("#title-modal-habitacion").html("Asignar habitación al alumno&nbsp;"+nombre);
                        $("#uuid_habitacion").val(uuid);
                        $("#id_habitacion_alumno").val(idAlumno);
                        if (response.success){
                            $("#numero_habitacion").val(response.data.num_habitacion).trigger("chosen:updated");
                            $("#fecha_entrada").val(response.data.desde);
                            $("#fecha_salida").val(response.data.hasta);
                            $("#observaciones_entrega_hab").val(response.data.observaciones);
                        }else{
                            $("#numero_habitacion").val('').trigger("chosen:updated");
                            $("#observaciones_entrega_hab").val('');
                        }
                        $.unblockUI();
                    });

                break;     
        }
    });

    
    $(document).on("click", ".imputar", function(event) {
        event.preventDefault();
        idAlumno = $(this).data('id-alumno');
        listarTrabajosRealizados(idAlumno)
        $("#modal-imputar").modal('show')
        $("#id_alumno_trabajo").val(idAlumno);
    });

    $(document).on("click", ".ver-grupo-familiar", function(event) {
        event.preventDefault();
        uuid = $(this).data('uuid');
        if(uuid == ''){
            alertify.error('Este alumno no tiene grupo familiar creado...');
            return false;
        }
       
        $.ajax({
            url: "ver-grupo-familiar-alumno",
            type: "post",
            datatype: "json",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                uuid: uuid
            },
            beforeSend: function() {
                loadingUI("Obteniendo datos del grupo familiar.");
            }
        })
            .fail(function(statusCode, errorThrown) {
                console.log(statusCode + " " + errorThrown);
            })
            .done(function(response) {
                console.log(response.data);
                $("#modal-grupo-familiar").show();       
                $("#mostrar-grupo-familiar").html(response.data);
                $.unblockUI();
            });
    });

    $(".close").click(function(){
        $("#modal-grupo-familiar").modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    function listarTrabajosRealizados(idAlumno) {
        destroy_existing_data_table("#table-trabajos-realizados");
        $.fn.dataTable.ext.pager.numbers_length = 4;
        dt_table_trabajos_imputados = $("#table-trabajos-realizados").DataTable({
            order: [[1, "asc"]],
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            processing: true,
            serverSide: true,
            responsive: true,
            paginationType: "input",
            sPaginationType: "full_numbers",
            language: {
                buttons: {
                    copyTitle: "Copiado al portapapeles.",
                    copySuccess: {
                        _: "Copiados %d Trabajos realizados.",
                        1: "Copiado 1 Trabajo realizado."
                    }
                },
                searchPlaceholder: "Buscar",
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ Trabajos realizados",
                sZeroRecords:
                    "No se encontró ningun Trabajo realizado con la Condición del Filtro",
                sEmptyTable: "Ningun Trabajo realizado Agregado aún...",
                sInfo: "Del _START_ al _END_ de un total de _TOTAL_ Trabajos realizados",
                sInfoEmpty: "De 0 al 0 de un total de 0 Trabajo realizado",
                sInfoFiltered: "(filtrado de un total de _MAX_ Trabajos realizados)",
                sInfoPostFix: "",
                sSearch: "",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: loadingUI(
                    "Cargando listado de Trabajos realizados...",
                    "white"
                ),
                oPaginate: {
                    sFirst: '<i class="fas fa-angle-double-left"></i>',
                    sLast: '<i class="fas fa-angle-double-right"></i>',
                    sNext: '<i class="fas fa-angle-right"></i>',
                    sPrevious: '<i class="fas fa-angle-left"></i>'
                },
                oAria: {
                    sSortAscending:
                        ": Activar para ordenar la columna de manera ascendente",
                    sSortDescending:
                        ": Activar para ordenar la columna de manera descendente"
                }
            },
            lengthMenu: [
                [5, 10, 20, 25, 50, -1],
                [5, 10, 20, 25, 50, "Todos"]
            ],
            iDisplayLength: 10,
            ajax: {
                method: "post",
                url: "listar-trabajos-realizados",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    idAlumno: idAlumno
                }
            },
            initComplete: function(settings, json) {
                $.unblockUI();
                $('[data-toggle="popover"]').popover();
            },
            columns: [                
                {
                    data: "trabajo",                  
                },
                {
                    data: "fecha",
                    render: function(data) {
                        return moment(data).format("DD-MM-YYYY");
                    }
                },
                {
                    data: "observaciones"
                },
                {
                    data: "action"
                }
            ],
            columnDefs: [
                {
                    width: "25%",
                    targets: 0
                },
                {
                    width: "17.5%",
                    targets: 1,
                    orderable: false
                },
                {
                    width: "52.5%",
                    targets: 2
                },
                {
                    width: "5%",
                    targets: 3
                }
            ]
        });
    }

    $("body").on("click", "#body-trabajos-realizados a", function(e) {
        e.preventDefault();

        accion_ok = $(this).attr("data-accion");
        idTrabajo = $(this).data("id-trabajo-imputado");

        switch (accion_ok) {
            case 'eliminar-trabajo': //eliminar-trabajo
            $.ajax({
                url: "eliminar-trabajo",
                type: "post",
                datatype: "json",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    idTrabajo: idTrabajo
                },
                beforeSend: function() {
                    loadingUI("Eliminando trabajo imputado.");
                }
            })
                .fail(function(statusCode, errorThrown) {
                    console.log(statusCode + " " + errorThrown);
                })
                .done(function(response) {
                    console.log(response.data);
                    if (response.success === true) {
                        alertify.success(
                            response.message
                        );
                    } else {
                        alertify.error(
                            response.message
                        );
                    }
                    dt_table_trabajos_imputados.ajax.reload();

                    $.unblockUI();
                });
                break;           
        }
    });

    $("#form-imputar-trabajo")
        .parsley()
        .on("field:validated", function() {
            var ok = $(".parsley-error").length === 0;
            $(".bs-callout-info").toggleClass("hidden", !ok);
            $(".bs-callout-warning").toggleClass("hidden", ok);
        })
        .on("form:submit", function() {
            return true;
        });

    $("#form-imputar-trabajos").submit(function(e) {
        e.preventDefault();
        var form = $("#form-imputar-trabajo");
        var formData = form.serialize();
        var route = form.attr("action");
        $.ajax({
            url: route,
            type: "post",
            data: formData,
            dataType: "json",
            beforeSend: function() {
                loadingUI("Actualizando los trabajos realizados");
            }
        })
            .done(function(response) {
                console.log(response);
                if (response.success === true) {
                    alertify.success(
                        response.message
                    );
                } else {
                    alertify.error(
                        response.message
                    );
                }
                dt_table_trabajos_imputados.ajax.reload();
                $("#observaciones_trabajo").val('');
                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    
    $("#form-hospedaje")
        .parsley()
        .on("field:validated", function() {
            var ok = $(".parsley-error").length === 0;
            $(".bs-callout-info").toggleClass("hidden", !ok);
            $(".bs-callout-warning").toggleClass("hidden", ok);
        })
        .on("form:submit", function() {
            return true;
        });

    $("#form-hospedaje").submit(function(e) {
        e.preventDefault();
        var form = $("#form-hospedaje");
        var formData = form.serialize();
        var route = form.attr("action");
        $.ajax({
            url: route,
            type: "post",
            data: formData,
            dataType: "json",
            beforeSend: function() {
                loadingUI("Actualizando el hospedaje del alumno");
            }
        })
            .done(function(response) {
                console.log(response);
                if (response.success === true) {
                    alertify.success(
                        response.message
                    );
                } else {
                    alertify.error(
                        response.message
                    );
                }
                $("#observaciones_entrega_hab").val('');
                dt_table_estudiantes.ajax.reload();
                $("#modal-asignar-habitacion").modal('show')
                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

});
