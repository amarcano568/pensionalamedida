<div class="row">
    <div class="col sm-12">
        <table id="table-variaciones-1" style="display: table;width: 100%" class="table-hoja-2 table table-hover">
            <tbody id="body-variaciones-1">
                <tr class="text-uppercase" style="height: 2.5em;">
                    <td class="text-center" rowspan="2" colspan="2" style="vertical-align : middle;width: 55%" >
                        <strong>1.- EDAD PARA PENSIONARTE</strong>
                    </td>
                    <td bgcolor="#DFF0D8" style="vertical-align : middle;width: 15%" class="text-center">
                        <strong>DE</strong>
                    </td>
                    <td bgcolor="#DFF0D8" style="vertical-align : middle;width: 15%" class="text-center">
                        <strong>A</strong>
                    </td>
                    <td colspan="2" bgcolor="#DFF0D8"  style="vertical-align : middle;width: 15%" class="text-center">
                        <strong>AÑOS QUE FALTAN</strong>
                    </td>
                </tr>
                <tr class="text-uppercase" style="height: 2.5em;">

                    <td style="vertical-align : middle;width: 15%"  class="text-center">
                        <strong>{{ $expectativas->edadDe}}</strong>
                    </td>
                    <td style="vertical-align : middle;width: 15%" class="text-center" >
                        <strong>{{ $expectativas->edadA}}</strong>
                    </td>
                    <td colspan="2" style="vertical-align : middle;width: 15%" >
                    <strong>{{ $cliente->edad_faltante}}</strong>
                    </td>
                </tr>
                <tr class="text-uppercase" style="height: 2.5em;">
                    <td class="text-center" rowspan="2" colspan="2" style="vertical-align : middle;width: 50%" >
                        <strong>2.- RANGO DE PENSION RAZONABLEMENTE ESPERADO</strong>
                    </td>
                   
                    <td colspan="4" bgcolor="#DFF0D8"  style="vertical-align : middle;width: 50%" class="text-center">
                        <strong>MENSUAL</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td colspan="2" style="vertical-align : middle;width: 25%" class="text-center">
                        $ <strong>{{ number_format($expectativas->rangoPensionDe, 2, '.', ',') }}</strong>
                    </td>
                    <td colspan="2" style="vertical-align : middle;width: 25%" class="text-center">
                        $ <strong>{{ number_format($expectativas->rangoPensionA, 2, '.', ',') }}</strong>
                    </td>
                </tr>
                <tr class="text-uppercase" style="height: 2.5em;">
                    <td class="text-center" rowspan="2" colspan="2" style="vertical-align : middle;width: 50%" >
                        <strong>3.- RANGO DE INVERSION EN M40</strong>
                    </td>
                    <td colspan="4" bgcolor="#DFF0D8" style="vertical-align : middle;width: 50%" class="text-center">
                        <strong>PAGOS</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td colspan="2"  style="vertical-align : middle;width: 25%" class="text-center">
                        $ <strong>{{ number_format($expectativas->rangoInversionDe, 2, '.', ',') }}</strong>
                    </td>
                    <td colspan="2"  style="vertical-align : middle;width: 25%" class="text-center">
                        $ <strong>{{ number_format($expectativas->rangoInversionA, 2, '.', ',') }}</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="height: 2.5em;" class="text-center" bgcolor="#DFF0D8">
                    <td><strong>NOMBRE</strong></td>
                    <td><strong>EDAD</strong></td>
                    <td><strong>NSS</strong></td>
                    <td><strong>CURP</strong></td>
                    <td colspan="2"><strong> FAMILIARES</strong></td>
                </tr>
                <tr style="height: 2.5em;" class="text-center" >
                    <td><strong>{{ $cliente->nombre }} {{ $cliente->apellidos }}</strong></td>
                    <td><strong>{{ $cliente->edad }}</strong></td>
                    <td><strong>{{$cliente['nroSeguridadSocial']}}</strong></td>
                    <td><strong>{{$cliente['nroDocumento']}}</strong></td>
                    <td colspan="2">
                        <strong>Esposa: {{$expectativas->esposa}} </strong>
                        @if ($expectativas->hijos>0)
                            <br>
                            <strong>Hijos: {{$expectativas->hijos}} </strong>
                        @endif
                        @if ($expectativas->padres>0)
                            <br>
                            <strong>Padres: {{$expectativas->padres}} </strong>
                        @endif
                    </td>
                </tr>
                <tr style="height: 2.5em;" class="text-center" bgcolor="#DFF0D8">
                    <td style="vertical-align : middle;"><strong>FECHA DE BAJA</strong></td>
                    <td style="vertical-align : middle;"><strong>SEMANAS COTIZADAS</strong></td>
                    <td style="vertical-align : middle;"><strong>SEMANAS DESCONTADAS</strong></td>
                    <td style="vertical-align : middle;"><strong>TOTAL SEMANAS</strong></td>
                    <td style="vertical-align : middle;" colspan="2"><strong>FECHA DEL PLAN</strong></td>
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td style="vertical-align : middle;"><strong>{{$expectativas->fechaRetiro}}</strong></td>
                    <td style="vertical-align : middle;"><strong>{{$expectativas->semanasCotizadas}}</strong></td>
                    <td style="vertical-align : middle;"><strong>{{$expectativas->semanasDescontadas}}</strong></td>
                    <td style="vertical-align : middle;"><strong>{{$expectativas->semanasCotizadas - $expectativas->semanasDescontadas}}</strong></td>
                    <td style="vertical-align : middle;" colspan="2"><strong>{{Carbon\Carbon::parse($expectativas->fechaPlan)->format('d-m-Y')}}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>