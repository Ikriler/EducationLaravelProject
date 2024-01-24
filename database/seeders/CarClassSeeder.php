<?php

namespace Database\Seeders;

use App\Models\CarClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            'Мини',
            'Маленький',
            'Среднеразмерный',
            'Полноразмерный',
            'Бизнес',
            'Представительский',
            'Спортивный',
            'Минивэн',
        ];

        foreach ($classes as $className) {
            CarClass::factory()->create(['name' => $className]);
        }
    }
}
