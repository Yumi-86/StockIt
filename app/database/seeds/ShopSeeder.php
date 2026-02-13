<?php

use Illuminate\Database\Seeder;
use App\Shop;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = [
            [
                'name' => '新宿店',
                'code' => 'SHINJUKU',
                'is_active' => true,
            ],
            [
                'name' => '池袋店',
                'code' => 'IKEBUKURO',
                'is_active' => true,
            ],
        ];

        foreach ($shops as $shop) {
            Shop::updateOrCreate(
                ['code' => $shop['code']],
                $shop
            );
        }
    }
}
