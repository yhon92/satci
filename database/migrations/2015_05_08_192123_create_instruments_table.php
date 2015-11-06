<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstrumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instruments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('date');
			$table->integer('theme_area_solicitude_id')->unsigned();
			$table->text('observation');
			$table->enum('status', ['Recibido', 'Aprobador', 'Rechazado', 'Atendido'])->default('Recibido');
			$table->timestamps();

			$table->foreign('theme_area_solicitude_id')->references('id')->on('theme_area_solicitudes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('instruments');
	}

}
