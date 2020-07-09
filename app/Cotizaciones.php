<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones extends Model
{
    protected $table = 'cotizaciones';
    protected $fillable = ['desde','hasta','salario'];
    
}
