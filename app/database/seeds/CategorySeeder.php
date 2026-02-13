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
        $categories = ['雑貨', '書籍', '文具'];

        foreach($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category],
                []
            );
        }
    }
}
