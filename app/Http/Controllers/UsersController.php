<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {

	public function getOrm ()
	{
		
		$users = User::select('id','first_name')
		->with('profile')
		->where('first_name','<>', 'Ricardo')
		->orderBy('first_name','ASC')
		->get();
		//$users = User::get();
		//$user = User::first();//traigo un objeto de la clase User
		//dd($result->full_name);
		//dd($result->getFullNameAttribute());
		//dd($user->profile);
		//dd($user->profile->age);
		dd($users->toArray());

	}

public function getIndex()
{
	$result = \DB::table('users')
		->select(
			'users.*',
			'user_profiles.id as profile_id',
			'user_profiles.twitter',
			'user_profiles.birthdate'
			)
		->where('first_name','<>','Ricardo')
		->orderBy('first_name','ASC')
		//->orderBy(\DB::raw('RAND()')) //Funciones de SQL
		->join('user_profiles','users.id','=','user_profiles.user_id')
		//->leftJoin('user_profiles','users.id','=','user_profiles.user_id')
		//->first();
		->get();

		//foreach ($result as $row)
		//{
			//$row->full_name = $row->first_name . ' ' . $row->last_name;
			//$row->age = \Carbon\Carbon::parse($row->birthdate)->age;//sacar la edad
		//}

		//$result->full_name = $result->first_name . ' ' . $result->last_name;

		//dd ($result->full_name);
		dd ($result);
		return $result;

}


}