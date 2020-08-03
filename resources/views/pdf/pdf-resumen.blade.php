@extends('welcome')
@section('css')
<link rel="stylesheet" href="{{ asset('css/stylos-pdfs.css') }}" />
@endsection
@section('contenido')

<br><br>
<div class="container-fluid" id="divPantallaPrincipal">
    <input type="text" value="{{ $uuid }}" id="uuid-pension" name="uuid-pension" style="display: none;">
    <input class="form-control" id="idCliente" name="idCliente" type="text" style="display: none" value="{{ $idCliente }}">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <i class="cil-beach-access"></i> Hoja resumen inicial de planes de pensión a la médida...
                            </div>
                            <div class="col-sm-6">
                    
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="img-resumen">
                        <div class="row">
                            <div class="col-sm-6">
                                <table id="table-hoja1-1" style="display: table;width: 100%"
                                    class="table table-hover table-xs">
                                    <tbody id="body-hoja1-1">
                                        <tr>
                                            <td style="width: 60%">
                                                Nombre
                                            </td>
                                            <td style="width: 40%">
                                                <input id="nombre"
                                                    name="nombre" type="text" class="form-control input-xs"
                                            readonly value="{{$cliente->nombre}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 60%">
                                                Apellidos
                                            </td>
                                            <td style="width: 40%">
                                                <input id="apellidos"
                                                    name="apellidos" type="text" class="form-control input-xs"
                                                    readonly value="{{$cliente->apellidos}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 60%">
                                                <i class="cil-calendar"></i>
                                                Fecha de nacimiento
                                            </td>
                                            <td style="width: 40%">
                                                <input id="fecNacimiento" name="fecNacimiento"
                                                    type="text" class="form-control input-xs" readonly value="{{Carbon\Carbon::parse($cliente->fechaNacimiento)->format('d-m-Y')}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 60%">
                                                <i class="cil-birthday-cake"></i> 
                                                Edad
                                            </td>
                                            <td style="width: 40%">
                                                <input id="edad" name="edad"
                                                    type="text" class="form-control input-xs" readonly value="{{$cliente->edad}}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table id="" style="display: table;width: 100%" class="table table-xs table-hover">
                                    <tbody id="">
                                        <tr>
                                            <td style="width: 50%;">
                                                <i class="cil-list-numbered"></i>
                                                Número de seguridad social
                                            </td>
                                            <td style="width: 50%;">
                                                <input style="width: 80%" id="nroSeguridadSocial" name="nroSeguridadSocial" type="text"
                                                    class="form-control input-xs" readonly
                                                    value="{{ $cliente['nroSeguridadSocial'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%">
                                                <i class="cil-list-numbered"></i>
                                                CURP
                                            </td>
                                            <td style="width: 50%">
                                                <input style="width: 80%" id="curp" name="curp" type="text"
                                                    class="form-control input-xs" readonly
                                                    value="{{ $cliente['nroDocumento'] }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <table id="table-pdf-resumen" style="display: table;width: 100%"
                                    class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Opción</th>
                                            <th class="text-center">Mensual</th>
                                            <th class="text-center">Acumulada a los 85 años</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-pdf-resumen" style="font-size: 25px;">
                                        @foreach ($pensiones as $pension)
                                            @php
                                                $id = explode('-',$pension->hoja);
                                                $id = $id[1];
                                            @endphp
                                            @if ($id == 1)
                                                <tr bgcolor="#F2DEDE" class="text-danger">
                                            @else
                                                <tr>
                                            @endif
                                               
                                                    <td class="text-center" style="width: 10%">
                                                        @if ($id == 1)
                                                            *
                                                        @endif
                                                        {{ $id }}
                                                    </td>
                                                    <td class="text-right" style="width: 45%">
                                                        {{ number_format($pension->pension_mensual , 2, '.', ',') }} 
                                                    </td>
                                                    <td class="text-right" style="width: 45%">
                                                        {{ number_format($pension->dif85 , 2, '.', ',') }}
                                                    </td>
                                                </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
         
                        </div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <h4 class="text-danger">* Solo como referencia...</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="row">
                
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <button class="btn btn-outline-primary" id="btn-ver-pdf"><i class="far fa-file-pdf"></i> Ver pdf resumen</button>
                <button style="display: none" class="btn-enviar-correo btn btn-outline-success"><i class="far fa-envelope"></i> Enviar por correo</button>
            </div>
        </div>
        <br>
        <img id="img-capture" src="" alt="">
    </div>
</div>
@include('pdf.modal-ver-pdf')
@endsection
@section('javascript')
<script src="{{ asset('jsApp/pdf-resumen.js') }}"></script>

@stop