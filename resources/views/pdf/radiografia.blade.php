<div class="row">
    <div class="col sm-12">
        <table id="table-hoja1-1" style="display: table;width: 100%" class="table-hoja-2 table table-hover">
            <tbody id="body-hoja1-1">
                <tr class="radiografia-title-font-size">
                    <td style="width: 25%" class="text-center">
                       
                    </td>
                    <td bgcolor="#FFA500" class="text-center" style="width: 12.5%">
                        <h5 class="radiografia-title-font-size">1</h5>
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
                <tr style="height: 2em;">
                    <td style="vertical-align : middle" class="text-center">
                        <strong>INVERSION TOTAL</strong>
                    </td>
                    <td colspan="6"></td>
                </tr>
                
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        A) M40 - Cooperativa
                    </td>
                    <td bgcolor="#EBEDEF" rowspan="11" style="vertical-align : middle" class="text-center">
                        <h4>Sin Modalidad 40</h4>
                    </td>
                    @foreach ($tmp as $item)
                        @if ($item->estrategia=='2' && $item->tipo=='INVERSION_TOTAL')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{number_format($item->$hoja, 2, '.', ',')}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        B) M40 - Retroactivo
                    </td>
                    @foreach ($tmp as $item)
                    @if ($item->estrategia=='3' && $item->tipo=='INVERSION_TOTAL')
                        @for ($i = 2; $i <= 6; $i++)
                            @php
                                $hoja = 'hoja'.$i
                            @endphp
                            @if ($item->$hoja == 0)
                                <td style="vertical-align : middle" class="text-center">
                                </td>
                            @else
                                <td style="vertical-align : middle" class="text-center">
                                    <strong>{{number_format($item->$hoja, 2, '.', ',')}}</strong>
                                </td>
                            @endif
                        @endfor
                    @endif
                @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Recargos x Retroactivo
                    </td>
                   
                    <td style="vertical-align : middle" class="text-center">
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        C) M40 - ya pagado
                    </td>
                    @foreach ($tmp as $item)
                    @if ($item->estrategia=='4' && $item->tipo=='INVERSION_TOTAL')
                        @for ($i = 2; $i <= 6; $i++)
                            @php
                                $hoja = 'hoja'.$i
                            @endphp
                            @if ($item->$hoja == 0)
                                <td style="vertical-align : middle" class="text-center">
                                </td>
                            @else
                                <td style="vertical-align : middle" class="text-center">
                                    <strong>{{number_format($item->$hoja, 2, '.', ',')}}</strong>
                                </td>
                            @endif
                        @endfor
                    @endif
                @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        D) M40 - Por pagar
                    </td>
                    @foreach ($tmp as $item)
                        @if ($item->estrategia=='6' && $item->tipo=='INVERSION_TOTAL')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{number_format($item->$hoja, 2, '.', ',')}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                @php
                    $inv_tota_hoja2 = 0;
                    $inv_tota_hoja3 = 0;
                    $inv_tota_hoja4 = 0;
                    $inv_tota_hoja5 = 0;
                    $inv_tota_hoja6 = 0;
                    foreach ($estrategias as $item) {
                        if ($item->hoja=='hoja-2'){
                            $inv_tota_hoja2 += $item->costo;
                        }
                        if ($item->hoja=='hoja-3'){
                            $inv_tota_hoja3 += $item->costo;
                        }
                        if ($item->hoja=='hoja-4'){
                            $inv_tota_hoja4 += $item->costo;
                        }
                        if ($item->hoja=='hoja-5'){
                            $inv_tota_hoja5 += $item->costo;
                        }
                        if ($item->hoja=='hoja-6'){
                            $inv_tota_hoja6 += $item->costo;
                        }
                    }
                @endphp
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-center">
                       
                    </td>
                    <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center">
                        $ <strong>{{number_format($inv_tota_hoja2, 2, '.', ',')}}</strong>
                    </td>
                    <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center">
                        $ <strong>{{number_format($inv_tota_hoja3, 2, '.', ',')}}</strong>
                    </td>
                    <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center">
                        $ <strong>{{number_format($inv_tota_hoja4, 2, '.', ',')}}</strong>
                    </td>
                    <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center">
                        $ <strong>{{number_format($inv_tota_hoja5, 2, '.', ',')}}</strong>
                    </td>
                    <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center">
                        $ <strong>{{number_format($inv_tota_hoja6, 2, '.', ',')}}</strong>
                    </td>
                </tr>
                <tr style="height: 2em;">
                    <td style="vertical-align : middle" class="text-center">
                        <strong>PAGOS MENSUALES</strong>
                    </td>
                    <td colspan="6"></td>
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        A) Cooperativa 
                    </td>
                    @foreach ($tmp as $item)
                        @if ($item->estrategia=='2' && $item->tipo=='PAGOS_MENSUAL')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{number_format($item->$hoja, 2, '.', ',')}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        B) M40 - Retroactivo
                    </td>
                    @foreach ($tmp as $item)
                        @if ($item->estrategia=='3' && $item->tipo=='PAGOS_MENSUAL')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{number_format($item->$hoja, 2, '.', ',')}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        C) M40 - ya pagado
                    </td>
                    @foreach ($tmp as $item)
                        @if ($item->estrategia=='4' && $item->tipo=='PAGOS_MENSUAL')
                            @for ($i = 2; $i <= 6; $i++)
                                @php
                                    $hoja = 'hoja'.$i
                                @endphp
                                @if ($item->$hoja == 0)
                                    <td style="vertical-align : middle" class="text-center">
                                    </td>
                                @else
                                    <td style="vertical-align : middle" class="text-center">
                                        <strong>{{number_format($item->$hoja, 2, '.', ',')}}</strong>
                                    </td>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        D) M40 - Por pagar
                    </td>
                    @foreach ($tmp as $item)
                    @if ($item->estrategia=='6' && $item->tipo=='PAGOS_MENSUAL')
                        @for ($i = 2; $i <= 6; $i++)
                            @php
                                $hoja = 'hoja'.$i
                            @endphp
                            @if ($item->$hoja == 0)
                                <td style="vertical-align : middle" class="text-center">
                                </td>
                            @else
                                <td style="vertical-align : middle" class="text-center">
                                    <strong>{{number_format($item->$hoja, 2, '.', ',')}}</strong>
                                </td>
                            @endif
                        @endfor
                    @endif
                @endforeach
                </tr>
                <tr style="height: 1.5em!important;vertical-align : middle">
                    <td colspan="8">
                        <h6 class="text-danger text-uppercase">Cifras resultantes para Pensión</h6>
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Semanas cotizadas
                    </td>
                    @foreach ($pensiones as $item)                        
                        @if ($item->semanas_cotizadas == 0)
                            <td style="vertical-align : middle" class="text-center"></td>
                        @else
                            <td style="vertical-align : middle" class="text-center">
                                <strong>{{$item->semanas_cotizadas}}</strong>
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Salario promedio obtenido
                    </td>
                    @foreach ($pensiones as $item)                        
                        @if ($item->salario_diario_promedio == 0)
                            <td style="vertical-align : middle" class="text-center"></td>
                        @else
                            <td style="vertical-align : middle" class="text-center">
                                <strong>{{number_format($item->salario_diario_promedio, 2, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td rowspan="2" style="vertical-align : middle" class="text-center">
                        <h6 class=" text-uppercase">Edad para pensionarte</h6>
                    </td>
                    @foreach ($pensiones as $item)      
                
                        @if ($item->edad_real_pension == 0)
                            <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center"></td>
                        @else
                            <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center">
                                <strong>{{$item->edad_real_pension}}</strong>
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    @foreach ($pensiones as $item)      
                        @if ($item->porc_pension == 0)
                            <td bgcolor="#FFC266" style="vertical-align : middle" class="text-center"></td>
                        @else
                            <td bgcolor="#FFC266" style="vertical-align : middle" class="text-center">
                                <strong>{{$item->porc_pension}}</strong>
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 1.5em!important;vertical-align : middle">
                    <td colspan="8">
                        <h6 class="text-success text-uppercase">Ingresos</h6>
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        1.- PENSIÓN MENSUAL promedio
                    </td>
                    @foreach ($pensiones as $item)      
                        @if ($item->pension_mensual == 0)
                            <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center"></td>
                        @else
                            <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center">
                                <strong>{{number_format($item->pension_mensual, 2, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        2.- AGUINALDO en Nov de cada año
                    </td>
                    @foreach ($pensiones as $item)      
                        @if ($item->aguinaldo == 0)
                            <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center"></td>
                        @else
                            <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center">
                                <strong>{{number_format($item->aguinaldo, 2, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left label-radiografia-pension-acum-85">
                        PENSIÓN TOTAL ACUMULADA a 85 años
                    </td>
                    @foreach ($pensiones as $item)      
                        @if ($item->dif85 == 0)
                            <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center"></td>
                        @else
                            <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center">
                                <strong>{{number_format($item->dif85, 2, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 1.5em!important;vertical-align : middle">
                    <td colspan="8">
                        <h6 class="text-success text-uppercase">Indicadores</h6>
                    </td>
                </tr>
                @php
                    $pension_mensual_hoja2 = 0;
                    $pension_mensual_hoja3 = 0;
                    $pension_mensual_hoja4 = 0;
                    $pension_mensual_hoja5 = 0;
                    $pension_mensual_hoja6 = 0;
                    foreach ($pensiones as $item) {
                        if ($item->hoja=='hoja-2'){
                            $pension_mensual_hoja2 += $item->pension_mensual;
                        }
                        if ($item->hoja=='hoja-3'){
                            $pension_mensual_hoja3 += $item->pension_mensual;
                        }
                        if ($item->hoja=='hoja-4'){
                            $pension_mensual_hoja4 += $item->pension_mensual;
                        }
                        if ($item->hoja=='hoja-5'){
                            $pension_mensual_hoja5 += $item->pension_mensual;
                        }
                        if ($item->hoja=='hoja-6'){
                            $pension_mensual_hoja6 += $item->pension_mensual;
                        }
                    }
                @endphp
                <tr style="height: 2.5em;">
                    <td colspan="2" style="vertical-align : middle" class="text-left">
                        3.- RECUPERACIÓN de tu inversión en (Meses)
                    </td>
                    <td bgcolor="#EBEDEF" style="vertical-align : middle" class="text-center">
                        {{  number_format($inv_tota_hoja2/$pension_mensual_hoja2, 2, '.', ',') }}
                    </td>
                    <td bgcolor="#EBEDEF" style="vertical-align : middle" class="text-center">
                        {{  number_format($inv_tota_hoja3/$pension_mensual_hoja3, 2, '.', ',') }}
                    </td>
                    <td bgcolor="#EBEDEF" style="vertical-align : middle" class="text-center">
                        {{  number_format($inv_tota_hoja4/$pension_mensual_hoja4, 2, '.', ',') }}
                    </td>
                    <td bgcolor="#EBEDEF" style="vertical-align : middle" class="text-center">
                        {{  number_format($inv_tota_hoja5/$pension_mensual_hoja5, 2, '.', ',') }}
                    </td>
                    <td bgcolor="#EBEDEF" style="vertical-align : middle" class="text-center">
                        {{  number_format($inv_tota_hoja6/$pension_mensual_hoja6, 2, '.', ',') }}
                    </td>
                </tr>
                <tr style="height: 2.5em;">
                    <td colspan="2" style="vertical-align : middle" class="text-left">
                        4.- RENDIMIENTO ANUAL  de tu Inversión
                    </td>
                    @php
                        $hoja = 2;
                    @endphp
                    @foreach ($pensiones as $item)  
                        @if ($item->hoja != 'hoja-1')
                            @if ($item->rendimiento_anual == 0)
                                <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center"></td>
                            @else
                                <td bgcolor="#DFF0D8" style="vertical-align : middle" class="text-center">
                                    @if ($item->hoja == 'hoja-2')
                                        <strong>{{number_format(($item->rendimiento_anual/$inv_tota_hoja2)*100, 2, '.', ',')}}%</strong>
                                    @elseif ($item->hoja == 'hoja-3')
                                        <strong>{{number_format(($item->rendimiento_anual/$inv_tota_hoja3)*100, 2, '.', ',')}}%</strong>
                                    @elseif ($item->hoja == 'hoja-4')
                                        <strong>{{number_format(($item->rendimiento_anual/$inv_tota_hoja4)*100, 2, '.', ',')}}%</strong>
                                    @elseif ($item->hoja == 'hoja-5')
                                        <strong>{{number_format(($item->rendimiento_anual/$inv_tota_hoja5)*100, 2, '.', ',')}}%</strong>
                                    @elseif ($item->hoja == 'hoja-6')
                                        <strong>{{number_format(($item->rendimiento_anual/$inv_tota_hoja6)*100, 2, '.', ',')}}%</strong>   
                                    @endif
                                </td>
                            @endif
                        @endif    
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>