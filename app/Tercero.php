<?php namespace App;
use Illuminate\Database\Eloquent\Model;
class Tercero extends Model {
	protected $table = 'terceros';
	protected $fillable = array (
		'nit', 'nombre', 'rol', 'direccion', 'telefono', 'email', 'notas'
	      );
}