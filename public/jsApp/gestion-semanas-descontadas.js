$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var objetoDataTables_semanas = "";

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $(".chosen-select").chosen(ConfigChosen());

    $("#migas-pan").html(
        '<ol class="breadcrumb border-0 m-0">' +
            '<li class="breadcrumb-item">Home</li>' +
            '<li class="breadcrumb-item">' +
            '<a href="#">Configuración</a></li>' +
            '<li class="breadcrumb-item active">Gestión de usuarios</li>' +
            "</ol>"
    );

    listarTipos();

    function listarTipos() {
        destroy_existing_data_table("#table-semanas-descontadas");
        $.fn.dataTable.ext.pager.numbers_length = 4;
        objetoDataTables_semanas = $("#table-semanas-descontadas").DataTable({
            order: [[1, "asc"]],
            dom: "lfrtip",
            processing: true,
            serverSide: true,
            responsive: true,
            paginationType: "input",
            sPaginationType: "full_numbers",
            language: {
                buttons: {
                    copyTitle: "Copiado al portapapeles.",
                    copySuccess: {
                        _: "Copiados %d Tipos.",
                        1: "Copiado 1 Tipo."
                    }
                },
                searchPlaceholder: "Buscar",
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ Tipos",
                sZeroRecords:
                    "No se encontró ningun Tipo con la Condición del Filtro",
                sEmptyTable: "Ningun Tipo Agregado aún...",
                sInfo: "Del _START_ al _END_ de un total de _TOTAL_ Tipos",
                sInfoEmpty: "De 0 al 0 de un total de 0 Tipo",
                sInfoFiltered: "(filtrado de un total de _MAX_ Tipos)",
                sInfoPostFix: "",
                sSearch: "",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: loadingUI(
                    "Cargando listado de Tipos...",
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
                method: "get",
                url: "/listar-semanas-descontadas",
                data: {}
            },
            initComplete: function(settings, json) {
                $.unblockUI();
                $('[data-toggle="popover"]').popover();
            },
            columns: [
                {
                    data: "id"
                },
                {
                    data: "tipo"
                },
                {
                    data: "nombre"
                },
                {
                    data: "status",
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
                    data: "created_at",
                    render: function(data) {
                        return moment(data).format("DD-MM-YYYY");
                    }
                },
                {
                    data: "action"
                }
            ],
            columnDefs: [
                {
                    width: "10%",
                    targets: 0
                },
                {
                    width: "20%",
                    targets: 1,
                    orderable: false
                },
                {
                    width: "40%",
                    targets: 2
                },
                {
                    width: "10%",
                    targets: 3
                },
                {
                    width: "10%",
                    targets: 4
                }
            ]
        });
    }

    $("body").on("click", "#body-semanas-descontadas a", function(e) {
        e.preventDefault();

        accion_ok = $(this).attr("data-accion");
        idTipo = $(this).attr("idTipo");

        switch (accion_ok) {
            case "bloquear-tipos-semanas": //bloquear-tipos-semanas
                $.ajax({
                    url: "bloquear-tipos-semanas",
                    type: "get",
                    datatype: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        idTipo: idTipo
                    },
                    beforeSend: function() {
                        loadingUI(
                            "Obteniendo datos del Tipo de semanas descontadas."
                        );
                    }
                })
                    .fail(function(statusCode, errorThrown) {
                        console.log(statusCode + " " + errorThrown);
                    })
                    .done(function(response) {
                        console.log(response.data);
                        if (response.success === true) {
                            alertify.success(response.mensaje);
                        } else {
                            alertify.error(response.mensaje);
                        }
                        objetoDataTables_semanas.ajax.reload();
                        $.unblockUI();
                    });
                break;
            case "editar-semanas-descontadas": // editar-semanas-descontadas
                $.ajax({
                    url: "editar-semanas-descontadas",
                    type: "get",
                    datatype: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        idTipo: idTipo
                    },
                    beforeSend: function() {
                        "Obteniendo datos del Tipo de semanas descontadas.";
                    }
                })
                    .fail(function(statusCode, errorThrown) {
                        console.log(statusCode + " " + errorThrown);
                    })
                    .done(function(response) {
                        console.log(response.data);
                        //$("input").removeClass("parsley-error");
                        $("#FormTiposSemanas")
                            .parsley()
                            .reset();
                        $("#title-modal").html(
                            '<i class="text-success cil-pencil"></i> Editar datos del tipo de semanas descontadas.'
                        );
                        $("#idTipo").prop("readonly", true);
                        $("#idTipo").val(response.data.id);
                        $("#tipo")
                            .val(response.data.tipo)
                            .trigger("chosen:updated");
                        $("#nombre").val(response.data.nombre);
                        $("#status")
                            .val(response.data.status)
                            .trigger("chosen:updated");
                        $("#modal-semanas").modal("show");
                        $.unblockUI();
                    });

                break;

            case "eliminarMiembro": // Eliminar Membro
                break;
        }
    });

    $("#FormTiposSemanas")
        .parsley()
        .on("field:validated", function() {
            var ok = $(".parsley-error").length === 0;
            $(".bs-callout-info").toggleClass("hidden", !ok);
            $(".bs-callout-warning").toggleClass("hidden", ok);
        })
        .on("form:submit", function() {
            return true;
        });

    $("#FormTiposSemanas").submit(function(e) {
        e.preventDefault();
        var form = $("#FormTiposSemanas");
        var formData = form.serialize();
        var route = form.attr("action");
        $.ajax({
            url: route,
            type: "post",
            data: formData,
            dataType: "json",
            beforeSend: function() {
                loadingUI("Actualizando la Ubicación");
            }
        })
            .done(function(data) {
                console.log(data);
                if (data.success === true) {
                    alertify.success(
                        "Los datos del Perfil se guardaron exitosamente."
                    );
                } else {
                    alertify.error(
                        "Hubo un problema guardando los datos del Perfil."
                    );
                }
                objetoDataTables_semanas.ajax.reload();
                $("#modal-semanas").modal("hide");
                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $(document).on("click", "#BtnNuevo", function(event) {
        event.preventDefault();
        $("#FormTiposSemanas").each(function() {
            this.reset();
        });
        $("#title-modal").html('<i class="fas fa-user-edit"></i> Nuevo Tipo.');
        $("#modal-semanas").modal("show");
        $("#idTipo").prop("readonly", true);
        $("#nombre").focus();
    });
});
