<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignSolicitudesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('assign_solicitudes', function(Blueprint $table)
    {
      $table->uuid('id')->unique();
      $table->uuid('solicitude_id');
      $table->integer('theme_id')->unsigned();
      $table->integer('area_means_id')->unsigned();

      $table->timestamps();

      $table->primary(['solicitude_id', 'theme_id', 'area_means_id']);

      $table->foreign('solicitude_id')->references('id')->on('solicitudes');
      $table->foreign('theme_id')->references('id')->on('themes');
      $table->foreign('area_means_id')->references('id')->on('area_means');

      $table->enum('status', ['Enviado', 'Leído', 'Aceptado', 'Rechazado', 'Atendido'])->default('Enviado');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('assign_solicitudes');
  }
}
