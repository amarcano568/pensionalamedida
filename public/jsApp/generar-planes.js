$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var DataTables_Pensiones = "";
    var PasosWizart = 1;
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

    $("html, body").animate({ scrollTop: 0 }, 1250);

    seeker($(".cliente-seeker"), "clientes", "/buscar-cliente");

    NewOrEdit = $("#NewOrEdit").val();

    if (NewOrEdit == "Edit") {
        ponerReadOnly("nombreCliente");
        uuid = $("#uuid-pension").val();
        idCliente = $("#idCliente").val();
        actualizaDataPension(uuid, idCliente);
    }

    function actualizaDataPension(uuid, idCliente) {
        buscarCliente(idCliente);
        buscarDataAdicional(uuid);
        buscarExpectativas(uuid);
        buscarCotizacionesHoja1(uuid);
    }

    function buscarDataAdicional(uuid) {
        $.ajax({
            url: "/buscar-data-adicional",
            type: "get",
            data: { uuid: uuid },
            dataType: "json"
        })
            .done(function(response) {
                console.log(response);
                response.data.forEach(element => {
                    hoja = element.hoja.split("-");
                    $("#hoja-" + hoja[1] + "-pension-mensual-con-m40").val(
                        $.number(element.pension_mensual, 2, ".", ",")
                    );
                    $("#hoja-" + hoja[1] + "-pension-anual-con-m40").val(
                        $.number(element.pension_anual, 2, ".", ",")
                    );
                    $("#hoja-" + hoja[1] + "-aguinaldo").val(
                        $.number(element.aguinaldo, 2, ".", ",")
                    );
                    $("#hoja-" + hoja[1] + "-total-anual").val(
                        $.number(element.total_anual, 2, ".", ",")
                    );
                    $("#hoja-" + hoja[1] + "-dif-85").val(
                        $.number(element.dif85, 2, ".", ",")
                    );
                    $("#hoja-" + hoja[1] + "-dif-edad-85-text").text(
                        element.dif85_text
                    );

                    $("#hoja-" + hoja[1] + "-nro-semanas-cotizadas").val(
                        element.semanas_cotizadas
                    );
                    $(
                        "#hoja-" +
                            hoja[1] +
                            "-salario-promedio-mensual-250-semanas"
                    ).val(
                        $.number(element.salario_diario_promedio, 2, ".", ",")
                    );
                    $("#hoja-" + hoja[1] + "-esposa").val(element.esposa);
                    $("#hoja-" + hoja[1] + "-hijos").val(element.hijos);
                    $("#hoja-" + hoja[1] + "-padres").val(element.padres);
                    $("#hoja-" + hoja[1] + "-edad-jubilacion").val(
                        element.edad_jubilacion
                    );
                });
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    function buscarCotizacionesHoja1(uuid) {
        $.ajax({
            url: "/buscar-cotizaciones-hoja-1",
            type: "get",
            data: { uuid: uuid },
            dataType: "json"
        })
            .done(function(response) {
                console.log(response);
                $("#table-cotizaciones tbody").empty();
                $("#body-cotizaciones").html(response.data);
                sumaDiasCotizados();

                buscarCotizacionesHoja("hoja-2", uuid, 2);

                setTimeout(function() {
                    buscarCotizacionesHoja("hoja-3", uuid, 3);
                }, 3000);

                setTimeout(function() {
                    buscarCotizacionesHoja("hoja-4", uuid, 4);
                }, 3000);

                setTimeout(function() {
                    buscarCotizacionesHoja("hoja-5", uuid, 5);
                }, 3000);

                setTimeout(function() {
                    buscarCotizacionesHoja("hoja-6", uuid, 6);
                }, 3000);

                setTimeout(function() {
                    calculaBtnHoja1(false);
                }, 5000);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    function buscarCotizacionesHoja(hoja, uuid, id) {
        $.ajax({
            url: "/buscar-cotizaciones-hoja",
            type: "get",
            data: { uuid: uuid, hoja: hoja },
            dataType: "json"
        })
            .done(function(response) {
                console.log(response);
                cargaCotizacionConEstrategiasEdit(response, id);
                i = 0;
                fila = $("#table-promedio-salarial-" + id + " tr:last").attr(
                    "row"
                );
                concepto = 6;
                //setTimeout(function() {}, 5000);
                $(".diasCotizacion").each(function() {
                    row = $(this).attr("row");
                    fechaDesde = $("#fechaDesde" + row).val();
                    fechaHasta = $("#fechaHasta" + row).val();
                    dias = $("#dias" + row).val();
                    monto = $("#monto" + row).val();
                    totalMontoCotizacion = $(
                        "#totalMontoCotizacion" + row
                    ).val();
                    i++;
                    fila++;
                    concepto++;
                    agregarTablePromedioHojaEdit(
                        fila,
                        fechaDesde,
                        fechaHasta,
                        dias,
                        monto,
                        totalMontoCotizacion,
                        i,
                        concepto,
                        id
                    );
                });
                totaldiasHojaEdit(id);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    function cargaCotizacionConEstrategiasEdit(response, id) {
        //console.log(response);
        response.data.forEach(element => {
            switch (parseInt(element.estrategias)) {
                case 6: // M40 -ALTO 2
                    $("#hoja-" + id + "-fecha-desde-mod40-alto").val(
                        moment(element.del).format("DD-MM-YYYY")
                    );
                    $("#hoja-" + id + "-fecha-hasta-mod40-alto").val(
                        moment(element.al).format("DD-MM-YYYY")
                    );
                    $("#hoja-" + id + "-dias-mod40-alto").val(element.dias);
                    $("#hoja-" + id + "-sbc-mod40-alto").val(
                        $.number(element.monto, 2, ".", ",")
                    );
                    $("#hoja-" + id + "-monto-base-mod40-alto").val(
                        $.number(element.total, 2, ".", ",")
                    );
                    break;
                case 3: // RETROACTIVO
                    $("#hoja-" + id + "-fecha-desde-mod40-retroactivo").val(
                        moment(element.del).format("DD-MM-YYYY")
                    );
                    $("#hoja-" + id + "-fecha-hasta-mod40-retroactivo").val(
                        moment(element.al).format("DD-MM-YYYY")
                    );
                    $("#hoja-" + id + "-dias-mod40-retroactivo").val(
                        element.dias
                    );
                    $("#hoja-" + id + "-sbc-mod40-retroactivo").val(
                        $.number(element.monto, 2, ".", ",")
                    );
                    $("#hoja-" + id + "-monto-base-mod40-retroactivo").val(
                        $.number(element.total, 2, ".", ",")
                    );
                    break;
                case 5: // M40 BARATA
                    $("#hoja-" + id + "-fecha-desde-mod40-barata").val(
                        moment(element.del).format("DD-MM-YYYY")
                    );
                    $("#hoja-" + id + "-fecha-hasta-mod40-barata").val(
                        moment(element.al).format("DD-MM-YYYY")
                    );
                    $("#hoja-" + id + "-dias-mod40-barata").val(element.dias);
                    $("#hoja-" + id + "-sbc-mod40-barata").val(
                        $.number(element.monto, 2, ".", ",")
                    );
                    $("#hoja-" + id + "-monto-base-mod40-barata").val(
                        $.number(element.total, 2, ".", ",")
                    );
                    break;
                case 2: // COOPERATIVA
                    $("#hoja-" + id + "-fecha-desde-cooperativa").val(
                        moment(element.del).format("DD-MM-YYYY")
                    );
                    $("#hoja-" + id + "-fecha-hasta-cooperativa").val(
                        moment(element.al).format("DD-MM-YYYY")
                    );
                    $("#hoja-" + id + "-dias-cooperativa").val(element.dias);
                    $("#hoja-" + id + "-sbc-cooperativa").val(
                        $.number(element.monto, 2, ".", ",")
                    );
                    $("#hoja-" + id + "-monto-base-cooperativa").val(
                        $.number(element.total, 2, ".", ",")
                    );
                    break;
                case 4: // M40 YA PAGADA
                    $("#hoja-" + id + "-fecha-desde-m40-pagada").val(
                        moment(element.del).format("DD-MM-YYYY")
                    );
                    $("#hoja-" + id + "-fecha-hasta-m40-pagada").val(
                        moment(element.al).format("DD-MM-YYYY")
                    );
                    $("#hoja-" + id + "-dias-m40-pagada").val(element.dias);
                    $("#hoja-" + id + "-sbc-m40-pagada").val(
                        $.number(element.monto, 2, ".", ",")
                    );
                    $("#hoja-" + id + "-monto-base-m40-pagada").val(
                        $.number(element.total, 2, ".", ",")
                    );
                    break;
            }

            $(
                "#hoja-" + id + "-fecha-desde-estrategia-" + element.estrategias
            ).val(element.del.substr(0, 10));

            $(
                "#hoja-" +
                    id +
                    "-entrada-dias-estrategia-" +
                    element.estrategias
            ).val(element.dias);

            if (element.estrategias == 2) {
                $(
                    "#hoja-" +
                        id +
                        "-inscripcion-cooperativa-estrategia-" +
                        element.estrategias
                ).val(element.inscripcion);
            }

            OkSumarDiasHoja(id, element.estrategias);
            $("#hoja-" + id + "-sbc-estrategia-" + element.estrategias).val(
                element.monto
            );

            setTimeout(function() {
                changeChosenEdadPensionHojaEdit(id, element.estrategias);
            }, 1500);

            setTimeout(function() {
                calculaTotalEstrategiasHojasEdit(id, element.estrategias);
            }, 1500);
        });
    }

    function buscarExpectativas(uuid) {
        $.ajax({
            url: "/buscar-expectativas",
            type: "get",
            data: { uuid: uuid },
            dataType: "json"
        })
            .done(function(response) {
                console.log(response);
                $("#fechaNacimiento").val(response.data.fechaNacimiento);
                $("#fechaPlan").val(response.data.fechaPlan);
                $("#edadDe").val(response.data.edadDe);
                $("#edadA").val(response.data.edadA);
                $("#semanasCotizadas").val(response.data.semanasCotizadas);
                $("#semanasDescontadas").val(response.data.semanasDescontadas);
                $("#totalSemanas").val(
                    response.data.semanasCotizadas -
                        response.data.semanasDescontadas
                );
                $("#esposa")
                    .val(response.data.esposa)
                    .trigger("chosen:updated");
                $("#hijos")
                    .val(response.data.hijos)
                    .trigger("chosen:updated");
                $("#padres")
                    .val(response.data.padres)
                    .trigger("chosen:updated");
                $("#rangoPensionDe").val(response.data.rangoPensionDe);
                $("#rangoPensionA").val(response.data.rangoPensionA);
                $("#rangoInversionDe").val(response.data.rangoInversionDe);
                $("#rangoInversionA").val(response.data.rangoInversionA);
                $("#statusRetiro").prop(
                    "checked",
                    response.data.vigente == "S" ? true : false
                );
                $("#fechaBaja").val(response.data.fechaRetiro);
                $("#comentarios").val(response.data.comentarios);
                $("#otrosComentarios").val(response.data.otrosComentarios);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    function buscarCliente(idCliente) {
        $.ajax({
            url: "/editar-cliente",
            type: "get",
            data: { idCliente: idCliente },
            dataType: "json"
        })
            .done(function(response) {
                console.log(response);
                muestraCliente(
                    response.data.id,
                    response.data.nombre,
                    response.data.apellidos,
                    response.data.email,
                    response.data.nroDocumento,
                    response.data.fechaNacimiento,
                    response.data.edad,
                    response.data.direccion,
                    response.data.telefonoFijo,
                    response.data.telefonoMovil
                );
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

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
                                    "<p><strong><span class='text-secondary'>" +
                                    data.id +
                                    ": </span>" +
                                    data.nombre +
                                    " " +
                                    data.apellidos +
                                    "<span class='text-secondary'> NSS: " +
                                    data.nroSeguridadSocial +
                                    "</span></strong></p>"
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
                    $("#formPaso1")
                        .parsley()
                        .reset();
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
        direccion = direccion === null ? "No registrado" : direccion;
        telefonoFijo = telefonoFijo === null ? "No registrado" : telefonoFijo;
        telefonoMovil =
            telefonoMovil === null ? "No registrado" : telefonoMovil;
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
        $("#idCliente").val(id);
        calculaFechas();
        $("#edadDe").focus();
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
        stepDirection
    ) {
        if (stepDirection == "forward") {
            PasosWizart++;
        } else if (stepDirection == "backward") {
            PasosWizart--;
        }

        $("html, body").animate({ scrollTop: 0 }, 800);

        switch (PasosWizart) {
            case 1:
                if (PasosWizart == 1) {
                    showStackTopLeft(
                        "Paso 1",
                        "Usted se encuentra en el paso <strong>Expectativas Salariales</strong>"
                    );
                }
                break;
            case 2:
                if (PasosWizart == 2) {
                    showStackTopLeft(
                        "Paso 2",
                        "Usted se encuentra en el paso <strong>Promedio Salarial 2</strong>"
                    );
                }
                break;
            case 3:
                if (PasosWizart == 3) {
                    showStackTopLeft(
                        "Paso 3",
                        "Usted se encuentra en el paso <strong>Promedio Salarial 3</strong>"
                    );
                }
                break;
            case 4:
                if (PasosWizart == 4) {
                    showStackTopLeft(
                        "Paso 4",
                        "Usted se encuentra en el paso <strong>Promedio Salarial 4</strong>"
                    );
                }
                break;
            case 5:
                if (PasosWizart == 5) {
                    showStackTopLeft(
                        "Paso 5",
                        "Usted se encuentra en el paso <strong>Promedio Salarial 5</strong>"
                    );
                }
                break;
        }
    });

    $("#smartwizard").on("leaveStep", function(
        e,
        anchorObject,
        currentStepIndex,
        nextStepIndex,
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
            } else {
            }
        }

        return true;
    });

    $("#smartwizard").smartWizard({
        selected: 0, // Initial selected step, 0 = first step
        theme: "arrows", // theme for the wizard, related css need to include for other than default theme
        justified: true, // Nav menu justification. true/false
        //autoAdjustHeight: true, // Automatically adjust content height
        autoAdjustHeight: false,
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
        idcliente = $("#idCliente").val();
        if (idcliente == "" || idcliente === null) {
            alertify.set("notifier", "position", "top-center");
            alertify.error(
                "<i class='fa-2x fas fa-exclamation-triangle'></i><br>Primero debe seleccionar un cliente.."
            );
            //alertify.set("notifier", "position", "bottom-right");
            return false;
        }
        $("#modal-cargar-cotizaciones").modal("show");
    });

    $(".btn-cerrar-modal-cotizaciones").click(function(ev) {
        if ($(".modal-backdrop").is(":visible")) {
            $("body").removeClass("modal-open");
            $(".modal-backdrop").remove();
        }
    });

    $(document).on(
        "focusout",
        ".fechaCotizacionDesde, .fechaCotizacionHasta",
        function(event) {
            row = $(this).attr("row");
            fechaDesde = $("#fechaDesde" + row).val();
            fechaHasta = $("#fechaHasta" + row).val();
            console.log(fechaDesde);
            console.log(fechaHasta);
            $.ajax({
                url: "/calcular-dias-entre-fechas",
                type: "get",
                data: { fechaDesde: fechaDesde, fechaHasta: fechaHasta },
                dataType: "json"
            })
                .done(function(response) {
                    //console.log(response);
                    $("#dias" + row).val(response.data);
                    sumaDiasCotizados();
                    //$("#monto" + row).focus();
                    calculaTotalCotizacionDias(row);
                })
                .fail(function(statusCode, errorThrown) {
                    $.unblockUI();
                    console.log(errorThrown);
                    ajaxError(statusCode, errorThrown);
                });
        }
    );

    function sumaDiasCotizados() {
        filas = $("#table-cotizaciones >tbody >tr").length + 1;
        totalDias = 0;
        $(".diasCotizacion").each(function() {
            row = $(this).attr("row");
            dias = $("#dias" + row).val();
            dias = dias === NaN || dias === null || dias == "" ? 0 : dias;
            totalDias += parseInt(dias);
        });
        if (totalDias < 875) {
            $("#totalDiasCotizados").attr(
                "style",
                "text-shadow: 1px 1px 2px black, 0 0 25px red, 0 0 5px darkred;color: white;"
            );
        } else if (totalDias >= 875 && totalDias < 1750) {
            $("#totalDiasCotizados").attr(
                "style",
                "text-shadow: 1px 1px 2px black, 0 0 25px orange, 0 0 5px darkorange;color: white;"
            );
        } else {
            $("#totalDiasCotizados").attr(
                "style",
                "text-shadow: 1px 1px 2px black, 0 0 25px lime, 0 0 5px darkgreen;color: white;"
            );
        }
        $("#totalDiasCotizados").text(totalDias);

        if (totalDias > 1750) {
            diasExcedidos = totalDias - 1750;
            $("#dias-cotizados").text(totalDias);
            $("#dias-excedidos").text(diasExcedidos);
            $("#dias-aceptados").text(totalDias - diasExcedidos);
            $("#div-dias-excedidos").show(200);

            $("#dias-excedidos-2").text(diasExcedidos + "d");
            id = $("#table-cotizaciones tr:last").attr("id");
            monto = parseFloat($("#monto" + id).val());
            $("#ultimo-salario").text("$" + monto);
            $("#salario-auxiliar").text("$" + diasExcedidos * monto);

            totalSalarios =
                parseFloat(calculaTotalSalarios()) -
                parseFloat(diasExcedidos * monto);
            $("#salarios-totales").text($.number(totalSalarios, 2, ".", ","));
            $("#dias-totales").text(1750);
            $("#promedio-salarios").text(
                $.number(totalSalarios / 1750, 2, ".", ",")
            );
            $("#btn-hoja-1").show();
        } else {
            $("#btn-hoja-1").hide();
            $("#div-dias-excedidos").hide();
            $("#dias-cotizados").text(0);
            $("#dias-excedidos").text(0);
            $("#dias-aceptados").text(0);
        }
    }

    function calculaTotalSalarios() {
        totalSalarios = 0;
        $(".totalCotizacion").each(function() {
            //alert("pasa");
            row = $(this).attr("row");
            montoSalario = $("#totalMontoCotizacion" + row).val();
            montoSalario =
                montoSalario === NaN ||
                montoSalario === null ||
                montoSalario == ""
                    ? 0.0
                    : montoSalario;
            totalSalarios += parseFloat(montoSalario);
        });
        return totalSalarios;
    }

    function calculaTotalCotizacionDias(row) {
        total =
            parseInt($("#dias" + row).val()) *
            parseInt($("#monto" + row).val());
        $("#totalMontoCotizacion" + row).val(total);
        console.log(total);
    }

    $(document).on("change", ".montoCotizacion", function(event) {
        row = $(this).attr("row");
        calculaTotalCotizacionDias(row);
    });

    $(document).on("click", "#addFila", function(event) {
        event.preventDefault();
        agregarFila();
    });

    $("body").on("keydown", function(e) {
        if (e.ctrlKey && e.which === 65) {
            e.preventDefault();
            agregarFila();
        }
    });

    $(document).on("click", ".borrar", function(event) {
        event.preventDefault();
        $(this)
            .closest("tr")
            .remove();
        sumaDiasCotizados();
    });

    function agregarFila() {
        id = $("#table-cotizaciones tr:last").attr("id");
        ultimoMonto = $("#totalMontoCotizacion" + id).val();
        if (ultimoMonto == 0) {
            alertify.error(
                '<i class="fa-2x fas fa-exclamation-triangle"></i><br>Por favor corrija la ultima cotización ingresada antes de intentar agregar una nueva cotización.'
            );
            return false;
        }

        totalDiasCotizados = parseInt($("#totalDiasCotizados").text());
        if (totalDiasCotizados >= 1750) {
            alertify.warning(
                '<i class="fa-2x fas fa-exclamation-triangle"></i><br>Ya tiene superado los 1750 días cotizados.'
            );
            return false;
        }

        filas = 0;
        $(".diasCotizacion").each(function() {
            id = $(this).attr("row");
            if (id > filas) {
                filas = id;
            }
        });

        filas++;
        var htmlTags =
            '<tr class="row2" id="' +
            filas +
            '">' +
            '<td class="altoFilaTable"><input type="date" row="' +
            filas +
            '" id="fechaDesde' +
            filas +
            '" class="form-control-sm form-control fechaCotizacionDesde" ></td>' +
            '<td class="altoFilaTable"><input type="date" row="' +
            filas +
            '" id="fechaHasta' +
            filas +
            '" class="form-control-sm form-control fechaCotizacionHasta"></td>' +
            '<td class="altoFilaTable"><input type="text" row="' +
            filas +
            '" id="dias' +
            filas +
            '" class="form-control-sm form-control diasCotizacion" readonly></td>' +
            '<td class="altoFilaTable">' +
            '<div class="input-group">' +
            '<div class="input-group-prepend">' +
            '<span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>' +
            "</div>" +
            '<input type="number" row="' +
            filas +
            '" id="monto' +
            filas +
            '" class="form-control-sm form-control montoCotizacion" value="0">' +
            "</div>" +
            "</td>" +
            '<td class="altoFilaTable">' +
            '<div class="input-group">' +
            '<div class="input-group-prepend">' +
            '<span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>' +
            "</div>" +
            '<input type="text" row="' +
            filas +
            '" id="totalMontoCotizacion' +
            filas +
            '" class="form-control-sm form-control totalCotizacion" readonly>' +
            "</div>" +
            "</td>" +
            '<td class="altoFilaTable"><a href="#" class="borrar"><i class="text-danger far fa-trash-alt"></i></a></td>' +
            "</tr>";

        $("#table-cotizaciones tbody").append(htmlTags);
        $("#fechaDesde" + filas).focus();
    }

    $("#modal-subir-excel").on("shown.bs.modal", function() {
        $("#modal-cargar-cotizaciones").modal("hide");
        iconoDropZone =
            '<br><br><i class="far fa-file-excel"></i><br><h6>Click para subir el archivo excel con los movimientos salariales.</h6>';
        configuraDropZone(iconoDropZone);
    });

    $("#modal-subir-excel").on("hidden.bs.modal", function() {
        $("#modal-cargar-cotizaciones").modal("show");
    });

    function configuraDropZone(iconoDropZone) {
        idMiembro = $("#idMiembro").val();
        Dropzone.autoDiscover = false;
        Dropzone.prototype.defaultOptions.dictRemoveFile = "Borrar archivo..";
        // if (Dropzone.instances.length > 0)
        //     Dropzone.instances.forEach(bz => bz.destroy());
        $("#formDropZone").html("");
        $("#formDropZone").append(
            "<form action='/subir-excel-cotizaciones' method='POST' files='true' enctype='multipart/form-data' id='dZUpload' class='dropzone borde-dropzone' style='width: 100%;padding: 0;cursor: pointer;'>" +
                "<div style='padding: 0;margin-top: 0em;' class='dz-default dz-message text-center'>" +
                iconoDropZone +
                "</div></form>"
        );

        myAwesomeDropzone = myAwesomeDropzone = {
            maxFilesize: 12,
            acceptedFiles: ".xlsx",
            addRemoveLinks: true,
            timeout: 50000,
            maxFiles: 1,
            removedfile: function(file) {
                var name = file.name;
                // console.log(name);
                $.ajax({
                    type: "post",
                    url: "delete-logo",
                    data: {
                        filename: name
                    },
                    success: function(data) {
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null
                    ? fileRef.parentNode.removeChild(file.previewElement)
                    : void 0;
            },
            params: {},
            success: function(file, response) {
                console.log(response);
                $("#table-cotizaciones tbody").empty();
                $("#body-cotizaciones").html(response.data);
                sumaDiasCotizados();
                $("#modal-subir-excel").modal("hide");
            },
            error: function(file, response) {
                return false;
            }
        };

        var myDropzone = new Dropzone("#dZUpload", myAwesomeDropzone);

        // myDropzone.on("queuecomplete", function(file, response) {
        //     if (Dropzone.instances.length > 0)
        //         Dropzone.instances.forEach(bz => bz.destroy());
        //     $("#ModalAgregarLogo").modal("hide");
        // });
    }

    $(document).on("change", "#statusRetiro", function(event) {
        event.preventDefault();
        if ($("#statusRetiro").prop("checked")) {
            $("#fechaBaja").val("Vigente");
        } else {
            $("#fechaBaja").val("");
            $("#fechaBaja").focus();
        }
    });

    $(document).on("click", "#btn-guardar-pension", function(event) {
        event.preventDefault();
        idcliente = $("#idCliente").val();
        if (idcliente == "" || idcliente === null) {
            alertify.set("notifier", "position", "top-center");
            alertify.error(
                "<i class='fa-2x fas fa-exclamation-triangle'></i><br>Primero debe seleccionar un cliente.."
            );
            //alertify.set("notifier", "position", "bottom-right");
            return false;
        }

        valida = $("#formPaso1")
            .parsley()
            .validate();
        if (valida === false) {
            alertify.set("notifier", "position", "top-center");
            alertify.error(
                '<i class="fas fa-exclamation-triangle"></i><br>Falta información por agregar en la ficha de Expectavivas salariales.'
            );
            return false;
        }

        alertify
            .confirm(
                '<h5 class="text-primary"><i class="cil-save"></i> PLANES DE GESTION.</h5>',
                '<h5 class="text-secondary">Esta seguro de guardar esta información..<i class="text-secondary fas fa-question"></i></h5>',
                function() {
                    var NewOrEdit = $("#NewOrEdit").val();
                    var idCliente = $("#idCliente").val();
                    var uuid = $("#uuid-pension").val();

                    var cotizacionesHoja1 = cotizacionesToJson();
                    var cotizacionesHoja2 = cotizacionesHojaToJson(2);
                    var cotizacionesHoja3 = cotizacionesHojaToJson(3);
                    var cotizacionesHoja4 = cotizacionesHojaToJson(4);
                    var cotizacionesHoja5 = cotizacionesHojaToJson(5);
                    var cotizacionesHoja6 = cotizacionesHojaToJson(6);
                    var resumenPensiones = PensionResumida();
                    console.log(resumenPensiones);

                    var form = $("#formPaso1");
                    var formData =
                        form.serialize() +
                        "&tipoPlan=1" +
                        "&NewOrEdit=" +
                        NewOrEdit +
                        "&uuid=" +
                        uuid +
                        "&idCliente=" +
                        idCliente +
                        "&cotizacionesHoja1=" +
                        cotizacionesHoja1 +
                        "&cotizacionesHoja2=" +
                        cotizacionesHoja2 +
                        "&cotizacionesHoja3=" +
                        cotizacionesHoja3 +
                        "&cotizacionesHoja4=" +
                        cotizacionesHoja4 +
                        "&cotizacionesHoja5=" +
                        cotizacionesHoja5 +
                        "&cotizacionesHoja6=" +
                        cotizacionesHoja6 +
                        "&resumenPensiones=" +
                        resumenPensiones;
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
                            $.unblockUI();
                            setTimeout(function() {
                                location.href = "/gestionar-pension";
                            }, 1500);
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

    function cotizacionesHojaToJson(hoja) {
        var arreglo = [];
        var i = 1;
        var filas = $("#body-promedio-salarial-" + hoja).find("tr");
        arreglo = cargaFilasEstrategiasArrayHojas(hoja, arreglo);
        for (i = 7; i < filas.length; i++) {
            var celdas = $(filas[i]).find("td");

            concepto = celdas[0].innerText;
            // console.log(concepto);

            if ((i >= 1) & (i <= 4)) {
                indice = 2;
            } else {
                indice = 1;
            }
            cadFecDesde = celdas[indice].innerHTML;
            fechaDesde = cadFecDesde.substr(
                cadFecDesde.indexOf('value="') + 7,
                10
            );

            cadFecHasta = celdas[++indice].innerHTML;
            fechaHasta = cadFecHasta.substr(
                cadFecHasta.indexOf('value="') + 7,
                10
            );

            cadDias = celdas[++indice].innerHTML;
            dias = cadDias.substr(cadDias.indexOf('value="') + 7);
            dias = dias.substr(0, dias.length - 2);

            cadMonto = celdas[++indice].innerHTML;
            monto = cadMonto.substr(cadMonto.indexOf('value="') + 7);
            monto = monto.substr(0, monto.length - 8);
            console.log(monto);

            arreglo.push({
                hoja: "hoja-" + hoja,
                estrategia: "",
                fechaDesde: fechaDesde,
                fechaHasta: fechaHasta,
                dias: dias,
                monto: monto,
                totalMonto: dias * monto,
                inscripcion: 0
            });
        }

        return JSON.stringify(arreglo);
    }

    function cargaFilasEstrategiasArrayHojas(hoja, arreglo) {
        dias = $("#hoja-" + hoja + "-dias-mod40-alto").val();
        if (dias != "") {
            concepto = "M40 -ALTO 2";
            estrategia = 6;
            fechaDesde = dateIso(
                $("#hoja-" + hoja + "-fecha-desde-mod40-alto").val()
            );
            fechaHasta = dateIso(
                $("#hoja-" + hoja + "-fecha-hasta-mod40-alto").val()
            );

            dias = $("#hoja-" + hoja + "-dias-mod40-alto").val();
            monto = convertNumberPure(
                $("#hoja-" + hoja + "-sbc-mod40-alto").val()
            );
            arreglo.push({
                hoja: "hoja-" + hoja,
                estrategia: estrategia,
                fechaDesde: moment(fechaDesde).format("YYYY/MM/DD"),
                fechaHasta: moment(fechaHasta).format("YYYY/MM/DD"),
                dias: dias,
                monto: monto,
                totalMonto: dias * monto,
                inscripcion: 0
            });
        }

        dias = $("#hoja-" + hoja + "-dias-mod40-retroactivo").val();
        if (dias != "") {
            concepto = "RETROACTIVO";
            estrategia = 3;
            fechaDesde = dateIso(
                $("#hoja-" + hoja + "-fecha-desde-mod40-retroactivo").val()
            );
            fechaHasta = dateIso(
                $("#hoja-" + hoja + "-fecha-hasta-mod40-retroactivo").val()
            );
            dias = $("#hoja-" + hoja + "-dias-mod40-retroactivo").val();
            monto = convertNumberPure(
                $("#hoja-" + hoja + "-sbc-mod40-retroactivo").val()
            );
            arreglo.push({
                hoja: "hoja-" + hoja,
                estrategia: estrategia,
                fechaDesde: moment(fechaDesde).format("YYYY-MM-DD"),
                fechaHasta: moment(fechaHasta).format("YYYY-MM-DD"),
                dias: dias,
                monto: monto,
                totalMonto: dias * monto,
                inscripcion: 0
            });
        }

        dias = $("#hoja-" + hoja + "-dias-mod40-barata").val();
        if (dias != "") {
            concepto = "M40 BARATA";
            estrategia = 5;
            fechaDesde = dateIso(
                $("#hoja-" + hoja + "-fecha-desde-mod40-barata").val()
            );
            fechaHasta = dateIso(
                $("#hoja-" + hoja + "-fecha-hasta-mod40-barata").val()
            );
            dias = $("#hoja-" + hoja + "-dias-mod40-barata").val();
            monto = convertNumberPure(
                $("#hoja-" + hoja + "-sbc-mod40-barata").val()
            );
            arreglo.push({
                hoja: "hoja-" + hoja,
                estrategia: estrategia,
                fechaDesde: moment(fechaDesde).format("YYYY-MM-DD"),
                fechaHasta: moment(fechaHasta).format("YYYY-MM-DD"),
                dias: dias,
                monto: monto,
                totalMonto: dias * monto,
                inscripcion: 0
            });
        }

        dias = $("#hoja-" + hoja + "-dias-cooperativa").val();
        if (dias != "") {
            concepto = "COOPERATIVA";
            estrategia = 2;
            fechaDesde = dateIso(
                $("#hoja-" + hoja + "-fecha-desde-cooperativa").val()
            );
            fechaHasta = dateIso(
                $("#hoja-" + hoja + "-fecha-hasta-cooperativa").val()
            );
            dias = $("#hoja-" + hoja + "-dias-cooperativa").val();
            monto = convertNumberPure(
                $("#hoja-" + hoja + "-sbc-cooperativa").val()
            );
            insc = $(
                "#hoja-" + hoja + "-inscripcion-cooperativa-estrategia-2"
            ).val();
            arreglo.push({
                hoja: "hoja-" + hoja,
                estrategia: estrategia,
                fechaDesde: moment(fechaDesde).format("YYYY-MM-DD"),
                fechaHasta: moment(fechaHasta).format("YYYY-MM-DD"),
                dias: dias,
                monto: monto,
                totalMonto: dias * monto,
                inscripcion: insc
            });
        }

        dias = $("#hoja-" + hoja + "-dias-m40-pagada").val();
        if (dias != "") {
            concepto = "M40 YA PAGADA";
            estrategia = 4;
            fechaDesde = dateIso(
                $("#hoja-" + hoja + "-fecha-desde-m40-pagada").val()
            );
            fechaHasta = dateIso(
                $("#hoja-" + hoja + "-fecha-hasta-m40-pagada").val()
            );
            dias = $("#hoja-" + hoja + "-dias-m40-pagada").val();
            monto = convertNumberPure(
                $("#hoja-" + hoja + "-sbc-m40-pagada").val()
            );
            arreglo.push({
                hoja: "hoja-" + hoja,
                estrategia: estrategia,
                fechaDesde: moment(fechaDesde).format("YYYY-MM-DD"),
                fechaHasta: moment(fechaHasta).format("YYYY-MM-DD"),
                dias: dias,
                monto: monto,
                totalMonto: dias * monto,
                inscripcion: 0
            });
        }

        dias = $("#hoja-" + hoja + "-total-estrategia-1").val();
        if (dias != "") {
            concepto = "EN SU EMPRESA";
            estrategia = 1;
            fechaDesde = $("#hoja-" + hoja + "-fecha-desde-estrategia-1").val();

            fechaHasta = $("#hoja-" + hoja + "-fecha-hasta-estrategia-1").val();

            dias = $("#hoja-" + hoja + "-dias-estrategia-1").val();
            monto = convertNumberPure(
                $("#hoja-" + hoja + "-sbc-estrategia-1").val()
            );
            arreglo.push({
                hoja: "hoja-" + hoja,
                estrategia: estrategia,
                fechaDesde: moment(fechaDesde).format("YYYY-MM-DD"),
                fechaHasta: moment(fechaHasta).format("YYYY-MM-DD"),
                dias: dias,
                monto: monto,
                totalMonto: dias * monto,
                inscripcion: 0
            });
        }

        return arreglo;
    }

    function cotizacionesToJson() {
        var arreglo = [];
        var i = 1;
        $(".diasCotizacion").each(function() {
            row = $(this).attr("row");
            concepto = "Cotizaciones " + i;
            fechaDesde = $("#fechaDesde" + row).val();
            fechaHasta = $("#fechaHasta" + row).val();
            dias = $("#dias" + row).val();
            monto = $("#monto" + row).val();
            totalMonto = $("#totalMontoCotizacion" + row).val();
            if (parseInt(monto) > 0) {
                arreglo.push({
                    hoja: "hoja-1",
                    estrategia: "",
                    fechaDesde: fechaDesde,
                    fechaHasta: fechaHasta,
                    dias: dias,
                    monto: monto,
                    totalMonto: totalMonto,
                    inscripcion: 0
                });
                i++;
            }
        });

        return JSON.stringify(arreglo);
    }

    function PensionResumida() {
        var arreglo = [];
        var i = 1;
        // alert($("#hoja-1-pension-mesual-sin-m40").val());
        arreglo.push({
            hoja: "hoja-" + i,
            mensual: convertNumberPure(
                $("#hoja-1-pension-mesual-sin-m40").val()
            ),
            anual: convertNumberPure($("#hoja-1-pension-anual-sin-m40").val()),
            aguinaldo: convertNumberPure($("#hoja-1-aguinaldo").val()),
            total_anual: convertNumberPure($("#hoja-1-total-anual").val()),
            dif85: convertNumberPure($("#hoja-1-dif-85").val()),
            dif85Txt: 0,
            pagandoMensual: 0,
            costo_total: 0,
            semanas_cotizadas: $("#totalSemanas").val(),
            salario_diario_promedio: convertNumberPure(
                $("#promedio-salarios").text()
            ),
            esposa: $("#esposa").val(),
            hijos: $("#hijos").val(),
            padres: $("#padres").val(),
            edad_jubilacion: $("#edadDe").val()
        });

        for (i = 2; i <= 6; i++) {
            arreglo.push({
                hoja: "hoja-" + i,
                mensual: convertNumberPure(
                    $(
                        "#hoja-" + i.toString() + "-pension-mensual-con-m40"
                    ).val()
                ),
                anual: convertNumberPure(
                    $("#hoja-" + i.toString() + "-pension-anual-con-m40").val()
                ),
                aguinaldo: convertNumberPure(
                    $("#hoja-" + i.toString() + "-aguinaldo").val()
                ),
                total_anual: convertNumberPure(
                    $("#hoja-" + i.toString() + "-total-anual").val()
                ),
                dif85: convertNumberPure(
                    $("#hoja-" + i.toString() + "-dif-85").val()
                ),
                dif85Txt: $(
                    "#hoja-" + i.toString() + "-dif-edad-85-text"
                ).text(),
                pagandoMensual: convertNumberPure(
                    $(
                        "#hoja-" + i.toString() + "-otro-valor-estrategia-6"
                    ).val()
                ),
                costo_total: costo_x_estrategias(i.toString()),
                semanas_cotizadas: $(
                    "#hoja-" + i.toString() + "-nro-semanas-cotizadas"
                ).val(),

                salario_diario_promedio: convertNumberPure(
                    $(
                        "#hoja-" +
                            i.toString() +
                            "-salario-promedio-mensual-250-semanas"
                    ).val()
                ),
                esposa: $("#hoja-" + i.toString() + "-esposa").val(),
                hijos: $("#hoja-" + i.toString() + "-hijos").val(),
                padres: $("#hoja-" + i.toString() + "-padres").val(),
                edad_jubilacion: $(
                    "#hoja-" + i.toString() + "-edad-jubilacion"
                ).val()
            });
        }

        return JSON.stringify(arreglo);
    }

    function costo_x_estrategias(hoja) {
        total_costo = 0;
        for (estrategia = 2; estrategia <= 6; estrategia++) {
            costo = $(
                "#hoja-" + hoja + "-costo-estrategia-" + estrategia
            ).val();
            if (costo != "") {
                total_costo += parseFloat(convertNumberPure(costo));
            }
        }

        return total_costo;
    }
});
