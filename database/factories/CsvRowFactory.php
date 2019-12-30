<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CsvRow;
use App\Models\CsvUpload;
use Faker\Generator as Faker;

$factory->define(CsvRow::class, function (Faker $faker) {
    return [
      'contents'      => [],
      'csv_upload_id' => function () {
          return factory(CsvUpload::class)->create()->id;
      }
    ];
});