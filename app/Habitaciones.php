<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitaciones extends Model
{
    protected $table = 'habitaciones';
    
    protected $fillable = ['num_habitacion','tipo','capacidad', 'piso', 'mobiliario', 'observaciones'];

}
