<?php

namespace App\Providers;

use App\Contracts\Repositories\SalonsClientRepositoryContract;
use App\Contracts\Services\ApiPayOrderServiceContract;
use App\Contracts\Services\ArticleRemoverSerivceContract;
use App\Contracts\Services\BasketPositionsServiceContract;
use App\Contracts\Services\BasketServiceContract;
use App\Contracts\Services\CarRemoverSerivceContract;
use App\Contracts\Services\ImagesServiceContract;
use App\Contracts\Services\OrdersServiceContract;
use App\Contracts\Services\PayOrdersServiceContract;
use App\Contracts\Services\RolesServiceContract;
use App\Contracts\Services\StatisticsServiceContract;
use App\Contracts\Services\SalonsClientServiceContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use App\DTO\SalonDTO;
use App\Http\Resources\CarResource;
use App\Models\Image;
use App\Providers\FakerImageProvider;
use App\Services\ApiPayOrderService;
use App\Services\ArticlesService;
use App\Services\BasketPositionsService;
use App\Services\BasketService;
use App\Services\CarsService;
use App\Services\ImagesService;
use App\Services\OrdersService;
use App\Services\PayOrdersService;
use App\Services\RolesService;
use App\Services\StatisticsService;
use App\Services\SalonsClientService;
use App\Services\TagsSynchronizer;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create(Config::get('app.faker_locale', 'en_US'));
            $faker->addProvider(new FakerImageProvider($faker));
            return $faker;
        });

        $this->app->singleton(TagsSynchronizerServiceContract::class, TagsSynchronizer::class);
        $this->app->singleton(ImagesServiceContract::class, function () {
            return $this->app->make(ImagesService::class, ['disk' => 'public']);
        });

        $this->app->singleton(CarRemoverSerivceContract::class, CarsService::class);
        $this->app->singleton(ArticleRemoverSerivceContract::class, ArticlesService::class);
        $this->app->singleton(StatisticsServiceContract::class, StatisticsService::class);
        $this->app->singleton(SalonsClientServiceContract::class,  function () {
            return $this->app->make(SalonsClientService::class, config('services.salons_api'));
        });

        $this->app->singleton(RolesServiceContract::class, RolesService::class);
        $this->app->singleton(BasketServiceContract::class, BasketService::class);
        $this->app->singleton(BasketPositionsServiceContract::class, BasketPositionsService::class);
        $this->app->singleton(OrdersServiceContract::class, OrdersService::class);

        $this->app->singleton(ApiPayOrderServiceContract::class, function () {
            return $this->app->make(ApiPayOrderService::class, config('services.orders_payment_api'));
        });

        $this->app->singleton(PayOrdersServiceContract::class, PayOrdersService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(SalonsClientRepositoryContract $salonsClientRepository): void
    {
        View::composer(['components.panels.salons'], function (\Illuminate\View\View $view) use ($salonsClientRepository) {
            $view->with('salons', $salonsClientRepository->getRandom(2));
        });

        CarResource::withoutWrapping();

        View::composer(['components.panels.footer_information_menu', 'components.panels.left_information_menu'], function (\Illuminate\View\View $view) {
            $view->with('menu', [
                [
                    'title' => 'О компании',
                    'path' => 'about'
                ],
                [
                    'title' => 'Контактная информация',
                    'path' => 'contacts'
                ],
                [
                    'title' => 'Условия продаж',
                    'path' => 'terms_of_sales'
                ],
                [
                    'title' => 'Финансовый отдел',
                    'path' => 'fin_department'
                ],
                [
                    'title' => 'Для клиентов',
                    'path' => 'for_clients'
                ],
            ]);
        });


        Blade::if('admin', fn () => Gate::allows('admin'));
    }
}
