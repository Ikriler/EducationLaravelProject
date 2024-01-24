<?php

namespace App\Services;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Repositories\TagsRepositoryContract;
use App\Contracts\Services\StatisticsServiceContract;
use App\Models\Article;
use Illuminate\Support\Collection;

class StatisticsService implements StatisticsServiceContract
{
    private array $statistics = [];

    public function __construct(
        private readonly CarsRepositoryContract $carsRepository,
        private readonly ArticlesRepositoryContract $articlesRepository,
        private readonly TagsRepositoryContract $tagsRepository
    )
    {

    }

    public function getStatistics(): array
    {
        $this->statistics = [];

        $this->tagsRepository->mostArticlesOnTag();

        // Общее количество машин.
        $this->putStatistic('cars_count', $this->carsRepository->getCount());

        // Общее количество новостей.
        $this->putStatistic('articles_count', $this->articlesRepository->getCount());

        // Тег, у которого больше всего новостей на сайте.
        $this->putStatistic('most_articles_on_tag', $this->tagsRepository->mostArticlesOnTag());

        // Самая длинная новость — название, id новости и длина новости в символах.
        $this->putStatistic('max_body_article', $this->articleWithLengthConverter($this->articlesRepository->maxLengthBodyArticle()));

        // Самая короткая новость — название, id новости и длина новости в символах.
        $this->putStatistic('min_body_article', $this->articleWithLengthConverter($this->articlesRepository->minLengthBodyArticle()));

        // Средние количество новостей у тега, из учета исключить теги без новостей.
        $this->putStatistic('avg_articles_on_tag', $this->tagsRepository->avgArticlesOnTag());

        // Самая тегированная новость — название, id новости и количество тегов этой новости
        $this->putStatistic('most_tagged_article', $this->mostTaggedArticleConverter($this->articlesRepository->mostTaggedArticle()));

        return $this->statistics;
    }

    private function articleWithLengthConverter(Article $article): Collection
    {
        $data = collect([
            'title' => $article->title,
            'id' => $article->id,
            'body_count' => strlen($article->body)
        ]);

        return $data;
    }

    private function mostTaggedArticleConverter(Article $article): Collection
    {
        $mostTaggedArticleData = collect([
            'title' => $article->title,
            'id' => $article->id,
            'tags_count' => $article->tags->count()
        ]);

        return $mostTaggedArticleData;
    }

    private function putStatistic(string $name, mixed $value): void
    {
        $this->statistics[] = [
            'name' => $name,
            'value' => $value
        ];
    }

}
