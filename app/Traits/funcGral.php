<?php

namespace App\Traits;

use \Auth;
use \DB;
use Carbon\Carbon;


trait funcGral
{

    public function Edad($fecNacimiento)
    {
        return Carbon::parse($fecNacimiento)->age;
    }

    public function EdadDetalle($fecNacimiento, $fecPlan)
    {
        return Carbon::createFromDate($fecNacimiento)->diff($fecPlan)->format('%y Años, %m meses y %d días');
    }

    public function AnosFaltantes($fecNacimiento, $edadA, $fechaPlan)
    {
        $fechaRetiro = Carbon::parse($fecNacimiento)->addYear($edadA);
        //dd($fechaRetiro);
        $fechaPlan = Carbon::parse($fechaPlan);


        return $fechaPlan->diff($fechaRetiro)->format('%y Años, %m meses y %d días');
    }

    public function DiasEntreFechas($fechaDesde, $fechaHasta)
    {
        $fechaDesde = Carbon::parse($fechaDesde);
        $fechaHasta = Carbon::parse($fechaHasta);
        return $fechaHasta->diffInDays($fechaDesde);
    }

    public function TiempoIndividualFaltanteRetiro($fecNacimiento, $edadA, $fechaPlan)
    {
        $fechaRetiro = Carbon::parse($fecNacimiento)->addYear($edadA);

        $fechaPlan = Carbon::parse($fechaPlan);

        $anos =  $fechaPlan->diffInYears($fechaRetiro);
        $meses =  $fechaPlan->diffInMonths($fechaRetiro);
        $semanas =  $fechaPlan->diffInWeeks($fechaRetiro);
        $dias =  $fechaPlan->diffInDays($fechaRetiro);

        $detalleTiempo = [
                            'anos' => $anos,
                            'meses' => $meses,
                            'semanas' => $semanas,
                            'dias' => $dias
                        ];
        return $detalleTiempo;
    }

    
}
