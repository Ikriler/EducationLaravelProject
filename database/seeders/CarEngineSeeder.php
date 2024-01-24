<?php

namespace Database\Seeders;

use App\Models\CarEngine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarEngineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $engines = [
            'Линейный',
            'Прямой',
            'Плоский',
            'VR',
            'W',
            'Ротационный',
        ];

        foreach ($engines as $engineName) {
            CarEngine::factory()->create(['name' => $engineName]);
        }
    }
}
