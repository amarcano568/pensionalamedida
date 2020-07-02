$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var DataTables_Pensiones = "";

    sw = true;

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    //$(".c-sidebar-minimizer").click();

    $(".chosen-select").chosen(ConfigChosen());

    $("#migas-pan").html(
        '<ol class="breadcrumb border-0 m-0">' +
            '<li class="breadcrumb-item active">Home</li>' +
            '<li class="breadcrumb-item">Gestión de pensiones</li>' +
            "</ol>"
    );

    listarPensiones();

    function listarPensiones() {
        destroy_existing_data_table("#table-pensiones");
        $.fn.dataTable.ext.pager.numbers_length = 4;
        DataTables_Pensiones = $("#table-pensiones").DataTable({
            order: [[1, "asc"]],
            dom:
                "<'ui grid'" +
                "<'row'" +
                "<'four wide column'l>" +
                "<'center aligned eight wide column'B>" +
                "<'right aligned four wide column'f>" +
                ">" +
                "<'row dt-table'" +
                "<'sixteen wide column'tr>" +
                ">" +
                "<'row'" +
                "<'four wide column'i>" +
                "<'center aligned eight wide column'>" +
                "<'right aligned four wide column'p>" +
                ">>",
            buttons: [
                {
                    text: '<i class="far fa-file-excel"></i> Exportar',
                    className: "btn-datatables",
                    action: function(e, dt, node, config) {
                        generarExcel();
                    }
                }
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            paginationType: "input",
            sPaginationType: "full_numbers",
            language: {
                buttons: {
                    copyTitle: "Copiado al portapapeles.",
                    copySuccess: {
                        _: "Copiados %d Pensiones.",
                        1: "Copiado 1 Pensión."
                    }
                },
                searchPlaceholder: "Buscar",
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ Pensiones",
                sZeroRecords:
                    "No se encontró ningun Pensión con la Condición del Filtro",
                sEmptyTable: "Ningun Pensión Agregada aún...",
                sInfo: "Del _START_ al _END_ de un total de _TOTAL_ Pensiones",
                sInfoEmpty: "De 0 al 0 de un total de 0 Pensión",
                sInfoFiltered: "(filtrado de un total de _MAX_ Pensiones)",
                sInfoPostFix: "",
                sSearch: "",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: loadingUI(
                    "Cargando listado de Pensiones...",
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
                url: "/listar-pensiones",
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
                    data: "nombre"
                },
                {
                    data: "apellidos"
                },
                {
                    data: "nroDocumento"
                },
                {
                    data: "email"
                },
                {
                    data: "pensiones.created_at",
                    render: function(data) {
                        return moment(data).format("DD-MM-YYYY");
                    }
                },
                {
                    data: "name"
                },
                {
                    data: "action"
                }
            ],
            columnDefs: [
                {
                    width: "5%",
                    targets: 0
                },
                {
                    width: "10%",
                    targets: 1,
                    orderable: false
                },
                {
                    width: "10%",
                    targets: 2
                },
                {
                    width: "12.5%",
                    targets: 3
                },
                {
                    width: "10%",
                    targets: 4
                },
                {
                    width: "7%",
                    targets: 5,
                    className: "text-center"
                },
                {
                    width: "10%",
                    targets: 6,
                    className: "text-center"
                },
                {
                    width: "7.5%",
                    targets: 7,
                    className: "text-center"
                }
            ]
        });
    }

    $(document).on("click", "#BtnNuevo", function(event) {
        event.preventDefault();
        event.preventDefault();
        location.href = "/generar-planes/0";
        // $("#FormPensiones").each(function() {
        //     this.reset();
        // });

        // $("#title-modal").html(
        //     '<i class="fas fa-user-edit"></i> Nuevos planes Pensión.'
        // );
        // $("#divGestionarPension").attr(
        //     "style",
        //     "padding: 1em;margin-top: -2em;opacity:1"
        // );
        // $("#divPantallaPrincipal").hide();
        // $("#nombre").focus();
        // $(".errorDescripcion").remove();
    });
});
