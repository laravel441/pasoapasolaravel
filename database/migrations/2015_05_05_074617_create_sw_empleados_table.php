<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwEmpleadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sw_empleados', function(Blueprint $table)
		{

            $table->string('emp_an8',100)->unique();
            $table->integer('emp_area_id');
            $table->string('emp_cod_tm',100)->nullable();
            $table->string('emp_identificacion',100)->unique();
            $table->string('emp_nombre');
            $table->string('emp_nombre2')->nullable();
            $table->string('emp_apellido');
            $table->string('emp_apellido2')->nullable();
            $table->string('emp_direccion')->nullable();
            $table->string('emp_telefono',100)->nullable();
            $table->string('emp_celular',100)->nullable();
            $table->string('emp_correo')->unique();
            $table->date('emp_fecha_nacimiento')->nullable();
            $table->string('emp_unidad_negocio',100)->nullable();
            $table->date('emp_fecha_ingreso')->nullable();
            $table->date('emp_fecha_salida')->nullable();
            $table->timestamp('emp_creado_en');
            $table->string('emp_creado_por',30);
            $table->timestamp('emp_modificado_en');
            $table->string('emp_modificado_por',30);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sw_empleados');
	}

}
