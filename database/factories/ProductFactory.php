<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
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
        // Storage::disk('s3')->putFileAs('', $files[$key],  $key);

        $name = $this->faker->sentence;
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            // 'image' => $this->faker->imageUrl($width = 480, $height = 640, $category = "image url"),
            'image' => $files[$key],
            'price' => $this->faker->numberBetween(100000, 999999),
            'price_sale' => $this->faker->numberBetween(100000, 666666),
            'sale_off' => $this->faker->numberBetween(0, 50),
            'quantity' => $this->faker->numberBetween(300, 600),
            'description' => $this->faker->paragraph(30),
            'details' => $this->faker->paragraph(10),
            'status' => 1,
            'view' => $this->faker->numberBetween(200, 500),
            'created_at' => $this->faker->dateTimeBetween('-' . rand(21, 30) . ' day'),
            'updated_at' => $this->faker->dateTimeBetween('-' . rand(0, 20) . ' day'),

        ];
    }
}