<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';  

    protected function Guardar($request)
    {    	
        
        if ( is_null($request->idCliente) ){     
            $cliente  = new \App\Clientes();
        }else{
            $cliente  = \App\Clientes::find($request->idCliente);
        }

		$cliente->nombre  = $request->nombre;
        $cliente->apellidos       = $request->apellidos;
        $cliente->nroDocumento  = $request->nroDocumento;
        $cliente->nroSeguridadSocial  = $request->nroSeguridadSocial;
        $cliente->fechaNacimiento       = $request->fecNacimiento;
        $cliente->genero  = $request->genero;
        $cliente->estadoCivil       = $request->estadocivil;
        $cliente->cp  = $request->codigopostal;
        $cliente->direccion       = $request->direccion;
        $cliente->email  = $request->email;
        $cliente->estado       = $request->estado;
        $cliente->telefonoFijo  = $request->telefonofijo;
        $cliente->telefonoMovil       = $request->telefonoMovil;
        $cliente->enCooperativa  = $request->has("enCooperativa") ? 'S' : 'N';
        $cliente->cotizandoM40  = $request->has("cotizandoM40") ? 'S' : 'N';

        return $cliente->save();
        
    }
}
