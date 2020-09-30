<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipos_Semanas_Descontadas extends Model
{
    protected $table = "tipos_semanas_descontadas";

    protected function Guardar($request)
    {

        if (is_null($request->idTipo)) {
            $tipo  = new \App\Tipos_Semanas_Descontadas();
        } else {
            $tipo  = \App\Tipos_Semanas_Descontadas::find($request->idTipo);
        }

        $tipo->nombre  = $request->nombre;
        $tipo->tipo       = $request->tipo;
        $tipo->status  = $request->status;
        return $tipo->save();
    }
}
