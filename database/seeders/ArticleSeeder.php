<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создание случайных моделей
        Article::factory()->count(5)->create();
        // Создание опубликованных моделей
        Article::factory()->count(5)->published()->create();
    }
}
