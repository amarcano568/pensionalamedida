<?php $hoja = 2;  ?>
@foreach ($pensiones as $item)
<?php
    if ($item->hoja == 'hoja-1'){
        $pension_Acum_Sin_M40 = $item->dif85;
    }

    $detalle = explode('|',$item->edad_detalle);
    $ano = $detalle[0];
    $mes = $detalle[1];
?>

@if ($item->hoja!='hoja-1')

<div class="row">
    <div class="col-sm-12">
        <table id="" style="display: table;width: 100%"
            class="table table-xs table-hover">
            <tbody id="">
                <tr>
                    <td bgcolor="orange" rowspan="4" style="width: 5%;vertical-align : middle;" class="text-center">
                        <h3 style="text-shadow: 1px 1px 2px black, 0 0 25px, 0 0 5px ;color: white;">{{$hoja++}}
                        </h3>
                    </td>
                    <td colspan="2" style="width: 25%;">
                        Pagando cada MES
                    </td>
                    <td style="width: 10%;" bgcolor="#EBEDEF" class="text-center">
                        $ <strong>{{ number_format($item->pagando_mensual, 2, '.', ',') }}</strong>
                    </td>
                    <td colspan="3" style="width: 25%;">
                        Obtienes una pensión mensual de
                    </td>
                    <td style="border-right: 5px solid#28A745;width: 10%;"  bgcolor="#EBEDEF" class="text-center">
                        $<strong>{{ number_format($item->pension_mensual, 2, '.', ',') }}</strong>
                    </td>
                    <td class="text-center" style="width: 10%">
                        <strong>{{Carbon\Carbon::parse($item->del)->format('d-m-Y')}}</strong>
                    </td>
                    <td class="text-center" style="border-right: 5px solid#28A745;width: 10%">
                        <strong>{{Carbon\Carbon::parse($item->al)->format('d-m-Y')}}</strong>
                    </td>
                    <td rowspan="4" style="border-right: 5px solid#28A745;width: 5%;" class="text-center">
                        <br>
                        <strong>{{$item->edad_anos_meses}}</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;!important">
                    <td class="text-center" rowspan="2" style="width: 10%!important;vertical-align : middle;">
                        <h5>A los 85 años</h5>
                    </td>
                    <td colspan="2" style="width: 25%!important">Tu Ingreso Total acumulado sería</td>
                    <td  class="text-center" bgcolor="#EBEDEF" style="width: 15%!important">$<strong>{{ number_format($item->dif85, 2, '.', ',') }}</strong></td>
                    <td class="text-center" colspan="2" rowspan="3" style="vertical-align : middle;width:10%!important">
                        <h5>TU INVERSIÓN SE MULTIPLICA</h5>
                    </td>
                    <td class="text-center" style="border-right: 5px solid#28A745;vertical-align : middle;"  bgcolor="#EBEDEF"  rowspan="2">
                        <h4>{{number_format((($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40) / $item->costo_total, 2, '.', ',')}}</h4>
                    </td>
                    <td class="text-center" colspan="2">
                        <strong>COTIZAS</strong>
                    </td>
                </tr>
                <tr style="height: 2.5em;!important">
                    <td colspan="2">
                        Tu Ganancia Neta Acum. sería
                    </td>
                    <td  class="text-center" bgcolor="#EBEDEF"">
                        $<strong>{{number_format(($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40, 2, '.', ',')}}</strong>
                    </td>
                    <td>
                        Años +
                    </td>
                    <td class="text-center"  >
                        <strong>{{ $ano }}</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        Y solamente inviertes en Cooperativa y/o M40:
                    </td>
                    <td  class="text-center" bgcolor="#EBEDEF"">
                    $ <strong>{{ number_format($item->costo_total, 2, '.', ',') }}</strong>
                    </td>
                    <td style="border-right: 5px solid#28A745;" class="text-center"><strong>Veces</strong></td>
                    <td>
                        Meses
                    </td>
                    <td class="text-center">
                        <strong>{{$mes}}</strong>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    
    
</div>
    
@endif
@endforeach
