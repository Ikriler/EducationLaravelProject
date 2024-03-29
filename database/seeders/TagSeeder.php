<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::factory()->count(10)->create();

        foreach (Article::get() as $article) {
            //** @var Artilce $article */
            $article->tags()->saveMany($tags->random(rand(0, 3)));
        }
    }
}
