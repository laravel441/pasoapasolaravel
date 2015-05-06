<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwParametrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sw_parametros', function(Blueprint $table)
		{
            $table->increments('par_id');
            $table->string('par_nombre');
            $table->string('par_descripcion');
            $table->string('par_valor');
            $table->string('par_valor2');
            $table->timestamp('par_creado_en',30);
            $table->string('par_creado_por');
            $table->timestamp('par_modificado_en',30);
            $table->string('par_modificado_por');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sw_parametros');
	}

}
