<?php

namespace App\Contracts\Repositories;

use App\Contracts\HasTagsContract;
use App\Models\Tag;

interface TagsRepositoryContract extends FlushCacheRepositoryContract
{
    public function firstOrCreateByName(string $name): Tag;

    public function syncTags(HasTagsContract $model, array $tags);

    public function deleteUnusedTags();

    public function avgArticlesOnTag(): float;

    public function mostArticlesOnTag(): Tag;
}
