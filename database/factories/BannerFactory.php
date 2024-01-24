<?php

namespace Database\Factories;

use App\Models\Image;
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
    public function definition(): array
    {
        return [
            'title' => implode(' ', $this->faker->words(5)),
            'description' => implode(' ', $this->faker->words(10)),
            'href' => route('catalog'),
            'image_id' => Image::factory()
        ];
    }
}
