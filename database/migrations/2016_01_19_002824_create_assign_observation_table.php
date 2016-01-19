<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignObservationTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('assign_observations', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->uuid('assign_solicitude_id');
      $table->enum('status', ['Enviado', 'Leído', 'Aceptado', 'Rechazado', 'Atendido']);
      $table->text('body');
      $table->timestamps();

      $table->primary(['assign_solicitude_id', 'status']);

      $table->foreign('assign_solicitude_id')->references('id')->on('assign_solicitudes')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('assign_observations');
  }
}
