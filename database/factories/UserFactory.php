<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    $username = $faker->unique()->numberBetween(3000000, 9000000);
    
    return [
        'name'      => $faker->name,
        'username'  => $username,
        'email'     => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'  => bcrypt('123456'), //'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});