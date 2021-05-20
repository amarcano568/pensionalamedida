<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    protected $table = 'alumnos'; 
    protected $primaryKey = 'numIdAlumno';

    protected $fillable = [
        'numIdAlumno',
        'strNombre',
        'strApellidos',
        'strCodigoExpediente',
        'strDomicilio',
        'strPais',
        'strPoblacion',
        'strProvincia',
        'strTelefono1',
        'strNif',
        'blnVigente',
        'blnBaja',
        'fecFechaAlta',
        'fecFechaNacimiento',
        'strCodigoPostal',
        'strEMail',
        'strFoto',
        'blnEmagister',
        'strNumeroSeguridadSocial',
        'strSexo',
        'strTelefono2',
        'fecFechaAltaCentro',
        'numNivelEstudios',
        'numIdOrigen',
        'numIdProvincia',
        'numIdPais',
        'blnMatriculado',
        'strRutaNotas',
        'numTipoNif',
        'strTelefonoMovil',
        'strPaisNacimiento',
        'numIdPaisNacimiento',
        'strProvinciaNacimiento',
        'numIdProvinciaNacimiento'
    ];

    public function scopeStatus($query, $status){
        if($status){
            return $query->where('alumnos.blnVigente',$status);
        }
    }
    
}
