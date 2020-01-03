<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $categories  = Category::pluck('id')->all();

    return [
      'category_id' => $faker->randomElement($categories),
      'title'       => $faker->text($maxNbChars = 30),
      'url'         => $faker->unique()->word(10),
      'description' => $faker->sentence($nbWords = 10),
    ];
});
