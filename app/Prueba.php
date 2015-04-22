<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model {

	//protected $table = 'pruebas';
	protected $table = 'users';

	protected $fillable = array ('first_name', 'last_name', 'email', 'password','type');

}
