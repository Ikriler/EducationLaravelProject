<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CarBody;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class);
        $this->call(CarClassSeeder::class);
        $this->call(CarEngineSeeder::class);
        $this->call(CarBodySeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(BannerSeeder::class);
    }
}
