<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GalleryProducts>
 */
class GalleryProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $files = Storage::disk('public-folder-images')->allFiles();
        $key = array_rand($files);
        return [
            'product_id' => Product::all()->random()->id,
            'order' => 0,
            'image' => $files[$key],
        ];
    }
}