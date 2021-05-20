@extends('welcome')
@section('contenido')
<form id="FormEmpresa" method="post" enctype="multipart/form-data" action="actualizar-empresa" data-parsley-validate="">
    @csrf
    <div class="row" style="padding: 5em;">
        <div class="col-sm-10">
            <div class="card shadow ">
                <div class="card-header">
                    <h4>
                        <svg class="c-icon mr-2 c-icon-2xl">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-building"></use>
                        </svg> MÓDULO DE
                        <strong>
                            RESIDENCIA.
                        </strong>
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="huespedes-tab" data-toggle="tab" href="#huespedes" role="tab"
                                aria-controls="huespedes" aria-selected="false">
                                <i class="fas fa-users"></i>
                                Huespedes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="habitaciones-tab" data-toggle="tab" href="#habitaciones" role="tab"
                                aria-controls="habitaciones" aria-selected="true">
                                <i class="fas fa-heading"></i>abitaciones
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" id="mobiliarios-tab" data-toggle="tab" href="#mobiliarios" role="tab"
                                aria-controls="mobiliarios" aria-selected="true">
                                <i class="fab fa-medium-m"></i>obiliario general
                            </a>
                        </li> 
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <br>
                        <input class="form-control" id="idEmpresa" name="idEmpresa" type="text" style="display: none;">            
                        <div class="tab-pane fade show active" id="huespedes" role="tabpanel" aria-labelledby="huespedes-tab">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <table id="table-huespedes" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 5%"></th>
                                                <th style="width: 25%" class="text-center">Nombre</th>
                                                <th style="width: 25%" class="text-center">Apellidos</th>
                                                <th style="width: 10%" class="text-center">Núm. Hab.</th>
                                                <th style="width: 10%" class="text-center">Desde</th>
                                                <th style="width: 10%" class="text-center">Hasta</th>
                                                <th style="width: 10%" class="text-center">Acciones</th>
                                                <th style="width: 5%" class="text-center">Detalles</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-huespedes">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>       
                        </div>
                        <div class="tab-pane fade" id="habitaciones" role="tabpanel" aria-labelledby="habitaciones-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button id="btn-nueva-habitacion" style="float: right;" class="btn btn-success" type="submit"> Nueva habitación</button>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <table id="table-habitaciones" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th class="text-center">Núm. hab.</th>
                                                <th class="text-center">Tipo</th>
                                                <th class="text-center">Capacidad</th>
                                                <th class="text-center">Piso</th>
                                                <th class="text-center">Observaciones</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-habitaciones">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>                           
                        </div>
                        <div class="tab-pane fade" id="mobiliarios" role="tabpanel" aria-labelledby="mobiliarios-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button id="btn-nuevo-mobiliario" style="float: right;" class="btn btn-success" type="submit"> Nuevo mobiliario</button>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <table id="table-mobiliarios" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th class="text-center">Tipo</th>
                                                <th class="text-center">Descripcióm</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-mobiliarios">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>                           
                        </div>
                        <br>
                    </div>
                    <div class="card-footer">                       
                    </div>
                </div>


            </div>
        </div>
    </div>
</form>
@include('residencia.modal-habitaciones')
@include('residencia.modal-mobiliarios')
@endsection
@section('javascript')
<script src="{{ asset('jsApp/habitaciones.js') }}"></script>
@stop