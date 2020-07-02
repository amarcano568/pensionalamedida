<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';  

    protected function Guardar($request)
    {    	
        
        $empresa  = \App\Empresa::find($request->idEmpresa);
         
		//$empresa->idEmpresa  = $request->idEmpresa;
        $empresa->nombreFiscal       = $request->nombreFiscal;
        $empresa->nombreComercial  = $request->nombreComercial;
        $empresa->rfc       = $request->rfc;
        $empresa->estado  = $request->estado;
        $empresa->direccion       = $request->direccion;
        $empresa->provincia  = $request->provincia;
        $empresa->cp       = $request->cp;
        $empresa->telefonoFijo  = $request->telefonoFijo;
        $empresa->telefonoMovil       = $request->telefonoMovil;
        $empresa->fax       = $request->fax;
        $empresa->email  = $request->email;
        $empresa->web       = $request->web;
        $empresa->linkedin  = $request->linkedin;
        $empresa->twitter       = $request->twitter;
        $empresa->facebook  = $request->facebook;
        $empresa->instagram       = $request->instagram;
        $empresa->youtube = $request->youtube;
        
        return $empresa->save();
        
    }
}
