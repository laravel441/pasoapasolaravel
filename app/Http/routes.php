<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');
Route::get('admin/users/cambio', 'HomeController@guardar');
Route::post('admin/users/cambio', 'HomeController@cambiar');
Route::get('auth/recuperar', 'ResetController@recuperar');
Route::post('auth/recuperar', 'ResetController@recuperarpassword');
Route::get('auth/home', 'ResetController@home');



Route::controllers([
	'users' => 'UsersController',
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',


	

]);

Route::group(['middleware' => 'auth'], function()
{
    Route::resource('/admin/roles', 'RRolesController');
    Route::get('admin/roles/rol/destroy/{id}', ['as' => 'rol.destroy', 'uses' => 'RRolesController@destroy']);
    Route::post('admin/roles/rol/modulos/{id}', ['as' => 'rol.modulos', 'uses' => 'RRolesController@modulos']);
    Route::get('admin/roles/rol/permisos/{id}/{idm}', ['as' => 'rol.permisos', 'uses' => 'RRolesController@permisos']);
    Route::post('admin/roles/rol/permisos/{id?}/{idm?}', ['as' => 'rol.permisos', 'uses' => 'RRolesController@permisoscambiar']);
    Route::get('admin/roles/rol/detalles/{id}', ['as' => 'rol.detalles', 'uses' => 'RRolesController@show']);
    Route::get('admin/roles/verpermisos/{id}', ['as' => 'rol.verpermisos', 'uses' => 'RRolesController@verpermisos']);
    Route::get('admin/roles/rol/borrar/{id}', ['as' => 'rol.borrar', 'uses' => 'RRolesController@borrar']);
});
	resource('terceros','TerceroController');
Route::group(['prefix'=>'admin','middleware'=>'auth','namespace'=>'Admin'], function()//ejecuta los middleware en orden ADMIN
{
	Route::resource('users','UsersController');

});

Route::group(['prefix'=>'/','middleware'=>'auth','namespace'=>'Lavado'], function()//ejecuta los middleware en orden LAVADO
{
    resource('lavado','LavadoController');
    resource('registro','RegistroController');
    resource('reporte','ReporteController');
    resource('adjunto','AdjuntoController');
    resource('lav/admin','Lav1Controller');
    Route::get('lav/admin/excel/{id}', ['as' => 'lav.admin.excel', 'uses' => 'Lav1Controller@exceles']);

});

Route::group(['prefix'=>'facturacion','middleware'=>'auth','namespace'=>'Facturacion'], function()//ejecuta los middleware en orden LAVADO
{
    resource('sticker','Fac1Controller');
    resource('radicacion','Fac2Controller');
    resource('hfacturas','Fac3Controller');
//    resource('control_radicacion','Fac2Controller');
//    resource('revision','Fac3Controller');
    resource('pruebas','FacpController');

});
Route::group(['prefix'=>'contabilidad','middleware'=>'auth','namespace'=>'Contabilidad'], function()//ejecuta los middleware en orden LAVADO
{
    resource('revision','Con1Controller');
    resource('generadordoc','Con2Controller');
//    resource('control_radicacion','Fac2Controller');
//    resource('revision','Fac3Controller');
    resource('pruebas','ConpController');

});

Route::group(['prefix'=>'tesoreria','middleware'=>'auth','namespace'=>'Tesoreria'], function()//ejecuta los middleware en orden LAVADO
{
    resource('revision','Tes1Controller');
//    resource('control_radicacion','Fac2Controller');
//    resource('revision','Fac3Controller');
    resource('pruebas','TespController');

});

Route::group(['prefix'=>'/','middleware'=>'auth','namespace'=>'Remuneracion'], function()//ejecuta los middleware en orden REMUNERACIONES
{
    Route::get('remuneracion/km/index', ['as' => 'carguekm', 'uses' => 'CargueKmsController@index']);
    Route::post('remuneracion/km/index', ['as' => 'carguekm.rem', 'uses' => 'CargueKmsController@storerem']);
    Route::put('remuneracion/km/index', ['as' => 'carguekm.carguerem', 'uses' => 'CargueKmsController@updateRem']);
    Route::get('remuneracion/km/formato/kms', ['as' => 'carguekm.desc', 'uses' => 'CargueKmsController@descForKilometros']);
    Route::get('remuneracion/km/formato/rem', ['as' => 'carguekm.descrem', 'uses' => 'CargueKmsController@descForRemuneracion']);
    resource('carguekm','CargueKmsController');
    //resource('remreportes','BusquedaReportesController');
});

Route::group(['prefix'=>'/','middleware'=>'auth','namespace'=>'Remuneracion'], function()
{
    Route::put('remuneracion/reportes/index', ['as' => 'remreportes.generar', 'uses' => 'BusquedaReportesController@generarReporte']);
    resource('remreportes','BusquedaReportesController');
});






