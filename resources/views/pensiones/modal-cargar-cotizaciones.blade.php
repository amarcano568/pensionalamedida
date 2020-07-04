    <div id="modal-cargar-cotizaciones" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="title-modal"><i class="cil-cloud-download"></i>
                            Cargar las cotizaciones</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-9 table-responsive">
                            <table id="table-cotizaciones" style="display: table;width: 100%" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">Del</th>
                                        <th class="text-center">Al</th>
                                        <th class="text-center">Días</th>
                                        <th class="text-center">Monto</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="body-cotizaciones">
                                    <tr class="row2" id="1">
                                        <td><input type="date" row="1" id="fechaDesde1" class="form-control fechaCotizacionDesde" ></td>
                                        <td><input type="date" row="1" id="fechaHasta1" class="form-control fechaCotizacionHasta"></td>
                                        <td><input type="text" row="1" id="dias1" class="form-control diasCotizacion" readonly></td>
                                        <td><input type="number" row="1" id="monto1" class="form-control montoCotizacion" value="0"></td>
                                        <td><input type="text" row="1" id="totalMontoCotizacion1" class="form-control" readonly></td>
                                        <td><a href="#" class="borrar"><i class="text-danger far fa-trash-alt"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-3">
                            <div class="card shadow" style="height: 7em;">
                                <div class="card-body">
                                    <h6 class="card-title"><i class="cil-calendar-check"></i> Días cotizados</h6>
                                    <center>
                                        <h4 id="totalDiasCotizados">0 días</h4>
                                    </center>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <b style="color:#626262;float: left;"></b>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <a id="addFila" style="float: right;" href=""><i class="fas fa-plus"></i> Añadir nueva cotización
                                (<strong class="text-info">ctrl-a</strong>)  </a>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-promary"><i class="far fa-file-excel"></i> Importar desde excel</button>
                    {{-- <button type="button" class="btn btn-primary btn-success"><i class="cil-save"></i> Guardar</button> --}}
                    <button type="button" class="btn btn-secondary btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>