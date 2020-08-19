<div class="row">
    <div class="col sm-12">
        <table id="table-hoja1-1" style="display: table;width: 100%" class="table-hoja-2 table table-hover">
            <tbody id="body-hoja1-1" class=" text-uppercase">
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
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Jubilación
                    </td>
                    @foreach ($pensiones as $item)
                        <td style="vertical-align : middle" class="text-center">
                            <strong>$ {{number_format($item->jubilacion, 2, '.', ',')}}</strong>
                        </td>
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Pensión antes de Impuesto
                    </td>
                    @foreach ($pensiones as $item)
                        <td style="vertical-align : middle" class="text-center">
                            <strong>$ {{number_format($item->pension_mensual, 2, '.', ',')}}</strong>
                        </td>
                    @endforeach
                </tr>
                <tr bgcolor="#DFF0D8" style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        <strong>Ingreso total mensual</strong>
                    </td>
                    @foreach ($pensiones as $item)
                        <td style="vertical-align : middle" class="text-center">
                            <strong>$ {{number_format($item->pension_mensual+$item->jubilacion, 2, '.', ',')}}</strong>
                        </td>
                    @endforeach
                </tr>
                
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        15 UMAs al mes - Exenta
                    </td>
                    @foreach ($pensiones as $item)
                        <td style="vertical-align : middle" class="text-center">
                            <strong>$ {{number_format($item->UMAs15, 2, '.', ',')}}</strong>
                        </td>
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Base para Impuesto
                    </td>
                    @foreach ($pensiones as $item)
                        
                        <td style="vertical-align : middle" class="text-center">
                            <strong>$ {{number_format($item->base_impuesto, 2, '.', ',')}}</strong>
                        </td>
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        LI
                    </td>
                    @foreach ($pensiones as $item)
                        
                        <td style="vertical-align : middle" class="text-center">
                            <strong>$ {{number_format($item->islr_LI, 2, '.', ',')}}</strong>
                        </td>
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Exced
                    </td>
                    @foreach ($pensiones as $item)
                        
                        <td style="vertical-align : middle" class="text-center">
                            <strong>$ {{number_format($item->base_impuesto-$item->islr_LI, 2, '.', ',')}}</strong>
                        </td>
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Tasa
                    </td>
                    @foreach ($pensiones as $item)
                        
                        <td style="vertical-align : middle" class="text-center">
                            <strong>{{number_format($item->islr_tasa, 2, '.', ',')}}%</strong>
                        </td>
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        ISR x Exced
                    </td>
                    @foreach ($pensiones as $item)
                        
                        <td style="vertical-align : middle" class="text-center">
                            <strong>$ {{number_format(($item->base_impuesto-$item->islr_LI)*($item->islr_tasa/100), 2, '.', ',')}}</strong>
                        </td>
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        ISR Cuota Fija
                    </td>
                    @foreach ($pensiones as $item)
                        <td style="vertical-align : middle" class="text-center">
                            <strong>$ {{number_format($item->islr_cuota_fija, 2, '.', ',')}}</strong>
                        </td>
                    @endforeach
                </tr>
                <tr bgcolor="#DFF0D8" style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        <strong>Impuesto Sobre la Renta ISR</strong>
                    </td>
                    @foreach ($pensiones as $item)
                        <td style="vertical-align : middle" class="text-center">
                            <strong>$ {{number_format(($item->base_impuesto-$item->islr_LI)*($item->islr_tasa/100)+$item->islr_cuota_fija, 2, '.', ',')}}</strong>
                        </td>
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        Tasa que representa
                    </td>
                    @foreach ($pensiones as $item)
                        <td style="vertical-align : middle" class="text-center">
                            <strong>{{number_format(((($item->base_impuesto-$item->islr_LI)*($item->islr_tasa/100)+$item->islr_cuota_fija)/($item->pension_mensual+$item->jubilacion))*100, 2, '.', ',')}}%</strong>
                        </td>
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        <strong class="text-danger">INGRESO NETO MENSUAL</strong>
                    </td>
                    @foreach ($pensiones as $item)
                        <td style="vertical-align : middle" class="text-center">
                            <strong class="text-danger">$ {{number_format(($item->pension_mensual+$item->jubilacion)-((($item->base_impuesto-$item->islr_LI)*($item->islr_tasa/100)+$item->islr_cuota_fija)), 2, '.', ',')}}</strong>
                        </td>
                    @endforeach
                </tr>
                <tr bgcolor="#DFF0D8" style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        <strong>Ingreso neto adicional de un Opción a la inmediata anterior</strong>
                    </td>
                    @foreach ($pensiones as $item)

                        @if ($item->hoja == 'hoja-1')
                            <td></td>
                            @php
                                $pensionAnterior = ($item->pension_mensual+$item->jubilacion)-((($item->base_impuesto-$item->islr_LI)*($item->islr_tasa/100)+$item->islr_cuota_fija));
                            @endphp
                        @else
                            <td style="vertical-align : middle" class="text-center">
                                <strong>$ {{number_format(($item->pension_mensual+$item->jubilacion)-((($item->base_impuesto-$item->islr_LI)*($item->islr_tasa/100)+$item->islr_cuota_fija))-$pensionAnterior, 2, '.', ',')}}</strong>
                            </td>
                            @php
                                $pensionAnterior = ($item->pension_mensual+$item->jubilacion)-((($item->base_impuesto-$item->islr_LI)*($item->islr_tasa/100)+$item->islr_cuota_fija));
                            @endphp
                        @endif
                    @endforeach
                </tr>
                <tr bgcolor="#ECECEC" style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left">
                        <strong class="text-danger">Ingreso neto adicional anual *</strong>
                    </td>
                    @foreach ($pensiones as $item)

                        @if ($item->hoja == 'hoja-1')
                            <td></td>
                            @php
                                $pensionAnterior = ($item->pension_mensual+$item->jubilacion)-((($item->base_impuesto-$item->islr_LI)*($item->islr_tasa/100)+$item->islr_cuota_fija));
                            @endphp
                        @else
                            <td style="vertical-align : middle" class="text-center">
                                <strong class="text-danger">$ {{number_format((($item->pension_mensual+$item->jubilacion)-((($item->base_impuesto-$item->islr_LI)*($item->islr_tasa/100)+$item->islr_cuota_fija))-$pensionAnterior)*12, 2, '.', ',')}}</strong>
                            </td>
                            @php
                                $pensionAnterior = ($item->pension_mensual+$item->jubilacion)-((($item->base_impuesto-$item->islr_LI)*($item->islr_tasa/100)+$item->islr_cuota_fija));
                            @endphp
                        @endif
                    @endforeach
                </tr>
                <tr style="height: 2.5em;">
                    <td style="vertical-align : middle" class="text-left" colspan="7">
                        <strong>* Sin considerar el Aguinaldo</strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>