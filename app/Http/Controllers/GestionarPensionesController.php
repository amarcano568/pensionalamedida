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
                ->join('planes', 'pensiones.tipoPlan', 'planes.id')
                ->get();

            //dd($pensiones);
            return Datatables::of($pensiones)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="nav navbar-left panel_toolbox">
                                <li class="dropdown dropleft">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="text-info fas fa-ellipsis-h"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu" x-placement="left-start" >
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i style="font-size: 1em;" class="text-success far fa-edit"></i> Editar Pensión
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" >
                                            <i style="font-size: 1em;" class="text-primary far fa-file-pdf"></i> Ver pdf resumen
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"> 
                                            <i style="font-size: 1em;" class="text-secondary far fa-file-pdf"></i> Ver pdf detalle
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i style="font-size: 1em;" class="text-warning far fa-envelope"></i> Enviar correo con resumen 
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i style="font-size: 1em;" class="text-danger far fa-envelope"></i> Enviar correo con detalle 
                                        </a>
                                    </li>
                                </ul>
                                </li>
                            </ul>';
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
            ->orWhere('apellidos', 'like', '%' . $request->buscar . '%')
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

    public function calcularDiasEntreFechas(Request $request)
    {
        try {
            $dias = $this->DiasEntreFechas($request->fechaDesde, $request->fechaHasta);
            return response()->json(array('success' => true, 'mensaje' => 'Diferencia entre fechas obtenido', 'data' => $dias));
        } catch (Exception $e) {
            return $this->internalException($e, __FUNCTION__);
        }
    }
}
