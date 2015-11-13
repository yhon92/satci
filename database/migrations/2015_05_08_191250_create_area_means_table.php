<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaMeansTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('area_means', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('area_id');
      $table->integer('means_id');

      // $table->timestamps();

      $table->foreign('area_id')->references('id')->on('areas');
      $table->foreign('means_id')->references('id')->on('means');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('area_means');
  }
}
