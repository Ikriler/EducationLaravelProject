<?php

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Repositories\CategoriesRepositoryContract;
use App\Models\Car;
use App\Models\Category;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

$categoriesRepository = app()->get(CategoriesRepositoryContract::class);
$carsRepository = app()->get(CarsRepositoryContract::class);
$articlesRepository = app()->get(ArticlesRepositoryContract::class);

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('home'));
});

Breadcrumbs::for('catalog', function (BreadcrumbTrail $trail, ?string $currentCategorySlug) use ($categoriesRepository) {
    $trail->parent('home', route('home'));
    $trail->push('Каталог', route('catalog'));

    if ($currentCategorySlug) {
        $category = $categoriesRepository->getBySlug($currentCategorySlug);
        if($category->parent) {
            $trail->push($category->parent->name, route('catalog', ['slug' => $category->parent->slug]));
        }
        $trail->push($category->name, route('catalog', ['slug' => $category->slug]));
    }

});

Breadcrumbs::for('car', function (BreadcrumbTrail $trail, string $car) use ($carsRepository) {
    $car = $carsRepository->findById((int) $car);
    $trail->parent('home');
    $trail->push('Каталог', route('catalog'));
    foreach($car->categories as $category) {
        $trail->push($category->name, route('catalog', ['slug' => $category->slug]));
    }
    $trail->push($car->name, route('car', ['car' => $car->id]));
});

Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('О компании', route('about'));
});

Breadcrumbs::for('contacts', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Контактная информация', route('contacts'));
});


Breadcrumbs::for('for_clients', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Для клиентов', route('for_clients'));
});


Breadcrumbs::for('terms_of_sales', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Условия продаж', route('terms_of_sales'));
});

Breadcrumbs::for('fin_department', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Финансовый отдел', route('fin_department'));
});

Breadcrumbs::for('articles', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Новости', route('articles'));
});

Breadcrumbs::for('article', function (BreadcrumbTrail $trail, ?string $article) use ($articlesRepository) {
    $trail->parent('articles');
    if ($article) {
        $article = $articlesRepository->findById($article);
        $trail->push($article->title, route('article', ['article' => $article->id]));
    }
});





