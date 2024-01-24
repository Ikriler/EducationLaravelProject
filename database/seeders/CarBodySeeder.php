<?php

namespace Database\Seeders;

use App\Models\CarBody;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarBodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bodies = [
            'Седан',
            'Купе',
            'Хэтчбек',
            'Лифтбек',
            'Фастбэк',
            'Универсал',
            'Кроссовер',
            'Внедорожник',
        ];

        foreach ($bodies as $bodyName) {
            CarBody::factory()->create(['name' => $bodyName]);
        }
    }
}
