<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
      'name' => 'Categoria ' . $faker->unique()->numberBetween($min = 100000, $max = 55555),
      'url'  => 'url_' . $faker->unique()->numberBetween($min = 66666, $max = 99999),
    ];
});
