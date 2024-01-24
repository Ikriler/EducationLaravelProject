<?php

namespace App\Services;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class CreateArticleService
{
    public function __construct(private readonly ArticlesRepositoryContract $articlesRepository)
    {

    }

    public function update(array $data): Article
    {
        return DB::transaction(function () use ($data) {
            $article = $this->articlesRepository->create($data);
            return $article;
        });
    }
}
