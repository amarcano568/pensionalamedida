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
    if ($(".modal-backdrop").is(":visible")) {
        $("body").removeClass("modal-open");
        $(".modal-backdrop").remove();
    }
});

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

// function changeChosenEdadPensionHojaEdit(hoja) {
//     edadJubilacion = $("#hoja-" + hoja + "-edad-estrategia-1").val();
//     mes = parseInt(edadJubilacion.substr(9, 2));
//     ano = parseInt(edadJubilacion.substr(0, 2));
//     edadPension1 = mes >= 6 ? ano + 1 : ano;
//     edadPension1 = edadPension1 > 65 ? 65 : edadPension1;

//     edadJubilacion = $("#hoja-" + hoja + "-edad-estrategia-2").val();
//     mes = parseInt(edadJubilacion.substr(9, 2));
//     ano = parseInt(edadJubilacion.substr(0, 2));
//     edadPension2 = mes >= 6 ? ano + 1 : ano;
//     edadPension2 = edadPension2 > 65 ? 65 : edadPension2;

//     edadJubilacion = $("#hoja-" + hoja + "-edad-estrategia-3").val();
//     mes = parseInt(edadJubilacion.substr(9, 2));
//     ano = parseInt(edadJubilacion.substr(0, 2));
//     edadPension3 = mes >= 6 ? ano + 1 : ano;
//     edadPension3 = edadPension3 > 65 ? 65 : edadPension3;

//     edadJubilacion = $("#hoja-" + hoja + "-edad-estrategia-4").val();
//     mes = parseInt(edadJubilacion.substr(9, 2));
//     ano = parseInt(edadJubilacion.substr(0, 2));
//     edadPension4 = mes >= 6 ? ano + 1 : ano;
//     edadPension4 = edadPension4 > 65 ? 65 : edadPension4;

//     edadJubilacion = $("#hoja-" + hoja + "-edad-estrategia-5").val();
//     mes = parseInt(edadJubilacion.substr(9, 2));
//     ano = parseInt(edadJubilacion.substr(0, 2));
//     edadPension5 = mes >= 6 ? ano + 1 : ano;
//     edadPension5 = edadPension5 > 65 ? 65 : edadPension5;

//     edadJubilacion = $("#hoja-" + hoja + "-edad-estrategia-6").val();
//     mes = parseInt(edadJubilacion.substr(9, 2));
//     ano = parseInt(edadJubilacion.substr(0, 2));
//     edadPension6 = mes >= 6 ? ano + 1 : ano;
//     edadPension6 = edadPension6 > 65 ? 65 : edadPension2;

//     $("#hoja-" + hoja + "-edad-calculo-pension").empty();

//     $("#hoja-" + hoja + "-edad-calculo-pension").append(
//         '<option value="' +
//             edadPension1 +
//             '">' +
//             edadPension1 +
//             " años - Empresa actual</option>"
//     );
//     $("#hoja-" + hoja + "-edad-calculo-pension").append(
//         '<option value="' +
//             edadPension2 +
//             '">' +
//             edadPension2 +
//             " años - Cooperativa</option>"
//     );
//     $("#hoja-" + hoja + "-edad-calculo-pension").append(
//         '<option value="' +
//             edadPension3 +
//             '">' +
//             edadPension3 +
//             " años - M40 Retroactivo</option>"
//     );
//     $("#hoja-" + hoja + "-edad-calculo-pension").append(
//         '<option value="' +
//             edadPension4 +
//             '">' +
//             edadPension4 +
//             " años - M40 Ya Pagada</option>"
//     );
//     $("#hoja-" + hoja + "-edad-calculo-pension").append(
//         '<option value="' +
//             edadPension5 +
//             '">' +
//             edadPension5 +
//             " años - M40 Barata</option>"
//     );
//     $("#hoja-" + hoja + "-edad-calculo-pension").append(
//         '<option value="' +
//             edadPension6 +
//             '">' +
//             edadPension6 +
//             " años - M40 Salario Alto</option>"
//     );
//     $("#hoja-" + hoja + "-edad-calculo-pension").trigger("chosen:updated");
// }

function convertNumberPure(data) {
    // post = data.indexOf(",", 0);
    //alert(post);
    data = data.replace(/\,/g, "");
    //data = data.replace(".", ",");
    return parseFloat(data);
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

function selectedOptionMenu(id, clase, subId = "", navlink = "") {
    if (subId != "") {
        // $(".nav-link").attr('class', 'nav-link');
        $("#" + subId).attr("class", navlink);
    }

    $(".br-menu-link").attr("class", "br-menu-link");
    $("#" + id).attr("class", clase);
}

function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
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
    server = server.replace(pathname, "");

    imgServer = server + "img/bars.svg";
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

//Función para validar una CURP
function curpValida(curp) {
    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        validado = curp.match(re);

    if (!validado)
        //Coincide con el formato general?
        return false;

    //Validar que coincida el dígito verificador
    function digitoVerificador(curp17) {
        //Fuente https://consultas.curp.gob.mx/CurpSP/
        var diccionario = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
            lngSuma = 0.0,
            lngDigito = 0.0;
        for (var i = 0; i < 17; i++)
            lngSuma =
                lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        lngDigito = 10 - (lngSuma % 10);
        if (lngDigito == 10) return 0;
        return lngDigito;
    }

    if (validado[2] != digitoVerificador(validado[1])) return false;

    return true; //Validado
}
//Handler para el evento cuando cambia el input
//Lleva la CURP a mayúsculas para validarlo
function validarInput(input) {
    var curp = input.value.toUpperCase(),
        resultado = document.getElementById("resultado"),
        valido = "No válido";

    if (curpValida(curp)) {
        // ⬅️ Acá se comprueba
        valido = "Válido";
        resultado.classList.add("ok");
    } else {
        resultado.classList.remove("ok");
    }

    resultado.innerText = "Formato: " + valido;
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

function calculaFormulasExcel(
    semanasCotizadas,
    salarioDiarioPromedio,
    edadJubilacion,
    muestraModal
) {
    valida = $("#formPaso1")
        .parsley()
        .validate();
    if (valida === false) {
        return false;
    }
    promedioSalario = $("#promedio-salarios").text();
    edadDe = $("#edadDe").val();
    totalSemanas = $("#totalSemanas").val();

    if (muestraModal) {
        $("#modal-formulas").modal("show");
    }

    $("#formulas-semana-cotizadas").val(totalSemanas);
    $("#formulas-salario-diario-promedio").val(promedioSalario);
    $("#formulas-edad-jubilacion").val(edadDe);
    $("#formulas-esposa").val($("#esposa").val());
    $("#formulas-hijos-menores").val($("#hijos").val());
    $("#formulas-padres").val($("#padres").val());

    //salarioDiarioPromedio = $("#formulas-salario-diario-promedio").val();
    salarioMinimoDf = $("#formulas-salario-minimo-df").val();
    salarioPromedioVsm = salarioDiarioPromedio / salarioMinimoDf;
    $("#formulas-salario-promedio-vsm").val(salarioPromedioVsm.toFixed(2));

    $("#cuantia-basica-salario-promedio").val(salarioDiarioPromedio);

    $("#incremento-anual-cuantia-basica-salario-promedio").val(
        salarioDiarioPromedio
    );

    $("#anos-ant-semanas-cotizadas").val($("#formulas-semana-cotizadas").val());
    $("#anos-ant-500-semanas").val(500);
    $("#anos-ant-semanas-reconocidas").val(
        parseInt($("#formulas-semana-cotizadas").val()) - 500
    );

    anosCompletos = Math.trunc($("#anos-ant-semanas-reconocidas").val() / 52);
    $("#anos-ant-anos-completos").val(anosCompletos);

    totalPost00 = $("#anos-ant-anos-completos").val() * 52;
    $("#anos-ant-semanas-completas-posteriores-500").val(totalPost00);

    $("#anos-ant-sem-reconocidas-post-500").val(
        parseInt($("#formulas-semana-cotizadas").val()) - 500
    );

    $("#anos-ant-sem-completas-post-500").val(totalPost00);

    semanasResiduos =
        $("#anos-ant-sem-reconocidas-post-500").val() -
        $("#anos-ant-sem-completas-post-500").val();
    $("#anos-ant-semanas-residuo").val(semanasResiduos);

    if (semanasResiduos >= 0 && semanasResiduos <= 12.99) {
        incrAnual = 0;
    } else if (semanasResiduos >= 13 && semanasResiduos <= 26) {
        incrAnual = 0.5;
    } else if (semanasResiduos > 26) {
        incrAnual = 1.0;
    }

    $("#anos-ant-ano-residuo").val(incrAnual);

    $("#anos-ant-comp-reconocdos-post-500").val(
        $("#anos-ant-anos-completos").val()
    );

    $("#anos-ant-mas-anos-residuo").val(incrAnual);

    totAnosReconocidos =
        parseInt($("#anos-ant-comp-reconocdos-post-500").val()) +
        parseInt($("#anos-ant-mas-anos-residuo").val());
    $("#anos-ant-tot-anos-reconocidos-post-500").val(totAnosReconocidos);
    $("#total-anos-reconocidos").val(totAnosReconocidos);
    // Buscar cuantía basica en tablas formulas-salario-promedio-vsm
    cuantiaBasica($("#formulas-salario-promedio-vsm").val(), edadJubilacion);
}

function cuantiaBasica(salarioPromedioVsm, edadJubilacion) {
    $.ajax({
        url: "/buscar-cuantia-basica",
        type: "get",
        data: { salarioPromedioVsm: salarioPromedioVsm },
        dataType: "json"
    })
        .done(function(response) {
            // console.log();
            $("#cuantia-basica-valor").val(response.data.cuantia_basica);
            $("#incremento-anual-cuantia-basica-valor").val(
                response.data.incremento_anual
            );

            cuantiaBasicaSalarioPromedio = $(
                "#cuantia-basica-salario-promedio"
            ).val();
            cuantiaBasicaValor = $("#cuantia-basica-valor").val();
            cuantiaBasicaDiaria =
                parseFloat(cuantiaBasicaSalarioPromedio) *
                parseFloat(cuantiaBasicaValor / 100);
            $("#cuantia-basica-diaria").val(cuantiaBasicaDiaria.toFixed(2));

            cuantiaBasicaDiaria = parseFloat($("#cuantia-basica-diaria").val());
            cuantiaBasicaX365 = parseFloat($("#cuantia-basica-x-365").val());
            cuantiaBasicaAnual = cuantiaBasicaDiaria * cuantiaBasicaX365;
            $("#cuantia-basica-anual").val(cuantiaBasicaAnual.toFixed(2));
            cuantiaBasicaMensual = cuantiaBasicaAnual / 12;
            $("#cuantia-basica-mensual").val(cuantiaBasicaMensual.toFixed(2));

            anualCuantiaBasicaSalarioPromedio = $(
                "#incremento-anual-cuantia-basica-salario-promedio"
            ).val();
            anualCuantiaBasicaValor = $(
                "#incremento-anual-cuantia-basica-valor"
            ).val();

            incrementoAnualCuantiaBasicaDiaria =
                anualCuantiaBasicaSalarioPromedio *
                (anualCuantiaBasicaValor / 100);
            $("#incremento-anual-cuantia-basica-diaria").val(
                incrementoAnualCuantiaBasicaDiaria.toFixed(2)
            );

            incrementoAnual = incrementoAnualCuantiaBasicaDiaria * 365;
            $("#incremento-anual-previo").val(incrementoAnual.toFixed(2));

            incrementoAnualPrevio = $("#incremento-anual-previo").val();
            totalAnosReconocidos = $("#total-anos-reconocidos").val();
            total3 = incrementoAnualPrevio * totalAnosReconocidos;
            $("#incremento-anual-a-la-cuantia-basica").val(total3);
            total4 = total3 / 12;
            $("#incremento-mensual-cuantia-basica").val(total4.toFixed(2));

            $("#cuanta-anual-pension-basica").val(
                $("#cuantia-basica-anual").val()
            );

            $("#cuanta-anual-pension-incremento").val(
                $("#incremento-anual-a-la-cuantia-basica").val()
            );

            total5 = parseFloat($("#cuanta-anual-pension-incremento").val());
            total6 = parseFloat($("#cuanta-anual-pension-basica").val());
            total7 = total5 + total6;
            $("#cuanta-anual-pension-igual").val(total7.toFixed(2));
            total8 = total7 / 12;
            $("#cuanta-anual-pension-igual-mensual").val(total8.toFixed(2));

            // Ayuda Esposa
            $("#asig-esposa-cuantia-anual-pension").val(total7.toFixed(2));
            montoEsposa = $("#esposa").val() == "No" ? 0 : total7 * (15 / 100);
            $("#asig-esposa-asignacion-viuda").val(montoEsposa.toFixed(2));
            $("#asig-esposa-mensual").val((montoEsposa / 12).toFixed(2));

            // Ayuda Hijos
            $("#ayuda-hijos-cuantia-anual-pension").val(total7.toFixed(2));
            hijos = $("#hijos").val();
            $("#ayuda-hijos-nro-hijos").val(hijos);
            total9 = total7 * (10 / 100) * hijos;
            $("#ayuda-hijos-ayuda-anual").val(total9.toFixed(2));
            $("#ayuda-hijos-mensual").val((total9 / 12).toFixed(2));

            // Ayuda Padres
            $("#ayuda-padres-anual-pesion").val(total7.toFixed(2));
            padres = $("#padres").val();
            $("#ayuda-padres-nro-padres").val(padres);

            if ($("#esposa").val() == "Si" || hijos > 0) {
                total10 = 0;
            } else {
                total10 = total7 * (20 / 100) * padres;
            }
            $("#ayuda-padres-ayuda-anual").val(total10.toFixed(2));
            $("#ayuda-padres-anual").val((total10 / 12).toFixed(2));

            // Ayuda por Soledad
            $("#ayuda-soledad-anual-pension").val(total7.toFixed(2));
            montosoledad =
                $("#esposa").val() == "No" && hijos == 0 && padres == 0
                    ? total7 * (15 / 100)
                    : 0;
            $("#ayuda-soledad-anual").val(montosoledad.toFixed(2));
            $("#ayuda-soledad-mensual").val((montosoledad / 12).toFixed(2));

            // Total ayudas
            totalAyudas = montoEsposa + total9 + total10 + montosoledad;
            $("#total-ayudas").val(totalAyudas.toFixed(2));
            $("#total-ayudas-mensual").val((totalAyudas / 12).toFixed(2));
            $("#total-ayuda-cuantia-anual").val(total7.toFixed(2));
            $("#total-ayuda-cuantia-anual-mas-ayuda").val(
                (totalAyudas + total7).toFixed(2)
            );
            $("#total-ayuda-cuantia-anual-ayuda-mensual").val(
                ((totalAyudas + total7) / 12).toFixed(2)
            );

            $("#cuantia-anual-pension-mas-ayudas").val(
                (totalAyudas + total7).toFixed(2)
            );
            $("#cuantia-anual-pension-mas-ayudas-mensual").val(
                ((totalAyudas + total7) / 12).toFixed(2)
            );
            $("#igual-pension-anual-x-vejez").val(
                ((totalAyudas + total7) * (111 / 100)).toFixed(2)
            );
            $("#igual-pension-anual-x-vejez-mensual").val(
                (((totalAyudas + total7) * (111 / 100)) / 12).toFixed(2)
            );

            switch (edadJubilacion) {
                case "60":
                    $porc = 75;
                    break;
                case "61":
                    $porc = 80;
                    break;
                case "62":
                    $porc = 85;
                    break;
                case "63":
                    $porc = 90;
                    break;
                case "64":
                    $porc = 95;
                    break;
                case "65":
                    $porc = 100;
                    break;
                // default:
                //     $porc = 100;
            }
            $("#porc-pension-por-edad").val($porc);
            // alert($porc);
            pensionAnualVejez = (totalAyudas + total7) * (111 / 100);
            $("#pension-anual-x-vejez-fin").val(pensionAnualVejez.toFixed(2));

            $("#pension-anual-x-cesantia").val(
                (pensionAnualVejez * ($porc / 100)).toFixed(2)
            );

            $("#pension-anual-x-cesantia-mensual").val(
                ((pensionAnualVejez * ($porc / 100)) / 12).toFixed(2)
            );

            $("#pension-anual-fin").text(
                $.number(pensionAnualVejez * ($porc / 100), 2, ".", ",")
            );

            $("#pension-mensual-fin").text(
                $.number((pensionAnualVejez * ($porc / 100)) / 12, 2, ".", ",")
            );
        })
        .fail(function(statusCode, errorThrown) {
            $.unblockUI();
            console.log(errorThrown);
            ajaxError(statusCode, errorThrown);
        });
}

function calculaFormulasExcelHojas(
    semanasCotizadas,
    salarioDiarioPromedio,
    edadPension,
    muestraModal,
    hoja
) {
    if (muestraModal) {
        $("#modal-formulas").modal("show");
    }
    if (isNaN(semanasCotizadas)) {
        semanasCotizadas = 0;
    }

    $("#formulas-semana-cotizadas").val(semanasCotizadas);
    $("#formulas-salario-diario-promedio").val(salarioDiarioPromedio);
    $("#formulas-esposa").val($("#esposa").val());
    $("#formulas-hijos-menores").val($("#hijos").val());
    $("#formulas-padres").val($("#padres").val());
    $("#formulas-edad-jubilacion").val(edadPension);

    //salarioDiarioPromedio = $("#formulas-salario-diario-promedio").val();
    salarioMinimoDf = $("#formulas-salario-minimo-df").val();
    salarioPromedioVsm = salarioDiarioPromedio / salarioMinimoDf;
    $("#formulas-salario-promedio-vsm").val(salarioPromedioVsm.toFixed(2));

    $("#cuantia-basica-salario-promedio").val(salarioDiarioPromedio);

    $("#incremento-anual-cuantia-basica-salario-promedio").val(
        salarioDiarioPromedio
    );

    $("#anos-ant-semanas-cotizadas").val($("#formulas-semana-cotizadas").val());
    $("#anos-ant-500-semanas").val(500);
    $("#anos-ant-semanas-reconocidas").val(
        parseInt($("#formulas-semana-cotizadas").val()) - 500
    );
    //console.log("error " + $("#formulas-semana-cotizadas").val());
    anosCompletos = Math.trunc($("#anos-ant-semanas-reconocidas").val() / 52);
    $("#anos-ant-anos-completos").val(anosCompletos);

    totalPost00 = $("#anos-ant-anos-completos").val() * 52;
    $("#anos-ant-semanas-completas-posteriores-500").val(totalPost00);

    $("#anos-ant-sem-reconocidas-post-500").val(
        parseInt($("#formulas-semana-cotizadas").val()) - 500
    );

    $("#anos-ant-sem-completas-post-500").val(totalPost00);

    semanasResiduos =
        $("#anos-ant-sem-reconocidas-post-500").val() -
        $("#anos-ant-sem-completas-post-500").val();
    $("#anos-ant-semanas-residuo").val(semanasResiduos);

    if (semanasResiduos >= 0 && semanasResiduos <= 12.99) {
        incrAnual = 0;
    } else if (semanasResiduos >= 13 && semanasResiduos <= 26) {
        incrAnual = 0.5;
    } else if (semanasResiduos > 26) {
        incrAnual = 1.0;
    }

    $("#anos-ant-ano-residuo").val(incrAnual);

    $("#anos-ant-comp-reconocdos-post-500").val(
        $("#anos-ant-anos-completos").val()
    );

    $("#anos-ant-mas-anos-residuo").val(incrAnual);

    totAnosReconocidos =
        parseInt($("#anos-ant-comp-reconocdos-post-500").val()) +
        parseInt($("#anos-ant-mas-anos-residuo").val());
    $("#anos-ant-tot-anos-reconocidos-post-500").val(totAnosReconocidos);
    $("#total-anos-reconocidos").val(totAnosReconocidos);
    // Buscar cuantía basica en tablas formulas-salario-promedio-vsm
    cuantiaBasicaHojas(
        $("#formulas-salario-promedio-vsm").val(),
        edadJubilacion,
        hoja,
        edadPension
    );
}

function cuantiaBasicaHojas(
    salarioPromedioVsm,
    edadJubilacion,
    hoja,
    edadPension
) {
    $.ajax({
        url: "/buscar-cuantia-basica",
        type: "get",
        data: { salarioPromedioVsm: salarioPromedioVsm },
        dataType: "json"
    })
        .done(function(response) {
            console.log(response);
            $("#cuantia-basica-valor").val(response.data.cuantia_basica);
            $("#incremento-anual-cuantia-basica-valor").val(
                response.data.incremento_anual
            );

            cuantiaBasicaSalarioPromedio = $(
                "#cuantia-basica-salario-promedio"
            ).val();
            cuantiaBasicaValor = $("#cuantia-basica-valor").val();
            cuantiaBasicaDiaria =
                parseFloat(cuantiaBasicaSalarioPromedio) *
                parseFloat(cuantiaBasicaValor / 100);
            $("#cuantia-basica-diaria").val(cuantiaBasicaDiaria.toFixed(2));

            cuantiaBasicaDiaria = parseFloat($("#cuantia-basica-diaria").val());
            cuantiaBasicaX365 = parseFloat($("#cuantia-basica-x-365").val());
            cuantiaBasicaAnual = cuantiaBasicaDiaria * cuantiaBasicaX365;
            $("#cuantia-basica-anual").val(cuantiaBasicaAnual.toFixed(2));
            cuantiaBasicaMensual = cuantiaBasicaAnual / 12;
            $("#cuantia-basica-mensual").val(cuantiaBasicaMensual.toFixed(2));

            anualCuantiaBasicaSalarioPromedio = $(
                "#incremento-anual-cuantia-basica-salario-promedio"
            ).val();
            anualCuantiaBasicaValor = $(
                "#incremento-anual-cuantia-basica-valor"
            ).val();

            incrementoAnualCuantiaBasicaDiaria =
                anualCuantiaBasicaSalarioPromedio *
                (anualCuantiaBasicaValor / 100);
            $("#incremento-anual-cuantia-basica-diaria").val(
                incrementoAnualCuantiaBasicaDiaria.toFixed(2)
            );

            incrementoAnual = incrementoAnualCuantiaBasicaDiaria * 365;
            $("#incremento-anual-previo").val(incrementoAnual.toFixed(2));

            incrementoAnualPrevio = $("#incremento-anual-previo").val();
            totalAnosReconocidos = $("#total-anos-reconocidos").val();
            total3 = incrementoAnualPrevio * totalAnosReconocidos;
            $("#incremento-anual-a-la-cuantia-basica").val(total3);
            total4 = total3 / 12;
            $("#incremento-mensual-cuantia-basica").val(total4.toFixed(2));

            $("#cuanta-anual-pension-basica").val(
                $("#cuantia-basica-anual").val()
            );

            $("#cuanta-anual-pension-incremento").val(
                $("#incremento-anual-a-la-cuantia-basica").val()
            );

            total5 = parseFloat($("#cuanta-anual-pension-incremento").val());
            total6 = parseFloat($("#cuanta-anual-pension-basica").val());
            total7 = total5 + total6;
            $("#cuanta-anual-pension-igual").val(total7.toFixed(2));
            total8 = total7 / 12;
            $("#cuanta-anual-pension-igual-mensual").val(total8.toFixed(2));

            // Ayuda Esposa
            $("#asig-esposa-cuantia-anual-pension").val(total7.toFixed(2));
            montoEsposa = $("#esposa").val() == "No" ? 0 : total7 * (15 / 100);
            $("#asig-esposa-asignacion-viuda").val(montoEsposa.toFixed(2));
            $("#asig-esposa-mensual").val((montoEsposa / 12).toFixed(2));

            // Ayuda Hijos
            $("#ayuda-hijos-cuantia-anual-pension").val(total7.toFixed(2));
            hijos = $("#hijos").val();
            $("#ayuda-hijos-nro-hijos").val(hijos);
            total9 = total7 * (10 / 100) * hijos;
            $("#ayuda-hijos-ayuda-anual").val(total9.toFixed(2));
            $("#ayuda-hijos-mensual").val((total9 / 12).toFixed(2));

            // Ayuda Padres
            $("#ayuda-padres-anual-pesion").val(total7.toFixed(2));
            padres = $("#padres").val();
            $("#ayuda-padres-nro-padres").val(padres);

            if ($("#esposa").val() == "Si" || hijos > 0) {
                total10 = 0;
            } else {
                total10 = total7 * (20 / 100) * padres;
            }
            $("#ayuda-padres-ayuda-anual").val(total10.toFixed(2));
            $("#ayuda-padres-anual").val((total10 / 12).toFixed(2));

            // Ayuda por Soledad
            $("#ayuda-soledad-anual-pension").val(total7.toFixed(2));
            montosoledad =
                $("#esposa").val() == "No" && hijos == 0 && padres == 0
                    ? total7 * (15 / 100)
                    : 0;
            $("#ayuda-soledad-anual").val(montosoledad.toFixed(2));
            $("#ayuda-soledad-mensual").val((montosoledad / 12).toFixed(2));

            // Total ayudas
            totalAyudas = montoEsposa + total9 + total10 + montosoledad;
            $("#total-ayudas").val(totalAyudas.toFixed(2));
            $("#total-ayudas-mensual").val((totalAyudas / 12).toFixed(2));
            $("#total-ayuda-cuantia-anual").val(total7.toFixed(2));
            $("#total-ayuda-cuantia-anual-mas-ayuda").val(
                (totalAyudas + total7).toFixed(2)
            );
            $("#total-ayuda-cuantia-anual-ayuda-mensual").val(
                ((totalAyudas + total7) / 12).toFixed(2)
            );

            $("#cuantia-anual-pension-mas-ayudas").val(
                (totalAyudas + total7).toFixed(2)
            );
            $("#cuantia-anual-pension-mas-ayudas-mensual").val(
                ((totalAyudas + total7) / 12).toFixed(2)
            );
            $("#igual-pension-anual-x-vejez").val(
                ((totalAyudas + total7) * (111 / 100)).toFixed(2)
            );
            $("#igual-pension-anual-x-vejez-mensual").val(
                (((totalAyudas + total7) * (111 / 100)) / 12).toFixed(2)
            );
            //  alert(edadPension);
            switch (edadPension) {
                case 60:
                    $porc = 75;
                    break;
                case 61:
                    $porc = 80;
                    break;
                case 62:
                    $porc = 85;
                    break;
                case 63:
                    $porc = 90;
                    break;
                case 64:
                    $porc = 95;
                    break;
                case 65:
                    $porc = 100;
                    break;
                // default:
                //     $porc = 100;
            }
            $("#porc-pension-por-edad").val($porc);

            pensionAnualVejez = (totalAyudas + total7) * (111 / 100);
            $("#pension-anual-x-vejez-fin").val(pensionAnualVejez.toFixed(2));

            $("#pension-anual-x-cesantia").val(
                (pensionAnualVejez * ($porc / 100)).toFixed(2)
            );

            $("#pension-anual-x-cesantia-mensual").val(
                ((pensionAnualVejez * ($porc / 100)) / 12).toFixed(2)
            );

            $("#pension-anual-fin").text(
                $.number(pensionAnualVejez * ($porc / 100), 2, ".", ",")
            );
            $("#pension-mensual-fin").text(
                $.number((pensionAnualVejez * ($porc / 100)) / 12, 2, ".", ",")
            );

            $("#" + hoja + "-pension-mensual-con-m40").val(
                $("#pension-mensual-fin").text()
            );

            $("#" + hoja + "-pension-anual-con-m40").val(
                $("#pension-anual-fin").text()
            );

            aguinaldo = convertNumberPure(
                $("#" + hoja + "-pension-mensual-con-m40").val()
            );

            aguinaldo = aguinaldo * 0.85;
            $("#" + hoja + "-aguinaldo").val($.number(aguinaldo, 2, ".", ","));

            totalAnual = convertNumberPure($("#pension-anual-fin").text());
            totalAnual = totalAnual + aguinaldo;
            $("#" + hoja + "-total-anual").val(
                $.number(totalAnual, 2, ".", ",")
            );

            difEdad = 85 - edadPension;
            $("#" + hoja + "-dif-edad-85-text").text(difEdad);
            $("#" + hoja + "-dif-85").val(
                $.number(totalAnual * difEdad, 2, ".", ",")
            );

            $("#title-pension-con-m40").attr("class", "text-success blink_me");
        })
        .fail(function(statusCode, errorThrown) {
            $.unblockUI();
            ////console.log(errorThrown);
            ajaxError(statusCode, errorThrown);
        });
}

function agregarTablePromedioHojaEdit(
    filas,
    fechaDesde,
    fechaHasta,
    dias,
    monto,
    totalMontoCotizacion,
    i,
    concepto,
    id
) {
    var htmlTags =
        '<tr row="' +
        filas +
        '" id="' +
        filas +
        '">' +
        '<td id="hoja-' +
        id +
        "-concepto-" +
        concepto +
        '" colspan="2" style="vertical-align:middle" class="concepto text-center"> Cotizaciones ' +
        i +
        "</td>" +
        '<td class=""><input type="date" row="' +
        filas +
        '" id="promedio' +
        id +
        "fechaDesde" +
        filas +
        '" class="input-xs form-control" value="' +
        fechaDesde +
        '" readonly></td>' +
        '<td class=""><input type="date" row="' +
        filas +
        '" id="promedio' +
        id +
        "fechaHasta" +
        filas +
        '" class="input-xs form-control" value="' +
        fechaHasta +
        '" readonly></td>' +
        '<td class=""><input type="text" row="' +
        filas +
        '" id="promedio' +
        id +
        "dias" +
        filas +
        '" class="input-xs hoja-' +
        id +
        '-dias form-control" readonly value="' +
        dias +
        '"></td>' +
        '<td class="">' +
        '<div class="input-group">' +
        '<div class="input-group-prepend">' +
        '<span class="input-group-text input-group-text-xs">$</span>' +
        "</div>" +
        '<input type="number" row="' +
        filas +
        '" id="promedio' +
        id +
        "monto" +
        filas +
        '" class="input-xs form-control" readonly value="' +
        monto +
        '">' +
        "</div>" +
        "</td>" +
        '<td class="">' +
        '<div class="input-group">' +
        '<div class="input-group-prepend">' +
        '<span class="input-group-text input-group-text-xs">$</span>' +
        "</div>" +
        '<input type="text" row="' +
        filas +
        '" id="promedio' +
        id +
        "totalMontoCotizacion" +
        filas +
        '" class="input-xs form-control  total-cotizacion-promedio-salarial-' +
        id +
        '" readonly value="' +
        $.number(totalMontoCotizacion, 2, ".", ",") +
        '">' +
        "</div>" +
        "</td>" +
        '<td class=""><a href="#" class="hoja-' +
        id +
        '-borrar-cotizacion"><i class="text-danger far fa-trash-alt"></i></a></td>' +
        "</tr>";

    $("#table-promedio-salarial-" + id + " tbody").append(htmlTags);
}

function totaldiasHojaEdit(id) {
    diasTotal = 0;
    $(".hoja-" + id + "-dias").each(function() {
        dias = $(this).val();
        if (dias != "") {
            diasTotal += parseInt(dias);
        }
    });

    totalCotiza = 0;
    $(".total-cotizacion-promedio-salarial-" + id + "").each(function() {
        totalCotizacion = $(this).val();
        if (totalCotizacion != "") {
            totalCotiza += convertNumberPure(totalCotizacion);
        }
    });

    if (diasTotal < 1750) {
        $("#hoja-" + id + "-total-dias").val($.number(diasTotal, 2, ".", ","));
        $("#hoja-" + id + "-dias-excedidos").val($.number(0, 2, ".", ","));
        $("#hoja-" + id + "-dias-equivalentes-250").val(
            $.number(0, 2, ".", ",")
        );
        return false;
    }
    diasExcedidos = diasTotal - 1750;
    diasEquivalentes250 = diasTotal - diasExcedidos;

    $("#hoja-" + id + "-total-dias").val($.number(diasTotal, 2, ".", ","));
    $("#hoja-" + id + "-dias-excedidos").val(
        $.number(diasExcedidos, 2, ".", ",")
    );
    $("#hoja-" + id + "-dias-equivalentes-250").val(
        $.number(diasEquivalentes250, 2, ".", ",")
    );

    cargaTablaCambioSalalarioHojaEdit(id);

    monto = $("#monto-a-descontar-excedido").val();

    salarioNeto = parseInt(diasExcedidos) * parseFloat(monto);

    $("#hoja-" + id + "-salarios-neto").val($.number(monto, 2, ".", ","));

    salarioBasePromedio = totalCotiza - monto;
    $("#hoja-" + id + "-salario-base-promedio").val(
        $.number(salarioBasePromedio, 2, ".", ",")
    );

    promedioUltimasSemanas = salarioBasePromedio / 1750;

    $("#hoja-" + id + "-entre").val(
        $("#hoja-" + id + "-dias-equivalentes-250").val()
    );
    $("#hoja-" + id + "-prom-ultimas-250-sem").val(
        $.number(promedioUltimasSemanas, 2, ".", ",")
    );

    semanasCotizadas = $("#totalSemanas").val();
    semanasCotiza = 0;
    $(".semanas-cotizadas-estrategia").each(function() {
        semanas = $(this).val();
        if (semanas != "") {
            semanasCotiza += parseFloat(semanas);
        }
    });
    console.log(semanasCotiza);
    semanasCotizadas = parseInt(semanasCotizadas) + Math.round(semanasCotiza);

    estrategiaEdad = $("#hoja-" + id + "-edad-calculo-pension").val();
    edadJubilacion = $(
        "#hoja-" + id + "-edad-estrategia-" + estrategiaEdad
    ).val();
    mes = parseInt(edadJubilacion.substr(9, 2));
    ano = parseInt(edadJubilacion.substr(0, 2));
    edadPension = mes >= 6 ? ano + 1 : ano;
    edadPension = edadPension > 65 ? 65 : edadPension;
    salarioDiarioPromedio = promedioUltimasSemanas;
    $("#hoja-" + id + "-nro-semanas-cotizadas").val(semanasCotizadas);
    $("#hoja-" + id + "-salario-promedio-mensual-250-semanas").val(
        $.number(salarioDiarioPromedio, 2, ".", ",")
    );
    $("#hoja-" + id + "-esposa").val($("#esposa").val());
    $("#hoja-" + id + "-hijos").val($("#hijos").val());
    $("#hoja-" + id + "-padres").val($("#padres").val());
    $("#hoja-" + id + "-edad-jubilacion").val(edadPension);

    calculaFormulasExcelHojas(
        semanasCotizadas,
        salarioDiarioPromedio,
        edadPension,
        false,
        "hoja-" + id + ""
    );
    /////
}

function cargaTablaCambioSalalarioHojaEdit(id) {
    i = 0;
    fila = 1;

    $("#table-cambiar-salario tr").remove();
    cargaFilasEstrategiasHojaEdit(id);
    i = 1;

    var filas = $("#body-promedio-salarial-" + id + "").find("tr");
    totalGeneral = 0.0;
    for (i = 7; i < filas.length; i++) {
        var celdas = $(filas[i]).find("td");

        concepto = celdas[0].innerText;

        cadFecDesde = celdas[1].innerHTML;
        fechaDesde = cadFecDesde.substr(cadFecDesde.indexOf('value="') + 7, 10);

        cadFecHasta = celdas[2].innerHTML;
        fechaHasta = cadFecHasta.substr(cadFecHasta.indexOf('value="') + 7, 10);

        cadDias = celdas[3].innerHTML;
        dias = cadDias.substr(cadDias.indexOf('value="') + 7);
        dias = dias.substr(0, dias.length - 2);

        cadMonto = celdas[4].innerHTML;
        monto = cadMonto.substr(cadMonto.indexOf('value="') + 7);
        monto = monto.substr(0, monto.length - 8);

        agregarTableCambiosalarioHojaEdit(
            concepto,
            moment(fechaDesde).format("DD-MM-YYYY"),
            moment(fechaHasta).format("DD-MM-YYYY"),
            dias,
            monto
        );
    }

    var tbody = $("#table-cambiar-salario tbody");
    $("#table-cambiar-salario tbody").html(
        $("tr", tbody)
            .get()
            .reverse()
    );

    $("#body-salario-excedido").empty();

    diasExcedidos = $("#hoja-" + id + "-dias-excedidos").val();
    $("#dias-excedidos-calculo").html(diasExcedidos);

    excedidos = convertNumberPure(diasExcedidos);
    var filas = $("#body-cambiar-salario").find("tr");
    totalGeneral = 0.0;
    for (i = 0; i < filas.length; i++) {
        var celdas = $(filas[i]).find("td");

        diasTable = parseInt(celdas[3].innerText);
        monto = celdas[4].innerText;
        monto = monto.replace("$ ", "");
        if (monto.indexOf(",") > -1) {
            monto = convertNumberPure(monto);
        }
        montoCotizado = monto;
        if (diasTable >= excedidos) {
            totalMontoExcedido = excedidos * montoCotizado;
            totalGeneral += totalMontoExcedido;
            htmlTags =
                "<tr><td class='text-center'>" +
                excedidos +
                "</td><td class='text-right'>" +
                celdas[4].innerText +
                "</td><td class='text-right'>$ " +
                $.number(totalMontoExcedido, 2, ".", ",") +
                "</td></tr>";
            $("#table-salario-excedido tbody").append(htmlTags);
            break;
        } else {
            totalMontoExcedido = diasTable * montoCotizado;
            totalGeneral += totalMontoExcedido;
            htmlTags =
                "<tr><td class='text-center'>" +
                diasTable +
                "</td><td class='text-right'>" +
                celdas[4].innerText +
                "</td><td class='text-right'>$ " +
                $.number(totalMontoExcedido, 2, ".", ",") +
                "</td></tr>";
            $("#table-salario-excedido tbody").append(htmlTags);
            excedidos = excedidos - diasTable;
        }
    }

    htmlTags =
        "<tr style='background-color: #F2DEDE'><td colspan='2' class='text-center'>Total <strong>Monto Base</strong> a descontar</td>" +
        "<td class='text-right text-danger'>$ " +
        $.number(totalGeneral, 2, ".", ",") +
        "</td></tr>";
    $("#table-salario-excedido tbody").append(htmlTags);

    $("#monto-a-descontar-excedido").val(totalGeneral);
}

function agregarTableCambiosalarioHojaEdit(
    concepto,
    fechaDesde,
    fechaHasta,
    dias,
    monto
) {
    var htmlTags =
        '<tr><td><a class="clickCambiaSalario" monto_sbc="' +
        monto +
        '" href="">' +
        concepto +
        '</a></td><td class="text-center"><a class="clickCambiaSalario" monto_sbc="' +
        monto +
        '" href="">' +
        fechaDesde +
        '</a></td><td class="text-center"><a class="clickCambiaSalario" monto_sbc="' +
        monto +
        '" href="">' +
        fechaHasta +
        '</a></td><td class="text-center"><a class="clickCambiaSalario" monto_sbc="' +
        monto +
        '" href="">' +
        dias +
        '</a></td><td class="text-right"><a class="clickCambiaSalario" monto_sbc="' +
        monto +
        '" href="">$ ' +
        monto +
        "</a></td></tr>";

    $("#table-cambiar-salario tbody").append(htmlTags);
}

function cargaFilasEstrategiasHojaEdit(id) {
    dias = $("#hoja-" + id + "-dias-mod40-alto").val();
    if (dias != "") {
        concepto = "M40 -ALTO 2";
        fechaDesde = $("#hoja-" + id + "-fecha-desde-mod40-alto").val();
        fechaHasta = $("#hoja-" + id + "-fecha-hasta-mod40-alto").val();
        dias = $("#hoja-" + id + "-dias-mod40-alto").val();
        monto = $("#hoja-" + id + "-sbc-mod40-alto").val();
        agregarTableCambiosalarioHojaEdit(
            concepto,
            fechaDesde,
            fechaHasta,
            dias,
            monto
        );
    }

    dias = $("#hoja-" + id + "-dias-mod40-retroactivo").val();
    if (dias != "") {
        concepto = "RETROACTIVO";
        fechaDesde = $("#hoja-" + id + "-fecha-desde-mod40-retroactivo").val();
        fechaHasta = $("#hoja-" + id + "-fecha-hasta-mod40-retroactivo").val();
        dias = $("#hoja-" + id + "-dias-mod40-retroactivo").val();
        monto = $("#hoja-" + id + "-sbc-mod40-retroactivo").val();
        agregarTableCambiosalarioHojaEdit(
            concepto,
            fechaDesde,
            fechaHasta,
            dias,
            monto
        );
    }

    dias = $("#hoja-" + id + "-dias-mod40-barata").val();
    if (dias != "") {
        concepto = "M40 BARATA";
        fechaDesde = $("#hoja-" + id + "-fecha-desde-mod40-barata").val();
        fechaHasta = $("#hoja-" + id + "-fecha-hasta-mod40-barata").val();
        dias = $("#hoja-" + id + "-dias-mod40-barata").val();
        monto = $("#hoja-" + id + "-sbc-mod40-barata").val();
        agregarTableCambiosalarioHojaEdit(
            concepto,
            fechaDesde,
            fechaHasta,
            dias,
            monto
        );
    }

    dias = $("#hoja-" + id + "-dias-cooperativa").val();
    if (dias != "") {
        concepto = "COOPERATIVA";
        fechaDesde = $("#hoja-" + id + "-fecha-desde-cooperativa").val();
        fechaHasta = $("#hoja-" + id + "-fecha-hasta-cooperativa").val();
        dias = $("#hoja-" + id + "-dias-cooperativa").val();
        monto = $("#hoja-" + id + "-sbc-cooperativa").val();
        agregarTableCambiosalarioHojaEdit(
            concepto,
            fechaDesde,
            fechaHasta,
            dias,
            monto
        );
    }

    dias = $("#hoja-" + id + "-dias-m40-pagada").val();
    if (dias != "") {
        concepto = "M40 YA PAGADA";
        fechaDesde = $("#hoja-" + id + "-fecha-desde-m40-pagada").val();
        fechaHasta = $("#hoja-" + id + "-fecha-hasta-m40-pagada").val();
        dias = $("#hoja-" + id + "-dias-m40-pagada").val();
        monto = $("#hoja-" + id + "-sbc-m40-pagada").val();
        agregarTableCambiosalarioHojaEdit(
            concepto,
            fechaDesde,
            fechaHasta,
            dias,
            monto
        );
    }
}

function calculaTotalEstrategiasHojasEdit(hoja, estrategia) {
    sbc = $("#hoja-" + hoja + "-sbc-estrategia-" + estrategia).val();
    dias = $("#hoja-" + hoja + "-dias-estrategia-" + estrategia).val();
    total = parseFloat(sbc) * parseFloat(dias);
    $("#hoja-" + hoja + "-total-estrategia-" + estrategia).val(
        $.number(total, 2, ".", ",")
    );

    meses = convertNumberPure(
        $("#hoja-" + hoja + "-meses-estrategia-" + estrategia).val()
    );
    fecDesde = $(
        "#hoja-" + hoja + "-fecha-desde-estrategia-" + estrategia
    ).val();
    fecHasta = $(
        "#hoja-" + hoja + "-fecha-hasta-estrategia-" + estrategia
    ).val();
    switch (estrategia) {
        case 1:
            break;
        case "2":
            // Costo coopeartiva
            meses = convertNumberPure(
                $("#hoja-" + hoja + "-meses-estrategia-" + estrategia).val()
            );
            inscCooperativa = convertNumberPure(
                $(
                    "#hoja-" +
                        hoja +
                        "-inscripcion-cooperativa-estrategia-" +
                        estrategia
                ).val()
            );
            tot1 = meses * 1750;
            costo = inscCooperativa + tot1;
            $("#hoja-" + hoja + "-costo-estrategia-" + estrategia).val(
                $.number(costo, 2, ".", ",")
            );
            otros = costo / meses;
            $("#hoja-" + hoja + "-otro-valor-estrategia-" + estrategia).val(
                $.number(otros, 2, ".", ",")
            );

            break;
        case "3":
            // Costo M40 retroactivo
            costo = total * 0.10075;
            $("#hoja-" + hoja + "-costo-estrategia-" + estrategia).val(
                $.number(costo, 2, ".", ",")
            );

            otroCosto = sbc * 30.4 * 0.10075;
            $("#hoja-" + hoja + "-otro-valor-estrategia-" + estrategia).val(
                $.number(otroCosto, 2, ".", ",")
            );

            break;
        case "4":
            // Costo M40 ya pagada
            costo = total * 0.10075;
            $("#hoja-" + hoja + "-costo-estrategia-" + estrategia).val(
                $.number(costo, 2, ".", ",")
            );

            otroCosto = sbc * 30.4 * 0.10075;
            $("#hoja-" + hoja + "-otro-valor-estrategia-" + estrategia).val(
                $.number(otroCosto, 2, ".", ",")
            );

            break;
        case "5":
            // Costo M40 mas barata
            costo = total * 0.10075;
            $("#hoja-" + hoja + "-costo-estrategia-" + estrategia).val(
                $.number(costo, 2, ".", ",")
            );

            otroCosto = sbc * 30.4 * 0.10075;
            $("#hoja-" + hoja + "-otro-valor-estrategia-" + estrategia).val(
                $.number(otroCosto, 2, ".", ",")
            );

            break;
        case "6":
            // Costo M40 Salario alto
            costo = total * 0.10075;
            $("#hoja-" + hoja + "-costo-estrategia-" + estrategia).val(
                $.number(costo, 2, ".", ",")
            );

            otroCosto = sbc * 30.4 * 0.10075;
            $("#hoja-" + hoja + "-otro-valor-estrategia-" + estrategia).val(
                $.number(otroCosto, 2, ".", ",")
            );

            break;
    }
}

function changeChosenEdadPensionHojaEdit(hoja, estrategia) {
    edadJubilacion = $(
        "#hoja-" + hoja + "-edad-estrategia-" + estrategia
    ).val();
    mes = parseInt(edadJubilacion.substr(9, 2));
    ano = parseInt(edadJubilacion.substr(0, 2));
    //alert("ano " + ano + " mes " + mes);
    edadPension1 = mes >= 6 ? ano + 1 : ano;
    edadPension1 = edadPension1 > 65 ? 65 : edadPension1;

    switch (estrategia) {
        case "1":
            concepto = " años - Empresa actual";
            break;
        case "2":
            concepto = " años - Cooperativa";
            break;
        case "3":
            concepto = " años - M40 Retroactivo";
            break;
        case "4":
            concepto = " años - M40 Ya Pagada";
            break;
        case "5":
            concepto = " años - M40 Barata";
            break;
        case "6":
            concepto = " años - M40 Salario Alto";
            break;
    }

    $(
        "#hoja-" +
            hoja +
            "-edad-calculo-pension option[value='" +
            estrategia +
            "']"
    ).remove();

    $("#hoja-" + hoja + "-edad-calculo-pension").append(
        '<option value="' +
            estrategia +
            '" >' +
            edadPension1 +
            concepto +
            "</option>"
    );

    $("#hoja-" + hoja + "-edad-calculo-pension").trigger("chosen:updated");
}

function OkSumarDiasHoja(hoja, estrategia) {
    elem = "#hoja-" + hoja + "-entrada-dias-estrategia-" + estrategia;
    fecha = "#hoja-" + hoja + "-fecha-hasta-estrategia-" + estrategia;

    id = estrategia;
    desdefecha = "#hoja-" + hoja + "-fecha-desde-estrategia-" + estrategia;
    diasFormulaEvaluar = $(elem).val();
    if (diasFormulaEvaluar == "") {
        return;
    }
    fechaDondesumar = $(desdefecha).val();
    $.ajax({
        url: "/sumar-dias-a-fecha-estrategias",
        type: "get",
        data: {
            diasFormulaEvaluar: diasFormulaEvaluar,
            fechaDondesumar: fechaDondesumar
        },
        dataType: "json"
    })
        .done(function(response) {
            $("#hoja-" + hoja + "-fecha-hasta-estrategia-" + estrategia).val(
                response.data
            );
            $("#hoja-" + hoja + "-sumas-dias-estrategia-" + estrategia).hide();
            fecDesde = $(
                "#hoja-" + hoja + "-fecha-desde-estrategia-" + estrategia
            ).val();
            fecHasta = $(
                "#hoja-" + hoja + "-fecha-hasta-estrategia-" + estrategia
            ).val();
            calculaDiasEntreFechasHojaEdit(
                fecDesde,
                fecHasta,
                estrategia,
                hoja
            );
            desde = $("#fechaNacimiento").val();
            hasta = $(
                "#hoja-" + hoja + "-fecha-hasta-estrategia-" + estrategia
            ).val();
            calculaFechasHojaEdit(
                desde,
                hasta,
                "#hoja-" + hoja + "-edad-estrategia-" + estrategia
            );

            setTimeout(function() {
                dias = $(
                    "#hoja-" + hoja + "-dias-estrategia-" + estrategia
                ).val();
                anos = parseInt(dias) / 365;
                $("#hoja-" + hoja + "-anos-estrategia-" + estrategia).val(
                    $.number(anos, 2, ".", ",")
                );

                meses = anos * 12;
                $("#hoja-" + hoja + "-meses-estrategia-" + estrategia).val(
                    $.number(meses, 2, ".", ",")
                );

                semanas = dias / 7;
                $("#hoja-" + hoja + "-semanas-estrategia-" + estrategia).val(
                    $.number(semanas, 2, ".", ",")
                );
                $("#hoja-" + hoja + "-sbc-estrategia-" + estrategia).focus();
            }, 1000);
        })
        .fail(function(statusCode, errorThrown) {
            $.unblockUI();
            ajaxError(statusCode, errorThrown);
        });
}

function calculaDiasEntreFechasHojaEdit(fecDesde, fecHasta, estrategia, hoja) {
    $.ajax({
        url: "/calcular-dias-entre-fechas",
        type: "get",
        data: { fechaDesde: fecDesde, fechaHasta: fecHasta },
        dataType: "json"
    })
        .done(function(response) {
            //2020-06-29 2020-07-10 2020-06-29 2020-07-09
            ////console.log(response);
            $("#hoja-" + hoja + "-dias-estrategia-" + estrategia).val(
                response.data
            );
        })
        .fail(function(statusCode, errorThrown) {
            $.unblockUI();
            ////console.log(errorThrown);
            ajaxError(statusCode, errorThrown);
        });
}

function calculaFechasHojaEdit(desde, hasta, elementoDom) {
    $.ajax({
        url: "/edad-cliente",
        type: "get",
        data: { fecNac: desde, fechaFutura: hasta },
        dataType: "json"
    })
        .done(function(response) {
            ////console.log(response);
            $(elementoDom).val(response.data);
        })
        .fail(function(statusCode, errorThrown) {
            $.unblockUI();
            ////console.log(errorThrown);
            ajaxError(statusCode, errorThrown);
        });
}

function calculaBtnHoja1(modal) {
    semanasCotizadas = $("#totalSemanas").val();
    salarioDiarioPromedio = $("#promedio-salarios").text();
    edadJubilacion = $("#edadDe").val();
    salarioDiarioPromedio = convertNumberPure(salarioDiarioPromedio);
    if (modal) {
        loadingUI("Calculando formulas...", "white");
    }

    calculaFormulasExcel(
        semanasCotizadas,
        salarioDiarioPromedio,
        edadJubilacion,
        false
    );

    setTimeout(function() {
        $.unblockUI();
        $("#hoja-1-fecha-nacimiento").val(
            moment($("#fechaNacimiento").val()).format("DD-MM-YYYY")
        );
        $("#hoja-1-fecha-plan").val(
            moment($("#fechaPlan").val()).format("DD-MM-YYYY")
        );
        edad = $("#divEdadCliente").text();
        $("#hoja-1-edad").val(edad);

        $("#hoja-1-fecha-baja").val($("#fechaBaja").val());

        $("#hoja-1-semanas-cotizadas").val($("#semanasCotizadas").val());
        $("#hoja-1-semanas-descontadas").val($("#semanasDescontadas").val());
        $("#hoja-1-total-semanas").val($("#totalSemanas").val());

        $("#hoja-1-edad-retiro").val($("#edadDe").val() + " Años");

        calcularTiempoIndividual();

        $("#hoja-1-semanas-cotizadas-2").val($("#totalSemanas").val());

        $("#hoja-1-salario-promedio").val($("#promedio-salarios").text());
        edadA = $("#edadA").val();
        $("#hoja-1-edad-2").val(edadA);

        $("#hoja-1-pension-mesual-sin-m40").val(
            $("#pension-mensual-fin").text()
        );

        $("#hoja-1-pension-anual-sin-m40").val($("#pension-anual-fin").text());

        aguinaldo = convertNumberPure(
            $("#hoja-1-pension-mesual-sin-m40").val()
        );
        aguinaldo = aguinaldo * 0.85;
        $("#hoja-1-aguinaldo").val($.number(aguinaldo, 2, ".", ","));

        totalAnual = convertNumberPure($("#pension-anual-fin").text());
        totalAnual = totalAnual + aguinaldo;
        $("#hoja-1-total-anual").val($.number(totalAnual, 2, ".", ","));

        difEdad = 85 - parseFloat(edadA);
        $("#dif-edad-85").text(difEdad);
        $("#hoja-1-dif-85").val($.number(totalAnual * difEdad, 2, ".", ","));
        if (modal) {
            $("#modal-hoja-1-pension-sin-estrategias").modal("show");
        }
    }, 1500);
}

function calcularTiempoIndividual() {
    fecNac = $("#fechaNacimiento").val();
    edadA = $("#edadA").val();
    fecPlan = $("#fechaPlan").val();
    $.ajax({
        url: "/calcular-tiempo-individual-faltante-retiro",
        type: "get",
        data: { fecNac: fecNac, edadA: edadA, fecPlan: fecPlan },
        dataType: "json"
    })
        .done(function(response) {
            console.log(response);
            $("#hoja-1-anos-retiro").val(response.data.ano);
            $("#hoja-1-meses-retiro").val(response.data.meses);
            $("#hoja-1-semanas-retiro").val(response.data.semanas);
            $("#hoja-1-dias-retiro").val(response.data.dias);
        })
        .fail(function(statusCode, errorThrown) {
            $.unblockUI();
            console.log(errorThrown);
            ajaxError(statusCode, errorThrown);
        });
}
