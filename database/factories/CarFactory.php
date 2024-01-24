<?php

namespace Database\Factories;

use App\Models\CarBody;
use App\Models\CarClass;
use App\Models\CarEngine;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(50),
            'body' => $this->faker->text(200),
            'price' => random_int(10**3, 10**4),
            'old_price' => random_int(10**5, 10**6),
            'salon' => $this->faker->text(200),
            'kpp' => $this->faker->text(10),
            'year' => random_int(1900, 2023),
            'color' => $this->faker->safeColorName(),
            'is_new' => ((bool) random_int(0, 1)),
            'car_class_id' => CarClass::factory(),
            'car_body_id' => CarBody::factory(),
            'car_engine_id' => CarEngine::factory(),
            'image_id' => Image::factory(),
        ];
    }

    public function cars_is_new()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_new' => true
            ];
        });
    }
}
