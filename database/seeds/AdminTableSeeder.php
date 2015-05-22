<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdminTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        \DB::table('sw_usuarios')->insert(array(
        'usr_emp_an8'=>'1069720',
        'usr_stu_id'=>'1',
        'usr_name'=>'william.beltran',
        'password'=>\Hash::make('urico'),
        'usr_caducidad'=>'30',
        'usr_flag_pass'=>'True',
        'usr_creado_en' => new DateTime,
        'usr_creado_por' => 'Swcapital',
        'usr_modificado_en' => new DateTime,
        'usr_modificado_por' => 'Swcapital',
        'remember_token'=> 'adpamdpmapdfaifmpfjipf64654654654846'
));
		\DB::table('users')->insert(array(
		'first_name'=>'Ricardo',
		'last_name' =>'Uricoechea',
        'user_name'=>'ricardo.uricoechea',

		'email'=>'ricardo.uricoechea@gmail.com',
		'password'=>\Hash::make('urico'),
		'type'=> 'admin',
        'remember_token'=> 'adpamdpmapdfaifmpfjipf64654654654846',
		'created_at' => new DateTime,
         'updated_at' => new DateTime,
		// $this->call('UserTableSeeder');
	));

		\DB::table('user_profiles')->insert(array(
			'user_id'=>1,
			'birthdate'=>'1990/07/12',
			'created_at' => new DateTime,   
      	   'updated_at' => new DateTime,



			));
}
}
