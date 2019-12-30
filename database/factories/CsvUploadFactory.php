<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CsvUpload;
use Faker\Generator as Faker;

$factory->define(CsvUpload::class, function (Faker $faker) {
    return [
      'original_filename' => $faker->word . '.csv',
      'has_headers'       => true,
      'file_contents'     => [],
      'column_mapping'    => [],
    ];
});