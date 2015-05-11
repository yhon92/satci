<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('area_requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('theme_request_id')->unsigned();
			$table->integer('area_id')->unsigned();
			$table->timestamps();

			$table->foreign('theme_request_id')->references('id')->on('theme_requests');
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
		Schema::drop('area_requests');
	}

}
