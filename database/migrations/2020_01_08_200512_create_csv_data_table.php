<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Guardar datos temporalmente
 */
class CreateCsvDataTable extends Migration
{
  public function up()
  {
    Schema::create('csv_data', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('csv_filename');
        $table->boolean('csv_header')->default(0);
        $table->longText('csv_data');
        $table->timestamps();
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('csv_data');
  }
}