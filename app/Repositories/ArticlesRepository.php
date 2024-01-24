<?php

namespace App\Repositories;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Services\ImagesServiceContract;
use App\DTO\ArticleFilterPublishedDTO;
use App\Events\ArticleCreatedEvent;
use App\Events\ArticleDeletedEvent;
use App\Events\ArticleUpdatedEvent;
use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;

class ArticlesRepository implements ArticlesRepositoryContract
{
    use FlushesCache;

    public function __construct(private readonly ImagesServiceContract $imagesService)
    {

    }

    protected function cacheTags(): array
    {
        return ['articles'];
    }

    public function get(array $relations = []): Collection
    {
        $query = Article::query()->with($relations);

        $articles = Cache::tags(['articles', 'images', 'tags'])->remember(
            sprintf('articles|%s', implode('|', $relations)),
            3600,
            fn () => $query->get()
        );

        return $articles;
    }

    public function findById(int $article, array $relations = []): Article|null
    {
        $query = Article::query();

        foreach ($relations as $relation) {
            $query->with($relation);
        }

        return Cache::tags(['articles', 'images', 'tags'])->remember(
            sprintf('article|%s|%s', $article, implode('|', $relations)),
            3600,
            fn () => $query->findOrFail($article)
        );
    }

    public function create(array $data): Article
    {
        if (! empty($data['image'])) {
            $image = $this->imagesService->createImage($data['image']);
            $data['image_id'] = $image->id;
        }

        $article = Article::create($data);

        $this->flushCache();

        Event::dispatch(new ArticleCreatedEvent($article));

        return $article;
    }

    public function getPublished(ArticleFilterPublishedDTO $articleFilterPublishedDTO, array $relations = []): Collection|LengthAwarePaginator
    {
        $query = Article::query();

        foreach ($relations as $relation) {
            $query->with($relation);
        }

        $query = $query->where('published_at', '!=', null)->latest('published_at')->latest('created_at')->latest('updated_at')->when(($limit = $articleFilterPublishedDTO->getLimit()) !== null, fn ($query) => $query->limit($limit));

        $articles = collect([]);

        $paginateCount = $articleFilterPublishedDTO->getPaginateCount();
        $page = $articleFilterPublishedDTO->getPage();

        if ($paginateCount && $page) {
            $articles = Cache::tags(['articles', 'images', 'tags'])->remember(
                sprintf('publishedArticles|%s', serialize([
                    'filter' => $articleFilterPublishedDTO,
                    'relations' => $relations
                ])),
                3600,
                fn () => $query->paginate($paginateCount, page: $page)
            );
        } else {
            $articles = Cache::tags(['articles', 'images', 'tags'])->remember(
                sprintf('publishedArticles|%s', serialize([
                    'filter' => $articleFilterPublishedDTO,
                    'relations' => $relations
                ])),
                3600,
                fn () => $query->get()
            );
        }

        return $articles;
    }

    public function update(Article $article, array $data): bool
    {
        $oldImageId = null;

        if (! empty($data['image'])) {
            $image = $this->imagesService->createImage($data['image']);
            $data['image_id'] = $image->id;
            $oldImageId = $article->image_id;
        }

        if (! empty($oldImageId)) {
            $this->imagesService->deleteImage($oldImageId);
        }

        $status = $article->update($data);

        $this->flushCache();

        Event::dispatch(new ArticleUpdatedEvent($article));

        return $status;
    }

    public function delete(Article $article): bool|null
    {
        $status = $article->delete();

        $this->flushCache();

        Event::dispatch(new ArticleDeletedEvent($article));

        return $status;
    }

    public function getCount(): int
    {
        return Article::count();
    }

    public function mostTaggedArticle(): Article
    {
        return Article::withCount('tags')->whereHas('tags')->orderByDesc('tags_count')->first();
    }

    public function maxLengthBodyArticle(): Article
    {
        return Article::orderByRaw('LENGTH(body) DESC')->first();
    }

    public function minLengthBodyArticle(): Article
    {

        return Article::orderByRaw('LENGTH(body) ASC')->first();
    }
}
