<style>
    #body-promedio-salarial-4 td {
        border-bottom: 1px solid #ddd;
        padding: 0.25em !important;
    }

    #body-calculos-salarial-4 td {
        border-bottom: 1px solid #ddd;
        padding: 0.25em !important;
    }

    .table-xs td {
        border-bottom: 1px solid #ddd;
        padding: 0.25em !important;
    }

    #body-promedio-salarial-4 input:read-only {
        text-align: right;
    }

    #body-calculos-salarial-4 input:read-only {
        text-align: right;
    }

    #body-cambiar-salario td {
        border-bottom: 1px solid #ddd;
        padding: 0.25em !important;
    }

    
</style>
<form id="formPaso4" method="post" enctype="multipart/form-data" data-parsley-validate="">
    @csrf
    <input type="text" id="hoja-4-edad-real-pension"  style="display: none">
    <div class="card">
        <div class="card-header"><i class="cil-functions-alt"></i> <strong>Promedio</strong>
            <small>Promedio Salario 4</small>
            <button id="btn-formulas-hoja-4" class="float-right btn btn-success btn-sm"><i class="cil-functions"></i>
                Formulas</button>
            <span class="float-right">&nbsp;</span>
            <button id="btn-carga-cotizaciones-hoja4" class="float-right btn btn-primary btn-sm"><i
                    class="fas fa-table"></i> Cargar Cotizaciones</button>
            <span class="float-right">&nbsp;</span>
            <button id="btn-carga-estrategias-hoja4" class="float-right btn btn-info btn-sm"><i
                    class="fas fa-hat-wizard"></i> Estrategias</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <table id="table-promedio-salarial-4" style="display: table;width: 100%" class="table table-hover">
                        <tbody id="body-promedio-salarial-4">
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
                                <td id="hoja-4-concepto-2" class="concepto">M40 -ALTO 2</td>
                                <td class=""><input id="hoja-4-fecha-desde-mod40-alto"
                                        name="hoja-4-fecha-desde-mod40-alto" type="text"
                                        class="hoja-4-estrategia-6 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-4-fecha-hasta-mod40-alto"
                                        name="hoja-4-fecha-hasta-mod40-alto" type="text"
                                        class="hoja-4-estrategia-6 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-4-dias-mod40-alto" name="hoja-4-dias-mod40-alto"
                                        type="text" class="hoja-4-dias hoja-4-estrategia-6 form-control input-xs" readonly>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-sbc-mod40-alto" name="hoja-4-sbc-mod40-alto" type="text"
                                            class="hoja-4-estrategia-6 form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-monto-base-mod40-alto" name="hoja-4-monto-base-mod40-alto"
                                            type="text"
                                            class="hoja-4-estrategia-6 form-control input-xs total-cotizacion-promedio-salarial-4"
                                            readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr row="3">
                                <td style="background-color: #EBEDEF" class=" text-center">3</td>
                                <td  id="hoja-4-concepto-3" class="concepto">RETROACTIVO</td>
                                <td class=""><input id="hoja-4-fecha-desde-mod40-retroactivo"
                                        name="hoja-4-fecha-desde-mod40-retroactivo" type="text"
                                        class="hoja-4-estrategia-3 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-4-fecha-hasta-mod40-retroactivo"
                                        name="hoja-4-fecha-hasta-mod40-retroactivo" type="text"
                                        class="hoja-4-estrategia-3 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-4-dias-mod40-retroactivo"
                                        name="hoja-4-dias-mod40-retroactivo" type="text" type="text"
                                        class="hoja-4-dias hoja-4-estrategia-3 form-control input-xs" readonly></td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-sbc-mod40-retroactivo" name="hoja-4-sbc-mod40-retroactivo"
                                            type="text" type="text" class="hoja-4-estrategia-3 form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-monto-base-mod40-retroactivo"
                                            name="hoja-4-monto-base-mod40-retroactivo" type="text"
                                            class="hoja-4-estrategia-3 form-control input-xs total-cotizacion-promedio-salarial-4"
                                            readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr row="4">
                                <td style="background-color: #EBEDEF" class=" text-center">5</td>
                                <td id="hoja-4-concepto-4" class="concepto">M40 BARATA</td>
                                <td class=""><input id="hoja-4-fecha-desde-mod40-barata"
                                        name="hoja-4-fecha-desde-mod40-barata" type="text"
                                        class="hoja-4-estrategia-5 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-4-fecha-hasta-mod40-barata"
                                        name="hoja-4-fecha-hasta-mod40-barata" type="text"
                                        class="hoja-4-estrategia-5 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-4-dias-mod40-barata" name="hoja-4-dias-mod40-barata"
                                        type="text" class="hoja-4-dias hoja-4-estrategia-5 form-control input-xs" readonly>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-sbc-mod40-barata" name="hoja-4-sbc-mod40-barata" type="text"
                                            class="hoja-4-estrategia-5 form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-monto-base-mod40-barata" name="hoja-4-monto-base-mod40-barata"
                                            type="text"
                                            class="hoja-4-estrategia-5 form-control input-xs total-cotizacion-promedio-salarial-4"
                                            readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr row="5">
                                <td style="background-color: #EBEDEF" class=" text-center">2</td>
                                <td id="hoja-4-concepto-5" class="concepto">COOPERATIVA</td>
                                <td class=""><input id="hoja-4-fecha-desde-cooperativa"
                                        name="hoja-4-fecha-desde-cooperativa" type="text"
                                        class="hoja-4-estrategia-2 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-4-fecha-hasta-cooperativa"
                                        name="hoja-4-fecha-hasta-cooperativa" type="text"
                                        class="hoja-4-estrategia-2 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-4-dias-cooperativa" name="hoja-4-dias-cooperativa"
                                        type="text" class="hoja-4-dias hoja-4-estrategia-2 form-control input-xs" readonly>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-sbc-cooperativa" name="hoja-4-sbc-cooperativa" type="text"
                                            class="hoja-4-estrategia-2 form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-monto-base-cooperativa" name="hoja-4-monto-base-cooperativa"
                                            type="text"
                                            class="hoja-4-estrategia-2 form-control input-xs total-cotizacion-promedio-salarial-4"
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
                                <td id="hoja-4-concepto-6" class="concepto">M40 YA PAGADA</td>
                                <td class=""><input id="hoja-4-fecha-desde-m40-pagada"
                                        name="hoja-4-fecha-desde-m40-pagada" type="text"
                                        class="hoja-4-estrategia-4 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-4-fecha-hasta-m40-pagada"
                                        name="hoja-4-fecha-hasta-m40-pagada" type="text"
                                        class="hoja-4-estrategia-4 form-control input-xs" readonly></td>
                                <td class=""><input id="hoja-4-dias-m40-pagada" name="hoja-4-dias-m40-pagada"
                                        type="text" class="hoja-4-dias hoja-4-estrategia-4 form-control input-xs" readonly>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-sbc-m40-pagada" name="hoja-4-sbc-m40-pagada" type="text"
                                            class="hoja-4-estrategia-4 form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-monto-base-m40-pagada" name="hoja-4-monto-base-m40-pagada"
                                            type="text"
                                            class="hoja-4-estrategia-4 form-control input-xs total-cotizacion-promedio-salarial-4"
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
                        class="table-hoja-4 table table-hover">
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
                                        <input id="hoja-4-pension-mensual-con-m40" name="hoja-4-pension-mensual-con-m40"
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
                                        <input id="hoja-4-pension-anual-con-m40" name="hoja-4-pension-anual-con-m40"
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
                                        <input id="hoja-4-aguinaldo" name="hoja-4-aguinaldo" type="text"
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
                                        <input id="hoja-4-total-anual" name="hoja-4-total-anual" type="text"
                                            class="form-control input-xs" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia" id="hoja-4-dif-edad-85-text">0</td>
                                <td class="table-columna2-cuantia">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-dif-85" name="hoja-4-dif-85" type="text"
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
                    <table id="table-calculos-salarial-4" style="display: table;width: 100%"
                        class="table table-hover">
                        <tbody id="body-calculos-salarial-4">
                            <tr row="1" style="background-color: #EEFAEE">
                                <td colspan="2" style="width: 35%" class="text-center"></td>
                                <td style="width: 12.5%" class="text-center">TOTAL DIAS</td>
                                <td style="width: 12.5%" class="text-center"><input id="hoja-4-total-dias"
                                        name="hoja-4-total-dias" type="text" class="form-control input-xs" readonly>
                                </td>
                                <td colspan="2" style="width: 25%" class="text-center"></td>
                                <td></td>
                            </tr>
                            <tr row="1" style="background-color: #EEFAEE">
                                <td colspan="2" style="width: 35%" class="text-center"></td>
                                <td style="width: 12.5%" class="text-center text-danger">EXCEDIDOS -</td>
                                <td style="width: 12.5%" class="text-center text-danger"><input
                                        id="hoja-4-dias-excedidos" name="hoja-4-dias-excedidos" type="text"
                                        class="form-control input-xs" readonly></td>
                                <td style="width: 12.5%" class="text-center text-danger">
                                    {{-- <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-salarios-excedidos" name="hoja-4-salarios-excedidos"
                                            type="text" class="form-control input-xs" readonly>
                                    </div> --}}

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-salarios-excedidos" name="hoja-4-salarios-excedidos"
                                        type="text" class="form-control input-xs" readonly>
                                        <div class="input-group-append">
                                          <span class="input-group-text input-group-text-xs"><a href="" id="cambiar-salario-calculo-hoja-4"><i class="fas fa-search-dollar"></i></a></span>
                                        </div>
                                      </div>
                                </td>
                                <td style="width: 12.5%" class="text-danger">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-xs">$</span>
                                        </div>
                                        <input id="hoja-4-salarios-neto" name="hoja-4-salarios-neto" type="text"
                                            class="form-control input-xs" readonly>
                                    </div>
                                </td>
                                <td style="width: 12.5%"></td>
                            </tr>
                            <tr row="1" style="background-color: #EEFAEE">
                                <td colspan="3" style="width: 60%" class="text-right text-primary">DIAS EQUIVALENTES
                                    ULTIMAS 250 SEMANAS -</td>
                                <td style="width: 12.5%" class="text-center"><input
                                        id="hoja-4-dias-equivalentes-250" name="hoja-4-dias-equivalentes-250"
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
                                        <input id="hoja-4-salario-base-promedio" name="hoja-4-salario-base-promedio"
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
                                        <input id="hoja-4-entre" name="hoja-4-entre" type="text"
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
                                        <input id="hoja-4-prom-ultimas-250-sem" name="hoja-4-prom-ultimas-250-sem"
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
                        class="table-hoja-4 table table-hover">
                        <tbody id="body-cuantia-basica">
                            <tr style="background-color: #EBEDEF">
                                <td colspan="2" class="text-center table-columna1-cuantia"><span
                                        id="title-pension-con-m40">INFORMACION PARA GENERAR LA PENSION</span></td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">No. Semanas Cotizadas</td>
                                <td class="table-columna2-cuantia">
                                    <input id="hoja-4-nro-semanas-cotizadas" name="hoja-4-nro-semanas-cotizadas"
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
                                        <input id="hoja-4-salario-promedio-mensual-250-semanas" name="hoja-4-salario-promedio-mensual-250-semanas"
                                            type="text" class="form-control input-xs" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Esposa </td>
                                <td class="table-columna2-cuantia">
                                    <input id="hoja-4-esposa" name="hoja-4-esposa" type="text"
                                            class="form-control input-xs" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Hijos Menores o Estudiando</td>
                                <td class="table-columna2-cuantia">
                                    <input id="hoja-4-hijos" name="hoja-4-hijos" type="text"
                                            class="form-control input-xs" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia">Padres (sólo a falta de viuda y huerfanos)</td>
                                <td class="table-columna2-cuantia">
                                    <input id="hoja-4-padres" name="hoja-4-padres" type="text"
                                            class="form-control input-xs" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-columna1-cuantia" id="hoja-4-dif-edad-85-text">Edad Jubilación</td>
                                <td class="table-columna2-cuantia">
                                    <input id="hoja-4-edad-jubilacion" name="hoja-4-edad-jubilacion" type="text"
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