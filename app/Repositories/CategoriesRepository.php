<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoriesRepositoryContract;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CategoriesRepository implements CategoriesRepositoryContract
{
    use FlushesCache;

    protected function cacheTags(): array
    {
        return ['categories'];
    }

    public function getAllCategories(Category $category): Collection
    {
        return Cache::tags(['categories'])->remember("allCategories|{$category}", 3600, fn () => $category->descendants->pluck('id')->push($category->id));
    }

    public function getBySlug(string $slug): Category|null
    {
        return Cache::tags(['categories'])->remember("categoryBySlug|{$slug}", 3600, fn () => Category::query()->where('slug', '=', $slug)->firstOrFail());
    }

    public function getCategoriesTree(int $depth): Collection
    {
        return Cache::tags(['categories'])->remember("categoryTree|{$depth}", 3600, fn () => Category::withDepth()->having('depth', '<=', $depth)->get()->toTree()->sortBy('sort'));
    }
}
