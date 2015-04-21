<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model {

	//protected $table = 'pruebas';
	protected $table = 'terceros';

	protected $fillable = array (
		'nit', 'nombre', 'rol', 'direccion', 'telefono', 'email', 'notas'
	      );

}
