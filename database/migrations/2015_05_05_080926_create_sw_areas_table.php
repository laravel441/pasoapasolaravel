<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sw_areas', function(Blueprint $table)
		{
            $table->increments('area_id');
            $table->string('area_nombre');
            $table->string('area_acronimo',30);
            $table->timestamp('area_creado_en');
            $table->string('area_creado_por',30);
            $table->timestamp('area_modificado_en');
            $table->string('area_modificado_por',30);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sw_areas');
	}

}
