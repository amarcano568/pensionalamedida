<style>
    #body-promedio-salarial-2 td {
        border-bottom: 1px solid #ddd;
        padding: 0.25em !important;
    }

    #body-promedio-salarial-2 input:read-only {
        text-align: right;
    }
</style>
<form id="formPaso2"  method="post" enctype="multipart/form-data" data-parsley-validate="">
    @csrf
    <div class="card">
        <div class="card-header"><i class="cil-functions-alt"></i> <strong>Promedio</strong>
            <small>Promedio Salario 2</small> 
            <button id="btn-formulas" class="float-right btn btn-success btn-sm"><i class="cil-functions"></i> Formulas</button>
            <span class="float-right">&nbsp;</span>
            <button id="btn-carga-cotizaciones-hoja2" class="float-right btn btn-primary btn-sm"><i class="fas fa-table"></i> Cargar Cotizaciones</button>
            <span class="float-right">&nbsp;</span>
            <button id="btn-carga-estrategias-hoja2" class="float-right btn btn-info btn-sm"><i class="fas fa-hat-wizard"></i> Estrategias</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <table id="table-promedio-salarial-2" style="display: table;width: 100%" class="table table-hover">
                        <tbody id="body-promedio-salarial-2">
                            <tr row="1" style="background-color: #EBEDEF">
                                <td style="width: 10%" class="text-center">PASOS</td>
                                <td style="width: 25%" class="text-center">CONCEPTOS</td>
                                <td style="width: 12.5%" class="text-center">DEL</td>
                                <td style="width: 12.5%" class="text-center">AL</td>
                                <td style="width: 12.5%" class="text-center">DIAS</td>
                                <td style="width: 12.5%" class="text-center">SBC</td>
                                <td style="width: 12.5%" class="text-center">MONTO BASE</td>
                                <td></td>
                            </tr>
                            <tr row="2">
                                <td style="background-color: #EBEDEF" class=" text-center">6</td>
                                <td class="">M40 -ALTO 2</td>
                                <td class=""><input id="hoja-2-fecha-desde-mod40-alto" name="hoja-2-fecha-desde-mod40-alto" type="text" class="estrategia-6 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-fecha-hasta-mod40-alto" name="hoja-2-fecha-hasta-mod40-alto"  type="text" class="estrategia-6 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-dias-mod40-alto" name="hoja-2-dias-mod40-alto"  type="text" class="estrategia-6 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-sbc-mod40-alto" name="hoja-2-sbc-mod40-alto"  type="text" class="estrategia-6 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-monto-base-mod40-alto" name="hoja-2-monto-base-mod40-alto" type="text" class="estrategia-6 form-control input-xs" readonly></td>
                                <td></td>
                            </tr>
                            <tr row="3">
                                <td style="background-color: #EBEDEF" class=" text-center">3</td>
                                <td class="">RETROACTIVO</td>
                                <td class=""><input id="hoja-2-fecha-desde-mod40-retroactivo" name="hoja-2-fecha-desde-mod40-retroactivo" type="text" class="estrategia-3 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-fecha-hasta-mod40-retroactivo" name="hoja-2-fecha-hasta-mod40-retroactivo" type="text" class="estrategia-3 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-dias-mod40-retroactivo" name="hoja-2-dias-mod40-retroactivo"  type="text" type="text" class="estrategia-3 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-sbc-mod40-retroactivo" name="hoja-2-sbc-mod40-retroactivo"  type="text"  type="text" class="estrategia-3 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-monto-base-mod40-retroactivo" name="hoja-2-monto-base-mod40-retroactivo" type="text" class="estrategia-3 form-control input-xs" readonly></td>
                                <td></td>
                            </tr>
                            <tr row="4">
                                <td style="background-color: #EBEDEF" class=" text-center">5</td>
                                <td class="">M40 BARATA</td>
                                <td class=""><input id="hoja-2-fecha-desde-mod40-barata" name="hoja-2-fecha-desde-mod40-barata" type="text" class="estrategia-5 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-fecha-hasta-mod40-barata" name="hoja-2-fecha-hasta-mod40-barata" type="text" class="estrategia-5 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-dias-mod40-barata" name="hoja-2-dias-mod40-barata" type="text" class="estrategia-5 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-sbc-mod40-barata" name="hoja-2-sbc-mod40-barata" type="text" class="estrategia-5 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-monto-base-mod40-barata" name="hoja-2-monto-base-mod40-barata" type="text" class="estrategia-5 form-control input-xs" readonly></td>
                                <td></td>
                            </tr>
                            <tr row="5">
                                <td style="background-color: #EBEDEF" class=" text-center">2</td>
                                <td class="">COOPERATIVA</td>
                                <td class=""><input id="hoja-2-fecha-desde-cooperativa" name="hoja-2-fecha-desde-cooperativa" type="text" class="estrategia-2 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-fecha-hasta-cooperativa" name="hoja-2-fecha-hasta-cooperativa" type="text" class="estrategia-2 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-dias-cooperativa" name="hoja-2-dias-cooperativa" type="text" class="estrategia-2 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-sbc-cooperativa" name="hoja-2-sbc-cooperativa" type="text" class="estrategia-2 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-monto-base-cooperativa" name="hoja-2-monto-base-cooperativa" type="text" class="estrategia-2 form-control input-xs" readonly></td>
                                <td></td>
                            </tr>
                            <tr row="6" style="background-color: #EBEDEF">
                                <td colspan="8" class="text-center">.:: E M P L E O S ::.</td>
                            </tr>
                            <tr row="7">
                                <td style="background-color: #EBEDEF" class=" text-center">4</td>
                                <td class="">M40 YA PAGADA</td>
                                <td class=""><input id="hoja-2-fecha-desde-m40-pagada" name="hoja-2-fecha-desde-m40-pagada" type="text" class="estrategia-4 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-fecha-hasta-m40-pagada" name="hoja-2-fecha-hasta-m40-pagada" type="text" class="estrategia-4 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-dias-m40-pagada" name="hoja-2-dias-m40-pagada" type="text" class="estrategia-4 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-sbc-m40-pagada" name="hoja-2-sbc-m40-pagada" type="text" class="estrategia-4 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-2-monto-base-m40-pagada" name="hoja-2-monto-base-m40-pagada" type="text" class="estrategia-4 form-control input-xs" readonly></td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4" >
                    <table id="table-cuantia-basica" style="display: table;width: 100%"
                        class="table-hoja-2 table table-hover">
                        <tbody id="body-cuantia-basica">
                            <tr style="background-color: #EBEDEF">
                                <td colspan="2" class="text-center table-columna1-cuantia">PENSION CON M40</td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Mes</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-pension-mesual-con-m40"
                                        name="hoja-2-pension-mesual-con-m40" type="text"
                                        class="form-control input-xs" readonly></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">12 Meses</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-pension-anual-con-m40"
                                        name="hoja-2-pension-anual-con-m40" type="text"
                                        class="form-control input-xs" readonly></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Aguinaldo</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-aguinaldo"
                                        name="hoja-2-aguinaldo" type="text" class="form-control input-xs"
                                        readonly></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Total anual</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-total-anual"
                                        name="hoja-2-total-anual" type="text" class="form-control input-xs"
                                        readonly></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia" id="dif-edad-85">0</td>
                                <td class="table-columna2-cuantia"><input id="hoja-2-dif-85"
                                        name="hoja-2-dif-85" type="text" class="form-control input-xs" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>