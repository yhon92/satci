<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('responses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('instrument_id')->unsigned();
			$table->string('number_job');
			$table->text('observation');
			$table->timestamps();

			$table->foreign('instrument_id')->references('id')->on('instruments');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('responses');
	}

}
