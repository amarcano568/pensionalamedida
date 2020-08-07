$(document).on("ready", function() {
    $("#btn-hoja-1").click(function(event) {
        event.preventDefault();
        valida = $("#formPaso1")
            .parsley()
            .validate();
        if (valida === false) {
            return false;
        }

        calculaBtnHoja1(true);
    });

    $("#btn-hoja-1-new-edad-pension").click(function(event) {
        event.preventDefault();
        $("#hoja-1-new-edad-pension").show();
        $("#ok-hoja-1-new-edad-pension").show();
        $("#hoja_1_chosen_edad_pension_chosen").hide();
    });

    $("#ok-hoja-1-new-edad-pension").click(function(event) {
        event.preventDefault();
        newEdad = $("#hoja-1-new-edad-pension").val();
        //alert(newEdad);
        valida = $("#hoja-1-new-edad-pension")
            .parsley()
            .validate();
        console.log(valida);
        if (valida !== true) {
            return false;
        }

        $("#hoja-1-new-edad-pension").hide();
        $("#ok-hoja-1-new-edad-pension").hide();
        $("#hoja_1_chosen_edad_pension_chosen").show();

        $("#hoja-1-chosen-edad-pension").append(
            '<option value="' +
                newEdad +
                '">' +
                newEdad +
                " Nueva edad para calculo"
        );

        $("#hoja-1-chosen-edad-pension")
            .val(newEdad)
            .trigger("chosen:updated");
        $("#edadCalculoHoja1Global").val(newEdad);
        calculaPensionNewEdad();
    });

    function calculaPensionNewEdad() {
        newEdad = $("#hoja-1-chosen-edad-pension").val();
        $("#hoja-1-edad-retiro").val(newEdad + " Años");

        semanasCotizadas = $("#totalSemanas").val();
        salarioDiarioPromedio = $("#promedio-salarios").text();
        salarioDiarioPromedio = convertNumberPure(salarioDiarioPromedio);
        // alert(newEdad);
        calculaFormulasExcel(
            semanasCotizadas,
            salarioDiarioPromedio,
            newEdad,
            false
        );

        setTimeout(function() {
            calcularTiempoIndividual(newEdad);

            $("#hoja-1-pension-mesual-sin-m40").val(
                $("#pension-mensual-fin").text()
            );

            $("#hoja-1-pension-anual-sin-m40").val(
                $("#pension-anual-fin").text()
            );

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
            $("#hoja-1-dif-85").val(
                $.number(totalAnual * difEdad, 2, ".", ",")
            );
        }, 1500);
    }

    $("#hoja-1-chosen-edad-pension").change(function(ev) {
        ev.preventDefault();
        calculaPensionNewEdad();
    });
});
