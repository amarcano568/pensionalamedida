<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends Model
{
    protected $table = 'users';  
    protected $guard_name = 'web';
    use HasRoles;
    protected function Guardar($request)
    {    	
        
        if ( is_null($request->idUser) ){     
            $usuario  = new \App\User();
            $usuario->email = $request->email;
            $usuario->foto = 'user-icon.png';
            $usuario->password           = Hash::make('12345678');
            $usuario->assignRole($request->rol);
        }else{
            $usuario  = \App\User::where('email',$request->email)->first();
            $roles = $usuario->getRoleNames();
            $usuario->removeRole($roles[0]);
            $usuario->assignRole($request->rol);
        }

		$usuario->name  = $request->nombre;
        $usuario->telefonoMovil       = $request->telefonoFijo;
        $usuario->telefonoFijo  = $request->telefonoMovil;
        $usuario->direccion       = $request->direccion;
        $usuario->cp  = $request->cp;
        $usuario->pais_id       = $request->pais;
        $usuario->facebook  = $request->facebook;
        $usuario->instagram       = $request->instagram;
        $usuario->twitter  = $request->twitter;
        $usuario->linkedin       = $request->linkedin;
        
        return $usuario->save();
        
    }
}
