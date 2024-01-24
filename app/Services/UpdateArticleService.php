<?php

namespace App\Services;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class UpdateArticleService
{
    public function __construct(private readonly ArticlesRepositoryContract $articlesRepository)
    {

    }

    public function update(Article $article, array $data): bool
    {
        return DB::transaction(function () use ($article, $data) {
            $status = $this->articlesRepository->update($article, $data);
            return $status;
        });
    }
}
