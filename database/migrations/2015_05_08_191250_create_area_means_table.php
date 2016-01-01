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
      
      $table->integer('area_id')->unsigned()->index();
      $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');

      $table->integer('means_id')->unsigned()->index();
      $table->foreign('means_id')->references('id')->on('means');

      // $table->timestamps();


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
