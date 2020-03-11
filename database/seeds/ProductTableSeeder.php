<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\Models\Product::class, 7)->create()->each(function ($product) {
            $category = Category::all()->random();
            $product->category()->attach($category);
        });
    }
}
