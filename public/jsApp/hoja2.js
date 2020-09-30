$(document).on("ready", function() {
    var edadJubilacionReal = 0;

    $("#btn-carga-estrategias-hoja2").click(function(event) {
        event.preventDefault();

        semanasCotizadas = $("#totalSemanas").val();
        salarioDiarioPromedio = $("#promedio-salarios").text();
        edadJubilacion = $("#edadDe").val();
        salarioDiarioPromedio = convertNumberPure(salarioDiarioPromedio);

        loadingUI("Calculando formulas...", "white");
        setTimeout(function() {
            $.unblockUI();
            $("#hoja-2-fecha-nacimiento").val(
                moment($("#fechaNacimiento").val()).format("DD-MM-YYYY")
            );
            $("#hoja-2-fecha-plan").val(
                moment($("#fechaPlan").val()).format("DD-MM-YYYY")
            );
            edad = $("#divEdadCliente").text();
            $("#hoja-2-edad").val(edad);

            $("#hoja-2-fecha-baja").val($("#fechaBaja").val());

            $("#hoja-2-semanas-cotizadas").val($("#semanasCotizadas").val());
            $("#hoja-2-semanas-descontadas").val(
                $("#semanasDescontadas").val()
            );
            $("#hoja-2-total-semanas").val($("#totalSemanas").val());

            $("#hoja-2-edad-retiro").val($("#edadDe").val() + " Años");

            calcularTiempoIndividualHoja2();
            /////////////////
            edadA = $("#edadA").val();
            edadDe = $("#edadDe").val();
            rangoPensionDe = $("#rangoPensionDe").val();
            rangoPensionA = $("#rangoPensionA").val();
            rangoInversionDe = $("#rangoInversionDe").val();
            rangoInversionA = $("#rangoInversionA").val();

            $("#hoja-2-edad-desde").val(edadDe);
            $("#hoja-2-edad-hasta").val(edadA);
            $("#hoja-2-monto-pension-desde").val(
                $.number(rangoPensionDe, 2, ".", ",")
            );
            $("#hoja-2-monto-pension-hasta").val(
                $.number(rangoPensionA, 3, ".", ",")
            );
            $("#hoja-2-pagos-desde").val(
                $.number(rangoInversionDe, 2, ".", ",")
            );
            $("#hoja-2-pagos-hasta").val(
                $.number(rangoInversionA, 2, ".", ",")
            );

            $("#modal-hoja-2-estrategias").modal("show");
        }, 1500);
    });

    function calcularTiempoIndividualHoja2() {
        fecNac = $("#fechaNacimiento").val();
        edadA = $("#edadA").val();
        fecPlan = $("#fechaPlan").val();
        $.ajax({
            url: "/calcular-tiempo-individual-faltante-retiro",
            type: "get",
            data: { fecNac: fecNac, edadA: edadA, fecPlan: fecPlan },
            dataType: "json"
        })
            .done(function(response) {
                console.log(response);
                $("#hoja-2-anos-retiro").val(response.data.anos);
                $("#hoja-2-meses-retiro").val(response.data.meses);
                $("#hoja-2-semanas-retiro").val(response.data.semanas);
                $("#hoja-2-dias-retiro").val(response.data.dias);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                ////console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    $("#btn-carga-cotizaciones-hoja2").click(function(event) {
        event.preventDefault();
        cargaTablaCotizaciones();
    });
    function cargaTablaCotizaciones() {
        filas = $("#table-cotizaciones >tbody >tr").length + 1;
        i = 0;
        fila = $("#table-promedio-salarial-2 tr:last").attr("row");
        concepto = 6;
        $(".diasCotizacion").each(function() {
            row = $(this).attr("row");
            fechaDesde = $("#fechaDesde" + row).val();
            fechaHasta = $("#fechaHasta" + row).val();
            dias = $("#dias" + row).val();
            monto = $("#monto" + row).val();
            totalMontoCotizacion = $("#totalMontoCotizacion" + row).val();
            i++;
            fila++;
            concepto++;
            agregarTablePromedio(
                fila,
                fechaDesde,
                fechaHasta,
                dias,
                monto,
                totalMontoCotizacion,
                i,
                concepto
            );
        });
        totaldiasHojas2(0);
    }

    function agregarTablePromedio(
        filas,
        fechaDesde,
        fechaHasta,
        dias,
        monto,
        totalMontoCotizacion,
        i,
        concepto
    ) {
        var htmlTags =
            '<tr row="' +
            filas +
            '" id="' +
            filas +
            '">' +
            '<td id="hoja-2-concepto-' +
            concepto +
            '" colspan="2" style="vertical-align:middle" class="concepto text-center"> Cotizaciones ' +
            i +
            "</td>" +
            '<td class=""><input type="date" row="' +
            filas +
            '" id="promedio2fechaDesde' +
            filas +
            '" class="input-xs form-control" value="' +
            fechaDesde +
            '" readonly></td>' +
            '<td class=""><input type="date" row="' +
            filas +
            '" id="promedio2fechaHasta' +
            filas +
            '" class="input-xs form-control" value="' +
            fechaHasta +
            '" readonly></td>' +
            '<td class=""><input type="text" row="' +
            filas +
            '" id="promedio2dias' +
            filas +
            '" class="input-xs hoja-2-dias form-control" readonly value="' +
            dias +
            '"></td>' +
            '<td class="">' +
            '<div class="input-group">' +
            '<div class="input-group-prepend">' +
            '<span class="input-group-text input-group-text-xs">$</span>' +
            "</div>" +
            '<input type="number" row="' +
            filas +
            '" id="promedio2monto' +
            filas +
            '" class="input-xs form-control" readonly value="' +
            monto +
            '">' +
            "</div>" +
            "</td>" +
            '<td class="">' +
            '<div class="input-group">' +
            '<div class="input-group-prepend">' +
            '<span class="input-group-text input-group-text-xs">$</span>' +
            "</div>" +
            '<input type="text" row="' +
            filas +
            '" id="promedio2totalMontoCotizacion' +
            filas +
            '" class="input-xs form-control  total-cotizacion-promedio-salarial-2" readonly value="' +
            $.number(totalMontoCotizacion, 2, ".", ",") +
            '">' +
            "</div>" +
            "</td>" +
            '<td class=""><a href="#" class="hoja-2-borrar-cotizacion"><i class="text-danger far fa-trash-alt"></i></a></td>' +
            "</tr>";

        $("#table-promedio-salarial-2 tbody").append(htmlTags);
    }

    $(".x_title_hoja2").click(function(event) {
        event.preventDefault();
        var d = new Date();
        var dia = d.getDate();
        var mes = "0" + (d.getMonth() + 1);
        var anio = d.getFullYear();
        var fechaHoy = anio + "-" + pad(mes, 2) + "-" + pad(dia, 2);
        //$("#fechaPlan").val(fechaHoy);
        estrategia = $(this).attr("estrategia");

        if (NewOrEdit == "New") {
            $("#hoja-2-fecha-desde-estrategia-" + estrategia).val(fechaHoy);
            $("#hoja-2-fecha-hasta-estrategia-" + estrategia).val(fechaHoy);
            $("#hoja-2-fecha-desde-estrategia-" + estrategia).focus();
        } else {
            $("#hoja-2-fecha-desde-estrategia-" + estrategia).focus();
            // $("#hoja-2-edad-estrategia-" + estrategia).focus();
            $("#hoja-2-sbc-estrategia-" + estrategia).focus();
            $("#hoja-2-total-estrategia-" + estrategia).focus();
        }

        desde = $("#hoja-2-fecha-nacimiento").val();
        hasta = $("#hoja-2-fecha-desde-estrategia-" + estrategia).val();
        calculaFechasHoja2(
            desde,
            hasta,
            "#hoja-2-edad-estrategia-" + estrategia
        );
    });

    function calculaFechasHoja2(desde, hasta, elementoDom) {
        $.ajax({
            url: "/edad-cliente",
            type: "get",
            data: { fecNac: desde, fechaFutura: hasta },
            dataType: "json"
        })
            .done(function(response) {
                ////console.log(response);
                $(elementoDom).val(response.data);
                $("#hoja-2-edad-real-pension").val(response.difInDays);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                ////console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    $(".hoja-2-fecha-desde-estrategia").focusout(function(ev) {
        estrategia = $(this).attr("estrategia");
        desde = $("#hoja-2-fecha-nacimiento").val();
        hasta = $("#hoja-2-fecha-desde-estrategia-" + estrategia).val();
        calculaFechasHoja2(
            desde,
            hasta,
            "#hoja-2-edad-estrategia-" + estrategia
        );

        fecDesde = $("#hoja-2-fecha-desde-estrategia-" + estrategia).val();
        fecHasta = $("#hoja-2-fecha-hasta-estrategia-" + estrategia).val();
        calculaDiasEntreFechas(fecDesde, fecHasta, estrategia);
    });

    function calculaDiasEntreFechas(fecDesde, fecHasta, estrategia) {
        $.ajax({
            url: "/calcular-dias-entre-fechas",
            type: "get",
            data: { fechaDesde: fecDesde, fechaHasta: fecHasta },
            dataType: "json"
        })
            .done(function(response) {
                //2020-06-29 2020-07-10 2020-06-29 2020-07-09
                ////console.log(response);
                $("#hoja-2-dias-estrategia-" + estrategia).val(response.data);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                ////console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    $(".addDayEstrategias").click(function(event) {
        event.preventDefault();
        elem = $(this).attr("sumaDias");
        $(elem).show();
        $(elem).focus();
    });

    $(".OksumarDias").click(function(event) {
        event.preventDefault();
        elem = $(this).attr("elemento");
        fecha = $(this).attr("fecha");
        id = $(this).attr("id");
        desdefecha = $(this).attr("desdefecha");
        diasFormulaEvaluar = $(elem).val();

        if (diasFormulaEvaluar == "") {
            return;
        }
        fechaDondesumar = $(desdefecha).val();
        $.ajax({
            url: "/sumar-dias-a-fecha-estrategias",
            type: "get",
            data: {
                diasFormulaEvaluar: diasFormulaEvaluar,
                fechaDondesumar: fechaDondesumar
            },
            dataType: "json"
        })
            .done(function(response) {
                ////console.log(response);
                $(fecha).val(response.data);
                $("#hoja-2-sumas-dias-estrategia-" + id).hide();
                fecDesde = $("#hoja-2-fecha-desde-estrategia-" + id).val();
                fecHasta = $(fecha).val();
                calculaDiasEntreFechas(fecDesde, fecHasta, id);
                ////alert(fecDesde + " " + fecHasta);
                desde = $("#fechaNacimiento").val();
                hasta = $("#hoja-2-fecha-hasta-estrategia-" + id).val();
                ////alert(desde + " " + hasta);
                calculaFechasHoja2(
                    desde,
                    hasta,
                    "#hoja-2-edad-estrategia-" + id
                );

                setTimeout(function() {
                    dias = $("#hoja-2-dias-estrategia-" + id).val();
                    anos = parseInt(dias) / 365;
                    $("#hoja-2-anos-estrategia-" + id).val(
                        $.number(anos, 2, ".", ",")
                    );

                    meses = anos * 12;
                    $("#hoja-2-meses-estrategia-" + id).val(
                        $.number(meses, 2, ".", ",")
                    );

                    semanas = dias / 7;
                    $("#hoja-2-semanas-estrategia-" + id).val(
                        $.number(semanas, 2, ".", ",")
                    );
                    $("#hoja-2-sbc-estrategia-" + id).focus();
                }, 1000);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                ////console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $(".sbc-monto-estrategia").focusout(function(ev) {
        estrategia = $(this).attr("estrategia");
        sbc = $(this).val();
        dias = $("#hoja-2-dias-estrategia-" + estrategia).val();
        total = parseFloat(sbc) * parseFloat(dias);
        $("#hoja-2-total-estrategia-" + estrategia).val(
            $.number(total, 2, ".", ",")
        );

        meses = convertNumberPure(
            $("#hoja-2-meses-estrategia-" + estrategia).val()
        );
        fecDesde = $("#hoja-2-fecha-desde-estrategia-" + estrategia).val();
        fecHasta = $("#hoja-2-fecha-hasta-estrategia-" + estrategia).val();
        switch (estrategia) {
            case 1:
                break;
            case "2":
                // Costo coopeartiva
                calculaCostoCooperativa(estrategia);
                $("#hoja-2-fecha-desde-cooperativa").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-2-fecha-hasta-cooperativa").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-2-dias-cooperativa").val(dias);
                $("#hoja-2-sbc-cooperativa").val($.number(sbc, 2, ".", ","));
                $("#hoja-2-monto-base-cooperativa").val(
                    $.number(total, 2, ".", ",")
                );
                break;
            case "3":
                // Costo M40 retroactivo
                costo = total * 0.10075;
                $("#hoja-2-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ".", ",")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-2-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ".", ",")
                );
                $("#hoja-2-fecha-desde-mod40-retroactivo").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-2-fecha-hasta-mod40-retroactivo").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-2-dias-mod40-retroactivo").val(dias);
                $("#hoja-2-sbc-mod40-retroactivo").val(
                    $.number(sbc, 2, ".", ",")
                );
                $("#hoja-2-monto-base-mod40-retroactivo").val(
                    $.number(total, 2, ".", ",")
                );
                break;
            case "4":
                // Costo M40 ya pagada
                costo = total * 0.10075;
                $("#hoja-2-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ".", ",")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-2-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ".", ",")
                );
                $("#hoja-2-fecha-desde-m40-pagada").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-2-fecha-hasta-m40-pagada").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-2-dias-m40-pagada").val(dias);
                $("#hoja-2-sbc-m40-pagada").val($.number(sbc, 2, ".", ","));
                $("#hoja-2-monto-base-m40-pagada").val(
                    $.number(total, 2, ".", ",")
                );
                break;
            case "5":
                // Costo M40 mas barata
                costo = total * 0.10075;
                $("#hoja-2-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ".", ",")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-2-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ".", ",")
                );
                $("#hoja-2-fecha-desde-mod40-barata").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-2-fecha-hasta-mod40-barata").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-2-dias-mod40-barata").val(dias);
                $("#hoja-2-sbc-mod40-barata").val($.number(sbc, 2, ".", ","));
                $("#hoja-2-monto-base-mod40-barata").val(
                    $.number(total, 2, ".", ",")
                );
                break;
            case "6":
                // Costo M40 Salario alto
                costo = total * 0.10075;
                $("#hoja-2-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ".", ",")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-2-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ".", ",")
                );

                $("#hoja-2-fecha-desde-mod40-alto").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-2-fecha-hasta-mod40-alto").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-2-dias-mod40-alto").val(dias);
                $("#hoja-2-sbc-mod40-alto").val($.number(sbc, 2, ".", ","));
                $("#hoja-2-monto-base-mod40-alto").val(
                    $.number(total, 2, ".", ",")
                );
                break;
        }

        changeChosenEdadPensionHoja2(estrategia);
    });

    function changeChosenEdadPensionHoja2(estrategia) {
        edadJubilacion = $("#hoja-2-edad-estrategia-" + estrategia).val();
        mes = parseInt(edadJubilacion.substr(9, 2));
        ano = parseInt(edadJubilacion.substr(0, 2));
        edadPension1 = mes >= 6 ? ano + 1 : ano;
        edadPension1 = edadPension1 > 65 ? 65 : edadPension1;

        switch (estrategia) {
            case "1":
                concepto = " años - Empresa actual";
                break;
            case "2":
                concepto = " años - Cooperativa";
                break;
            case "3":
                concepto = " años - M40 Retroactivo";
                break;
            case "4":
                concepto = " años - M40 Ya Pagada";
                break;
            case "5":
                concepto = " años - M40 Barata";
                break;
            case "6":
                concepto = " años - M40 Salario Alto";
                break;
        }

        $(
            "#hoja-2-edad-calculo-pension option[value='" + estrategia + "']"
        ).remove();

        $("#hoja-2-edad-calculo-pension").append(
            '<option value="' +
                estrategia +
                '" >' +
                edadPension1 +
                concepto +
                "</option>"
        );

        $("#hoja-2-edad-calculo-pension").trigger("chosen:updated");
    }

    function calculaCostoCooperativa(estrategia) {
        meses = convertNumberPure(
            $("#hoja-2-meses-estrategia-" + estrategia).val()
        );
        inscCooperativa = convertNumberPure(
            $("#hoja-2-inscripcion-cooperativa-estrategia-" + estrategia).val()
        );
        tot1 = meses * 1750;
        costo = inscCooperativa + tot1;
        $("#hoja-2-costo-estrategia-" + estrategia).val(
            $.number(costo, 2, ".", ",")
        );
        otros = costo / meses;
        $("#hoja-2-otro-valor-estrategia-" + estrategia).val(
            $.number(otros, 2, ".", ",")
        );
    }

    $("#hoja-2-inscripcion-cooperativa-estrategia-2").focusout(function(ev) {
        estrategia = $(this).attr("estrategia");
        calculaCostoCooperativa(estrategia);
    });

    $("#modal-hoja-2-estrategias").on("show.bs.modal", function() {
        for (i = 1; i <= 6; i++) {
            dias = $("#hoja-2-dias-estrategia-" + i).val();
            if (dias != "") {
                $("#hoja-2-x_content-" + i).attr("style", "display: block;");
            } else {
                $("#hoja-2-x_content-" + i).attr("style", "display: none;");
            }
        }
    });

    // $("#modal-hoja-2-estrategias").on("hide.bs.modal", function() {
    //     totaldiasHojas2(0);
    // });

    $("#btn-cerrar-modal-hoja-2").click(function(event) {
        estrategiaEdad = $("#hoja-2-edad-calculo-pension").val();
        edadJubilacion = $("#hoja-2-edad-estrategia-" + estrategiaEdad).val();
        mes = parseInt(edadJubilacion.substr(9, 2));
        ano = parseInt(edadJubilacion.substr(0, 2));
        edadPension = mes >= 6 ? ano + 1 : ano;
        edadPension = edadPension > 65 ? 65 : edadPension;

        if (parseInt(edadPension) >= 60) {
            edadMayor = edadMayorFunc("hoja-2");
            console.log(edadPension + " <=> " + edadMayor[0].edad);
            if (edadPension < edadMayor[0].edad) {
                alertify
                    .confirm(
                        '<h5 class="text-primary">Edad incorrecta para calculo de pensión.</h5>',
                        '<h5 class="text-secondary">Se recomienda usar la edad de <strong>' +
                            edadMayor[0].edad +
                            "</strong> años generada en la estrategia " +
                            edadMayor[0].estrategia +
                            "</h5>",
                        function() {
                            return;
                        },
                        function() {
                            totaldiasHojas2(0);
                            $("#modal-hoja-2-estrategias").modal("hide");
                        }
                    )
                    .set("labels", {
                        ok:
                            '<i class="fas fa-check"></i> Seleccionar edad sugerida',
                        cancel: "Cerrar con edad seleccionada"
                    })
                    .set({
                        transition: "zoom"
                    })
                    .set({
                        modal: true,
                        closableByDimmer: false
                    });
            } else {
                totaldiasHojas2(0);
                $("#modal-hoja-2-estrategias").modal("hide");
            }
        } else {
            alertify
                .confirm(
                    '<h5 class="text-primary"><i class="fas fa-calculator"></i> Calcular Pensión.</h5>',
                    '<h5 class="text-secondary">La edad de calculo de la pensión es menor a 60 años, si cierra la ventana de estrategias sin corregir la edad no realizara un nuevo calculo de pensión mensual. </h5>',
                    function() {
                        return;
                    },
                    function() {
                        // En caso de Cancelar
                        alertify.error(
                            '<i class="fa-2x fas fa-ban"></i><br>No se realizo el nuevo calculo de Pensión.'
                        );
                        $("#modal-hoja-2-estrategias").modal("hide");
                    }
                )
                .set("labels", {
                    ok: '<i class="fas fa-check"></i> Corregir edad',
                    cancel: "Cerrar sin corregir edad"
                })
                .set({
                    transition: "zoom"
                })
                .set({
                    modal: true,
                    closableByDimmer: false
                });
        }
    });

    function totaldiasHojas2(changeMonto) {
        diasTotal = 0;
        $(".hoja-2-dias").each(function() {
            dias = $(this).val();
            ////console.log(dias);
            if (dias != "") {
                diasTotal += parseInt(dias);
            }
        });

        totalCotiza = 0;
        $(".total-cotizacion-promedio-salarial-2").each(function() {
            totalCotizacion = $(this).val();
            ////console.log(totalCotizacion);
            if (totalCotizacion != "") {
                //console.log(convertNumberPure(totalCotizacion));
                totalCotiza += convertNumberPure(totalCotizacion);
            }
        });

        if (diasTotal < 1750) {
            $("#hoja-2-total-dias").val($.number(diasTotal, 2, ".", ","));
            $("#hoja-2-dias-excedidos").val($.number(0, 2, ".", ","));
            $("#hoja-2-dias-equivalentes-250").val($.number(0, 2, ".", ","));
            return false;
        }
        diasExcedidos = diasTotal - 1750;
        diasEquivalentes250 = diasTotal - diasExcedidos;

        $("#hoja-2-total-dias").val($.number(diasTotal, 2, ".", ","));
        $("#hoja-2-dias-excedidos").val($.number(diasExcedidos, 2, ".", ","));
        $("#hoja-2-dias-equivalentes-250").val(
            $.number(diasEquivalentes250, 2, ".", ",")
        );

        cargaTablaCambioSalalario();

        monto = $("#monto-a-descontar-excedido").val();

        salarioNeto = parseInt(diasExcedidos) * parseFloat(monto);
        $("#hoja-2-salarios-neto").val($.number(monto, 2, ".", ","));

        salarioBasePromedio = totalCotiza - monto;
        $("#hoja-2-salario-base-promedio").val(
            $.number(salarioBasePromedio, 2, ".", ",")
        );

        promedioUltimasSemanas = salarioBasePromedio / 1750;

        $("#hoja-2-entre").val($("#hoja-2-dias-equivalentes-250").val());
        $("#hoja-2-prom-ultimas-250-sem").val(
            $.number(promedioUltimasSemanas, 2, ".", ",")
        );

        semanasCotizadas = $("#totalSemanas").val();
        semanasCotiza = 0;
        $(".semanas-cotizadas-estrategia").each(function() {
            semanas = $(this).val();
            if (semanas != "") {
                semanasCotiza += parseFloat(semanas);
            }
        });
        console.log(semanasCotiza);
        semanasCotizadas =
            parseInt(semanasCotizadas) + Math.round(semanasCotiza);

        estrategiaEdad = $("#hoja-2-edad-calculo-pension").val();

        edadJubilacion = $("#hoja-2-edad-estrategia-" + estrategiaEdad).val();
        mes = parseInt(edadJubilacion.substr(9, 2));
        ano = parseInt(edadJubilacion.substr(0, 2));
        edadPension = mes >= 6 ? ano + 1 : ano;
        edadPension = edadPension > 65 ? 65 : edadPension;
        salarioDiarioPromedio = promedioUltimasSemanas;
        $("#hoja-2-nro-semanas-cotizadas").val(semanasCotizadas);
        $("#hoja-2-salario-promedio-mensual-250-semanas").val(
            $.number(salarioDiarioPromedio, 2, ".", ",")
        );
        $("#hoja-2-esposa").val($("#esposa").val());
        $("#hoja-2-hijos").val($("#hijos").val());
        $("#hoja-2-padres").val($("#padres").val());

        //hoja-2-edad-calculo-pension
        $("#hoja-2-edad-jubilacion").val(edadPension);
        //alert(edadPension);
        calculaFormulasExcelHojas(
            semanasCotizadas,
            salarioDiarioPromedio,
            edadPension,
            false,
            "hoja-2"
        );
        /////
    }

    $(".delete-estrategia-hoja2").click(function(event) {
        event.preventDefault();
        estrategia = $(this).attr("estrategia");
        $("#hoja-2-fecha-desde-estrategia-" + estrategia).val("");
        $("#hoja-2-fecha-hasta-estrategia-" + estrategia).val("");
        $("#hoja-2-edad-estrategia-" + estrategia).val("");
        $("#hoja-2-anos-estrategia-" + estrategia).val("");
        $("#hoja-2-meses-estrategia-" + estrategia).val("");
        $("#hoja-2-semanas-estrategia-" + estrategia).val("");
        $("#hoja-2-dias-estrategia-" + estrategia).val("");
        $("#hoja-2-sbc-estrategia-" + estrategia).val("");
        $("#hoja-2-total-estrategia-" + estrategia).val("");
        $("#hoja-2-costo-estrategia-" + estrategia).val("");
        $("#hoja-2-otro-valor-estrategia-" + estrategia).val("");
        $(".hoja-2-estrategia-" + estrategia).val("");
        $(
            "#hoja-2-edad-calculo-pension option[value='" + estrategia + "']"
        ).remove();
        $("#hoja-2-edad-calculo-pension").trigger("chosen:updated");
    });

    $(document).on("click", ".hoja-2-borrar-cotizacion", function(event) {
        event.preventDefault();
        $(this)
            .closest("tr")
            .remove();
        totaldiasHojas2(0);
    });

    $(document).on("click", "#cambiar-salario-calculo", function(event) {
        event.preventDefault();
        // if ($("#hoja-2-dias-excedidos").val() == "") {
        //     return false;
        // }
        cargaTablaCambioSalalario();
        $("#modal-cambiar-salario").modal("show");
    });

    function cargaTablaCambioSalalario() {
        i = 0;
        fila = 1;

        //$("#table-cambiar-salario tr:not(:first-child)").remove();
        $("#table-cambiar-salario tr").remove();
        cargaFilasEstrategias();
        i = 1;

        var filas = $("#body-promedio-salarial-2").find("tr");
        totalGeneral = 0.0;
        for (i = 7; i < filas.length; i++) {
            var celdas = $(filas[i]).find("td");

            concepto = celdas[0].innerText;
            ////console.log(concepto);

            cadFecDesde = celdas[1].innerHTML;
            fechaDesde = cadFecDesde.substr(
                cadFecDesde.indexOf('value="') + 7,
                10
            );

            cadFecHasta = celdas[2].innerHTML;
            fechaHasta = cadFecHasta.substr(
                cadFecHasta.indexOf('value="') + 7,
                10
            );

            cadDias = celdas[3].innerHTML;
            dias = cadDias.substr(cadDias.indexOf('value="') + 7);
            dias = dias.substr(0, dias.length - 2);

            cadMonto = celdas[4].innerHTML;
            monto = cadMonto.substr(cadMonto.indexOf('value="') + 7);
            monto = monto.substr(0, monto.length - 8);
            ////console.log(monto);

            agregarTableCambiosalario(
                concepto,
                moment(fechaDesde).format("DD-MM-YYYY"),
                moment(fechaHasta).format("DD-MM-YYYY"),
                dias,
                monto
            );
        }

        var tbody = $("#table-cambiar-salario tbody");
        $("#table-cambiar-salario tbody").html(
            $("tr", tbody)
                .get()
                .reverse()
        );

        $("#body-salario-excedido").empty();

        diasExcedidos = $("#hoja-2-dias-excedidos").val();
        $("#dias-excedidos-calculo").html(diasExcedidos);

        excedidos = convertNumberPure(diasExcedidos);
        var filas = $("#body-cambiar-salario").find("tr");
        totalGeneral = 0.0;
        for (i = 0; i < filas.length; i++) {
            var celdas = $(filas[i]).find("td");

            diasTable = parseInt(celdas[3].innerText);
            monto = celdas[4].innerText;
            monto = monto.replace("$ ", "");
            if (monto.indexOf(",") > -1) {
                monto = convertNumberPure(monto);
            }
            montoCotizado = monto;
            if (diasTable >= excedidos) {
                totalMontoExcedido = excedidos * montoCotizado;
                totalGeneral += totalMontoExcedido;
                htmlTags =
                    "<tr><td class='text-center'>" +
                    excedidos +
                    "</td><td class='text-right'>" +
                    celdas[4].innerText +
                    "</td><td class='text-right'>$ " +
                    $.number(totalMontoExcedido, 2, ".", ",") +
                    "</td></tr>";
                $("#table-salario-excedido tbody").append(htmlTags);
                break;
            } else {
                totalMontoExcedido = diasTable * montoCotizado;
                totalGeneral += totalMontoExcedido;
                htmlTags =
                    "<tr><td class='text-center'>" +
                    diasTable +
                    "</td><td class='text-right'>" +
                    celdas[4].innerText +
                    "</td><td class='text-right'>$ " +
                    $.number(totalMontoExcedido, 2, ".", ",") +
                    "</td></tr>";
                $("#table-salario-excedido tbody").append(htmlTags);
                excedidos = excedidos - diasTable;
            }

            ////alert(diasTotal);
        }

        htmlTags =
            "<tr style='background-color: #F2DEDE'><td colspan='2' class='text-center'>Total <strong>Monto Base</strong> a descontar</td>" +
            "<td class='text-right text-danger'>$ " +
            $.number(totalGeneral, 2, ".", ",") +
            "</td></tr>";
        $("#table-salario-excedido tbody").append(htmlTags);

        //$("#hoja-2-salarios-neto").val(totalGeneral);
        $("#monto-a-descontar-excedido").val(totalGeneral);

        //totaldiasHojas2(0);
    }

    function cargaFilasEstrategias() {
        dias = $("#hoja-2-dias-mod40-alto").val();
        if (dias != "") {
            concepto = "M40 -ALTO 2";
            fechaDesde = $("#hoja-2-fecha-desde-mod40-alto").val();
            fechaHasta = $("#hoja-2-fecha-hasta-mod40-alto").val();
            dias = $("#hoja-2-dias-mod40-alto").val();
            monto = $("#hoja-2-sbc-mod40-alto").val();
            agregarTableCambiosalario(
                concepto,
                fechaDesde,
                fechaHasta,
                dias,
                monto
            );
        }

        dias = $("#hoja-2-dias-mod40-retroactivo").val();
        if (dias != "") {
            concepto = "RETROACTIVO";
            fechaDesde = $("#hoja-2-fecha-desde-mod40-retroactivo").val();
            fechaHasta = $("#hoja-2-fecha-hasta-mod40-retroactivo").val();
            dias = $("#hoja-2-dias-mod40-retroactivo").val();
            monto = $("#hoja-2-sbc-mod40-retroactivo").val();
            agregarTableCambiosalario(
                concepto,
                fechaDesde,
                fechaHasta,
                dias,
                monto
            );
        }

        dias = $("#hoja-2-dias-mod40-barata").val();
        if (dias != "") {
            concepto = "M40 BARATA";
            fechaDesde = $("#hoja-2-fecha-desde-mod40-barata").val();
            fechaHasta = $("#hoja-2-fecha-hasta-mod40-barata").val();
            dias = $("#hoja-2-dias-mod40-barata").val();
            monto = $("#hoja-2-sbc-mod40-barata").val();
            agregarTableCambiosalario(
                concepto,
                fechaDesde,
                fechaHasta,
                dias,
                monto
            );
        }

        dias = $("#hoja-2-dias-cooperativa").val();
        if (dias != "") {
            concepto = "COOPERATIVA";
            fechaDesde = $("#hoja-2-fecha-desde-cooperativa").val();
            fechaHasta = $("#hoja-2-fecha-hasta-cooperativa").val();
            dias = $("#hoja-2-dias-cooperativa").val();
            monto = $("#hoja-2-sbc-cooperativa").val();
            agregarTableCambiosalario(
                concepto,
                fechaDesde,
                fechaHasta,
                dias,
                monto
            );
        }

        dias = $("#hoja-2-dias-m40-pagada").val();
        if (dias != "") {
            concepto = "M40 YA PAGADA";
            fechaDesde = $("#hoja-2-fecha-desde-m40-pagada").val();
            fechaHasta = $("#hoja-2-fecha-hasta-m40-pagada").val();
            dias = $("#hoja-2-dias-m40-pagada").val();
            monto = $("#hoja-2-sbc-m40-pagada").val();
            agregarTableCambiosalario(
                concepto,
                fechaDesde,
                fechaHasta,
                dias,
                monto
            );
        }
    }

    function agregarTableCambiosalario(
        concepto,
        fechaDesde,
        fechaHasta,
        dias,
        monto
    ) {
        var htmlTags =
            '<tr><td><a class="clickCambiaSalario" monto_sbc="' +
            monto +
            '" href="">' +
            concepto +
            '</a></td><td class="text-center"><a class="clickCambiaSalario" monto_sbc="' +
            monto +
            '" href="">' +
            fechaDesde +
            '</a></td><td class="text-center"><a class="clickCambiaSalario" monto_sbc="' +
            monto +
            '" href="">' +
            fechaHasta +
            '</a></td><td class="text-center"><a class="clickCambiaSalario" monto_sbc="' +
            monto +
            '" href="">' +
            dias +
            '</a></td><td class="text-right"><a class="clickCambiaSalario" monto_sbc="' +
            monto +
            '" href="">$ ' +
            monto +
            "</a></td></tr>";

        $("#table-cambiar-salario tbody").append(htmlTags);
    }

    $(document).on("click", ".clickCambiaSalario", function(event) {
        event.preventDefault();
        // monto_sbc = $(this).attr("monto_sbc");

        // $("#hoja-2-salarios-excedidos").val(monto_sbc);
        // totaldiasHojas2(monto_sbc);
        // $("#modal-cambiar-salario").modal("hide");
    });

    $("#btn-formulas-hoja-2").click(function(event) {
        event.preventDefault();

        semanasCotizadas = $("#hoja-2-nro-semanas-cotizadas").val();
        salarioDiarioPromedio = $(
            "#hoja-2-salario-promedio-mensual-250-semanas"
        ).val();
        edadJubilacion = $("#hoja-2-edad-jubilacion").val();
        //alert(salarioDiarioPromedio);
        salarioDiarioPromedio = convertNumberPure(salarioDiarioPromedio);
        calculaFormulasExcelHojas(
            semanasCotizadas,
            salarioDiarioPromedio,
            edadJubilacion,
            true,
            edadJubilacionReal
        );
    });
});
