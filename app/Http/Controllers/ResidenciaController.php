<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumnos;
use App\Habitaciones;
use App\Mobiliarios;
use Carbon\Carbon;
use \DataTables;

class ResidenciaController extends Controller
{
    
    public function gestionResidencia(){
        $mobiliarios = Mobiliarios::get();
        $data = [
            'mobiliarios' => $mobiliarios
        ];
        return view('residencia.gestion', $data);
    }

    /**
     *      Listado de habitaciones.
     */
    public function listarHabitaciones(Request $request)
    {
        $habitaciones = Habitaciones::get();

        return Datatables::of($habitaciones)
            ->setRowId('id')
            ->addIndexColumn()           
            ->addColumn('action', function ($row) {
                $btn =  '<div class="icono-action">
                                    <a href="" data-accion="editar-habitacion" data-id-habitacion="' . $row->id . '" data-nombre="'.$row->num_habitacion.'">
                                        <i data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Editar datos de la habitación <strong>' . $row->num_habitacion . '</strong>." class="icono-action text-success far fa-edit">
                                        </i>
                                    </a>
                                    <a href="" data-accion="eliminar-habitacion" data-id-habitacion="' . $row->id . '" data-nombre="'.$row->num_habitacion.'">
                                        <i data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Borrar habitación (<strong>' . $row->num_habitacion . '</strong>)." class="text-danger far fa-trash-alt"></i>
                                    </a>
                                </div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }


    public function getDataHabitacion(Request $request){
        $habitacion = Habitaciones::find($request->id_hab);
        return response()->json(array('success' => true, 'message' => 'Datos de la habitación obtenidos correctamente.', 'data' => $habitacion, ''));
    }

    public function actualizarHabitaciones(Request $request){
        $mobiliario =  implode("|", $request->mobiliario_hab);
        $habitacion = Habitaciones::updateOrCreate(['id' => $request->id_hab], 
                                                ['num_habitacion' => $request->num_hab, 
                                                'tipo' => $request->tipo_hab, 
                                                'capacidad' => $request->cap_hab,
                                                'piso' => $request->pis_hab,
                                                'mobiliario' => $mobiliario,
                                                'observaciones' => $request->obs_hab, 
                                                ]);
        if($habitacion->exists){
            return response()->json(array('success' => true, 'message' => 'Datos de la habitación actualizados correctamente.', 'data' =>  ''));
        }

        return response()->json(array('success' => true, 'message' => 'Habitación creada correctamente.', 'data' =>  ''));
    }

    public function eliminarHabitacion(Request $request){
        $deletedRows = Habitaciones::find($request->id_hab)->delete();
        return response()->json(array('success' => true, 'message' => 'La habitación fue eliminada correctamente.', 'data' => '' , ''));
    }


    public function listarHuespedes(Request $request){
        $huespedes = Alumnos::select('strNombre','strApellidos','num_habitacion','desde','hasta','hasta','uuid_habitacion')
                    ->join('hospedajes', 'hospedajes.uuid', 'alumnos.uuid_habitacion')
                    ->whereNotNull('uuid_habitacion')->get();

        return Datatables::of($huespedes)
        ->setRowId('numIdAlumno')
        ->addIndexColumn()    
        ->addColumn('detalle', function ($row) {
            return $this->DetalleHabitacion($row->num_habitacion);
        })       
        ->addColumn('action', function ($row) {
            $btn =  '<div class="icono-action">
                                <a href="" data-accion="editar-habitacion" >
                                    <i data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="" class="icono-action text-success far fa-edit">
                                    </i>
                                </a>                                
                            </div>';
            return $btn;
        })
        ->rawColumns(['action','detalle'])
        ->make(true);
       
    }

    public function DetalleHabitacion($num_habitacion){
        $mobiliario_habitacion = Habitaciones::select('mobiliario')->where('num_habitacion',$num_habitacion)->first();
        $idMobiliarios = explode('|',$mobiliario_habitacion->mobiliario);
        $salida = '';
        foreach($idMobiliarios as $id){
            if ($id != '' and $id !== null ){
                $mobiliario = Mobiliarios::find($id);
                $salida .= ' <li class="list-group-item"><i class="text-danger fas fa-certificate"></i> '.$mobiliario['descripcion'].'</li>';
            }
        }
        
        return '<div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                    '.$salida.'
                    </ul>
                </div>';
    }

    public function listarMobiliarios(){
        $mobiliarios = Mobiliarios::get();

        return Datatables::of($mobiliarios)
        ->setRowId('id')
        ->addIndexColumn()       
        ->addColumn('action', function ($row) {
            $btn =  '<div class="icono-action">
                <a href="" data-accion="editar-mobiliario" data-id-mobiliario="' . $row->id . '" data-nombre="'.addslashes($row->descripcion).'">
                    <i data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Editar datos del mobiliario <strong>' . addslashes($row->descripcion) . '</strong>." class="icono-action text-success far fa-edit">
                    </i>
                </a>
                <a href="" data-accion="eliminar-mobiliario" data-id-mobiliario="' . $row->id . '" data-nombre="'.addslashes($row->descripcion).'">
                    <i data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Borrar mobiliario (<strong>' . addslashes($row->descripcion) . '</strong>)." class="text-danger far fa-trash-alt"></i>
                </a>
            </div>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }


    public function editarMobiliario(Request $request){
        $mobiliarios = Mobiliarios::find($request->id_mobiliario);
        return response()->json(array('success' => true, 'message' => 'Mobiliarios obtenidos correctamente.', 'data' =>  $mobiliarios));        
    }

    
    public function actualizarMobiliarios(Request $request){
        $mobiliario = Mobiliarios::updateOrCreate(['id' => $request->id_mobiliario], 
                                                ['tipo' => $request->tipo_mobiliario, 
                                                'descripcion' => $request->descripcion_mobiliario, 
                                                'status' => $request->status_mobiliario,                                                
                                                ]);
        if($mobiliario->exists){
            return response()->json(array('success' => true, 'message' => 'Datos del mobiliario actualizaron correctamente.', 'data' =>  ''));
        }

        return response()->json(array('success' => true, 'message' => 'Mobiliario creado correctamente.', 'data' =>  ''));
    }

    
    public function eliminarMobiliario(Request $request){
        $deletedRows = Mobiliarios::find($request->id_mobiliario)->delete();
        return response()->json(array('success' => true, 'message' => 'El mobiliario fue eliminado correctamente.', 'data' => '' , ''));
    }

}
