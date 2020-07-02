<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Empresa;
use \App\Estados;
use \DB;


class MantenimientoEmpresaController extends Controller
{
    public function informacionEmpresa()
    {
        $empresa = Empresa::find(1);
        $estados = Estados::get();
    	$data = array(
                        'empresa' => $empresa,
                        'estados' => $estados
    				);
        return view('empresa.informacion',$data);
    }

    public function buscarEmpresa()
    {
        $empresa = Empresa::get();
        $mi_imagen = public_path().'/'.$empresa[0]->logo;
       // dd($mi_imagen);
        if (!@getimagesize($mi_imagen)) {
            $empresa[0]->logo = 'sinlogo.png';
        }
        return response()->json( array('success' => true, 'mensaje'=> 'Datos de la empresa obtenido exitosamente','data' => $empresa) );
    }

    public function actualizarEmpresa(Request $request)
    {

        try {
            DB::beginTransaction();    
            
            $save = Empresa::Guardar($request);
            DB::commit();
            $mensaje="Empresa guardada con exito.";
            if(!$save){
            	$mensaje="Hubo error intentando guardar el Perfil.";
                //App::abort(500, 'Error');
            }

            return response()->json( array('success' => true, 'mensaje'=> $mensaje) );

        } catch (Exception $e) {
            DB::rollback();
            return $this->internalException($e, __FUNCTION__);
        }
    }

    public function subirLogo(Request $request)
    {
        $ruta     = '/img/';
        $path     = public_path().$ruta;
        $files    = $request->file('file');
        $ext      = explode('/',$request->file('file')->getMimeType());
        $fileName = $files->getClientOriginalName();
		$extension = $request->file('file')->extension();
		if ($extension == 'bin'){
			$extension = $files->getClientOriginalExtension();
		}
        $files->move($path, $fileName);
        //$myFile = date('mdYHis') . uniqid() . $request->fileName;
        rename($path.$fileName, $path.'logo.'.$extension);
        
        DB::beginTransaction();   

        $empresa = Empresa::find(1);
        $empresa->logo = 'img/logo.'.$extension;
        $empresa->save();

        DB::commit();
        //Storage::move($path.$fileName, $path.'usuario-'.$request->idSucursal);
        return 'img/logo.'.$extension;
        
    }

    public function deleteLogo(Request $request){
        //dd($request);
        unlink('img/logo.png');
    }

}
