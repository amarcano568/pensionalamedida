$(document).on("click", "#btn-importar-nuevos-alumnos", function(event) {
    event.preventDefault();
    $("#modal-importar-alumnos").modal("show");
});

$("#modal-importar-alumnos").on("shown.bs.modal", function() {
    iconoDropZone =
        '<br><br><i class="text-success fa-4x far fa-file-excel"></i><br><h6>Click para importar nuevos alumnos.</h6>';
    configuraDropZone(iconoDropZone);
});

function configuraDropZone(iconoDropZone) {
    idMiembro = $("#idMiembro").val();
    Dropzone.autoDiscover = false;
    Dropzone.prototype.defaultOptions.dictRemoveFile = "Borrar archivo..";
    // if (Dropzone.instances.length > 0)
    //     Dropzone.instances.forEach(bz => bz.destroy());
    $("#formDropZone").html("");
    $("#formDropZone").append(
        "<form action='subir-fichero-nuevos-alumnos' method='POST' files='true' enctype='multipart/form-data' id='dZUpload' class='dropzone borde-dropzone' style='width: 100%;padding: 0;cursor: pointer;'>" +
            "<div style='padding: 0;margin-top: 0em;' class='dz-default dz-message text-center'>" +
            iconoDropZone +
            "</div></form>"
    );

    myAwesomeDropzone = myAwesomeDropzone = {
        maxFilesize: 12,
        acceptedFiles: ".xlsx, .xls",
        addRemoveLinks: true,
        timeout: 50000,
        maxFiles: 1,
        removedfile: function(file) {
            var name = file.name;
            // console.log(name);
            $.ajax({
                type: "post",
                url: "delete-fichero-importar-alumno",
                data: {
                    filename: name
                },
                success: function(response) {
                    console.log("File has been successfully removed!!");
                    var dt = new Date();
                    if (response.success){
                        alertify.success(response.message);
                    }else{
                        alertify.error(response.message);
                    }
                   
                },
                error: function(e) {
                    console.log(e);
                }
            });
            var fileRef;
            return (fileRef = file.previewElement) != null
                ? fileRef.parentNode.removeChild(file.previewElement)
                : void 0;
        },
        params: {},
        success: function(file, response) {
            console.log(response);
            //$("#ModalAgregarLogo").modal("hide");
            //$("#ModalAgregarLogo .close").click();
            var dt = new Date();
            $("#modal-importar-alumnos").modal("hide");
            alertify.success('<i class="far fa-thumbs-up"></i> El fichero fue importado correctamente.');
        },
        error: function(file, response) {
            return false;
        }
    };

    var myDropzone = new Dropzone("#dZUpload", myAwesomeDropzone);

    // myDropzone.on("queuecomplete", function(file, response) {
    //     if (Dropzone.instances.length > 0)
    //         Dropzone.instances.forEach(bz => bz.destroy());
    //     $("#ModalAgregarLogo").modal("hide");
    // });
}

//buscarDataTablero();

function buscarDataTablero() {
    $.ajax({
        url: "/buscar-data-tablero",
        type: "get",
        data: {},
        dataType: "json",
        beforeSend: function() {
            loadingUI("Buscando la data del tablero...");
        }
    })
        .done(function(response) {
            console.log(response);

            $("#pensionesHoy").html(response.data.hoy[0]);
            $("#pensionesHoyFecha").html(
                "<br><h5 class='text-center'><i class='cil-calendar-check'></i> " +
                    response.data.hoy[1] +
                    "</h5>"
            );

            $("#pensionesMesActual").html(response.data.pensionesMesActual[0]);
            $("#pensionesMesActualFecha").html(
                "<br><h5 class='text-center'><i class='cil-calendar-check'></i> " +
                    response.data.pensionesMesActual[1] +
                    "</h5>"
            );

            $("#pensionesMesAnterior").html(
                response.data.pensionesMesAnterior[0]
            );
            $("#pensionesMesAnteriorFecha").html(
                "<br><h5 class='text-center'><i class='cil-calendar-check'></i> " +
                    response.data.pensionesMesAnterior[1] +
                    "</h5>"
            );

            $("#pensionesAnoActual").html(response.data.pensionesAnoActual[0]);
            $("#pensionesAnoActualFecha").html(
                "<br><h5 class='text-center'><i class='cil-calendar-check'></i> " +
                    response.data.pensionesAnoActual[1] +
                    "</h5>"
            );

            generaGraph(response.data.fechaGraph, response.data.valueGraph);
            $.unblockUI();
        })
        .fail(function(statusCode, errorThrown) {
            $.unblockUI();
            console.log(statusCode);
            ajaxError(statusCode, errorThrown);
        });

    function generaGraph(fecha, valor) {
        console.log(fecha);
        var ctx = document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: fecha,
                datasets: [
                    {
                        label: "",
                        data: valor,
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                            "rgba(255, 159, 64, 0.2)"
                        ],
                        borderColor: [
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)"
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true
                            }
                        }
                    ]
                }
            }
        });
    }
}
