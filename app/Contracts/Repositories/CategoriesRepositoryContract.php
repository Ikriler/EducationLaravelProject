<?php

namespace App\Contracts\Repositories;

use App\Models\Category;
use Illuminate\Support\Collection;

interface CategoriesRepositoryContract extends FlushCacheRepositoryContract
{
    public function getAllCategories(Category $category): Collection;

    public function getBySlug(string $slug): Category|null;

    public function getCategoriesTree(int $depth): Collection;
}
