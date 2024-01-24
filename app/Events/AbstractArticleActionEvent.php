<?php

namespace App\Events;

use App\Contracts\Events\ArticleActionEventContract;
use App\Models\Article;

abstract class AbstractArticleActionEvent implements ArticleActionEventContract
{
   public function __construct(
    public readonly Article $article
   )
   {

   }

   public function article(): Article
   {
        return $this->article;
   }
}

