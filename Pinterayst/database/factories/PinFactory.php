<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $imageFiles = Storage::disk('public')->files('images');
        $randomImageUrl = $this->faker->randomElement($imageFiles);
        return [
            'user_id' => rand(2, 40),
            // 'pin_url' => 'images/profile2.jpg',
            'pin_url' => $randomImageUrl,
            'pin_title' => $this->faker->streetName(),
            'pin_desc' => $this->faker->realText(),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }
}
