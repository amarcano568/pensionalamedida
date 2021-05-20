<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Carbon\Carbon;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {

	Route::get('/', function () {
		return view('home');
	});
	Route::get('/home', function () {
		return view('home');
	});
	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

	/** Perfil de Usuario */
	Route::get('ver-perfil', 'PerfilController@verPerfil');
	Route::get('buscar-perfil', 'PerfilController@buscarPerfil');
	Route::post('actualizar-perfil', 'PerfilController@actualizarPerfil');
	Route::get('cambiar-contrasena', 'PerfilController@cambiarContrasena');
	Route::post('actualiza-password', 'PerfilController@actualizaPassword');

	/**	Importar nuevos alumnos */
	Route::post('subir-fichero-nuevos-alumnos', 'AlumnosController@subirFicheroNuevosAlumnos');
	Route::post('delete-fichero-importar-alumno', 'AlumnosController@deleteFicheroImportarAlumno');

	
	/**	Alumnos */	
	Route::group(['middleware' => ['permission:gestion_alumnos']], function () {
		Route::get('gestionar-estudiantes', 'AlumnosController@gestionarEstudiantes')->name('gestion-estudiantes.gestionarEstudiantes');
	});
	Route::post('/listar-estudiantes', 'AlumnosController@listarEstudiantes');
	Route::post('/ver-grupo-familiar-alumno', 'AlumnosController@verGrupoFamiliarAlumno');
	Route::post('/listar-trabajos-realizados', 'AlumnosController@listarTrabajosRealizados');
	//Route::post('guardar-trabajo-imputado', 'AlumnosController@imputarTrabajo');
	Route::post('/eliminar-trabajo', 'AlumnosController@eliminarTrabajo');
	Route::post('/guardar-trabajo-imputado', 'AlumnosController@guardarTrabajoImputado');
	Route::post('/ver-hospedaje-alumno', 'AlumnosController@verHospedajeAlumno');
	Route::post('/actualizar-hospedaje', 'AlumnosController@actualizarHospedaje');

	/**	Grupos familiares */
	Route::group(['middleware' => ['permission:gestion_grupos_familiares']], function () {
		Route::get('gestionar-grupos-familiares', 'GruposFamiliaresController@gestionarGrupoFamiliar')->name('gestion-grupos-familiares.gestionarGrupoFamiliar');
	});
	Route::post('/listar-grupos-familiares', 'GruposFamiliaresController@listarGruposFamiliares');
	Route::post('/eliminar-grupo-familiar', 'GruposFamiliaresController@eliminarGrupoFamiliar');
	Route::post('/editar-grupo-familiar', 'GruposFamiliaresController@editarGrupoFamiliar');
	Route::post('/eliminar-hijo', 'GruposFamiliaresController@eliminarHijo');
	Route::post('/actualizar-hijo', 'GruposFamiliaresController@actualizarHijo');
	Route::post('/guardar-grupo-familiar', 'GruposFamiliaresController@guardarGrupoFamiliar');

	/**	Residencia */
	Route::group(['middleware' => ['permission:gestion_residencia']], function () {
		Route::get('gestion-residencia', 'ResidenciaController@gestionResidencia')->name('gestion-residencia.gestionResidencia');
	});
	Route::post('/listar-habitaciones', 'ResidenciaController@listarHabitaciones');
	Route::post('/editar-habitacion', 'ResidenciaController@getDataHabitacion');
	Route::post('/actualizar-habitaciones', 'ResidenciaController@actualizarHabitaciones');
	Route::post('/eliminar-habitacion', 'ResidenciaController@eliminarHabitacion');
	Route::post('/listar-huespedes', 'ResidenciaController@listarHuespedes');
	Route::post('/listar-mobiliarios', 'ResidenciaController@listarMobiliarios');
	Route::post('/editar-mobiliario', 'ResidenciaController@editarMobiliario');
	Route::post('/actualizar-mobiliarios', 'ResidenciaController@actualizarMobiliarios');
	Route::post('eliminar-mobiliario', 'ResidenciaController@eliminarMobiliario');
		
	/**	Usuarios */
	// Route::group(['middleware' => ['permission:mantenimiento_usuarios']], function () {
	// 	Route::get('gestion-usuarios', 'MantenimientoUsuariosController@gestionUsuarios')->name('gestion-usuarios.gestionUsuarios');
	// });
	// Route::get('/listar-usuarios', 'MantenimientoUsuariosController@listarUsuarios');
	// Route::get('/editar-usuario', 'MantenimientoUsuariosController@editarUsuario');
	// Route::get('/bloquear-usuario', 'MantenimientoUsuariosController@bloquearUsuario');
	
	/** Información de la Empresa */
	// Route::group(['middleware' => ['permission:mantenimiento_empresa']], function () {
	// 	Route::get('informacion-empresa', 'MantenimientoEmpresaController@informacionEmpresa')->name('informacion-empresa.informacionEmpresa');
	// });
	// Route::get('buscar-empresa', 'MantenimientoEmpresaController@buscarempresa');
	// Route::post('actualizar-empresa', 'MantenimientoEmpresaController@actualizarEmpresa');
	// Route::post('subir-logo', 'MantenimientoEmpresaController@subirLogo');
	// Route::post('delete-logo', 'MantenimientoEmpresaController@deleteLogo');

	/** Gestión de roles */
	Route::group(['middleware' => ['permission:gestion_roles']], function () {
		Route::get('gestion-roles', 'MantenimientoRolesController@gestionRoles')->name('gestion-roles.gestionRoles');
	});
	Route::get('change-role', 'MantenimientoRolesController@changeRole');
	Route::get('revocar-permiso', 'MantenimientoRolesController@revocarPermiso');
	Route::get('dar-permiso-a', 'MantenimientoRolesController@darPermisoA');
	Route::post('nuevo-role', 'MantenimientoRolesController@nuevoRole');
	

});
