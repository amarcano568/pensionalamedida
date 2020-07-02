var idOpcion = 0;
var arreglo = [];
/*****************************************************************************************
								Sub MenÃº Ordenes
*****************************************************************************************/
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- Ordenes",
    icono: "fa-heartbeat"
});
arreglo.push({
    id: "|6000|0001",
    opcion: addId() + ".- Registro de Ordenes",
    icono: "fa-heartbeat"
});
arreglo.push({
    id: "|6000|0002",
    opcion: addId() + ".- Tracking de Ordenes",
    icono: "fa-link"
});
arreglo.push({
    id: "|6000|0003",
    opcion: addId() + ".- Ordenes Domicilio",
    icono: "fa-home"
});
arreglo.push({
    id: "|6000|0004",
    opcion: addId() + ".- Bandeja - AtenciÃ³n",
    icono: "fa-inbox"
});
arreglo.push({
    id: "|6000|6004",
    opcion: addId() + ".- AtenciÃ³n Tomador",
    icono: "fa-user-md"
});
arreglo.push({
    id: "|6000|6003",
    opcion: addId() + ".- Agenda del Tomador",
    icono: "fa-address-book-o"
});
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- Presupuesto",
    icono: "fa-file-text-o"
});
arreglo.push({
    id: "|6999|6001",
    opcion: addId() + ".- Registrar",
    icono: "fa-file-text-o"
});
arreglo.push({
    id: "|6999|6002",
    opcion: addId() + ".- Listado",
    icono: "fa-print"
});
/*****************************************************************************************
								Sub MenÃº Counter
*****************************************************************************************/
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- Counter",
    icono: "fa-headphones"
});
arreglo.push({
    id: "|7000|0014",
    opcion: addId() + ".- Registro-Incidencias",
    icono: "fa-share-alt"
});
arreglo.push({
    id: "|7000|0015",
    opcion: addId() + ".- Resetear ContraseÃ±a",
    icono: "fa-key"
});
/*****************************************************************************************
								Sub MenÃº Paneles
*****************************************************************************************/
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- Paneles",
    icono: "fa-columns"
});
arreglo.push({
    id: "|4000|4001",
    opcion: addId() + ".- Mant. Paneles",
    icono: "fa-columns"
});
arreglo.push({
    id: "|4000|0016",
    opcion: addId() + ".- Mis Pacientes",
    icono: "fa-heartbeat"
});
/*****************************************************************************************
								Sub MenÃº Gerencia
*****************************************************************************************/
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- Gerencia",
    icono: "fa-bookmark-o"
});
arreglo.push({
    id: "|8000|0009",
    opcion: addId() + ".- EstadÃ­stica Ventas",
    icono: "fa-bar-chart"
});
arreglo.push({
    id: "|8000|0017",
    opcion: addId() + ".- ProducciÃ³n ClÃ­nicas & Hospitales",
    icono: "fa-bar-chart"
});
/*****************************************************************************************
								Sub MenÃº HelpDesk
*****************************************************************************************/
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- HelpDesk",
    icono: "fa-life-ring"
});
arreglo.push({
    id: "|3000|0005",
    opcion: addId() + ".- Registro de Ticket",
    icono: "fa-ticket"
});
arreglo.push({
    id: "|3000|0007",
    opcion: addId() + ".- Ticket Externo",
    icono: "fa-ticket"
});
arreglo.push({
    id: "|3000|0008",
    opcion: addId() + ".- Incidencias de Laboratorio",
    icono: "fa-ticket"
});
arreglo.push({
    id: "|3000|0006",
    opcion: addId() + ".- EstadÃ­stica HelpDesk",
    icono: "fa-line-chart"
});
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- ConfiguraciÃ³n HelpDesk",
    icono: "fa-life-ring"
});
arreglo.push({
    id: "|3000|3005",
    opcion: addId() + ".- Mant. Tipo Tickect",
    icono: "fa-cogs"
});
arreglo.push({
    id: "|3000|3001",
    opcion: addId() + ".- CategorÃ­a / SubCategorÃ­a",
    icono: "fa-cog"
});
arreglo.push({
    id: "|3000|3002",
    opcion: addId() + ".- Ãrea / Sub Ãrea",
    icono: "fa-cog"
});
arreglo.push({
    id: "|3000|3003",
    opcion: addId() + ".- Cargo",
    icono: "fa-cog"
});
arreglo.push({
    id: "|3000|3004",
    opcion: addId() + ".- Local",
    icono: "fa-cog"
});
/*****************************************************************************************
								Sub MenÃº Seguridad
*****************************************************************************************/
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- Seguridad",
    icono: "fa-user"
});
arreglo.push({
    id: "|2000|2001",
    opcion: addId() + ".- AdministraciÃ³n de Perfiles",
    icono: "fa-user"
});
arreglo.push({
    id: "|2000|2002",
    opcion: addId() + ".- AdministraciÃ³n de Usuarios",
    icono: "fa-user"
});
arreglo.push({
    id: "|2000|2003",
    opcion: addId() + ".- AdministraciÃ³n de Grupos",
    icono: "fa-user"
});
/*****************************************************************************************
								Sub MenÃº Tails (Cola)
*****************************************************************************************/
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- Cola",
    icono: "fa-list-ol"
});
arreglo.push({
    id: "|9000|0010",
    opcion: addId() + ".- AtenciÃ³n",
    icono: "fa-bullhorn"
});
arreglo.push({
    id: "|9000|0011",
    opcion: addId() + ".- Espera",
    icono: "fa-desktop"
});
arreglo.push({
    id: "|9000|0012",
    opcion: addId() + ".- Reportes",
    icono: "fa-file-pdf-o"
});
arreglo.push({
    id: "|9000|0013",
    opcion: addId() + ".- Tomar turno",
    icono: "fa-hand-paper-o"
});
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- ConfiguraciÃ³n de Cola",
    icono: "fa-cogs"
});
arreglo.push({
    id: "|5000|5001",
    opcion: addId() + ".- Locales",
    icono: "fa-cog"
});
arreglo.push({
    id: "|5000|5002",
    opcion: addId() + ".- UbicaciÃ³n",
    icono: "fa-cog"
});
arreglo.push({
    id: "|5000|5003",
    opcion: addId() + ".- Operaciones",
    icono: "fa-cog"
});
arreglo.push({
    id: "|5000|5004",
    opcion: addId() + ".- Modulos",
    icono: "fa-cog"
});
arreglo.push({
    id: "|5000|5005",
    opcion: addId() + ".- Operaciones Local",
    icono: "fa-cog"
});
/*****************************************************************************************
								Sub MenÃº Resultados
*****************************************************************************************/
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- Resultados",
    icono: "fa-flask"
});
arreglo.push({
    id: "|10000|10001",
    opcion: addId() + ".- Mantenimiento de Firmas",
    icono: "fa-pencil"
});
arreglo.push({
    id: "|10000|10002",
    opcion: addId() + ".- Mantenimiento de Encabezados y Pies de Paginas",
    icono: "fa-picture-o"
});
arreglo.push({
    id: "|10000|10003",
    opcion: addId() + ".- Mantenimiento de Pruebas Certificadas",
    icono: "fa-check"
});
/*****************************************************************************************
								Sub MenÃº Laboratorio
*****************************************************************************************/
arreglo.push({
    id: "subMenu",
    opcion: addId() + ".- Laboratorio",
    icono: "fa-flask"
});
arreglo.push({
    id: "|11000|11001",
    opcion: addId() + ".- Alerta - Pruebas En Proceso Por UbicaciÃ³n",
    icono: "fa-pencil"
});
arreglo.push({
    id: "|11000|11002",
    opcion: addId() + ".- Solicitudes Pendientes Rangos Critico",
    icono: "fa-exclamation-triangle"
});
arreglo.push({
    id: "|11000|11003",
    opcion: addId() + ".- Solicitudes Historicas de Rangos Critico",
    icono: "fa-exclamation-triangle"
});
arreglo.push({
    id: "|11000|11004",
    opcion: addId() + ".- Gestor de Incidencias",
    icono: "fa-exclamation-triangle"
});

function addId() {
    idOpcion = parseInt(idOpcion) + 1;
    return pad(idOpcion, 2);
}

function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
}

console.log(arreglo);

$('[data-toggle="tooltip"]').tooltip();

MuestraPerfiles();

function MuestraPerfiles() {
    $("#DivAminPerfiles").load(
        "FuncGral.php",
        {
            Tipo: "CargaPerfiles",
            Parametro1: "",
            Parametro2: "",
            Parametro3: ""
        },

        function(response, status, xhr) {
            if (status == "error") {
                var msg = "Error!, algo ha sucedido: ";
                $("#DivAminPerfiles").html(
                    msg + xhr.status + " " + xhr.statusText
                );
            } else if (status == "success") {
                var filas = $("#listaPerfilesWebOK").find("tr");
                var celdas = $(filas[0]).find("td");
                idOpcion = $(celdas[0])
                    .text()
                    .trim();
                Nombre = $(celdas[1])
                    .text()
                    .trim();
                opcionesPerfil = buscarOpcionesPerfil(idOpcion);
                // muestraOpciones(idOpcion,opcionesPerfil);
                $("#idPerfil").val(idOpcion);
                $("#NombrePerfil").text(Nombre);
            }
        }
    );
}

function muestraOpciones(idOpcion, opcionesPerfil) {
    olOpcionesMenu = '<ol class="olMenu asc" id="OpcionesMenu">';
    olOpcionesSele = '<ol class="olSele" id="OpcionesSeleccionable">';

    arreglo.forEach(function(opcionMenu, index) {
        idBuscar = opcionMenu.id;

        icono = '<i class="ace-icon fa ' + opcionMenu.icono + '" ></i>';
        opcionMenu.icono;
        estilo = "text-align:left;";
        if (opcionesPerfil.indexOf(idBuscar) > -1) {
            olOpcionesSele +=
                '<li style="' +
                estilo +
                '">' +
                icono +
                " " +
                opcionMenu.opcion +
                "</li>";
        } else {
            if (idBuscar == "subMenu") {
                estilo =
                    "pointer-events:none;opacity:0.6;color: blue;font-size:18px;text-align:left;";
            }
            olOpcionesMenu +=
                '<li style="' +
                estilo +
                '">' +
                icono +
                " " +
                opcionMenu.opcion +
                "</li>";
        }
    });

    olOpcionesMenu += "</ol>";
    olOpcionesSele += "</ol>";
    $("#DivOpcionesdelMenu").html(olOpcionesMenu);
    $("#DivOpcionesSeleccionables").html(olOpcionesSele);

    $("#OpcionesMenu").sortable({
        connectWith: "#OpcionesSeleccionable",
        receive: function(e, ui) {
            ordenarLista();
        }
    });

    $("#OpcionesSeleccionable").sortable();
    $("#OpcionesSeleccionable").sortable(
        "option",
        "connectWith",
        "#OpcionesMenu"
    );

    //document.getElementById('DivOpcionesdelMenu').addEventListener("DOMSubtreeModified", handler, true);
}

function handler() {
    ordenarLista();
}

$(document).on("click", "#OpcionesMenu li", function() {
    $(this).appendTo("#OpcionesSeleccionable");
});

$(document).on("click", "#OpcionesSeleccionable li", function() {
    $(this).appendTo("#OpcionesMenu");
    ordenarLista();
});

function ordenarLista() {
    $("ol.asc li")
        .sort(sort_ascending)
        .appendTo("ol.asc");
}

function sort_ascending(a, b) {
    return $(b).text() < $(a).text() ? 1 : -1;
}

/* Pasar todas las opciones del menu */
$("#PasarTodas").click(function() {
    $("#OpcionesMenu li").each(function() {
        opcionMenu = $(this)
            .text()
            .trim();
        if (
            "01.- Ordenes|10.- Counter|13.- Paneles|16.- Gerencia|19.- HelpDesk|30.- Seguridad|34.- Cola|45.- Resultados|49.- Laboratorio|07.- Presupuesto|24.- ConfiguraciÃ³n HelpDesk|39.- ConfiguraciÃ³n de Cola".indexOf(
                opcionMenu
            ) > -1
        ) {
            // Son Las Etiquetas del SubMenu.
        } else {
            $(this).appendTo("#OpcionesSeleccionable");
        }
    });
});

/* Remover todas las opciones del menu */
$("#RemoverTodas").click(function() {
    $("#OpcionesSeleccionable li").each(function() {
        $(this).appendTo("#OpcionesMenu");
    });
    ordenarLista();
});

// botÃ³n Agregar Perfiles.
$("#BtnAgregarPerfil").click(function() {
    $("#ModalAgregarPerfil").modal("show");
    $("#ModalAgregarPerfil").on("shown.bs.modal", function() {
        $(addId() + ".chosen-select", this)
            .chosen("destroy")
            .chosen();
    });

    $("#TitleModal").text("Agregar Perfil del Sistema..!");
    $("#StatusPerfil").hide();
    $("#DivIdPerfil").hide();
    $("#InputDescripcionPerfil").val("");
    $(".chosen-select")
        .val("")
        .trigger("chosen:updated");
});

// botÃ³n Guardar Opciones del Menu.
$("#btnGuardarOpcionesMenu").click(function(e) {
    e.preventDefault();

    alertify
        .confirm(
            "Opciones del menÃº para este Perfil.",
            '<h5 class="blue">Esta Seguro de guardar estos datos ?',
            function() {
                var arregloOpciones = [];
                $("#OpcionesSeleccionable li").each(function() {
                    opcionMenu = $(this).text();
                    //alert(opcionMenu)
                    opciones = opcionMenu.split(".- ");
                    nombreOpcion = opciones[1].trim();
                    arregloOpciones.push({
                        nombreOpcion: nombreOpcion
                    });
                });
                console.log(arregloOpciones);

                var arregloOpcionesAux = JSON.stringify(arregloOpciones);
                var arregloAux = JSON.stringify(arreglo);

                idPerfil = $("#idPerfil").val();

                $.ajax({
                    url: "FuncGral.php",
                    type: "post",
                    dataType: "text",
                    data: {
                        Tipo: "guardarPerfilOpciones",
                        Parametro1: arregloAux,
                        Parametro2: arregloOpcionesAux,
                        Parametro3: idPerfil
                    },

                    success: function(data) {
                        if (data == 1) {
                            MensajeGritter(
                                "Opciones del perfil.",
                                "Los datos se guardaron correctamente.",
                                "gritter-success"
                            );
                        } else if (data[0] == 0) {
                            MensajeGritter(
                                "Error",
                                "Hubo un error guardando los datos",
                                "gritter-error"
                            );
                        }
                    },
                    error: function(data) {
                        MensajeGritter(
                            "Error",
                            "SucediÃ³ un Error Inesperado",
                            "gritter-error"
                        );
                    }
                }).done(function(res) {
                    //$("#mensaje").html("Respuesta del Host: " + res);
                });
            },
            function() {
                // En caso de Cancelar
                alertify.error(
                    "Se Cancelo el proceso de guardar las opciones del menÃº."
                );
            }
        )
        .set("labels", {
            ok: "Confirmar",
            cancel: "Cancelar"
        })
        .set({
            transition: "zoom"
        });
});

/*
         Eventos Click sobre la Table <grilla> de Perfiles.
    */
$("body").on("click", "#listaPerfilesWebOK a", function(e) {
    e.preventDefault();

    accion_ok = $(this).attr("data-accion");
    Id = $(this)
        .parents("tr")
        .find("td")[0].innerHTML;
    Nombre = $(this).attr("nomPerfil");

    $("#idPerfil").val(Id);

    Descripcion = $(this)
        .parents("tr")
        .find("td")[4]
        .innerHTML.trim();
    Status = $(this)
        .parents("tr")
        .find("td")[5].innerHTML;
    idOpcion = $(this).attr("idOpcion");

    if (accion_ok == "EditarPerfil") {
        // Ver Editar Perfil

        $("#ModalAgregarPerfil").modal("show");

        $("#TitleModal").text("Actualizar Perfil del Sistema..!");
        $("#IdPerfil").val(Id);
        $("#InputNombrePerfil").val(Nombre);
        $("#InputDescripcionPerfil").val(Descripcion);
        $("#SelectStatus")
            .val(Status)
            .change();
    } else if ("bloquear | activar".indexOf(accion_ok) > -1) {
        // Bloquea Activa o Desactiva Perfil

        var Selector = "#" + Id;
        $(Selector).show();
        $.ajax({
            // EnvÃ­o por Ajax para Activar o Desactivar el Perfil
            url: "FuncGral.php",
            type: "post",
            dataType: "text",
            data: {
                Tipo: "ActivaDesactivaPerfil",
                Parametro1: accion_ok,
                Parametro2: Id,
                Parametro3: ""
            },
            success: function(data) {
                //alert(data)
                if (data == 1) {
                    // La opciÃ³n se ejcuto con Exito
                    if (accion_ok == "activar") {
                        $StatusNombre = "El Perfil se Activo Exitosamente";
                    } else {
                        $StatusNombre = "El Perfil se Desactivo Exitosamente";
                    }
                    alertify.success($StatusNombre);
                    MuestraPerfiles();
                } else {
                    // No se pudo Ejecutar la Accion
                    alertify.error(
                        "Sucedio un Problema intentando Actualizar el Status del Perfil"
                    );
                }
                $(Selector).hide();
            },
            error: function(data) {
                MensajeGritter(
                    "Error",
                    "SucediÃ³ un Error Inesperado",
                    "gritter-error"
                );
            }
        });
    } else if (accion_ok == "cargaPerfil") {
        $("#OpcionesMenu").remove();
        $("#OpcionesSeleccionable").remove();
        $("#DivOpcionesdelMenu").html(
            '<img src="img/espera.gif" class="editable img-responsive imgcenter" width="75" height="75" id="espera_datos" />'
        );
        $("#DivOpcionesSeleccionables").html(
            '<img src="img/espera.gif" class="editable img-responsive imgcenter" width="75" height="75" id="espera_datos" />'
        );
        opcionesPerfil = buscarOpcionesPerfil(Id);
        $("#NombrePerfil").text(Nombre);

        // $("#OpcionesSeleccionable").draggable();

        // $("#OpcionesMenu").droppable({
        //     accept: ".draggable",
        //     activeClass: 'droppable-active',
        //     hoverClass: 'droppable-hover',
        //     drop: function(evento, ui) {
        //         $(this).html("Lo soltaste!!!");
        //     }
        // });
    }
});

function buscarOpcionesPerfil(Id) {
    $.ajax({
        url: "FuncGral.php",
        type: "post",
        dataType: "text",
        data: {
            Tipo: "buscarOpcionesPerfil",
            Parametro1: Id,
            Parametro2: "",
            Parametro3: ""
        },
        success: function(data) {
            muestraOpciones(Id, data);
        },
        error: function(data) {
            MensajeGritter(
                "Error",
                "SucediÃ³ un Error Inesperado",
                "gritter-error"
            );
        }
    }).done(function(res) {
        //$("#mensaje").html("Respuesta del Host: " + res);
    });
}

$(document).ready(function() {
    $.validator.setDefaults({
        ignore: ":hidden:not(.chosen-select)"
    });

    $("#ModalPerfiles").validate({
        errorElement: "div",
        errorClass: "help-block",
        focusInvalid: false,
        rules: {
            InputNombrePerfil: {
                required: true,
                minlength: 2
            },
            InputDescripcionPerfil: {
                required: true,
                minlength: 4
            },
            OpcionesChosen: {
                required: true
            }
        },
        messages: {
            InputNombrePerfil: "Debe introducir el Nombre del Perfil.",
            InputDescripcionPerfil:
                "Debe introducir DescripciÃ³n para el Perfil.",
            OpcionesChosen: "Debe seleccionar al Menos una OpciÃ³n."
        },
        invalidHandler: function(event, validator) {
            //display error alert on form submit
            $(addId() + ".alert-danger", $(addId() + ".login-form")).show();
        },
        highlight: function(e) {
            $(e)
                .closest(addId() + ".form-group")
                .removeClass("has-info")
                .addClass("has-error");
        },
        success: function(e) {
            $(e)
                .closest(addId() + ".form-group")
                .removeClass("has-error")
                .addClass("has-info");
            $(e).remove();
        },
        errorPlacement: function(error, element) {
            if (element.is(":checkbox") || element.is(":radio")) {
                var controls = element.closest('div[class*="col-"]');
                if (controls.find(":checkbox,:radio").length > 1)
                    controls.append(error);
                else
                    error.insertAfter(
                        element.nextAll(addId() + ".lbl:eq(0)").eq(0)
                    );
            } else if (element.is(addId() + ".select2")) {
                error.insertAfter(
                    element.siblings('[class*="select2-container"]:eq(0)')
                );
            } else if (element.is(addId() + ".chosen-select")) {
                error.insertAfter(
                    element.siblings('[class*="chosen-container"]:eq(0)')
                );
            } else error.insertAfter(element.parent());
        },
        submitHandler: function(form) {
            var accionAux = $("#TitleModal").text();
            accionAux = accionAux.split(" ");
            var accion = accionAux[0];
            Id = $("#IdPerfil").val();
            Nombre = $("#InputNombrePerfil").val();
            Descripcion = $("#InputDescripcionPerfil").val();
            Status = $("#SelectStatus").val();
            $.ajax({
                url: "FuncGral.php",
                type: "post",
                dataType: "text",
                data: {
                    Tipo: accion,
                    Parametro1: Id,
                    Parametro2: Nombre + "|" + Descripcion,
                    Parametro3: Status
                },
                success: function(data) {
                    //alert(data)
                    if (data == 1) {
                        MensajeGritter(
                            "Registro Agregado",
                            "El Perfil se Agrego Exitosamente",
                            "gritter-success"
                        );
                        MuestraPerfiles();
                    } else if (data == 2) {
                        MensajeGritter(
                            "Registro Actualizado",
                            "El Perfil se Actualizo de Forma Correcta!",
                            "gritter-success"
                        );
                        MuestraPerfiles();
                    } else if (data == 0) {
                        MensajeGritter(
                            "Error",
                            "SucediÃ³ un Error tratando de Agregar/Actualizar el Perfil!",
                            "gritter-error"
                        );
                    }
                },
                error: function(data) {
                    MensajeGritter(
                        "Error",
                        "SucediÃ³ un Error Inesperado",
                        "gritter-error"
                    );
                }
            }).done(function(res) {
                //$("#mensaje").html("Respuesta del Host: " + res);
            });

            $("#ModalAgregarPerfil").modal("hide");
            $("#ModalPerfiles").each(function() {
                this.reset();
            });
        }
    });
});
