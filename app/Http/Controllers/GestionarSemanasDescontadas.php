<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use \DataTables;
use Illuminate\Support\Facades\DB;
use Exception;
use \App\Tipos_Semanas_Descontadas;
use \App\Porc_calculo;
use Illuminate\Http\Request;

class GestionarSemanasDescontadas extends Controller
{

    public function gestionSemanasDescontadas()
    {

        return view('semanas_descontadas.semanas');
    }

    public function listarSemanasDescontadas(Request $request)
    {
        try {
            DB::beginTransaction();
            $semanas = Tipos_Semanas_Descontadas::get();

            //dd($semanas);
            return Datatables::of($semanas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="icono-action text-center">
                                <a data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Editar tipo semana descuento (<strong>' . $row->nombre . '</strong>)." href="" data-accion="editar-semanas-descontadas" idTipo="' . $row->id . '">
                                    <i style="font-size: 1em;" class="text-success cil-pencil"></i>
                                </a>
                                <a data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Bloquear tipo semana descuento (<strong>' . $row->nombre . '</strong>)." href="" data-accion="bloquear-tipos-semanas" idTipo="' . $row->id . '" >
                                    <i class="text-danger fas fa-ban"></i>
                                </a>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (Exception $e) {
            DB::rollback();
            return $this->internalException($e, __FUNCTION__);
        }
    }

    public function bloquearTiposSemanas(Request $request)
    {
        $tipo = Tipos_Semanas_Descontadas::find($request->idTipo);

        $tipo->status = $tipo->status == 1 ? 0 : 1;

        if ($tipo->save()) {
            return response()->json(array('success' => true, 'mensaje' => 'Status del Tipo de semana descontado actualizado exitosamente.', 'data' => $tipo));
        } else {
            return response()->json(array('success' => false, 'mensaje' => 'Hubo un problema intentando actualizar el Tipo de semana descontado.', 'data' => $tipo));
        }
    }

    public function editarSemanasDescontadas(Request $request)
    {
        $tipos = Tipos_Semanas_Descontadas::where('id', $request->idTipo)->first();
        return response()->json(array('success' => true, 'mensaje' => 'Datos del tipo de semana descontada obtenido', 'data' => $tipos));
    }

    public function actualizaTiposSemanas(Request $request)
    {

        try {
            DB::beginTransaction();
            $save = Tipos_Semanas_Descontadas::Guardar($request);
            DB::commit();
            $mensaje = "Datos del Tipo de semana descontada guardado con exito.";
            if (!$save) {
                $mensaje = "Hubo error intentando guardar los datos.";
                App::abort(500, 'Error');
            }

            return response()->json(array('success' => true, 'mensaje' => $mensaje));
        } catch (Exception $e) {
            DB::rollback();
            return $this->internalException($e, __FUNCTION__);
        }
    }

    public function porcentajeCalculoAnual()
    {
        return view('por_calculo_anual.porcentajes');
    }

    public function listarPorcentajesCalculos(Request $request)
    {
        try {
            DB::beginTransaction();
            $semanas = Porc_calculo::get();

            //dd($semanas);
            return Datatables::of($semanas)
                ->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //     $btn = '<div class="icono-action text-center">
                //                 <a data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Editar porcentaje año(<strong>' . $row->ano . '</strong>)." href="" data-accion="editar-porcentaje" idTipo="' . $row->id . '">
                //                     <i style="font-size: 1em;" class="text-success cil-pencil"></i>
                //                 </a>
                //             </div>';
                //     return $btn;
                // })
                // ->rawColumns(['action'])
                ->make(true);
        } catch (Exception $e) {
            DB::rollback();
            return $this->internalException($e, __FUNCTION__);
        }
    }

}
