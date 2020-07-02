<form id="FormRole" method="post" enctype="multipart/form-data" action="nuevo-role" data-parsley-validate="">
    @csrf
    <div id="modal-role-new" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row" id="divNuevoRol">
                        <div class="col-sm-12" style="padding-left: 2em;">
                            <div class="card shadow ">
                                <div class="card-header">
                                    <h4>
                                        <svg class="c-icon mr-2 c-icon-2xl">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-shield-alt"></use>
                                        </svg>
                                        <strong>
                                            CREAR UN NUEVO ROLE.
                                        </strong>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="card shadow ">
                                                <div class="card-body">
                
                                                        <div class="form-group">
                                                            <label for="newRole">
                                                                <i class="cil-shield-alt"></i> Nuevo rol
                                                            </label>
                                                            <input class="form-control" id="newRole" name="newRole" type="text"
                                                                placeholder="Nuevo rol" required data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El nombre del Rol es requerido."  data-parsley-length="[4, 100]" data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Mínimo cuatro (4) caracteres y máximo cien (100).">
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-success"><i class="cil-save"></i>
                         Guardar</button>
                    <button type="button" class="btn btn-secondary btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>