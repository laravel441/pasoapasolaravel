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





Route::controllers([
	'users' => 'UsersController',
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',

	

]);
	resource('terceros','TerceroController');
Route::group(['prefix'=>'admin','middleware'=>'auth','namespace'=>'Admin'], function()//ejecuta los middleware en orden
{
	Route::resource('users','UsersController');
    Route::resource('emps','EmpleadoController');
});

