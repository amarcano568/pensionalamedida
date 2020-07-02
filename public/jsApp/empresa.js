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
            '<a href="#">Configuración</a></li>' +
            '<li class="breadcrumb-item active">Información de Empresa</li>' +
            "</ol>"
    );

    buscaPerfil();

    function buscaPerfil() {
        $.ajax({
            url: "buscar-empresa",
            type: "get",
            datatype: "json",
            data: {
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function() {
                loadingUI("Buscando la empresa...");
            }
        })
            .fail(function(statusCode, errorThrown) {
                console.log(statusCode + " " + errorThrown);
            })
            .done(function(response) {
                console.log(response.data);
                $("#idEmpresa").val(response.data[0].id);
                $("#nombreFiscal").val(response.data[0].nombreFiscal);
                $("#nombreComercial").val(response.data[0].nombreComercial);
                $("#rfc").val(response.data[0].rfc);
                $("#estado")
                    .val(response.data[0].estado)
                    .trigger("chosen:updated");
                $("#direccion").val(response.data[0].direccion);
                $("#provincia").val(response.data[0].provincia);
                $("#cp").val(response.data[0].cp);
                $("#telefonoFijo").val(response.data[0].telefonoFijo);
                $("#telefonoMovil").val(response.data[0].telefonoMovil);
                $("#fax").val(response.data[0].fax);
                $("#email").val(response.data[0].email);
                $("#web").val(response.data[0].web);
                $("#linkedin").val(response.data[0].linkedin);
                $("#twitter").val(response.data[0].twitter);
                $("#facebook").val(response.data[0].facebook);
                $("#instagram").val(response.data[0].instagram);
                $("#youtube").val(response.data[0].youtube);
                $("#logo").attr("src", response.data[0].logo);

                $.unblockUI();
            });
    }

    $("#FormEmpresa")
        .parsley()
        .on("field:validated", function() {
            var ok = $(".parsley-error").length === 0;
            $(".bs-callout-info").toggleClass("hidden", !ok);
            $(".bs-callout-warning").toggleClass("hidden", ok);
        })
        .on("form:submit", function() {
            return true;
        });

    $("#FormEmpresa").submit(function(e) {
        e.preventDefault();
        var form = $("#FormEmpresa");
        var formData = form.serialize();
        var route = form.attr("action");
        $.ajax({
            url: route,
            type: "post",
            data: formData,
            dataType: "json",
            beforeSend: function() {
                loadingUI("Actualizando la Empresa");
            }
        })
            .done(function(data) {
                console.log(data);
                if (data.success === true) {
                    alertify.success(data.mensaje);
                } else {
                    alertify.error(data.mensaje);
                }

                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $("#ModalAgregarLogo").on("shown.bs.modal", function() {
        iconoDropZone =
            '<br><br><i class="fa-4x fas fa-camera-retro"></i><br><h6>Click para agregar Logo de la empresa.</h6>';
        configuraDropZone(iconoDropZone);
    });

    function configuraDropZone(iconoDropZone) {
        idMiembro = $("#idMiembro").val();
        Dropzone.autoDiscover = false;
        Dropzone.prototype.defaultOptions.dictRemoveFile = "Borrar archivo..";
        // if (Dropzone.instances.length > 0)
        //     Dropzone.instances.forEach(bz => bz.destroy());
        $("#formDropZone").html("");
        $("#formDropZone").append(
            "<form action='subir-logo' method='POST' files='true' enctype='multipart/form-data' id='dZUpload' class='dropzone borde-dropzone' style='width: 100%;padding: 0;cursor: pointer;'>" +
                "<div style='padding: 0;margin-top: 0em;' class='dz-default dz-message text-center'>" +
                iconoDropZone +
                "</div></form>"
        );

        myAwesomeDropzone = myAwesomeDropzone = {
            maxFilesize: 12,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp",
            addRemoveLinks: true,
            timeout: 50000,
            maxFiles: 1,
            removedfile: function(file) {
                var name = file.name;
                // console.log(name);
                $.ajax({
                    type: "post",
                    url: "delete-logo",
                    data: {
                        filename: name
                    },
                    success: function(data) {
                        console.log("File has been successfully removed!!");
                        var dt = new Date();
                        $("#divLogo").html(
                            '<img src="img/sinlogo.png' +
                                "?" +
                                dt.getTime() +
                                '"  height="150" width="150" id="logo" class="img-thumbnail img-fluid">'
                        );
                        $("#logoWelcome").html(
                            '<img src="img/sinlogo.png' +
                                "?" +
                                dt.getTime() +
                                '"  height="150" width="150" id="logo" class="img-fluid">'
                        );
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null
                    ? fileRef.parentNode.removeChild(file.previewElement)
                    : void 0;
            },
            params: {},
            success: function(file, response) {
                console.log(response);
                //$("#ModalAgregarLogo").modal("hide");
                //$("#ModalAgregarLogo .close").click();
                var dt = new Date();
                $("#divLogo").html(
                    '<img src="' +
                        response +
                        "?" +
                        dt.getTime() +
                        '"  height="150" width="150" id="logo" class="img-thumbnail img-fluid">'
                );
                $("#logoWelcome").html(
                    '<img src="' +
                        response +
                        "?" +
                        dt.getTime() +
                        '"  alt="" width="118" height="46" id="logo" class="img-fluid">'
                );
            },
            error: function(file, response) {
                return false;
            }
        };

        var myDropzone = new Dropzone("#dZUpload", myAwesomeDropzone);

        // myDropzone.on("queuecomplete", function(file, response) {
        //     if (Dropzone.instances.length > 0)
        //         Dropzone.instances.forEach(bz => bz.destroy());
        //     $("#ModalAgregarLogo").modal("hide");
        // });
    }
});
