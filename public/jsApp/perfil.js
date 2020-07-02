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
            '<li class="breadcrumb-item active">Perfil</li>' +
            "</ol>"
    );

    buscaPerfil();

    function buscaPerfil() {
        $.ajax({
            url: "buscar-perfil",
            type: "get",
            datatype: "json",
            data: {
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function() {
                loadingUI("Buscando el perfil...");
            }
        })
            .fail(function(statusCode, errorThrown) {
                console.log(statusCode + " " + errorThrown);
            })
            .done(function(response) {
                console.log(response.data.user.email);

                $("#idUser").val(response.data.user.id);
                $("#email").val(response.data.user.email);
                $("#rol")
                    .val(response.data.user.rol)
                    .trigger("chosen:updated");
                $("#rol")
                    .prop("disabled", true)
                    .trigger("chosen:updated");
                $("#nombre").val(response.data.user.name);
                $("#telefonoFijo").val(response.data.user.telefonoFijo);
                $("#telefonoMovil").val(response.data.user.telefonoMovil);
                $("#direccion").val(response.data.user.direccion);
                $("#postal-code").val(response.data.user.cp);
                $("#pais")
                    .val(response.data.user.pais_id)
                    .trigger("chosen:updated");

                $("#linkedin").val(response.data.user.linkedin);
                $("#twitter").val(response.data.user.twitter);
                $("#facebook").val(response.data.user.facebook);
                $("#instagram").val(response.data.user.instagram);

                $.unblockUI();
            });
    }

    $("#FormPerfil")
        .parsley()
        .on("field:validated", function() {
            var ok = $(".parsley-error").length === 0;
            $(".bs-callout-info").toggleClass("hidden", !ok);
            $(".bs-callout-warning").toggleClass("hidden", ok);
        })
        .on("form:submit", function() {
            return true;
        });

    $("#FormPerfil").submit(function(e) {
        e.preventDefault();
        $("#rol").prop("disabled", false);
        var form = $("#FormPerfil");
        var formData = form.serialize();
        var route = form.attr("action");
        $.ajax({
            url: route,
            type: "post",
            data: formData,
            dataType: "json",
            beforeSend: function() {
                loadingUI("Actualizando la Ubicación");
            }
        })
            .done(function(data) {
                console.log(data);
                if (data.success === true) {
                    alertify.success(
                        "Los datos del Perfil se guardaron exitosamente."
                    );
                } else {
                    alertify.error(
                        "Hubo un problema guardando los datos del Perfil."
                    );
                }

                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });
});
