<?php

namespace App\Repositories;

use App\Contracts\HasTagsContract;
use App\Contracts\Repositories\TagsRepositoryContract;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class TagsRepository implements TagsRepositoryContract
{

    use FlushesCache;

    public function __construct(private readonly Tag $model)
    {

    }

    protected function cacheTags(): array
    {
        return ['tags', 'articles'];
    }

    public function firstOrCreateByName(string $name): Tag
    {
        return Cache::tags(['tags'])->remember("firstOrCrateTag|{$name}", 3600, fn () => $this->getModel()->firstOrCreate(['name' => $name]));
    }

    public function syncTags(HasTagsContract $model, array $tags)
    {
        $model->tags()->sync($tags);
    }

    private function getModel(): Tag
    {
        return $this->model;
    }

    public function deleteUnusedTags()
    {
        $this
            ->getModel()
            ->whereDoesntHave('articles')
            ->delete()
        ;

        $this->flushCache();
    }


    public function avgArticlesOnTag(): float
    {
        $articlesCount = 0;
        $tags = $this->getModel()->query()->whereHas('articles')->get()->map(function ($tag) use (&$articlesCount) {
            $articlesCount += $tag->articles->count();
            return $tag;
        });

        $avg = $articlesCount / $tags->count();

        return $avg;
    }


    public function mostArticlesOnTag(): Tag
    {
        return $this->getModel()->withCount('articles')->orderByDesc('articles_count')->first();
    }
}
