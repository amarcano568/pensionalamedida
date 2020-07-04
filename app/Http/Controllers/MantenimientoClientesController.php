<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \DataTables;
use Illuminate\Support\Facades\DB;
use \App\User;
use \App\Usuario;
use \App\Paises;
use \App\Clientes;
use \App\Estados;
use Spatie\Permission\Models\Role;
use App\Traits\funcGral;
use App\Exports\ClientesExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\Storage;

class MantenimientoClientesController extends Controller
{
    use funcGral;

    public function gestionClientes()
    {
        $paises = Paises::get();
        $estados = Estados::get();
        $data = array(
            'paises' => $paises,
            'estados' => $estados
        );
        return view('clientes.gestion', $data);
    }

    public function listarclientes(Request $request)
    {
        try {
            DB::beginTransaction();
            $clientes = Clientes::get();
            $clientes->map(function ($cliente) {
                $cliente->edad = Carbon::parse($cliente->fechaNacimiento)->age;
            });
            //dd($clientes);
            return Datatables::of($clientes)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="icono-action text-center">
                                         <a data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Editar los datos del clientes (<strong>' . $row->nombre . '</strong>)." href="" data-accion="editar-cliente" idCliente="' . $row->id . '">
                                             <i style="font-size: 1em;" class="text-success cil-pencil"></i>
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

    public function editarCliente(Request $request)
    {
        $cliente = Clientes::find($request->idCliente);
        $cliente->edad = Carbon::parse($cliente->fechaNacimiento)->age;
        return response()->json(array('success' => true, 'mensaje' => 'Datos del cliente obtenido', 'data' => $cliente));
    }

    public function calcularEdad(Request $request)
    {
        return response()->json(array('success' => true, 'mensaje' => 'Status del usuario actualizado exitosamente.', 'data' => $this->Edad($request->fecNac)));
    }

    public function actualizarCliente(Request $request)
    {

        try {
            DB::beginTransaction();
            if (is_null($request->idCliente)) {

                $rules = [
                    'email' => ['required', 'email', 'unique:clientes,email'],
                    'nroDocumento' => ['required', 'unique:clientes,nroDocumento'],
                    'nroSeguridadSocial' => ['required', 'unique:clientes,nroSeguridadSocial'],
                ];

                $customMessages =   [
                    'email.unique' => '<i class="fas fa-exclamation-triangle"></i> Existe otro Cliente con este <strong>Correo</strong>',
                    'nroDocumento.unique'  => '<i class="fas fa-exclamation-triangle"></i> Existe otro Cliente con este <strong>Nro. de Documento</strong>',
                    'nroSeguridadSocial.unique'  => '<i class="fas fa-exclamation-triangle"></i> Existe otro Cliente con este <strong>Nro. de Seguridad Social</strong>',
                ];

                $v =  $this->validate($request, $rules, $customMessages);
            }
            $save = Clientes::Guardar($request);
            DB::commit();
            $mensaje = "Datos del Cliente guardado con exito.";
            if (!$save) {
                $mensaje = "Hubo error intentando guardar los datos Cliente.";
                App::abort(500, 'Error');
            }

            return response()->json(array('success' => true, 'mensaje' => $mensaje));
        } catch (Exception $e) {
            DB::rollback();
            return $this->internalException($e, __FUNCTION__);
        }
    }

    public function generarExcelClientes()
    {
        $header = ['Id', 'Nombre', 'Apellidos', 'Nro. Documento', 'Fecha Nacimiento', 'Género', 'Estado Civil', 'CP', 'Dirección', 'Email', 'Estado', 'Nombre del Estado', 'Telefono Fijo', 'Telefono Movil']; //headers
        Excel::store(new ClientesExport($header, 'A6'), 'clientes.xlsx', 'public');
        return asset('storage/clientes.xlsx');
    }
}
