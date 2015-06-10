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

/*Route::get('formulario', 'StorageController@index');
Route::post('storage/create', 'StorageController@save');

/*Route::get('storage/{archivo}', function ($archivo) {
    $public_path = public_path();
    $url = $public_path.'/storage/'.$archivo;
    //verificamos si el archivo existe y lo retornamos
    if (Storage::exists($archivo))
    {
        return response()->download($url);
    }
    //si no se encuentra lanzamos un error 404.
    abort(404);

});*/








Route::controllers([
	'users' => 'UsersController',
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',


	

]);
	resource('terceros','TerceroController');
Route::group(['prefix'=>'admin','middleware'=>'auth','namespace'=>'Admin'], function()//ejecuta los middleware en orden
{
	Route::resource('users','UsersController');

});
resource('lavado','Admin\LavadoController');
resource('registro','Admin\RegistroController');
resource('reporte','Admin\ReporteController');


