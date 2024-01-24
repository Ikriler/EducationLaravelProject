<?php

namespace App\Contracts\Repositories;

use App\DTO\ArticleFilterPublishedDTO;
use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ArticlesRepositoryContract extends FlushCacheRepositoryContract
{
    public function get(array $relations = []): Collection;

    public function findById(int $article, array $relations = []): Article|null;

    public function create(array $data): Article;

    public function getPublished(ArticleFilterPublishedDTO $articleFilterPublishedDTO, array $relations = []): Collection|LengthAwarePaginator;

    public function update(Article $article, array $data): bool;

    public function delete(Article $article): bool|null;

    public function getCount(): int;

    public function mostTaggedArticle(): Article;

    public function maxLengthBodyArticle(): Article;

    public function minLengthBodyArticle(): Article;
}
