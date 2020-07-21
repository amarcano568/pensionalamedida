$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var archivoPdf = "";
    var descripcionImg = "";
    var objetoDataTables_Facturas = "";

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    buscarDataTomaDecisiones();

    function buscarDataTomaDecisiones() {
        idCliente = $("#idCliente").val();
        uuid = $("#uuid-pension").val();
        $.ajax({
            url: "/data-toma-decisiones",
            type: "get",
            datatype: "json",
            data: {
                _token: "{{ csrf_token() }}",
                idCliente: idCliente,
                uuid: uuid
            },
            beforeSend: function() {
                loadingUI("Obteniendo Data Toma Decisiones.");
            }
        })
            .fail(function(statusCode, errorThrown) {
                console.log(statusCode + " " + errorThrown);
            })
            .done(function(response) {
                console.log(response.data);
                // Llleno Perdidas y Ganancias

                response.data.forEach(element => {
                    hoja = element.hoja.split("-");
                    $("#g-p-pension-acumulada-" + hoja[1]).html(
                        "<strong>" +
                            $.number(element.dif85, 2, ".", ",") +
                            "</strong>"
                    );
                });

                pensionSinM40 = $("#g-p-pension-acumulada-1").text();
                $(".g-p-pension-pension-sin-m40").html(
                    "<strong>" +
                        $.number(pensionSinM40, 2, ".", ",") +
                        "</strong>"
                );

                mon2 =
                    convertNumberPure($("#g-p-pension-acumulada-2").text()) -
                    convertNumberPure(pensionSinM40);
                mon3 =
                    convertNumberPure($("#g-p-pension-acumulada-3").text()) -
                    convertNumberPure(pensionSinM40);
                mon4 =
                    convertNumberPure($("#g-p-pension-acumulada-4").text()) -
                    convertNumberPure(pensionSinM40);
                mon5 =
                    convertNumberPure($("#g-p-pension-acumulada-5").text()) -
                    convertNumberPure(pensionSinM40);
                mon6 =
                    convertNumberPure($("#g-p-pension-acumulada-6").text()) -
                    convertNumberPure(pensionSinM40);

                $("#g-p-ingreso-adicional-acumulado-2").html(
                    "<strong>" + $.number(mon2, 2, ".", ",") + "</strong>"
                );
                $("#g-p-ingreso-adicional-acumulado-3").html(
                    "<strong>" + $.number(mon3, 2, ".", ",") + "</strong>"
                );
                $("#g-p-ingreso-adicional-acumulado-4").html(
                    "<strong>" + $.number(mon4, 2, ".", ",") + "</strong>"
                );
                $("#g-p-ingreso-adicional-acumulado-5").html(
                    "<strong>" + $.number(mon5, 2, ".", ",") + "</strong>"
                );
                $("#g-p-ingreso-adicional-acumulado-6").html(
                    "<strong>" + $.number(mon6, 2, ".", ",") + "</strong>"
                );

                response.data.forEach(element => {
                    hoja = element.hoja.split("-");
                    $("#g-p-dinero-invertido-coop-m40-" + hoja[1]).html(
                        "<strong>" +
                            $.number(element.invertido_coop_m40, 2, ".", ",") +
                            "</strong>"
                    );
                });

                for (i = 2; i <= 6; i++) {
                    ingresoAdicional = convertNumberPure(
                        $("#g-p-ingreso-adicional-acumulado-" + i).text()
                    );
                    dineroInvertido = convertNumberPure(
                        $("#g-p-dinero-invertido-coop-m40-" + i).text()
                    );
                    neto = ingresoAdicional - dineroInvertido;
                    $("#g-p-ganancia-neta-acumulada-" + i).html(
                        "<strong>" + $.number(neto, 2, ".", ",") + "</strong>"
                    );
                }

                for (i = 2; i <= 6; i++) {
                    ingresoAdicional = convertNumberPure(
                        $("#g-p-ingreso-adicional-acumulado-" + i).text()
                    );

                    gananciaAcumulada = convertNumberPure(
                        $("#g-p-ganancia-neta-acumulada-" + i).text()
                    );

                    porcIngresoAdicional =
                        (gananciaAcumulada / ingresoAdicional) * 100;

                    $("#g-p-porc-ingreso-adicional-" + i).html(
                        "<strong>" +
                            $.number(porcIngresoAdicional, 2, ".", ",") +
                            "%</strong>"
                    );
                }

                for (i = 2; i <= 6; i++) {
                    gananciaAcumulada = convertNumberPure(
                        $("#g-p-ganancia-neta-acumulada-" + i).text()
                    );

                    dineroInvertido = convertNumberPure(
                        $("#g-p-dinero-invertido-coop-m40-" + i).text()
                    );

                    recuperaInvertido = gananciaAcumulada / dineroInvertido;

                    $("#g-p-recupera-ivertido-" + i).html(
                        "<h4>" +
                            $.number(recuperaInvertido, 2, ".", ",") +
                            "</h4>"
                    );
                }
                console.log(response.pension_1_4);
                pensionNoCobrada2 =
                    response.pension_1_4[0] * 12 +
                    response.pension_1_4[0] * 1 * 0.85;

                pensionNoCobrada4 =
                    response.pension_1_4[1] * 24 +
                    response.pension_1_4[1] * 2 * 0.85;

                $("#g-p-pension-no-cobrada-2").html(
                    "<h4>" + $.number(pensionNoCobrada2, 2, ".", ",") + "</h4>"
                );
                $("#g-p-pension-no-cobrada-3").html(
                    "<h4>" + $.number(pensionNoCobrada2, 2, ".", ",") + "</h4>"
                );

                $("#g-p-pension-no-cobrada-5").html(
                    "<h4>" + $.number(pensionNoCobrada4, 2, ".", ",") + "</h4>"
                );
                $("#g-p-pension-no-cobrada-6").html(
                    "<h4>" + $.number(pensionNoCobrada4, 2, ".", ",") + "</h4>"
                );

                for (i = 2; i <= 6; i++) {
                    pensionNoCobrada = convertNumberPure(
                        $("#g-p-pension-no-cobrada-" + i).text()
                    );

                    pensionNoCobrada = isNaN(pensionNoCobrada)
                        ? 0
                        : pensionNoCobrada;

                    gananciaAcumulada = convertNumberPure(
                        $("#g-p-ganancia-neta-acumulada-" + i).text()
                    );

                    GanancionMenosIngresos =
                        gananciaAcumulada - pensionNoCobrada;
                    $("#g-p-ganancia-menos-ingresos-" + i).html(
                        "<h4>" +
                            $.number(GanancionMenosIngresos, 2, ".", ",") +
                            "</h4>"
                    );
                }

                // Indicadores para toma de decisiones
                response.data.forEach(element => {
                    hoja = element.hoja.split("-");
                    $("#hoja-" + hoja[1] + "-pagando-cada-mes").html(
                        "<strong>" +
                            "$ " +
                            $.number(element.pagando_mensual, 2, ".", ",") +
                            "</strong>"
                    );
                    $("#hoja-" + hoja[1] + "-obtienes-pension-mensual").html(
                        "<strong>" +
                            "$" +
                            $.number(element.pension_mensual, 2, ".", ",") +
                            "</strong>"
                    );

                    $("#hoja-" + hoja[1] + "-ingreso-total-acumulado").html(
                        "<strong>" +
                            "$ " +
                            $.number(element.dif85, 2, ".", ",") +
                            "</strong>"
                    );

                    $("#hoja-" + hoja[1] + "-solo-invierte-cooperativa").html(
                        "<strong>" +
                            "$ " +
                            $.number(element.costo_total, 2, ".", ",") +
                            "</strong>"
                    );
                });

                response.cotiza_fechas.forEach(element => {
                    hoja = element.hoja.split("-");
                    $("#hoja-" + hoja[1] + "-fecha-desde").html(
                        "<strong>" +
                            moment(element.del).format("DD-MM-YYYY") +
                            "</strong>"
                    );
                    $("#hoja-" + hoja[1] + "-fecha-hasta").html(
                        "<strong>" +
                            moment(element.al).format("DD-MM-YYYY") +
                            "</strong>"
                    );

                    tiempo = element.edad_detalle.split("|");
                    $("#hoja-" + hoja[1] + "-cotizas-anos").html(
                        "<strong>" + tiempo[0] + "</strong>"
                    );
                    $("#hoja-" + hoja[1] + "-cotizas-meses").html(
                        "<strong>" + tiempo[1] + "</strong>"
                    );
                });

                response.cliente_ano_mes.forEach(element => {
                    hoja = element.hoja.split("-");
                    $("#hojas-" + hoja[1] + "-anos-meses").html(
                        "<br><br><strong>" +
                            element.edad_anos_meses +
                            "</strong>"
                    );
                });

                for (i = 2; i <= 6; i++) {
                    GyP = $("#g-p-ganancia-neta-acumulada-" + i).text();
                    $("#hoja-" + i + "-ganancia-neta-acumulada").html(
                        "<strong>$ " + GyP + "</strong>"
                    );
                }

                for (i = 2; i <= 6; i++) {
                    GyP = convertNumberPure(
                        $("#g-p-ganancia-neta-acumulada-" + i).text()
                    );
                    soloInviertes = convertNumberPure$(
                        $("#hoja-" + i + "-solo-invierte-cooperativa").text()
                    );

                    seMultipliTuInversion = GyP / soloInviertes;
                    $("#hoja-" + i + "-inversion-multiplica").html(
                        "<strong>" +
                            seMultipliTuInversion.toFixed(2) +
                            "</strong>"
                    );
                }

                $.unblockUI();
            });
    }
});
