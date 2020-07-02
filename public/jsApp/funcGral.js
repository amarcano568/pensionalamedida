swChat = false;

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

function selectedOptionMenu(id, clase, subId = "", navlink = "") {
    if (subId != "") {
        // $(".nav-link").attr('class', 'nav-link');
        $("#" + subId).attr("class", navlink);
    }

    $(".br-menu-link").attr("class", "br-menu-link");
    $("#" + id).attr("class", clase);
}

function existeFecha(fecha) {
    var fechaf = fecha.split("/");
    var day = fechaf[0];
    var month = fechaf[1];
    var year = fechaf[2];
    var date = new Date(year, month, "0");
    if (day - 0 > date.getDate() - 0) {
        return false;
    }
    return true;
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
        message: '<img src="img/bars.svg"> <span class="hidden-xs"></span>'
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

function ajaxError(statusCode, errorThrown) {
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
        console.log(statusCode);
        console.log(errorThrown);
        alertify.alert(
            "Alerta...",
            '<h4 class="text-danger"><i class="text-danger fas fa-exclamation-triangle"></i> Error del Sistema</h4><br>' +
                statusCode.responseJSON.message,
            function() {
                alertify.success("Ok");
            }
        );
    }
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
