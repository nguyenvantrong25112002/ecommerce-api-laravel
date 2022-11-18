<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->sentence;
        $slug = Str::slug($name);
        return [
            'title' => $name,
            'image' => $this->faker->imageUrl($width = 1024, $height = 768, $category = "image banner url"),
            'url_to' => $this->faker->imageUrl($width = 1024, $height = 768, $category = "image banner url"),
            'description' => $this->faker->paragraph(5),
            'status' => 1,
            'order' => 0,
            'slug' => $slug
        ];
    }
}