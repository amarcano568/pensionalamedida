<form id="form-mobiliarios" method="post" enctype="multipart/form-data" action="actualizar-mobiliarios" data-parsley-validate="">
    @csrf
    <div id="modal-mobiliarios" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="title-modal-mobiliarios"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="row">
                       <div class="col-sm-6">
                        <div class="form-group">
                            <label for="num_hab">
                                Id
                            </label>
                            <input class="form-control" id="id_mobiliario" name="id_mobiliario" type="text" readonly>
                        </div>
                       </div>
                       <div class="col-sm-6">
                        <label for="num_hab">
                            Tipo
                        </label>
                           <select name="tipo_mobiliario" id="tipo_mobiliario" class="form-control chosen-select">
                               <option value="tv">tv</option>
                               <option value="silla">silla</option>
                               <option value="camara">camara</option>
                               <option value="lampara">lampara</option>
                               <option value="sabana">sabana</option>
                           </select>
                       </div>
                   </div>
                   <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="num_hab">
                                    Descripción
                                </label>
                                <input class="form-control" id="descripcion_mobiliario" name="descripcion_mobiliario" type="text"
                                    placeholder="Descripción del mobiliario" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="num_hab">
                                Status
                            </label>
                            <select name="status_mobiliario" id="status_mobiliario" class="form-control chosen-select">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-success">Guardar</button>
                    <button type="button" class="btn btn-secondary btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>