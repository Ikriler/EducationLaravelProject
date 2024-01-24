<?php

namespace App\Contracts\Events;

use App\Models\Article;

interface ArticleActionEventContract
{
    public function article(): Article;
}
