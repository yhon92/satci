<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemeRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('theme_requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('request_id')->unsigned();
			$table->integer('theme_id')->unsigned();
			$table->timestamps();

			$table->foreign('request_id')->references('id')->on('requests');
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
		Schema::drop('theme_requests');
	}

}
