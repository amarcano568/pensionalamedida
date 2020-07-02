<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \DataTables;
use Illuminate\Support\Facades\DB;
use Exception;
use \App\User;
use \App\Usuario;
use \App\Paises;
use \App\Roles;
use Spatie\Permission\Models\Role;

class MantenimientoUsuariosController extends Controller
{
    public function gestionUsuarios()
    {
        $paises = Paises::get();
        $roles = Roles::get();
        $data = array(
            'paises' => $paises,
            'roles' => $roles
        );
        return view('usuarios.gestion', $data);
    }

    public function listarUsuarios(Request $request)
    {
        try {
            DB::beginTransaction();
            $users = \App\User::join('paises', 'users.pais_id', 'paises.idPais')
                ->select('id', 'foto', 'name', 'email', 'pais_id', 'paises.nombre', 'users.status')
                ->get();

            $users->map(function ($user) {
                $roles = $user->roles->pluck('name');
                $nameRol = '';
                foreach ($roles as $rol => $value) {
                    $nameRol .=  $value;
                }
                $user->rol = $nameRol;
            });
            //dd($users);
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="icono-action text-center">
                                         <a data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Editar los datos del usuario (<strong>' . $row->name . '</strong>)." href="" data-accion="editar-usuario" idUser="' . $row->id . '">
                                             <i style="font-size: 1em;" class="text-success cil-pencil"></i>
                                         </a>
                                         <a data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Bloquear el acceso al usuario (<strong>' . $row->name . '</strong>)." href="" data-accion="bloquear-usuario" idUser="' . $row->id . '" >
                                            <i style="font-size: 1em;" class="text-danger cil-user-x"></i>
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

    public function editarUsuario(Request $request)
    {
        $user = User::where('id', $request->idUser)->first();

        $roles = $user->getRoleNames();
        $user['rol'] =  $roles[0];

        return response()->json(array('success' => true, 'mensaje' => 'Datos del usuario obtenido', 'data' => $user));
    }

    public function bloquearUsuario(Request $request)
    {
        $user = User::find($request->idUser);

        $user->status = $user->status == 1 ? 0 : 1;

        if ($user->save()) {
            return response()->json(array('success' => true, 'mensaje' => 'Status del usuario actualizado exitosamente.', 'data' => $user));
        } else {
            return response()->json(array('success' => false, 'mensaje' => 'Hubo un problema intentando actualizar el status del usuario.', 'data' => $user));
        }
    }
}
