$(document).on("ready", function() {
    var server = "";
    var pathname = document.location.pathname;
    var pathnameArray = pathname.split("/public/");
    var tituloimg = "";
    var descripcionImg = "";
    var dt_table_habitaciones = "";
    var dt_table_huespedes = ";"

    server = pathnameArray.length > 0 ? pathnameArray[0] + "/public/" : "";

    $("#filtro").chosen(ConfigChosen());

    $(document).on("change", "#filtro", function (event) {
        listarHabitaciones($(this).val());
    });

    $(".chosen-select").chosen(ConfigChosen());

    $("#migas-pan").html(
        '<ol class="breadcrumb border-0 m-0">' +
            '<li class="breadcrumb-item">Home</li>' +
            '<li class="breadcrumb-item">' +
            '<a href="#">Configuración</a></li>' +
            '<li class="breadcrumb-item active">Gestión de residencia</li>' +
            "</ol>"
    );

    listarHabitaciones();

    function listarHabitaciones() {
        destroy_existing_data_table("#table-habitaciones");
        $.fn.dataTable.ext.pager.numbers_length = 4;
        dt_table_habitaciones = $("#table-habitaciones").DataTable({
            order: [[1, "asc"]],
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
                        _: "Copiados %d Habitaciones.",
                        1: "Copiado 1 Habitación."
                    }
                },
                searchPlaceholder: "Buscar",
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ Habitaciones",
                sZeroRecords:
                    "No se encontró ningun Habitación con la Condición del Filtro",
                sEmptyTable: "Ningun Habitación Agregado aún...",
                sInfo: "Del _START_ al _END_ de un total de _TOTAL_ Habitaciones",
                sInfoEmpty: "De 0 al 0 de un total de 0 Habitación",
                sInfoFiltered: "(filtrado de un total de _MAX_ Habitaciones)",
                sInfoPostFix: "",
                sSearch: "",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: loadingUI(
                    "Cargando listado de Habitaciones...",
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
                method: "post",
                url: "listar-habitaciones",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                }
            },
            initComplete: function(settings, json) {
                $.unblockUI();
                $('[data-toggle="popover"]').popover();
            },
            columns: [                
                {
                    data: "id",                  
                },
                {
                    data: "num_habitacion"
                },
                {
                    data: "tipo"
                },
                {
                    data: "capacidad"
                },
                {
                    data: "piso"
                },
                {
                    data: "observaciones"
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
                    width: "15%",
                    targets: 2
                },
                {
                    width: "10%",
                    targets: 3
                },
                {
                    width: "10%",
                    targets: 4
                },
                {
                    width: "40%",
                    targets: 5
                },
                {
                    width: "10%",
                    targets: 6
                }
            ]
        });
    }

    $("body").on("click", "#body-habitaciones a", function(e) {
        e.preventDefault();

        accion_ok = $(this).attr("data-accion");
        id_hab = $(this).data("id-habitacion");
        nombre = $(this).data("nombre");

        switch (accion_ok) {
            case "editar-habitacion": //editar Habitación.
                $.ajax({
                    url: "editar-habitacion",
                    type: "post",
                    datatype: "json",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id_hab: id_hab
                    },
                    beforeSend: function() {
                        loadingUI("Obteniendo datos del Habitación.");
                    }
                })
                    .fail(function(statusCode, errorThrown) {
                        console.log(statusCode + " " + errorThrown);
                    })
                    .done(function(response) {
                        console.log(response.data);
                        $("#modal-habitaciones").modal('show');
                        $("#title-modal-habitaciones").html('<i class="far fa-edit"></i> Editar habitación (<strong>'+nombre+'</strong>)');
                        mobiliarios = response.data.mobiliario
                        mobiliario = mobiliarios.split('|');
                        $("#mobiliario_hab").val(mobiliario).trigger("chosen:updated");;
                        $("#id_hab").val(response.data.id);
                        $("#num_hab").val(response.data.num_habitacion);
                        $("#tipo_hab").val(response.data.tipo).trigger("chosen:updated");
                        $("#cap_hab").val(response.data.capacidad);
                        $("#pis_hab").val(response.data.piso);
                        $("#obs_hab").val(response.data.observaciones);
                        $.unblockUI();
                    });
                break;
            case "eliminar-habitacion": // Eliminar Habitación
                alertify.confirm('Habitaciones', '<h4 class="text-danger">Esta seguro de eliminar esta habitación..?</h4>', function() {
                    $.ajax({
                        url: "eliminar-habitacion",
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id_hab: id_hab,
                        },
                        beforeSend: function() {
                            loadingUI('por favor espere, se esta eliminado el hijo.');
                        }
                    }).done(function(data) {
                        console.log(data)
                        $.unblockUI();
                        if (data.success === true) {
                            alertify.success(data.message);  
                            dt_table_habitaciones.ajax.reload();                  
                        } else {
                            Pnotifica('Configuración previa..', data.message, 'error', false);
                        }               
                    }).fail(function(statusCode, errorThrown) {
                        $.unblockUI();
                        console.log(errorThrown);
                        ajaxError(statusCode, errorThrown);
                    });
        
                }, function() { // En caso de Cancelar              
                    alertify.error('Se Cancelo el proceso para eliminar la habitación.');
                }).set('labels', {
                    ok: 'Eliminar',
                    cancel: 'Cancelar'
                }).set({
                    transition: 'zoom'
                }).set({
                    modal: true,
                    closableByDimmer: false
                });
                break;
        }
    });

    $("#form-habitaciones")
        .parsley()
        .on("field:validated", function() {
            var ok = $(".parsley-error").length === 0;
            $(".bs-callout-info").toggleClass("hidden", !ok);
            $(".bs-callout-warning").toggleClass("hidden", ok);
        })
        .on("form:submit", function() {
            return true;
        });

    $("#form-habitaciones").submit(function(e) {
        e.preventDefault();
        var form = $("#form-habitaciones");
        var formData = form.serialize();
        var route = form.attr("action");
        $.ajax({
            url: route,
            type: "post",
            data: formData,
            dataType: "json",
            beforeSend: function() {
                loadingUI("Actualizando la Habitación");
            }
        })
            .done(function(response) {
                console.log(response);
                if (response.success === true) {
                    alertify.success(
                        response.message
                    );
                } else {
                    alertify.error(
                        response.message
                    );
                }
                dt_table_habitaciones.ajax.reload();
                $("#modal-habitaciones").modal("hide");
                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $(document).on("click", "#btn-nueva-habitacion", function(event) {
        event.preventDefault();
        $("#form-habitaciones").each(function() {
            this.reset();
        });
        $("#title-modal-habitaciones").html(
            '<i class="fas fa-user-edit"></i> Nueva Habitación.'
        );
        $("#modal-habitaciones").modal("show");
    });

    /** 
     *                  H U E S P E D E S 
     */
     listarHuespedes();

     function listarHuespedes() {
         destroy_existing_data_table("#table-huespedes");
         $.fn.dataTable.ext.pager.numbers_length = 4;
         dt_table_huespedes = $("#table-huespedes").DataTable({
             order: [[1, "asc"]],
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
                         _: "Copiados %d Huespedes.",
                         1: "Copiado 1 Huespede."
                     }
                 },
                 searchPlaceholder: "Buscar",
                 sProcessing: "Procesando...",
                 sLengthMenu: "Mostrar _MENU_ Huespedes",
                 sZeroRecords:
                     "No se encontró ningun Huespede con la Condición del Filtro",
                 sEmptyTable: "Ningun Huespede Agregado aún...",
                 sInfo: "Del _START_ al _END_ de un total de _TOTAL_ Huespedes",
                 sInfoEmpty: "De 0 al 0 de un total de 0 Huespede",
                 sInfoFiltered: "(filtrado de un total de _MAX_ Huespedes)",
                 sInfoPostFix: "",
                 sSearch: "",
                 sUrl: "",
                 sInfoThousands: ",",
                 sLoadingRecords: loadingUI(
                     "Cargando listado de Huespedes...",
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
                 method: "post",
                 url: "listar-huespedes",
                 data: {
                     _token: $('meta[name="csrf-token"]').attr('content')
                 }
             },
             initComplete: function(settings, json) {
                 $.unblockUI();
                 $('[data-toggle="popover"]').popover();
             },
             columns: [
                 {
                     className: "celda_de_descripcion",
                     orderable: false,
                     data: null,
                     defaultContent:
                         '<a class="botonesGraficos" href=""><i style="font-size: 20px;" class="fa fa-plus-circle text-success" aria-hidden="true"></i></a>',
                 },
                 {
                     data: "strNombre",                  
                 },
                 {
                     data: "strApellidos"
                 },
                 {
                     data: "num_habitacion"
                 },
                 {
                     data: "desde",
                     render: function(data) {
                        return moment(data).format("DD-MM-YYYY");
                    }
                 },
                 {
                     data: "hasta",
                     render: function(data) {
                        return moment(data).format("DD-MM-YYYY");
                    }
                 },
                 {
                     data: "action"
                 },
                 {
                     data: "detalle"
                 },
             ],
             columnDefs: [
                 {
                     width: "2.5%",
                     targets: 0
                 },
                 {
                     width: "5%",
                     targets: 1,
                     orderable: false
                 },
                 {
                     width: "20%",
                     targets: 2
                 },
                 {
                     width: "20%",
                     targets: 3
                 },
                 {
                     width: "10%",
                     targets: 4
                 },
                 {
                     width: "10%",
                     targets: 5,
                     className: "dt-body-center"
                 }
             ]
         });
     }
 
     var detailRows = [];
 
     $("#body-huespedes").on("click", "td.celda_de_descripcion", function (event) {
         event.preventDefault();
 
         var filaDeLaTabla = $(this).closest("tr");
         var filaComplementaria = dt_table_huespedes.row(filaDeLaTabla);
         var celdaDeIcono = $(this).closest("td.celda_de_descripcion");
 
         var tr = $(this).closest("tr");
         //console.log(tr);
         var row = dt_table_huespedes.row(tr);
         var idx = $.inArray(tr.attr("id"), detailRows);
 
         if (filaComplementaria.child.isShown()) {
             detailRows.splice(idx, 1);
             // La fila complementaria está abierta y se cierra.
             filaComplementaria.child.hide();
             celdaDeIcono.html(
                 '<a style="font-size: 20px;"  class="botonesGraficos" href=""><i class="fa fa-plus-circle text-success" aria-hidden="true"></i></a>'
             );
         } else {
             // Add to the 'open' array
             if (idx === -1) {
                 detailRows.push(tr.attr("id"));
             }
             // La fila complementaria está cerrada y se abre.
             filaComplementaria
                 .child(
                     formatearSalidaDeDatosComplementarios(
                         filaComplementaria.data(),
                         2
                     )
                 )
                 .show();
             celdaDeIcono.html(
                 '<a style="font-size: 20px;" class="botonesGraficos" href=""><i class="fa fa-minus-circle text-danger" aria-hidden="true"></i></a>'
             );
         }
     });
 
     // On each draw, loop over the `detailRows` array and show any child rows
     dt_table_huespedes.on("draw", function () {
         console.log(detailRows);
         $.each(detailRows, function (i, id) {
             //alert("open");
             $("#" + id + " td.celda_de_descripcion").trigger("click");
         });
         dt_table_huespedes.columns(7).visible(false);
     });
 
     function formatearSalidaDeDatosComplementarios(filaDelDataSet, columna) {
         var cadenaDeRetorno = "";
 
         cadenaDeRetorno += '<div class="row" style="padding-top: 0;">';
         cadenaDeRetorno +=
             '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 0;">';
         cadenaDeRetorno += filaDelDataSet["detalle"];
         cadenaDeRetorno += "</div>";
 
         return cadenaDeRetorno;
     }


     /**    
      *                 I n v e n t a r i o    M o b i l i a r i o
      */
      listarMobiliario();

      function listarMobiliario() {
          destroy_existing_data_table("#table-mobiliarios");
          $.fn.dataTable.ext.pager.numbers_length = 4;
          dt_table_mobiliarios = $("#table-mobiliarios").DataTable({
              order: [[1, "asc"]],
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
                          _: "Copiados %d Mobiliarios.",
                          1: "Copiado 1 Mobiliario."
                      }
                  },
                  searchPlaceholder: "Buscar",
                  sProcessing: "Procesando...",
                  sLengthMenu: "Mostrar _MENU_ Mobiliarios",
                  sZeroRecords:
                      "No se encontró ningun Mobiliario con la Condición del Filtro",
                  sEmptyTable: "Ningun Mobiliario Agregado aún...",
                  sInfo: "Del _START_ al _END_ de un total de _TOTAL_ Mobiliarios",
                  sInfoEmpty: "De 0 al 0 de un total de 0 Mobiliario",
                  sInfoFiltered: "(filtrado de un total de _MAX_ Mobiliarios)",
                  sInfoPostFix: "",
                  sSearch: "",
                  sUrl: "",
                  sInfoThousands: ",",
                  sLoadingRecords: loadingUI(
                      "Cargando listado de Mobiliarios...",
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
                  method: "post",
                  url: "listar-mobiliarios",
                  data: {
                      _token: $('meta[name="csrf-token"]').attr('content'),
                  }
              },
              initComplete: function(settings, json) {
                  $.unblockUI();
                  $('[data-toggle="popover"]').popover();
              },
              columns: [                
                  {
                      data: "id",                  
                  },
                  {
                      data: "tipo"
                  },
                  {
                      data: "descripcion"
                  },
                  {
                      data: "status",
                      render: function(data) {
                        estadoLabel = "";
                        if (data == "1") {
                            estadoLabel = '<span class="badge badge-success">Activo</span>';
                        } else if (data == "0") {
                            estadoLabel = '<span class="badge badge-danger">Inactivo</span>';
                        }
                        return estadoLabel;
                    }
                  },
                  {
                      data: "action"
                  }
              ],
              columnDefs: [
                  {
                      width: "10%",
                      targets: 0
                  },
                  {
                      width: "20%",
                      targets: 1,
                      orderable: false
                  },
                  {
                      width: "30%",
                      targets: 2
                  },
                  {
                      width: "10%",
                      targets: 3
                  },
                  {
                      width: "10%",
                      targets: 4
                  }
              ]
          });
      }
  
      $("body").on("click", "#body-mobiliarios a", function(e) {
          e.preventDefault();
  
          accion_ok = $(this).attr("data-accion");
          id_mobiliario = $(this).data("id-mobiliario");
          nombre = $(this).data("nombre");
          switch (accion_ok) {
              case "editar-mobiliario": //editar Mobiliario.
                  $.ajax({
                      url: "editar-mobiliario",
                      type: "post",
                      datatype: "json",
                      data: {
                          _token: $('meta[name="csrf-token"]').attr('content'),
                          id_mobiliario: id_mobiliario
                      },
                      beforeSend: function() {
                          loadingUI("Obteniendo datos del Mobiliario.");
                      }
                  })
                      .fail(function(statusCode, errorThrown) {
                          console.log(statusCode + " " + errorThrown);
                      })
                      .done(function(response) {
                          console.log(response.data);
                          $("#modal-mobiliarios").modal('show');
                          $("#title-modal-mobiliarios").html('<i class="far fa-edit"></i> Editar Mobiliario (<strong>'+nombre+'</strong>)');                      
                          $("#id_mobiliario").val(response.data.id);
                          $("#tipo_mobiliario").val(response.data.tipo).trigger("chosen:updated");
                          $("#descripcion_mobiliario").val(response.data.descripcion);
                          $("#status_mobiliario").val(response.data.status).trigger("chosen:updated");                          
                          $.unblockUI();
                      });
                  break;
              case "eliminar-mobiliario": // Eliminar Mobiliario
                  alertify.confirm('Mobiliarios', '<h4 class="text-danger">Esta seguro de eliminar este Mobiliario..?</h4>', function() {
                      $.ajax({
                          url: "eliminar-mobiliario",
                          type: 'POST',
                          data: {
                              _token: $('meta[name="csrf-token"]').attr('content'),
                              id_mobiliario: id_mobiliario,
                          },
                          beforeSend: function() {
                              loadingUI('por favor espere, se esta eliminando el mobiliario.');
                          }
                      }).done(function(data) {
                          console.log(data)
                          $.unblockUI();
                          if (data.success === true) {
                              alertify.success(data.message);  
                              dt_table_mobiliarios.ajax.reload();                  
                          } else {
                              Pnotifica('Configuración previa..', data.message, 'error', false);
                          }               
                      }).fail(function(statusCode, errorThrown) {
                          $.unblockUI();
                          console.log(errorThrown);
                          ajaxError(statusCode, errorThrown);
                      });
          
                  }, function() { // En caso de Cancelar              
                      alertify.error('Se Cancelo el proceso para eliminar la Mobiliario.');
                  }).set('labels', {
                      ok: 'Eliminar',
                      cancel: 'Cancelar'
                  }).set({
                      transition: 'zoom'
                  }).set({
                      modal: true,
                      closableByDimmer: false
                  });
                  break;
          }
      });


      $("#form-mobiliarios")
        .parsley()
        .on("field:validated", function() {
            var ok = $(".parsley-error").length === 0;
            $(".bs-callout-info").toggleClass("hidden", !ok);
            $(".bs-callout-warning").toggleClass("hidden", ok);
        })
        .on("form:submit", function() {
            return true;
        });

    $("#form-mobiliarios").submit(function(e) {
        e.preventDefault();
        var form = $("#form-mobiliarios");
        var formData = form.serialize();
        var route = form.attr("action");
        $.ajax({
            url: route,
            type: "post",
            data: formData,
            dataType: "json",
            beforeSend: function() {
                loadingUI("Actualizando el mobiliario");
            }
        })
            .done(function(response) {
                console.log(response);
                if (response.success === true) {
                    alertify.success(
                        response.message
                    );
                } else {
                    alertify.error(
                        response.message
                    );
                }
                dt_table_mobiliarios.ajax.reload();
                $("#modal-mobiliarios").modal("hide");
                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    $(document).on("click", "#btn-nuevo-mobiliario", function(event) {
        event.preventDefault();
        $("#form-mobiliarios").each(function() {
            this.reset();
        });
        $("#title-modal-mobiliarios").html(
            '<i class="fas fa-user-edit"></i> Nuevo Mobiliario.'
        );
        $("#modal-mobiliarios").modal("show");
    });
 
});

