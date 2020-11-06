<?php

namespace App\Http\Controllers;
//namespace App\Imports;

use Illuminate\Http\Request;
use \App\Pensiones;
use \App\Clientes;
use \App\Expectativas_Salariales;
use \App\Formulas_tabla;
use \App\Cotizaciones;
use \App\Cotizaciones_Clientes;
use \App\Tipos_Semanas_Descontadas;
use \App\Semanas_Descontadas;
use \App\Estrategias;
use Carbon\Carbon;
use \DataTables;
use Illuminate\Support\Facades\DB;
use App\Traits\funcGral;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Imports\CotizacionesImport;
use App\Pension_Final;
use MathParser\StdMathParser;
use MathParser\Interpreting\Evaluator;

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
                ->select('pensiones.id', 'clientes.nombre', 'clientes.apellidos', 'nroDocumento', 'clientes.email', 'nombrePlan', 'nombre', 'name', 'uuid', 'clientes.id as idCliente')
                ->get();

            //dd($pensiones);
            return Datatables::of($pensiones)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="nav navbar-left">
                                <li class="dropdown dropleft">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="text-info fas fa-ellipsis-h"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu" x-placement="left-start" >
                                    <li>
                                        <a class="dropdown-item" href="#"  data-accion="editar-pension" idCliente="' . $row->idCliente . '"  uuid="' . $row->uuid . '">
                                            <i style="font-size: 1em;" class="text-success far fa-edit"></i> Editar Pensión
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" data-accion="ver-pdf-resumen" idCliente="' . $row->idCliente . '"  uuid="' . $row->uuid . '" >
                                            <i style="font-size: 1em;" class="text-primary far fa-file-pdf"></i> Ver pdf resumen
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" data-accion="ver-pdf-detalle" idCliente="' . $row->idCliente . '"  uuid="' . $row->uuid . '"> 
                                            <i style="font-size: 1em;" class="text-secondary far fa-file-pdf"></i> Ver pdf detalle
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
                'nroSeguridadSocial' => $cliente->nroSeguridadSocial,
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

    public function edadCliente(Request $request)
    {
        $fecNac = Carbon::parse($request->fecNac);
        $fechaRetiro = Carbon::parse($request->fechaFutura);
        $edad =  $fecNac->diff($fechaRetiro)->format('%y Años, %m meses, %d días');
        $difInDays =  $fecNac->diffInDays($fechaRetiro) / 365;
        return response()->json(array('success' => true, 'mensaje' => 'Datos del cliente obtenido', 'data' => $edad, 'difInDays' => $difInDays));
    }

    public function calcularDif85Hoja1(Request $request){
        $fechaRetiro = Carbon::parse($request->fecNac)->addYear(85);
        
    }

    public function calcularAnosFaltante(Request $request)
    {

        $edad = $this->AnosFaltantes($request->fecNac, $request->edadA, $request->fecPlan);
        return response()->json(array('success' => true, 'mensaje' => 'Datos del cliente obtenido', 'data' => $edad));
    }

    public function generarPlanes(Request $request)
    {
        // dd($request->idPension);
        $tablas = Formulas_tabla::get();
        if ($request->idPension == '0') {
            $newEdit = 'New';
        } else {
            $newEdit = 'Edit';
        }
        $tiposDescuentoSemanas = Tipos_Semanas_Descontadas::where('status', 1)->get();
        $data = array(
            'tablas' => $tablas,
            'NewPlan' => $newEdit,
            'uuid' => $request->idPension == '0' ? '' : $request->idPension,
            'idCliente' => $request->idPension == '0' ? '' : $request->idCliente,
            'tiposDescuentoSemanas' => $tiposDescuentoSemanas
        );

        return view('pensiones.generar-planes', $data);
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

    public function subirExcelCotizaciones(Request $request)
    {

        try {
            $files    = $request->file('file');
            $ext      = explode('/', $request->file('file')->getMimeType());
            $fileName = $files->getClientOriginalName();
            $extension = $request->file('file')->extension();
            if ($extension == 'bin') {
                $extension = $files->getClientOriginalExtension();
            }

            \Storage::disk('public')->put($fileName,  \File::get($files));

            Cotizaciones::truncate();
            Excel::import(new CotizacionesImport, $fileName, 'public');
            Cotizaciones::where('desde', '1970-01-01')->delete();

            $cotizaciones = Cotizaciones::get();
            $salida = '';
            $i = 0;
            foreach ($cotizaciones as $cotizacion) {
                ++$i;
                $dias = $this->DiasEntreFechas($cotizacion->desde, $cotizacion->hasta);
                $salida .= '<tr class="row2" id="' . $i . '">
                                <td class="altoFilaTable">
                                    <input type="date" row="' . $i . '" id="fechaDesde' . $i . '"
                                        class="form-control-sm form-control fechaCotizacionDesde" value="' . $cotizacion->desde . '">
                                </td>
                                <td class="altoFilaTable">
                                    <input type="date" row="' . $i . '" id="fechaHasta' . $i . '"
                                        class="form-control-sm form-control fechaCotizacionHasta" value="' . $cotizacion->hasta . '">
                                </td>
                                <td class="altoFilaTable">
                                    <input type="text" row="' . $i . '" id="dias' . $i . '"
                                        class="form-control-sm form-control diasCotizacion" readonly value="' . $dias . '">
                                </td>
                                <td class="altoFilaTable">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="number" row="' . $i . '" id="monto' . $i . '" class="form-control-sm form-control montoCotizacion" value="' . $cotizacion->salario . '">
                                    </div>
                                </td>
                                <td class="altoFilaTable">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="text" row="' . $i . '" id="totalMontoCotizacion' . $i . '" class="form-control-sm form-control totalCotizacion" readonly value="' . $dias * $cotizacion->salario . '">
                                    </div>
                                    
                                </td>
                                <td class="altoFilaTable">
                                    <a href="#" class="borrar">
                                        <i class="text-danger far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>';
            }

            return response()->json(array('success' => true, 'mensaje' => 'Excel importado exitosamente', 'data' => $salida));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $fallas = $e->failures();

            // foreach ($fallas as $falla) {
            //     $falla->row(); // fila en la que ocurrió el error
            //     $falla->attribute(); // el número de columna o la "llave" de la columna
            //     $falla->errors(); // Errores de las validaciones de laravel
            //     $falla->values(); // Valores de la fila en la que ocurrió el error.
            // }
            return $this->ValidationException($e, __FUNCTION__);
        }
    }

    public function buscarCuantiaBasica(Request $request)
    {
        $valor = $request->salarioPromedioVsm;
        $cuantia =  DB::table('formulas_tabla')
            ->whereRaw('? >= de and ? <= a', [$valor, $valor])->first();

        return response()->json(array('success' => true, 'mensaje' => 'Retornando cuantía básica de tablas', 'data' => $cuantia));
    }


    public function calcularTiempoIndividualFaltanteRetiro(Request $request)
    {
        $tiempo = $this->TiempoIndividualFaltanteRetiro($request->fecNac, $request->edadA, $request->fecPlan);
        return response()->json(array('success' => true, 'mensaje' => 'Datos del tiempo individual del retiro obtenido con exito', 'data' => $tiempo));
    }

    public function sumarDiasaFechaEstrategias(Request $request)
    {
        try {

            $parser = new StdMathParser();
            $resultado = $parser->parse($request->diasFormulaEvaluar);
            $evaluator = new Evaluator();
            $value = $resultado->accept($evaluator);
            //echo($value);
            $NewFecha = Carbon::parse($request->fechaDondesumar)->addDays($value)->format('Y-m-d');
            return response()->json(array('success' => true, 'mensaje' => 'Dias sumados a la fecha', 'data' => $NewFecha));
        } catch (Throwable $t) {
        }
    }

    public function guardarPlanPension(Request $request)
    {
        //dd($request);
        try {
            DB::beginTransaction();
            $save = Pensiones::Guardar($request);
            DB::commit();
            $mensaje = "Datos del Plan de pensión guardado con exito.";
            if (!$save) {
                $mensaje = "Hubo error intentando guardar los datos de la pensión.";
                //App::abort(500, 'Error');
            }

            return response()->json(array('success' => true, 'mensaje' => $mensaje));
        } catch (Exception $e) {
            DB::rollback();
            return $this->internalException($e, __FUNCTION__);
        }
    }

    public function buscarExpectativas(Request $request)
    {
        $expectativas = Expectativas_Salariales::join('pensiones', 'expectativas_salariales.uuid', 'pensiones.uuid')
            ->join('clientes', 'pensiones.idCliente', 'clientes.id')
            ->where('expectativas_salariales.uuid', $request->uuid)
            ->first();

        return response()->json(array('success' => true, 'mensaje' => 'Expectativa salarial obtenida para el cliente', 'data' => $expectativas));
    }

    public function buscarSemanasDescontadas(Request $request)
    {

        $semanasDescontadas = Semanas_Descontadas::join('tipos_semanas_descontadas', 'semanas_descontadas.tipo', 'tipos_semanas_descontadas.id')
            ->where('uuid', $request->uuid)->get();
        //dd($semanasDescontadas);
        return Datatables::of($semanasDescontadas)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="icono-action text-center">
                        <a semanas="' . $row->semanas . '" class="borrar-semanas-descontadas" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Eliminar semanas descontadas (<strong>' . $row->nombre . '</strong>)." href="" data-accion="eliminar-semanas" idSemana="' . $row->id . '">
                            <i class="text-danger far fa-trash-alt"></i>
                        </a>
                    </div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function buscarCotizacionesHoja1(Request $request)
    {
        $cotizaciones = Cotizaciones_Clientes::where('uuid', $request->uuid)->where('hoja', 'hoja-1')->get();

        $salida = '';
        $i = 0;
        foreach ($cotizaciones as $cotizacion) {
            ++$i;
            $dias = $this->DiasEntreFechas($cotizacion->del, $cotizacion->al);

            $salida .= '<tr class="row2" id="' . $i . '">
                            <td class="altoFilaTable">
                                <input type="date" row="' . $i . '" id="fechaDesde' . $i . '"
                                    class="form-control-sm form-control fechaCotizacionDesde" value="' . Carbon::parse($cotizacion->del)->format('Y-m-d') . '">
                            </td>
                            <td class="altoFilaTable">
                                <input type="date" row="' . $i . '" id="fechaHasta' . $i . '"
                                    class="form-control-sm form-control fechaCotizacionHasta" value="' . Carbon::parse($cotizacion->al)->format('Y-m-d') . '">
                            </td>
                            <td class="altoFilaTable">
                                <input type="text" row="' . $i . '" id="dias' . $i . '"
                                    class="form-control-sm form-control diasCotizacion" readonly value="' . $dias . '">
                            </td>
                            <td class="altoFilaTable">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" row="' . $i . '" id="monto' . $i . '" class="form-control-sm form-control montoCotizacion" value="' . $cotizacion->monto . '">
                                </div>
                            </td>
                            <td class="altoFilaTable">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="text" row="' . $i . '" id="totalMontoCotizacion' . $i . '" class="form-control-sm form-control totalCotizacion" readonly value="' . $dias * $cotizacion->monto . '">
                                </div>
                                
                            </td>
                            <td class="altoFilaTable">
                                <a href="#" class="borrar">
                                    <i class="text-danger far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>';
        }

        return response()->json(array('success' => true, 'mensaje' => 'Cotizaciones generales obtenidas exitosamente', 'data' => $salida));
    }


    public function buscarCotizacionesHoja(Request $request)
    {
        $cotizaciones = Cotizaciones_Clientes::where('uuid', $request->uuid)
            ->where('hoja', $request->hoja)
            ->where('estrategias', '!=', '')
            ->get();

        return response()->json(array('success' => true, 'mensaje' => 'Cotizaciones obtenidas exitosamente para la ' . $request->hoja, 'data' => $cotizaciones));
    }

    public function buscarDataAdicional(Request $request)
    {
        $datos = Pension_Final::where('uuid', $request->uuid)->get();
        return response()->json(array('success' => true, 'mensaje' => 'Obtenidos otros datos de los planes de pensión', 'data' => $datos));
    }

    public function buscarEstrategiasSaveOnBd(Request $request)
    {
        $estrategias = Estrategias::where('uuid', $request->uuid)->get();
        return response()->json(array('success' => true, 'mensaje' => 'Estrategias obtenidas', 'data' => $estrategias));
    }

    public function calcularSemanasFaltantes60(Request $request)
    {
        $edad =  $this->Edad($request->fecNac);
        if ($edad >= 60) {
            return response()->json(array('success' => false, 'mensaje' => 'El cliente tiene <strong>' . $edad . '</strong> años por lo tanto no hay semanas pendiente por calcular.', 'data' => $edad));
        }

        $detalleFecha = $this->TiempoIndividualFaltanteRetiro($request->fecNac, 60, $request->fecPlan);
        return response()->json(array('success' => true, 'mensaje' => $detalleFecha['semanas'] . ' semanas agregadas para el calculo de pensión de la hoja1,', 'data' => $detalleFecha['semanas']));
    }
}
