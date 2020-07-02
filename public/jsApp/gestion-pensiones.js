$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var DataTables_Pensiones = "";

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $(".c-sidebar-minimizer").click();

    $(".chosen-select").chosen(ConfigChosen());

    $("#migas-pan").html(
        '<ol class="breadcrumb border-0 m-0">' +
            '<li class="breadcrumb-item active">Home</li>' +
            '<li class="breadcrumb-item">Gestión de pensiones</li>' +
            "</ol>"
    );

    listarPensiones();

    function listarPensiones() {
        destroy_existing_data_table("#table-pensiones");
        $.fn.dataTable.ext.pager.numbers_length = 4;
        DataTables_Pensiones = $("#table-pensiones").DataTable({
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
                        _: "Copiados %d Pensiones.",
                        1: "Copiado 1 Pensión."
                    }
                },
                searchPlaceholder: "Buscar",
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ Pensiones",
                sZeroRecords:
                    "No se encontró ningun Pensión con la Condición del Filtro",
                sEmptyTable: "Ningun Pensión Agregada aún...",
                sInfo: "Del _START_ al _END_ de un total de _TOTAL_ Pensiones",
                sInfoEmpty: "De 0 al 0 de un total de 0 Pensión",
                sInfoFiltered: "(filtrado de un total de _MAX_ Pensiones)",
                sInfoPostFix: "",
                sSearch: "",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: loadingUI(
                    "Cargando listado de Pensiones...",
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
                url: "/listar-pensiones",
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
                    data: "pensiones.created_at",
                    render: function(data) {
                        return moment(data).format("DD-MM-YYYY");
                    }
                },
                {
                    data: "name"
                },
                {
                    data: "action"
                }
            ],
            columnDefs: [
                {
                    width: "5%",
                    targets: 0
                },
                {
                    width: "10%",
                    targets: 1,
                    orderable: false
                },
                {
                    width: "10%",
                    targets: 2
                },
                {
                    width: "12.5%",
                    targets: 3
                },
                {
                    width: "10%",
                    targets: 4
                },
                {
                    width: "7%",
                    targets: 5,
                    className: "text-center"
                },
                {
                    width: "10%",
                    targets: 6,
                    className: "text-center"
                },
                {
                    width: "7.5%",
                    targets: 7,
                    className: "text-center"
                }
            ]
        });
    }

    $("#FormPensiones").submit(function(e) {
        e.preventDefault();
        alertify
            .confirm(
                '<h5 class="text-primary"><i class="cil-save"></i> Datos del Pensión.</h5>',
                '<h5 class="text-secondary">Esta seguro de guardar esta información..<i class="text-secondary fas fa-question"></i></h5>',
                function() {
                    var form = $("#FormPensiones");
                    var formData = form.serialize();
                    var route = form.attr("action");
                    $.ajax({
                        url: route,
                        type: "post",
                        data: formData,
                        dataType: "json",
                        beforeSend: function() {
                            loadingUI("Actualizando el Pensión");
                        }
                    })
                        .done(function(data) {
                            console.log(data);
                            if (data.success === true) {
                                alertify.success(data.mensaje);
                            } else {
                                alertify.error(data.mensaje);
                            }
                            DataTables_Pensiones.ajax.reload();
                            $("#modal-planes-pension").modal("hide");
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
                        '<i class="fa-2x fas fa-ban"></i><br>Se Cancelo el Proceso para guardar el Pensión.'
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
        $("#FormPensiones").each(function() {
            this.reset();
        });
        $("#FormPensiones")
            .parsley()
            .reset();
        $("#title-modal").html(
            '<i class="fas fa-user-edit"></i> Nuevos planes Pensión.'
        );

        $("#divGestionarPension").show();
        $("#divPantallaPrincipal").hide();
        $("#nombre").focus();
        $(".errorDescripcion").remove();
    });

    seeker($(".cliente-seeker"), "clientes", "buscar-cliente");

    function seeker(element, name, url) {
        if (element.length !== 0) {
            element
                .typeahead(
                    {
                        minLength: 3,
                        hightligth: true,
                        hint: true
                    },
                    {
                        name: name,
                        displayKey: "label",
                        templates: {
                            empty: [
                                "<p><strong>&nbsp; No se encontro resultados  &nbsp;</strong></p>"
                            ].join("\n"),
                            suggestion: function(data) {
                                //console.log(data)
                                return (
                                    "<p><strong>" +
                                    data.id +
                                    ": " +
                                    data.nombre +
                                    " " +
                                    data.apellidos +
                                    "</strong></p>"
                                );
                            }
                        },
                        limit: 100,
                        source: function(query, processSync, processAsync) {
                            //processSync(['This suggestion appears immediately', 'This one too']);
                            return $.ajax({
                                url: url,
                                type: "get",
                                async: true,
                                data: {
                                    buscar: query
                                },
                                dataType: "json",
                                success: function(json) {
                                    //console.log(json)
                                    return processAsync(json);
                                }
                            });
                        }
                    }
                )
                .on("typeahead:selected", function(evt, item) {
                    //console.log(evt);
                    if (name == "clientes") {
                        muestraCliente(
                            item.id,
                            item.nombre,
                            item.apellidos,
                            item.email,
                            item.nroDocumento,
                            item.fechaNacimiento,
                            item.edad,
                            item.direccion,
                            item.telefonoFijo,
                            item.telefonoMovil
                        );
                    } else if (name == "productos") {
                        agregarProducto(item, evt);
                    }
                });
        }
    }

    function muestraCliente(
        id,
        nombre,
        apellidos,
        email,
        nroDocumento,
        fechaNacimiento,
        edad,
        direccion,
        telefonoFijo,
        telefonoMovil
    ) {
        $("#datosComplementarios").html(
            nombre +
                " " +
                apellidos +
                " &nbsp;&nbsp;&nbsp;&nbsp;" +
                '<i class="text-primary cil-calendar"></i> ' +
                moment(fechaNacimiento).format("DD-MM-YYYY") +
                ' <i class="text-info cil-birthday-cake"></i> ' +
                edad +
                " Años <br>" +
                '<i class="text-success fas fa-map-signs"></i> ' +
                direccion +
                ' <i class="text-danger cil-phone"></i> ' +
                telefonoFijo +
                ' <i class="text-danger fas fa-mobile-alt"></i> ' +
                telefonoMovil +
                "<br>" +
                '<i class="far fa-envelope"></i> ' +
                email
        );
        $("#smartwizard").smartWizard("goToStep", 1);
        $("#smartwizard").smartWizard("goToStep", 0);
        $("#fechaNacimiento").focus();
    }

    $("#fechaNacimiento,#fechaPlan").change(function(ev) {
        fecNac = $("#fechaNacimiento").val();
        fecPlan = $("#fechaPlan").val();
        $.ajax({
            url: "calcular-edad-completa",
            type: "get",
            data: { fecNac: fecNac, fecPlan: fecPlan },
            dataType: "json"
        })
            .done(function(response) {
                //console.log(response);
                $("#divEdadCliente").html(
                    '<i class="text-primary cil-birthday-cake"></i> ' +
                        response.data
                );
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $("#edadA").change(function(ev) {
        fecNac = $("#fechaNacimiento").val();
        edadA = $("#edadA").val();
        fecPlan = $("#fechaPlan").val();
        $.ajax({
            url: "calcular-anos-faltante",
            type: "get",
            data: { fecNac: fecNac, edadA: edadA, fecPlan: fecPlan },
            dataType: "json"
        })
            .done(function(response) {
                console.log(response);
                $("#divEdadParaPensionarte").html(
                    '<i class="text-success cil-beach-access"></i> ' +
                        response.data
                );
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    // Toolbar extra buttons
    var btnFinish = $("<button></button>")
        .text("Finalizar")
        .addClass("btn btn-info")
        .on("click", function() {
            alert("Finish Clicked");
        });
    var btnCancel = $("<button></button>")
        .text("Cancelar")
        .addClass("btn btn-danger")
        .on("click", function() {
            $("#smartwizard").smartWizard("reset");
        });

    var btnNext = $("<button></button>")
        .text("Próximo")
        .addClass("btn sw-btn-next")
        .attr("type", "button");

    // Step show event
    $("#smartwizard").on("showStep", function(
        e,
        anchorObject,
        stepIndex,
        stepDirection,
        stepPosition
    ) {
        // alert("You are on step " + stepIndex + " now");
        $("#FormPensiones").parsley();
    });

    $("#smartwizard").on("leaveStep", function(
        e,
        anchorObject,
        stepIndex,
        stepDirection
    ) {
        // return confirm("Do you want to leave the step " + stepIndex + "?");
    });

    $("#smartwizard").smartWizard({
        selected: 0,
        theme: "arrows",
        transition: {
            animation: "slide-horizontal" // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
        },
        toolbarSettings: {
            toolbarPosition: "bottom", // both bottom
            toolbarExtraButtons: [btnFinish, btnCancel]
        }
    });

    // External Button Events
    $("#reset-btn").on("click", function() {
        // Reset wizard
        $("#smartwizard").smartWizard("reset");
        return true;
    });

    $("#prev-btn").on("click", function() {
        // Navigate previous
        $("#smartwizard").smartWizard("prev");
        return true;
    });

    $("#next-btn").on("click", function() {
        // Navigate next
        $("#smartwizard").smartWizard("next");
        return true;
    });

    // Demo Button Events
    $("#got_to_step").on("change", function() {
        // Go to step
        var step_index = $(this).val() - 1;
        $("#smartwizard").smartWizard("goToStep", step_index);
        return true;
    });

    $("#is_justified").on("click", function() {
        // Change Justify
        var options = {
            justified: $(this).prop("checked")
        };

        $("#smartwizard").smartWizard("setOptions", options);
        return true;
    });

    $("#animation").on("change", function() {
        // Change theme
        var options = {
            transition: {
                animation: $(this).val()
            }
        };
        $("#smartwizard").smartWizard("setOptions", options);
        return true;
    });

    $("#theme_selector").on("change", function() {
        // Change theme
        var options = {
            theme: $(this).val()
        };
        $("#smartwizard").smartWizard("setOptions", options);
        return true;
    });
});
