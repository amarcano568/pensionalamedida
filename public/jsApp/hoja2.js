$(document).on("ready", function() {
    $("#btn-carga-estrategias-hoja2").click(function(event) {
        event.preventDefault();

        semanasCotizadas = $("#totalSemanas").val();
        salarioDiarioPromedio = $("#promedio-salarios").text();
        edadJubilacion = $("#edadDe").val();
        salarioDiarioPromedio = convertNumberPure(salarioDiarioPromedio);

        loadingUI("Calculando formulas...", "white");

        // calculaFormulasExcel(
        //     semanasCotizadas,
        //     salarioDiarioPromedio,
        //     edadJubilacion,
        //     false
        // );

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
                $.number(rangoPensionDe, 2, ",", ".")
            );
            $("#hoja-2-monto-pension-hasta").val(
                $.number(rangoPensionA, 3, ",", ".")
            );
            $("#hoja-2-pagos-desde").val(
                $.number(rangoInversionDe, 2, ",", ".")
            );
            $("#hoja-2-pagos-hasta").val(
                $.number(rangoInversionA, 2, ",", ".")
            );

            /////////
            // $("#hoja-2-pension-mesual-con-m40").val(
            //     $("#pension-mensual-fin").text()
            // );

            // $("#hoja-2-pension-anual-con-m40").val(
            //     $("#pension-anual-fin").text()
            // );

            // aguinaldo = convertNumberPure(
            //     $("#hoja-2-pension-mesual-con-m40").val()
            // );
            // aguinaldo = aguinaldo * 0.85;
            // $("#hoja-2-aguinaldo").val($.number(aguinaldo, 2, ",", "."));

            // totalAnual = convertNumberPure($("#pension-anual-fin").text());
            // totalAnual = totalAnual + aguinaldo;
            // $("#hoja-2-total-anual").val($.number(totalAnual, 2, ",", "."));

            // difEdad = 85 - parseFloat(edadA);
            // $("#dif-edad-85").text(difEdad);
            // $("#hoja-2-dif-85").val(
            //     $.number(totalAnual * difEdad, 2, ",", ".")
            // );
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
                $("#hoja-2-anos-retiro").val(response.data.ano);
                $("#hoja-2-meses-retiro").val(response.data.meses);
                $("#hoja-2-semanas-retiro").val(response.data.semanas);
                $("#hoja-2-dias-retiro").val(response.data.dias);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
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
        $(".diasCotizacion").each(function() {
            row = $(this).attr("row");
            fechaDesde = $("#fechaDesde" + row).val();
            fechaHasta = $("#fechaHasta" + row).val();
            dias = $("#dias" + row).val();
            monto = $("#monto" + row).val();
            totalMontoCotizacion = $("#totalMontoCotizacion" + row).val();
            i++;
            fila = $("#table-promedio-salarial-2 tr:last").attr("row");
            agregarTablePromedio(
                fila,
                fechaDesde,
                fechaHasta,
                dias,
                monto,
                totalMontoCotizacion,
                i
            );
        });
    }

    function agregarTablePromedio(
        filas,
        fechaDesde,
        fechaHasta,
        dias,
        monto,
        totalMontoCotizacion,
        i
    ) {
        filas++;
        var htmlTags =
            '<tr class="row2" id="' +
            filas +
            '">' +
            '<td colspan="2" style="vertical-align:middle" class="text-center"> Cotizaciones ' +
            i +
            "</td>" +
            '<td class="altoFilaTable"><input type="date" row="' +
            filas +
            '" id="promedio2fechaDesde' +
            filas +
            '" class="form-control-sm form-control fechaCotizacionDesde" value="' +
            fechaDesde +
            '" readonly></td>' +
            '<td class="altoFilaTable"><input type="date" row="' +
            filas +
            '" id="promedio2fechaHasta' +
            filas +
            '" class="form-control-sm form-control fechaCotizacionHasta" value="' +
            fechaHasta +
            '" readonly></td>' +
            '<td class="altoFilaTable"><input type="text" row="' +
            filas +
            '" id="promedio2dias' +
            filas +
            '" class="form-control-sm form-control diasCotizacion" readonly value="' +
            dias +
            '"></td>' +
            '<td class="altoFilaTable">' +
            '<input type="number" row="' +
            filas +
            '" id="promedio2monto' +
            filas +
            '" class="form-control-sm form-control montoCotizacion" readonly value="' +
            monto +
            '">' +
            "</td>" +
            '<td class="altoFilaTable">' +
            '<input type="text" row="' +
            filas +
            '" id="promedio2totalMontoCotizacion' +
            filas +
            '" class="form-control-sm form-control totalCotizacion" readonly value="' +
            totalMontoCotizacion +
            '">' +
            "</td>" +
            '<td class="altoFilaTable"><a href="#" class="borrar"><i class="text-danger far fa-trash-alt"></i></a></td>' +
            "</tr>";

        $("#table-promedio-salarial-2 tbody").append(htmlTags);
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
        $("#hoja-2-fecha-desde-estrategia-" + estrategia).val(fechaHoy);
        $("#hoja-2-fecha-hasta-estrategia-" + estrategia).val(fechaHoy);
        $("#hoja-2-fecha-desde-estrategia-" + estrategia).focus();

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
            url: "/calcular-edad-completa",
            type: "get",
            data: { fecNac: desde, fecPlan: hasta },
            dataType: "json"
        })
            .done(function(response) {
                //console.log(response);
                $(elementoDom).val(response.data);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
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
        //alert(fecDesde + " " + fecHasta);
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
                console.log(response);
                $("#hoja-2-dias-estrategia-" + estrategia).val(response.data);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
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
                console.log(response);
                $(fecha).val(response.data);
                $("#hoja-2-sumas-dias-estrategia-" + id).hide();
                fecDesde = $("#hoja-2-fecha-desde-estrategia-" + id).val();
                fecHasta = $(fecha).val();
                //alert(fecDesde + " " + fecHasta);
                calculaDiasEntreFechas(fecDesde, fecHasta, id);

                setTimeout(function() {
                    dias = $("#hoja-2-dias-estrategia-" + id).val();
                    anos = parseInt(dias) / 365;
                    $("#hoja-2-anos-estrategia-" + id).val(
                        $.number(anos, 2, ",", ".")
                    );

                    meses = anos * 12;
                    $("#hoja-2-meses-estrategia-" + id).val(
                        $.number(meses, 2, ",", ".")
                    );

                    semanas = dias / 7;
                    $("#hoja-2-semanas-estrategia-" + id).val(
                        $.number(semanas, 2, ",", ".")
                    );
                }, 1000);
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $(".sbc-monto-estrategia").focusout(function(ev) {
        estrategia = $(this).attr("estrategia");
        sbc = $(this).val();
        dias = $("#hoja-2-dias-estrategia-" + estrategia).val();
        total = parseFloat(sbc) * parseFloat(dias);
        $("#hoja-2-total-estrategia-" + estrategia).val(
            $.number(total, 2, ",", ".")
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
                $("#hoja-2-sbc-cooperativa").val($.number(sbc, 2, ",", "."));
                $("#hoja-2-monto-base-cooperativa").val(
                    $.number(total, 2, ",", ".")
                );
                break;
            case "3":
                // Costo M40 retroactivo
                costo = total * 0.10075;
                $("#hoja-2-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ",", ".")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-2-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ",", ".")
                );
                $("#hoja-2-fecha-desde-mod40-retroactivo").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-2-fecha-hasta-mod40-retroactivo").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-2-dias-mod40-retroactivo").val(dias);
                $("#hoja-2-sbc-mod40-retroactivo").val(
                    $.number(sbc, 2, ",", ".")
                );
                $("#hoja-2-monto-base-mod40-retroactivo").val(
                    $.number(total, 2, ",", ".")
                );
                break;
            case "4":
                // Costo M40 ya pagada
                costo = total * 0.10075;
                $("#hoja-2-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ",", ".")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-2-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ",", ".")
                );
                $("#hoja-2-fecha-desde-m40-pagada").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-2-fecha-hasta-m40-pagada").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-2-dias-m40-pagada").val(dias);
                $("#hoja-2-sbc-m40-pagada").val($.number(sbc, 2, ",", "."));
                $("#hoja-2-monto-base-m40-pagada").val(
                    $.number(total, 2, ",", ".")
                );
                break;
            case "5":
                // Costo M40 mas barata
                costo = total * 0.10075;
                $("#hoja-2-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ",", ".")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-2-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ",", ".")
                );
                $("#hoja-2-fecha-desde-mod40-barata").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-2-fecha-hasta-mod40-barata").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-2-dias-mod40-barata").val(dias);
                $("#hoja-2-sbc-mod40-barata").val($.number(sbc, 2, ",", "."));
                $("#hoja-2-monto-base-mod40-barata").val(
                    $.number(total, 2, ",", ".")
                );
                break;
            case "6":
                // Costo M40 Salario alto
                costo = total * 0.10075;
                $("#hoja-2-costo-estrategia-" + estrategia).val(
                    $.number(costo, 2, ",", ".")
                );

                otroCosto = sbc * 30.4 * 0.10075;
                $("#hoja-2-otro-valor-estrategia-" + estrategia).val(
                    $.number(otroCosto, 2, ",", ".")
                );

                $("#hoja-2-fecha-desde-mod40-alto").val(
                    moment(fecDesde).format("DD-MM-YYYY")
                );
                $("#hoja-2-fecha-hasta-mod40-alto").val(
                    moment(fecHasta).format("DD-MM-YYYY")
                );
                $("#hoja-2-dias-mod40-alto").val(dias);
                $("#hoja-2-sbc-mod40-alto").val($.number(sbc, 2, ",", "."));
                $("#hoja-2-monto-base-mod40-alto").val(
                    $.number(total, 2, ",", ".")
                );
                break;
        }
    });

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
            $.number(costo, 2, ",", ".")
        );
        otros = costo / meses;
        $("#hoja-2-otro-valor-estrategia-" + estrategia).val(
            $.number(otros, 2, ",", ".")
        );
    }

    $("#hoja-2-inscripcion-cooperativa-estrategia-2").focusout(function(ev) {
        estrategia = $(this).attr("estrategia");
        calculaCostoCooperativa(estrategia);
    });

    $("#modal-hoja-2-estrategias").on("shown.bs.modal", function() {
        $(".x_content").each(function() {
            estrategia = $(this).attr("estrategia");
            if (estrategia !== undefined) {
                total = $("#hoja-2-total-estrategia-" + estrategia).val();
                if (total == "" || total == 0) {
                    $(this).attr("style", "display: none;");
                } else {
                    $(this).attr("style", "display: block;");
                }
            }
        });
    });

    $(".deleteEstrategia").click(function(event) {
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
        $(".estrategia-" + estrategia).val("");
    });
});
