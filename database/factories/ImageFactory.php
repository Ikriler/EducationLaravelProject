<?php

namespace Database\Factories;

use App\Contracts\Services\ImagesServiceContract;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagesService = app(ImagesServiceContract::class);

        $path = $imagesService->saveFile($this->faker->image('public/storage'));

        return [
            'path' => $path,
            'name' => $this->faker->word()
        ];
    }
}
