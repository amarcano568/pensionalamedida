<?php

namespace App\Imports;

use App\Cotizaciones;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class CotizacionesImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cotizaciones([
            'desde'     => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['desde']),
            'hasta'    => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hasta']),
            'salario' => $row['salario'],
        ]);
    }

    public function rules(): array
        {
            return [

                // Siempre valida por lotes
                // Fila.columna
                '0.0' => 'in:Desde',
                '0.1' => 'in:Hasta',
                '0.2' => 'in:Salario',
            ];
        }
}
