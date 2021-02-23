$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var objetoDataTables_semanas = "";

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $(".chosen-select").chosen(ConfigChosen());

    $("#migas-pan").html(
        '<ol class="breadcrumb border-0 m-0">' +
            '<li class="breadcrumb-item">Home</li>' +
            '<li class="breadcrumb-item">' +
            '<a href="#">Configuración</a></li>' +
            '<li class="breadcrumb-item active">Porc % calculo anual</li>' +
            "</ol>"
    );

    listarPorcentajes();

    function listarPorcentajes() {
        destroy_existing_data_table("#table-porcentaje-calculo");
        $.fn.dataTable.ext.pager.numbers_length = 4;
        objetoDataTables_semanas = $("#table-porcentaje-calculo").DataTable({
            order: [[0, "asc"]],
            dom: "lfrtip",
            processing: true,
            serverSide: true,
            responsive: true,
            paginationType: "input",
            sPaginationType: "full_numbers",
            language: {
                buttons: {
                    copyTitle: "Copiado al portapapeles.",
                    copySuccess: {
                        _: "Copiados %d Porcentajes.",
                        1: "Copiado 1 Porcentaje."
                    }
                },
                searchPlaceholder: "Buscar",
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ Porcentajes",
                sZeroRecords:
                    "No se encontró ningún Porcentaje con la Condición del Filtro",
                sEmptyTable: "Ningun Porcentaje Agregado aún...",
                sInfo:
                    "Del _START_ al _END_ de un total de _TOTAL_ Porcentajes",
                sInfoEmpty: "De 0 al 0 de un total de 0 Porcentaje",
                sInfoFiltered: "(filtrado de un total de _MAX_ Porcentajes)",
                sInfoPostFix: "",
                sSearch: "",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: loadingUI(
                    "Cargando listado de Porcentajes...",
                    "white"
                ),
                oPaginate: {
                    sFirst: '<i class="fas fa-angle-double-left"></i>',
                    sLast: '<i class="fas fa-angle-double-right"></i>',
                    sNext: '<i class="fas fa-angle-right"></i>',
                    sPrevious: '<i class="fas fa-angle-left"></i>'
                },
                oAria: {
                    sSortAscending:
                        ": Activar para ordenar la columna de manera ascendente",
                    sSortDescending:
                        ": Activar para ordenar la columna de manera descendente"
                }
            },
            lengthMenu: [
                [5, 10, 20, 25, 50, -1],
                [5, 10, 20, 25, 50, "Todos"]
            ],
            iDisplayLength: 10,
            ajax: {
                method: "get",
                url: "/listar-porcentajes-calculos",
                data: {}
            },
            initComplete: function(settings, json) {
                $.unblockUI();
                $('[data-toggle="popover"]').popover();
            },
            columns: [
                {
                    data: "id"
                },
                {
                    data: "ano"
                },
                {
                    data: "operador"
                },
                {
                    data: "porc_calculo",
                    className: "inputSwitch",
                    render: function(data) {
                        return "<span>" + data + "</span>";
                    }
                }
            ],
            columnDefs: [
                {
                    width: "10%",
                    targets: 0
                },
                {
                    width: "40%",
                    targets: 1,
                    orderable: false
                },
                {
                    width: "10%",
                    targets: 2
                },
                {
                    width: "10%",
                    targets: 3
                }
            ]
        });
    }

    $(document).on("dblclick", ".inputSwitch", function(e) {
        e.stopPropagation();
        var value = $(this).text();
        updateVal(this, value);
    });

    function updateVal(currentEle, value) {
        $(currentEle).html(
            '<input class="thVal form-control" maxlength="4" type="text" width="2" value="' +
                value +
                '" />'
        );
        $(".thVal", currentEle)
            .focus()
            .keyup(function(event) {
                if (event.keyCode == 13) {
                    $(currentEle).html(
                        $(".thVal")
                            .val()
                            .trim()
                    );
                }
            })
            .click(function(e) {
                e.stopPropagation();
            });

        $(document).click(function() {
            $(".thVal").replaceWith(function() {
                return this.value;
            });
        });
    }

    $(document).on("click", "#BtnGuardar", function(event) {
        event.preventDefault();
        arrayData = getArrayData();
        alertify
            .confirm(
                "Guardar información",
                "<span class='text-danger'>Esta seguro de guardar esta información ?</span>",
                function() {
                    $.ajax({
                        url: "/save-porc",
                        type: "get",
                        data: {
                            dataPorc: arrayData
                        },
                        dataType: "json",
                        beforeSend: function() {
                            loadingUI("Enviando correo");
                        }
                    })
                        .done(function(response) {
                            console.log(response);
                            $.unblockUI();
                            if (response.success === true) {
                                alertify.success(response.mensaje);
                            } else {
                                alertify.error(response.mensaje);
                            }
                        })
                        .fail(function(statusCode, errorThrown) {
                            $.unblockUI();
                            console.log(errorThrown);
                            ajaxError(statusCode, errorThrown);
                        });
                },
                function() {
                    alertify.error(
                        "El proceso para guardar la información fue cancelado."
                    );
                }
            )
            .set("labels", { ok: "Guardar", cancel: "Cancelar" });
    });
});
