<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->unique()->regexify('[A-Za-z0-9-_]{20}'),
            'title' => $this->faker->text(50),
            'description' => $this->faker->text(255),
            'body' => $this->faker->text(500),
            'published_at' => ((bool) random_int(0, 1)) ? $this->generateCurrentMonthDate() : null,
            'image_id' => Image::factory()
        ];
    }

    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => $this->generateCurrentMonthDate()
            ];
        });
    }

    private function generateCurrentMonthDate()
    {
        $dateNow = now();

        $maxDays = $dateNow->daysInMonth;
        $randomDay = random_int(1, $maxDays);

        $datePublish = $dateNow;
        $datePublish->day = $randomDay;

        return $datePublish;
    }
}
