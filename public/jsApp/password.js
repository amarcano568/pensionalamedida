$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var objetoDataTables_Facturas = "";

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $(".chosen-select").chosen(ConfigChosen());

    $("#migas-pan").html(
        '<ol class="breadcrumb border-0 m-0">' +
            '<li class="breadcrumb-item">Home</li>' +
            '<li class="breadcrumb-item">' +
            '<a href="#">Usuario</a></li>' +
            '<li class="breadcrumb-item active">Cambiar contraseña</li>' +
            "</ol>"
    );

    $("#FormPassword")
        .parsley()
        .on("field:validated", function() {
            var ok = $(".parsley-error").length === 0;
            $(".bs-callout-info").toggleClass("hidden", !ok);
            $(".bs-callout-warning").toggleClass("hidden", ok);
        })
        .on("form:submit", function() {
            return true;
        });

    $("#FormPassword").submit(function(e) {
        e.preventDefault();
        var form = $("#FormPassword");
        var formData = form.serialize();
        var route = form.attr("action");

        alertify
            .confirm(
                '<h5 class="text-warning"><i class="cil-key"></i> Cambiar la contraseña</h5>',
                '<h5 class="text-danger">Esta seguro de cambiar la contraseña..<i class="cil-sync"></i></h5>',
                function() {
                    $.ajax({
                        url: route,
                        type: "post",
                        data: formData,
                        dataType: "json",
                        beforeSend: function() {
                            loadingUI("Actualizando la contraseña");
                        }
                    })
                        .done(function(data) {
                            console.log(data);
                            if (data.status === true) {
                                alertify.success(data.message);
                            } else {
                                alertify.error(data.message);
                            }

                            $.unblockUI();
                        })
                        .fail(function(statusCode, errorThrown) {
                            $.unblockUI();
                            console.log(statusCode);
                            ajaxError(statusCode, errorThrown);
                        });
                },
                function() {
                    // En caso de Cancelar
                    alertify.error(
                        '<i class="fa-2x fas fa-ban"></i><br>Se Cancelo el Proceso para cambiar la contraseña.'
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
});
