<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => '雑貨',
                'prefix' => 'MIS',
            ],
            [
                'name' => '書籍',
                'prefix' => 'LIB',
            ],
            [
                'name' => '文具',
                'prefix' => 'STA',
            ],
        ];

        foreach($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                ['prefix' => $category['prefix']]
            );
        }
    }
}
