<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwModulosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sw_modulos', function(Blueprint $table)
		{
            $table->increments('mod_id');
            $table->string('mod_nombre');
            $table->integer('mod_id_parent');
            $table->timestamp('mod_creado_en',30);
            $table->string('mod_creado_por');
            $table->timestamp('mod_modificado_en',30);
            $table->string('mod_modificado_por');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sw_modulos');
	}

}
