<html>

<head>
    <link href="{{ asset('css/bootstrap-3-simple.min.css') }}" rel="stylesheet" />
    <style>
        header {
            position: fixed;
            top: -30px;
            left: 0px;
            right: 0px;
            /* background-color: lightblue; */
            height: 100px;
        }

        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 0.5cm;
        }

        .otraPagina {
            page-break-before: always;
        }

        .otraPagina:last-child {
            page-break-before: never;
        } 

        td {
            border-bottom: 1px solid #ddd;
            padding: 0.25em !important;
        }


        .input-xs {
            height: 22px;
            padding: 2px 5px;
            font-size: 12px;
            line-height: 1.5;
            /* If Placeholder of the input is moved up, rem/modify this. */
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <header>
        <div class="row">
            <div class="col-xs-2">
                <img src="img/logo.png" alt="" width="100%">
            </div>
            <div class="col-xs-8 text-center">
                <br>
                <h4>ALTERNATIVAS DE PENSION - RESUMEN</h4>
            </div>
        </div>
    </header>
    <footer>
        <div class="row">
            <hr>
            <div class="col-xs-6">
                <h5>Visita nuestra página web: {{ $empresa->web}}</h5>
            </div>
            <div class="col-xs-6 text-center">
                <h5>Escríbenos: {{ $empresa->email}}</h5>
            </div>
        </div>
    </footer>
    <main>
        <br><br><br><br>
        <div class="row">
            <div class="col-xs-6">
                <table id="" style="display: table;width: 100%" class="table table-xs">
                    <tbody id="">
                        <tr>
                            <td style="width: 60%">
                                Nombre
                            </td>
                            <td style="width: 40%">
                                <input id="nombre" name="nombre" type="text" class="form-control input-xs" readonly
                                    value="{{ $cliente->nombre }}">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 60%">
                                Apellidos
                            </td>
                            <td style="width: 40%">
                                <input id="apellidos" name="apellidos" type="text" class="form-control input-xs"
                                    readonly value="{{ $cliente->apellidos }}">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 60%">
                                <i class="cil-calendar"></i>
                                Fecha de nacimiento
                            </td>
                            <td style="width: 40%">
                                <input id="fecNacimiento" name="fecNacimiento" type="text" class="form-control input-xs"
                                    readonly
                                    value="{{ Carbon\Carbon::parse($cliente->fechaNacimiento)->format('d-m-Y') }}">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 60%">
                                <i class="cil-birthday-cake"></i>
                                Edad
                            </td>
                            <td style="width: 40%">
                                <input id="edad" name="edad" type="text" class="form-control input-xs" readonly
                                    value="{{ $cliente->edad }}">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-6">
                <table id="" style="display: table;width: 100%" class="table table-2">
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
                {{-- <table id="" style="display: table;width: 100%" class="table table-2">
                    <tbody id="">
                        <tr>
                            <td style="width: 60%;">
                                <i class="cil-calendar"></i>
                                Semanas cotizadas
                            </td>
                            <td style="width: 40%;">
                                <input style="width: 50%" id="semanas-cotizadas" name="semanas-cotizadas" type="text"
                                    class="text-right form-control input-xs" readonly
                                    value="{{ $expectativas['semanasCotizadas'] }}">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 60%">
                                <i class="cil-calendar"></i>
                                Semanas descontadas
                            </td>
                            <td style="width: 40%">
                                <input style="width: 50%" id="hoja-2-fecha-plan" name="hoja-2-fecha-plan" type="text"
                                    class="text-right form-control input-xs" readonly
                                    value="{{ $expectativas['semanasDescontadas'] }}">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 60%">
                                <i class="cil-calendar"></i>
                                Total semanas
                            </td>
                            <td style="width: 40%">
                                <input style="width: 50%" id="hoja-2-edad" name="hoja-2-edad" type="text"
                                    class="text-right form-control input-xs" readonly
                                    value="{{ $expectativas['semanasCotizadas'] - $expectativas['semanasDescontadas'] }}">
                            </td>
                        </tr>

                    </tbody>
                </table> --}}
            </div>
        </div>

        <div class="row">

            <div class="col-xs-6">
                <table id="table-pdf-resumen" style="display: table;width: 100%" class="table table-xs table-striped">
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
                    <tfoot>
                        <tr>
                          <td colspan="3"><h4 class="text-danger">* Solo como referencia...</h4></td>
                          
                        </tr>
                      </tfoot>
                </table>
            </div>
            <div class="col-xs-1"></div>
            <div class="col-xs-3">
                <div class="container" style="background-color: #F7A00F;border-radius: 25px;">
                    <h3 style="text-align:center;color: white;margin-top: 1em;">NOTA</h3>
                    <hr>
                    <h4 style="text-align:center;color: white">Este resumen de ninguna manera es la Planeación. El análisis detallado se integra por 16 HOJAS CON REPORTES E INDICADORES NUMÉRICOS, y será
                        enviado una vez que se liquide el costo del plan
                    </h4>
                    <br><br>
                    
                </div>
            </div>
           
        </div>
        <div class="otraPagina">
            <br><br><br>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h3 style="color: #F7A00F;">I N D I C E</h3>
                </div> 
            </div> 
            <div class="row">
                <div class="col-lg-12">
                    <h4>1.- Lista de 21 datos y hojas en la que los encuentras</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-danger">A.- Indicadores básicos para tomar Decisiones</h4>
                </div>
            </div>
            <div class="row"> 
                <div class="col-lg-12">
                    <h4 class="text-danger">B.- Porcentajes de variación en: la Pensión, la Ganancia Neta, las Semanas y los Salarios</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-danger">C.- Impacto de la Pensión en tu Nivel de Vida (Tasa de Reemplazo)</h4>
                </div>
             </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>2.- Expectativas de Pensión del trabajador </h4>
                </div>
             </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>3.- Radiografía integral comparativa de las 6 Opciones de Pensión</h4>
                </div>
             </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>4.- Ganancia Neta Acumulada (Estado de Resultados) ( 2 Láminas )</h4>
                </div>
             </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>5.- Fechas y Salarios a cotizar en la Modalidad 40</h4>
                </div>
             </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>6.- Impuesto Sobre la Renta a Pagar en cada Opción</h4>
                </div>
             </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>7.- Otros datos de apoyo para tomar decisiones</h4>
                </div>
             </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>8.- La RUTA para una PENSIÓN MILLONARIA (8 etapas del Proceso de Pensión)</h4>
                </div>
            </div>
        </div>
    </main>
</body>

</html>