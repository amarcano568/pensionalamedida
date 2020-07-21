<style>
    #body-promedio-salarial-6 td {
        border-bottom: 1px solid #ddd;
        padding: 0.25em !important;
    }

    #body-calculos-salarial-6 td {
        border-bottom: 1px solid #ddd;
        padding: 0.25em !important;
    }

    .table-xs td {
        border-bottom: 1px solid #ddd;
        padding: 0.25em !important;
    }

    #body-promedio-salarial-6 input:read-only {
        text-align: right;
    }

    #body-calculos-salarial-6 input:read-only {
        text-align: right;
    }

    #body-cambiar-salario td {
        border-bottom: 1px solid #ddd;
        padding: 0.25em !important;
    }

    
</style>
<form id="formPaso6" method="post" enctype="multipart/form-data" data-parsley-validate="">
    @csrf
    <input type="text" id="hoja-6-edad-real-pension">
    <div class="card">
        <div class="card-header"><i class="cil-functions-alt"></i> <strong>Promedio</strong>
            <small>Promedio Salario 6</small>
            <button id="btn-formulas-hoja-6" class="float-right btn btn-success btn-sm"><i class="cil-functions"></i>
                Formulas</button>
            <span class="float-right">&nbsp;</span>
            <button id="btn-carga-cotizaciones-hoja6" class="float-right btn btn-primary btn-sm"><i
                    class="fas fa-table"></i> Cargar Cotizaciones</button>
            <span class="float-right">&nbsp;</span>
            <button id="btn-carga-estrategias-hoja6" class="float-right btn btn-info btn-sm"><i
                    class="fas fa-hat-wizard"></i> Estrategias</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <table id="table-promedio-salarial-6" style="display: table;width: 100%" class="table table-hover">
                        <tbody id="body-promedio-salarial-6">
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
                                <td id="hoja-6-concepto-2" class="concepto">M40 -ALTO 2</td>
                                <td class=""><input id="hoja-6-fecha-desde-mod40-alto"
                                        name="hoja-6-fecha-desde-mod40-alto" type="text"
                                        class="hoja-6-estrategia-6 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-6-fecha-hasta-mod40-alto"
                                        name="hoja-6-fecha-hasta-mod40-alto" type="text"
                                        class="hoja-6-estrategia-6 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-6-dias-mod40-alto" name="hoja-6-dias-mod40-alto"
                                        type="text" class="hoja-6-dias hoja-6-estrategia-6 form-control input-xs" readonly>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-sbc-mod40-alto" name="hoja-6-sbc-mod40-alto" type="text"
                                            class="hoja-6-estrategia-6 form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-monto-base-mod40-alto" name="hoja-6-monto-base-mod40-alto"
                                            type="text"
                                            class="hoja-6-estrategia-6 form-control input-xs total-cotizacion-promedio-salarial-6"
                                            readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr row="3">
                                <td style="background-color: #EBEDEF" class=" text-center">3</td>
                                <td  id="hoja-6-concepto-3" class="concepto">RETROACTIVO</td>
                                <td class=""><input id="hoja-6-fecha-desde-mod40-retroactivo"
                                        name="hoja-6-fecha-desde-mod40-retroactivo" type="text"
                                        class="hoja-6-estrategia-3 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-6-fecha-hasta-mod40-retroactivo"
                                        name="hoja-6-fecha-hasta-mod40-retroactivo" type="text"
                                        class="hoja-6-estrategia-3 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-6-dias-mod40-retroactivo"
                                        name="hoja-6-dias-mod40-retroactivo" type="text" type="text"
                                        class="hoja-6-dias hoja-6-estrategia-3 form-control input-xs" readonly></td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-sbc-mod40-retroactivo" name="hoja-6-sbc-mod40-retroactivo"
                                            type="text" type="text" class="hoja-6-estrategia-3 form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-monto-base-mod40-retroactivo"
                                            name="hoja-6-monto-base-mod40-retroactivo" type="text"
                                            class="hoja-6-estrategia-3 form-control input-xs total-cotizacion-promedio-salarial-6"
                                            readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr row="4">
                                <td style="background-color: #EBEDEF" class=" text-center">5</td>
                                <td id="hoja-6-concepto-4" class="concepto">M40 BARATA</td>
                                <td class=""><input id="hoja-6-fecha-desde-mod40-barata"
                                        name="hoja-6-fecha-desde-mod40-barata" type="text"
                                        class="hoja-6-estrategia-5 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-6-fecha-hasta-mod40-barata"
                                        name="hoja-6-fecha-hasta-mod40-barata" type="text"
                                        class="hoja-6-estrategia-5 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-6-dias-mod40-barata" name="hoja-6-dias-mod40-barata"
                                        type="text" class="hoja-6-dias hoja-6-estrategia-5 form-control input-xs" readonly>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-sbc-mod40-barata" name="hoja-6-sbc-mod40-barata" type="text"
                                            class="hoja-6-estrategia-5 form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-monto-base-mod40-barata" name="hoja-6-monto-base-mod40-barata"
                                            type="text"
                                            class="hoja-6-estrategia-5 form-control input-xs total-cotizacion-promedio-salarial-6"
                                            readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr row="5">
                                <td style="background-color: #EBEDEF" class=" text-center">2</td>
                                <td id="hoja-6-concepto-5" class="concepto">COOPERATIVA</td>
                                <td class=""><input id="hoja-6-fecha-desde-cooperativa"
                                        name="hoja-6-fecha-desde-cooperativa" type="text"
                                        class="hoja-6-estrategia-2 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-6-fecha-hasta-cooperativa"
                                        name="hoja-6-fecha-hasta-cooperativa" type="text"
                                        class="hoja-6-estrategia-2 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-6-dias-cooperativa" name="hoja-6-dias-cooperativa"
                                        type="text" class="hoja-6-dias hoja-6-estrategia-2 form-control input-xs" readonly>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-sbc-cooperativa" name="hoja-6-sbc-cooperativa" type="text"
                                            class="hoja-6-estrategia-2 form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-monto-base-cooperativa" name="hoja-6-monto-base-cooperativa"
                                            type="text"
                                            class="hoja-6-estrategia-2 form-control input-xs total-cotizacion-promedio-salarial-6"
                                            readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr row="6" style="background-color: #EBEDEF">
                                <td colspan="8" class="text-center">.:: E M P L E O S ::.</td>
                            </tr>
                            <tr row="7">
                                <td style="background-color: #EBEDEF" class=" text-center">4</td>
                                <td id="hoja-6-concepto-6" class="concepto">M40 YA PAGADA</td>
                                <td class=""><input id="hoja-6-fecha-desde-m40-pagada"
                                        name="hoja-6-fecha-desde-m40-pagada" type="text"
                                        class="hoja-6-estrategia-4 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-6-fecha-hasta-m40-pagada"
                                        name="hoja-6-fecha-hasta-m40-pagada" type="text"
                                        class="hoja-6-estrategia-4 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-6-dias-m40-pagada" name="hoja-6-dias-m40-pagada"
                                        type="text" class="hoja-6-dias hoja-6-estrategia-4 form-control input-xs" readonly>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-sbc-m40-pagada" name="hoja-6-sbc-m40-pagada" type="text"
                                            class="hoja-6-estrategia-4 form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-monto-base-m40-pagada" name="hoja-6-monto-base-m40-pagada"
                                            type="text"
                                            class="hoja-6-estrategia-4 form-control input-xs total-cotizacion-promedio-salarial-6"
                                            readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                    <table id="table-cuantia-basica" style="display: table;width: 100%"
                        class="table-hoja-6 table table-hover">
                        <tbody id="body-cuantia-basica">
                            <tr style="background-color: #EBEDEF">
                                <td colspan="2" class="text-center table-columna1-cuantia"><span
                                        id="title-pension-con-m40">PENSION CON M40</span></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Mes</td>
                                <td class="table-columna2-cuantia">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-pension-mensual-con-m40" name="hoja-6-pension-mensual-con-m40"
                                            type="text" class="form-control input-xs" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">12 Meses</td>
                                <td class="table-columna2-cuantia">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-pension-anual-con-m40" name="hoja-6-pension-anual-con-m40"
                                            type="text" class="form-control input-xs" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Aguinaldo</td>
                                <td class="table-columna2-cuantia">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-aguinaldo" name="hoja-6-aguinaldo" type="text"
                                            class="form-control input-xs" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Total anual</td>
                                <td class="table-columna2-cuantia">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-total-anual" name="hoja-6-total-anual" type="text"
                                            class="form-control input-xs" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia" id="hoja-6-dif-edad-85-text">0</td>
                                <td class="table-columna2-cuantia">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-dif-85" name="hoja-6-dif-85" type="text"
                                            class="form-control input-xs" readonly>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>  
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <table id="table-calculos-salarial-6" style="display: table;width: 100%"
                        class="table table-hover">
                        <tbody id="body-calculos-salarial-6">
                            <tr row="1" style="background-color: #EEFAEE">
                                <td colspan="2" style="width: 35%" class="text-center"></td>
                                <td style="width: 12.5%" class="text-center">TOTAL DIAS</td>
                                <td style="width: 12.5%" class="text-center"><input id="hoja-6-total-dias"
                                        name="hoja-6-total-dias" type="text" class="form-control input-xs" readonly>
                                </td>
                                <td colspan="2" style="width: 25%" class="text-center"></td>
                                <td></td>
                            </tr>
                            <tr row="1" style="background-color: #EEFAEE">
                                <td colspan="2" style="width: 35%" class="text-center"></td>
                                <td style="width: 12.5%" class="text-center text-danger">EXCEDIDOS -</td>
                                <td style="width: 12.5%" class="text-center text-danger"><input
                                        id="hoja-6-dias-excedidos" name="hoja-6-dias-excedidos" type="text"
                                        class="form-control input-xs" readonly></td>
                                <td style="width: 12.5%" class="text-center text-danger">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-salarios-excedidos" name="hoja-6-salarios-excedidos"
                                        type="text" class="form-control input-xs" readonly>
                                        <div class="input-group-append">
                                          <span class="input-group-text input-group-text-xs"><a href="" id="cambiar-salario-calculo-hoja-6"><i class="fas fa-search-dollar"></i></a></span>
                                        </div>
                                      </div>
                                </td>
                                <td style="width: 12.5%" class="text-danger">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-salarios-neto" name="hoja-6-salarios-neto" type="text"
                                            class="form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td style="width: 12.5%"></td>
                            </tr>
                            <tr row="1" style="background-color: #EEFAEE">
                                <td colspan="3" style="width: 60%" class="text-right text-primary">DIAS EQUIVALENTES
                                    ULTIMAS 250 SEMANAS -</td>
                                <td style="width: 12.5%" class="text-center"><input
                                        id="hoja-6-dias-equivalentes-250" name="hoja-6-dias-equivalentes-250"
                                        type="text" class="form-control input-xs" readonly></td>
                                <td colspan="2" style="width: 25%" class="text-center"></td>
                                <td></td>
                            </tr>
                            <tr style="background-color: #EBEDEF">
                                <td style="width: 10%" class="text-center"></td>
                                <td style="width: 25%" class="text-center"></td>
                                <td style="width: 12.5%" class="text-center"></td>
                                <td style="width: 12.5%" class="text-center"></td>
                                <td style="width: 12.5%" class="text-center"></td>
                                <td style="width: 12.5%" class="text-center"></td>
                                <td style="width: 12.5%" class="text-center"></td>
                                <td></td>
                            </tr>
                            <tr style="background-color: #EEFAEE">
                                <td colspan="5" style="width: 25%" class="text-right">SALARIO BASE PARA EL PROMEDIO
                                    SALARIAL
                                </td>
                                <td style="width: 12.5%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-salario-base-promedio" name="hoja-6-salario-base-promedio"
                                            type="text" class="form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td style="width: 25%" class="text-center"></td>
                            </tr>
                            <tr style="background-color: #EEFAEE">
                                <td colspan="5" style="width: 25%" class="text-right">ENTRE</td>
                                <td style="width: 12.5%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-entre" name="hoja-6-entre" type="text"
                                            class="form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td style="width: 25%" class="text-center"></td>
                            </tr>
                            <tr style="background-color: #EEFAEE">
                                <td colspan="5" style="width: 25%" class="text-right">SALARIO PROMEDIO ULTIMAS 250
                                    SEMANAS</td>
                                <td style="width: 12.5%" class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-prom-ultimas-250-sem" name="hoja-6-prom-ultimas-250-sem"
                                            type="text" class="form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td style="width: 25%" class="text-center"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                    <table id="table-cuantia-basica" style="display: table;width: 100%"
                        class="table-hoja-6 table table-hover">
                        <tbody id="body-cuantia-basica">
                            <tr style="background-color: #EBEDEF">
                                <td colspan="2" class="text-center table-columna1-cuantia"><span
                                        id="title-pension-con-m40">INFORMACION PARA GENERAR LA PENSION</span></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">No. Semanas Cotizadas</td>
                                <td class="table-columna2-cuantia">
                                    <input id="hoja-6-nro-semanas-cotizadas" name="hoja-6-nro-semanas-cotizadas"
                                            type="text" class="form-control input-xs" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Salario Diario Prom. (últ. 250 Semanas)</td>
                                <td class="table-columna2-cuantia">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-6-salario-promedio-mensual-250-semanas" name="hoja-6-salario-promedio-mensual-250-semanas"
                                            type="text" class="form-control input-xs" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Esposa </td>
                                <td class="table-columna2-cuantia">
                                    <input id="hoja-6-esposa" name="hoja-6-esposa" type="text"
                                            class="form-control input-xs" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Hijos Menores o Estudiando</td>
                                <td class="table-columna2-cuantia">
                                    <input id="hoja-6-hijos" name="hoja-6-hijos" type="text"
                                            class="form-control input-xs" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Padres (sólo a falta de viuda y huerfanos)</td>
                                <td class="table-columna2-cuantia">
                                    <input id="hoja-6-padres" name="hoja-6-padres" type="text"
                                            class="form-control input-xs" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia" id="hoja-6-dif-edad-85-text">Edad Jubilación</td>
                                <td class="table-columna2-cuantia">
                                    <input id="hoja-6-edad-jubilacion" name="hoja-6-edad-jubilacion" type="text"
                                            class="form-control input-xs" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>