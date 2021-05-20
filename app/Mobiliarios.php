<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobiliarios extends Model
{
    protected $table = 'mobiliarios'; 
    protected $fillable = ['tipo','descripcion','status'];
}
