<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\IncomingPlan;
use App\Product;
use Faker\Generator as Faker;

$factory->define(IncomingPlan::class, function (Faker $faker) {
    $arrivingDate = $faker->boolean(50)
        ? $faker->dateTimeBetween('-7 days', 'yesterday')
        : $faker->dateTimeBetween('today', '+30 days');

    return [
        'product_id' => factory(Product::class),
        'shop_id' => $faker->numberBetween(1, 50),
        'quantity' => $faker->numberBetween(1, 10),
        'arriving_date' => $arrivingDate->format('Y-m-d'),
        'status' => $arrivingDate < now()
            ? $faker->boolean(90)
            : 0,
    ];
});
