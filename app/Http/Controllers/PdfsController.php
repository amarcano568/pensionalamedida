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
            $rutaFile =  realpath('public/pdf/' . $request->archivoPdf);
            echo  'prueba ' . $rutaFile;
            die();
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
}
