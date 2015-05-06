<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwEstadoUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sw_estado_usuarios', function(Blueprint $table)
		{
            $table->increments('stu_id');
            $table->integer('stu_estado');
            $table->string('stu_descripcion');
            $table->timestamp('stu_creado_en');
            $table->string('stu_creado_por',30);
            $table->timestamp('stu_modificado_en');
            $table->string('stu_modificado_por',30);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sw_estado_usuarios');
	}

}
