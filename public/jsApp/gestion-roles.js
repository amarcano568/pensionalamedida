$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var objetoDataTables_Usuarios = "";

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $(".chosen-select").chosen(ConfigChosen());

    $("#migas-pan").html(
        '<ol class="breadcrumb border-0 m-0">' +
            '<li class="breadcrumb-item">Home</li>' +
            '<li class="breadcrumb-item">' +
            '<a href="#">Configuración</a></li>' +
            '<li class="breadcrumb-item active">Gestión de roles</li>' +
            "</ol>"
    );

    $("#role").change(function(ev) {
        idRole = $("#role").val();
        if (idRole == "") {
            $("#permisosDisponibles").html("");
            $("#permisosAsignados").html("");
            $("#PasarTodas").show();
            $("#RevocarTodas").show();
            return false;
            //<li style="pointer-events:none;opacity:0.6;color: blue;font-size:18px;text-align:left;" class="ui-sortable-handle"><i class="ace-icon fa fa-file-text-o"></i> 08.- Presupuesto</li>
        }
        $.ajax({
            url: "change-role",
            type: "get",
            data: { idRole: idRole },
            dataType: "json",
            beforeSend: function() {
                loadingUI("Actualizando el cliente");
            }
        })
            .done(function(response) {
                console.log(response);
                $("#created_at").val(response.data.roleFormatDate);
                $("#permisosAsignados").html(response.asignados);
                $("#permisosDisponibles").html(response.disponibles);
                $("#PasarTodas").show();
                $("#RevocarTodas").show();

                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $(init);

    function init() {
        $(".droppable-area1, .droppable-area2").sortable({
            connectWith: ".connected-sortable",
            stack: ".connected-sortable ul"
        });
    }

    $(".ulOpciones").sortable({
        receive: function(event, ui) {
            ui.item.unbind("click");
            ui.item.one("click", function(event) {
                console.log("one-time-click");
                event.stopImmediatePropagation();
                $(this).click(myClick);
            });
            rol = $("#role").val();
            permiso = event.toElement.attributes.permission.nodeValue;
            console.log("Id: " + event.target.id);
            console.log("Permiso: " + permiso);

            if (event.target.id == "permisosDisponibles") {
                $("#liDisponibleEmpty").remove();
                revocarPermiso(rol, permiso);
            }
            if (event.target.id == "permisosAsignados") {
                $("#liAsignadoEmpty").remove();
                darPermisoA(rol, permiso);
            }

            contarUL();
        },
        delay: 30
    });

    function darPermisoA(rol, permiso) {
        $.ajax({
            url: "dar-permiso-a",
            type: "get",
            data: { rol: rol, permiso: permiso },
            dataType: "json",
            beforeSend: function() {
                loadingUI("Revocando permiso.");
            }
        })
            .done(function(response) {
                console.log(response);
                alertify.dismissAll();
                if (response.success === true) {
                    alertify.success(response.mensaje);
                } else {
                    alertify.error(response.mensaje);
                }

                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    function revocarPermiso(rol, permiso) {
        $.ajax({
            url: "revocar-permiso",
            type: "get",
            data: { rol: rol, permiso: permiso },
            dataType: "json",
            beforeSend: function() {
                loadingUI("Revocando permiso.");
            }
        })
            .done(function(response) {
                console.log(response);
                alertify.dismissAll();
                if (response.success === true) {
                    alertify.success(response.mensaje);
                } else {
                    alertify.error(response.mensaje);
                }

                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    function contarUL() {
        Disponibles = $("ul#permisosDisponibles li").length;
        Asignados = $("ul#permisosAsignados li").length;

        if (Disponibles == 0) {
            $("#permisosDisponibles").append(
                '<li id="liDisponibleEmpty" style="pointer-events:none;opacity:0.6;" class="ui-state-default"></li>'
            );
        }
        if (Asignados == 0) {
            $("#permisosAsignados").append(
                '<li id="liAsignadoEmpty" style="pointer-events:none;opacity:0.6;" class="ui-state-default"></li>'
            );
        }
    }

    $("#PasarTodas").click(function() {
        if ($("#liDisponibleEmpty").length > 0) {
            return false;
        }
        $("#permisosDisponibles li").each(function(idx, valor) {
            $(this).appendTo("#permisosAsignados");
            console.log(valor);
            permiso = $(this).attr("permission");
            rol = $("#role").val();
            darPermisoA(rol, permiso);
        });
        $("#liAsignadoEmpty").remove();
        contarUL();
    });

    $("#RevocarTodas").click(function() {
        if ($("#liAsignadoEmpty").length > 0) {
            return false;
        }
        $("#permisosAsignados li").each(function(idx, valor) {
            console.log(valor);
            $(this).appendTo("#permisosDisponibles");
            permiso = $(this).attr("permission");
            rol = $("#role").val();
            revocarPermiso(rol, permiso);
        });
        $("#liDisponibleEmpty").remove();
        contarUL();
        //ordenarLista();
    });

    $(document).on("click", "#permisosAsignados li", function() {
        $(this).appendTo("#permisosDisponibles");
        $("#liDisponibleEmpty").remove();
        contarUL();
    });

    $(document).on("click", ".permisoAsignado", function() {
        permiso = $(this).attr("permission");
        rol = $("#role").val();
        revocarPermiso(rol, permiso);
    });

    $(document).on("click", ".permisoDisponible", function() {
        permiso = $(this).attr("permission");
        rol = $("#role").val();
        darPermisoA(rol, permiso);
    });

    $(document).on("click", "#permisosDisponibles li", function() {
        $(this).appendTo("#permisosAsignados");
        $("#liAsignadoEmpty").remove();
        contarUL();
    });

    $("#btnNuevoRol").click(function() {
        $("#modal-role-new").modal("show");
        $("#newRole").focus();
    });

    $("#FormRole")
        .parsley()
        .on("field:validated", function() {
            var ok = $(".parsley-error").length === 0;
            $(".bs-callout-info").toggleClass("hidden", !ok);
            $(".bs-callout-warning").toggleClass("hidden", ok);
        })
        .on("form:submit", function() {
            return true;
        });

    $("#FormRole").submit(function(e) {
        e.preventDefault();
        var form = $("#FormRole");
        var formData = form.serialize();
        var route = form.attr("action");
        $.ajax({
            url: route,
            type: "post",
            data: formData,
            dataType: "json",
            beforeSend: function() {
                loadingUI("Creando rol");
            }
        })
            .done(function(data) {
                console.log(data);
                if (data.success === true) {
                    alertify.success(data.mensaje);
                    $("#role").empty();
                    $("#role").append('<option value=""></option>');

                    $(data.data).each(function(i, role) {
                        $("#role").append(
                            '<option value="' +
                                role.id +
                                '">' +
                                role.name +
                                "</option>"
                        );
                    });
                    $("#role").trigger("chosen:updated");
                } else {
                    alertify.error(data.mensaje);
                }

                $("#modal-role-new").modal("hide");
                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });
});
