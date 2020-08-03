$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var archivoPdf = "";
    var inpcChange = false;

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $(document).on("click", "#btn-ver-pdf", function(event) {
        mejorSalario = $("#mejor-salario-mensual-nivel-vida").val();
        if (mejorSalario == "") {
            alertify.alert(
                "Nivel de vida...",
                '<h5 class="text-danger"><i class="text-danger fas fa-exclamation-triangle"></i> Por favor agregue información de Nivel de Vida incluyendo los indices de INPC</h5><br>',
                function() {
                    activaTab("nivel-de-vida", "#empresa-nivel-vida");
                }
            );
            return false;
        }
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

    $(document).on("click", ".btn-enviar-correo", function(event) {
        uuid = $("#uuid-pension").val();
        idCliente = $("#idCliente").val();
        $.ajax({
            url: "/send-mail-detalle",
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

    $(document).on("click", "#btn-ipnc", function(event) {
        event.preventDefault();
        $("#modal-inpc").modal("show");
    });

    $(document).on("change", "#salario-diario-nivel-vida", function(event) {
        event.preventDefault();
        calculaNivelVida();
    });

    function calculaNivelVida() {
        uuid = $("#uuid-pension").val();
        idCliente = $("#idCliente").val();
        inpcMesOriginal = $("#inpc-mes-original").val();
        inpcMesActual = $("#inpc-mes-actual").val();
        salarioDiarioNivelVida = $("#salario-diario-nivel-vida").val();
        empresaNivelVida = $("#empresa-nivel-vida").val();
        fechaNivelvida = $("#fecha-nivel-vida").val();
        $.ajax({
            url: "/change-view-nivel-vida",
            type: "get",
            data: {
                uuid: uuid,
                idCliente: idCliente,
                inpcMesOriginal: inpcMesOriginal,
                inpcMesActual: inpcMesActual,
                salarioDiarioNivelVida: salarioDiarioNivelVida,
                empresaNivelVida: empresaNivelVida,
                fechaNivelvida: fechaNivelvida
            },
            dataType: "json",
            beforeSend: function() {
                loadingUI("Enviando correo");
            }
        })
            .done(function(response) {
                console.log(response);
                $.unblockUI();
                $("#principalPanel")
                    .empty()
                    .append($(response));
                inpcChange = false;
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown, "INPC");
            });
    }

    $(document).on("click", "#btn-cerrar-modal-inpc", function(event) {
        event.preventDefault();
        inpcOriginal = $("#inpc-mes-original").val();
        inpcActual = $("#inpc-mes-actual").val();
        valida = $("#form-modal-inpc")
            .parsley()
            .validate();
        if (valida === false) {
            alertify.set("notifier", "position", "top-center");
            alertify.error(
                '<i class="fas fa-exclamation-triangle"></i><br>Por favor agregar el los valores <strong>INPC</strong>.'
            );
            return false;
        } else {
            if (inpcChange) {
                calculaNivelVida();
            }
            $("#modal-inpc").modal("hide");
            cierraModal();
        }
    });

    $(document).on("change", "#inpc-mes-original,#inpc-mes-actual", function(
        event
    ) {
        event.preventDefault();
        inpcChange = true;
    });
});
