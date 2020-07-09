$(document).on("ready", function() {
    $("#btn-hoja-1").click(function(event) {
        event.preventDefault();
        valida = $("#formPaso1")
            .parsley()
            .validate();
        if (valida === false) {
            return false;
        }

        semanasCotizadas = $("#totalSemanas").val();
        salarioDiarioPromedio = $("#promedio-salarios").text();
        edadJubilacion = $("#edadDe").val();
        salarioDiarioPromedio = convertNumberPure(salarioDiarioPromedio);

        loadingUI("Calculando formulas...", "white");

        calculaFormulasExcel(
            semanasCotizadas,
            salarioDiarioPromedio,
            edadJubilacion,
            false
        );

        setTimeout(function() {
            // Espero por que se genere el Codigo Medico
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
            $("#hoja-1-semanas-descontadas").val(
                $("#semanasDescontadas").val()
            );
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

            $("#hoja-1-pension-anual-sin-m40").val(
                $("#pension-anual-fin").text()
            );

            aguinaldo = convertNumberPure(
                $("#hoja-1-pension-mesual-sin-m40").val()
            );
            aguinaldo = aguinaldo * 0.85;
            $("#hoja-1-aguinaldo").val($.number(aguinaldo, 2, ",", "."));

            totalAnual = convertNumberPure($("#pension-anual-fin").text());
            totalAnual = totalAnual + aguinaldo;
            $("#hoja-1-total-anual").val($.number(totalAnual, 2, ",", "."));

            difEdad = 85 - parseFloat(edadA);
            $("#dif-edad-85").text(difEdad);
            $("#hoja-1-dif-85").val(
                $.number(totalAnual * difEdad, 2, ",", ".")
            );
            $("#modal-hoja-1-pension-sin-estrategias").modal("show");
        }, 1500);
    });

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
});
