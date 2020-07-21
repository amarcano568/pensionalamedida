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
</style>
@section('contenido')
<br>
<div class="container-fluid" id="divPantallaPrincipal">
    <input type="text" value="{{ $uuid }}" id="uuid-pension" name="uuid-pension" style="display: none;">
    <input class="form-control" id="idCliente" name="idCliente" type="text" style="display: none"
        value="{{ $idCliente }}">
    <h4 class="text-center">{{ $cliente->nombre}} {{$cliente->apellidos}}</h4>
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-boxed">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#incicadores-tomar-decision" role="tab"
                                aria-controls="home">A.- INDICADORES TOMAR DECISIONES</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#perdida-ganancia" role="tab"
                                aria-controls="profile">Perdida y Ganancia</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#impacto-nivel-vida" role="tab"
                                aria-controls="messages">C.- IMPACTO EN NIVEL DE VIDA</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="incicadores-tomar-decision" role="tabpanel">
                            @include('pdf.indicador-toma-decision')
                        </div>
                        <div class="tab-pane" id="perdida-ganancia" role="tabpanel">
                            @include('pdf.perdida-ganancia')
                        </div>
                        <div class="tab-pane" id="impacto-nivel-vida" role="tabpanel">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <button class="btn btn-outline-primary" id="btn-ver-pdf"><i class="far fa-file-pdf"></i> Ver pdf resumen</button>
                <button style="display: none" class="btn-enviar-correo btn btn-outline-success"><i class="far fa-envelope"></i> Enviar por correo</button>
            </div>
        </div> --}}
    </div>
</div>

@endsection
@section('javascript')
<script src="{{ asset('js/jquery.number.min.js') }}"></script>
<script src="{{ asset('jsApp/pdf-detalle.js') }}"></script>
@stop