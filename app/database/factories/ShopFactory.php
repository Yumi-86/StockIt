<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->lastName . '店',
        'code' => $faker->unique()->numberBetween(1, 99999),
        'region_id' => $faker->numberBetween(1, 47),
        'phone' => $faker->phoneNumber,
        'postal_code' => $faker->postcode,
        'prefecture' => $faker->prefecture,
        'city' => $faker->city,
        'address_line1' => $faker->streetAddress,
        'address_line2' => $faker->secondaryAddress,
        'is_active' => true,
    ];
});
