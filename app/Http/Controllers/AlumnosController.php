<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Alumnos;
use App\Alumnos_tmp;
use App\GruposFamiliares;
use Carbon\Carbon;
use \DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Imports\AlumnosImport;
use App\Trabajos_realizados;
use App\Trabajos;
use App\Habitaciones;
use App\Hospedajes;
use Webpatser\Uuid\Uuid;

class AlumnosController extends Controller
{
    public function subirFicheroNuevosAlumnos(Request $request)
    {
      
        $file   = $request->file('file');
        $nombre = $file->getClientOriginalName();
			
        \Storage::disk('local')->put($nombre,  \File::get($file));
       
        Alumnos_tmp::truncate();
        Excel::import(new AlumnosImport, $nombre);

        $count = 0;
        $data = [];

        $alumnos = Alumnos_tmp::get();
        foreach ($alumnos as $alumno) {
            $data = [];
            $data['numIdAlumno'] = $alumno->numIdAlumno;
            $data['strNombre'] = $alumno->strNombre;
            $data['strApellidos'] = $alumno->strApellidos;
            $data['strCodigoExpediente'] = $alumno->strCodigoExpediente;
            $data['strDomicilio'] = $alumno->strDomicilio;
            $data['strPais'] = $alumno->strPais;
            $data['strPoblacion'] = $alumno->strPoblacion;
            $data['strProvincia'] = $alumno->strProvincia;
            $data['strTelefono1'] = $alumno->strTelefono1;
            $data['strNif'] = $alumno->strNif;
            $data['blnVigente'] = $alumno->blnVigente;
            $data['blnBaja'] = $alumno->blnBaja;
            $data['fecFechaAlta'] = $alumno->fecFechaAlta;
            $data['fecFechaNacimiento'] = $alumno->fecFechaNacimiento;
            $data['strCodigoPostal'] = $alumno->strCodigoPostal;
            $data['strEMail'] = $alumno->strEMail;
            $data['strFoto'] = $alumno->strFoto;
            $data['blnEmagister'] = $alumno->blnEmagister;
            $data['strNumeroSeguridadSocial'] = $alumno->strNumeroSeguridadSocial;
            $data['strSexo'] = $alumno->strSexo;
            $data['strTelefono2'] = $alumno->strTelefono2;
            $data['fecFechaAltaCentro'] = $alumno->fecFechaAltaCentro;
            $data['numNivelEstudios'] = $alumno->numNivelEstudios;
            $data['numIdOrigen'] = $alumno->numIdOrigen;
            $data['numIdProvincia'] = $alumno->numIdProvincia;
            $data['numIdPais'] = $alumno->numIdPais;
            $data['blnMatriculado'] = $alumno->blnMatriculado;
            $data['strRutaNotas'] = $alumno->strRutaNotas;
            $data['numTipoNif'] = $alumno->numTipoNif;
            $data['strTelefonoMovil'] = $alumno->strTelefonoMovil;
            $data['strPaisNacimiento'] = $alumno->strPaisNacimiento;
            $data['numIdPaisNacimiento'] = $alumno->numIdPaisNacimiento;
            $data['strProvinciaNacimiento'] = $alumno->strProvinciaNacimiento;
            $data['numIdProvinciaNacimiento'] = $alumno->numIdProvinciaNacimiento;

            $exists = Alumnos::firstOrCreate([
                'numIdAlumno' => $alumno->numIdAlumno
            ], $data);
   
        }


    }

    public function deleteFicheroImportarAlumno(Request $request){
       $archivo =  $request->filename;
       
        //verificamos si el archivo existe y lo retornamos
        if (Storage::exists($archivo))
        {
            Storage::delete($archivo);
            return response()->json(array('success' => true, 'message' => '<i class="far fa-thumbs-up"></i> El fichero fue borrado correctamente.', 'data' => '', ''));
        }

        return response()->json(array('success' => false, 'message' => '<i class="far fa-sad-tear"></i> Hubo un problema intentando borrar el fichero.', 'data' => '', ''));
    }

    
    public function gestionarEstudiantes()
    {
        $trabajos = Trabajos::get();
        $habitaciones = Habitaciones::get();
        $data = [
            'trabajos' => $trabajos,
            'habitaciones' => $habitaciones
        ];
        return view('alumnos.gestion',$data);
    }

    
    /**
     *      Lista de estudiantes.
     */
    public function listarEstudiantes(Request $request)
    {
        $alumnos = Alumnos::
        select('alumnos.numIdAlumno','alumnos.strNombre','alumnos.strApellidos','alumnos.strTelefono1','alumnos.strEMail','alumnos.strCodigoExpediente','alumnos.blnVigente','alumnos.uuid_habitacion')
        ->Status($request->filtro)
        ->get();

        return Datatables::of($alumnos)
            ->setRowId('numIdAlumno')
            ->addIndexColumn()
            ->addColumn('detalle', function ($row) {
                return $this->detalleAlumno($row);
            })
            ->addColumn('action', function ($row) {
                $btn =  '<div class="icono-action">
                                    <a href="" data-accion="imputar-trabajo" data-id-alumno="' . $row->numIdAlumno . '" >
                                        <i data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Imputar trabajo a <strong>' . $row->strNombre . '</strong>." class="icono-action text-primary fas fa-tools">
                                        </i>
                                    </a>
                                    <a href="" data-accion="asignar-habitacion" data-uuid-habitacion="'.$row->uuid_habitacion.'" data-id-alumno="'. $row->numIdAlumno .'" data-nombre="'. $row->strNombre .'">
                                        <i data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="Residencia del alumno (<strong>' . $row->strNombre . '</strong>)." class="text-info fas fa-hotel"></i>
                                    </a>
                                </div>';
                return $btn;
            })
            ->rawColumns(['detalle', 'action'])
            ->make(true);

    }

    public function detalleAlumno($row){
        $data = Alumnos::find($row->numIdAlumno);
        $habitacion = Hospedajes::where('uuid',$data->uuid_habitacion)->first();
        $fec_nac = $data->fecFechaNacimiento == "" ? '' : Carbon::parse($data->fecFechaNacimiento);
        $fec_alta = $data->fecFechaAlta == "" ? '' : Carbon::parse($data->fecFechaAlta);
        $fec_entrada =  $habitacion['desde'] == '' ? '' : Carbon::parse($habitacion['desde'])->format('d-m-Y');
        $fec_salida =  $habitacion['hasta'] == '' ? '' : Carbon::parse($habitacion['hasta'])->format('d-m-Y');
        $residencia = 'No tiene hospedaje en la universidad';
        if ($habitacion['num_habitacion'] != ''){
            $residencia = '<h6>Habitación asignada: <strong><span class="badge badge-pill badge-success">'.$habitacion['num_habitacion'].'</span></strong></h6>
            <h6 class="card-subtitle mb-2 text-muted">Fecha de entrada: <strong>'.$fec_entrada.'</strong></h6>
            <h6 class="card-subtitle mb-2 text-muted">Fecha de salida: <strong>'.$fec_salida.'</strong></h6>';
        }

        $foto = $data->strSexo == 'H' ? '<img src="img/man.png" class="img-responsive">' : '<img src="img/woman.png" class="img-responsive">';
        $sexo = $data->strSexo == 'H' ? '<i class="fas fa-male"></i> Hombre' : '<i class="fas fa-female"></i> Mujer';
        $salida = '<div class="card" style="width: 54rem;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h5 class="card-title">'.trim($data->strNombre).' '.trim($data->strApellidos).'</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Sexo: '.$sexo.'</h6>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="text-info far fa-id-card"></i> Nif: '.$data->strNif.'</h6>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="text-success far fa-envelope"></i> '.$data->strEMail.'</h6>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="text-primary far fa-calendar-alt"></i> Nac. '.$fec_nac->format('d-m-Y').' <i class="text-warning fas fa-birthday-cake"></i> '.$fec_nac->age.'</h6>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="text-success fas fa-phone"></i> '.$data->strTelefono1.'  <i class="text-warning fas fa-phone"></i> '.$data->strTelefono2.'</h6>
                                    <hr>
                                    <h6 class="card-subtitle mb-2 text-muted">Código de expediente: <strong>'.$data->strCodigoExpediente.'</strong></h6>
                                    <h6 class="card-subtitle mb-2 text-muted">Fecha de alta: <strong>'.$fec_alta->format('d-m-Y').'</strong></h6>
                                    <hr>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-hotel"></i> <strong>Residencia en la facultad</strong>: </h6>
                                    '.$residencia.'
                                    <hr>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-map-marker-alt"></i> <strong>Dirección</strong>: </h6>
                                    <h6 class="card-text">'.$data->strDomicilio.'</h6>
                                    <h6 class="card-text">'.$data->strPais.', '.$data->strProvincia.', '.$data->strPoblacion.'</h6>                                    
                                </div>
                                <div class="col-sm4">
                                    <div class="card float-right">
                                        <div class="card-body">
                                            <center>
                                            '.$foto.'
                                            <br><a href="">Click para cambiar</a>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <a href="#" class="card-link btn btn-xs btn-outline-success">Ir al expediente académico</a>
                            <button data-uuid="'.$data->uuid_grupo_familiar.'" class="btn btn-xs btn-outline-primary ver-grupo-familiar">Ver grupo familiar</button>
                            <button data-id-alumno="'.$data->numIdAlumno.'" class="imputar btn btn-xs btn-outline-info">Imputar trabajo realizado</button>
                        </div>
                    </div>';
        return $salida;
    }

    public function verGrupoFamiliarAlumno(Request $request){
        $grupo = GruposFamiliares::where('uuid',$request->uuid)->first();
        $vista = app(GruposFamiliaresController::class)->drawGroupFamily($grupo,12);
        return response()->json(array('success' => true, 'message' => 'Grupo familiar obtenido correctamente', 'data' => $vista, ''));
    }

    public function listarTrabajosRealizados(Request $request){
        $trabajos = Trabajos_realizados::select('trabajo','fecha','observaciones','trabajos_realizados.id as id')->join('trabajos', 'trabajos.id', 'trabajos_realizados.id_trabajo')
        ->where('id_alumno',$request->idAlumno)
        ->get();

        return Datatables::of($trabajos)
        ->setRowId('id')
        ->addIndexColumn()                  
        ->addColumn('action', function ($row) {
            $btn =  '<div class="icono-action">
                                <a href="" data-accion="eliminar-trabajo" data-id-trabajo-imputado="'.$row->id.'">
                                    <i data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" data-content="" class="icono-action text-danger far fa-trash-alt">
                                    </i>
                                </a>                                
                            </div>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function guardarTrabajoImputado(Request $request){
        $imputar = Trabajos_realizados::create(
                                                    [
                                                        'id_trabajo' => $request->trabajo_id,
                                                        'fecha' => $request->fecha_trabajo,
                                                        'id_alumno' => $request->id_alumno_trabajo, 
                                                        'observaciones' => $request->observaciones_trabajo
                                                    ]
                                                );       
        if($imputar->wasRecentlyCreated){
            return response()->json(array('success' => true, 'message' => 'Trabajo imputado correctamente.', 'data' =>  ''));
        }
        return response()->json(array('success' => false, 'message' => 'El Trabajo no pudo ser imputado.', 'data' =>  ''));
    }

    public function eliminarTrabajo(Request $request){
        $deletedRows = Trabajos_realizados::where('id',$request->idTrabajo)->delete();
        return response()->json(array('success' => true, 'message' => 'El Trabajo fue eliminado correctamente.', 'data' => '' , ''));
    }

    public function verHospedajeAlumno(Request $request){
        $hospedaje = Hospedajes::where('uuid',$request->uuid)->first();
        if ($hospedaje !== null){            
            return response()->json(array('success' => true, 'message' => 'El Alumno tiene hospedaje asignado.', 'data' => $hospedaje , ''));
        }
        return response()->json(array('success' => false, 'message' => 'El Alumno no tiene hospedaje asignado.', 'data' => '' , ''));
    }

    public function actualizarHospedaje(Request $request){

        if ( is_null($request->uuid_habitacion) ){     
            $hospedaje  = new Hospedajes();
            $uuid = Uuid::generate();
            $hospedaje->uuid = $uuid;
            $sw = true;
        }else{
            $hospedaje  = Hospedajes::where('uuid',$request->uuid_habitacion)->first(); 
            $sw = false;        
        }

		$hospedaje->num_habitacion  = $request->numero_habitacion;
        $hospedaje->desde           = $request->fecha_entrada;
        $hospedaje->hasta           = $request->fecha_salida;
        $hospedaje->observaciones   = $request->observaciones_entrega_hab;
        $hospedaje->save();

        if ($sw){
            $alumno = Alumnos::find($request->id_habitacion_alumno);
            $alumno->uuid_habitacion = $uuid;
            $alumno->save();
            return response()->json(array('success' => true, 'message' => 'La habitación fue asignada correctamente.', 'data' =>  ''));
        }

        return response()->json(array('success' => true, 'message' => 'La habitación del alumno se actualizo correctamente.', 'data' =>  ''));
    }

}
