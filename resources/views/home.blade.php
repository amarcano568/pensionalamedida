@extends('welcome')
@section('contenido')
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-gradient-info shadow-lg">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg" id="pensionesHoy">0</div>
                                <div>Estudiantes</div>
                            </div>
                        </div>
                        <div style="height:70px;"  id="pensionesHoyFecha">
                            <center>
                                <br>
                                <a style="color: white" href="{{URL::to('/gestionar-estudiantes')}}">
                                    <strong>Ir a listado de estudiantes <i class="fas fa-arrow-right"></i></strong>
                                </a>
                            </center>
                        </div>
                        <button id="btn-importar-nuevos-alumnos" class="btn btn-primary btn-sm"><i class="far fa-file-excel"></i>&nbsp;Importar nuevos alumnos</button>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-gradient-info">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg" id="pensionesMesActual">0</div>
                                <div>Grupos familiares</div>
                            </div>
                        </div>
                        <div style="height:70px;"  id="pensionesMesActualFecha">
                            <center>
                                <br>
                                <a style="color: white" href="{{URL::to('/gestionar-grupos-familiares')}}">
                                    <strong>Ir a crear un nuevo grupo <i class="fas fa-arrow-right"></i></strong>
                                </a>
                            </center>
                        </div>
                        <button class="btn btn-primary btn-sm"><i class="fas fa-people-arrows"></i>&nbsp;&nbsp;Crear nuevo grupo familiar</button>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-gradient-info">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg" id="pensionesMesAnterior">0</div>
                                <div>Informes</div>
                            </div>
                        </div>
                        <div style="height:70px;"  id="pensionesMesAnteriorFecha">
                            
                        </div>
                        <button class="btn btn-primary btn-sm"><i class="far fa-file-alt"></i>&nbsp;Ver informes</button>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-gradient-info">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg" id="pensionesAnoActual">0</div>
                                <div>Expedientes académicos</div>
                            </div>
                        </div>
                        <div style="height:70px;"  id="pensionesAnoActualFecha">
                            
                        </div>
                        <button class="btn btn-primary btn-sm"><i class="far fa-file-alt"></i>&nbsp;Ir a los expedientes</button>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <br><br>
                        <center>
                            <img src="img/logo.jpg" alt="" class="img-responsive">
                        </center>
                        <br><br>
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
    @include('modal-importar-alumnos')
</main>

@endsection
@section('javascript')
<script src="{{ asset('jsApp/inicio.js')}}"></script> 
@stop