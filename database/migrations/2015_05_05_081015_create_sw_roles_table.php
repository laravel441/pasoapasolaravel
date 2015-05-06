<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sw_roles', function(Blueprint $table)
		{
            $table->increments('rol_id');
            $table->string('rol_nombre');
            $table->timestamp('rol_creado_en',30);
            $table->string('rol_creado_por');
            $table->timestamp('rol_modificado_en',30);
            $table->string('rol_modificado_por');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sw_roles');
	}

}
