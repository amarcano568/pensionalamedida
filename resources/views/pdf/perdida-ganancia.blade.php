<div class="row">
    <div class="col sm-12">
        <table id="table-hoja1-1" style="display: table;width: 100%" class="table-hoja-2 table table-hover">
            <tbody id="body-hoja1-1">
                <tr>
                    <td style="width: 25%">
                       
                    </td>
                    <td bgcolor="#FFA500" class="text-center" style="width: 12.5%">
                        <h3 style="text-shadow: 1px 1px 2px black, 0 0 25px, 0 0 5px ;color: white;">1
                        </h3>
                    </td>
                    <td bgcolor="#FFA500" class="text-center" style="width: 12.5%">
                        <h3 style="text-shadow: 1px 1px 2px black, 0 0 25px, 0 0 5px ;color: white;">2
                        </h3>
                    </td>
                    <td bgcolor="#FFA500"  class="text-center"style="width: 12.5%">
                        <h3 style="text-shadow: 1px 1px 2px black, 0 0 25px, 0 0 5px ;color: white;">3
                        </h3>
                    </td>
                    <td bgcolor="#FFA500" class="text-center" style="width: 12.5%">
                        <h3 style="text-shadow: 1px 1px 2px black, 0 0 25px, 0 0 5px ;color: white;">4
                        </h3>
                    </td>
                    <td bgcolor="#FFA500" class="text-center" style="width: 12.5%">
                        <h3 style="text-shadow: 1px 1px 2px black, 0 0 25px, 0 0 5px ;color: white;">5
                        </h3>
                    </td>
                    <td bgcolor="#FFA500" class="text-center" style="width: 12.5%">
                        <h3 style="text-shadow: 1px 1px 2px black, 0 0 25px, 0 0 5px ;color: white;">6
                        </h3>
                    </td>
                  
                </tr>
                <tr style="height: 4em;">
                    <td style="vertical-align : middle" class="text-center">
                        Pensión Total Acumulada (PTA) CON M40
                    </td>
                    @foreach ($pensiones as $item)
                        <?php
                            if ($item->hoja == 'hoja-1'){
                                $pension_Acum_Sin_M40 = $item->dif85;
                            }
                         ?>
                        <td style="vertical-align : middle" class="text-center">
                            <strong>{{number_format($item->dif85, 2, '.', ',')}}</strong>
                        </td>
                    @endforeach                  
                </tr>
                <tr>
                    <td bgcolor="#F2DEDE" colspan="7">
                        <strong>Menos (-)</strong>
                    </td>
                </tr>
                <tr style="height: 4em;">
                    <td style="vertical-align : middle" class="text-center">
                        Pensión Total Acumulada (PTA) SIN M40
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                       <strong>{{number_format($pension_Acum_Sin_M40, 2, '.', ',')}}</strong>
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                       <strong>{{number_format($pension_Acum_Sin_M40, 2, '.', ',')}}</strong>
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                       <strong>{{number_format($pension_Acum_Sin_M40, 2, '.', ',')}}</strong>
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                       <strong>{{number_format($pension_Acum_Sin_M40, 2, '.', ',')}}</strong>
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                       <strong>{{number_format($pension_Acum_Sin_M40, 2, '.', ',')}}</strong>
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                       <strong>{{number_format($pension_Acum_Sin_M40, 2, '.', ',')}}</strong>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#DFF0D8" colspan="7">
                        <strong>Igual (=)</strong>
                    </td>
                </tr>
                <tr style="height: 4em;">
                    <td style="vertical-align : middle" class="text-center">
                        INGRESO ADICIONAL ACUMULADO (IAA)
                    </td>
                    <td class="text-center" style="vertical-align : middle" >
                       <h6>EL 100%</h6>
                    </td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-center">
                                <strong>{{number_format($item->dif85 - $pension_Acum_Sin_M40, 2, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach 
                  
                </tr>
                <tr>
                    <td bgcolor="#F2DEDE" colspan="7">
                        <strong>Menos (-)</strong>
                    </td>
                </tr>
                <tr style="height: 4em;">
                    <td style="vertical-align : middle" class="text-center" colspan="2">
                        Dinero invertido en Coop + Mod 40
                    </td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-center">
                                <strong>{{number_format($item->invertido_coop_m40, 2, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach 
                   
                </tr>
                <tr style="height: 4em;">
                    <td style="vertical-align : middle" class="text-center" colspan="2">
                        <span>= Ganancia Neta Acumulada de la GPA
                       <strong class="text-danger float-right">A - B</strong></span>
                    </td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-center">
                                <strong>{{number_format(($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40, 2, '.', ',')}}</strong>
                            </td>
                        @endif
                    @endforeach 
                </tr>
                <tr style="height: 4em;">
                    <td style="vertical-align : middle" class="text-center" colspan="2">
                        Porcentaje del Ingreso Adicional Acumulado
                    </td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-center">
                                <strong>{{number_format(((($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40)/($item->dif85 - $pension_Acum_Sin_M40))*100, 2, '.', ',')}}%</strong>
                            </td>
                        @endif
                    @endforeach 
                </tr>
                <tr class="text-danger">
                    <td colspan="2" class="text-center">
                        <h4>Cuantas veces se recupera lo invertido en Mod 40</h4>
                    </td>
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <td style="vertical-align : middle" class="text-center">
                                <h4>{{number_format((($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40)/$item->invertido_coop_m40, 2, '.', ',')}}</h4>
                            </td>
                        @endif
                    @endforeach 
                </tr>

                {{-- <tr>
                    <td bgcolor="#F2DEDE" colspan="7">
                        <strong>Menos (-)</strong>
                    </td>
                </tr>
                <tr style="height: 4em;">
                    <td style="vertical-align : middle" class="text-center" colspan="2" class="text-center">
                        Pensión no cobrada por el tiempo que se invierte en la Modalidad 40
                    </td>
                   
                    <td style="vertical-align : middle" class="text-center">
                       <h4>$ {{ number_format($pension_1_4[0] * 12 + $pension_1_4[0] * 1 * 0.85, 2, '.', ',') }}</h4>
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                        <h4>$ {{ number_format($pension_1_4[0] * 12 + $pension_1_4[0] * 1 * 0.85, 2, '.', ',') }}</h4>
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                       
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                        <h4>$ {{ number_format($pension_1_4[1] * 24 + $pension_1_4[1] * 2 * 0.85, 2, '.', ',') }}</h4>
                    </td>
                    <td style="vertical-align : middle" class="text-center">
                        <h4>$ {{ number_format($pension_1_4[1] * 24 + $pension_1_4[1] * 2 * 0.85, 2, '.', ',') }}</h4>
                    </td>
                </tr>
                <tr style="height: 4em;" bgcolor="#DFF0D8">
                    <td style="vertical-align : middle" class="text-center" colspan="2">
                        <h5>= Ganancia menos ingresos no cobrados</h5>
                    </td>
                    @foreach ($pensiones as $item)
                    @if ($item->hoja == 'hoja-2' or $item->hoja == 'hoja-3')
                        <td style="vertical-align : middle" class="text-center">
                            <h4>$ {{number_format(((($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40))-($pension_1_4[0] * 12 + $pension_1_4[0] * 1 * 0.85), 2, '.', ',')}}</h4>
                        </td>
                    @endif
                    @if ($item->hoja == 'hoja-4')
                        <td style="vertical-align : middle" class="text-center">
                            <h4>$ {{number_format(((($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40)), 2, '.', ',')}}</h4>
                        </td>
                    @endif
                    @if ($item->hoja == 'hoja-5' or $item->hoja == 'hoja-6')
                        <td style="vertical-align : middle" class="text-center">
                            <h4>$ {{number_format(((($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40))-($pension_1_4[1] * 24 + $pension_1_4[1] * 2 * 0.85), 2, '.', ',')}}</h4>
                        </td>
                    @endif
                @endforeach 
                </tr> --}}
            </tbody>
        </table>
        {{-- <table>
            <tr>
                <td>
                    <h5 class="text-danger">Dos datos importantes en este reporte:</h5>
                    <p>1.- La Ganancia Neta acumulada es generada por lo invertido en M40.</p>
                    <p>2.- Aunque inviertes mucho en M40, en tu caso recuperas lo invertido de 8.6 a 13.9  veces, dependiendo la Opción que elijas.</p>
                </td>
            </tr>
        </table> --}}
    </div>
</div>