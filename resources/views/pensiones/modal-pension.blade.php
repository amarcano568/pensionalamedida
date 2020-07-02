<form id="FormPensiones" method="post" enctype="multipart/form-data" action="actualizar-cliente" data-parsley-validate="">
    @csrf
    <div id="modal-planes-pension" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="title-modal"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row"  id="divVentanaDatos">
                        <div class="col-sm-12">
                            <div class="card shadow ">
                                <div class="card-body" style="height: 7.5em;">
                                    <input class="form-control" id="idCliente" name="idCliente" type="text"
                                        style="display: none">
                                    <div class="tab-pane fade show active" id="historial" role="tabpanel"
                                        aria-labelledby="historial-tab">
                                        <div class="row">
                                            
                                            <div class="form-group col-sm-4">
                                                <input class="cliente-seeker form-control" id="nombreCliente" name="nombreCliente" type="text"
                                                    placeholder="Comienze a escribir para buscar un cliente" style="width: 165%;">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <div class="card shadow ">
                                                    <div class="card-body" style="height: 6em;margin-top: -1em;" id="datosComplementarios">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <div class="card shadow ">
                                                    <div class="card-body" style="padding-top: 1.5em;height: 6em;margin-top: -1em;" id="datosComplementarios">
                                                        <button class="btn btn-sm btn-outline-success" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Agregar nuevo cliente."> 
                                                            <i class="cil-user-plus"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-warning" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Enviar resumen de planes."> 
                                                            <i class="far fa-envelope"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-info" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Enviar detalle de planes."> 
                                                            <i class="far fa-envelope"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-danger" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Generar pdf."> 
                                                            <i class="far fa-file-pdf"></i>
                                                        </button>
                                                        
                                                       
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
                <button type="submit" class="btn btn-primary btn-success"><i class="cil-save"></i> Guardar</button>
                <button type="button" class="btn btn-secondary btn-info" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    </div>
</form>