<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hijos;

class GruposFamiliares extends Model
{
    protected $table = 'grupos_familiares'; 

    protected function Guardar($request)
    {    	
  
        $hijo = new Hijos;       
		$hijo->nombres = $request->nombre_hijo;
        $hijo->apellidos = $request->apellidos_hijo;
		$hijo->dni = $request->dni_hijo;
        $hijo->fecha_nacimiento = $request->fec_nac_hijo;
		$hijo->sexo = $request->sexo_hijo;

        if( $hijo->save() ){
            $uuid = $request->uuid_grupo_familiar;
            $grupo = GruposFamiliares::where('uuid',$uuid)->first();
            $grupo->hijos = $grupo->hijos.'|'.$hijo->id;
            $grupo->save();
            return true;
        }
        return false;
    }

}
