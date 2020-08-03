<?php

use Illuminate\Support\Facades\Route;

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


	/**	Usuarios */
	Route::group(['middleware' => ['permission:mantenimiento_usuarios']], function () {
		Route::get('gestion-usuarios', 'MantenimientoUsuariosController@gestionUsuarios')->name('gestion-usuarios.gestionUsuarios');
	});
	Route::get('/listar-usuarios', 'MantenimientoUsuariosController@listarUsuarios');
	Route::get('/editar-usuario', 'MantenimientoUsuariosController@editarUsuario');
	Route::get('/bloquear-usuario', 'MantenimientoUsuariosController@bloquearUsuario');


	/** Clientes */
	//Route::get('/gestion-clientes', 'MantenimientoUsuariosController@bloquearUsuario');
	Route::group(['middleware' => ['permission:gestionar_clientes']], function () {
		Route::get('gestion-clientes', 'MantenimientoClientesController@gestionClientes')->name('gestion-clientes.gestionClientes');
	});
	Route::get('/listar-clientes', 'MantenimientoClientesController@listarClientes');
	Route::get('/editar-cliente', 'MantenimientoClientesController@editarCliente');
	Route::get('/calcular-edad', 'MantenimientoClientesController@calcularEdad');
	Route::post('/actualizar-cliente', 'MantenimientoClientesController@actualizarCliente');
	Route::get('generar-excel-clientes', 'MantenimientoClientesController@generarExcelClientes');
	Route::get('buscar-curp', 'MantenimientoClientesController@buscarCurp');


	/** Información de la Empresa */
	Route::group(['middleware' => ['permission:mantenimiento_empresa']], function () {
		Route::get('informacion-empresa', 'MantenimientoEmpresaController@informacionEmpresa')->name('informacion-empresa.informacionEmpresa');
	});
	Route::get('buscar-empresa', 'MantenimientoEmpresaController@buscarempresa');
	Route::post('actualizar-empresa', 'MantenimientoEmpresaController@actualizarEmpresa');
	Route::post('subir-logo', 'MantenimientoEmpresaController@subirLogo');
	Route::post('delete-logo', 'MantenimientoEmpresaController@deleteLogo');

	/** Gestión de roles */
	Route::group(['middleware' => ['permission:gestion_roles']], function () {
		Route::get('gestion-roles', 'MantenimientoRolesController@gestionRoles')->name('gestion-roles.gestionRoles');
	});
	Route::get('change-role', 'MantenimientoRolesController@changeRole');
	Route::get('revocar-permiso', 'MantenimientoRolesController@revocarPermiso');
	Route::get('dar-permiso-a', 'MantenimientoRolesController@darPermisoA');
	Route::post('nuevo-role', 'MantenimientoRolesController@nuevoRole');


	/** Pensiones */
	Route::group(['middleware' => ['permission:gestionar_pension']], function () {
		Route::get('gestionar-pension', 'GestionarPensionesController@gestionarPension')->name('gestionar-pension.gestionarPension');
	});
	Route::get('listar-pensiones', 'GestionarPensionesController@listarPensiones');
	Route::get('buscar-cliente', 'GestionarPensionesController@buscarCliente');
	Route::get('calcular-edad-completa', 'GestionarPensionesController@calcularEdadCompleta');
	Route::get('calcular-anos-faltante', 'GestionarPensionesController@calcularAnosFaltante');
	Route::get('generar-planes/{idPension}/{idCliente}', 'GestionarPensionesController@generarPlanes');
	Route::get('calcular-dias-entre-fechas', 'GestionarPensionesController@calcularDiasEntreFechas');
	Route::post('subir-excel-cotizaciones', 'GestionarPensionesController@subirExcelCotizaciones');
	Route::get('buscar-cuantia-basica', 'GestionarPensionesController@buscarCuantiaBasica');
	Route::get('calcular-tiempo-individual-faltante-retiro', 'GestionarPensionesController@calcularTiempoIndividualFaltanteRetiro');
	Route::get('sumar-dias-a-fecha-estrategias', 'GestionarPensionesController@sumarDiasaFechaEstrategias');
	Route::get('edad-cliente', 'GestionarPensionesController@edadCliente');
	Route::post('guardar-plan-pension', 'GestionarPensionesController@guardarPlanPension');
	Route::get('/buscar-expectativas', 'GestionarPensionesController@buscarExpectativas');
	Route::get('/buscar-cotizaciones-hoja-1', 'GestionarPensionesController@buscarCotizacionesHoja1');
	Route::get('/buscar-cotizaciones-hoja', 'GestionarPensionesController@buscarCotizacionesHoja');
	Route::get('/buscar-data-adicional', 'GestionarPensionesController@buscarDataAdicional');
	Route::get('/buscar-estrategias-save-on-bd', 'GestionarPensionesController@buscarEstrategiasSaveOnBd');



	/**Generar Pdfs */
	Route::get('generar-pdf-resumen/{uuid}/{idCliente}', 'PdfsController@generarPdfResumen');
	Route::get('/ver-pdf-resumen', 'PdfsController@verPdfResumen');
	Route::get('/send-mail-resumen', 'PdfsController@sendMailResumen');
	Route::get('/data-toma-decisiones', 'PdfsController@dataTomaDecisiones');
	Route::get('/restar-fechas', 'PdfsController@restarFechas');
	Route::get('/ver-pdf-detalle', 'PdfsController@verPdfDetalle');
	Route::get('generar-pdf-detalle/{uuid}/{idCliente}', 'PdfsController@generarPdfDetalle');
	Route::get('/send-mail-detalle', 'PdfsController@sendMailDetalle');
	Route::get('/change-view-nivel-vida', 'PdfsController@changeViewNivelVida');

	/** Inicio tablero */
	Route::get('/buscar-data-tablero', 'PerfilController@buscarDataTablero');
});
