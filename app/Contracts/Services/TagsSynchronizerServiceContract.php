<?php

namespace App\Contracts\Services;

use App\Contracts\HasTagsContract;
use Illuminate\Support\Collection;

interface TagsSynchronizerServiceContract
{
    public function sync(Collection $tags, HasTagsContract $model);
}
