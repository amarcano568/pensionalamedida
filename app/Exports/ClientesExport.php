<?php

namespace App\Exports;

use App\Clientes;
use App\Empresa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use \DB;

class ClientesExport implements FromCollection,WithHeadings,WithDrawings, WithCustomStartCell,ShouldAutoSize, WithEvents
{
    use Exportable;
    use RegistersEventListeners;
    private $myArray;
    private $myHeadings;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Clientes::leftjoin('estadosmexicanos','estadosmexicanos.id','=','clientes.estado')
            ->select('clientes.id','clientes.nombre', 'apellidos', 'nroDocumento', 'fechaNacimiento', DB::raw('(CASE WHEN clientes.genero = "M" THEN "Masculino" ELSE "Femenino" END) AS genero'), DB::raw('(CASE WHEN clientes.estadoCivil = "Cas" THEN "Casado" WHEN clientes.estadoCivil = "Sol" THEN "Soltero" ELSE "Concubino" END) AS estadoCivil'), 'cp', 'direccion', 'email','estado', 'estadosmexicanos.nombre as NombreEstado', 'telefonoFijo', 'telefonoMovil')
            ->get();
    }

    

    public static function afterSheet(AfterSheet $event)
    {
        
        $styleArray = [
            'font' => [
                'bold' => false,
                'color' => ['argb' => 'ffffff'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],

            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'FFA0A0A0',
                ],
                'endColor' => [
                    'argb' => 'FFFFFFFF',
                ],
            ],
        ];
        $sheet = $event->sheet->getDelegate();
        
       // $to = $event->sheet->getDelegate()->getHighestColumn();
        $event->sheet->getDelegate()->getStyle('A6:O6')->applyFromArray($styleArray);
        $event->sheet->setCellValue('D3', 'INFORME DE CLIENTES');
        //$sheet->setFontFamily('Comic Sans MS');
        $sheet->getStyle('D3')->getFont()->setSize(16);
        $sheet->getStyle('A6:O6')->getFont()->setSize(14);
        $sheet->getStyle('A6:O6')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('0091ff');
            
            
    }

    public function __construct( $myHeadings){
        $this->myHeadings = $myHeadings;
    }

    public function headings(): array{
        return $this->myHeadings;
    }

    public function drawings()
    {
        $logo = \App\Empresa::select('logo')->first(); 
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('PENSION A LA MEDIDA LOGO');
        $drawing->setPath(public_path($logo->logo));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function startCell(): string
    {
        return 'A6';
    }
}
