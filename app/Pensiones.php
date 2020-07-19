<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \App\Expectativas_Salariales;
use \App\Cotizaciones_Clientes;
use \App\Pension_Final;

class Pensiones extends Model
{
    protected $table = 'pensiones';
    protected $primaryKey = 'idCliente';

    protected function Guardar($request)
    {

        try {
            DB::beginTransaction();

            if ($request->NewOrEdit == 'New') {
                $pension  = new \App\Pensiones();
                $uuid = Uuid::generate();
                $pension->uuid = $uuid;

                $espectativas = new Expectativas_Salariales;
                $espectativas->uuid = $uuid;
            } else {
                $uuid = $request->uuid;
                $pension  = \App\Pensiones::find($request->idCliente);
                $espectativas  = \App\Expectativas_Salariales::find($request->uuid);
            }


            /** Guarda información en TB Pensiones */
            $pension->idCliente  = $request->idCliente;
            $pension->tipoPlan   = $request->tipoPlan;
            $pension->created_by = Auth::id();
            $pension->save();

            /** Guarda información TB Expectativas Salariales */
            $espectativas->fechaPlan          = $request->fechaPlan;
            $espectativas->edadDe             = $request->edadDe;
            $espectativas->edadA              = $request->edadA;
            $espectativas->semanasCotizadas   = $request->semanasCotizadas;
            $espectativas->semanasDescontadas = $request->semanasDescontadas;
            $espectativas->esposa             = $request->esposa;
            $espectativas->padres             = $request->padres;
            $espectativas->hijos              = $request->hijos;
            $espectativas->rangoPensionDe     = $request->rangoPensionDe;
            $espectativas->rangoPensionA      = $request->rangoPensionA;
            $espectativas->rangoInversionDe   = $request->rangoInversionDe;
            $espectativas->rangoInversionA    = $request->rangoInversionA;
            $espectativas->vigente            = $request->has("statusRetiro") ? 'S' : 'N';
            $espectativas->fechaRetiro        = $request->fechaBaja;
            $espectativas->comentarios        = $request->comentarios;
            $espectativas->otrosComentarios   = $request->otrosComentarios;
            $espectativas->save();

            $cotizacionesHoja1 = Cotizaciones_Clientes::where('uuid', $uuid)->get()->each->delete();

            $cotizacionesHoja1 = json_decode($request->cotizacionesHoja1);

            foreach ($cotizacionesHoja1 as $cotiza) {
                $cotiza_cliente             = new Cotizaciones_Clientes;
                $cotiza_cliente->uuid       = $uuid;
                $cotiza_cliente->hoja       = $cotiza->hoja;
                #$cotiza_cliente->estrategias = $cotiza->estrategia;
                $cotiza_cliente->del        = $cotiza->fechaDesde;
                $cotiza_cliente->al         = $cotiza->fechaHasta;
                $cotiza_cliente->dias       = $cotiza->dias;
                $cotiza_cliente->monto      = $cotiza->monto;
                $cotiza_cliente->total      = $cotiza->totalMonto;
                $cotiza_cliente->inscripcion      = $cotiza->inscripcion;
                $cotiza_cliente->save();
            }

            $cotizacionesHoja2 = json_decode($request->cotizacionesHoja2);

            foreach ($cotizacionesHoja2 as $cotiza) {
                $cotiza_cliente             = new Cotizaciones_Clientes;
                $cotiza_cliente->uuid       = $uuid;
                $cotiza_cliente->hoja       = $cotiza->hoja;
                $cotiza_cliente->estrategias = $cotiza->estrategia;
                $cotiza_cliente->del        = $cotiza->fechaDesde;
                $cotiza_cliente->al         = $cotiza->fechaHasta;
                $cotiza_cliente->dias       = $cotiza->dias;
                $cotiza_cliente->monto      = $cotiza->monto;
                $cotiza_cliente->total      = $cotiza->totalMonto;
                $cotiza_cliente->inscripcion      = $cotiza->inscripcion;
                $cotiza_cliente->save();
            }

            $cotizacionesHoja3 = json_decode($request->cotizacionesHoja3);
            foreach ($cotizacionesHoja3 as $cotiza) {
                $cotiza_cliente             = new Cotizaciones_Clientes;
                $cotiza_cliente->uuid       = $uuid;
                $cotiza_cliente->hoja       = $cotiza->hoja;
                $cotiza_cliente->estrategias = $cotiza->estrategia;
                $cotiza_cliente->del        = $cotiza->fechaDesde;
                $cotiza_cliente->al         = $cotiza->fechaHasta;
                $cotiza_cliente->dias       = $cotiza->dias;
                $cotiza_cliente->monto      = $cotiza->monto;
                $cotiza_cliente->total      = $cotiza->totalMonto;
                $cotiza_cliente->inscripcion      = $cotiza->inscripcion;
                $cotiza_cliente->save();
            }

            $cotizacionesHoja4 = json_decode($request->cotizacionesHoja4);
            foreach ($cotizacionesHoja4 as $cotiza) {
                $cotiza_cliente             = new Cotizaciones_Clientes;
                $cotiza_cliente->uuid       = $uuid;
                $cotiza_cliente->hoja       = $cotiza->hoja;
                $cotiza_cliente->estrategias = $cotiza->estrategia;
                $cotiza_cliente->del        = $cotiza->fechaDesde;
                $cotiza_cliente->al         = $cotiza->fechaHasta;
                $cotiza_cliente->dias       = $cotiza->dias;
                $cotiza_cliente->monto      = $cotiza->monto;
                $cotiza_cliente->total      = $cotiza->totalMonto;
                $cotiza_cliente->inscripcion      = $cotiza->inscripcion;
                $cotiza_cliente->save();
            }

            $cotizacionesHoja5 = json_decode($request->cotizacionesHoja5);
            foreach ($cotizacionesHoja5 as $cotiza) {
                $cotiza_cliente             = new Cotizaciones_Clientes;
                $cotiza_cliente->uuid       = $uuid;
                $cotiza_cliente->hoja       = $cotiza->hoja;
                $cotiza_cliente->estrategias = $cotiza->estrategia;
                $cotiza_cliente->del        = $cotiza->fechaDesde;
                $cotiza_cliente->al         = $cotiza->fechaHasta;
                $cotiza_cliente->dias       = $cotiza->dias;
                $cotiza_cliente->monto      = $cotiza->monto;
                $cotiza_cliente->total      = $cotiza->totalMonto;
                $cotiza_cliente->inscripcion      = $cotiza->inscripcion;
                $cotiza_cliente->save();
            }

            $cotizacionesHoja6 = json_decode($request->cotizacionesHoja6);
            foreach ($cotizacionesHoja6 as $cotiza) {
                $cotiza_cliente             = new Cotizaciones_Clientes;
                $cotiza_cliente->uuid       = $uuid;
                $cotiza_cliente->hoja       = $cotiza->hoja;
                $cotiza_cliente->estrategias = $cotiza->estrategia;
                $cotiza_cliente->del        = $cotiza->fechaDesde;
                $cotiza_cliente->al         = $cotiza->fechaHasta;
                $cotiza_cliente->dias       = $cotiza->dias;
                $cotiza_cliente->monto      = $cotiza->monto;
                $cotiza_cliente->total      = $cotiza->totalMonto;
                $cotiza_cliente->inscripcion      = $cotiza->inscripcion;
                $cotiza_cliente->save();
            }

            Pension_Final::where('uuid', $uuid)->get()->each->delete();
            $resumenPensiones = json_decode($request->resumenPensiones);
            foreach ($resumenPensiones as $resumen) {
                $pension_final                  = new Pension_Final;
                $pension_final->uuid            = $uuid;
                $pension_final->hoja            = $resumen->hoja;
                $pension_final->pension_mensual = $resumen->mensual;
                $pension_final->pension_anual   = $resumen->anual;
                $pension_final->aguinaldo       = $resumen->aguinaldo;
                $pension_final->total_anual     = $resumen->total_anual;
                $pension_final->dif85           = $resumen->dif85;
                $pension_final->save();
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return $this->internalException($e, __FUNCTION__);
        }
    }
}
