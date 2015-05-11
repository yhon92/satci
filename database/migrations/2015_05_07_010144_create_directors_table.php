<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('directors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('identification')->unique();
			$table->string('full_name');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('prefix_phone', 4);
			$table->string('number_phone', 10);
			$table->string('email')->unique();
			$table->string('resolution');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('directors');
	}

}
