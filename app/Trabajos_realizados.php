<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajos_realizados extends Model
{
    protected $table = 'trabajos_realizados'; 
    protected $fillable = ['id_trabajo','fecha','id_alumno', 'observaciones'];
}
