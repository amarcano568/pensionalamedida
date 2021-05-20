<?php

namespace App\Imports;

use App\Alumnos_tmp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class AlumnosImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       // dd($row);
        return new Alumnos_tmp([            
            'numIdAlumno' => $row[strtolower('numIdAlumno')],
            'strNombre' => $row[strtolower('strNombre')],
            'strApellidos' => $row[strtolower('strApellidos')],   
            'strCodigoExpediente' => $row[strtolower('strCodigoExpediente')],
            'strDomicilio' => $row[strtolower('strDomicilio')],
            'strPais' => $row[strtolower('strPais')],   
            'strPoblacion' => $row[strtolower('strPoblacion')],
            'strProvincia' => $row[strtolower('strProvincia')],
            'strTelefono1' => $row[strtolower('strTelefono1')], 
            'strNif' => $row[strtolower('strNif')],   
            'blnVigente' => $row[strtolower('blnVigente')],
            'blnBaja' => $row[strtolower('blnBaja')],
            'fecFechaAlta' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[strtolower('fecFechaAlta')]),   
            'fecFechaNacimiento' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[strtolower('fecFechaNacimiento')]),
            'strCodigoPostal' => $row[strtolower('strCodigoPostal')],
            'strEMail' => $row[strtolower('strEMail')],   
            'strFoto' => $row[strtolower('strFoto')],
            'blnEmagister' => $row[strtolower('blnEmagister')],
            'strNumeroSeguridadSocial' => $row[strtolower('strNumeroSeguridadSocial')], 
            'strSexo' => $row[strtolower('strSexo')], 
            'strTelefono2' => $row[strtolower('strTelefono2')],
            'fecFechaAltaCentro' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[strtolower('fecFechaAltaCentro')]),
            'numNivelEstudios' => $row[strtolower('numNivelEstudios')],   
            'numIdOrigen' => $row[strtolower('numIdOrigen')],
            'numIdProvincia' => $row[strtolower('numIdProvincia')],
            'numIdPais' => $row[strtolower('numIdPais')],   
            'blnMatriculado' => $row[strtolower('blnMatriculado')],
            'strRutaNotas' => $row[strtolower('strRutaNotas')],
            'numTipoNif' => $row[strtolower('numTipoNif')], 
            'strTelefonoMovil' => $row[strtolower('strTelefonoMovil')], 
            'strPaisNacimiento' => $row[strtolower('strPaisNacimiento')],
            'numIdPaisNacimiento' => $row[strtolower('numIdPaisNacimiento')],
            'strProvinciaNacimiento' => $row[strtolower('strProvinciaNacimiento')],   
            'numIdProvinciaNacimiento' => $row[strtolower('numIdProvinciaNacimiento')],
            
        ]);
    }

    public function rules(): array
        {
            return [

                // Siempre valida por lotes
                // Fila.columna
                '0.0' => 'in:numIdAlumno',
                '0.1' => 'in:strNombre',
                '0.2' => 'in:strApellidos',
            ];
        }
}
