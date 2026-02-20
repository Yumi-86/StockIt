<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'code' => rand(1, 99999),
        'code_prefix' => 'UNK',
        'category_id' => rand(1, 3),
        'name' => $faker->word,
        'weight' => $faker->numberBetween(1, 50),
        'image_path' => Str::random(10),
        'is_active' => true
    ];
});
