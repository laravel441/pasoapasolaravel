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



});

Route::group(['prefix'=>'facturacion','middleware'=>'auth','namespace'=>'Facturacion'], function()//ejecuta los middleware en orden LAVADO
{
    resource('sticker','Fac1Controller');
//    resource('control_radicacion','Fac2Controller');
//    resource('revision','Fac3Controller');
    resource('pruebas','FacpController');

});


