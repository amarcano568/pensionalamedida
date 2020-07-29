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
use Carbon\Carbon;
use \DataTables;
use Illuminate\Support\Facades\DB;
use Redirect, Response, Config;
use Mail;
use App\Traits\funcGral;

use PDF;

class PdfsController extends Controller
{
    use funcGral;

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
            'subject' => 'Resumen del plan - Pensión a la medida',
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
        $cliente->edad_faltante = $this->AnosFaltantes($cliente->fechaNacimiento, $expectativas->edadA, $expectativas->fechaPlan);

        $pension_dif85_hoja1 = Pension_Final::where('uuid', $request->uuid)->where('hoja', 'hoja-1')->select('dif85')->first();

        $pensiones->map(function ($pension)  use ($cliente, $pension_dif85_hoja1) {
            $hoja = $pension->hoja;

            $rango_fecha = $this->rangos_fechas($pension->uuid, $hoja);
            //dd($rango_fecha['fecha_menor']->format('Y-m-d'));
            $del = $rango_fecha['fecha_menor'];
            $al = $rango_fecha['fecha_mayor'];
            $pension->del = $rango_fecha['fecha_menor'];
            $pension->al = $rango_fecha['fecha_mayor'];
            $pension->edad_detalle = $del->diff($al)->format('%y | %m');
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
                $pension->edad_real_pension =  $fecNac->diff($fechaRetiro)->format('%y Años, %m meses');
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
            'expectativas' => $expectativas
        );

        return view('pdf.pdf-detalle', $data);
    }

    public function rangos_fechas($uuid, $hoja)
    {
        $estrategias = Estrategias::where('uuid', $uuid)->where('hoja', $hoja)->get();

        /* Define la fecha menor de las esrategias */
        $fecha_menor = Carbon::parse('2050-01-01');
        foreach ($estrategias as $item) {
            $fecha_estrategia =  Carbon::parse($item->desde);
            if ($fecha_estrategia->lessThanOrEqualTo($fecha_menor)) {
                $fecha_menor = $fecha_estrategia;
            }
        }

        /* Define la fecha menor de las esrategias */
        $fecha_mayor = Carbon::parse('1900-01-01');
        foreach ($estrategias as $item) {
            $fecha_estrategia =  Carbon::parse($item->hasta);
            if ($fecha_estrategia->greaterThanOrEqualTo($fecha_mayor)) {
                $fecha_mayor = $fecha_estrategia;
            }
        }

        return array('fecha_menor' => $fecha_menor, 'fecha_mayor' => $fecha_mayor);
    }

    public function porcentaje_pension($edad_real)
    {
        $pos = strpos($edad_real, ',') + 1;
        $mes = substr($edad_real, $pos, 3);
        $edadReal = trim(substr($edad_real, 0, 2)) . "." . trim($mes);
        $edad = round($edadReal);
        if ($edad == 60) {
            $porc = '80%';
        } else if ($edad == 61) {
            $porc = '85%';
        } else if ($edad == 62) {
            $porc = '90%';
        } else if ($edad == 63) {
            $porc = '90%';
        } else if ($edad == 64) {
            $porc = '95%';
        } else if ($edad >= 65) {
            $porc = '100%';
        }

        return $porc;
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

        $cliente = Clientes::find($request->idCliente);
        $cliente->edad = Carbon::parse($cliente->fechaNacimiento)->age;
        $expectativas = Expectativas_Salariales::where('uuid', $request->uuid)
            ->first();
        $cliente->edad_faltante = $this->AnosFaltantes($cliente->fechaNacimiento, $expectativas->edadA, $expectativas->fechaPlan);

        $pensiones = Pension_Final::where('uuid', $request->uuid)->get();

        $pension_dif85_hoja1 = Pension_Final::where('uuid', $request->uuid)->where('hoja', 'hoja-1')->select('dif85')->first();

        $pensiones->map(function ($pension)  use ($cliente, $pension_dif85_hoja1) {
            $hoja = $pension->hoja;
            $cotiza_clientes_fechas = Cotizaciones_Clientes::where('uuid', $pension->uuid)
                ->where('estrategias', '6')
                ->where('hoja', $hoja)
                ->first();
            $del = Carbon::parse($cotiza_clientes_fechas['del']);
            $al = Carbon::parse($cotiza_clientes_fechas['al']);
            $pension->del = $cotiza_clientes_fechas['del'];
            $pension->al = $cotiza_clientes_fechas['al'];
            $pension->edad_detalle = $del->diff($al)->format('%y | %m');
            $pension->edad_anos_meses = $al->diff($del)->format('%y año(s) más %m mes(es)');

            if ($hoja == 'hoja-1') {
                $expectativas = Expectativas_Salariales::where('uuid', $pension->uuid)->first();
                $pension->edad_real_pension = $expectativas->edadDe . ' Años, 0 meses';
                $pension->porc_pension = $this->porcentaje_pension($pension->edad_real_pension);
            } else {
                $fecNac = Carbon::parse($cliente->fechaNacimiento);
                $fechaRetiro = Carbon::parse($al);
                $pension->edad_real_pension =  $fecNac->diff($fechaRetiro)->format('%y Años, %m meses');
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

        $expectativas = Expectativas_Salariales::where('uuid', $pension->uuid)
            ->first();

        $estrategias = Estrategias::where('uuid', $pension->uuid)
            ->where('estrategia', '!=', '')
            ->get();

        $tmp = $this->preparaTemporalEstrategias($pension->uuid, $estrategias);
        $empresa = Empresa::first();
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
            'expectativas' => $expectativas

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
            'subject' => 'Detalle del plan - Pensión a la medida',
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
}
