<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $imageFiles = Storage::disk('public')->files('images');
        $randomImageUrl = $this->faker->randomElement($imageFiles);
        return [

            'user_url' => $randomImageUrl,
            'user_name' => $this->faker->name(),
            'user_password' => Hash::make($this->faker->password()),
            'user_email' => $this->faker->email(),
            'user_bio' => $this->faker->realText(),
            'user_dob' => $this->faker->date(),
            'user_role' => 'user',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
