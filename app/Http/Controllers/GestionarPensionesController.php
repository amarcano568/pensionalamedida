<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Pensiones;
use \App\Clientes;
use Carbon\Carbon;
use \DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\funcGral;

class GestionarPensionesController extends Controller
{
    use funcGral;

    public function gestionarPension()
    {
        // $roles = Roles::get();
        // $data = array(
        //     'roles' => $roles,
        // );
        return view('pensiones.gestion');
    }

    public function listarPensiones(Request $request)
    {
        try {
            DB::beginTransaction();
            $pensiones = Pensiones::join('clientes', 'pensiones.idCliente', 'clientes.id')
                ->join('users', 'pensiones.created_by', 'users.id')
                ->get();

            //dd($pensiones);
            return Datatables::of($pensiones)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="icono-action text-center">
                                         <a data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Editar los datos de pensión del cliente (<strong>' . $row->nombre . '</strong>)." href="" data-accion="editar-cliente" idCliente="' . $row->id . '">
                                             <i style="font-size: 1em;" class="text-success far fa-edit"></i>
                                         </a>
                                         <a data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Enviar correo resumen al cliente (<strong>' . $row->nombre . '</strong>)." href="" data-accion="corre-resumen-cliente" idCliente="' . $row->id . '">
                                             <i style="font-size: 1em;" class="text-warning far fa-envelope"></i>
                                         </a>
                                         <a data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Enviar correo detalle al cliente (<strong>' . $row->nombre . '</strong>)." href="" data-accion="corre-resumen-cliente" idCliente="' . $row->id . '">
                                             <i style="font-size: 1em;" class="text-info far fa-envelope"></i>
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

    public function buscarCliente(Request $request)
    {

        $clientes = Clientes::where('nombre', 'like', '%' . $request->buscar . '%')
            ->where('nombre', 'like', '%' . $request->buscar . '%')
            ->get();

        $i = 0;
        $data = array();
        $dataInfo = array();
        foreach ($clientes as $cliente) {

            $data[$i] = array(
                'id' => $cliente->id,
                'nombre' => $cliente->nombre,
                'apellidos' => $cliente->apellidos,
                'email' => $cliente->email,
                'nroDocumento' => $cliente->nroDocumento,
                'fechaNacimiento' => $cliente->fechaNacimiento,
                'edad' => Carbon::parse($cliente->fechaNacimiento)->age,
                'direccion' => $cliente->direccion,
                'telefonoFijo' => $cliente->telefonoFijo === null ? '' : $cliente->telefonoFijo,
                'telefonoMovil' =>  $cliente->telefonoMovil === null ? '' : $cliente->telefonoMovil,


            );

            $i++;
        }

        return json_encode($data);
    }

    public function calcularEdadCompleta(Request $request)
    {
        $edad = $this->EdadDetalle($request->fecNac, $request->edadA);
        return response()->json(array('success' => true, 'mensaje' => 'Datos del cliente obtenido', 'data' => $edad));
    }

    public function calcularAnosFaltante(Request $request)
    {

        $edad = $this->AnosFaltantes($request->fecNac, $request->edadA, $request->fecPlan);
        return response()->json(array('success' => true, 'mensaje' => 'Datos del cliente obtenido', 'data' => $edad));
    }

    public function generarPlanes()
    {
        // $roles = Roles::get();
        // $data = array(
        //     'roles' => $roles,
        // );
        return view('pensiones.generar-planes');
    }
}
