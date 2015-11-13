<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemeAreaSolicitudesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('theme_area_solicitudes', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('solicitude_id')->unsigned();
      $table->integer('theme_id')->unsigned();
      $table->integer('area_means_id')->unsigned();

      $table->timestamps();

      $table->foreign('solicitude_id')->references('id')->on('solicitudes');
      $table->foreign('theme_id')->references('id')->on('themes');
      $table->foreign('area_means_id')->references('id')->on('area_means');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('theme_area_solicitudes');
  }
}
