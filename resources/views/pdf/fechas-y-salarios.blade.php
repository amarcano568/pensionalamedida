<div class="row">
    <div class="col sm-12">
        <table id="table-hoja1-1" style="display: table;width: 100%" class="table-hoja-2 table table-hover">
            <tbody id="body-hoja1-1" class=" text-uppercase">
                <tr class="radiografia-title-font-size">
                    <td style="width: 25%" class="text-center">
                       
                    </td>
                    <td bgcolor="#FFA500" class="text-center" style="width: 12.5%">
                        <h5 class="radiografia-title-font-size">2</h5>
                    </td>
                    <td bgcolor="#FFA500"  class="text-center"style="width: 12.5%">
                        <h5 class="radiografia-title-font-size">3</h5>
                    </td>
                    <td bgcolor="#FFA500" class="text-center" style="width: 12.5%">
                        <h5 class="radiografia-title-font-size">4</h5>
                    </td>
                    <td bgcolor="#FFA500" class="text-center" style="width: 12.5%">
                        <h5 class="radiografia-title-font-size">5</h5>
                    </td>
                    <td bgcolor="#FFA500" class="text-center " style="width: 12.5%">
                        <h5 class="radiografia-title-font-size">6</h5>
                    </td>
                   
                </tr>
                <tr bgcolor="#DFF0D8" style="height: 2em;" >
                    <td colspan="6" style="vertical-align : middle" class="text-left">
                        <strong>A) Continuación Empleo actual</strong>
                    </td>
                </tr>
                
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Fecha de corte para este Plan
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Desde' && $item->tipo=='EMPLEO_ACTUAL')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Fecha de la futura baja
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Hasta' && $item->tipo=='EMPLEO_ACTUAL')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Años cotizados
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Anos' && $item->tipo=='EMPLEO_ACTUAL')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Meses cotizados
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Meses' && $item->tipo=='EMPLEO_ACTUAL')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Salario Diario Base de Cotización
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Salarios' && $item->tipo=='EMPLEO_ACTUAL')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr bgcolor="#DFF0D8" style="height: 2em;" >
                    <td colspan="6" style="vertical-align : middle" class="text-left">
                        <strong>B) Cooperativa</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Fecha de alta 
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Desde' && $item->tipo=='COOPERATIVA')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Fecha de baja
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Hasta' && $item->tipo=='COOPERATIVA')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Años cotizados
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Anos' && $item->tipo=='COOPERATIVA')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Meses cotizados
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Meses' && $item->tipo=='COOPERATIVA')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Salario Diario Base de Cotización
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Salarios' && $item->tipo=='COOPERATIVA')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr bgcolor="#DFF0D8" style="height: 2em;" >
                    <td colspan="6" style="vertical-align : middle" class="text-left">
                        <strong>C) Modalidad 40 - ALTA</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;vertical-align : middle">
                    <td style="vertical-align : middle" class="text-left">
                        Fecha de inicio 
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Desde' && $item->tipo=='M40-ALTA')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;vertical-align : middle">
                    <td style="vertical-align : middle" class="text-left">
                        Fecha de terminación
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Hasta' && $item->tipo=='M40-ALTA')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Años a cotizar
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Anos' && $item->tipo=='M40-ALTA')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Meses a cotizar
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Meses' && $item->tipo=='M40-ALTA')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Salario Diario Base de Cotización
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='Salarios' && $item->tipo=='M40-ALTA')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr bgcolor="#E8E78E" style="height: 2em;" >
                    <td colspan="6" style="vertical-align : middle" class="text-left">
                        <strong>D) M40 - Salario mensual teórico y pagos</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle;" class="text-left">
                        Salario mensual teórico contratado
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='SALARIO-MENSUAL-TEORICO-CONTRATADO' && $item->tipo=='M40-SALARIO-MENSUAL-TEORICO-Y-PAGOS')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle;" class="text-left">
                        Pago mensual de la M40 ALTA
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='PAGO-MENSUAL-DE-LA-M40-ALTA' && $item->tipo=='M40-SALARIO-MENSUAL-TEORICO-Y-PAGOS')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr bgcolor="#E8E78E"  style="height: 2em;" >
                    <td colspan="6" style="vertical-align : middle" class="text-left">
                        <strong>D) INVERSIÓN TOTAL DE TIEMPO</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle;" class="text-left">
                        MESES
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='MESES' && $item->tipo=='INVERSION-TOTAL-DE-TIEMPO')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle;" class="text-left">
                        AÑOS
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='ANOS' && $item->tipo=='INVERSION-TOTAL-DE-TIEMPO')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle;" class="text-left">
                        SEMANAS
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='SEMANAS' && $item->tipo=='INVERSION-TOTAL-DE-TIEMPO')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>