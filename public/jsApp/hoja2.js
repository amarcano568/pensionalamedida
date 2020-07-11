$(document).on("ready", function() {
    $("#btn-carga-estrategias-hoja2").click(function(event) {
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
        fila = $("#table-promedio-salarial-2 tr:last").attr("row");
        $(".diasCotizacion").each(function() {
            row = $(this).attr("row");
            fechaDesde = $("#fechaDesde" + row).val();
            fechaHasta = $("#fechaHasta" + row).val();
            dias = $("#dias" + row).val();
            monto = $("#monto" + row).val();
            totalMontoCotizacion = $("#totalMontoCotizacion" + row).val();
            i++;
            fila++;
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
        totaldiasHojas2();
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
        var htmlTags =
            '<tr class="" id="' +
            filas +
            '">' +
            '<td colspan="2" style="vertical-align:middle" class="text-center"> Cotizaciones ' +
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
            $.number(totalMontoCotizacion, 2, ",", ".") +
            '">' +
            "</div>" +
            "</td>" +
            '<td class=""><a href="#" class="hoja-2-borrar-cotizacion"><i class="text-danger far fa-trash-alt"></i></a></td>' +
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
            url: "/edad-cliente",
            type: "get",
            data: { fecNac: desde, fechaFutura: hasta },
            dataType: "json"
        })
            .done(function(response) {
                console.log(response);
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
                calculaDiasEntreFechas(fecDesde, fecHasta, id);
                //alert(fecDesde + " " + fecHasta);
                desde = $("#fechaNacimiento").val();
                hasta = $("#hoja-2-fecha-hasta-estrategia-" + estrategia).val();
                //alert(desde + " " + hasta);
                calculaFechasHoja2(
                    desde,
                    hasta,
                    "#hoja-2-edad-estrategia-" + estrategia
                );

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

    $("#modal-hoja-2-estrategias").on("hide.bs.modal", function() {
        totaldiasHojas2("hoja-2");
    });

    function totaldiasHojas2(hoja) {
        diasTotal = 0;
        $(".hoja-2-dias").each(function() {
            dias = $(this).val();
            console.log(dias);
            if (dias != "") {
                diasTotal += parseInt(dias);
            }
        });

        totalCotiza = 0;
        $(".total-cotizacion-promedio-salarial-2").each(function() {
            totalCotizacion = $(this).val();
            //nsole.log(dias);
            if (totalCotizacion != "") {
                totalCotiza += convertNumberPure(totalCotizacion);
            }
        });

        if (diasTotal < 1750) {
            $("#hoja-2-total-dias").val($.number(diasTotal, 2, ",", "."));
            $("#hoja-2-dias-excedidos").val($.number(0, 2, ",", "."));
            $("#hoja-2-dias-equivalentes-250").val($.number(0, 2, ",", "."));
            return false;
        }
        diasExcedidos = diasTotal - 1750;
        diasEquivalentes250 = diasTotal - diasExcedidos;
        salarioNeto = diasExcedidos * monto;
        $("#hoja-2-total-dias").val($.number(diasTotal, 2, ",", "."));
        $("#hoja-2-dias-excedidos").val($.number(diasExcedidos, 2, ",", "."));
        $("#hoja-2-dias-equivalentes-250").val(
            $.number(diasEquivalentes250, 2, ",", ".")
        );

        id = $("#body-promedio-salarial-2 tr:last").attr("id");
        monto = parseFloat($("#promedio2monto" + id).val());
        $("#hoja-2-salarios-excedidos").val($.number(monto, 2, ",", "."));
        $("#hoja-2-salarios-neto").val($.number(salarioNeto, 2, ",", "."));

        montoExcedente = convertNumberPure($("#hoja-2-salarios-neto").val());
        salarioBasePromedio = totalCotiza - montoExcedente;
        $("#hoja-2-salario-base-promedio").val(
            $.number(salarioBasePromedio, 2, ",", ".")
        );

        promedioUltimasSemanas = salarioBasePromedio / 1750;

        $("#hoja-2-entre").val($("#hoja-2-dias-equivalentes-250").val());
        $("#hoja-2-prom-ultimas-250-sem").val(
            $.number(promedioUltimasSemanas, 2, ",", ".")
        );

        semanasCotizadas = $("#totalSemanas").val();
        semanasCotiza = 0;
        $(".semanas-cotizadas-estrategia").each(function() {
            semanas = $(this).val();
            console.log(semanas);
            if (semanas != "") {
                semanasCotiza += convertNumberPure(semanas);
            }
        });

        semanasCotizadas = semanasCotizadas + Math.round(semanasCotiza);

        edadJubilacion = $("#hoja-2-edad-estrategia-6").val();
        mes = parseInt(edadJubilacion.substr(9, 2));
        ano = parseInt(edadJubilacion.substr(0, 2));
        edadPension = mes >= 6 ? ano + 1 : ano;
        edadPension = edadPension > 65 ? 65 : edadPension;
        //alert(edadPension);
        salarioDiarioPromedio = promedioUltimasSemanas;

        calculaFormulasExcelHojas(
            semanasCotizadas,
            salarioDiarioPromedio,
            edadPension,
            false,
            "hoja-2"
        );
        /////
    }

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

    $(document).on("click", ".hoja-2-borrar-cotizacion", function(event) {
        event.preventDefault();
        $(this)
            .closest("tr")
            .remove();
        totaldiasHojas2();
    });

    function calculaFormulasExcelHojas(
        semanasCotizadas,
        salarioDiarioPromedio,
        edadPension,
        muestraModal,
        hoja
    ) {
        if (muestraModal) {
            $("#modal-formulas").modal("show");
        }

        $("#formulas-esposa").val($("#esposa").val());
        $("#formulas-hijos-menores").val($("#hijos").val());
        $("#formulas-padres").val($("#padres").val());

        //salarioDiarioPromedio = $("#formulas-salario-diario-promedio").val();
        salarioMinimoDf = $("#formulas-salario-minimo-df").val();
        salarioPromedioVsm = salarioDiarioPromedio / salarioMinimoDf;
        $("#formulas-salario-promedio-vsm").val(salarioPromedioVsm.toFixed(2));

        $("#cuantia-basica-salario-promedio").val(salarioDiarioPromedio);

        $("#incremento-anual-cuantia-basica-salario-promedio").val(
            salarioDiarioPromedio
        );

        $("#anos-ant-semanas-cotizadas").val(
            $("#formulas-semana-cotizadas").val()
        );
        $("#anos-ant-500-semanas").val(500);
        $("#anos-ant-semanas-reconocidas").val(
            parseInt($("#formulas-semana-cotizadas").val()) - 500
        );

        anosCompletos = Math.trunc(
            $("#anos-ant-semanas-reconocidas").val() / 52
        );
        $("#anos-ant-anos-completos").val(anosCompletos);

        totalPost00 = $("#anos-ant-anos-completos").val() * 52;
        $("#anos-ant-semanas-completas-posteriores-500").val(totalPost00);

        $("#anos-ant-sem-reconocidas-post-500").val(
            parseInt($("#formulas-semana-cotizadas").val()) - 500
        );

        $("#anos-ant-sem-completas-post-500").val(totalPost00);

        semanasResiduos =
            $("#anos-ant-sem-reconocidas-post-500").val() -
            $("#anos-ant-sem-completas-post-500").val();
        $("#anos-ant-semanas-residuo").val(semanasResiduos);

        if (semanasResiduos >= 0 && semanasResiduos <= 12.99) {
            incrAnual = 0;
        } else if (semanasResiduos >= 13 && semanasResiduos <= 26) {
            incrAnual = 0.5;
        } else if (semanasResiduos > 26) {
            incrAnual = 1.0;
        }

        $("#anos-ant-ano-residuo").val(incrAnual);

        $("#anos-ant-comp-reconocdos-post-500").val(
            $("#anos-ant-anos-completos").val()
        );

        $("#anos-ant-mas-anos-residuo").val(incrAnual);

        totAnosReconocidos =
            parseInt($("#anos-ant-comp-reconocdos-post-500").val()) +
            parseInt($("#anos-ant-mas-anos-residuo").val());
        $("#anos-ant-tot-anos-reconocidos-post-500").val(totAnosReconocidos);
        $("#total-anos-reconocidos").val(totAnosReconocidos);
        // Buscar cuantía basica en tablas formulas-salario-promedio-vsm
        cuantiaBasicaHojas(
            $("#formulas-salario-promedio-vsm").val(),
            edadJubilacion,
            hoja,
            edadPension
        );
    }

    function cuantiaBasicaHojas(
        salarioPromedioVsm,
        edadJubilacion,
        hoja,
        edadPension
    ) {
        $.ajax({
            url: "/buscar-cuantia-basica",
            type: "get",
            data: { salarioPromedioVsm: salarioPromedioVsm },
            dataType: "json"
        })
            .done(function(response) {
                // console.log();
                $("#cuantia-basica-valor").val(response.data.cuantia_basica);
                $("#incremento-anual-cuantia-basica-valor").val(
                    response.data.incremento_anual
                );

                cuantiaBasicaSalarioPromedio = $(
                    "#cuantia-basica-salario-promedio"
                ).val();
                cuantiaBasicaValor = $("#cuantia-basica-valor").val();
                cuantiaBasicaDiaria =
                    parseFloat(cuantiaBasicaSalarioPromedio) *
                    parseFloat(cuantiaBasicaValor / 100);
                $("#cuantia-basica-diaria").val(cuantiaBasicaDiaria.toFixed(2));

                cuantiaBasicaDiaria = parseFloat(
                    $("#cuantia-basica-diaria").val()
                );
                cuantiaBasicaX365 = parseFloat(
                    $("#cuantia-basica-x-365").val()
                );
                cuantiaBasicaAnual = cuantiaBasicaDiaria * cuantiaBasicaX365;
                $("#cuantia-basica-anual").val(cuantiaBasicaAnual.toFixed(2));
                cuantiaBasicaMensual = cuantiaBasicaAnual / 12;
                $("#cuantia-basica-mensual").val(
                    cuantiaBasicaMensual.toFixed(2)
                );

                anualCuantiaBasicaSalarioPromedio = $(
                    "#incremento-anual-cuantia-basica-salario-promedio"
                ).val();
                anualCuantiaBasicaValor = $(
                    "#incremento-anual-cuantia-basica-valor"
                ).val();

                incrementoAnualCuantiaBasicaDiaria =
                    anualCuantiaBasicaSalarioPromedio *
                    (anualCuantiaBasicaValor / 100);
                $("#incremento-anual-cuantia-basica-diaria").val(
                    incrementoAnualCuantiaBasicaDiaria.toFixed(2)
                );

                incrementoAnual = incrementoAnualCuantiaBasicaDiaria * 365;
                $("#incremento-anual-previo").val(incrementoAnual.toFixed(2));

                incrementoAnualPrevio = $("#incremento-anual-previo").val();
                totalAnosReconocidos = $("#total-anos-reconocidos").val();
                total3 = incrementoAnualPrevio * totalAnosReconocidos;
                $("#incremento-anual-a-la-cuantia-basica").val(total3);
                total4 = total3 / 12;
                $("#incremento-mensual-cuantia-basica").val(total4.toFixed(2));

                $("#cuanta-anual-pension-basica").val(
                    $("#cuantia-basica-anual").val()
                );

                $("#cuanta-anual-pension-incremento").val(
                    $("#incremento-anual-a-la-cuantia-basica").val()
                );

                total5 = parseFloat(
                    $("#cuanta-anual-pension-incremento").val()
                );
                total6 = parseFloat($("#cuanta-anual-pension-basica").val());
                total7 = total5 + total6;
                $("#cuanta-anual-pension-igual").val(total7.toFixed(2));
                total8 = total7 / 12;
                $("#cuanta-anual-pension-igual-mensual").val(total8.toFixed(2));

                // Ayuda Esposa
                $("#asig-esposa-cuantia-anual-pension").val(total7.toFixed(2));
                montoEsposa =
                    $("#esposa").val() == "No" ? 0 : total7 * (15 / 100);
                $("#asig-esposa-asignacion-viuda").val(montoEsposa.toFixed(2));
                $("#asig-esposa-mensual").val((montoEsposa / 12).toFixed(2));

                // Ayuda Hijos
                $("#ayuda-hijos-cuantia-anual-pension").val(total7.toFixed(2));
                hijos = $("#hijos").val();
                $("#ayuda-hijos-nro-hijos").val(hijos);
                total9 = total7 * (10 / 100) * hijos;
                $("#ayuda-hijos-ayuda-anual").val(total9.toFixed(2));
                $("#ayuda-hijos-mensual").val((total9 / 12).toFixed(2));

                // Ayuda Padres
                $("#ayuda-padres-anual-pesion").val(total7.toFixed(2));
                padres = $("#padres").val();
                $("#ayuda-padres-nro-padres").val(padres);

                if ($("#esposa").val() == "Si" || hijos > 0) {
                    total10 = 0;
                } else {
                    total10 = total7 * (20 / 100) * padres;
                }
                $("#ayuda-padres-ayuda-anual").val(total10.toFixed(2));
                $("#ayuda-padres-anual").val((total10 / 12).toFixed(2));

                // Ayuda por Soledad
                $("#ayuda-soledad-anual-pension").val(total7.toFixed(2));
                montosoledad =
                    $("#esposa").val() == "No" && hijos == 0 && padres == 0
                        ? total7 * (15 / 100)
                        : 0;
                $("#ayuda-soledad-anual").val(montosoledad.toFixed(2));
                $("#ayuda-soledad-mensual").val((montosoledad / 12).toFixed(2));

                // Total ayudas
                totalAyudas = montoEsposa + total9 + total10 + montosoledad;
                $("#total-ayudas").val(totalAyudas.toFixed(2));
                $("#total-ayudas-mensual").val((totalAyudas / 12).toFixed(2));
                $("#total-ayuda-cuantia-anual").val(total7.toFixed(2));
                $("#total-ayuda-cuantia-anual-mas-ayuda").val(
                    (totalAyudas + total7).toFixed(2)
                );
                $("#total-ayuda-cuantia-anual-ayuda-mensual").val(
                    ((totalAyudas + total7) / 12).toFixed(2)
                );

                $("#cuantia-anual-pension-mas-ayudas").val(
                    (totalAyudas + total7).toFixed(2)
                );
                $("#cuantia-anual-pension-mas-ayudas-mensual").val(
                    ((totalAyudas + total7) / 12).toFixed(2)
                );
                $("#igual-pension-anual-x-vejez").val(
                    ((totalAyudas + total7) * (111 / 100)).toFixed(2)
                );
                $("#igual-pension-anual-x-vejez-mensual").val(
                    (((totalAyudas + total7) * (111 / 100)) / 12).toFixed(2)
                );

                switch (edadJubilacion) {
                    case 60:
                        $porc = 75;
                        break;
                    case 61:
                        $porc = 80;
                        break;
                    case 62:
                        $porc = 85;
                        break;
                    case 63:
                        $porc = 90;
                        break;
                    case 64:
                        $porc = 95;
                        break;
                    case 65:
                        $porc = 100;
                        break;
                    default:
                        $porc = 100;
                }
                $("#porc-pension-por-edad").val($porc);

                pensionAnualVejez = (totalAyudas + total7) * (111 / 100);
                $("#pension-anual-x-vejez-fin").val(
                    pensionAnualVejez.toFixed(2)
                );

                $("#pension-anual-x-cesantia").val(
                    (pensionAnualVejez * ($porc / 100)).toFixed(2)
                );

                $("#pension-anual-x-cesantia-mensual").val(
                    ((pensionAnualVejez * ($porc / 100)) / 12).toFixed(2)
                );

                $("#pension-anual-fin").text(
                    $.number(pensionAnualVejez * ($porc / 100), 2, ",", ".")
                );
                $("#pension-mensual-fin").text(
                    $.number(
                        (pensionAnualVejez * ($porc / 100)) / 12,
                        2,
                        ",",
                        "."
                    )
                );

                $("#" + hoja + "-pension-mensual-con-m40").val(
                    $("#pension-mensual-fin").text()
                );

                $("#" + hoja + "-pension-anual-con-m40").val(
                    $("#pension-anual-fin").text()
                );

                aguinaldo = convertNumberPure(
                    $("#" + hoja + "-pension-mensual-con-m40").val()
                );

                aguinaldo = aguinaldo * 0.85;
                $("#" + hoja + "-aguinaldo").val(
                    $.number(aguinaldo, 2, ",", ".")
                );

                totalAnual = convertNumberPure($("#pension-anual-fin").text());
                totalAnual = totalAnual + aguinaldo;
                $("#" + hoja + "-total-anual").val(
                    $.number(totalAnual, 2, ",", ".")
                );

                difEdad = 85 - edadPension;
                $("#" + hoja + "-dif-edad-85-text").text(difEdad);
                $("#" + hoja + "-dif-85").val(
                    $.number(totalAnual * difEdad, 2, ",", ".")
                );

                $("#title-pension-con-m40").attr(
                    "class",
                    "text-success blink_me"
                );
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }
});
