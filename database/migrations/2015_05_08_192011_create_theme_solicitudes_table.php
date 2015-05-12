<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemeSolicitudesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('theme_solicitudes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('solicitude_id')->unsigned();
			$table->integer('theme_id')->unsigned();
			$table->timestamps();

			$table->foreign('solicitude_id')->references('id')->on('solicitudes');
			$table->foreign('theme_id')->references('id')->on('themes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('theme_solicitudes');
	}

}
