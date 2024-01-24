<?php

namespace App\Services;

use App\Contracts\HasTagsContract;
use App\Contracts\Repositories\TagsRepositoryContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use Illuminate\Support\Collection;

class TagsSynchronizer implements TagsSynchronizerServiceContract
{
    public function __construct(private readonly TagsRepositoryContract $tagsRepository)
    {

    }

    public function sync(Collection $tags, HasTagsContract $model)
    {
        $tagsToSync = collect();

        foreach ($tags as $tag) {
            $tagsToSync->push($this->tagsRepository->firstOrCreateByName($tag));
        }

        $this->tagsRepository->syncTags($model, $tagsToSync->pluck('id')->all());

        $this->tagsRepository->deleteUnusedTags();
    }
}
