<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnos_tmp extends Model
{
    protected $table = 'alumnos_tmp'; 
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
}
