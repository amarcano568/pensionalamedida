<html>

<head>
    <link href="{{ asset('css/bootstrap-3-simple.min.css') }}" rel="stylesheet" />
    <style>
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 0.25cm;
        }

        body {
            margin-top: -7.5px;
        }

        .otraPagina {
            page-break-before: always;
        }

        .otraPagina:last-child {
            page-break-before: never;
        }

        td {
            padding: 0.10em !important;
            height: 1.30em;
            border: 1px solid grey;
            border-top-color: 1px solid grey;
        }

        table {
            border-collapse: collapse;
        }

        .fila-variaciones{
            height: 0.5em!important;
            padding:0em !important;
        }

        .input-xs {
            height: 22px;
            padding: 2px 5px;
            font-size: 12px;
            line-height: 1.5;
            /* If Placeholder of the input is moved up, rem/modify this. */
            border-radius: 3px;
        }
        .label-radiografia-pension-acum-85{
            font-size: 10px;
        }
        .radiografia-title-font-size{
            text-shadow: 1px 1px 2px black, 0 0 25px, 0 0 5px ;color: white;
        }

        #table-indice-1 td{
            padding: 0em!important;
            height: 0.5em!important;
        }

        #table-def-ganancia-neta-1 td{
            padding: 1.5em!important;
        }

        .title-gananci-neta{
            font-size: 18px;
        }

        .page-number:before {
        content: "Pág: " counter(page);
        }
    </style>
</head>

<body>
    <header>
        <div class="row">
            <div class="col-xs-2">
                
            </div>
            <div class="col-xs-8 text-center">
                <br>
                <h4>ALTERNATIVAS DE PENSION - DETALLES</h4>
            </div>
        </div>
    </header>
    <footer>
        <div class="row">
            <hr>
            <div class="col-xs-5">
                <h5>Visita nuestra página web: {{ $empresa->web }}</h5>
            </div>
            <div class="col-xs-4 text-left" style="vertical-align : middle;">
                <h5><img src="img/email.png" alt=""> <span style="margin-top: -1em">{{ $empresa->email }}</span></h5>
            </div>
            <div class="col-xs-2 text-right">
                <div class="page-number"></div>
            </div>
        </div>
    </footer>
    <main>
        <center>
            {{-- <img src="img/logo-xl.png" alt="" width="50%"> --}}
            <h3 class=" text-uppercase">Opciones de Pensión por Cesantía y Vejez con Ley IMSS 1973 </h3>
        </center>
        <br>
        <div class="row">
            <div class="col-sm-8">
                <table id="table-variaciones-1" style="display: table;width: 100%" class="table-hoja-2 table table-hover">
                    <tbody id="body-variaciones-1">
                        <tr style="height: 2.5em;" class="text-center" bgcolor="#DFF0D8">
                            <td><strong>NOMBRE</strong></td>
                            <td><strong>EDAD</strong></td>
                            <td><strong>NSS</strong></td>
                            <td><strong>CURP</strong></td>
                        </tr>
                        <tr style="height: 2.5em;" class="text-center" >
                            <td><strong>{{ $cliente->nombre }} {{ $cliente->apellidos }}</strong></td>
                            <td><strong>{{ $cliente->edad }}</strong></td>
                            <td><strong>{{$cliente['nroSeguridadSocial']}}</strong></td>
                            <td><strong>{{$cliente['nroDocumento']}}</strong></td>
                        </tr>                     
                            
                    </tbody>
                </table>
            </div>
            <br><br>
            <div class="col-sm-12">
                <center>
                    <img src="img/logo-xl.png" alt="" width="80%">
                </center>
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
                    <h4 class="text-danger">B.- Porcentajes de variación en: la Pensión, la Ganancia Neta, las Semanas y
                        los Salarios</h4>
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

        <div class="otraPagina">
            <h5 style="margin-top: -1em;">1.- 21 DATOS Y SU UBICACIÓN EN EL REPORTE</h5>
            @include('pdf.indice')
        </div>

        <div class="otraPagina">
            <h5 style="margin-top: -1em;">A.- INDICADORES PARA TOMAR DECISIONES</h5>
            @include('pdf.indicador-toma-decision')
        </div>
        <div class="otraPagina">
            <h5 style="margin-top: -1em;">B) PORCENTAJES DE VARIACION</h5>
            @include('pdf.variaciones')
        </div>
        <div class="otraPagina">
            <h5 style="margin-top: -1em;">B.- IMPACTO DE LA PENSIÓN EN TU NIVEL DE VIDA (Tasa de Reemplazo)
            </h5>
            <br><br>
            @include('pdf.nivel-de-vida')
        </div>
        <div class="otraPagina">
            <h5 class="text-uppercase" style="margin-top: -1em;">2.- Expectativas de Pensión del trabajador</h5>
            <br><br><br><br>
            @include('pdf.expectativas')
        </div>
        <div class="otraPagina">
            <h5 class="text-uppercase" style="margin-top: -1em;">3.- Radiografía integral comparativa de las  Seis Opciones de Pensión</h5>
            @include('pdf.radiografia')
        </div>
        <div class="otraPagina">
            <h5 class="text-uppercase" style="margin-top: -1em;">4.- Ganancia Neta Acumulada que genera la Modalidad 40  (GNA)</h5>
            @include('pdf.definicion-ganancia-neta')
        </div>
        <div class="otraPagina">
            <h5 class="text-uppercase" style="margin-top: -1em;">4.- Ganancia Neta Acumulada que genera la Modalidad 40  (GNA)</h5>
            <br><br>
            @include('pdf.perdida-ganancia')
        </div>
        <div class="otraPagina">
            <h5 class="text-uppercase" style="margin-top: -1em;">5.- Fechas y Salarios a cotizar</h5>
            @include('pdf.fechas-y-salarios')
        </div>
        <div class="otraPagina">
            <h5 class="text-uppercase" style="margin-top: -1em;">6.- Impuesto Sobre la Renta a pagar</h5>
            @if ($showIslr)
                <br><br><br>
                @include('pdf.islr')
            @else
                <br><br><br><br><br>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <h3>Ceros Impuestos, aunque en Noviembre de cada año pagarás un poco de ISR (Impuesto Sobre la Renta), 
                            ya que en ese mes recibes la Pensión 
                            y el Aguinaldo (2 ingresos), por lo que la tasa de ISR aumenta, SOLO PARA ESE MES.</h3>
                    </div>
                </div>
            @endif
        </div>
        <div class="otraPagina">
            <h5 class="text-uppercase" style="margin-top: -1em;">7.- Otros datos de apoyo para tomar decisiones</h5>
            @include('pdf.otros-datos-apoyo')
        </div>
        <div class="otraPagina">
            <h5 class="text-uppercase" style="margin-top: -1em;">8.- La Ruta para una PENSIÓN MILLONARIA</h5>
            <h3><strong>Ques es ?</strong></h3>
            <h5>Es la ruta guiada hacia una Pensión Millonaria</h5>

            <h3><strong>Para ques es util?</strong></h3>

            <h5>Es un Check List de las etapas que debes ir cumpliendo para que logres tu Pensión a la Medida.</h5>
            <br><br>
            <img src="img/ruta_millonaria.png" class="img-thumbnail rounded">

        </div>
        <div class="otraPagina">
            <h5 class="text-uppercase" style="margin-top: -1em;">8.- La Ruta para una PENSIÓN MILLONARIA</h5>
            <br><br><br>
            <img  src="img/ruta_millonaria_2.png" width="95%" class="img-thumbnail rounded text-center">
        </div>
        <div class="otraPagina">
            <br><br><br><br><br><br>
            <div class="col-sm-12">
                <center>
                    <img src="img/logo-xl.png" alt="" width="80%">
                </center>
            </div>
            <div class="col-sm-12 text-center">
                <h2 style="color: #FFA500">C.P. Armando Galván Armas</h2>
            </div>
        </div>
    </main>
</body>

</html>