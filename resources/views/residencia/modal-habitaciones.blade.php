<form id="form-habitaciones" method="post" enctype="multipart/form-data" action="actualizar-habitaciones" data-parsley-validate="">
    @csrf
    <div id="modal-habitaciones" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="title-modal-habitaciones"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" id="id_hab" name="id_hab" type="text" style="display: none;">
                   <div class="row">
                       <div class="col-sm-6">
                        <div class="form-group">
                            <label for="num_hab">
                                Número de habitación
                            </label>
                            <input class="form-control" id="num_hab" name="num_hab" type="text"
                                placeholder="Número de habitación" required>
                        </div>
                       </div>
                       <div class="col-sm-6">
                        <label for="num_hab">
                            Tipo de habitación
                        </label>
                           <select name="tipo_hab" id="tipo_hab" class="form-control chosen-select">
                               <option value="Individual">Individual</option>
                               <option value="Doble">Doble</option>
                               <option value="Cuadruple">Cuádruple</option>
                           </select>
                       </div>
                   </div>
                   <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="num_hab">
                                    Capacidad de persona por habitación
                                </label>
                                <input class="form-control" id="cap_hab" name="cap_hab" type="number"
                                    placeholder="Capacidad de persona por habitación" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="num_hab">
                                Piso donde se encuentra la habitación
                            </label>
                            <input class="form-control" id="pis_hab" name="pis_hab" type="text"
                            placeholder="Piso donde se encuentra la habitación" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="observaciones">
                                    Mobiliarios
                                </label>
                                <select data-placeholder="Seleccione el mobiliario para esta habitación..." multiple name="mobiliario_hab[]" id="mobiliario_hab" class="form-control chosen-select">
                                    <option value=""></option>
                                    @foreach ($mobiliarios as $mobiliario)
                                        <option value="{{ $mobiliario->id }}">{{ $mobiliario->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                       
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="observaciones">
                                    Observaciones
                                </label>
                                <textarea name="obs_hab" id="obs_hab" rows="3" class="form-control"></textarea>
                            </div>
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