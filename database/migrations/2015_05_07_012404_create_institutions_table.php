<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institutions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('identification')->unique();
			$table->string('full_name');
			$table->text('address');
			$table->string('prefix_phone', 4);
			$table->string('number_phone', 10);
			$table->string('agent_identification');
			$table->string('agent_full_name');
			$table->string('agent_first_name');
			$table->string('agent_last_name');
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
		Schema::drop('institutions');
	}

}
