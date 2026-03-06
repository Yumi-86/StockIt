<?php

use Illuminate\Database\Seeder;
use App\IncomingPlan;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RegionSeeder::class);

        DB::table('sequences')->updateOrInsert([
            'name' => 'product_code',
            'current_value' => 0,
        ]);

        DB::table('sequences')->updateOrInsert([
            'name' => 'shop_code',
            'current_value' => 0,
        ]);

        $this->call(ShopSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(CategorySeeder::class);

        factory(User::class, 10)->create();
        factory(IncomingPlan::class, 200)->create();
        
        $this->call(StockSeeder::class);

    }
}
