$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var archivoPdf = "";
    var descripcionImg = "";
    var objetoDataTables_Facturas = "";

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $("#btn-ver-pdf").click(function() {
        uuid = $("#uuid-pension").val();
        idCliente = $("#idCliente").val();
        $.ajax({
            url: "/ver-pdf-detalle",
            type: "get",
            data: { uuid: uuid, idCliente: idCliente },
            dataType: "json",
            beforeSend: function() {
                loadingUI("Actualizando el cliente");
            }
        })
            .done(function(response) {
                console.log(response);
                archivoPdf = response.data;
                $("#ObjPdf").attr("src", response.data);
                $(".btn-enviar-correo").html(
                    '<i class="far fa-envelope"></i> Enviar a <strong>' +
                        response.email +
                        "</strong>"
                );
                $("#modal-ver-pdf").modal("show");
                $(".btn-enviar-correo").show();
                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $(".btn-enviar-correo").click(function() {
        uuid = $("#uuid-pension").val();
        idCliente = $("#idCliente").val();
        $.ajax({
            url: "/send-mail-resumen",
            type: "get",
            data: { uuid: uuid, idCliente: idCliente, archivoPdf: archivoPdf },
            dataType: "json",
            beforeSend: function() {
                loadingUI("Enviando correo");
            }
        })
            .done(function(response) {
                console.log(response);
                $.unblockUI();
                if (response.success === true) {
                    alertify.success(response.mensaje);
                } else {
                    alertify.error(response.mensaje);
                }
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });
});
