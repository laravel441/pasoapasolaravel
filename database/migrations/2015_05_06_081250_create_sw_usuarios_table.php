<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sw_usuarios', function(Blueprint $table)
		{
            $table->increments('usr_id');
            $table->integer('usr_emp_id');
            $table->integer('usr_stu_id');
            $table->string('usr_name')->unique();
            $table->string('usr_contrasena',60);
            $table->integer('usr_caducidad');
            $table->boolean('usr_flag_pass');
            $table->timestamp('usr_creado_en');
            $table->string('usr_creado_por',30);
            $table->timestamp('usr_modificado_en');
            $table->string('usr_modificado_por',30);
            $table->rememberToken();

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sw_usuarios');
	}

}
