$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var DataTables_Pensiones = "";

    sw = true;

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $("#btn-formulas").click(function(event) {
        event.preventDefault();

        semanasCotizadas = $("#totalSemanas").val();
        salarioDiarioPromedio = $("#promedio-salarios").text();
        edadJubilacion = $("#hoja-1-chosen-edad-pension").val();
        salarioDiarioPromedio = convertNumberPure(salarioDiarioPromedio);
        //salarioDiarioPromedio = salarioDiarioPromedio.replace(".", ",");
        calculaFormulasExcel(
            semanasCotizadas,
            salarioDiarioPromedio,
            edadJubilacion,
            true
        );
    });

    $("#modal-formulas").on("shown.bs.modal", function() {});
});
