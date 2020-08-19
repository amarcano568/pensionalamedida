@extends('welcome')
@section('contenido')
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-gradient-primary">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg" id="pensionesHoy">0</div>
                                <div>Pensiones hoy</div>
                            </div>
                        </div>
                        <div style="height:70px;"  id="pensionesHoyFecha">
                            
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-gradient-info">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg" id="pensionesMesActual">0</div>
                                <div>Pensiones mes actual</div>
                            </div>
                        </div>
                        <div style="height:70px;"  id="pensionesMesActualFecha">
                            
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-gradient-warning">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg" id="pensionesMesAnterior">0</div>
                                <div>Pensiones Mes anterior</div>
                            </div>
                        </div>
                        <div style="height:70px;"  id="pensionesMesAnteriorFecha">
                            
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-gradient-danger">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg" id="pensionesAnoActual">0</div>
                                <div>Pensiones Año actual</div>
                            </div>
                        </div>
                        <div style="height:70px;"  id="pensionesAnoActualFecha">
                            
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Planes de Pensión</h4>
                            <div class="small text-muted">Ultimos 30 días</div>
                        </div>
                        {{-- <div class="btn-toolbar d-none d-md-block" role="toolbar"
                            aria-label="Toolbar with buttons">
                            <div class="btn-group btn-group-toggle mx-3" data-toggle="buttons">
                                <label class="btn btn-outline-secondary">
                                    <input id="option1" type="radio" name="options" autocomplete="off"> Day
                                </label>
                                <label class="btn btn-outline-secondary active">
                                    <input id="option2" type="radio" name="options" autocomplete="off"
                                        checked=""> Month
                                </label>
                                <label class="btn btn-outline-secondary">
                                    <input id="option3" type="radio" name="options" autocomplete="off"> Year
                                </label>
                            </div>
                            <button class="btn btn-primary" type="button">
                                <svg class="c-icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cloud-download">
                                    </use>
                                </svg>
                            </button>
                        </div> --}}
                    </div>
                    <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                        <canvas class="chart" id="myChart" height="300"></canvas>
                    </div>
                </div>
                <div class="card-footer">
                    {{-- <div class="row text-center">
                        <div class="col-sm-12 col-md mb-sm-2 mb-0">
                            <div class="text-muted">Visits</div><strong>29.703 Users (40%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-gradient-success" role="progressbar"
                                    style="width: 40%" aria-valuenow="40" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md mb-sm-2 mb-0">
                            <div class="text-muted">Unique</div><strong>24.093 Users (20%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-gradient-info" role="progressbar"
                                    style="width: 20%" aria-valuenow="20" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md mb-sm-2 mb-0">
                            <div class="text-muted">Pageviews</div><strong>78.706 Views (60%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-gradient-warning" role="progressbar"
                                    style="width: 60%" aria-valuenow="60" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md mb-sm-2 mb-0">
                            <div class="text-muted">New Users</div><strong>22.123 Users (80%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-gradient-danger" role="progressbar"
                                    style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md mb-sm-2 mb-0">
                            <div class="text-muted">Bounce Rate</div><strong>40.15%</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar" role="progressbar" style="width: 40%"
                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- /.card-->
       
            <!-- /.row-->
          
            <!-- /.row-->
        </div>
    </div>
</main>

@endsection
@section('javascript')
<script src="{{ asset('jsApp/inicio.js')}}"></script> 
@stop