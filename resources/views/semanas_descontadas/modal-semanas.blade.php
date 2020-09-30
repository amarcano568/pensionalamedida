<form id="FormTiposSemanas" method="post" enctype="multipart/form-data" action="actualizar-tipos-semanas" data-parsley-validate="">
    @csrf
    <div id="modal-semanas" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="title-modal"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <div class="card shadow ">
                                <div class="card-body">
                                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="historial-tab" data-toggle="tab"
                                                href="#historial" role="tab" aria-controls="historial"
                                                aria-selected="true">
                                                <i class="fas fa-info"></i>
                                                Tipo de semanas de descontadas
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <br>
                                        <input class="form-control" id="idUser" name="idUser" type="text" style="display: none;">
                                        <div class="tab-pane fade show active" id="historial" role="tabpanel"
                                            aria-labelledby="historial-tab">
                                            
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label for="idTipo">
                                                        Id
                                                    </label>
                                                    <input class="form-control" id="idTipo" name="idTipo"
                                                        type="text" placeholder="idTipo" value="">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="tipo">
                                                        Tipo
                                                    </label>
                                                    <select name="tipo" id="tipo" class="chosen-select">
                                                        <option value="fechas">Fechas</option>
                                                        <option value="semanas">Semanas</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <label for="nombre">
                                                        Nombre
                                                    </label>
                                                    <input class="form-control" id="nombre" name="nombre"
                                                        type="text" placeholder="Nombre"  data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El Nombre es requerido" required>
                                                </div>
                                            </div>
                                            <!-- /.row-->
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label for="status">
                                                        Status
                                                    </label>
                                                    <select required id="status" name="status" class="chosen-select"
                                                        data-placeholder="Seleccione un Status..." data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El Status es requerido">
                                                        <option value="1">Activo</option>
                                                        <option value="0">Inactivo</option>
                                                    </select>
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
                    <button type="submit" class="btn btn-primary btn-success">Guardar</button>
                    <button type="button" class="btn btn-secondary btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>