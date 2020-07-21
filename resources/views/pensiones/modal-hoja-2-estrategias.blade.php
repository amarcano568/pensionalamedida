
<div id="modal-hoja-2-estrategias" class="modal" tabindex="-1" role="dialog" data-backdrop="static"
data-keyboard="false">
<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><span id="title-modal">
                    <i class="fas fa-cubes"></i>
                    Estrategias 2</span></h5>
            <button type="button" class="btn-cerrar-modal close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <table id="table-hoja1-1" style="display: table;width: 100%"
                        class="table-hoja-2 table table-hover">
                        <tbody id="body-hoja1-1">
                            <tr>
                                <td style="width: 60%">
                                    <i class="cil-calendar"></i>
                                    Fecha de Nacimiento
                                </td>
                                <td style="width: 40%"><input id="hoja-2-fecha-nacimiento"
                                        name="hoja-2-fecha-nacimiento" type="text" class="form-control input-xs"
                                        readonly></td>
                            </tr>
                            <tr>
                                <td style="width: 60%">
                                    <i class="cil-calendar"></i>
                                    Fecha del Plan
                                </td>
                                <td style="width: 40%"><input id="hoja-2-fecha-plan"
                                        name="hoja-2-fecha-plan" type="text" class="form-control input-xs"
                                        readonly></td>
                            </tr>
                            <tr>
                                <td style="width: 60%"><i class="cil-birthday-cake"></i> Edad</td>
                                <td style="width: 40%"><input id="hoja-2-edad" name="hoja-2-edad"
                                        type="text" class="form-control input-xs" readonly></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6">
                    <table id="table-hoja1-2" style="display: table;width: 100%"
                        class="table-hoja-2 table table-hover">
                        <tbody id="body-hoja1-2">
                            <tr>
                                <td class="table-columna1-cuantia"><i class="cil-calendar"></i> Fecha de la baja
                                </td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-fecha-baja"
                                        name="hoja-2-fecha-baja" type="text" class="form-control input-xs"
                                        readonly></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia"><i class="text-success cil-plus"></i> Semanas
                                    cotizadas</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-semanas-cotizadas"
                                        name="hoja-2-semanas-cotizadas" type="text"
                                        class="form-control input-xs" readonly></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia"><i class="text-danger cil-minus"></i> Semanas
                                    descontadas</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-semanas-descontadas"
                                        name="hoja-2-semanas-descontadas" type="text"
                                        class="form-control input-xs" readonly></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia" style="font-weight: bold">Total semanas</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-total-semanas"
                                        name="hoja-2-total-semanas" type="text" class="form-control input-xs"
                                        readonly></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <table id="table-hoja1-3" style="display: table;width: 100%"
                        class="table-hoja-2 table table-hover">
                        <tbody id="body-hoja1-3">
                            <tr style="background-color: #EBEDEF">
                                <td colspan="2" class="text-center table-columna1-cuantia">Tiempo faltante para
                                    pensión</td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Retiro</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-edad-retiro"
                                        name="hoja-2-edad-retiro" type="text" class="form-control input-xs"
                                        readonly></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Años</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-anos-retiro"
                                        name="hoja-2-anos-retiro" type="text" class="form-control input-xs"
                                        readonly></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Meses</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-meses-retiro"
                                        name="hoja-2-meses-retiro" type="text" class="form-control input-xs"
                                        readonly></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Semanas</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-semanas-retiro"
                                        name="hoja-2-semanas-retiro" type="text" class="form-control input-xs"
                                        readonly></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Días</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-dias-retiro"
                                        name="hoja-2-dias-retiro" type="text" class="form-control input-xs"
                                        readonly></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                    <table id="table-cuantia-basica" style="display: table;width: 100%"
                        class="table-hoja-2 table table-hover">
                        <tbody id="body-cuantia-basica">
                            <tr style="background-color: #EBEDEF">
                                <td colspan="3" class="text-center table-columna1-cuantia">Expectativas</td>
                            </tr>
                            <tr>
                                <td style="width: 33%">Edades</td>
                                <td style="width: 33%">
                                    <input id="hoja-2-edad-desde" name="hoja-2-edad-desde" type="text" class="form-control input-xs" readonly>
                                </td>
                                <td style="width: 33%">
                                    <input id="hoja-2-edad-hasta" name="hoja-2-edad-hasta" type="text" class="form-control input-xs" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 33%">Monto Pensión</td>
                                <td style="width: 33%">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-2-monto-pension-desde" name="hoja-2-monto-pension-desde" type="text" class="form-control input-xs"
                                        readonly>
                                    </div>                                    
                                </td>
                                <td style="width: 33%">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-2-monto-pension-hasta"
                                        name="hoja-2-monto-pension-hasta" type="text" class="form-control input-xs"
                                        readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 33%">Pagos</td>
                                <td style="width: 33%">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-2-pagos-desde"
                                        name="hoja-2-pagos-desde" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                                <td style="width: 33%">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-2-pagos-hasta"
                                        name="hoja-2-pagos-hasta" type="text" class="form-control input-xs" readonly>
                                    </div>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                    <label for="">Edad para el calculo de pensión</label>
                   <select name="hoja-2-edad-calculo-pension" id="hoja-2-edad-calculo-pension" class="chosen-select">

                   </select>
                </div>
                
            </div>

            <div class="x_panel" >
                <div estrategia="1" class="x_title">
                    <h6 style="cursor: pointer" class="collapse-link"><i class="far fa-edit"></i> 1.- EN SU EMPRESA ACTUAL (PARA DAR TIEMPO A GESTIONAR SU BAJA)</h6>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div estrategia="1" class="x_content" style="display: block;" id="hoja-2-x_content-1">
                    <table id="hoja-2-table-estrategia-1" style="display: table;width: 100%" class="table table-xs">
                        <tbody id="hoja-2-body-estrategia-1">
                            <tr style="background-color: #EBEDEF">
                                <td style="width: 10%" class="text-center">Desde</td>
                                <td style="width: 10%" class="text-center">Hasta <a href=""><i sumaDias="#hoja-2-sumas-dias-estrategia-1" class="addDayEstrategias fas fa-plus-circle"></i></a></td>
                                <td style="width: 10%" class="text-center">Edad</td>
                                <td style="width: 10%" class="text-center">Años</td>
                                <td style="width: 10%" class="text-center">Meses</td>
                                <td style="width: 10%" class="text-center">Semanas</td>
                                <td style="width: 10%" class="text-center">Días</td>
                                <td style="width: 10%" class="text-center">SBC</td>
                                <td style="width: 10%" class="text-center">Total</td>
                                <td style="width: 10%" class="text-center">Costo</td>
                            </tr>
                            <tr>
                                <td style="width: 10%" class="text-center"><input id="hoja-2-fecha-desde-estrategia-1" name="hoja-2-fecha-desde-estrategia-1" type="date" class="form-control input-xs hoja-2-fecha-desde-estrategia" estrategia="1" ></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="row" style="display: none" id="hoja-2-sumas-dias-estrategia-1">
                                        <div class="col-sm-9">
                                            <input id="hoja-2-entrada-dias-estrategia-1" type="text" class="form-control input-xs" style="width: 130%">
                                        </div>
                                        <div class="col-sm-3 float-left">
                                            <a href=""><i id="1" desdefecha="#hoja-2-fecha-desde-estrategia-1" fecha="#hoja-2-fecha-hasta-estrategia-1" elemento="#hoja-2-entrada-dias-estrategia-1" class="OksumarDias text-success cil-check"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <input id="hoja-2-fecha-hasta-estrategia-1" name="hoja-2-fecha-hasta-estrategia-1" type="date" class="form-control input-xs" readonly>
                                </td>
                                <td style="width: 10%" class="text-center"><input estrategia="1" id="hoja-2-edad-estrategia-1" name="hoja-2-edad-estrategia-1" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="1" id="hoja-2-anos-estrategia-1" name="hoja-2-anos-estrategia-1" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="1" id="hoja-2-meses-estrategia-1" name="hoja-2-meses-estrategia-1" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="1" id="hoja-2-semanas-estrategia-1" name="hoja-2-semanas-estrategia-1" type="text" class="form-control input-xs semanas-cotizadas-estrategia" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="1" id="hoja-2-dias-estrategia-1" name="hoja-2-dias-estrategia-1" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="1" id="hoja-2-sbc-estrategia-1" name="hoja-2-sbc-estrategia-1" type="number" class="sbc-monto-estrategia form-control input-xs">
                                    </div>                                    
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="1" id="hoja-2-total-estrategia-1" name="hoja-2-total-estrategia-1" type="text" class="form-control input-xs" readonly>
                                    </div>                                     
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="1" id="hoja-2-costo-estrategia-1" name="hoja-2-costo-estrategia-1" type="text" class="form-control input-xs" readonly>
                                    </div>                                
                                </td>
                            </tr>
                            <tr style="background-color: #EBEDEF">
                                <td><a href=""><i estrategia="1" class="delete-estrategia-hoja2 text-danger far fa-trash-alt"></i></a></td>
                                <td colspan="8" style="width: 10%" class="text-center"></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input type="text" class="form-control input-xs" readonly id="hoja-2-otro-valor-estrategia-1" value="0">
                                    </div>                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="x_panel">
                <div estrategia="2" class="x_title">
                    <h6 style="cursor: pointer" class="collapse-link"><i class="far fa-edit"></i> 2.- COOPERATIVA (PARA GENERAR UNA VIGENCIA SÓLIDA FUTURA)</h6>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div estrategia="2" class="x_content" style="display: block;" id="hoja-2-x_content-2">
                    <table id="hoja-2-table-estrategia-2" style="display: table;width: 100%" class="table table-xs">
                        <tbody id="body-estrategia-2">
                            <tr style="background-color: #EBEDEF">
                                <td style="width: 10%" class="text-center">Desde</td>
                                <td style="width: 10%" class="text-center">Hasta <a href=""><i sumaDias="#hoja-2-sumas-dias-estrategia-2" class="addDayEstrategias fas fa-plus-circle"></i></a></td>
                                <td style="width: 10%" class="text-center">Edad</td>
                                <td style="width: 10%" class="text-center">Años</td>
                                <td style="width: 10%" class="text-center">Meses</td>
                                <td style="width: 10%" class="text-center">Semanas</td>
                                <td style="width: 10%" class="text-center">Días</td>
                                <td style="width: 10%" class="text-center">SBC</td>
                                <td style="width: 10%" class="text-center">Total</td>
                                <td style="width: 10%" class="text-center">Costo</td>
                            </tr>
                            <tr>
                                <td style="width: 10%" class="text-center"><input estrategia="2" id="hoja-2-fecha-desde-estrategia-2" name="hoja-2-fecha-desde-estrategia-1" type="date" class="form-control input-xs hoja-2-fecha-desde-estrategia" estrategia="1" ></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="row" style="display: none" id="hoja-2-sumas-dias-estrategia-2">
                                        <div class="col-sm-9">
                                            <input id="hoja-2-entrada-dias-estrategia-2" type="text" class="form-control input-xs" style="width: 130%">
                                        </div>
                                        <div class="col-sm-3 float-left">
                                            <a href=""><i id="2" desdefecha="#hoja-2-fecha-desde-estrategia-2" fecha="#hoja-2-fecha-hasta-estrategia-2" elemento="#hoja-2-entrada-dias-estrategia-2" class="OksumarDias text-success cil-check"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <input id="hoja-2-fecha-hasta-estrategia-2" name="hoja-2-fecha-hasta-estrategia-2" type="date" class="form-control input-xs" readonly>
                                </td>
                                <td style="width: 10%" class="text-center"><input estrategia="2" id="hoja-2-edad-estrategia-2" name="hoja-2-edad-estrategia-2" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="2" id="hoja-2-anos-estrategia-2" name="hoja-2-anos-estrategia-2" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="2" id="hoja-2-meses-estrategia-2" name="hoja-2-meses-estrategia-2" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="2" id="hoja-2-semanas-estrategia-2" name="hoja-2-semanas-estrategia-2" type="text" class="form-control input-xs semanas-cotizadas-estrategia" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="2" id="hoja-2-dias-estrategia-2" name="hoja-2-dias-estrategia-2" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="2" id="hoja-2-sbc-estrategia-2" name="hoja-2-sbc-estrategia-2" type="number" class="form-control input-xs sbc-monto-estrategia">
                                    </div>                                    
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="2" id="hoja-2-total-estrategia-2" name="hoja-2-total-estrategia-1" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="2" id="hoja-2-costo-estrategia-2" name="hoja-2-costo-estrategia-1" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                            </tr>
                            <tr style="background-color: #EBEDEF">
                                <td><a href=""><i estrategia="2" class="delete-estrategia-hoja2 text-danger far fa-trash-alt"></i></a></td>
                                <td colspan="3" style="width: 10%" class="text-center"></td>
                                <td colspan="3" class="text-right">Inscripción costo</td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="2" id="hoja-2-inscripcion-cooperativa-estrategia-2" name="hoja-2-inscripcion-cooperativa-estrategia-1" type="text" class="form-control input-xs" value="0">
                                    </div>                                    
                                </td>
                                <td></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-2-otro-valor-estrategia-2" name="hoja-2-otro-valor-estrategia-2" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="x_panel">
                <div estrategia="3" class="x_title">
                    <h6 style="cursor: pointer" class="collapse-link"><i class="far fa-edit"></i> 3.- M40 - RETROACTIVO (PARA RECUPERAR SEMANAS ANTERIORES)</h6>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div estrategia="3" class="x_content" style="display: block;" id="hoja-2-x_content-3">
                    <table id="hoja-2-table-estrategia-3" style="display: table;width: 100%" class="table table-xs">
                        <tbody id="hoja-2-body-estrategia-3">
                            <tr style="background-color: #EBEDEF">
                                <td style="width: 10%" class="text-center">Desde</td>
                                <td style="width: 10%" class="text-center">Hasta <a href=""><i sumaDias="#hoja-2-sumas-dias-estrategia-3" class="addDayEstrategias fas fa-plus-circle"></i></a></td>
                                <td style="width: 10%" class="text-center">Edad</td>
                                <td style="width: 10%" class="text-center">Años</td>
                                <td style="width: 10%" class="text-center">Meses</td>
                                <td style="width: 10%" class="text-center">Semanas</td>
                                <td style="width: 10%" class="text-center">Días</td>
                                <td style="width: 10%" class="text-center">SBC</td>
                                <td style="width: 10%" class="text-center">Total</td>
                                <td style="width: 10%" class="text-center">Costo</td>
                            </tr>
                            <tr>
                                <td style="width: 10%" class="text-center"><input estrategia="3" id="hoja-2-fecha-desde-estrategia-3" name="hoja-2-fecha-desde-estrategia-1" type="date" class="form-control input-xs hoja-2-fecha-desde-estrategia" estrategia="1" ></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="row" style="display: none" id="hoja-2-sumas-dias-estrategia-3">
                                        <div class="col-sm-9">
                                            <input id="hoja-2-entrada-dias-estrategia-3" type="text" class="form-control input-xs" style="width: 130%">
                                        </div>
                                        <div class="col-sm-3 float-left">
                                            <a href=""><i id="3" desdefecha="#hoja-2-fecha-desde-estrategia-3" fecha="#hoja-2-fecha-hasta-estrategia-3" elemento="#hoja-2-entrada-dias-estrategia-3" class="OksumarDias text-success cil-check"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <input id="hoja-2-fecha-hasta-estrategia-3" name="hoja-2-fecha-hasta-estrategia-3" type="date" class="form-control input-xs" readonly>
                                </td>
                                <td style="width: 10%" class="text-center"><input estrategia="3" id="hoja-2-edad-estrategia-3" name="hoja-2-edad-estrategia-3" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="3" id="hoja-2-anos-estrategia-3" name="hoja-2-anos-estrategia-3" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="3" id="hoja-2-meses-estrategia-3" name="hoja-2-meses-estrategia-3" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="3" id="hoja-2-semanas-estrategia-3" name="hoja-2-semanas-estrategia-3" type="text" class="form-control input-xs semanas-cotizadas-estrategia" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="3" id="hoja-2-dias-estrategia-3" name="hoja-2-dias-estrategia-3" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="3" id="hoja-2-sbc-estrategia-3" name="hoja-2-sbc-estrategia-3" type="number" class="form-control input-xs sbc-monto-estrategia">
                                    </div>                                    
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="3" id="hoja-2-total-estrategia-3" name="hoja-2-total-estrategia-1" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="3" id="hoja-2-costo-estrategia-3" name="hoja-2-costo-estrategia-1" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                            </tr>
                            <tr style="background-color: #EBEDEF">
                                <td><a href=""><i estrategia="3" class="delete-estrategia-hoja2 text-danger far fa-trash-alt"></i></a></td>
                                <td colspan="8" style="width: 10%" class="text-center"></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-2-otro-valor-estrategia-3" name="hoja-2-otro-valor-estrategia-3" type="text" class="form-control input-xs" readonly>
                                    </div>                                     
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="x_panel">
                <div estrategia="4" class="x_title">
                    <h6 style="cursor: pointer" class="collapse-link"><i class="far fa-edit"></i> 4.- M40 - YA PAGADA (PARA RECUPERAR SEMANAS ANTERIORES)</h6>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div estrategia="4" class="x_content" style="display: block;" id="hoja-2-x_content-4">
                    <table id="hoja-2-table-estrategia-4" style="display: table;width: 100%" class="table table-xs">
                        <tbody id="hoja-2-body-estrategia-4">
                            <tr style="background-color: #EBEDEF">
                                <td style="width: 10%" class="text-center">Desde</td>
                                <td style="width: 10%" class="text-center">Hasta <a href=""><i sumaDias="#hoja-2-sumas-dias-estrategia-4" class="addDayEstrategias fas fa-plus-circle"></i></a></td>
                                <td style="width: 10%" class="text-center">Edad</td>
                                <td style="width: 10%" class="text-center">Años</td>
                                <td style="width: 10%" class="text-center">Meses</td>
                                <td style="width: 10%" class="text-center">Semanas</td>
                                <td style="width: 10%" class="text-center">Días</td>
                                <td style="width: 10%" class="text-center">SBC</td>
                                <td style="width: 10%" class="text-center">Total</td>
                                <td style="width: 10%" class="text-center">Costo</td>
                            </tr>
                            <tr>
                                <td style="width: 10%" class="text-center"><input estrategia="4" id="hoja-2-fecha-desde-estrategia-4" name="hoja-2-fecha-desde-estrategia-1" type="date" class="form-control input-xs hoja-2-fecha-desde-estrategia" estrategia="1" ></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="row" style="display: none" id="hoja-2-sumas-dias-estrategia-4">
                                        <div class="col-sm-9">
                                            <input id="hoja-2-entrada-dias-estrategia-4" type="text" class="form-control input-xs" style="width: 130%">
                                        </div>
                                        <div class="col-sm-3 float-left">
                                            <a href=""><i id="4" desdefecha="#hoja-2-fecha-desde-estrategia-4" fecha="#hoja-2-fecha-hasta-estrategia-4" elemento="#hoja-2-entrada-dias-estrategia-4" class="OksumarDias text-success cil-check"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <input id="hoja-2-fecha-hasta-estrategia-4" name="hoja-2-fecha-hasta-estrategia-4" type="date" class="form-control input-xs" readonly>
                                </td>
                                <td style="width: 10%" class="text-center"><input estrategia="4" id="hoja-2-edad-estrategia-4" name="hoja-2-edad-estrategia-4" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="4" id="hoja-2-anos-estrategia-4" name="hoja-2-anos-estrategia-4" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="4" id="hoja-2-meses-estrategia-4" name="hoja-2-meses-estrategia-4" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="4" id="hoja-2-semanas-estrategia-4" name="hoja-2-semanas-estrategia-4" type="text" class="form-control input-xs semanas-cotizadas-estrategia" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="4" id="hoja-2-dias-estrategia-4" name="hoja-2-dias-estrategia-4" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="4" id="hoja-2-sbc-estrategia-4" name="hoja-2-sbc-estrategia-4" type="number" class="form-control input-xs sbc-monto-estrategia">
                                    </div>
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="4" id="hoja-2-total-estrategia-4" name="hoja-2-total-estrategia-1" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="4" id="hoja-2-costo-estrategia-4" name="hoja-2-costo-estrategia-1" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                            </tr>
                            <tr style="background-color: #EBEDEF">
                                <td><a href=""><i estrategia="4" class="delete-estrategia-hoja2 text-danger far fa-trash-alt"></i></a></td>
                                <td colspan="8" style="width: 10%" class="text-center"></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-2-otro-valor-estrategia-4" name="hoja-2-otro-valor-estrategia-4" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="x_panel">
                <div estrategia="5" class="x_title">
                    <h6 style="cursor: pointer" class="collapse-link"><i class="far fa-edit"></i> 5.- M40 BARATA (PARA SUMAR SEMANAS A PRECIO BAJO)</h6>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div estrategia="5" class="x_content" style="display: block;" id="hoja-2-x_content-5">
                    <table id="hoja-2-table-estrategia-5" style="display: table;width: 100%" class="table table-xs">
                        <tbody id="hoja-2-body-estrategia-5">
                            <tr style="background-color: #EBEDEF">
                                <td style="width: 10%" class="text-center">Desde</td>
                                <td style="width: 10%" class="text-center">Hasta <a href=""><i sumaDias="#hoja-2-sumas-dias-estrategia-5" class="addDayEstrategias fas fa-plus-circle"></i></a></td>
                                <td style="width: 10%" class="text-center">Edad</td>
                                <td style="width: 10%" class="text-center">Años</td>
                                <td style="width: 10%" class="text-center">Meses</td>
                                <td style="width: 10%" class="text-center">Semanas</td>
                                <td style="width: 10%" class="text-center">Días</td>
                                <td style="width: 10%" class="text-center">SBC</td>
                                <td style="width: 10%" class="text-center">Total</td>
                                <td style="width: 10%" class="text-center">Costo</td>
                            </tr>
                            <tr>
                                <td style="width: 10%" class="text-center"><input estrategia="5" id="hoja-2-fecha-desde-estrategia-5" name="hoja-2-fecha-desde-estrategia-1" type="date" class="form-control input-xs hoja-2-fecha-desde-estrategia" estrategia="1" ></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="row" style="display: none" id="hoja-2-sumas-dias-estrategia-5">
                                        <div class="col-sm-9">
                                            <input id="hoja-2-entrada-dias-estrategia-5" type="text" class="form-control input-xs" style="width: 130%">
                                        </div>
                                        <div class="col-sm-3 float-left">
                                            <a href=""><i id="5" desdefecha="#hoja-2-fecha-desde-estrategia-5" fecha="#hoja-2-fecha-hasta-estrategia-5" elemento="#hoja-2-entrada-dias-estrategia-5" class="OksumarDias text-success cil-check"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <input id="hoja-2-fecha-hasta-estrategia-5" name="hoja-2-fecha-hasta-estrategia-5" type="date" class="form-control input-xs" readonly>
                                </td>
                                <td style="width: 10%" class="text-center"><input estrategia="5" id="hoja-2-edad-estrategia-5" name="hoja-2-edad-estrategia-5" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="5" id="hoja-2-anos-estrategia-5" name="hoja-2-anos-estrategia-5" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="5" id="hoja-2-meses-estrategia-5" name="hoja-2-meses-estrategia-5" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="5" id="hoja-2-semanas-estrategia-5" name="hoja-2-semanas-estrategia-5" type="text" class="form-control input-xs semanas-cotizadas-estrategia" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="5" id="hoja-2-dias-estrategia-5" name="hoja-2-dias-estrategia-5" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="5" id="hoja-2-sbc-estrategia-5" name="hoja-2-sbc-estrategia-5" type="text" class="form-control input-xs sbc-monto-estrategia">
                                    </div>                                    
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="5" id="hoja-2-total-estrategia-5" name="hoja-2-total-estrategia-1" type="text" class="form-control input-xs" readonly>
                                    </div>                                     
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="5" id="hoja-2-costo-estrategia-5" name="hoja-2-costo-estrategia-1" type="text" class="form-control input-xs" readonly>
                                    </div>                                     
                                </td>
                            </tr>
                            <tr style="background-color: #EBEDEF">
                                <td><a href=""><i estrategia="5" class="delete-estrategia-hoja2 text-danger far fa-trash-alt"></i></a></td>
                                <td colspan="8" style="width: 10%" class="text-center"></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-2-otro-valor-estrategia-5" name="hoja-2-otro-valor-estrategia-5" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="x_panel">
                <div estrategia="6" class="x_title">
                    <h6 style="cursor: pointer" class="collapse-link"><i class="far fa-edit"></i> 6.- M40 C0N SALARIO ALTO X PAGAR (PARA GENERAR EL SALARIO PROMEDIO ALTO)</h6>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div estrategia="6" class="x_content" style="display: block;" id="hoja-2-x_content-6">
                    <table id="hoja-2-table-estrategia-6" style="display: table;width: 100%" class="table table-xs">
                        <tbody id="hoja-2-body-estrategia-6">
                            <tr style="background-color: #EBEDEF">
                                <td style="width: 10%" class="text-center">Desde</td>
                                <td style="width: 10%" class="text-center">Hasta <a href=""><i sumaDias="#hoja-2-sumas-dias-estrategia-6" class="addDayEstrategias fas fa-plus-circle"></i></a></td>
                                <td style="width: 10%" class="text-center">Edad</td>
                                <td style="width: 10%" class="text-center">Años</td>
                                <td style="width: 10%" class="text-center">Meses</td>
                                <td style="width: 10%" class="text-center">Semanas</td>
                                <td style="width: 10%" class="text-center">Días</td>
                                <td style="width: 10%" class="text-center">SBC</td>
                                <td style="width: 10%" class="text-center">Total</td>
                                <td style="width: 10%" class="text-center">Costo</td>
                            </tr>
                            <tr>
                                <td style="width: 10%" class="text-center"><input estrategia="6" id="hoja-2-fecha-desde-estrategia-6" name="hoja-2-fecha-desde-estrategia-1" type="date" class="form-control input-xs hoja-2-fecha-desde-estrategia" estrategia="1" ></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="row" style="display: none" id="hoja-2-sumas-dias-estrategia-6">
                                        <div class="col-sm-9">
                                            <input id="hoja-2-entrada-dias-estrategia-6" type="text" class="form-control input-xs" style="width: 130%">
                                        </div>
                                        <div class="col-sm-3 float-left">
                                            <a href=""><i id="6" desdefecha="#hoja-2-fecha-desde-estrategia-6" fecha="#hoja-2-fecha-hasta-estrategia-6" elemento="#hoja-2-entrada-dias-estrategia-6" class="OksumarDias text-success cil-check"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <input id="hoja-2-fecha-hasta-estrategia-6" name="hoja-2-fecha-hasta-estrategia-6" type="date" class="form-control input-xs" readonly>
                                </td>
                                <td style="width: 10%" class="text-center"><input estrategia="6" id="hoja-2-edad-estrategia-6" name="hoja-2-edad-estrategia-6" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="6" id="hoja-2-anos-estrategia-6" name="hoja-2-anos-estrategia-6" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="6" id="hoja-2-meses-estrategia-6" name="hoja-2-meses-estrategia-6" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="6" id="hoja-2-semanas-estrategia-6" name="hoja-2-semanas-estrategia-6" type="text" class="form-control input-xs semanas-cotizadas-estrategia" readonly></td>
                                <td style="width: 10%" class="text-center"><input estrategia="6" id="hoja-2-dias-estrategia-6" name="hoja-2-dias-estrategia-6" type="text" class="form-control input-xs" readonly></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="6" id="hoja-2-sbc-estrategia-6" name="hoja-2-sbc-estrategia-6" type="number" class="form-control input-xs sbc-monto-estrategia">
                                    </div>                                    
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="6" id="hoja-2-total-estrategia-6" name="hoja-2-total-estrategia-6" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input estrategia="6" id="hoja-2-costo-estrategia-6" name="hoja-2-costo-estrategia-6" type="text" class="form-control input-xs" readonly>
                                    </div>                                    
                                </td>
                            </tr>
                            <tr style="background-color: #EBEDEF">
                                <td><a href=""><i estrategia="6" class="delete-estrategia-hoja2 text-danger far fa-trash-alt"></i></a></td>
                                <td colspan="8" style="width: 10%" class="text-center"></td>
                                <td style="width: 10%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-2-otro-valor-estrategia-6" name="hoja-2-otro-valor-estrategia-6" type="text" class="form-control input-xs" readonly>
                                    </div>                                     
                                </td>
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