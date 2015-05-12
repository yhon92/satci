<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaSolicitudesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('area_solicitudes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('theme_solicitude_id')->unsigned();
			$table->integer('area_id')->unsigned();
			$table->timestamps();

			$table->foreign('theme_solicitude_id')->references('id')->on('theme_solicitudes');
			$table->foreign('area_id')->references('id')->on('areas');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('area_solicitudes');
	}

}
