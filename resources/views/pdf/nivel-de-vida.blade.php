<div class="row">
    <div class="col sm-12">
        <table id="table-hoja1-1" style="display: table;width: 100%" class="table-hoja-2 table table-hover">
            <tbody id="body-hoja1-1">
                <tr bgcolor="#DFF0D8">
                    <td colspan="2" class="text-center" style="vertical-align : middle;width: 25%">
                        <h6>Empresa en la que tuviste tu mejor ingreso</h6>
                    </td>
                    <td class="text-center" style="vertical-align : middle;width: 12.5%">
                        <h6>Fechas de tu MEJOR sueldo diario</h6>
                    </td>
                    <td  class="text-center"style="vertical-align : middle;width: 12.5%">
                        <h6>Salario diario Reporte Semanas Cotizadas</h6>
                    </td>
                    <td class="text-center" style="vertical-align : middle;width: 12.5%">
                        <h6>Factor de Actualización</h6>
                    </td>
                    <td class="text-center" style="vertical-align : middle;width: 12.5%">
                        <h6>Tu mejor salario diario, actualizado a hoy</h6>
                    </td>
                    <td class="text-center" style="vertical-align : middle;width: 12.5%">
                        <h6>Mejor sueldo mensual obtenido, actualizado</h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center" style="vertical-align : middle;width: 25%">
                        <input style="font-weight: bold;" type="text" class="form-control input-xs" name="empresa-nivel-vida" id="empresa-nivel-vida" value="{{$nivel_vida->empresa}}">
                    </td>
                    <td class="text-center" style="vertical-align : middle;width: 12.5%">
                        <input style="font-weight: bold;" type="text" class="form-control input-xs" name="fecha-nivel-vida" id="fecha-nivel-vida" value="{{$nivel_vida->fecha}}">
                    </td>
                    <td  class="text-center"style="vertical-align : middle;width: 12.5%">
                        <input style="font-weight: bold;" type="text" class="form-control input-xs" name="salario-diario-nivel-vida" id="salario-diario-nivel-vida" value="{{number_format($nivel_vida->salario_diario, 2, '.', ',')}}">
                    </td>
                    <td class="text-center" style="vertical-align : middle;width: 12.5%">
                        <input style="font-weight: bold;" type="text" class="form-control input-xs" name="factor-actualizacion-nivel-vida" id="factor-actualizacion-nivel-vida" value="{{$nivel_vida->factor_actualizacion}}" readonly>
                    </td>
                    <td class="text-center" style="vertical-align : middle;width: 12.5%">
                        <input style="font-weight: bold;" type="text" class="form-control input-xs" name="mejor-salario-diario-nivel-vida" id="mejor-salario-diario-nivel-vida" value="{{number_format($nivel_vida->mejor_salario_diario, 2, '.', ',')}}" readonly>
                    </td>
                    <td class="text-center" style="vertical-align : middle;width: 12.5%">
                        <input style="font-weight: bold;" type="text" class="form-control input-xs" name="mejor-salario-mensual-nivel-vida" id="mejor-salario-mensual-nivel-vida" value="{{number_format($nivel_vida->mejor_salario_mensual, 2, '.', ',')}}" readonly>
                    </td>

                </tr>
                <tr style="color: whitesmoke">
                    <td bgcolor="#FFA500" class="text-center" style="vertical-align : middle;width: 2.5%!important">
                        <h6 style="">Opción
                        </h6>
                    </td>
                    <td bgcolor="#FFA500" class="text-center" style="vertical-align : middle;width: 12.5%">
                        <h6 style="">Mejor sueldo mensual obtenido, a valor del 2020
                        </h6>
                    </td>
                    <td bgcolor="#FFA500"  class="text-center"style="vertical-align : middle;width: 12.5%">
                        <h6 style="">Pensión mensual en cada Opción
                        </h6>
                    </td>
                    <td bgcolor="#DFF0D8" class="text-center" style="vertical-align : middle;width: 12.5%;color: black">
                        <h6 style="">Tasa de Reemplazo
                        </h6>
                    </td>
                    <td bgcolor="#FFA500" class="text-center" style="vertical-align : middle;width: 12.5%">
                        <h6 style="">Variación en pesos actuales
                        </h6>
                    </td>
                    <td colspan="2" bgcolor="#FFA500" class="text-center" style="vertical-align : middle;width: 12.5%">
                    </td>
                    @php
                        $hoja = 2;
                    @endphp
                    @foreach ($pensiones as $item)
                        @if ($item->hoja != 'hoja-1')
                            <tr>
                                <td class="text-center" style="vertical-align : middle;">
                                <h5>{{$hoja++ }}</h5>
                                </td>
                                @if ($item->hoja == 'hoja-2')
                                    <td class="text-center" rowspan="5"  style="vertical-align : middle;">
                                        <h3>{{number_format($nivel_vida->mejor_salario_mensual, 2, '.', ',')}}</h3>
                                    </td>
                                @endif
                                <td  class="text-center"style="vertical-align : middle;">
                                    <h5>{{number_format($item->pension_mensual, 2, '.', ',')}}</h5>
                                </td>
                                <td class="text-center" style="vertical-align : middle;">
                                    <h5>{{ number_format(($item->pension_mensual /$nivel_vida->mejor_salario_mensual)*100, 2, '.', ',') }}%</h5>
                                </td>
                                @php
                                    $variacion_pesos = $item->pension_mensual - $nivel_vida->mejor_salario_mensual;
                                @endphp
                                <td class="text-center" style="vertical-align : middle;">
                                    @if ($variacion_pesos<0)
                                        <h5 class="text-danger">{{number_format($variacion_pesos, 2, '.', ',')}}</h5>
                                    @else 
                                        <h5 class="text-success">{{number_format($variacion_pesos, 2, '.', ',')}}</h5>
                                    @endif
                                </td>
                                @php
                                    if ($variacion_pesos <0 ){
                                        $mas_menos = 'MENOS';
                                    }else{
                                        $mas_menos = 'MAS';
                                    }
                                    $message = 'Tu Pensión mensual es '.number_format($variacion_pesos, 2, '.', ',').'  '.$mas_menos.' que tu mejor salario obtenido actualizado a pesos del '.\Carbon\Carbon::now()->year.' Tu Nivel de Vida LLEGA SOLO AL '.number_format(($item->pension_mensual /$nivel_vida->mejor_salario_mensual)*100, 2, '.', ',').'% en relación a tu mejor ingreso obtenido.';
                                @endphp
                                <td colspan="2" class="text-center" style="vertical-align : middle;">
                                <h6>{{$message}}</h6>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tr>
            </tbody>
        </table>
        <table class="table">
            <tbody>
                <tr>
                    <td class="text-center">
                        Tasa de Reemplazo promedio en México
                        <strong class="text-danger"> SIN M40:</strong> 27%.
                        En Europa: 70%
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>