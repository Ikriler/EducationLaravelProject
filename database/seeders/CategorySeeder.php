<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Легковые',
                'sort' => 1,
                'children' => [
                    ['name' => 'Седаны', 'sort' => 2],
                    ['name' => 'Хетчбеки', 'sort' => 2 ],
                    ['name' => 'Универсалы', 'sort' => 2],
                    ['name' => 'Купе', 'sort' => 2],
                    ['name' => 'Родстеры', 'sort' => 2],
                ],
            ],
            [
                'name' => 'Внедорожники',
                'sort' => 2,
                'children' => [
                    ['name' => 'Рамные', 'sort' => 2],
                    ['name' => 'Пикапы', 'sort' => 2],
                    ['name' => 'Кроссоверы', 'sort' => 2],
                ],
            ],
            ['name' => 'Раритетные', 'sort' => 3],
            ['name' => 'Распродажа', 'sort' => 4],
            ['name' => 'Новинки', 'sort' => 5],
        ];

        foreach ($this->categoriesSlug($categories) as $category) {
            Category::create($category);
        }
    }

    private function categoriesSlug(array $categories): array
    {
        array_walk($categories, function (&$category) {
            if (isset($category['children'])) {
                $category['children'] = $this->categoriesSlug($category['children']);
            }

            $category['slug'] = Str::slug($category['name']);
        });

        return $categories;
    }
}

