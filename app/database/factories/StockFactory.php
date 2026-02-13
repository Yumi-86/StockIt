<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\IncomingPlan;
use App\Stock;
use Faker\Generator as Faker;

$factory->define(Stock::class, function (Faker $faker) {
    $completedPlans = IncomingPlan::where('status', 1)->get();

    foreach($completedPlans as $plan) {
        $stock = Stock::firstOrNew([
            'product_id' => $plan->product_id,
        ]);
        $stock->quantity += $plan->quantity;
        
    }
    return [
        
    ];
});
