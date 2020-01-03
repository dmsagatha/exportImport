<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsvRowLogsTable extends Migration
{
  public function up()
  {
    Schema::create('csv_row_logs', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('csv_row_id')->index();

        $table->foreign('csv_row_id')
              ->references('id')
              ->on('csv_rows')
              ->onDelete('cascade');
        
        $table->string('code')->nullable();
        $table->string('pipe')->nullable();
        $table->text('message')->nullable();
        $table->string('level')->nullable();
        $table->timestamps();
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('csv_row_logs');
  }
}