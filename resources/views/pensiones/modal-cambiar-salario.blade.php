<div id="modal-cambiar-salario" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><i class="cil-dollar"></i> Calculo descuento monto base excedido.</h6>
                <button id="cerrarModal" type="button" class="btn-cerrar-modal close" data-dismiss="modal"
                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="x_panel">
                    <div class="x_title">
                        <h6 style="cursor: pointer" class="collapse-link"><i class="cil-grid"></i> Tabla de cotizaciones y salarios</h6>
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
                    <div class="x_content" style="display: none;">
                        <table id="table-cambiar-salario" style="display: table;width: 100%" class="table table-hover">
                            <thead>
                                <tr style="background-color: #EBEDEF">
                                    <td style="width: 25%" class="text-center">Concepto</td>
                                    <td style="width: 15%" class="text-center">Del</td>
                                    <td style="width: 15%" class="text-center">Al</td>
                                    <td style="width: 15%" class="text-center">Días</td>
                                    <td style="width: 15%" class="text-center">SBC</td>
                                </tr>
                            </thead>
                            <tbody id="body-cambiar-salario">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <table style="display: table;width: 100%" class="table">
                                <thead>
                                    <tr style="background-color: #EBEDEF">
                                        <td colspan="2" style="width: 75%" class="text-center">Días excedidos</td>
                                        <td style="width: 25%" class="text-center"id="dias-excedidos-calculo"></td>    
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="table-salario-excedido" style="display: table;width: 100%" class="table table-hover">
                                <thead>
                                    <tr style="background-color: #EBEDEF">
                                        <td style="width: 33.3%" class="text-center">Días excedidos</td>
                                        <td style="width: 33.3%" class="text-center">SBC</td>   
                                        <td style="width: 33.3%" class="text-center">Monto Base</td>    
                                    </tr>
                                </thead>
                                <tbody id="body-salario-excedido">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <input type="text" id="monto-a-descontar-excedido" style="display: none">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cerrar-modal btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>