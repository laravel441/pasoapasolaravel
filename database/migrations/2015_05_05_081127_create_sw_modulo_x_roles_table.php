<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwModuloXRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sw_modulo_x_roles', function(Blueprint $table)
		{
            $table->increments('mxr_id');
            $table->integer('mxr_mod_id');
            $table->integer('mxr_rol_id');
            $table->boolean('mxr_flag_crear');
            $table->boolean('mxr_flag_consultar');
            $table->boolean('mxr_flag_modificar');
            $table->boolean('mxr_flag_eliminar');
            $table->timestamp('mxr_creado_en',30);
            $table->string('mxr_creado_por');
            $table->timestamp('mxr_modificado_en',30);
            $table->string('mxr_modificado_por');;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sw_modulo_x_roles');
	}

}
