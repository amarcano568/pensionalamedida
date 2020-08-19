@extends('welcome')
{{-- @section('css')
<link rel="stylesheet" href="{{ asset('css/stylos-pdfs.css') }}" />
@endsection --}}
<style>
    table {
      border-collapse: collapse;
    }
    
    table, td, th {
        border: 1px solid #ddd;
        padding: 0.25em !important;
    }

    .radiografia-title-font-size{
        text-shadow: 1px 1px 2px black, 0 0 25px, 0 0 5px ;color: white;
    }

</style>
@section('contenido')
<div id="principalPanel">
<br>
<div class="container-fluid" id="divPantallaPrincipal">
    <input type="text" value="{{ $uuid }}" id="uuid-pension" name="uuid-pension" style="display: none;">
    <input class="form-control" id="idCliente" name="idCliente" type="text" style="display: none"
        value="{{ $idCliente }}">
    <div class="row">
        <div class="col-sm-6"><h4 class="text-center">{{ $cliente->nombre}} {{$cliente->apellidos}}</h4></div>
        <div class="col-sm-6">
            <button style="display: none;" class="btn-enviar-correo btn btn-outline-success float-right"><i class="far fa-envelope"></i> Enviar por correo</button>
            <span class="float-right">&nbsp;</span>
            <button class="btn btn-outline-primary float-right" id="btn-ver-pdf"><i class="far fa-file-pdf"></i> Ver pdf detalle</button>
        </div>
    </div>
    <br>
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-boxed">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#indice" role="tab"
                            aria-controls="messages"><i class="fas fa-info"></i> INDICE</a></li>
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#incicadores-tomar-decision" role="tab"
                                aria-controls="home"><i class="fas fa-balance-scale-right"></i> A.- INDICADORES TOMAR DECISIONES</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#perdida-ganancia" role="tab"
                                aria-controls="profile"><i class="fas fa-dollar-sign"></i> PERDIDA Y GANANCIA</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#radiografia" role="tab"
                                aria-controls="messages"><i class="fas fa-prescription"></i> RADIOGRAFIA</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#variaciones" role="tab"
                                aria-controls="messages"><i class="fab fa-battle-net"></i> VARIACIONES</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#expectativas" role="tab"
                                aria-controls="messages"><i class="fas fa-glass-cheers"></i> EXPECTATIVAS DE PENSION</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#definicion_ganancia_neta" role="tab"
                                aria-controls="messages"><i class="fas fa-trophy"></i> DEFINICION GANANCIA NETA</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nivel-de-vida" role="tab"
                                    aria-controls="messages"><i class="fas fa-suitcase-rolling"></i> NIVEL DE VIDA <button id="btn-ipnc" class="btn btn-sm btn-info">INPC</button></a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fechas_salarios" role="tab"
                            aria-controls="messages"><i class="far fa-calendar-alt"></i> FECHAS Y SALARIOS</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#otros_datos_apoyo" role="tab"
                            aria-controls="messages"><i class="fab fa-accessible-icon"></i> OTROS DATOS DE APOYO</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#islr" role="tab"
                            aria-controls="messages"><i class="fas fa-dollar-sign"></i> ISLR</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="incicadores-tomar-decision" role="tabpanel">
                            @include('pdf.indicador-toma-decision')
                        </div>
                        <div class="tab-pane" id="perdida-ganancia" role="tabpanel">
                            @include('pdf.perdida-ganancia')
                        </div>
                        <div class="tab-pane" id="radiografia" role="tabpanel">
                            @include('pdf.radiografia')
                        </div>
                        <div class="tab-pane" id="variaciones" role="tabpanel">
                            @include('pdf.variaciones')
                        </div>
                        <div class="tab-pane" id="expectativas" role="tabpanel">
                            @include('pdf.expectativas')
                        </div>
                        <div class="tab-pane active" id="indice" role="tabpanel">
                            @include('pdf.indice')
                        </div>
                        <div class="tab-pane" id="definicion_ganancia_neta" role="tabpanel">
                            @include('pdf.definicion-ganancia-neta')
                        </div>
                        <div class="tab-pane" id="nivel-de-vida" role="tabpanel">
                            @if ($nivel_vida->empresa === null)
                                @include('pdf.nivel-de-vida-new')
                            @else 
                                @include('pdf.nivel-de-vida')
                            @endif
                        </div>
                        <div class="tab-pane" id="fechas_salarios" role="tabpanel">
                            @include('pdf.fechas-y-salarios')
                        </div>
                        <div class="tab-pane" id="otros_datos_apoyo" role="tabpanel">
                            @include('pdf.otros-datos-apoyo')
                        </div>
                        <div class="tab-pane" id="islr" role="tabpanel">
                            @include('pdf.islr')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pdf.modal-ver-pdf')
@include('pdf.modal-inpc')
@endsection
</div>
@section('javascript')
<script src="{{ asset('js/jquery.number.min.js') }}"></script>
<script src="{{ asset('jsApp/pdf-detalle.js') }}"></script>
@stop