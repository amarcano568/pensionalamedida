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
                default:
                    $porc = 100;
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
        })
        .fail(function(statusCode, errorThrown) {
            $.unblockUI();
            console.log(errorThrown);
            ajaxError(statusCode, errorThrown);
        });
}
