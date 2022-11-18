<?php

namespace Database\Seeders;

use App\Models\GalleryProducts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GalleryProducts::factory(100)->create();
    }
}