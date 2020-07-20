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
});
