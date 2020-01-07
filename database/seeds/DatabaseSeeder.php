<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    //factory(Category::class, 3000)->create();

    // Datos ejemplos para las importaciones
    /* DB::table('categories')->insert([
      ['name' => 'Categoria 1', 'url' => 'categoria_1'],
      ['name' => 'Categoria 2', 'url' => 'categoria_2'],
      ['name' => 'Categoria 3', 'url' => 'categoria_3'],
      ['name' => 'Categoria 4', 'url' => 'categoria_4'],
      ['name' => 'Categoria 5', 'url' => 'categoria_5'],
    ]); */

    /* factory(User::class, 30)->create();
    factory(Product::class, 30)->create(); */
  }
}