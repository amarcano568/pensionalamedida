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

        semanasCotizadas = parseInt($("#semanasCotizadas").val());
        semanasFaltanP60 = parseInt($("#hoja-1-semanas-faltan-p60").val());
        salarioDiarioPromedio = $("#promedio-salarios").text();
        edadJubilacion = $("#hoja-1-chosen-edad-pension").val();
        salarioDiarioPromedio = convertNumberPure(salarioDiarioPromedio);
        //salarioDiarioPromedio = salarioDiarioPromedio.replace(".", ",");
        calculaFormulasExcel(
            semanasCotizadas + semanasFaltanP60,
            salarioDiarioPromedio,
            edadJubilacion,
            true
        );
    });

    $("#modal-formulas").on("shown.bs.modal", function() {});
});
