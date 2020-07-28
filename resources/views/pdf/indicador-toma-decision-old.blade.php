<?php $hoja = 2;  ?>
@foreach ($pensiones as $item)
<?php
    if ($item->hoja == 'hoja-1'){
        $pension_Acum_Sin_M40 = $item->dif85;
    }
?>

@if ($item->hoja!='hoja-1')

<div class="row">
    <div class="col-sm-8">
        <table id="" style="display: table;width: 100%"
            class="table table-xs table-hover">
            <tbody id="">
                <tr>
                    <td bgcolor="orange" rowspan="4" style="width: 2%;vertical-align : middle;">
                        <h3 style="text-shadow: 1px 1px 2px black, 0 0 25px, 0 0 5px ;color: white;">{{$hoja++}}
                        </h3>
                    </td>
                    <td colspan="2" style="width: 25%;">
                        Pagando cada MES
                    </td>
                    <td style="width: 5%;" bgcolor="#EBEDEF">
                        $ <strong>{{ number_format($item->pagando_mensual, 2, '.', ',') }}</strong>
                    </td>
                    <td colspan="3" style="width: 25%;">
                        Obtienes una pensión mensual de
                    </td>
                    <td style="width: 5%;"  bgcolor="#EBEDEF">
                        $<strong>{{ number_format($item->pension_mensual, 2, '.', ',') }}</strong>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" rowspan="2" style="width: 10%!important;vertical-align : middle;">
                        <h4>A los 85 años</h4>
                    </td>
                    <td colspan="2">Tu Ingreso Total acumulado sería</td>
                    <td  bgcolor="#EBEDEF">$ <strong>{{ number_format($item->dif85, 2, '.', ',') }}</strong></td>
                    <td class="text-center" colspan="2" rowspan="3" style="vertical-align : middle;">
                        <h5>TU INVERSIÓN SE MULTIPLICA</h5>
                    </td>
                    <td class="text-center" style="vertical-align : middle;"  bgcolor="#EBEDEF"  rowspan="2">
                        <h4>{{number_format((($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40) / $item->costo_total, 2, '.', ',')}}</h4>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Tu Ganancia Neta Acum. sería
                    </td>
                    <td  bgcolor="#EBEDEF"">
                        $<strong>{{number_format(($item->dif85 - $pension_Acum_Sin_M40)-$item->invertido_coop_m40, 2, '.', ',')}}</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        Y solamente inviertes en Cooperativa y/o M40:
                    </td>
                    <td  bgcolor="#EBEDEF"">
                    $ <strong>{{ number_format($item->costo_total, 2, '.', ',') }}</strong>
                    </td>
                    <td class="text-center"><strong>Veces</strong></td>
                </tr>

            </tbody>
        </table>
    </div>
    <?php 
      $detalle = explode('|',$item->edad_detalle);
      $ano = $detalle[0];
      $mes = $detalle[1];
    ?>
    <div class="col-sm-3">
        <table id="table-hoja1-1" style="display: table;width: 100%" class="table table-hover table-xs">
            <tbody id="body-hoja1-1">
                <tr>
                    <td class="text-center" style="width: 50%" >
                        <strong>{{Carbon\Carbon::parse($item->del)->format('d-m-Y')}}</strong>
                    </td>
                    <td class="text-center" style="width: 50%" >
                        <strong>{{Carbon\Carbon::parse($item->al)->format('d-m-Y')}}</strong>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" colspan="2">
                        <strong>COTIZAS</strong>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%">
                        Años +
                    </td>
                    <td class="text-center" style="width: 50%" >
                        <strong>{{ $ano }}</strong>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%">
                        Meses
                    </td>
                    <td class="text-center" style="width: 50%" >
                        <strong>{{$mes}}</strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-1" style="border: 1px solid #ddd;height:7.7em;" >
        <br><br>
       <strong>{{$item->edad_anos_meses}}</strong>
    </div>
</div>
    
@endif
@endforeach