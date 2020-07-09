@extends('welcome')
@section('contenido')
<br><br>
<div id="divGestionarPension" style="padding: 1em;margin-top: -2em;">
    {{-- <form id="FormPensiones" method="post" enctype="multipart/form-data" action="actualizar-pension"
        data-parsley-validate="">
@csrf--}}
        <div class="row" id="divVentanaDatos">
            <div class="col-sm-12">
                <div class="card shadow ">
                    <div class="card-body" style="height: 7.5em;">
                        <input class="form-control" id="idCliente" name="idCliente" type="text" style="display: none">
                        <div class="tab-pane fade show active" id="historial" role="tabpanel"
                            aria-labelledby="historial-tab">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <input autocomplete="off" class="cliente-seeker form-control" id="nombreCliente" name="nombreCliente"
                                        type="text" placeholder="Comienze a escribir para buscar un cliente"
                                        style="width: 165%;">
                                        <br><br>
                                    <button id="btn-cargar-cotizaciones" class="btn btn-sm btn-outline-info"><i class="cil-cloud-download"></i>
                                         Cargar cotizaciones
                                    </button>
                                    <button id="btn-hoja-1" style="display: none" class="btn btn-sm btn-outline-success">
                                        <i class="cil-functions-alt"></i>
                                        Hoja 1 (pensión sin estrategia)
                                    </button>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="card shadow ">
                                        <div class="card-body" style="height: 6em;margin-top: -1em;"
                                            id="datosComplementarios">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <div class="card shadow ">
                                        <div class="card-body" style="padding-top: 1.5em;height: 6em;margin-top: -1em;"
                                            id="datosComplementarios">
                                            <button class="btn btn-sm btn-outline-success" data-trigger="hover"
                                                data-html="true" data-toggle="popover" data-placement="top"
                                                data-content="Agregar nuevo cliente.">
                                                <i class="cil-user-plus"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" data-trigger="hover"
                                                data-html="true" data-toggle="popover" data-placement="top"
                                                data-content="Enviar resumen de planes.">
                                                <i class="far fa-envelope"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info" data-trigger="hover"
                                                data-html="true" data-toggle="popover" data-placement="top"
                                                data-content="Enviar detalle de planes.">
                                                <i class="far fa-envelope"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" data-trigger="hover"
                                                data-html="true" data-toggle="popover" data-placement="top"
                                                data-content="Generar pdf.">
                                                <i class="far fa-file-pdf"></i>
                                            </button>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="smartwizard">

            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="#step-1">
                        Expectativas salariales
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-2">
                        <i class="cil-functions-alt"></i> Promedio Salario 2
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-3">
                        <i class="cil-functions-alt"></i> Promedio Salario 3
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-4">
                        <i class="cil-functions-alt"></i> Promedio Salario 4
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-5">
                        <i class="cil-functions-alt"></i> Promedio Salario 5
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-6">
                        <i class="cil-functions-alt"></i> Promedio Salario 6
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                    @include('pensiones.expectativa-salarial')
                </div>
                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                    @include('pensiones.promedio-salarial-2')
                </div>
                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                    Step 3 Content
                </div>
                <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                    Step 4 Content
                </div>
                <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
                    Step 5 Content
                </div>
                <div id="step-6" class="tab-pane" role="tabpanel" aria-labelledby="step-6">
                    Step 6 Content
                </div>
                
            </div>
        </div>
    {{-- </form> --}}
</div>
@include('pensiones.modal-cargar-cotizaciones')
@include('pensiones.modal-subir-excel')
@include('pensiones.modal-formulas')
@include('pensiones.modal-hoja-1-pension-sin-estrategias')
@include('pensiones.modal-hoja-2-estrategias')
@endsection
@section('javascript')
<script src="{{ asset('jsApp/generar-planes.js') }}"></script>
<script src="{{ asset('js/jquery.number.min.js') }}"></script>
<script src="{{ asset('jsApp/formulas.js') }}"></script>
<script src="{{ asset('jsApp/hoja1.js') }}"></script>
<script src="{{ asset('jsApp/hoja2.js') }}"></script>
@stop