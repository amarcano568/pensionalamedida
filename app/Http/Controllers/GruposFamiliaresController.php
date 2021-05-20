<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GruposFamiliares;
use App\Alumnos;
use App\Hijos;
use Carbon\Carbon;
use Webpatser\Uuid\Uuid;

class GruposFamiliaresController extends Controller
{
    public function gestionarGrupoFamiliar()
    {        
        $padres = Alumnos::where('blnVigente',1)->where('strSexo','H')->get();       
        $madres = Alumnos::where('blnVigente',1)->where('strSexo','M')->get();

        $data = [
            'padres' => $padres,
            'madres' => $madres
        ];
      
        return view('grupos-familiares.gestion', $data);
    }

    public function listarGruposFamiliares(){
        $grupos = GruposFamiliares::get();

        $salida = '';
        foreach($grupos as $grupo){            
            $salida .= $this->drawGroupFamily($grupo,4);
        }

        return response()->json(array('success' => true, 'message' => 'Se genero el listado de grupos', 'data' => '<div class="row">'.$salida.'</div>', ''));
    }

    public function drawGroupFamily($grupo,$col){
        $padre = $this->padres($grupo->padre);
        $madre = $this->padres($grupo->madre);
        return '<div class="col-sm-'.$col.'">
            <div class="card">
                <center>
                    <img class="card-img-top img-responsive" src="img/family.png" alt="" style="height: 96px;width: 96px;">
                </center>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td class="text-center"><strong>Padre</strong></td>
                            <td class="text-center"><strong>Madre</strong></td>
                        </tr>
                        <tr>
                            <td class="text-center">'.$padre.'</td>
                            <td class="text-center">'.$madre.'</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center"><strong>Hijos</strong></td>
                        </tr>
                        '.$this->hijos($grupo->hijos).'
                    </table>
                    <div class="float-right">
                        <a href=""><i data-uuid="'.$grupo->uuid.'" data-toggle="tooltip" data-placement="top" title="Editar este grupo" class="editar-grupo-familiar text-success fa-2x far fa-edit"></i></a>
                        <a href=""><i data-uuid="'.$grupo->uuid.'" data-toggle="tooltip" data-placement="top" title="Eliminar este grupo" class="eliminar-grupo-familiar text-danger fa-2x far fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>';
    }

    public function padres($id){
        $data = Alumnos::select('alumnos.strNombre','alumnos.strApellidos')->find($id);
        return trim($data->strNombre.' '.trim($data->strApellidos));
    }

    public function hijos($hijos){
       if ($hijos == ''){
           return '';
       }

        $hijos = \explode("|",$hijos);
        $salida = '';
        foreach($hijos as $hijo){
            $data_hijo = Hijos::find($hijo);
            if ($data_hijo !== null){
                $nombre = trim($data_hijo->nombres).' '.trim($data_hijo->apellidos);
                $fec_nac =  Carbon::parse($data_hijo->fecha_nacimiento);
                $fecha = $fec_nac->format('d-m-Y').'<br> <i class="text-warning fas fa-birthday-cake"></i> '.$fec_nac->age. ' años';
                $salida .= '<tr>
                                <td class="text-center">'.$nombre.'</td>
                                <td class="text-center"><i class="text-primary far fa-calendar-alt"></i> '.$fecha.'</td>
                            </tr>';
            }
        }
        return $salida;
    }

    public function eliminarGrupoFamiliar(Request $request){
        $deletedRows = GruposFamiliares::where('uuid', $request->uuid)->delete();
        return response()->json(array('success' => true, 'message' => 'El grupo familiar fue eliminado correctamente.', 'data' => '' , ''));
    }

    public function editarGrupoFamiliar(Request $request){
        $grupo = GruposFamiliares::where('uuid', $request->uuid)->first();
        $padres = [
            'padre' => $grupo->padre,
            'madre' => $grupo->madre,
        ];

        $hijos = $grupo->hijos;

        $hijos = explode('|',$hijos);      
        $table = '';
        foreach($hijos as $hijo){
            $data_hijo = Hijos::find($hijo);
            if ($data_hijo !== null){
                $table .=   '<tr>
                                <td>'.$data_hijo->id.'</td>
                                <td>'.$data_hijo->nombres.'</td>
                                <td>'.$data_hijo->apellidos.'</td>
                                <td>'.$data_hijo->dni.'</td>
                                <td>'.$data_hijo->fecha_nacimiento.'</td>
                                <td>'.($data_hijo->sexo == 'H' ? 'Hombre' : 'Mujer').'</td>
                                <td><a href=""><i data-id="'.$data_hijo->id.'" class="delete-hijo text-danger far fa-trash-alt"></i></a></td>
                            </tr>';
            }
        }
        return response()->json(array('success' => true, 'message' => 'Editar grupo familiar.', 'padres' => $padres, 'table' => $table, 'grupo' => $grupo ));
    }

    public function actualizarHijo(Request $request){
        $resul = GruposFamiliares::Guardar($request);
        if ($resul){
            return response()->json(array('success' => true, 'message' => 'Los datos se guardaron correctamente.' ));
        }
        return response()->json(array('success' => false, 'message' => 'Los datos no se pudieron guardar' ));
    }   

    
    public function eliminarHijo(Request $request){
        $deletedRows = Hijos::where('id', $request->idHijo)->delete();
        $grupo = GruposFamiliares::where('uuid',$request->uuid)->first();
        $hijos = $grupo->hijos;
        $grupo->hijos = str_replace('|'.$request->idHijo, "", $hijos);
        $grupo->save();
        return response()->json(array('success' => true, 'message' => 'El hijo fue eliminado correctamente.', 'data' => '' , ''));
    }
    
    public function guardarGrupoFamiliar(Request $request){
        if ( is_null($request->uuid) ){     
            $grupo  = new \App\GruposFamiliares(); 
            $uuid = Uuid::generate(); 
            $grupo->uuid  = $uuid;          
        }else{
            $grupo = GruposFamiliares::where('uuid',$request->uuid)->first();  
        }
              
        $grupo->padre  = $request->padre;
        $grupo->madre  = $request->madre;
        if ($grupo->save()){    
            if ( is_null($request->uuid) ){     
                $alumno = Alumnos::find($request->padre);
                $alumno->uuid_grupo_familiar = $uuid;  
                $alumno->save();
                $alumno = Alumnos::find($request->madre);
                $alumno->uuid_grupo_familiar = $uuid;  
                $alumno->save();
            }      
            return response()->json(array('success' => true, 'message' => 'El grupo familiar se actualizo correctamente.', 'data' => '' , ''));
        }
        return response()->json(array('success' => false, 'message' => 'El grupo familiar no pudo ser creado.', 'data' => '' , ''));
    }

}
