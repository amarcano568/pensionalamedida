    <style>
        .altoFilaTable {
            height: 1.5em;
        }
    </style>
    <div id="modal-cargar-cotizaciones" class="modal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="title-modal"><i class="cil-cloud-download"></i>
                            Cargar las cotizaciones</span></h5>
                    <button type="button" class="btn-cerrar-modal-cotizaciones close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-9 table-responsive">
                            <table id="table-cotizaciones" style="display: table;width: 100%"
                                class="table table-responsive-sm table-hover table-outline mb-0 table-xs" style="width: 100%">
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
                                        <td class="altoFilaTable">
                                            <input type="date" row="1" id="fechaDesde1"
                                                class="form-control-sm form-control fechaCotizacionDesde">
                                        </td>
                                        <td class="altoFilaTable">
                                            <input type="date" row="1" id="fechaHasta1"
                                                class="form-control-sm form-control fechaCotizacionHasta">
                                        </td>
                                        <td class="altoFilaTable">
                                            <input type="text" row="1" id="dias1"
                                                class="form-control-sm form-control diasCotizacion" readonly>
                                        </td>
                                        <td class="altoFilaTable">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="fas fa-dollar-sign"></i></span>
                                                </div>
                                                <input type="number" row="1" id="monto1"
                                                    class="form-control-sm form-control montoCotizacion" value="0">
                                            </div>
                                        </td>
                                        <td class="altoFilaTable">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="fas fa-dollar-sign"></i></span>
                                                </div>
                                                <input type="text" row="1" id="totalMontoCotizacion1"
                                                    class="form-control-sm form-control totalCotizacion" readonly>
                                            </div>

                                        </td>
                                        <td class="altoFilaTable">
                                            <a href="#" class="borrar">
                                                <i class="text-danger far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h6 class="card-title"><i class="text-primary far fa-calendar-check"></i> Días
                                        cotizados</h6>
                                    <center>
                                        <h4 id="totalDiasCotizados">0 días</h4>
                                    </center>
                                    <div id="div-dias-excedidos" style="display: none">
                                        <hr>
                                        <h6 class="card-title text-danger">
                                            <i class="fas fa-exclamation-triangle"></i> Días excedidos
                                        </h6>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 70%">
                                                        <i class="text-danger far fa-calendar-times"></i> Días cotizados
                                                    </td>
                                                    <td style="width: 30%" class="text-right">
                                                        <span class="text-danger" id="dias-cotizados"> 0</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 70%">
                                                        <i class="text-warning far fa-calendar-minus"></i> Días
                                                        excedidos
                                                    </td>
                                                    <td style="width: 30%;border-bottom: 1px solid #ddd;"
                                                        class="text-right">
                                                        <span class="text-warning" id="dias-excedidos"> 0</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 70%">
                                                        <i class="text-success far fa-calendar-check"></i> Días
                                                        aceptados
                                                    </td>
                                                    <td style="width: 30%" class="text-right">
                                                        <span class="text-success" id="dias-aceptados"> 0</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr bgcolor="#F2DEDE" style="vertical-align : middle;">
                                                    <td colspan="2" style="width: 30%" class="text-center">
                                                        <span > Salario excedido</span>
                                                    </td>
                                                    {{-- <td style="width: 30%" class="text-center">
                                                        <span class="text-danger" id="ultimo-salario"> 0</span>
                                                    </td> --}}
                                                    <td style="width: 40%;vertical-align : middle;" class="text-center">
                                                        <strong  id="salario-auxiliar"> 0</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 70%">
                                                        $ Salarios
                                                    </td>
                                                    <td style="width: 30%" class="text-right">
                                                        <span class="text-danger" id="salarios-totales"> 0</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 70%">
                                                        Días
                                                    </td>
                                                    <td style="width: 30%;border-bottom: 1px solid #ddd;"
                                                        class="text-right">
                                                        <span class="text-warning" id="dias-totales"> 0</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 70%">
                                                        Promedio salarial
                                                    </td>
                                                    <td style="width: 30%" class="text-right">
                                                        <span class="text-success" id="promedio-salarios"> 0</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <b style="color:#626262;float: left;"></b>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <a id="addFila" style="float: right;" href=""><i class="fas fa-plus"></i> Añadir nueva
                                cotización
                                (<strong class="text-info">ctrl-a</strong>)  </a>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal-subir-excel"><i class="far fa-file-excel"></i> Importar
                        desde excel</button>
                    <button type="button" class="btn btn-success" data-toggle="modal"
                    data-target="#modal-cambiar-salario"><i class="cil-list"></i>
                        Ver Tabla Salarios excedidos</button>
                    <button type="button" class="btn-cerrar-modal-cotizaciones btn btn-secondary btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>