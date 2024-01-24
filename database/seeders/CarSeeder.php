<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarBody;
use App\Models\CarClass;
use App\Models\CarEngine;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carClasses = CarClass::get();
        $carEngines = CarEngine::get();
        $carBodies = CarBody::get();
        $categories = Category::get();

        // Создание случайных моделей
        $cars = Car::factory()->count(5)->create([
            'car_class_id' => $carClasses->random(),
            'car_engine_id' => $carEngines->random(),
            'car_body_id' => $carBodies->random(),
        ]);

        $cars->map(fn($car) => $car->categories()->attach($categories->random(rand(1,3))));
        $cars->map(fn($car) => $car->images()->attach(Image::factory()->count(rand(0, 3))->create()));;

        // Создание новинок
        $newCars = Car::factory()->count(5)->cars_is_new()->create([
            'car_class_id' => $carClasses->random(),
            'car_engine_id' => $carEngines->random(),
            'car_body_id' => $carBodies->random(),
        ]);

        $newCars->map(fn($car) => $car->categories()->attach($categories->random(rand(1,3))));
        $newCars->map(fn($car) => $car->images()->attach(Image::factory()->count(rand(0, 3))->create()));;
    }
}
