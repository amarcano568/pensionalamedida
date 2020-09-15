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

    $("#hoja-1-chosen-edad-pension").change(function(ev) {
        ev.preventDefault();
        calculaPensionNewEdad();
    });
});
