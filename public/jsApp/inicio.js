buscarDataTablero();

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
