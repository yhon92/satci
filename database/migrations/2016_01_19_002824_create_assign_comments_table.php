<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignCommentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('assign_comments', function (Blueprint $table) {
      $table->uuid('assign_solicitude_id');
      $table->enum('status', ['Enviado', 'Leído', 'Aceptado', 'Rechazado', 'Atendido']);
      $table->text('observation');
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
    Schema::drop('assign_comments');
  }
}
