<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface HasTagsContract
{
    public function tags(): MorphToMany;
}
