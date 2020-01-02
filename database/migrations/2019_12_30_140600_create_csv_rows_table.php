<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsvRowsTable extends Migration
{
  public function up()
  {
    Schema::create('csv_rows', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->text('contents');
        $table->unsignedBigInteger('csv_upload_id')->index();

        $table->foreign('csv_upload_id')
              ->references('id')
              ->on('csv_uploads')
              ->onDelete('cascade');
        
        $table->dateTime('imported_at')->nullable();
        $table->dateTime('warned_at')->nullable();
        $table->dateTime('failed_at')->nullable();
        $table->timestamps();
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('csv_rows');
  }
}