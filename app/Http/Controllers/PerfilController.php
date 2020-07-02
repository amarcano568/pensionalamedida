<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Paises;
use Illuminate\Support\Facades\Auth;
use \App\Usuario;
use \DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Hashing\BcryptHasher;

class PerfilController extends Controller
{
    public function verPerfil()
    {
        $paises = Paises::get();
    	$data = array(
    					'paises' => $paises,
    				);

        return view('perfiles.perfil',$data);
    }

    public function buscarPerfil()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();
        $user['rol'] =  $roles[0];
    	$data = array(
    					'user' => $user,
    				);

        return response()->json( array('success' => true, 'mensaje'=> 'Datos del perfil obtenido exitosamente','data' => $data) );
    }

    public function actualizarPerfil(Request $request)
    {

        try {
            DB::beginTransaction();    
            
            $save = Usuario::Guardar($request);
            DB::commit();
            $mensaje="Perfil guardado con exito.";
            if(!$save){
            	$mensaje="Hubo error intentando guardar el Perfil.";
                App::abort(500, 'Error');
            }

            return response()->json( array('success' => true, 'mensaje'=> $mensaje) );

        } catch (Exception $e) {
            DB::rollback();
            return $this->internalException($e, __FUNCTION__);
        }
    }

    public function cambiarContrasena()
    {

        return view('perfiles.change-password');
    }


    public function actualizaPassword(Request $request) {
        try {
            $valid = validator($request->only('contrasenaActual', 'newContrasena', 'repetirContrasena'), [
                'contrasenaActual' => 'required|string|min:8',
                'newContrasena' => 'required|string|min:8|different:contrasenaActual',
                'repetirContrasena' => 'required_with:newContrasena|same:newContrasena|string|min:8',
                    ], [
                'repetirContrasena.required_with' => 'Confirm password is required.'
            ]);

            if ($valid->fails()) {
                return response()->json([
                            'errors' => $valid->errors(),
                            'message' => 'Fallo al actualizar la contraseña.',
                            'status' => false
                                ], 200);
            }
//            Hash::check("param1", "param2")
//            param1 - user password that has been entered on the form
//            param2 - old password hash stored in database
            if (\Hash::check($request->contrasenaActual, Auth::user()->password)) {
                $user = Usuario::find(Auth::user()->id);
                $user->password =  Hash::make($request->newContrasena);
                if ($user->save()) {
                    return response()->json([
                                'data' => [],
                                'message' => '<i class="cil-happy 3x"></i><br>Tu contraseña fue actualizada.',
                                'status' => true
                                    ], 200);
                }
            } else {
                return response()->json([
                            'errors' => [],
                            'message' => '<i class="cil-frown 3x"></i><br> Contraseña ingresada es incorrecta.',
                            'status' => false
                                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                        'errors' => $e->getMessage(),
                        'message' => 'Please try again',
                        'status' => false
                            ], 200);
        }
    }

}
