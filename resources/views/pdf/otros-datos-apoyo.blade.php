
<div class="row">
    <div class="col sm-12">
        <table id="table-hoja1-1" style="display: table;width: 100%" class="table-hoja-2 table table-hover">
            <tbody id="body-hoja1-1" class=" text-uppercase">
                <tr class="radiografia-title-font-size">
                    <td colspan="3" style="width: 25%" class="text-center">
                       
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
                    <td colspan="8" style="vertical-align : middle" class="text-left">
                        <strong>Pensión Mensual</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td rowspan="3" style="vertical-align : middle">
                        MONTO DE PENSIÓN
                    </td>
                    <td style="vertical-align : middle" class="text-center">REQUERIDA</td>
                    <td style="vertical-align : middle" class="text-center">Máxima</td>
                    <td style="vertical-align : middle"><strong>{{number_format($expectativas->rangoPensionA, 2, '.', ',')}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{number_format($expectativas->rangoPensionA, 2, '.', ',')}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{number_format($expectativas->rangoPensionA, 2, '.', ',')}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{number_format($expectativas->rangoPensionA, 2, '.', ',')}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{number_format($expectativas->rangoPensionA, 2, '.', ',')}}</strong></td>
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td colspan="2" style="vertical-align : middle" >CALCULADA</td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle"><strong>{{number_format($item->pension_mensual, 2, '.', ',')}}</strong></td>
                        @endif
                    @endforeach
                    
                    
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td colspan="2" style="vertical-align : middle">% de efectividad</td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle"><strong>{{number_format(($item->pension_mensual/$expectativas->rangoPensionA)*100, 2, '.', ',')}}%</strong></td>
                        @endif
                    @endforeach
                </tr>

                <tr bgcolor="#DFF0D8" style="height: 2em;" >
                    <td colspan="8" style="vertical-align : middle" class="text-left">
                        <strong>Inversión Total</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td rowspan="4" style="vertical-align : middle" class="text-center">
                        MONTO DE PENSIÓN
                    </td>
                    <td colspan="2" style="vertical-align : middle">Máxima monto (A)</td>
                    <td style="vertical-align : middle"><strong>{{number_format($maxima_en_monto, 2, '.', ',')}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{number_format($maxima_en_monto, 2, '.', ',')}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{number_format($maxima_en_monto, 2, '.', ',')}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{number_format($maxima_en_monto, 2, '.', ',')}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{number_format($maxima_en_monto, 2, '.', ',')}}</strong></td>
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td colspan="2" style="vertical-align : middle" >CALCULADA (B)</td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle"><strong>{{number_format($item->costo_total, 2, '.', ',')}}</strong></td>
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td colspan="2" style="vertical-align : middle">Diferencia   ( A - B )</td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-danger"><strong>{{number_format($item->costo_total-$maxima_en_monto, 2, '.', ',')}}</strong></td>
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td colspan="2" style="vertical-align : middle">% de efectividad</td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-danger"><strong>{{number_format(($item->costo_total-($expectativas->rangoInversionA*$cliente->edad_abs_faltante))/($maxima_en_monto)*100, 2, '.', ',')}}%</strong></td>
                        @endif
                    @endforeach
                </tr>
                
                <tr bgcolor="#DFF0D8" style="height: 2em;" >
                    <td colspan="8" style="vertical-align : middle" class="text-left">
                        <strong>Edad</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td colspan="3" style="vertical-align : middle">
                        Edad requerida x trabajador
                    </td>
                    <td style="vertical-align : middle"><strong>{{$expectativas->edadA}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{$expectativas->edadA}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{$expectativas->edadA}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{$expectativas->edadA}}</strong></td>
                    <td style="vertical-align : middle"><strong>{{$expectativas->edadA}}</strong></td>
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td colspan="3" style="vertical-align : middle">
                        CALCULADA
                    </td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle"><strong>{{85-$item->dif85_text}}</strong></td>
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td colspan="3" style="vertical-align : middle">
                        % de diferencia
                    </td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle"><strong>{{number_format(((85-$item->dif85_text-$expectativas->edadA)/$expectativas->edadA)*100, 2, '.', ',')}}%</strong></td>
                        @endif
                    @endforeach
                </tr>

                <tr bgcolor="#DFF0D8" style="height: 2em;" >
                    <td colspan="8" style="vertical-align : middle" class="text-left">
                        <strong>Ganancia Neta Acumulada (GNA)</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;" class="text-center">
                    <td colspan="3" style="vertical-align : middle" class="text-center">
                        Inversión Total pagada
                    </td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle"><strong>{{number_format($item->costo_total, 2, '.', ',')}}</strong></td>
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td colspan="3" style="vertical-align : middle" class="text-center">
                        GNA (ver Lámina 4, Pag 10)
                    </td>
                    @foreach ($pensiones as $item)
                        @php
                            if ($item->hoja == 'hoja-1'){
                                $pension_Acum_Sin_M40 = $item->dif85;
                            }
                        @endphp
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-center">
                                <strong>{{number_format(($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40, 2, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach 
                </tr>
                <tr style="height: 2.5em;">
                    <td colspan="3" style="vertical-align : middle" class="text-center">
                        Veces Ganancia cubre Inversión
                    </td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-center">
                                <strong>{{number_format((($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40)/$item->costo_total, 2, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach 
                </tr>

                <tr bgcolor="#DFF0D8" style="height: 2em;" >
                    <td colspan="8" style="vertical-align : middle" class="text-left">
                        <strong>Disfrute de la Pensión - 85 Años</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td rowspan="2" style="vertical-align : middle" class="text-center">
                        Tiempo proyectado como beneficiario
                    </td>
                    <td colspan="2" style="vertical-align : middle" class="text-center">Años</td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-center">
                                <strong>{{number_format($item->dif85_text, 2, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach 
                </tr>
                <tr style="height: 2.5em;">
                    <td colspan="2" style="vertical-align : middle" class="text-center">Días</td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-center">
                                <strong>{{number_format($item->dif85_text*365, 0, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach 
                </tr>

                <tr bgcolor="#DFF0D8" style="height: 2em;" >
                    <td colspan="8" style="vertical-align : middle" class="text-left">
                        
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td colspan="3" style="vertical-align : middle" class="text-center">
                        Último Salario contratado Mod40
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='ULTIMO-SALARIO-CONTRATADO-MOD40' && $item->tipo=='OTROS-DATOS-APOYO')
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
                    <td colspan="3" style="vertical-align : middle" class="text-center">
                        Salario promedio resultante para la pensión
                    </td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-center">
                                <strong>{{number_format($item->salario_diario_promedio, 2, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach 
                </tr>
                <tr style="height: 2.5em;">
                    <td colspan="3" style="vertical-align : middle" class="text-center">
                        <strong>Índice de Aprovechamiento</strong>
                    </td>
                    @foreach ($tmp_fecha_salario as $item)
                        @if ($item->item=='INDICE_DE_APROVECHAMIENTO' && $item->tipo=='OTROS-DATOS-APOYO')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{$item->$hoja}}%</strong>
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