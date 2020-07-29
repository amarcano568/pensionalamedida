<div class="row">
    <div class="col sm-12">
        <table id="table-variaciones-1" style="display: table;width: 100%" class="table-hoja-2 table table-hover">
            <tbody id="body-variaciones-1">
                <tr style="height: 2em;">
                    <td colspan="7" style="vertical-align : middle" class="text-center text-uppercase">
                        <strong>Aumentos en las Semanas y el Salario base para Pensión</strong>
                    </td>
                </tr>
                
                <tr style="height: 1.5em;">
                    <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-left">
                        
                    </td>
                    <td colspan="3" bgcolor="#EBEDEF" style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones">
                        <h6>SEMANAS</h6>
                    </td>
                    <td colspan="3" bgcolor="#EBEDEF" style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones">
                        <h6>SALARIOS</h6>
                    </td>
                </tr>
                <tr class="text-uppercase" bgcolor="#DFF0D8" style="height: 2.5em;">
                    <td style="border-right: 5px solid#28A745;vertical-align : middle;width: 14.25%" class="text-center fila-variaciones">
                        <strong>Opción</strong>
                    </td>
                    <td style="vertical-align : middle;width: 14.25%" class="text-center fila-variaciones">
                        <strong>Semanas</strong>
                    </td>
                    <td style="vertical-align : middle;width: 14.25%" class="text-center fila-variaciones">
                        <strong>Diferencia V.S. Op 1</strong>
                    </td>
                    <td style="border-right: 5px solid#28A745;vertical-align : middle;width: 14.25%" class="text-center fila-variaciones">
                        <strong>% de variación</strong>
                    </td>
                    <td style="vertical-align : middle;width: 14.25%" class="text-center fila-variaciones">
                        <strong>Promedio del Salario Diario en M40</strong>
                    </td>
                    <td style="vertical-align : middle;width: 14.25%" class="text-center fila-variaciones">
                        <strong>Diferencia V.S. Op 1</strong>
                    </td>
                    <td style="border-right: 5px solid#28A745;vertical-align : middle;width: 14.25%" class="text-center fila-variaciones">
                        <strong>% de variación</strong>
                    </td>
                   
                </tr>
                @php
                    $hoja = 1;
                    
                @endphp
                @foreach ($pensiones as $item)
                    @php
                        if ($item->hoja=='hoja-1'){
                            $semanas_hoja1 = $item->semanas_cotizadas; 
                            $salario_diario_hoja1 = $item->salario_diario_promedio;
                        }
                    @endphp
                    <tr class="">
                        <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones">
                            <h5>{{$hoja++}}</h5>
                        </td>
                        <td style="vertical-align : middle" class="text-center fila-variaciones">
                            {{number_format($item->semanas_cotizadas, 0, '', ',')}}
                        </td>
                        @if ($item->hoja=='hoja-1')
                            <td style="vertical-align : middle" class="text-center fila-variaciones"></td>
                        @else
                            <td style="vertical-align : middle" class="text-center fila-variaciones">
                                {{number_format($item->semanas_cotizadas - $semanas_hoja1, 0, '', ',')}}
                            </td>
                        @endif
                        @if ($item->hoja=='hoja-1')
                            <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones"></td>
                        @else
                            <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones">
                                {{number_format((($item->semanas_cotizadas - $semanas_hoja1)/$semanas_hoja1)*100, 2, '.', ',')}}%
                            </td>
                        @endif
                        <td style="vertical-align : middle" class="text-center fila-variaciones">
                            ${{number_format($item->salario_diario_promedio, 2, '.', ',')}}
                        </td>
                        @if ($item->hoja=='hoja-1')
                            <td style="vertical-align : middle" class="text-center fila-variaciones"></td>
                        @else
                            <td style="vertical-align : middle" class="text-center fila-variaciones">
                                ${{number_format($item->salario_diario_promedio - $salario_diario_hoja1, 2, '.', ',')}}
                            </td>
                        @endif
                        @if ($item->hoja=='hoja-1')
                            <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones"></td>
                        @else
                            <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones">
                                {{number_format((($item->salario_diario_promedio - $salario_diario_hoja1)/$salario_diario_hoja1)*100, 2, '.', ',')}}%
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col sm-12">
        <table id="table-hoja1-1" style="display: table;width: 100%" class="table-hoja-2 table table-hover">
            <tbody id="body-hoja1-1">
                <tr style="height: 2em;">
                    <td colspan="7" style="vertical-align : middle" class="text-center text-uppercase">
                        <strong>Aumentos en la Pensión Mensual y en la Ganancia Neta Acumulada - GNA</strong>
                    </td>
                </tr>
                
                <tr style="height: 2.5em;" class="text-uppercase">
                    <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-left">
                        
                    </td>
                    <td colspan="3" bgcolor="#EBEDEF" style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones">
                        <h6>Pensión Mensual</h6>
                    </td>
                    <td colspan="3" bgcolor="#EBEDEF" style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones">
                        <h6>Ganancia Neta Acumulada - GNA</h6>
                    </td>
                    <td colspan="2" bgcolor="#EBEDEF" style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones">
                        <h6>Variación en porcientos</h6>
                    </td>
                </tr>
                <tr class="text-uppercase" bgcolor="#DFF0D8" style="height: 2.5em;">
                    <td style="border-right: 5px solid#28A745;vertical-align : middle;width: 12.50%" class="text-center fila-variaciones">
                        <strong>Opción</strong>
                    </td>
                    <td style="vertical-align : middle;width: 12.50%" class="text-center fila-variaciones">
                        <strong>MONTO</strong>
                    </td>
                    <td style="vertical-align : middle;width: 12.50%" class="text-center fila-variaciones">
                        <strong>Diferencia con Opción anterior</strong>
                    </td>
                    <td style="border-right: 5px solid#28A745;vertical-align : middle;width: 12.50%" class="text-center fila-variaciones">
                        <strong>Diferencia acumulada</strong>
                    </td>
                    <td style="vertical-align : middle;width: 12.50%" class="text-center fila-variaciones">
                        <strong>MONTO</strong>
                    </td>
                    <td style="vertical-align : middle;width: 12.50%" class="text-center fila-variaciones">
                        <strong>Diferencia con Opción anterior</strong>
                    </td>
                    <td style="border-right: 5px solid#28A745;vertical-align : middle;width: 12.50%" class="text-center fila-variaciones">
                        <strong>Diferencia acumulada</strong>
                    </td>
                    <td style="vertical-align : middle;width: 6.25%" class="text-center fila-variaciones">
                        <strong>Pensión</strong>
                    </td>
                    <td style="border-right: 5px solid#28A745;vertical-align : middle;width: 6.25%" class="text-center fila-variaciones">
                        <strong>GNA</strong>
                    </td>
                   
                </tr>
                @php
                    $hoja = 2;
                @endphp
                @foreach ($pensiones as $item)
                    @php
                        if ($item->hoja == 'hoja-1'){
                            $pension_Acum_Sin_M40 = $item->dif85;
                        }
                 
                        if ($item->hoja=='hoja-2'){
                            $pension_mensual_hoja2 = $item->pension_mensual; 
                            $pen_men_hoja2 = $item->pension_mensual; 
                            $ganancia_hoja2 = ($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40;
                            $gan_hoja2 = ($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40;
                            $dif_acumulada = 0;
                            $dif_acumulada_ganancia = 0;
                        }
                    @endphp
                    @if ($item->hoja <> 'hoja-1')
                        @php
                            $porc_var_pension =  $pen_men_hoja2;
                        @endphp
                        <tr style="height: 2.5em;">
                            <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones">
                                <h5>{{$hoja++}}</h5>
                            </td>
                            <td style="vertical-align : middle" class="text-center fila-variaciones">
                                ${{number_format($item->pension_mensual, 2, '.', ',')}}
                            </td>
                            @if ($item->hoja=='hoja-2')
                                <td style="vertical-align : middle" class="text-center fila-variaciones"></td>
                            @else
                                <td style="vertical-align : middle" class="text-center fila-variaciones">
                                ${{number_format($item->pension_mensual - $pension_mensual_hoja2, 2, '.', ',')}}
                                </td>
                            @endif
                            @if ($item->hoja=='hoja-2')
                                <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones"></td>
                            @else
                                <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones">
                                    ${{number_format(($item->pension_mensual - $pension_mensual_hoja2)+$dif_acumulada, 2, '.', ',')}}
                                </td>
                            @endif

                  
                            <td style="vertical-align : middle" class="text-center fila-variaciones">
                                <strong>${{number_format(($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40, 2, '.', ',')}}</strong>
                            </td>
                         

                            @if ($item->hoja=='hoja-2')
                                <td style="vertical-align : middle" class="text-center fila-variaciones"></td>
                            @else
                                <td style="vertical-align : middle" class="text-center fila-variaciones">
                                ${{number_format((($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40) - $ganancia_hoja2, 2, '.', ',')}}
                                </td>
                            @endif
                            @php
                                $dif_acumulada_ganancia = ((($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40) - $ganancia_hoja2)+$dif_acumulada_ganancia ;
                            @endphp
                            @if ($item->hoja=='hoja-2')
                                <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones"></td>
                            @else
                                <td style="border-right: 5px solid#28A745;vertical-align : middle" class="text-center fila-variaciones">
                                  ${{number_format($dif_acumulada_ganancia, 2, '.', ',')}}
                                </td>
                            @endif

                            @if ($item->hoja=='hoja-2')
                                <td style="vertical-align : middle" class="text-center fila-variaciones"></td>
                            @else
                                <td style="vertical-align : middle;" class="text-right">
                                    {{ number_format(((($item->pension_mensual - $pension_mensual_hoja2)+$dif_acumulada)/ $porc_var_pension)*100, 2, '.', ',') }}%
                                </td>
                            @endif
                            
                            @if ($item->hoja=='hoja-2')
                                <td style="vertical-align : middle;border-right: 5px solid#28A745;" class="text-center fila-variaciones"></td>
                            @else
                                <td style="vertical-align : middle;border-right: 5px solid#28A745;" class="text-right">
                                    {{ number_format(($dif_acumulada_ganancia/$gan_hoja2)*100, 2, '.', ',') }}%
                                </td>
                            @endif

                        </tr>
                        @php    
                            $dif_acumulada += $item->pension_mensual - $pension_mensual_hoja2;
                            $pension_mensual_hoja2 = $item->pension_mensual; 
                            $ganancia_hoja2 = ($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40;
                            $dif_acumulada_ganancia +=  ((($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40) - $ganancia_hoja2);
                        @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>