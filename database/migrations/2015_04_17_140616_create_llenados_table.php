<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLlenadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('llenados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cilindro_id')->unsigned();
			$table->integer('tercero_id')->unsigned();
			$table->enum('estado',['llenado','lleno']);
			$table->string('notas',1000)->nullable;
   			$table->timestamps();

   			$table->foreign('tercero_id')
   				  ->references('id')->on('terceros')
   				  ->onUpdate('CASCADE')
   				  ->onDelete('CASCADE');
   				  
   			$table->foreign('cilindro_id')
   				  ->references('id')->on('cilindros')
   				  ->onUpdate('CASCADE')
   				  ->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('llenados');
	}

}
