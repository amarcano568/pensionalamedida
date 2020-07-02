$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var DataTables_Pensiones = "";

    sw = true;

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $(".c-sidebar-minimizer").click();

    $(".chosen-select").chosen(ConfigChosen());

    $("#migas-pan").html(
        '<ol class="breadcrumb border-0 m-0">' +
            '<li class="breadcrumb-item active">Home</li>' +
            '<li class="breadcrumb-item">Gestión de planes</li>' +
            "</ol>"
    );

    seeker($(".cliente-seeker"), "clientes", "/buscar-cliente");

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
        // $("#smartwizard").smartWizard("goToStep", 1);
        // $("#smartwizard").smartWizard("goToStep", 0);
        $("#fechaNacimiento").val(fechaNacimiento);
        var d = new Date();
        var dia = d.getDate();
        var mes = "0" + (d.getMonth() + 1);
        var anio = d.getFullYear();
        var fechaHoy = anio + "-" + pad(mes, 2) + "-" + pad(dia, 2);
        $("#fechaPlan").val(fechaHoy);
        calculaFechas();
        $("#fechaNacimiento").focus();
    }

    $("#semanasCotizadas,#semanasDescontadas").change(function(ev) {
        var total =
            $("#semanasCotizadas").val() - $("#semanasDescontadas").val();
        $("#totalSemanas").val(total);
    });

    $("#fechaNacimiento,#fechaPlan").change(function(ev) {
        calculaFechas();
    });

    function calculaFechas() {
        fecNac = $("#fechaNacimiento").val();
        fecPlan = $("#fechaPlan").val();
        $.ajax({
            url: "/calcular-edad-completa",
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
    }

    $("#edadA").change(function(ev) {
        fecNac = $("#fechaNacimiento").val();
        edadA = $("#edadA").val();
        fecPlan = $("#fechaPlan").val();
        $.ajax({
            url: "/calcular-anos-faltante",
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
    ) {});

    $("#smartwizard").on("leaveStep", function(
        e,
        anchorObject,
        stepIndex,
        stepDirection
    ) {
        // Add the custom validation here
        var stepIndexAux = $("#smartwizard").smartWizard("getStepIndex");

        if (stepIndexAux == 0) {
            valida = $("#formPaso1")
                .parsley()
                .validate();
            if (valida === false) {
                return false;
            }
        }

        return true;
    });

    $("#smartwizard").smartWizard({
        selected: 0, // Initial selected step, 0 = first step
        theme: "arrows", // theme for the wizard, related css need to include for other than default theme
        justified: true, // Nav menu justification. true/false
        autoAdjustHeight: true, // Automatically adjust content height
        cycleSteps: false, // Allows to cycle the navigation of steps
        backButtonSupport: true, // Enable the back button support
        enableURLhash: true, // Enable selection of the step based on url hash
        transition: {
            animation: "none", // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
            speed: "400", // Transion animation speed
            easing: "" // Transition animation easing. Not supported without a jQuery easing plugin
        },
        toolbarSettings: {
            toolbarPosition: "bottom", // none, top, bottom, both
            toolbarButtonPosition: "right", // left, right, center
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            toolbarExtraButtons: [] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
        },
        anchorSettings: {
            anchorClickable: true, // Enable/Disable anchor navigation
            enableAllAnchors: false, // Activates all anchors clickable all times
            markDoneStep: true, // Add done css
            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        },
        keyboardSettings: {
            keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            keyLeft: [37], // Left key code
            keyRight: [39] // Right key code
        },
        lang: {
            // Language variables for button
            next: "Próximo",
            previous: "Anterior"
        },
        disabledSteps: [], // Array Steps disabled
        errorSteps: [], // Highlight step with errors
        hiddenSteps: [] // Hidden steps
    });

    $("#formPaso1").submit(function(e) {
        e.preventDefault();
        alertify
            .confirm(
                '<h5 class="text-primary"><i class="cil-save"></i> Datos del Pensión.</h5>',
                '<h5 class="text-secondary">Esta seguro de guardar esta información..<i class="text-secondary fas fa-question"></i></h5>',
                function() {
                    var form = $("#formPaso1");
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

    $("#btn-cargar-cotizaciones").click(function(ev) {
        $("#modal-cargar-cotizaciones").modal("show");
    });
});
