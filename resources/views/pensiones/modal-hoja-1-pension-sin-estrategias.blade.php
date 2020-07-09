    <div id="modal-hoja-1-pension-sin-estrategias" class="modal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="title-modal">
                        <i class="fas fa-cubes"></i>
                        Hoja 1 (pensión sin M40)</span></h5>
                    <button type="button" class="btn-cerrar-modal close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <table id="table-hoja1-1" style="display: table;width: 100%" class="table-hoja-1 table table-hover">
                                <tbody id="body-hoja1-1">
                                    <tr>
                                        <td class="table-columna1-cuantia">
                                            <i class="cil-calendar"></i> 
                                            Fecha de Nacimiento
                                        </td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-fecha-nacimiento"
                                                name="hoja-1-fecha-nacimiento" type="text" class="form-control input-xs"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">
                                            <i class="cil-calendar"></i> 
                                            Fecha del Plan
                                        </td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-fecha-plan"
                                                name="hoja-1-fecha-plan" type="text" class="form-control input-xs"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia"><i class="cil-birthday-cake"></i> Edad</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-edad" name="hoja-1-edad"
                                                type="text" class="form-control input-xs" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <table id="table-hoja1-2" style="display: table;width: 100%" class="table-hoja-1 table table-hover">
                                <tbody id="body-hoja1-2">
                                    <tr>
                                        <td class="table-columna1-cuantia"><i class="cil-calendar"></i>  Fecha de la baja</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-fecha-baja"
                                                name="hoja-1-fecha-baja" type="text" class="form-control input-xs"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia"><i class="text-success cil-plus"></i> Semanas cotizadas</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-semanas-cotizadas"
                                                name="hoja-1-semanas-cotizadas" type="text" class="form-control input-xs"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia"><i class="text-danger cil-minus"></i> Semanas descontadas</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-semanas-descontadas" name="hoja-1-semanas-descontadas"
                                                type="text" class="form-control input-xs" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia" style="font-weight: bold">Total semanas</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-total-semanas" name="hoja-1-total-semanas"
                                                type="text" class="form-control input-xs" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <table id="table-hoja1-3" style="display: table;width: 100%" class="table-hoja-1 table table-hover">
                                <tbody id="body-hoja1-3">
                                    <tr style="background-color: #EBEDEF">
                                        <td colspan="2" class="text-center table-columna1-cuantia">Tiempo faltante para pensión</td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">Retiro</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-edad-retiro"
                                                name="hoja-1-edad-retiro" type="text" class="form-control input-xs"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">Años</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-anos-retiro"
                                                name="hoja-1-anos-retiro" type="text" class="form-control input-xs"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">Meses</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-meses-retiro" name="hoja-1-meses-retiro"
                                                type="text" class="form-control input-xs" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">Semanas</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-semanas-retiro" name="hoja-1-semanas-retiro"
                                                type="text" class="form-control input-xs" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">Días</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-dias-retiro" name="hoja-1-dias-retiro"
                                                type="text" class="form-control input-xs" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <table id="table-cuantia-basica" style="display: table;width: 100%" class="table-hoja-1 table table-hover">
                                <tbody id="body-cuantia-basica">
                                    <tr style="background-color: #EBEDEF">
                                        <td colspan="2" class="text-center table-columna1-cuantia">Semanas reportadas</td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">Semanas cotizadas</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-semanas-cotizadas-2"
                                                name="hoja-1-semanas-cotizadas-2" type="text" class="form-control input-xs"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">Salario promedio</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-salario-promedio"
                                                name="hoja-1-salario-promedio" type="text" class="form-control input-xs"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">Edad</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-edad-2" name="hoja-1-edad-2"
                                                type="text" class="form-control input-xs" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <table id="table-cuantia-basica" style="display: table;width: 100%" class="table-hoja-1 table table-hover">
                                <tbody id="body-cuantia-basica">
                                    <tr style="background-color: #EBEDEF">
                                        <td colspan="2" class="text-center table-columna1-cuantia">PENSION SIN M40</td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">Mes</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-pension-mesual-sin-m40"
                                                name="hoja-1-pension-mesual-sin-m40" type="text" class="form-control input-xs"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">12 Meses</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-pension-anual-sin-m40"
                                                name="hoja-1-pension-anual-sin-m40" type="text" class="form-control input-xs"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">Aguinaldo</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-aguinaldo" name="hoja-1-aguinaldo"
                                                type="text" class="form-control input-xs" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia">Total anual</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-total-anual" name="hoja-1-total-anual"
                                                type="text" class="form-control input-xs" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="table-columna1-cuantia" id="dif-edad-85">0</td>
                                        <td class="table-columna2-cuantia"><input id="hoja-1-dif-85" name="hoja-1-dif-85"
                                                type="text" class="form-control input-xs" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cerrar-modal btn btn-secondary btn-info"
                        data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>