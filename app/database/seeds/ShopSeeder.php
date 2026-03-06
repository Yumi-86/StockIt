<?php

use Illuminate\Database\Seeder;
use App\Shop;
use Illuminate\Support\Facades\App;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Shop::class, 50)->create();
    }
}
