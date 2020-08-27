<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Pensiones;
use \App\Clientes;
use \App\Expectativas_Salariales;
use \App\Formulas_tabla;
use \App\Cotizaciones;
use \App\Radiografia_Tem;
use \App\Cotizaciones_Clientes;
use App\Empresa;
use App\Estrategias;
use \App\Pension_Final;
use \App\Nivel_Vida;
use \App\Fecha_Salario_Tem;
use Carbon\Carbon;
use \DataTables;
use Illuminate\Support\Facades\DB;
use Redirect, Response, Config;
use Mail;
use App\Traits\funcGral;
use App\Http\Controllers\View;

use PDF;

class PdfsController extends Controller
{
    use funcGral;
    protected $showIslr;

    public function generarPdfResumen(Request $request)
    {
        $cliente = Clientes::find($request->idCliente);
        $cliente->edad = Carbon::parse($cliente->fechaNacimiento)->age;
        $expectativas = Expectativas_Salariales::join('pensiones', 'expectativas_salariales.uuid', 'pensiones.uuid')
            ->find($request->uuid);
        $pensiones = Pension_Final::where('uuid', $request->uuid)->get();
        //dd($expectativas);
        $data = array(
            'uuid' => $request->uuid,
            'idCliente' => $request->idCliente,
            'cliente' => $cliente,
            'expectativas' => $expectativas,
            'pensiones' => $pensiones
        );
        return view('pdf.pdf-resumen', $data);
    }

    public function verPdfResumen(Request $request)
    {

        $cliente = Clientes::find($request->idCliente);
        $cliente->edad = Carbon::parse($cliente->fechaNacimiento)->age;
        $expectativas = Expectativas_Salariales::join('pensiones', 'expectativas_salariales.uuid', 'pensiones.uuid')
            ->find($request->uuid);
        $pensiones = Pension_Final::where('uuid', $request->uuid)->get();
        $empresa = Empresa::first();
        //dd($expectativas);
        $data = array(
            'uuid' => $request->uuid,
            'idCliente' => $request->idCliente,
            'cliente' => $cliente,
            'expectativas' => $expectativas,
            'pensiones' => $pensiones,
            'empresa' => $empresa
        );

        $nameFilePdf = strtoupper(trim($cliente->nombre)) . '-RESUMEN PLAN.pdf';

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $rutaFile = public_path() . '/pdf/' . $nameFilePdf;
            $ruta = '/pdf/' . $nameFilePdf;
        } else {
            $rutaFile = public_path() . '/pdf/' . $nameFilePdf;
            $ruta = '/pdf/' . $nameFilePdf;
        }
        $nro = rand(1, 1000);

        \PDF::loadView('pdf.resumenpdf', $data)->setPaper('letter', 'landscape')->save($rutaFile);
        return response()->json(array('success' => true, 'mensaje' => 'Pdf resumen generado exitosamente', 'data' => $ruta, 'email' => $cliente->email));
    }

    public function sendMailResumen(Request $request)
    {
        $cliente = Clientes::find($request->idCliente);
        $empresa = Empresa::first();
        $details = array(
            'empresa' => $empresa,
            'cliente' => $cliente,
        );

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $rutaFile = base_path() . '\public\\' . $request->archivoPdf;
        } else {
            $rutaFile =  public_path($request->archivoPdf);
        }

        $data = [
            'email'   => $cliente->email,
            'subject' => 'Planeación A La Medida – Resumen',
            'adjunto'    =>  $rutaFile
        ];


        Mail::send('emails.plantilla', $details, function ($message) use ($data) {
            $message->to($data['email'], 'Pensión a la medida.');
            $message->attach($data['adjunto']);
            $message->subject($data['subject']);
        });

        if (Mail::failures()) {
            return response()->json(array('success' => true, 'mensaje' => 'Envío de correo a fallado'));
        } else {
            return response()->json(array('success' => true, 'mensaje' => 'El correo se ha enviado con exito'));
        }
    }

    public function generarPdfDetalle(Request $request)
    {
        $cliente = Clientes::find($request->idCliente);
        $cliente->edad = Carbon::parse($cliente->fechaNacimiento)->age;
        $pensiones = Pension_Final::where('uuid', $request->uuid)->get();
        $expectativas = Expectativas_Salariales::where('uuid', $request->uuid)
            ->first();

        $fecNac = Carbon::parse($cliente->fechaNacimiento);
        $fechaFutura = $fecNac->addYear($expectativas->edadA);
        $maxima_en_monto =  $expectativas->rangoInversionA * (Carbon::parse($expectativas->fechaPlan)->diffInDays($fechaFutura) / 365) * 12;

        $edad_faltante_cliente = $this->AnosFaltantes($cliente->fechaNacimiento, $expectativas->edadA, $expectativas->fechaPlan);
        $cliente->edad_faltante = $edad_faltante_cliente;
        $edad_abs = explode(',', $edad_faltante_cliente);
        $meses = ((int)substr($edad_abs[1], 0, 2) * 10) / 12;

        $edad_abs = (int)substr($edad_faltante_cliente, 0, 2) + (float)($meses / 10);
        $cliente->edad_abs_faltante = $edad_abs;

        $pension_dif85_hoja1 = Pension_Final::where('uuid', $request->uuid)->where('hoja', 'hoja-1')->select('dif85')->first();

        $showIslr = false;
        $pensiones->map(function ($pension)  use ($cliente, $pension_dif85_hoja1) {
            $hoja = $pension->hoja;

            $pension->jubilacion = 0;
            $pension->UMAs15 = 86.88 * 15 * 30.4;
            //86.88 * 15 * 30.4

            $base_impuesto = ($pension->pension_mensual + $pension->jubilacion) - $pension->UMAs15;
            $pension->base_impuesto = $base_impuesto > 0 ? $base_impuesto : 0;

            if ($base_impuesto > 0) {
                $showIslr = true;
            }

            if ($pension->base_impuesto > 0) {
                $islr = $this->buscarISLR($pension->base_impuesto);
                $pension->islr_LI = $islr->limite_inferior;
                $pension->islr_tasa = $islr->porc;
                $pension->islr_cuota_fija = $islr->cuota_fija;
            } else {
                $islr = 0;
                $pension->islr_LI = 0;
                $pension->islr_tasa = 0;
                $pension->islr_cuota_fija = 0;
            }


            $rango_fecha = $this->rangos_fechas($pension->uuid, $hoja);
            $del = $rango_fecha['fecha_menor'];
            $al = $rango_fecha['fecha_mayor'];
            $pension->del = $rango_fecha['fecha_menor'];
            $pension->al = $rango_fecha['fecha_mayor'];
            $pension->edad_detalle = $del->diff($al)->format('%y Años, %m meses y %d días');
            $pension->edad_anos_meses = $al->diff($del)->format('%y año(s) más %m mes(es)');

            if ($hoja == 'hoja-1') {
                $expectativas = Expectativas_Salariales::where('uuid', $pension->uuid)->first();
                $pension->edad_real_pension = $expectativas->edadDe . ' Años, 0 meses';
                $pension->porc_pension = $this->porcentaje_pension($pension->edad_real_pension, $hoja);
            } else {
                $cotiza_clientes_fechas = Cotizaciones_Clientes::where('uuid', $pension->uuid)
                    ->where('estrategias', '6')
                    ->where('hoja', $hoja)
                    ->first();

                $fecNac = Carbon::parse($cliente->fechaNacimiento);
                $fechaRetiro = $al;
                $pension->edad_real_pension =  $fecNac->diff($fechaRetiro)->format('%y Años, %m meses, %d días');
                $pension->porc_pension = $this->porcentaje_pension($pension->edad_real_pension, $hoja);
            }
            if ($hoja != 'hoja-1') {
                $pension->rendimiento_anual = ($pension->dif85 - $pension_dif85_hoja1->dif85) / $pension->dif85_text;
            }
        });

        //dd($pensiones);

        foreach ($pensiones as $pension) {
            if ($pension->hoja == 'hoja-1') {
                $pension_hoja1 = $pension->pension_mensual;
            }
            if ($pension->hoja == 'hoja-4') {
                $pension_hoja4 = $pension->pension_mensual;
            }
        }

        $estrategias = Estrategias::where('uuid', $pension->uuid)
            ->where('estrategia', '!=', '')
            ->get();

        $tmp = $this->preparaTemporalEstrategias($pension->uuid, $estrategias);
        $tmp_fecha_salario =  $this->preparaTemporalFechaSalario($pension->uuid, $estrategias);

        $nivel_vida = Nivel_Vida::find($pension->uuid);

        if ($nivel_vida == null) {
            $nivel  = new \App\Nivel_Vida();
            $nivel->uuid = $request->uuid;
            $nivel->save();
            $nivel_vida = Nivel_Vida::where('uuid', $pension->uuid)->first();
        }

        $data = array(
            'uuid' => $request->uuid,
            'idCliente' => $request->idCliente,
            'cliente' => $cliente,
            'pensiones' => $pensiones,
            'cliente_ano_mes' => $cliente,
            'pension_1_4' => [$pension_hoja1, $pension_hoja4],
            /* Data para Radiografía */
            'estrategias' => $estrategias,
            'tmp' => $tmp,
            /* Data para Expectativas */
            'expectativas' => $expectativas,
            /** Nivel de Vida */
            'nivel_vida' => $nivel_vida,
            /**Fechas y Salarios */
            'tmp_fecha_salario' => $tmp_fecha_salario,
            'maxima_en_monto' => $maxima_en_monto,
            'showIslr' => $showIslr
        );
        //dd($data);
        return view('pdf.pdf-detalle', $data);
    }

    public function buscarISLR($base_impuesto)
    {
        $valor = $base_impuesto;

        $islr =  DB::table('islr')
            ->whereRaw('? >= limite_inferior and ? <= limite_superior', [$valor, $valor])->first();

        return $islr;
    }

    public function rangos_fechas($uuid, $hoja)
    {
        $estrategias = Estrategias::where('uuid', $uuid)->where('hoja', $hoja)->whereIn('estrategia', [3, 6])->get();

        /* Define la fecha menor de las esrategias */
        $fecha_menor = Carbon::parse('2050-01-01');
        foreach ($estrategias as $item) {
            $fecha_estrategia =  Carbon::parse(Carbon::parse($item->desde)->format('d-m-Y'));
            if ($fecha_estrategia->lessThanOrEqualTo($fecha_menor)) {
                $fecha_menor = $fecha_estrategia;
            }
        }

        /* Define la fecha menor de las esrategias */
        $fecha_mayor = Carbon::parse('1900-01-01');
        foreach ($estrategias as $item) {
            $fecha_estrategia =  Carbon::parse(Carbon::parse($item->hasta)->format('d-m-Y'));
            if ($fecha_estrategia->greaterThanOrEqualTo($fecha_mayor)) {
                $fecha_mayor = $fecha_estrategia;
            }
        }

        return array('fecha_menor' => $fecha_menor, 'fecha_mayor' => $fecha_mayor);
    }

    public function porcentaje_pension($edad_real, $hoja = '')
    {
        $pos = strpos($edad_real, ',') + 1;
        $mes = (int)substr($edad_real, $pos, 3);
        $mes = round($mes * 10 / 12);

        $edadReal = trim(substr($edad_real, 0, 2)) . "." . trim($mes);
        $edad = (int)round((float)$edadReal, 0);
        //  echo $edad . '<br>';
        if ($edad == 60) {
            $porc = '75%';
        } else if ($edad == 61) {
            $porc = '80%';
        } else if ($edad == 62) {
            $porc = '85%';
        } else if ($edad == 63) {
            $porc = '90%';
        } else if ($edad == 64) {
            $porc = '95%';
        } else if ($edad >= 65) {
            $porc = '100%';
        }

        return $porc;
    }

    public function preparaTemporalFechaSalario($uuid, $estrategias)
    {
        //dd($estrategias);
        Fecha_Salario_Tem::where('uuid', $uuid)->get()->each->delete();

        $estrategias_a_crear = [1, 2, 6];
        $title = ['Desde', 'Hasta', 'Anos', 'Meses', 'Salarios'];
        $indice = 0;
        for ($i = 0; $i <= 4; $i++) {
            $temp  = new \App\Fecha_Salario_Tem();
            $temp->item = $title[$indice++];
            $temp->tipo = 'EMPLEO_ACTUAL';
            $temp->uuid = $uuid;
            $temp->hoja2 = '';
            $temp->hoja3 = '';
            $temp->hoja4 = '';
            $temp->hoja5 = '';
            $temp->hoja6 = '';
            $temp->save();
        }

        $indice = 0;
        for ($i = 0; $i <= 4; $i++) {
            $temp  = new \App\Fecha_Salario_Tem();
            $temp->item = $title[$indice++];
            $temp->tipo = 'COOPERATIVA';
            $temp->uuid = $uuid;
            $temp->hoja2 = '';
            $temp->hoja3 = '';
            $temp->hoja4 = '';
            $temp->hoja5 = '';
            $temp->hoja6 = '';
            $temp->save();
        }

        $indice = 0;
        for ($i = 0; $i <= 4; $i++) {
            $temp  = new \App\Fecha_Salario_Tem();
            $temp->item = $title[$indice++];
            $temp->tipo = 'M40-ALTA';
            $temp->uuid = $uuid;
            $temp->hoja2 = '';
            $temp->hoja3 = '';
            $temp->hoja4 = '';
            $temp->hoja5 = '';
            $temp->hoja6 = '';
            $temp->save();
        }

        $indice = 0;
        $title = ['SALARIO-MENSUAL-TEORICO-CONTRATADO', 'PAGO-MENSUAL-DE-LA-M40-ALTA'];
        for ($i = 0; $i <= 1; $i++) {
            $temp  = new \App\Fecha_Salario_Tem();
            $temp->item = $title[$indice++];
            $temp->tipo = 'M40-SALARIO-MENSUAL-TEORICO-Y-PAGOS';
            $temp->uuid = $uuid;
            $temp->hoja2 = '';
            $temp->hoja3 = '';
            $temp->hoja4 = '';
            $temp->hoja5 = '';
            $temp->hoja6 = '';
            $temp->save();
        }

        $indice = 0;
        $title = ['MESES', 'ANOS', 'SEMANAS'];
        for ($i = 0; $i <= 2; $i++) {
            $temp  = new \App\Fecha_Salario_Tem();
            $temp->item = $title[$indice++];
            $temp->tipo = 'INVERSION-TOTAL-DE-TIEMPO';
            $temp->uuid = $uuid;
            $temp->hoja2 = '';
            $temp->hoja3 = '';
            $temp->hoja4 = '';
            $temp->hoja5 = '';
            $temp->hoja6 = '';
            $temp->save();
        }

        $indice = 0;
        $title = ['INDICE_DE_APROVECHAMIENTO', 'ULTIMO-SALARIO-CONTRATADO-MOD40'];
        for ($i = 0; $i <= 1; $i++) {
            $temp  = new \App\Fecha_Salario_Tem();
            $temp->item = $title[$indice++];
            $temp->tipo = 'OTROS-DATOS-APOYO';
            $temp->uuid = $uuid;
            $temp->hoja2 = '';
            $temp->hoja3 = '';
            $temp->hoja4 = '';
            $temp->hoja5 = '';
            $temp->hoja6 = '';
            $temp->save();
        }

        foreach ($estrategias as $item) {
            if ($item->estrategia == 1) {
                $hoja = $item->hoja;
                $hoja = str_replace("-", "", $hoja);
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'EMPLEO_ACTUAL')->where('item', 'Desde')->first();
                $temp->$hoja = Carbon::parse($item->desde)->format('d-m-Y');
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'EMPLEO_ACTUAL')->where('item', 'Hasta')->first();
                $temp->$hoja = Carbon::parse($item->hasta)->format('d-m-Y');
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'EMPLEO_ACTUAL')->where('item', 'Anos')->first();
                $temp->$hoja = $item->anos;
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'EMPLEO_ACTUAL')->where('item', 'Anos')->first();
                $temp->$hoja = $item->anos;
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'EMPLEO_ACTUAL')->where('item', 'Meses')->first();
                $temp->$hoja = $item->meses;
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'EMPLEO_ACTUAL')->where('item', 'Salarios')->first();
                $temp->$hoja = $item->sbc;
                $temp->save();
            }
        }

        foreach ($estrategias as $item) {
            if ($item->estrategia == 2) {
                $hoja = $item->hoja;
                $hoja = str_replace("-", "", $hoja);
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'COOPERATIVA')->where('item', 'Desde')->first();
                $temp->$hoja = Carbon::parse($item->desde)->format('d-m-Y');
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'COOPERATIVA')->where('item', 'Hasta')->first();
                $temp->$hoja = Carbon::parse($item->hasta)->format('d-m-Y');
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'COOPERATIVA')->where('item', 'Anos')->first();
                $temp->$hoja = $item->anos;
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'COOPERATIVA')->where('item', 'Anos')->first();
                $temp->$hoja = $item->anos;
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'COOPERATIVA')->where('item', 'Meses')->first();
                $temp->$hoja = $item->meses;
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'COOPERATIVA')->where('item', 'Salarios')->first();
                $temp->$hoja = $item->sbc;
                $temp->save();
            }
        }

        foreach ($estrategias as $item) {
            if ($item->estrategia == 6) {
                $hoja = $item->hoja;
                $hoja = str_replace("-", "", $hoja);
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'M40-ALTA')->where('item', 'Desde')->first();
                $temp->$hoja = Carbon::parse($item->desde)->format('d-m-Y');
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'M40-ALTA')->where('item', 'Hasta')->first();
                $temp->$hoja = Carbon::parse($item->hasta)->format('d-m-Y');
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'M40-ALTA')->where('item', 'Anos')->first();
                $temp->$hoja = $item->anos;
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'M40-ALTA')->where('item', 'Anos')->first();
                $temp->$hoja = $item->anos;
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'M40-ALTA')->where('item', 'Meses')->first();
                $temp->$hoja = $item->meses;
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'M40-ALTA')->where('item', 'Salarios')->first();
                $temp->$hoja = $item->sbc;
                $temp->save();
            }
        }

        foreach ($estrategias as $item) {
            if ($item->estrategia == 6) {
                $hoja = $item->hoja;
                $hoja = str_replace("-", "", $hoja);
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'M40-SALARIO-MENSUAL-TEORICO-Y-PAGOS')->where('item', 'SALARIO-MENSUAL-TEORICO-CONTRATADO')->first();
                $temp->$hoja = number_format($item->sbc * 30.4, 2, '.', ',');
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'M40-SALARIO-MENSUAL-TEORICO-Y-PAGOS')->where('item', 'PAGO-MENSUAL-DE-LA-M40-ALTA')->first();
                $temp->$hoja = number_format($item->pago_mensual, 2, '.', ',');
                $temp->save();
            }
        }

        foreach ($estrategias as $item) {
            if ($item->estrategia == 6) {
                $hoja = $item->hoja;
                $hoja = str_replace("-", "", $hoja);
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'INVERSION-TOTAL-DE-TIEMPO')->where('item', 'MESES')->first();
                $temp->$hoja = $item->meses;
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'INVERSION-TOTAL-DE-TIEMPO')->where('item', 'ANOS')->first();
                $temp->$hoja = $item->anos;
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'INVERSION-TOTAL-DE-TIEMPO')->where('item', 'SEMANAS')->first();
                $temp->$hoja = $item->semanas;
                $temp->save();
            }
        }

        foreach ($estrategias as $item) {
            if ($item->estrategia == 6) {
                $hoja = $item->hoja;
                $hoja = str_replace("-", "", $hoja);
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'OTROS-DATOS-APOYO')->where('item', 'INDICE_DE_APROVECHAMIENTO')->first();
                $temp->$hoja =  number_format(($this->salarioDiarioPromedio($item->uuid, $item->hoja) / $item->sbc) * 100, 2, '.', ',');
                $temp->save();
                $temp = Fecha_Salario_Tem::where('uuid', $uuid)->where('tipo', 'OTROS-DATOS-APOYO')->where('item', 'ULTIMO-SALARIO-CONTRATADO-MOD40')->first();
                $temp->$hoja =  number_format($item->sbc, 2, '.', ',');
                $temp->save();
            }
        }

        return Fecha_Salario_Tem::where('uuid', $uuid)->get();
    }

    public function salarioDiarioPromedio($uuid, $hoja)
    {
        $pension = Pension_Final::where('uuid', $uuid)->where('hoja', $hoja)->select('salario_diario_promedio')->first();
        return $pension->salario_diario_promedio;
    }

    public function preparaTemporalEstrategias($uuid, $estrategias)
    {
        Radiografia_Tem::where('uuid', $uuid)->get()->each->delete();
        for ($i = 2; $i <= 6; $i++) {
            $temp  = new \App\Radiografia_Tem();
            $temp->tipo = 'INVERSION_TOTAL';
            $temp->uuid = $uuid;
            $temp->estrategia = $i;
            $temp->hoja2 = 0;
            $temp->hoja3 = 0;
            $temp->hoja4 = 0;
            $temp->hoja5 = 0;
            $temp->hoja6 = 0;
            $temp->save();
        }

        foreach ($estrategias as $item) {
            $estrategia = $item->estrategia;
            $hoja = $item->hoja;
            $hoja = str_replace("-", "", $hoja);
            $temp = Radiografia_Tem::where('uuid', $uuid)->where('estrategia', $estrategia)->where('tipo', 'INVERSION_TOTAL')->first();
            if ($estrategia != 1) {
                $temp->$hoja = $item->costo;
                $temp->save();
            }
        }

        for ($i = 2; $i <= 6; $i++) {
            $temp  = new \App\Radiografia_Tem();
            $temp->tipo = 'PAGOS_MENSUAL';
            $temp->uuid = $uuid;
            $temp->estrategia = $i;
            $temp->hoja2 = 0;
            $temp->hoja3 = 0;
            $temp->hoja4 = 0;
            $temp->hoja5 = 0;
            $temp->hoja6 = 0;
            $temp->save();
        }

        foreach ($estrategias as $item) {
            $estrategia = $item->estrategia;
            $hoja = $item->hoja;
            $hoja = str_replace("-", "", $hoja);
            $temp = Radiografia_Tem::where('uuid', $uuid)->where('estrategia', $estrategia)->where('tipo', 'PAGOS_MENSUAL')->first();
            if ($estrategia != 1) {
                $temp->$hoja = $item->pago_mensual;
                $temp->save();
            }
        }

        return Radiografia_Tem::where('uuid', $uuid)->get();
    }

    public function dataTomaDecisiones(Request $request)
    {
        $pensiones = Pension_Final::where('uuid', $request->uuid)->get();
        $cotiza_clientes_fechas = Cotizaciones_Clientes::where('uuid', $request->uuid)->where('estrategias', '6')->get();
        $cotiza_clientes_fechas->map(function ($pension) {
            $del = Carbon::parse($pension->del);
            $al = Carbon::parse($pension->al);
            $pension->edad_detalle = $del->diff($al)->format('%y | %m');
        });

        $cliente = Cotizaciones_Clientes::join('pensiones', 'cotizaciones_clientes.uuid', 'pensiones.uuid')
            ->join('clientes', 'pensiones.idCliente', 'clientes.id')
            ->where('cotizaciones_clientes.uuid', $request->uuid)
            ->whereIn('cotizaciones_clientes.estrategias', [2, 3, 4, 5, 6])
            ->select('cotizaciones_clientes.uuid', 'fechaNacimiento', 'cotizaciones_clientes.al', 'cotizaciones_clientes.hoja')
            ->get();
        $cliente->map(function ($clien) {
            $del = Carbon::parse($clien->fechaNacimiento);
            $al = Carbon::parse($clien->al);
            $clien->edad_anos_meses = $al->diff($del)->format('%y año(s) más %m mes(es)');
        });

        foreach ($pensiones as $pension) {
            if ($pension->hoja == 'hoja-1') {
                $pension_hoja1 = $pension->pension_mensual;
            }
            if ($pension->hoja == 'hoja-4') {
                $pension_hoja4 = $pension->pension_mensual;
            }
        }

        return response()->json(array(
            'success' => true,
            'mensaje' => 'Pensión final obtenida exitosamente',
            'data' => $pensiones,
            'cotiza_fechas' => $cotiza_clientes_fechas,
            'cliente_ano_mes' => $cliente,
            'pension_1_4' => [$pension_hoja1, $pension_hoja4]
        ));
    }

    public function restarFechas()
    {
        $fec1 =  Carbon::parse('1957/01/17');
        $fec2 = Carbon::parse('2023/01/31');

        $fecha = $fec2->diff($fec1);

        dd($fecha);
    }

    public function verPdfDetalle(Request $request)
    {
        ini_set('memory_limit', '-1');
        $cliente = Clientes::find($request->idCliente);
        $cliente->edad = Carbon::parse($cliente->fechaNacimiento)->age;
        $expectativas = Expectativas_Salariales::where('uuid', $request->uuid)->first();

        $fecNac = Carbon::parse($cliente->fechaNacimiento);
        $fechaFutura = $fecNac->addYear($expectativas->edadA);
        $maxima_en_monto =  $expectativas->rangoInversionA * (Carbon::parse($expectativas->fechaPlan)->diffInDays($fechaFutura) / 365) * 12;

        $edad_faltante_cliente = $this->AnosFaltantes($cliente->fechaNacimiento, $expectativas->edadA, $expectativas->fechaPlan);
        $cliente->edad_faltante = $edad_faltante_cliente;
        $edad_abs = explode(',', $edad_faltante_cliente);
        $meses = ((int)substr($edad_abs[1], 0, 2) * 10) / 12;

        $edad_abs = ((int)substr($edad_faltante_cliente, 0, 2) + ($meses / 10)) * 12;
        $cliente->edad_abs_faltante = $edad_abs;

        $pensiones = Pension_Final::where('uuid', $request->uuid)->get();

        $pension_dif85_hoja1 = Pension_Final::where('uuid', $request->uuid)->where('hoja', 'hoja-1')->select('dif85')->first();

        $this->showIslr = false;
        $pensiones->map(function ($pension)  use ($cliente, $pension_dif85_hoja1) {
            $hoja = $pension->hoja;

            $pension->jubilacion = 0;
            $pension->UMAs15 = 86.88 * 15 * 30.4;
            //86.88 * 15 * 30.4

            $base_impuesto = ($pension->pension_mensual + $pension->jubilacion) - $pension->UMAs15;
            $pension->base_impuesto = $base_impuesto > 0 ? $base_impuesto : 0;

            if ($pension->base_impuesto > 0) {
                $this->showIslr = true;
            }

            if ($pension->base_impuesto > 0) {
                $islr = $this->buscarISLR($pension->base_impuesto);
                $pension->islr_LI = $islr->limite_inferior;
                $pension->islr_tasa = $islr->porc;
                $pension->islr_cuota_fija = $islr->cuota_fija;
            } else {
                $islr = 0;
                $pension->islr_LI = 0;
                $pension->islr_tasa = 0;
                $pension->islr_cuota_fija = 0;
            }

            $cotiza_clientes_fechas = Cotizaciones_Clientes::where('uuid', $pension->uuid)
                ->where('estrategias', '6')
                ->where('hoja', $hoja)
                ->first();
            $del = Carbon::parse($cotiza_clientes_fechas['del']);
            $al = Carbon::parse($cotiza_clientes_fechas['al']);
            $pension->del = $cotiza_clientes_fechas['del'];
            $pension->al = $cotiza_clientes_fechas['al'];
            $pension->edad_detalle = $del->diff($al)->format('%y Años, %m meses y %d días');
            $pension->edad_anos_meses = $al->diff($del)->format('%y año(s) más %m mes(es)');

            if ($hoja == 'hoja-1') {
                $expectativas = Expectativas_Salariales::where('uuid', $pension->uuid)->first();
                $pension->edad_real_pension = $expectativas->edadDe . ' Años, 0 meses';
                $pension->porc_pension = $this->porcentaje_pension($pension->edad_real_pension);
            } else {
                $fecNac = Carbon::parse($cliente->fechaNacimiento);
                $fechaRetiro = Carbon::parse($al);
                $pension->edad_real_pension =  $fecNac->diff($fechaRetiro)->format('%y Años, %m meses, %d días');
                $pension->porc_pension = $this->porcentaje_pension($pension->edad_real_pension);
            }
            if ($hoja != 'hoja-1') {
                $pension->rendimiento_anual = ($pension->dif85 - $pension_dif85_hoja1->dif85) / $pension->dif85_text;
            }
        });

        foreach ($pensiones as $pension) {
            if ($pension->hoja == 'hoja-1') {
                $pension_hoja1 = $pension->pension_mensual;
            }
            if ($pension->hoja == 'hoja-4') {
                $pension_hoja4 = $pension->pension_mensual;
            }
        }

        $expectativas = Expectativas_Salariales::where('uuid', $pension->uuid)
            ->first();

        $estrategias = Estrategias::where('uuid', $pension->uuid)
            ->where('estrategia', '!=', '')
            ->get();

        $empresa = Empresa::first();

        $tmp = $this->preparaTemporalEstrategias($pension->uuid, $estrategias);
        $tmp_fecha_salario =  $this->preparaTemporalFechaSalario($pension->uuid, $estrategias);
        $nivel_vida = Nivel_Vida::find($pension->uuid);

        if ($nivel_vida == null) {
            $nivel  = new \App\Nivel_Vida();
            $nivel->uuid = $request->uuid;
            $nivel->save();
            $nivel_vida = Nivel_Vida::where('uuid', $pension->uuid)->first();
        }

        $data = array(
            'uuid' => $request->uuid,
            'idCliente' => $request->idCliente,
            'cliente' => $cliente,
            'pensiones' => $pensiones,
            'cliente_ano_mes' => $cliente,
            'pension_1_4' => [$pension_hoja1, $pension_hoja4],
            /* Data para Radiografía */
            'estrategias' => $estrategias,
            'tmp' => $tmp,
            'empresa' => $empresa,
            /** Data para las expectativas */
            'expectativas' => $expectativas,
            /** Nivel de vida */
            'nivel_vida' => $nivel_vida,
            'tmp_fecha_salario' => $tmp_fecha_salario,
            'maxima_en_monto' => $maxima_en_monto,
            'showIslr' => $this->showIslr

        );

        $nameFilePdf = strtoupper(trim($cliente->nombre)) . '-DETALLE PLAN.pdf';

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $rutaFile = public_path() . '/pdf/' . $nameFilePdf;
            $ruta = '/pdf/' . $nameFilePdf;
        } else {
            $rutaFile = public_path() . '/pdf/' . $nameFilePdf;
            $ruta = '/pdf/' . $nameFilePdf;
        }
        $nro = rand(1, 1000);
        // dd($data);
        \PDF::loadView('pdf.detallepdf', $data)->setPaper('letter', 'landscape')->save($rutaFile);
        return response()->json(array('success' => true, 'mensaje' => 'Pdf detalle generado exitosamente', 'data' => $ruta, 'email' => $cliente->email));
    }

    public function sendMailDetalle(Request $request)
    {
        $cliente = Clientes::find($request->idCliente);
        $empresa = Empresa::first();
        $details = array(
            'empresa' => $empresa,
            'cliente' => $cliente,
        );

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $rutaFile = base_path() . '\public\\' . $request->archivoPdf;
        } else {
            $rutaFile =  public_path($request->archivoPdf);
        }

        $data = [
            'email'   => $cliente->email,
            'subject' => 'Planeación A La Medida – Plan',
            'adjunto'    =>  $rutaFile
        ];


        Mail::send('emails.plantilla-detalle', $details, function ($message) use ($data) {
            $message->to($data['email'], 'Pensión a la medida.');
            $message->attach($data['adjunto']);
            $message->subject($data['subject']);
        });

        if (Mail::failures()) {
            return response()->json(array('success' => true, 'mensaje' => 'Envío de correo a fallado'));
        } else {
            return response()->json(array('success' => true, 'mensaje' => 'El correo se ha enviado con exito'));
        }
    }

    public function changeViewNivelVida(Request $request)
    {
        $nivel = Nivel_Vida::firstOrCreate(
            ['uuid' =>  request('uuid')]
        );

        $nivel->empresa = request('empresaNivelVida');
        $nivel->fecha =  request('fechaNivelvida');
        $nivel->salario_diario = request('salarioDiarioNivelVida');
        $nivel->factor_actualizacion =  request('inpcMesActual') / request('inpcMesOriginal');
        $nivel->mejor_salario_diario = request('salarioDiarioNivelVida') * (request('inpcMesActual') / request('inpcMesOriginal'));
        $nivel->mejor_salario_mensual =  request('salarioDiarioNivelVida') * (request('inpcMesActual') / request('inpcMesOriginal')) * 30.4;
        $nivel->inpc_original = request('inpcMesOriginal');
        $nivel->inpc_acual =  request('inpcMesActual');
        $nivel->save();

        $cliente = Clientes::find($request->idCliente);
        $cliente->edad = Carbon::parse($cliente->fechaNacimiento)->age;
        $pensiones = Pension_Final::where('uuid', $request->uuid)->get();
        $expectativas = Expectativas_Salariales::where('uuid', $request->uuid)
            ->first();
        $fecNac = Carbon::parse($cliente->fechaNacimiento);
        $fechaFutura = $fecNac->addYear($expectativas->edadA);
        $maxima_en_monto =  $expectativas->rangoInversionA * (Carbon::parse($expectativas->fechaPlan)->diffInDays($fechaFutura) / 365) * 12;

        $cliente->edad_faltante = $this->AnosFaltantes($cliente->fechaNacimiento, $expectativas->edadA, $expectativas->fechaPlan);

        $pension_dif85_hoja1 = Pension_Final::where('uuid', $request->uuid)->where('hoja', 'hoja-1')->select('dif85')->first();

        $showIslr = false;
        $pensiones->map(function ($pension)  use ($cliente, $pension_dif85_hoja1) {
            $hoja = $pension->hoja;

            $pension->jubilacion = 0;
            $pension->UMAs15 = 86.88 * 15 * 30.4;
            //86.88 * 15 * 30.4

            $base_impuesto = ($pension->pension_mensual + $pension->jubilacion) - $pension->UMAs15;
            $pension->base_impuesto = $base_impuesto > 0 ? $base_impuesto : 0;

            if ($pension->base_impuesto > 0) {
                $this->showIslr = true;
            }

            if ($pension->base_impuesto > 0) {
                $islr = $this->buscarISLR($pension->base_impuesto);
                $pension->islr_LI = $islr->limite_inferior;
                $pension->islr_tasa = $islr->porc;
                $pension->islr_cuota_fija = $islr->cuota_fija;
            } else {
                $islr = 0;
                $pension->islr_LI = 0;
                $pension->islr_tasa = 0;
                $pension->islr_cuota_fija = 0;
            }

            $rango_fecha = $this->rangos_fechas($pension->uuid, $hoja);
            //dd($rango_fecha['fecha_menor']->format('Y-m-d'));
            $del = $rango_fecha['fecha_menor'];
            $al = $rango_fecha['fecha_mayor'];
            $pension->del = $rango_fecha['fecha_menor'];
            $pension->al = $rango_fecha['fecha_mayor'];
            $pension->edad_detalle = $del->diff($al)->format('%y Años, %m meses y %d días');
            $pension->edad_anos_meses = $al->diff($del)->format('%y año(s) más %m mes(es)');

            if ($hoja == 'hoja-1') {
                $expectativas = Expectativas_Salariales::where('uuid', $pension->uuid)->first();
                $pension->edad_real_pension = $expectativas->edadDe . ' Años, 0 meses';
                $pension->porc_pension = $this->porcentaje_pension($pension->edad_real_pension);
            } else {
                $cotiza_clientes_fechas = Cotizaciones_Clientes::where('uuid', $pension->uuid)
                    ->where('estrategias', '6')
                    ->where('hoja', $hoja)
                    ->first();

                $fecNac = Carbon::parse($cliente->fechaNacimiento);
                $fechaRetiro = $al;
                $pension->edad_real_pension =  $fecNac->diff($fechaRetiro)->format('%y Años, %m meses, %d días');
                $pension->porc_pension = $this->porcentaje_pension($pension->edad_real_pension);
            }
            if ($hoja != 'hoja-1') {
                $pension->rendimiento_anual = ($pension->dif85 - $pension_dif85_hoja1->dif85) / $pension->dif85_text;
            }
        });

        //dd($pensiones);

        foreach ($pensiones as $pension) {
            if ($pension->hoja == 'hoja-1') {
                $pension_hoja1 = $pension->pension_mensual;
            }
            if ($pension->hoja == 'hoja-4') {
                $pension_hoja4 = $pension->pension_mensual;
            }
        }

        $estrategias = Estrategias::where('uuid', $pension->uuid)
            ->where('estrategia', '!=', '')
            ->get();

        $tmp = $this->preparaTemporalEstrategias($pension->uuid, $estrategias);
        $tmp_fecha_salario =  $this->preparaTemporalFechaSalario($pension->uuid, $estrategias);
        $nivel_vida = Nivel_Vida::find($pension->uuid);

        if ($nivel_vida == null) {
            $nivel  = new \App\Nivel_Vida();
            $nivel->uuid = $request->uuid;
            $nivel->save();
            $nivel_vida = Nivel_Vida::where('uuid', $pension->uuid)->first();
        }

        $data = array(
            'uuid' => $request->uuid,
            'idCliente' => $request->idCliente,
            'cliente' => $cliente,
            'pensiones' => $pensiones,
            'cliente_ano_mes' => $cliente,
            'pension_1_4' => [$pension_hoja1, $pension_hoja4],
            /* Data para Radiografía */
            'estrategias' => $estrategias,
            'tmp' => $tmp,
            /* Data para Expectativas */
            'expectativas' => $expectativas,
            /** Nivel de Vida */
            'nivel_vida' => $nivel_vida,
            'tmp_fecha_salario' => $tmp_fecha_salario,
            'maxima_en_monto' => $maxima_en_monto,
            'showIslr' => $this->showIslr
        );

        $view = \View::make('pdf.pdf-detalle', $data);
        if ($request->ajax()) {
            $sections = $view->renderSections();
            return Response::json($sections['contenido']);
        } else return $view;
    }
}
