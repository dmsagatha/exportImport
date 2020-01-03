<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('title');
        $table->string('url')->unique();
        $table->text('description');

        $table->unsignedBigInteger('category_id')->nullable()->after('id');
        $table->foreign('category_id')->references('id')->on('categories')
              ->onUpdate('cascade')     // Al cambiar el id de la Categoría cambiar en Productos
              ->onDelete('set null');   // al eliminar asignar el valor a NULL
        $table->timestamps();
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('products');
  }
}