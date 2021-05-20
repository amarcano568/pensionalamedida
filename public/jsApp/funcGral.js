var server = "";
var pathname = document.location.pathname;

var pathnameArray = pathname.split("/public/");

server = pathnameArray.length > 0 ? pathnameArray[0] + "/" : "";

swChat = false;

// Panel toolbox
$(document).ready(function() {
    $(".collapse-link").on("click", function() {
        var $BOX_PANEL = $(this).closest(".x_panel"),
            $ICON = $(this).find("i"),
            $BOX_CONTENT = $BOX_PANEL.find(".x_content");

        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr("style")) {
            $BOX_CONTENT.slideToggle(200, function() {
                $BOX_PANEL.removeAttr("style");
            });
        } else {
            $BOX_CONTENT.slideToggle(200);
            $BOX_PANEL.css("height", "auto");
        }

        $ICON.toggleClass("fa-chevron-up fa-chevron-down");
    });

    $(".close-link").click(function() {
        var $BOX_PANEL = $(this).closest(".x_panel");

        $BOX_PANEL.remove();
    });
});
// /Panel toolbox

$(".btn-cerrar-modal").click(function(ev) {
    cierraModal();
});

function cierraModal() {
    if ($(".modal-backdrop").is(":visible")) {
        $("body").removeClass("modal-open");
        $(".modal-backdrop").remove();
    }
}

function ponerReadOnly(id) {
    // Ponemos el atributo de solo lectura
    $("#" + id).attr("readonly", "readonly");
    // Ponemos una clase para cambiar el color del texto y mostrar que
    // esta deshabilitado
    $("#" + id).addClass("readOnly");
}

function quitarReadOnly(id) {
    // Eliminamos el atributo de solo lectura
    $("#" + id).removeAttr("readonly");
    // Eliminamos la clase que hace que cambie el color
    $("#" + id).removeClass("readOnly");
}

function dateIso(fecha) {
    return (
        fecha.substr(6, 4) + "-" + fecha.substr(3, 2) + "-" + fecha.substr(0, 2)
    );
}



function deleteFile(fileDelete) {
    setTimeout(function() {
        $.ajax({
            url: "delete-file-pdf",
            type: "get",
            data: {
                fileDelete: fileDelete
            },
            beforeSend: function() {}
        })
            .done(function(data) {
                console.log(data);
            })
            .fail(function(statusCode, errorThrown) {
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }, 5000);
}


function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
}



function calcularEdad(birthday) {
    console.log(birthday);
    var birthday_arr = birthday.split("-");
    var birthday_date = new Date(
        birthday_arr[0],
        birthday_arr[1] - 1,
        birthday_arr[2]
    );
    var ageDifMs = Date.now() - birthday_date.getTime();
    var ageDate = new Date(ageDifMs);
    edad = Math.abs(ageDate.getUTCFullYear() - 1970);

    return edad === NaN ? "" : edad;
}

function loadingUI(message, color) {
    server = server.replace(pathname, "");

    imgServer = "img/bars.svg";
    //console.log(server);
    $.blockUI({
        baseZ: 2000,
        css: {
            border: "none",
            padding: "15px",
            backgroundColor: "#000",
            "-webkit-border-radius": "10px",
            "-moz-border-radius": "10px",
            opacity: 0.5,
            color: "#fff",
            message: message
        },
        message: '<img src="' + imgServer + '"> <span class="hidden-xs"></span>'
    });
}

function responseUI(message, color) {
    $.blockUI({
        baseZ: 2000,
        css: {
            border: "none",
            padding: "15px",
            backgroundColor: color,
            "-webkit-border-radius": "10px",
            "-moz-border-radius": "10px",
            opacity: 0.5,
            color: "#fff"
        },
        message: '<h2 class="blockUIMensaje">' + message + "</h2>"
    });

    setTimeout(function() {
        $.unblockUI();
    }, 2000);
}
// $(".nav-link").click(function(event) {

// })

function destroy_existing_data_table(tableDestry) {
    var existing_table = $(tableDestry).dataTable();
    if (existing_table != undefined) {
        existing_table.fnClearTable();
        existing_table.fnDestroy();
    }
}

function ajaxError(statusCode, errorThrown, tipo = "") {
    if (statusCode.status == 0) {
        alertify.alert(
            "Alerta...",
            '<h4 class="yellow">Internet: Problemas de Conexion</h4>',
            function() {
                alertify.success("Ok");
            }
        );
    } else if (statusCode.status == 422) {
        console.warn(statusCode.responseJSON.errors);
        $(".errorDescripcion").remove();
        $.each(statusCode.responseJSON.errors, function(i, error) {
            var el = $(document).find('[name="' + i + '"]');
            console.log(el);
            el.after(
                $(
                    '<p class="errorDescripcion" style="color: #a94442;background-color: #f2dede;border-color: #ebccd1;padding:1px 20px 1px 20px;">' +
                        error[0] +
                        "</p>"
                )
            );
        });
    } else {
        switch (tipo) {
            case "INPC":
                alertify.alert(
                    "Nivel de Vida...",
                    '<h4 class="text-danger"><i class="text-danger fas fa-exclamation-triangle"></i> INPC</h4><br>' +
                        "Por favor debe ingresar los valores INPC",
                    function() {
                        $("#modal-inpc").modal("show");
                    }
                );

                break;
            default:
                console.log(statusCode);
                console.log(errorThrown);
                alertify.alert(
                    "Alerta...",
                    '<h4 class="text-danger"><i class="text-danger fas fa-exclamation-triangle"></i> Error del Sistema</h4><br>' +
                        statusCode.responseJSON.message,
                    function() {
                        //alertify.success("Ok");
                    }
                );
        }
    }
}

function activaTab(tab, id) {
    $('.nav-tabs a[href="#' + tab + '"]').tab("show");
    $(id).focus();
}


function showStackTopLeft(Title, Text) {
    $(".ui-pnotify").remove();
    PNotify.info({
        title: Title,
        shadow: true,
        text: Text,
        textTrusted: true,
        swipeDismiss: true
    });
}

function changeSwitchery(element, checked) {
    if (
        (element.is(":checked") && checked == false) ||
        (!element.is(":checked") && checked == true)
    ) {
        element
            .parent()
            .find(".switchery")
            .trigger("click");
    }
}

function Pnotifica(title1, text1, type1, hide1) {
    new PNotify({
        title: title1,
        text: text1,
        type: type1,
        hide: hide1,
        addClass: "translucent",
        styling: "bootstrap3"
    });
}

function ConfigChosen() {
    return {
        no_results_text: "No hay resultados para ",
        placeholder_text_single: "Seleccione una Opción",
        disable_search_threshold: 10,
        width: "100%",
        allow_single_deselect: true
    };
}
