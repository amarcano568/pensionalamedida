    <div id="modal-formulas" class="modal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-info modal-title">
                        <span id="title-modal">
                            <i class="cil-functions"></i>
                            FORMULAS - PENSIONES DE VEJEZ Y CESANTIA EN EDAD AVANZADA LEY '73
                        </span>
                    </h5>
                    <button type="button" class="btn-cerrar-modal-cotizaciones close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="data-principal-tab" data-toggle="tab" href="#principal-tab" role="tab"
                                aria-controls="principal-tab" aria-selected="true">
                                <i class="fas fa-info"></i>
                                Datos principales
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="" data-toggle="tab" href="#table-tablas-tab" role="tab"
                                aria-controls="graficos" aria-selected="false">
                                <i class="fas fa-table"></i> Tablas
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#graficos" role="tab"
                                aria-controls="graficos" aria-selected="false">
                                Modalidad 40
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#anos-anteriores" role="tab"
                                aria-controls="anos-anteriores" aria-selected="false">
                                Años Ant
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="principal-tab" role="tabpanel"
                            aria-labelledby="data-principal-tab">
                            <br>
                            <div class="row">
                                <div class="col-sm-9 table-responsive">
                                    @include('pensiones.table-input-formulas')
                                </div>
                                <div class="col-sm-3">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <center>
                                            <h6 class="float-center card-title">Pensión Anual</h6>
                                            <h6 class="text-success blink_me" id="pension-anual-fin"><i class="fas fa-sync fa-spin"></i> Calculando...</h6>
                                            <h6 class="float-center card-title">Pensión Mensual</h6>
                                            <h6 class="text-success blink_me" id="pension-mensual-fin"><i class="fas fa-sync fa-spin"></i> Calculando...</h6>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#cuantia-basica-tab" role="tab"
                                        aria-controls="cuantia-basica-tab" aria-selected="true">
                                        <i class="fas fa-info"></i>
                                        Cuantía Básica
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#incremento-anual-cuantia-basica-tab" role="tab"
                                        aria-controls="incremento-anual-cuantia-basica-tab" aria-selected="false">
                                        Incr. Anual Cuantía
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cuantia-anual-pension-tab" role="tab"
                                        aria-controls="cuantia-anual-pension-tab" aria-selected="false">
                                        Cuantía Anual Pensión
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#ayudas-tab" role="tab"
                                        aria-controls="ayudas-tab" aria-selected="false">
                                        Ayudas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#pension-anual-tab" role="tab"
                                        aria-controls="pension-anual-tab" aria-selected="false">
                                        Pensión Anual
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="cuantia-basica-tab" role="tabpanel"
                                    aria-labelledby="cuantia-basica-tab">
                                    @include('pensiones.table-cuantia-basica')
                                </div>
                                <div class="tab-pane fade show" id="incremento-anual-cuantia-basica-tab" role="tabpanel"
                                    aria-labelledby="cuantia-basica-tab">
                                    @include('pensiones.table-incremento-anual-cuantia-basica')
                                </div>
                                <div class="tab-pane fade show" id="cuantia-anual-pension-tab" role="tabpanel"
                                    aria-labelledby="cuantia-basica-tab">
                                    @include('pensiones.table-cuantia-anual-pension')
                                </div>
                                <div class="tab-pane fade show" id="ayudas-tab" role="tabpanel"
                                    aria-labelledby="cuantia-basica-tab">
                                    @include('pensiones.table-ayudas')
                                </div>
                                <div class="tab-pane fade show" id="pension-anual-tab" role="tabpanel"
                                    aria-labelledby="pension-anual-tab">
                                    @include('pensiones.pension-anual')
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="table-tablas-tab" role="tabpanel" aria-labelledby="table-tablas-tab">
                            @include('pensiones.table-tablas')
                        </div>
                        <div class="tab-pane fade" id="anos-anteriores" role="tabpanel" aria-labelledby="table-tablas-tab">
                            @include('pensiones.table-anos-anteriores')
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                   <button type="button" class="btn-cerrar-modal-cotizaciones btn btn-secondary btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>