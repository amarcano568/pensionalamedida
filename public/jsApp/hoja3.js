$(document).on("ready", function() {
    $("#btn-carga-estrategias-hoja3").click(function(event) {
        event.preventDefault();

        semanasCotizadas = $("#totalSemanas").val();
        salarioDiarioPromedio = $("#promedio-salarios").text();
        edadJubilacion = $("#edadDe").val();
        salarioDiarioPromedio = convertNumberPure(salarioDiarioPromedio);

        // calculaFormulasExcel(
        //     semanasCotizadas,
        //     salarioDiarioPromedio,
        //     edadJubilacion,
        //     false
        // );
        loadingUI("Calculando formulas...", "white");
        setTimeout(function() {
            $.unblockUI();
            $("#hoja-3-fecha-nacimiento").val(
                moment($("#fechaNacimiento").val()).format("DD-MM-YYYY")
            );
            $("#hoja-3-fecha-plan").val(
                moment($("#fechaPlan").val()).format("DD-MM-YYYY")
            );
            edad = $("#divEdadCliente").text();
            $("#hoja-3-edad").val(edad);

            $("#hoja-3-fecha-baja").val($("#fechaBaja").val());

            $("#hoja-3-semanas-cotizadas").val($("#semanasCotizadas").val());
            $("#hoja-3-semanas-descontadas").val(
                $("#semanasDescontadas").val()
            );
            $("#hoja-3-total-semanas").val($("#totalSemanas").val());

            $("#hoja-3-edad-retiro").val($("#edadDe").val() + " Años");

            calcularTiempoIndividualHoja3();
            /////////////////
            edadA = $("#edadA").val();
            edadDe = $("#edadDe").val();
            rangoPensionDe = $("#rangoPensionDe").val();
            rangoPensionA = $("#rangoPensionA").val();
            rangoInversionDe = $("#rangoInversionDe").val();
            rangoInversionA = $("#rangoInversionA").val();

            $("#hoja-3-edad-desde").val(edadDe);
            $("#hoja-3-edad-hasta").val(edadA);
            $("#hoja-3-monto-pension-desde").val(
                $.number(rangoPensionDe, 2, ".", ",")
            );
            $("#hoja-3-monto-pension-hasta").val(
                $.number(rangoPensionA, 3, ".", ",")
            );
            $("#hoja-3-pagos-desde").val(
                $.number(rangoInversionDe, 2, ".", ",")
            );
            $("#hoja-3-pagos-hasta").val(
                $.number(rangoInversionA, 2, ".", ",")
            );

            $("#modal-hoja-3-estrategias").modal("show");
        }, 1500);
    });

    function calcularTiempoIndividualHoja3() {
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
                ////console.log(response);
                $("#hoja-3-anos-retiro").val(response.data.ano);
                $("#hoja-3-meses-retiro").val(response.data.meses);
                $("#hoja-3-semanas-retiro").val(response.data.semanas);
                $("#hoja-3-dias-retiro").val(response.data.dias);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                ////console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    $("#btn-carga-cotizaciones-hoja3").click(function(event) {
        event.preventDefault();
        cargaTablaCotizaciones();
    });
    function cargaTablaCotizaciones() {
        filas = $("#table-cotizaciones >tbody >tr").length + 1;
        i = 0;
        fila = $("#table-promedio-salarial-3 tr:last").attr("row");
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
        totaldiasHojas3(0);
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
            '<td id="hoja-3-concepto-' +
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
            '" class="input-xs hoja-3-dias form-control" readonly value="' +
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
            '" class="input-xs form-control  total-cotizacion-promedio-salarial-3" readonly value="' +
            $.number(totalMontoCotizacion, 2, ".", ",") +
            '">' +
            "</div>" +
            "</td>" +
            '<td class=""><a href="#" class="hoja-3-borrar-cotizacion"><i class="text-danger far fa-trash-alt"></i></a></td>' +
            "</tr>";

        $("#table-promedio-salarial-3 tbody").append(htmlTags);
    }

    $(".x_title").click(function(event) {
        event.preventDefault();
        var d = new Date();
        var dia = d.getDate();
        var mes = "0" + (d.getMonth() + 1);
        var anio = d.getFullYear();
        var fechaHoy = anio + "-" + pad(mes, 2) + "-" + pad(dia, 2);
        //$("#fechaPlan").val(fechaHoy);
        estrategia = $(this).attr("estrategia");

        if (NewOrEdit == "New") {
            $("#hoja-3-fecha-desde-estrategia-" + estrategia).val(fechaHoy);
            $("#hoja-3-fecha-hasta-estrategia-" + estrategia).val(fechaHoy);
            $("#hoja-3-fecha-desde-estrategia-" + estrategia).focus();
        } else {
            $("#hoja-3-fecha-desde-estrategia-" + estrategia).focus();
            // $("#hoja-2-edad-estrategia-" + estrategia).focus();
            $("#hoja-3-sbc-estrategia-" + estrategia).focus();
            $("#hoja-3-total-estrategia-" + estrategia).focus();
        }

        desde = $("#hoja-3-fecha-nacimiento").val();
        hasta = $("#hoja-3-fecha-desde-estrategia-" + estrategia).val();
        calculaFechasHoja3(
            desde,
            hasta,
            "#hoja-3-edad-estrategia-" + estrategia
        );
    });

    function calculaFechasHoja3(desde, hasta, elementoDom) {
        $.ajax({
            url: "/edad-cliente",
            type: "get",
            data: { fecNac: desde, fechaFutura: hasta },
            dataType: "json"
        })
            .done(function(response) {
                ////console.log(response);
                $(elementoDom).val(response.data);
                pos = response.data.indexOf(",") + 1;
                mes = response.data.substr(pos, 3);
                edadReal = response.data.substr(0, 2).trim() + "." + mes.trim();
                $("#hoja-3-edad-real-pension").val(edadReal);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                ////console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    // function changeChosenEdadPensionHoja3(estrategia) {
    //     edadJubilacion = $("#hoja-3-edad-estrategia-1").val();
    //     mes = parseInt(edadJubilacion.substr(9, 2));
    //     ano = parseInt(edadJubilacion.substr(0, 2));
    //     edadPension1 = mes >= 6 ? ano + 1 : ano;
    //     edadPension1 = edadPension > 65 ? 65 : edadPension1;

    //     edadJubilacion = $("#hoja-3-edad-estrategia-2").val();
    //     mes = parseInt(edadJubilacion.substr(9, 2));
    //     ano = parseInt(edadJubilacion.substr(0, 2));
    //     edadPension2 = mes >= 6 ? ano + 1 : ano;
    //     edadPension2 = edadPension > 65 ? 65 : edadPension2;

    //     edadJubilacion = $("#hoja-3-edad-estrategia-3").val();
    //     mes = parseInt(edadJubilacion.substr(9, 2));
    //     ano = parseInt(edadJubilacion.substr(0, 2));
    //     edadPension3 = mes >= 6 ? ano + 1 : ano;
    //     edadPension3 = edadPension > 65 ? 65 : edadPension3;

    //     edadJubilacion = $("#hoja-3-edad-estrategia-4").val();
    //     mes = parseInt(edadJubilacion.substr(9, 2));
    //     ano = parseInt(edadJubilacion.substr(0, 2));
    //     edadPension4 = mes >= 6 ? ano + 1 : ano;
    //     edadPension4 = edadPension > 65 ? 65 : edadPension4;

    //     edadJubilacion = $("#hoja-3-edad-estrategia-5").val();
    //     mes = parseInt(edadJubilacion.substr(9, 2));
    //     ano = parseInt(edadJubilacion.substr(0, 2));
    //     edadPension5 = mes >= 6 ? ano + 1 : ano;
    //     edadPension5 = edadPension > 65 ? 65 : edadPension5;

    //     edadJubilacion = $("#hoja-3-edad-estrategia-6").val();
    //     mes = parseInt(edadJubilacion.substr(9, 2));
    //     ano = parseInt(edadJubilacion.substr(0, 2));
    //     edadPension6 = mes >= 6 ? ano + 1 : ano;
    //     edadPension6 = edadPension > 65 ? 65 : edadPension2;

    //     $("#hoja-3-edad-calculo-pension").empty();

    //     $("#hoja-3-edad-calculo-pension").append(
    //         '<option value="' +
    //             edadPension1 +
    //             '">' +
    //             edadPension1 +
    //             " años - Empresa actual</option>"
    //     );
    //     $("#hoja-3-edad-calculo-pension").append(
    //         '<option value="' +
    //             edadPension2 +
    //             '">' +
    //             edadPension2 +
    //             " años - Cooperativa</option>"
    //     );
    //     $("#hoja-3-edad-calculo-pension").append(
    //         '<option value="' +
    //             edadPension3 +
    //             '">' +
    //             edadPension3 +
    //             " años - M40 Retroactivo</option>"
    //     );
    //     $("#hoja-3-edad-calculo-pension").append(
    //         '<option value="' +
    //             edadPension4 +
    //             '">' +
    //             edadPension4 +
    //             " años - M40 Ya Pagada</option>"
    //     );
    //     $("#hoja-3-edad-calculo-pension").append(
    //         '<option value="' +
    //             edadPension5 +
    //             '">' +
    //             edadPension5 +
    //             " años - M40 Barata</option>"
    //     );
    //     $("#hoja-3-edad-calculo-pension").append(
    //         '<option value="' +
    //             edadPension6 +
    //             '">' +
    //             edadPension6 +
    //             " años - M40 Salario Alto</option>"
    //     );
    //     $("#hoja-3-edad-calculo-pension").trigger("chosen:updated");
    // }

    $(".hoja-3-fecha-desde-estrategia").focusout(function(ev) {
        estrategia = $(this).attr("estrategia");
        desde = $("#hoja-3-fecha-nacimiento").val();
        hasta = $("#hoja-3-fecha-desde-estrategia-" + estrategia).val();
        calculaFechasHoja3(
            desde,
            hasta,
            "#hoja-3-edad-estrategia-" + estrategia
        );

        fecDesde = $("#hoja-3-fecha-desde-estrategia-" + estrategia).val();
        fecHasta = $("#hoja-3-fecha-hasta-estrategia-" + estrategia).val();
        ////alert(fecDesde + " " + fecHasta);
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
                $("#hoja-3-dias-estrategia-" + estrategia).val(response.data);
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

    $(".OksumarDiasHoja3").click(function(event) {
        event.preventDefault();
        elem = $(this).attr("elemento");
        fecha = $(this).attr("fecha");
        id = $(this).attr("id");
        desdefecha = $(this).attr("desdefecha");
        diasFormulaEvaluar = $(elem).val();
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
                $("#hoja-3-sumas-dias-estrategia-" + id).hide();
                fecDesde = $("#hoja-3-fecha-desde-estrategia-" + id).val();
                fecHasta = $(fecha).val();
                calculaDiasEntreFechas(fecDesde, fecHasta, id);
                ////alert(fecDesde + " " + fecHasta);
                desde = $("#fechaNacimiento").val();
                hasta = $("#hoja-3-fecha-hasta-estrategia-" + id).val();
                //alert(desde + " " + hasta);
                calculaFechasHoja3(
                    desde,
                    hasta,
                    "#hoja-3-edad-estrategia-" + id
                );

                setTimeout(function() {
                    dias = $("#hoja-3-dias-estrategia-" + id).val();
                    anos = parseInt(dias) / 365;
                    $("#hoja-3-anos-estrategia-" + id).val(
                        $.number(anos, 2, ".", ",")
                    );

                    meses = anos * 12;
                    $("#hoja-3-meses-estrategia-" + id).val(
                        $.number(meses, 2, ".", ",")
                    );

                    semanas = dias / 7;
                    $("#hoja-3-semanas-estrategia-" + id).val(
                        $.number(semanas, 2, ".", ",")
                    );
                    $("#hoja-3-sbc-estrategia-" + id).focus();
                }, 1000);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                ////console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $(".sbc-monto-estrategia-hoja-3").focusout(function(ev) {
        estrategia = $(this).attr("estrategia");
        sbc = $(this).val();
        dias = $("#hoja-3-dias-estrategia-" + estrategia).val();
        total = parseFloat(sbc) * parseFloat(dias);
        $("#hoja-3-total-estrategia-" + estrategia).val(
            $.number(total, 2, ".", ",")
        );

        meses = convertNumberPure(
            $("#hoja-3-meses-estrategia-" + estrategia).val()
        );
        fecDesde = $("#hoja-3-fecha-desde-estrategia-" + estrategia).val();
        fecHasta = $("#hoja-3-fecha-hasta-estrategia-" + estrategia).val();
        switch (estrategia) {
            case 1:
                break;
            case "2":
                // Costo coopeartiva
                calculaCostoCooperativa(estrategia);
                $("#hoja-3-fecha-desde-cooperativa").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-3-fecha-hasta-cooperativa").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-3-dias-cooperativa").val(dias);
                $("#hoja-3-sbc-cooperativa").val($.number(sbc, 2, ".", ","));
                $("#hoja-3-monto-base-cooperativa").val(
                    $.number(total, 2, ".", ",")
                );
                break;
            case "3":
                // Costo M40 retroactivo
                costo = total * 0.10075;
                $("#hoja-3-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ".", ",")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-3-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ".", ",")
                );
                $("#hoja-3-fecha-desde-mod40-retroactivo").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-3-fecha-hasta-mod40-retroactivo").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-3-dias-mod40-retroactivo").val(dias);
                $("#hoja-3-sbc-mod40-retroactivo").val(
                    $.number(sbc, 2, ".", ",")
                );
                $("#hoja-3-monto-base-mod40-retroactivo").val(
                    $.number(total, 2, ".", ",")
                );
                break;
            case "4":
                // Costo M40 ya pagada
                costo = total * 0.10075;
                $("#hoja-3-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ".", ",")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-3-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ".", ",")
                );
                $("#hoja-3-fecha-desde-m40-pagada").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-3-fecha-hasta-m40-pagada").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-3-dias-m40-pagada").val(dias);
                $("#hoja-3-sbc-m40-pagada").val($.number(sbc, 2, ".", ","));
                $("#hoja-3-monto-base-m40-pagada").val(
                    $.number(total, 2, ".", ",")
                );
                break;
            case "5":
                // Costo M40 mas barata
                costo = total * 0.10075;
                $("#hoja-3-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ".", ",")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-3-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ".", ",")
                );
                $("#hoja-3-fecha-desde-mod40-barata").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-3-fecha-hasta-mod40-barata").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-3-dias-mod40-barata").val(dias);
                $("#hoja-3-sbc-mod40-barata").val($.number(sbc, 2, ".", ","));
                $("#hoja-3-monto-base-mod40-barata").val(
                    $.number(total, 2, ".", ",")
                );
                break;
            case "6":
                // Costo M40 Salario alto
                costo = total * 0.10075;
                $("#hoja-3-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ".", ",")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-3-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ".", ",")
                );

                $("#hoja-3-fecha-desde-mod40-alto").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-3-fecha-hasta-mod40-alto").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-3-dias-mod40-alto").val(dias);
                $("#hoja-3-sbc-mod40-alto").val($.number(sbc, 2, ".", ","));
                $("#hoja-3-monto-base-mod40-alto").val(
                    $.number(total, 2, ".", ",")
                );
                break;
        }

        changeChosenEdadPensionHoja3(estrategia);
    });

    function changeChosenEdadPensionHoja3(estrategia) {
        edadJubilacion = $("#hoja-3-edad-estrategia-" + estrategia).val();
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
            "#hoja-3-edad-calculo-pension option[value='" + estrategia + "']"
        ).remove();

        $("#hoja-3-edad-calculo-pension").append(
            '<option value="' +
                estrategia +
                '" >' +
                edadPension1 +
                concepto +
                "</option>"
        );

        $("#hoja-3-edad-calculo-pension").trigger("chosen:updated");
    }

    function calculaCostoCooperativa(estrategia) {
        meses = convertNumberPure(
            $("#hoja-3-meses-estrategia-" + estrategia).val()
        );
        inscCooperativa = convertNumberPure(
            $("#hoja-3-inscripcion-cooperativa-estrategia-" + estrategia).val()
        );
        tot1 = meses * 1750;
        costo = inscCooperativa + tot1;
        $("#hoja-3-costo-estrategia-" + estrategia).val(
            $.number(costo, 2, ".", ",")
        );
        otros = costo / meses;
        $("#hoja-3-otro-valor-estrategia-" + estrategia).val(
            $.number(otros, 2, ".", ",")
        );
    }

    $("#hoja-3-inscripcion-cooperativa-estrategia-2").focusout(function(ev) {
        estrategia = $(this).attr("estrategia");
        calculaCostoCooperativa(estrategia);
    });

    $("#modal-hoja-3-estrategias").on("show.bs.modal", function() {
        for (i = 1; i <= 6; i++) {
            dias = $("#hoja-3-dias-estrategia-" + i).val();
            if (dias != "") {
                $("#hoja-3-x_content-" + i).attr("style", "display: block;");
            } else {
                $("#hoja-3-x_content-" + i).attr("style", "display: none;");
            }
        }
    });

    $("#modal-hoja-3-estrategias").on("hide.bs.modal", function() {
        totaldiasHojas3(0);
    });

    function totaldiasHojas3(changeMonto) {
        diasTotal = 0;
        $(".hoja-3-dias").each(function() {
            dias = $(this).val();
            ////console.log(dias);
            if (dias != "") {
                diasTotal += parseInt(dias);
            }
        });

        totalCotiza = 0;
        $(".total-cotizacion-promedio-salarial-3").each(function() {
            totalCotizacion = $(this).val();
            ////console.log(totalCotizacion);
            if (totalCotizacion != "") {
                //console.log(convertNumberPure(totalCotizacion));
                totalCotiza += convertNumberPure(totalCotizacion);
            }
        });

        if (diasTotal < 1750) {
            $("#hoja-3-total-dias").val($.number(diasTotal, 2, ".", ","));
            $("#hoja-3-dias-excedidos").val($.number(0, 2, ".", ","));
            $("#hoja-3-dias-equivalentes-250").val($.number(0, 2, ".", ","));
            return false;
        }
        diasExcedidos = diasTotal - 1750;
        diasEquivalentes250 = diasTotal - diasExcedidos;

        $("#hoja-3-total-dias").val($.number(diasTotal, 2, ".", ","));
        $("#hoja-3-dias-excedidos").val($.number(diasExcedidos, 2, ".", ","));
        $("#hoja-3-dias-equivalentes-250").val(
            $.number(diasEquivalentes250, 2, ".", ",")
        );

        cargaTablaCambioSalarioHoja3();

        monto = $("#monto-a-descontar-excedido").val();

        salarioNeto = parseInt(diasExcedidos) * parseFloat(monto);

        $("#hoja-3-salarios-neto").val($.number(monto, 2, ".", ","));

        //montoExcedente = convertNumberPure($("#hoja-3-salarios-neto").val());
        salarioBasePromedio = totalCotiza - monto;
        $("#hoja-3-salario-base-promedio").val(
            $.number(salarioBasePromedio, 2, ".", ",")
        );

        promedioUltimasSemanas = salarioBasePromedio / 1750;

        $("#hoja-3-entre").val($("#hoja-3-dias-equivalentes-250").val());
        $("#hoja-3-prom-ultimas-250-sem").val(
            $.number(promedioUltimasSemanas, 2, ".", ",")
        );

        semanasCotizadas = $("#totalSemanas").val();
        semanasCotiza = 0;
        $(".semanas-cotizadas-estrategia-hoja3").each(function() {
            semanas = $(this).val();
            //console.log(semanas);
            if (semanas != "") {
                semanasCotiza += parseFloat(semanas);
            }
        });
        console.log(semanasCotiza);
        semanasCotizadas =
            parseInt(semanasCotizadas) + Math.round(semanasCotiza);

        estrategiaEdad = $("#hoja-3-edad-calculo-pension").val();
        edadJubilacion = $("#hoja-3-edad-estrategia-" + estrategiaEdad).val();
        mes = parseInt(edadJubilacion.substr(9, 2));
        ano = parseInt(edadJubilacion.substr(0, 2));
        edadPension = mes >= 6 ? ano + 1 : ano;
        edadPension = edadPension > 65 ? 65 : edadPension;
        ////alert(edadPension);
        salarioDiarioPromedio = promedioUltimasSemanas;
        ////alert(salarioDiarioPromedio);
        $("#hoja-3-nro-semanas-cotizadas").val(semanasCotizadas);
        $("#hoja-3-salario-promedio-mensual-250-semanas").val(
            $.number(salarioDiarioPromedio, 2, ".", ",")
        );
        $("#hoja-3-esposa").val($("#esposa").val());
        $("#hoja-3-hijos").val($("#hijos").val());
        $("#hoja-3-padres").val($("#padres").val());
        $("#hoja-3-edad-jubilacion").val(edadPension);

        calculaFormulasExcelHojas(
            semanasCotizadas,
            salarioDiarioPromedio,
            edadPension,
            false,
            "hoja-3"
        );
        /////
    }

    $(".delete-estrategia-hoja3").click(function(event) {
        event.preventDefault();
        estrategia = $(this).attr("estrategia");
        $("#hoja-3-fecha-desde-estrategia-" + estrategia).val("");
        $("#hoja-3-fecha-hasta-estrategia-" + estrategia).val("");
        $("#hoja-3-edad-estrategia-" + estrategia).val("");
        $("#hoja-3-anos-estrategia-" + estrategia).val("");
        $("#hoja-3-meses-estrategia-" + estrategia).val("");
        $("#hoja-3-semanas-estrategia-" + estrategia).val("");
        $("#hoja-3-dias-estrategia-" + estrategia).val("");
        $("#hoja-3-sbc-estrategia-" + estrategia).val("");
        $("#hoja-3-total-estrategia-" + estrategia).val("");
        $("#hoja-3-costo-estrategia-" + estrategia).val("");
        $("#hoja-3-otro-valor-estrategia-" + estrategia).val("");
        $(".hoja-3-estrategia-" + estrategia).val("");
        $(
            "#hoja-3-edad-calculo-pension option[value='" + estrategia + "']"
        ).remove();
        $("#hoja-3-edad-calculo-pension").trigger("chosen:updated");
    });

    $(document).on("click", ".hoja-3-borrar-cotizacion", function(event) {
        event.preventDefault();
        $(this)
            .closest("tr")
            .remove();
        totaldiasHojas3(0);
    });

    // function calculaFormulasExcelHojas(
    //     semanasCotizadas,
    //     salarioDiarioPromedio,
    //     edadPension,
    //     muestraModal,
    //     hoja
    // ) {
    //     if (muestraModal) {
    //         $("#modal-formulas").modal("show");
    //     }
    //     //alert(semanasCotizadas);
    //     $("#formulas-semana-cotizadas").val(semanasCotizadas);
    //     $("#formulas-salario-diario-promedio").val(salarioDiarioPromedio);
    //     $("#formulas-esposa").val($("#esposa").val());
    //     $("#formulas-hijos-menores").val($("#hijos").val());
    //     $("#formulas-padres").val($("#padres").val());
    //     $("#formulas-edad-jubilacion").val(edadPension);

    //     //salarioDiarioPromedio = $("#formulas-salario-diario-promedio").val();
    //     salarioMinimoDf = $("#formulas-salario-minimo-df").val();
    //     salarioPromedioVsm = salarioDiarioPromedio / salarioMinimoDf;
    //     $("#formulas-salario-promedio-vsm").val(salarioPromedioVsm.toFixed(2));

    //     $("#cuantia-basica-salario-promedio").val(salarioDiarioPromedio);

    //     $("#incremento-anual-cuantia-basica-salario-promedio").val(
    //         salarioDiarioPromedio
    //     );

    //     $("#anos-ant-semanas-cotizadas").val(
    //         $("#formulas-semana-cotizadas").val()
    //     );
    //     $("#anos-ant-500-semanas").val(500);
    //     $("#anos-ant-semanas-reconocidas").val(
    //         parseInt($("#formulas-semana-cotizadas").val()) - 500
    //     );
    //     console.log("error " + $("#formulas-semana-cotizadas").val());
    //     anosCompletos = Math.trunc(
    //         $("#anos-ant-semanas-reconocidas").val() / 52
    //     );
    //     $("#anos-ant-anos-completos").val(anosCompletos);

    //     totalPost00 = $("#anos-ant-anos-completos").val() * 52;
    //     $("#anos-ant-semanas-completas-posteriores-500").val(totalPost00);

    //     $("#anos-ant-sem-reconocidas-post-500").val(
    //         parseInt($("#formulas-semana-cotizadas").val()) - 500
    //     );

    //     $("#anos-ant-sem-completas-post-500").val(totalPost00);

    //     semanasResiduos =
    //         $("#anos-ant-sem-reconocidas-post-500").val() -
    //         $("#anos-ant-sem-completas-post-500").val();
    //     $("#anos-ant-semanas-residuo").val(semanasResiduos);

    //     if (semanasResiduos >= 0 && semanasResiduos <= 12.99) {
    //         incrAnual = 0;
    //     } else if (semanasResiduos >= 13 && semanasResiduos <= 26) {
    //         incrAnual = 0.5;
    //     } else if (semanasResiduos > 26) {
    //         incrAnual = 1.0;
    //     }

    //     $("#anos-ant-ano-residuo").val(incrAnual);

    //     $("#anos-ant-comp-reconocdos-post-500").val(
    //         $("#anos-ant-anos-completos").val()
    //     );

    //     $("#anos-ant-mas-anos-residuo").val(incrAnual);

    //     totAnosReconocidos =
    //         parseInt($("#anos-ant-comp-reconocdos-post-500").val()) +
    //         parseInt($("#anos-ant-mas-anos-residuo").val());
    //     $("#anos-ant-tot-anos-reconocidos-post-500").val(totAnosReconocidos);
    //     $("#total-anos-reconocidos").val(totAnosReconocidos);
    //     // Buscar cuantía basica en tablas formulas-salario-promedio-vsm
    //     cuantiaBasicaHojas(
    //         $("#formulas-salario-promedio-vsm").val(),
    //         edadJubilacion,
    //         hoja,
    //         edadPension
    //     );
    // }

    // function cuantiaBasicaHojas(
    //     salarioPromedioVsm,
    //     edadJubilacion,
    //     hoja,
    //     edadPension
    // ) {
    //     $.ajax({
    //         url: "/buscar-cuantia-basica",
    //         type: "get",
    //         data: { salarioPromedioVsm: salarioPromedioVsm },
    //         dataType: "json"
    //     })
    //         .done(function(response) {
    //             // ////console.log();
    //             $("#cuantia-basica-valor").val(response.data.cuantia_basica);
    //             $("#incremento-anual-cuantia-basica-valor").val(
    //                 response.data.incremento_anual
    //             );

    //             cuantiaBasicaSalarioPromedio = $(
    //                 "#cuantia-basica-salario-promedio"
    //             ).val();
    //             cuantiaBasicaValor = $("#cuantia-basica-valor").val();
    //             cuantiaBasicaDiaria =
    //                 parseFloat(cuantiaBasicaSalarioPromedio) *
    //                 parseFloat(cuantiaBasicaValor / 100);
    //             $("#cuantia-basica-diaria").val(cuantiaBasicaDiaria.toFixed(2));

    //             cuantiaBasicaDiaria = parseFloat(
    //                 $("#cuantia-basica-diaria").val()
    //             );
    //             cuantiaBasicaX365 = parseFloat(
    //                 $("#cuantia-basica-x-365").val()
    //             );
    //             cuantiaBasicaAnual = cuantiaBasicaDiaria * cuantiaBasicaX365;
    //             $("#cuantia-basica-anual").val(cuantiaBasicaAnual.toFixed(2));
    //             cuantiaBasicaMensual = cuantiaBasicaAnual / 12;
    //             $("#cuantia-basica-mensual").val(
    //                 cuantiaBasicaMensual.toFixed(2)
    //             );

    //             anualCuantiaBasicaSalarioPromedio = $(
    //                 "#incremento-anual-cuantia-basica-salario-promedio"
    //             ).val();
    //             anualCuantiaBasicaValor = $(
    //                 "#incremento-anual-cuantia-basica-valor"
    //             ).val();

    //             incrementoAnualCuantiaBasicaDiaria =
    //                 anualCuantiaBasicaSalarioPromedio *
    //                 (anualCuantiaBasicaValor / 100);
    //             $("#incremento-anual-cuantia-basica-diaria").val(
    //                 incrementoAnualCuantiaBasicaDiaria.toFixed(2)
    //             );

    //             incrementoAnual = incrementoAnualCuantiaBasicaDiaria * 365;
    //             $("#incremento-anual-previo").val(incrementoAnual.toFixed(2));

    //             incrementoAnualPrevio = $("#incremento-anual-previo").val();
    //             totalAnosReconocidos = $("#total-anos-reconocidos").val();
    //             total3 = incrementoAnualPrevio * totalAnosReconocidos;
    //             $("#incremento-anual-a-la-cuantia-basica").val(total3);
    //             total4 = total3 / 12;
    //             $("#incremento-mensual-cuantia-basica").val(total4.toFixed(2));

    //             $("#cuanta-anual-pension-basica").val(
    //                 $("#cuantia-basica-anual").val()
    //             );

    //             $("#cuanta-anual-pension-incremento").val(
    //                 $("#incremento-anual-a-la-cuantia-basica").val()
    //             );

    //             total5 = parseFloat(
    //                 $("#cuanta-anual-pension-incremento").val()
    //             );
    //             total6 = parseFloat($("#cuanta-anual-pension-basica").val());
    //             total7 = total5 + total6;
    //             $("#cuanta-anual-pension-igual").val(total7.toFixed(2));
    //             total8 = total7 / 12;
    //             $("#cuanta-anual-pension-igual-mensual").val(total8.toFixed(2));

    //             // Ayuda Esposa
    //             $("#asig-esposa-cuantia-anual-pension").val(total7.toFixed(2));
    //             montoEsposa =
    //                 $("#esposa").val() == "No" ? 0 : total7 * (15 / 100);
    //             $("#asig-esposa-asignacion-viuda").val(montoEsposa.toFixed(2));
    //             $("#asig-esposa-mensual").val((montoEsposa / 12).toFixed(2));

    //             // Ayuda Hijos
    //             $("#ayuda-hijos-cuantia-anual-pension").val(total7.toFixed(2));
    //             hijos = $("#hijos").val();
    //             $("#ayuda-hijos-nro-hijos").val(hijos);
    //             total9 = total7 * (10 / 100) * hijos;
    //             $("#ayuda-hijos-ayuda-anual").val(total9.toFixed(2));
    //             $("#ayuda-hijos-mensual").val((total9 / 12).toFixed(2));

    //             // Ayuda Padres
    //             $("#ayuda-padres-anual-pesion").val(total7.toFixed(2));
    //             padres = $("#padres").val();
    //             $("#ayuda-padres-nro-padres").val(padres);

    //             if ($("#esposa").val() == "Si" || hijos > 0) {
    //                 total10 = 0;
    //             } else {
    //                 total10 = total7 * (20 / 100) * padres;
    //             }
    //             $("#ayuda-padres-ayuda-anual").val(total10.toFixed(2));
    //             $("#ayuda-padres-anual").val((total10 / 12).toFixed(2));

    //             // Ayuda por Soledad
    //             $("#ayuda-soledad-anual-pension").val(total7.toFixed(2));
    //             montosoledad =
    //                 $("#esposa").val() == "No" && hijos == 0 && padres == 0
    //                     ? total7 * (15 / 100)
    //                     : 0;
    //             $("#ayuda-soledad-anual").val(montosoledad.toFixed(2));
    //             $("#ayuda-soledad-mensual").val((montosoledad / 12).toFixed(2));

    //             // Total ayudas
    //             totalAyudas = montoEsposa + total9 + total10 + montosoledad;
    //             $("#total-ayudas").val(totalAyudas.toFixed(2));
    //             $("#total-ayudas-mensual").val((totalAyudas / 12).toFixed(2));
    //             $("#total-ayuda-cuantia-anual").val(total7.toFixed(2));
    //             $("#total-ayuda-cuantia-anual-mas-ayuda").val(
    //                 (totalAyudas + total7).toFixed(2)
    //             );
    //             $("#total-ayuda-cuantia-anual-ayuda-mensual").val(
    //                 ((totalAyudas + total7) / 12).toFixed(2)
    //             );

    //             $("#cuantia-anual-pension-mas-ayudas").val(
    //                 (totalAyudas + total7).toFixed(2)
    //             );
    //             $("#cuantia-anual-pension-mas-ayudas-mensual").val(
    //                 ((totalAyudas + total7) / 12).toFixed(2)
    //             );
    //             $("#igual-pension-anual-x-vejez").val(
    //                 ((totalAyudas + total7) * (111 / 100)).toFixed(2)
    //             );
    //             $("#igual-pension-anual-x-vejez-mensual").val(
    //                 (((totalAyudas + total7) * (111 / 100)) / 12).toFixed(2)
    //             );

    //             switch (edadJubilacion) {
    //                 case 60:
    //                     $porc = 75;
    //                     break;
    //                 case 61:
    //                     $porc = 80;
    //                     break;
    //                 case 62:
    //                     $porc = 85;
    //                     break;
    //                 case 63:
    //                     $porc = 90;
    //                     break;
    //                 case 64:
    //                     $porc = 95;
    //                     break;
    //                 case 65:
    //                     $porc = 100;
    //                     break;
    //                 default:
    //                     $porc = 100;
    //             }
    //             $("#porc-pension-por-edad").val($porc);

    //             pensionAnualVejez = (totalAyudas + total7) * (111 / 100);
    //             $("#pension-anual-x-vejez-fin").val(
    //                 pensionAnualVejez.toFixed(2)
    //             );

    //             $("#pension-anual-x-cesantia").val(
    //                 (pensionAnualVejez * ($porc / 100)).toFixed(2)
    //             );

    //             $("#pension-anual-x-cesantia-mensual").val(
    //                 ((pensionAnualVejez * ($porc / 100)) / 12).toFixed(2)
    //             );

    //             $("#pension-anual-fin").text(
    //                 $.number(pensionAnualVejez * ($porc / 100), 2, ".", ",")
    //             );
    //             $("#pension-mensual-fin").text(
    //                 $.number(
    //                     (pensionAnualVejez * ($porc / 100)) / 12,
    //                     2,
    //                     ",",
    //                     "."
    //                 )
    //             );

    //             $("#" + hoja + "-pension-mensual-con-m40").val(
    //                 $("#pension-mensual-fin").text()
    //             );

    //             $("#" + hoja + "-pension-anual-con-m40").val(
    //                 $("#pension-anual-fin").text()
    //             );

    //             aguinaldo = convertNumberPure(
    //                 $("#" + hoja + "-pension-mensual-con-m40").val()
    //             );

    //             aguinaldo = aguinaldo * 0.85;
    //             $("#" + hoja + "-aguinaldo").val(
    //                 $.number(aguinaldo, 2, ".", ",")
    //             );

    //             totalAnual = convertNumberPure($("#pension-anual-fin").text());
    //             totalAnual = totalAnual + aguinaldo;
    //             $("#" + hoja + "-total-anual").val(
    //                 $.number(totalAnual, 2, ".", ",")
    //             );

    //             difEdad = 85 - edadPension;
    //             $("#" + hoja + "-dif-edad-85-text").text(difEdad);
    //             $("#" + hoja + "-dif-85").val(
    //                 $.number(totalAnual * difEdad, 2, ".", ",")
    //             );

    //             $("#title-pension-con-m40").attr(
    //                 "class",
    //                 "text-success blink_me"
    //             );
    //         })
    //         .fail(function(statusCode, errorThrown) {
    //             $.unblockUI();
    //             ////console.log(errorThrown);
    //             ajaxError(statusCode, errorThrown);
    //         });
    // }

    $(document).on("click", "#cambiar-salario-calculo-hoja-3", function(event) {
        event.preventDefault();
        // if ($("#hoja-3-dias-excedidos").val() == "") {
        //     return false;
        // }
        cargaTablaCambioSalarioHoja3();
        $("#modal-cambiar-salario").modal("show");
    });

    function cargaTablaCambioSalarioHoja3() {
        i = 0;
        fila = 1;

        //$("#table-cambiar-salario tr:not(:first-child)").remove();
        $("#table-cambiar-salario tr").remove();
        cargaFilasEstrategias();
        i = 1;

        var filas = $("#body-promedio-salarial-3").find("tr");
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

        diasExcedidos = $("#hoja-3-dias-excedidos").val();
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

        //$("#hoja-3-salarios-neto").val(totalGeneral);
        $("#monto-a-descontar-excedido").val(totalGeneral);

        //totaldiasHojas3(0);
    }

    function cargaFilasEstrategias() {
        dias = $("#hoja-3-dias-mod40-alto").val();
        if (dias != "") {
            concepto = "M40 -ALTO 2";
            fechaDesde = $("#hoja-3-fecha-desde-mod40-alto").val();
            fechaHasta = $("#hoja-3-fecha-hasta-mod40-alto").val();
            dias = $("#hoja-3-dias-mod40-alto").val();
            monto = $("#hoja-3-sbc-mod40-alto").val();
            agregarTableCambiosalario(
                concepto,
                fechaDesde,
                fechaHasta,
                dias,
                monto
            );
        }

        dias = $("#hoja-3-dias-mod40-retroactivo").val();
        if (dias != "") {
            concepto = "RETROACTIVO";
            fechaDesde = $("#hoja-3-fecha-desde-mod40-retroactivo").val();
            fechaHasta = $("#hoja-3-fecha-hasta-mod40-retroactivo").val();
            dias = $("#hoja-3-dias-mod40-retroactivo").val();
            monto = $("#hoja-3-sbc-mod40-retroactivo").val();
            agregarTableCambiosalario(
                concepto,
                fechaDesde,
                fechaHasta,
                dias,
                monto
            );
        }

        dias = $("#hoja-3-dias-mod40-barata").val();
        if (dias != "") {
            concepto = "M40 BARATA";
            fechaDesde = $("#hoja-3-fecha-desde-mod40-barata").val();
            fechaHasta = $("#hoja-3-fecha-hasta-mod40-barata").val();
            dias = $("#hoja-3-dias-mod40-barata").val();
            monto = $("#hoja-3-sbc-mod40-barata").val();
            agregarTableCambiosalario(
                concepto,
                fechaDesde,
                fechaHasta,
                dias,
                monto
            );
        }

        dias = $("#hoja-3-dias-cooperativa").val();
        if (dias != "") {
            concepto = "COOPERATIVA";
            fechaDesde = $("#hoja-3-fecha-desde-cooperativa").val();
            fechaHasta = $("#hoja-3-fecha-hasta-cooperativa").val();
            dias = $("#hoja-3-dias-cooperativa").val();
            monto = $("#hoja-3-sbc-cooperativa").val();
            agregarTableCambiosalario(
                concepto,
                fechaDesde,
                fechaHasta,
                dias,
                monto
            );
        }

        dias = $("#hoja-3-dias-m40-pagada").val();
        if (dias != "") {
            concepto = "M40 YA PAGADA";
            fechaDesde = $("#hoja-3-fecha-desde-m40-pagada").val();
            fechaHasta = $("#hoja-3-fecha-hasta-m40-pagada").val();
            dias = $("#hoja-3-dias-m40-pagada").val();
            monto = $("#hoja-3-sbc-m40-pagada").val();
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

        // $("#hoja-3-salarios-excedidos").val(monto_sbc);
        // totaldiasHojas3(monto_sbc);
        // $("#modal-cambiar-salario").modal("hide");
    });

    $("#btn-formulas-hoja-3").click(function(event) {
        event.preventDefault();

        semanasCotizadas = $("#hoja-3-nro-semanas-cotizadas").val();
        salarioDiarioPromedio = $(
            "#hoja-3-salario-promedio-mensual-250-semanas"
        ).val();
        edadJubilacion = $("#hoja-3-edad-jubilacion").val();
        //alert(salarioDiarioPromedio);
        salarioDiarioPromedio = convertNumberPure(salarioDiarioPromedio);
        calculaFormulasExcelHojas(
            semanasCotizadas,
            salarioDiarioPromedio,
            edadJubilacion,
            true
        );
    });
});
