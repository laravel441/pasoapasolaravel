<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {

	protected $table = 'user_profiles'; //si no le definimos la tabla, 
	                                     //laravel va tratar de adivinar con el name de la clase

	public function getAgeAttribute ()
	{
		return \Carbon\Carbon::parse($this->birthdate)->age;
	}

}
