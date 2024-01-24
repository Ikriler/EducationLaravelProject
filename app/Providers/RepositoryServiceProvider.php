<?php

namespace App\Providers;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Repositories\BannersRepositroyContract;
use App\Contracts\Repositories\BasketPositionsRepositoryContract;
use App\Contracts\Repositories\BasketsRepositoryContract;
use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Repositories\CategoriesRepositoryContract;
use App\Repositories\CategoriesRepository;
use App\Contracts\Repositories\TagsRepositoryContract;
use App\Contracts\Repositories\ImagesRepositoryContract;
use App\Contracts\Repositories\OrdersRepositoryContract;
use App\Contracts\Repositories\RolesRepositoryContract;
use App\Contracts\Repositories\SalonsClientRepositoryContract;
use App\Repositories\ArticlesRepository;
use App\Repositories\BannersRepository;
use App\Repositories\BasketPositionsRepository;
use App\Repositories\BasketsRepository;
use App\Repositories\CarsRepository;
use App\Repositories\ImagesRepository;
use App\Repositories\OrdersRepository;
use App\Repositories\RolesRepository;
use App\Repositories\SalonsRepositroy;
use App\Repositories\TagsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CarsRepositoryContract::class, CarsRepository::class);
        $this->app->singleton(ArticlesRepositoryContract::class, ArticlesRepository::class);
        $this->app->singleton(CategoriesRepositoryContract::class, CategoriesRepository::class);
        $this->app->singleton(TagsRepositoryContract::class, TagsRepository::class);
        $this->app->singleton(ImagesRepositoryContract::class, ImagesRepository::class);
        $this->app->singleton(BannersRepositroyContract::class, BannersRepository::class);
        $this->app->singleton(SalonsClientRepositoryContract::class, SalonsRepositroy::class);
        $this->app->singleton(RolesRepositoryContract::class, RolesRepository::class);
        $this->app->singleton(BasketsRepositoryContract::class, BasketsRepository::class);
        $this->app->singleton(BasketPositionsRepositoryContract::class, BasketPositionsRepository::class);
        $this->app->singleton(OrdersRepositoryContract::class, OrdersRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
