<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Buihuycuong\Vnfaker\VNFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => vnfaker()->fullname($word = rand(2, 4)),
            'image' => $this->faker->imageUrl($width = 400, $height = 400),
            'email' => vnfaker()->email(['gmail.com']),
            'phone_number' => vnfaker()->mobilephone($numbers = 10),
            'birthday' => vnfaker()->year() . '-' .  vnfaker()->month() . '-' . vnfaker()->day(),
            'status' => config('util.ACTIVE_STATUS'),
            'password' => '$2a$07$KquutFVt8/p7RFkyw.SVau6zPDQMDBFFG85wvBIc3ToFgvXNBWuqG', // 12345678
            'remember_token' => Str::random(10),
        ];
    }
}