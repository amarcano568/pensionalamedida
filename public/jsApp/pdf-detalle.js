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
                });

                $.unblockUI();
            });
    }
});
