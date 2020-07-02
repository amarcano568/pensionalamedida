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
            '<li class="breadcrumb-item active">Gestión de usuarios</li>' +
            "</ol>"
    );

    listarUsuarios();

    function listarUsuarios() {
        destroy_existing_data_table("#tableUsuarios");
        $.fn.dataTable.ext.pager.numbers_length = 4;
        objetoDataTables_Usuarios = $("#tableUsuarios").DataTable({
            order: [[1, "asc"]],
            dom: "lfrtip",
            processing: true,
            serverSide: true,
            responsive: true,
            paginationType: "input",
            sPaginationType: "full_numbers",
            language: {
                buttons: {
                    copyTitle: "Copiado al portapapeles.",
                    copySuccess: {
                        _: "Copiados %d Usuarios.",
                        1: "Copiado 1 Usuario."
                    }
                },
                searchPlaceholder: "Buscar",
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ Usuarios",
                sZeroRecords:
                    "No se encontró ningun Usuario con la Condición del Filtro",
                sEmptyTable: "Ningun Usuario Agregado aún...",
                sInfo: "Del _START_ al _END_ de un total de _TOTAL_ Usuarios",
                sInfoEmpty: "De 0 al 0 de un total de 0 Usuario",
                sInfoFiltered: "(filtrado de un total de _MAX_ Usuarios)",
                sInfoPostFix: "",
                sSearch: "",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: loadingUI(
                    "Cargando listado de Usuarios...",
                    "white"
                ),
                oPaginate: {
                    sFirst: '<i class="fas fa-angle-double-left"></i>',
                    sLast: '<i class="fas fa-angle-double-right"></i>',
                    sNext: '<i class="fas fa-angle-right"></i>',
                    sPrevious: '<i class="fas fa-angle-left"></i>'
                },
                oAria: {
                    sSortAscending:
                        ": Activar para ordenar la columna de manera ascendente",
                    sSortDescending:
                        ": Activar para ordenar la columna de manera descendente"
                }
            },
            lengthMenu: [
                [5, 10, 20, 25, 50, -1],
                [5, 10, 20, 25, 50, "Todos"]
            ],
            iDisplayLength: 10,
            ajax: {
                method: "get",
                url: "/listar-usuarios",
                data: {}
            },
            initComplete: function(settings, json) {
                $.unblockUI();
                $('[data-toggle="popover"]').popover();
            },
            columns: [
                {
                    data: "foto",
                    render: function(data) {
                        return '<img src="img/fotos/' + data + '" height="35">';
                    }
                },
                {
                    data: "name"
                },
                {
                    data: "email"
                },
                {
                    data: "nombre"
                },
                {
                    data: "rol"
                },
                {
                    data: "status",
                    render: function(data) {
                        estadoLabel = "";
                        if (data == 1) {
                            estadoLabel =
                                '<span class="badge badge-success">Activo</span>';
                        } else if (data == 0) {
                            estadoLabel =
                                '<span class="badge badge-warning">Inactivo</span>';
                        }
                        return estadoLabel;
                    }
                },
                {
                    data: "action"
                }
            ],
            columnDefs: [
                {
                    width: "5%",
                    targets: 0
                },
                {
                    width: "20%",
                    targets: 1,
                    orderable: false
                },
                {
                    width: "20%",
                    targets: 2
                },
                {
                    width: "10%",
                    targets: 3
                },
                {
                    width: "10%",
                    targets: 4
                },
                {
                    width: "10%",
                    targets: 5,
                    className: "dt-body-center"
                },
                {
                    width: "5%",
                    targets: 6,
                    className: "dt-body-right"
                }
            ]
        });
    }

    $("body").on("click", "#bodyUsuarios a", function(e) {
        e.preventDefault();

        accion_ok = $(this).attr("data-accion");
        idUser = $(this).attr("idUser");

        switch (accion_ok) {
            case "bloquear-usuario": //Bloquear Usuario.
                $.ajax({
                    url: "bloquear-usuario",
                    type: "get",
                    datatype: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        idUser: idUser
                    },
                    beforeSend: function() {
                        loadingUI("Obteniendo datos del usuario.");
                    }
                })
                    .fail(function(statusCode, errorThrown) {
                        console.log(statusCode + " " + errorThrown);
                    })
                    .done(function(response) {
                        console.log(response.data);
                        if (response.success === true) {
                            alertify.success(response.mensaje);
                        } else {
                            alertify.error(response.mensaje);
                        }
                        objetoDataTables_Usuarios.ajax.reload();
                        $.unblockUI();
                    });
                break;
            case "editar-usuario": // Edita Usuario
                $.ajax({
                    url: "editar-usuario",
                    type: "get",
                    datatype: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        idUser: idUser
                    },
                    beforeSend: function() {
                        loadingUI("Obteniendo datos del usuario.");
                    }
                })
                    .fail(function(statusCode, errorThrown) {
                        console.log(statusCode + " " + errorThrown);
                    })
                    .done(function(response) {
                        console.log(response.data);
                        //$("input").removeClass("parsley-error");
                        $("#FormPerfil")
                            .parsley()
                            .reset();
                        $("#title-modal").html(
                            '<i class="text-success cil-pencil"></i> Editar datos del usuario.'
                        );
                        $("#email").prop("readonly", true);
                        $("#idUser").val(response.data.id);
                        $("#email").val(response.data.email);
                        $("#rol")
                            .val(response.data.rol)
                            .trigger("chosen:updated");
                        $("#nombre").val(response.data.name);
                        $("#telefonoFijo").val(response.data.telefonoFijo);
                        $("#telefonoMovil").val(response.data.telefonoMovil);
                        $("#direccion").val(response.data.direccion);
                        $("#postal-code").val(response.data.cp);
                        $("#pais")
                            .val(response.data.pais_id)
                            .trigger("chosen:updated");

                        $("#linkedin").val(response.data.linkedin);
                        $("#twitter").val(response.data.twitter);
                        $("#facebook").val(response.data.facebook);
                        $("#instagram").val(response.data.instagram);
                        $("#modal-usuario").modal("show");
                        $.unblockUI();
                    });

                break;

            case "eliminarMiembro": // Eliminar Membro
                break;
        }
    });

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
                objetoDataTables_Usuarios.ajax.reload();
                $("#modal-usuario").modal("hide");
                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $(document).on("click", "#BtnNuevo", function(event) {
        event.preventDefault();
        $("#FormPerfil").each(function() {
            this.reset();
        });
        $("#title-modal").html(
            '<i class="fas fa-user-edit"></i> Nuevo Usuario.'
        );
        $("#modal-usuario").modal("show");
        $("#email").prop("readonly", false);
        $("#email").focus();
    });
});
