<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Repositories\BannersRepositroyContract;
use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Repositories\CategoriesRepositoryContract;
use App\Contracts\Repositories\SalonsClientRepositoryContract;
use App\Contracts\Services\OrdersServiceContract;
use App\DTO\ArticleFilterPublishedDTO;
use App\Models\Article;
use App\Models\Car;
use App\DTO\CarFilterCatalogDTO;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class PagesController extends Controller
{
    public function home(
        CarsRepositoryContract $carsRepository,
        ArticlesRepositoryContract $articlesRepository,
        BannersRepositroyContract $bannersRepositroy
    ): Factory|View|Application
    {
        $banners = $bannersRepositroy->getRandom(3, relations: ['image']);

        $filter = new ArticleFilterPublishedDTO();

        $filter->setLimit(3);

        $articles = $articlesRepository->getPublished($filter, relations: ['tags', 'image']);

        $cars = $carsRepository->getNew(4, relations: ['image']);

        return view('pages.homepage', ['articles' => $articles, 'cars' => $cars, 'banners' => $banners]);
    }

    public function about(): Factory|View|Application
    {
        return view('pages.about');
    }

    public function contacts(): Factory|View|Application
    {
        return view('pages.contacts');
    }

    public function for_clients(): Factory|View|Application
    {
        $cars = Car::query()->with('carEngine')->with('carClass')->with('carBody')->get();

        dump(
            //Средняя цена моделей
            $cars->avg('price'),
            // Средняя цена моделей со скидкой
            $cars->whereNotNull('old_price')->avg('price'),
            //Самая дорогая модель
            $cars->max('price'),
            //Все виды салонов моделей
            $cars->pluck('salon')->unique(),
            //Коллекция состоящая из названий двигателей, отсортированных по алфавиту
            $cars->sortBy('carEngine.name')->pluck('carEngine.name'),
            //Сформируйте коллекцию состоящую из названий классов моделей, отсортированных по алфавиту. Ключом сделайте символьный код, сформированный из названия класса
            $cars->sortBy('carClass.name')->pluck('carClass.name')->mapWithKeys(fn($value) => [uniqid($value) => $value]),
            //Сформируйте коллекцию моделей. В ней должны быть только модели со скидкой, а также в названии этих моделей, или в названии их двигателей, или КПП, должна содержаться цифра 5 или 6.
            $cars->whereNotNull('old_price')->filter(function ($value) {
                $regFound = fn ($value) => (bool) preg_match('/(5|6)/', $value);
                return $regFound($value->name) |
                    $regFound($value->carEngine->name) |
                    $regFound($value->kpp)
                ;
            }),
            //Сформируйте коллекцию всех видов кузовов отсортированных по возрастанию средней цены (для моделей, без учета скидок), где ключом является название вида кузова, а значением средняя цена на модели с этим видом кузова. При этом не должны учитываться модели, у которых тип кузова не указан.
            $cars->pluck('carBody.name')->unique()->mapWithKeys(function ($value) use ($cars) {
                return [$value => $cars->where('carBody.name', '=', $value)->avg('price')];
            })
        );

        return view('pages.for_clients');
    }

    public function terms_of_sales(): Factory|View|Application
    {
        return view('pages.terms_of_sales');
    }

    public function fin_department(): Factory|View|Application
    {
        return view('pages.fin_department');
    }

    public function articles(ArticlesRepositoryContract $articlesRepository, Request $request): Factory|View|Application
    {
        $filter = new ArticleFilterPublishedDTO();

        $filter->setPaginateCount(5);
        $filter->setPage($request->get('page', 1));

        $articles = $articlesRepository->getPublished($filter, relations: ['tags', 'image']);

        return view('pages.news', ['articles' => $articles]);
    }

    public function catalog(Request $request, CarsRepositoryContract $carsRepository, CategoriesRepositoryContract $categoriesRepository, ?string $slug = null): Factory|View|Application
    {
        $filter = new CarFilterCatalogDTO();

        $paginateCount = 16;
        $page = $request->get('page') ?? 1;

        $filter->setModel($request->get('model'));
        $filter->setPriceFrom($request->get('price_from'));
        $filter->setPriceTo($request->get('price_to'));
        $filter->setOrderModel($request->get('order_model'));
        $filter->setOrderPrice($request->get('order_price'));
        $filter->setPaginateCount($paginateCount);
        $filter->setPage($page);

        $category = $slug === null ? null : $categoriesRepository->getBySlug($slug);

        $allCategories = collect();

        if ($category) {
            $allCategories = $categoriesRepository->getAllCategories($category);
        }

        $filter->setCategory($category);
        $filter->setAllCategories($allCategories);

        $cars = $carsRepository->getWithFilter($filter, ['image']);

        return view('pages.catalog', ['cars' => $cars, 'currentCategory' => $category]);
    }

    public function salons(SalonsClientRepositoryContract $salonsClientRepository): Factory|View|Application
    {
        $salons = $salonsClientRepository->getAll();

        return view('pages.salons', ['salons' => $salons]);
    }

    public function account(
        OrdersServiceContract $ordersService
    ): Factory|View|Application
    {
        $orders = $ordersService->getByUserId(auth()->user()->id);

        return view('pages.account', ['orders' => $orders]);
    }

    public function basket(): Factory|View|Application
    {
        return view('pages.basket');
    }
}
