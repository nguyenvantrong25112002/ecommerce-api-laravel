<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\GalleryProducts;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Product::factory(50)->create();
        // Category::factory(10)->create();
        $cate  = Category::all();
        Product::all()->each(function ($pro) use ($cate) {
            $pro->categorys()->syncWithoutDetaching(
                $cate->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
        // GalleryProducts::factory(100)->create();
        // Banner::factory(10)->create();
        // User::factory(100)->create();
    }
}