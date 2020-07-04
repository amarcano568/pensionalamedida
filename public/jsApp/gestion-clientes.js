$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var objetoDataTables_Clientes = "";

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $(".chosen-select").chosen(ConfigChosen());

    $("#migas-pan").html(
        '<ol class="breadcrumb border-0 m-0">' +
            '<li class="breadcrumb-item active">Home</li>' +
            '<li class="breadcrumb-item">Gestión de clientes</li>' +
            "</ol>"
    );

    listarClientes();

    function listarClientes() {
        destroy_existing_data_table("#tableClientes");
        $.fn.dataTable.ext.pager.numbers_length = 4;
        objetoDataTables_Clientes = $("#tableClientes").DataTable({
            order: [[1, "asc"]],
            dom:
                "<'ui grid'" +
                "<'row'" +
                "<'four wide column'l>" +
                "<'center aligned eight wide column'B>" +
                "<'right aligned four wide column'f>" +
                ">" +
                "<'row dt-table'" +
                "<'sixteen wide column'tr>" +
                ">" +
                "<'row'" +
                "<'four wide column'i>" +
                "<'center aligned eight wide column'>" +
                "<'right aligned four wide column'p>" +
                ">>",
            buttons: [
                {
                    text: '<i class="far fa-file-excel"></i> Exportar',
                    className: "btn-datatables",
                    action: function(e, dt, node, config) {
                        generarExcel();
                    }
                }
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            paginationType: "input",
            sPaginationType: "full_numbers",
            language: {
                buttons: {
                    copyTitle: "Copiado al portapapeles.",
                    copySuccess: {
                        _: "Copiados %d Clientes.",
                        1: "Copiado 1 Cliente."
                    }
                },
                searchPlaceholder: "Buscar",
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ Clientes",
                sZeroRecords:
                    "No se encontró ningun Cliente con la Condición del Filtro",
                sEmptyTable: "Ningun Cliente Agregado aún...",
                sInfo: "Del _START_ al _END_ de un total de _TOTAL_ Clientes",
                sInfoEmpty: "De 0 al 0 de un total de 0 Cliente",
                sInfoFiltered: "(filtrado de un total de _MAX_ Clientes)",
                sInfoPostFix: "",
                sSearch: "",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: loadingUI(
                    "Cargando listado de Clientes...",
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
                url: "/listar-clientes",
                data: {}
            },
            initComplete: function(settings, json) {
                $.unblockUI();
                $('[data-toggle="popover"]').popover();
            },
            columns: [
                {
                    data: "nombre"
                },
                {
                    data: "apellidos"
                },
                {
                    data: "nroDocumento"
                },
                {
                    data: "email"
                },
                {
                    data: "fechaNacimiento",
                    render: function(data) {
                        return moment(data).format("DD-MM-YYYY");
                    }
                },
                {
                    data: "edad"
                },
                {
                    data: "genero",
                    render: function(data) {
                        estadoLabel = "";
                        if (data == "M") {
                            estadoLabel = '<i class="cil-user"></i> Hombre';
                        } else if (data == "F") {
                            estadoLabel =
                                '<i class="cil-user-female"></i> Mujer';
                        }
                        return estadoLabel;
                    }
                },
                {
                    data: "action"
                }
            ],
            columnDefs: [
                {
                    width: "17%",
                    targets: 0
                },
                {
                    width: "17%",
                    targets: 1,
                    orderable: false
                },
                {
                    width: "15%",
                    targets: 2
                },
                {
                    width: "15%",
                    targets: 3
                },
                {
                    width: "10%",
                    targets: 4
                },
                {
                    width: "5%",
                    targets: 5,
                    className: "text-center"
                },
                {
                    width: "10%",
                    targets: 5,
                    className: "text-center"
                }
            ]
        });
    }

    $("body").on("click", "#bodyClientes a", function(e) {
        e.preventDefault();

        accion_ok = $(this).attr("data-accion");
        idCliente = $(this).attr("idCliente");

        switch (accion_ok) {
            case "----------": //Disponible
                break;
            case "editar-cliente": // Edita Cliente
                $.ajax({
                    url: "editar-cliente",
                    type: "get",
                    datatype: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        idCliente: idCliente
                    },
                    beforeSend: function() {
                        loadingUI("Obteniendo datos del Cliente.");
                    }
                })
                    .fail(function(statusCode, errorThrown) {
                        console.log(statusCode + " " + errorThrown);
                    })
                    .done(function(response) {
                        console.log(response.data);
                        //$("input").removeClass("parsley-error");
                        $("#FormCliente")
                            .parsley()
                            .reset();
                        $("#resultado").html("");
                        $(".errorDescripcion").remove();
                        $("#title-modal").html(
                            '<i class="text-success cil-pencil"></i> Editar datos del Cliente.'
                        );

                        $("#idCliente").val(response.data.id);
                        $("#nombre").val(response.data.nombre);
                        $("#apellidos").val(response.data.apellidos);
                        $("#nroDocumento").val(response.data.nroDocumento);
                        $("#nroSeguridadSocial").val(
                            response.data.nroSeguridadSocial
                        );
                        $("#fecNacimiento").val(response.data.fechaNacimiento);
                        $("#edad").val(response.data.edad);
                        $("#genero")
                            .val(response.data.genero)
                            .trigger("chosen:updated");
                        $("#estadocivil")
                            .val(response.data.estadoCivil)
                            .trigger("chosen:updated");
                        $("#email").val(response.data.email);
                        $("#estado")
                            .val(response.data.estado)
                            .trigger("chosen:updated");
                        $("#codigopostal").val(response.data.cp);
                        $("#direccion").val(response.data.direccion);
                        $("#telefonofijo").val(response.data.telefonoFijo);
                        $("#telefonoMovil").val(response.data.telefonoMovil);
                        $("#modal-cliente").modal("show");

                        $("#cotizandoM40").prop(
                            "checked",
                            response.data.cotizandoM40 == "S" ? true : false
                        );
                        $("#enCooperativa").prop(
                            "checked",
                            response.data.enCooperativa == "S" ? true : false
                        );

                        $.unblockUI();
                    });

                break;

            case "eliminarMiembro": // Eliminar Membro
                break;
        }
    });

    $("#FormCliente")
        .parsley()
        .on("field:validated", function() {
            var ok = $(".parsley-error").length === 0;
            $(".bs-callout-info").toggleClass("hidden", !ok);
            $(".bs-callout-warning").toggleClass("hidden", ok);
        })
        .on("form:submit", function() {
            return true;
        });

    $("#FormCliente").submit(function(e) {
        e.preventDefault();
        alertify
            .confirm(
                '<h5 class="text-primary"><i class="cil-save"></i> Datos del cliente.</h5>',
                '<h5 class="text-secondary">Esta seguro de guardar esta información..<i class="text-secondary fas fa-question"></i></h5>',
                function() {
                    var form = $("#FormCliente");
                    var formData = form.serialize();
                    var route = form.attr("action");
                    $.ajax({
                        url: route,
                        type: "post",
                        data: formData,
                        dataType: "json",
                        beforeSend: function() {
                            loadingUI("Actualizando el cliente");
                        }
                    })
                        .done(function(data) {
                            console.log(data);
                            if (data.success === true) {
                                alertify.success(data.mensaje);
                            } else {
                                alertify.error(data.mensaje);
                            }
                            objetoDataTables_Clientes.ajax.reload();
                            $("#modal-cliente").modal("hide");
                            $.unblockUI();
                        })
                        .fail(function(statusCode, errorThrown) {
                            $.unblockUI();
                            console.log(errorThrown);
                            ajaxError(statusCode, errorThrown);
                        });
                },
                function() {
                    // En caso de Cancelar
                    alertify.error(
                        '<i class="fa-2x fas fa-ban"></i><br>Se Cancelo el Proceso para guardar el cliente.'
                    );
                }
            )
            .set("labels", {
                ok: '<i class="fas fa-check"></i> Confirmar',
                cancel: "Cancelar"
            })
            .set({
                transition: "zoom"
            })
            .set({
                modal: true,
                closableByDimmer: false
            });
    });

    $(document).on("click", "#BtnNuevo", function(event) {
        event.preventDefault();
        $("#FormCliente").each(function() {
            this.reset();
        });
        $("#FormCliente")
            .parsley()
            .reset();
        $("#resultado").html("");
        $("#title-modal").html(
            '<i class="fas fa-user-edit"></i> Nuevo Cliente.'
        );
        $("#genero")
            .val("")
            .trigger("chosen:updated");
        $("#estadocivil")
            .val("")
            .trigger("chosen:updated");
        $("#estado")
            .val("")
            .trigger("chosen:updated");
        $("#modal-cliente").modal("show");
        $("#nombre").focus();
        $(".errorDescripcion").remove();
    });

    $("#buscarCurp").click(function(ev) {
        curp = $("#nroDocumento").val();
        $.ajax({
            url: "buscar-curp",
            type: "get",
            data: { curp: curp },
            dataType: "json"
        })
            .done(function(response) {
                console.log(response);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $("#fecNacimiento").change(function(ev) {
        $.ajax({
            url: "calcular-edad",
            type: "get",
            data: { fecNac: $("#fecNacimiento").val() },
            dataType: "json"
        })
            .done(function(response) {
                //console.log(response);
                $("#edad").val(response.data);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    function generarExcel() {
        $.ajax({
            url: "generar-excel-clientes",
            type: "get",
            data: {},
            beforeSend: function() {
                loadingUI("Generando Excel");
            }
        })
            .done(function(result) {
                //console.log(result);
                $.unblockUI();

                var link = document.createElement("a");
                link.href = result;
                link.download = "clientes.xlsx";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }
});
