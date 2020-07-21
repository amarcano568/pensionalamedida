<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Pensiones;
use \App\Clientes;
use \App\Expectativas_Salariales;
use \App\Formulas_tabla;
use \App\Cotizaciones;
use \App\Cotizaciones_Clientes;
use App\Empresa;
use \App\Pension_Final;
use Carbon\Carbon;
use \DataTables;
use Illuminate\Support\Facades\DB;
use Redirect, Response, Config;
use Mail;

use PDF;

class PdfsController extends Controller
{
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
        return view('pdf.pdf-detalle', $data);
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
}
