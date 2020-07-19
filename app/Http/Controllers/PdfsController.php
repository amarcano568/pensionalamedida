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

        //$pdf = PDF::loadView('pdf.resumenpdf', $data)->output();
        //\Storage::disk('public')->put($nameFilePdf, $pdf);
        $nro = rand(1, 1000);
        $nameFilePdf = strtoupper(trim($cliente->nombre)) . '-RESUMEN PLAN.pdf';
        \PDF::loadView('pdf.resumenpdf', $data)->setPaper('letter', 'landscape')->save(base_path() . "\public\pdf\\" . $nameFilePdf);
        return response()->json(array('success' => true, 'mensaje' => 'Pdf resumen generado exitosamente', 'data' => '/pdf/' . $nameFilePdf, 'email' => $cliente->email));
    }

    public function sendMailResumen(Request $request)
    {
        $cliente = Clientes::find($request->idCliente);
        $empresa = Empresa::first();
        $details = array(
            'empresa' => $empresa,
            'cliente' => $cliente,
        );

        //  \Mail::to($cliente->email)->send(new \App\Mail\MyEMail($details));

        $data = [
            'email'   => $cliente->email,
            'subject' => 'Resumen del plan - Pensión a la medida',
            'adjunto'    => base_path() . '\public\\' . $request->archivoPdf
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
