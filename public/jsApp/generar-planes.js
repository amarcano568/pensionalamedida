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

    $("html, body").animate({ scrollTop: 0 }, 1250);

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
            $("#salarios-totales").text($.number(totalSalarios, 2, ",", "."));
            $("#dias-totales").text(1750);
            $("#promedio-salarios").text(
                $.number(totalSalarios / 1750, 2, ",", ".")
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
});
