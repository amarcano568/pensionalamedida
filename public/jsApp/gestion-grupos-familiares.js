$(document).on("ready", function() {
    
    $(".chosen-select").chosen(ConfigChosen());

    listar_grupos_familiares();

    function listar_grupos_familiares(){
        $.ajax({
            url: "listar-grupos-familiares",
            type: "post",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            beforeSend: function() {
                loadingUI("Listando grupos familiares...");
            },
            dataType: "json"
        })
            .done(function(response) {
                // console.log();
                $("#listado-grupos-familiares").html(response.data);
                $('[data-toggle="tooltip"]').tooltip();
                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    }

    $(document).on("click", ".eliminar-grupo-familiar", function(event) {
        event.preventDefault();
        var uuid = $(this).data('uuid');
        alertify.confirm('Grupo familiar', '<h4 class="text-danger">Esta seguro de eliminar este grupo..?</h4>', function() {
            $.ajax({
                url: "eliminar-grupo-familiar",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    uuid: uuid
                },
                beforeSend: function() {
                    loadingUI('por favor espere, se esta eliminado este grupo.');
                }
            }).done(function(data) {
                console.log(data)
                $.unblockUI();
                if (data.success === true) {
                    alertify.success(data.message);
                    listar_grupos_familiares();
                } else {
                    Pnotifica('Configuración previa..', data.message, 'error', false);
                }               
            }).fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });

        }, function() { // En caso de Cancelar              
            alertify.error('Se Cancelo el Proceso para eliminar el grupo.');
        }).set('labels', {
            ok: 'Eliminar',
            cancel: 'Cancelar'
        }).set({
            transition: 'zoom'
        }).set({
            modal: true,
            closableByDimmer: false
        });
    });

    $(document).on("click", ".editar-grupo-familiar", function(event) {
        event.preventDefault();
        var uuid = $(this).data('uuid');
        
        $.ajax({
            url: "editar-grupo-familiar",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                uuid: uuid
            },
            beforeSend: function() {
                loadingUI('por favor espere, se esta eliminado este grupo.');
            }
        }).done(function(response) {
            console.log(response)
            $.unblockUI();
            $("#title-modal").html('<h5>Editar grupo familiar</h5>');
            $("#div-table-hijos").show();
            $("#datos-hijo").show();
            $("#btn-guardar-grupo-familiar").show();
            $("#btn-guardar-nuevo-grupo-familiar").hide();      
            $("#modal-grupo-familiar").modal('show'); 
            $("#uuid_grupo_familiar").val(response.grupo.uuid);
            $("#select-padre").val(response.padres.padre).trigger("chosen:updated");
            $("#select-madre").val(response.padres.madre).trigger("chosen:updated");
            $("#body-hijo").html(response.table);
            // $("#select-padre").html(response.select_padre)
            // $("#select-madre").html(response.select_madre)
            // $(".chosen-select").chosen(ConfigChosen());
                     
        }).fail(function(statusCode, errorThrown) {
            $.unblockUI();
            console.log(errorThrown);
            ajaxError(statusCode, errorThrown);
        });

    });

    $("#form-hijos")
        .parsley()
        .on("field:validated", function() {
            var ok = $(".parsley-error").length === 0;
            $(".bs-callout-info").toggleClass("hidden", !ok);
            $(".bs-callout-warning").toggleClass("hidden", ok);
        })
        .on("form:submit", function() {
            return true;
        });

    $("#form-hijos").submit(function(e) {
        e.preventDefault();
        var form = $("#form-hijos");
        var formData = form.serialize();
        var route = form.attr("action");
        $.ajax({
            url: route,
            type: "post",
            data: formData,
            dataType: "json",
            beforeSend: function() {
                loadingUI("Guardando hijo");
            }
        })
            .done(function(response) {
                console.log(response);
                if (response.success === true) {
                    alertify.success(response.message);
                    uuid = $("#uuid_grupo_familiar").val();
                    cargaTable(uuid);
                } else {
                    alertify.error(respons.message);
                }
                $.unblockUI();
            })
            .fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });
    });

    function cargaTable(uuid){
        $.ajax({
            url: "editar-grupo-familiar",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                uuid: uuid
            }
        }).done(function(response) {
            $("#body-hijo").html(response.table);            
        }).fail(function(statusCode, errorThrown) {
            console.log(errorThrown);
            ajaxError(statusCode, errorThrown);
        });
    }
    
    $(document).on("click", ".delete-hijo", function(event) {
        event.preventDefault();
        idHijo = $(this).data('id');
        uuid = $("#uuid_grupo_familiar").val();
        alertify.confirm('Hijo', '<h4 class="text-danger">Esta seguro de eliminar este hijo..?</h4>', function() {
            $.ajax({
                url: "eliminar-hijo",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    idHijo: idHijo,
                    uuid: uuid,
                },
                beforeSend: function() {
                    loadingUI('por favor espere, se esta eliminado el hijo.');
                }
            }).done(function(data) {
                console.log(data)
                $.unblockUI();
                if (data.success === true) {
                    alertify.success(data.message);                    
                    cargaTable(uuid);
                } else {
                    Pnotifica('Configuración previa..', data.message, 'error', false);
                }               
            }).fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });

        }, function() { // En caso de Cancelar              
            alertify.error('Se Cancelo el Proceso para eliminar el hijo.');
        }).set('labels', {
            ok: 'Eliminar',
            cancel: 'Cancelar'
        }).set({
            transition: 'zoom'
        }).set({
            modal: true,
            closableByDimmer: false
        });
    });
    
    
    $(document).on("click", "#btn-guardar-grupo-familiar, #btn-guardar-nuevo-grupo-familiar", function(event) {
        event.preventDefault();
        uuid = $("#uuid_grupo_familiar").val();
        padre = $("#select-padre").val(); 
        madre = $("#select-madre").val(); 
            $.ajax({
                url: "guardar-grupo-familiar",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    padre: padre,
                    madre: madre,
                    uuid: uuid,
                },
                beforeSend: function() {
                    loadingUI('Guardar grupo familiar.');
                }
            }).done(function(data) {
                console.log(data)
                $.unblockUI();
                if (data.success === true) {
                    alertify.success(data.message);                    
                    listar_grupos_familiares();
                } else {
                    Pnotifica('Grupo familiar..', data.message, 'error', false);
                }   
                $("#modal-grupo-familiar").modal('hide');             
            }).fail(function(statusCode, errorThrown) {
                $.unblockUI();
                console.log(errorThrown);
                ajaxError(statusCode, errorThrown);
            });

        });

        
        $(document).on("click", "#btn-crear-nuevo-grupo-familiar", function(event) {
            event.preventDefault();
            $("#div-table-hijos").hide(); 
            $("#datos-hijo").hide();
            $("#btn-guardar-grupo-familiar").hide();
            $("#btn-guardar-nuevo-grupo-familiar").show();     
            $("#title-modal").html('<h5>Crear nuevo grupo familiar</h5>');
            $("#modal-grupo-familiar").modal('show');  
            $("#select-padre").val('').trigger("chosen:updated");
            $("#select-madre").val('').trigger("chosen:updated"); 
            $("#uuid_grupo_familiar").val('');
        });              

});
