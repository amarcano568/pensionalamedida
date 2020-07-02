<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Roles;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Exception;

class MantenimientoRolesController extends Controller
{
    public function gestionRoles()
    {
        $roles = Roles::get();
        $data = array(
            'roles' => $roles,
        );
        return view('roles.gestion', $data);
    }

    public function changeRole(Request $request)
    {
        $role = \Spatie\Permission\Models\Role::find($request->idRole);

        $permisosAsignados = $role->getPermissionNames();

        $permisosDisponibles = \Spatie\Permission\Models\Permission::whereNotIn('name', $permisosAsignados)->get();


        $liDispoibles = '';
        foreach ($permisosDisponibles as $disponibles) {
            $liDispoibles .= '<li class="permisoDisponible ui-state-default draggable-item" permission="' . $disponibles->name . '">' . $disponibles->icono . ' ' . $disponibles->nombre . '</li>';
        }
        if ($liDispoibles == '') {
            $liDispoibles = '<li id="liDisponibleEmpty" style="pointer-events:none;opacity:0.6;" class="ui-state-default"></li>';
        }

        $liAsignados = '';
        foreach ($permisosAsignados as $asignados) {
            $permisosNombre = \Spatie\Permission\Models\Permission::where('name', $asignados)->first();
            $liAsignados .= '<li class="permisoAsignado ui-state-default draggable-item" permission="' . $permisosNombre->name . '">' . $permisosNombre->icono . ' ' . $permisosNombre->nombre . '</li>';
        }
        if ($liAsignados == '') {
            $liAsignados = '<li id="liAsignadoEmpty" style="pointer-events:none;opacity:0.6;" class="ui-state-default"></li>';
        }

        $role->roleFormatDate = $role['created_at']->format('d-m-Y  h:i:s');
        return response()->json(array(
            'success' => true,
            'mensaje' => 'Datos del role obtenido exitosamente',
            'data' => $role,
            'asignados' => $liAsignados,
            'disponibles' => $liDispoibles
        ));
    }

    public function revocarPermiso(Request $request)
    {
        $role = Role::findOrFail($request->rol);
        if ($role->hasPermissionTo($request->permiso)) {
            $role->revokePermissionTo($request->permiso);
            return response()->json(array(
                'success' => true,
                'mensaje' => 'Permiso <strong>' . $request->permiso . '</strong> revocado al rol sastifactoriamente.',
                'data' => ''
            ));
        } else {
            return response()->json(array(
                'success' => false,
                'mensaje' => 'Hubo un problema intentando revocar el permiso <strong>' . $request->permiso . '</strong> al rol.',
                'data' => ''
            ));
        }
    }

    public function darPermisoA(Request $request)
    {

        $role = Role::findOrFail($request->rol);

        if ($role->givePermissionTo($request->permiso)) {
            return response()->json(array(
                'success' => true,
                'mensaje' => 'Permiso <strong>' . $request->permiso . '</strong> asignado al rol sastifactoriamente.',
                'data' => ''
            ));
        } else {
            return response()->json(array(
                'success' => false,
                'mensaje' => 'Hubo un problema intentando asignar el permiso <strong>' . $request->permiso . '</strong> al rol.',
                'data' => ''
            ));
        }
    }

    public function nuevoRole(Request $request)
    {
        try {
            DB::beginTransaction();

            // $rules = [
            //             'name' => ['required', 'unique:role,name' ],
            //         ];

            // $customMessages =   [
            //                         'name.unique'  => '<i class="fas fa-exclamation-triangle"></i> Este nombre de role ya existe.',
            //                     ];                                

            // $v =  $this->validate($request, $rules, $customMessages);


            if (Role::create(['name' => $request->newRole])) {
                $roles = Roles::get();
                return response()->json(array(
                    'success' => true,
                    'mensaje' => 'Rol <strong>' . $request->newRole . '</strong> creado sastifactoriamente.',
                    'data' => $roles
                ));
            } else {
                return response()->json(array(
                    'success' => false,
                    'mensaje' => 'Hubo un problema intentando crear el <strong>' . $request->newRole . '</strong>.',
                    'data' => ''
                ));
            }
        } catch (Exception $e) {
            DB::rollback();
            return $this->internalException($e, __FUNCTION__);
        }
    }
}
