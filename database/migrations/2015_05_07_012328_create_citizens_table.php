<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('citizens', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('identification')->unique();
			$table->string('full_name');
			$table->string('first_name');
			$table->string('last_name');
			$table->text('address');
			$table->string('prefix_phone', 4);
			$table->string('number_phone', 10);
			$table->integer('parish_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('parish_id')->references('id')->on('parishes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('citizens');
	}

}
