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
			$table->uuid('assign_solicitude_id');
			$table->text('observation');
			$table->timestamps();

			$table->foreign('assign_solicitude_id')->references('id')->on('assign_solicitudes');
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
