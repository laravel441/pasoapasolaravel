<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwUsuarioXRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sw_usuario_x_roles', function(Blueprint $table)
		{
            $table->increments('uxr_id');
            $table->integer('uxr_usr_id');
            $table->integer('uxr_rol_id');
            $table->timestamp('mxr_creado_en',30);
            $table->string('mxr_creado_por');
            $table->timestamp('mxr_modificado_en',30);
            $table->string('mxr_modificado_por');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sw_usuario_x_roles');
	}

}
