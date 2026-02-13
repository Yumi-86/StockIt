<?php

use Illuminate\Database\Seeder;
use App\IncomingPlan;
use App\Stock;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $completedPlans = IncomingPlan::where('status', 1)->get();

        foreach ($completedPlans as $plan) {

            $stock = Stock::firstOrNew([
                'product_id' => $plan->product_id,
                'shop_id' => $plan->shop_id,
            ]);

            $stock->quantity = ($stock->quantity ?? 0) + $plan->quantity;

            $stock->save();
        }
    }
}
