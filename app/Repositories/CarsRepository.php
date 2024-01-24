<?php

namespace App\Repositories;

use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Services\ImagesServiceContract;
use App\Models\Car;
use App\DTO\CarFilterCatalogDTO;
use App\Services\ImagesService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CarsRepository implements CarsRepositoryContract
{
    use FlushesCache;

    public function __construct(
        private readonly ImagesServiceContract $imagesService
    )
    {

    }

    protected function cacheTags(): array
    {
        return ['cars'];
    }

    public function get(): Collection
    {
        return Cache::tags(['cars', 'images', 'tags', 'categories'])->remember('cars', 3600, fn () => Car::query()->get());
    }

    public function update(Car $car, array $data): Car
    {
        $oldImageId = null;

        if (! empty($data['image'])) {
            $image = $this->imagesService->createImage($data['image']);
            $data['image_id'] = $image->id;
            $oldImageId = $car->image_id;
        }

        if (! empty($oldImageId)) {
            $this->imagesService->deleteImage($oldImageId);
        }

        $car->update($data);

        $this->flushCache();

        return $car;
    }

    public function delete(Car $car): Car
    {
        $car->delete();

        $this->flushCache();

        return $car;
    }

    public function findById(int $car, array $relations = []): Car|null
    {
        return Cache::tags(['cars', 'images', 'tags', 'carBodies', 'carClasses', 'categories', 'carEngines', 'categories'])->remember(
            sprintf('carById|%s|%s', $car, implode('|', $relations)),
            3600,
            fn () => Car::query()
                ->with($relations)
                ->findOrFail($car)
        );
    }

    public function create(array $data): Car
    {
        if (! empty($data['image'])) {
            $image = $this->imagesService->createImage($data['image']);
            $data['image_id'] = $image->id;
        }

        $car = Car::create($data);

        $this->flushCache();

        return $car;
    }

    public function getWithFilter(CarFilterCatalogDTO $carFilterCatalogDTO, array $relations = []): Collection|LengthAwarePaginator
    {
        $query = Car::query()
            ->with($relations)
            ->when(($model = $carFilterCatalogDTO->getModel()) !== null, fn ($query) => $query->where('name', 'like', "%$model%"))
            ->when(($price_from = $carFilterCatalogDTO->getPriceFrom()) !== null, fn ($query) => $query->where('price', '>=', $price_from))
            ->when(($price_to = $carFilterCatalogDTO->getPriceTo()) !== null, fn ($query) => $query->where('price', '<=', $price_to))
            ->when(($order_price = $carFilterCatalogDTO->getOrderPrice()) !== null, fn ($query) => $query->orderBy('price', $order_price === 'desc' ? 'desc' : 'asc'))
            ->when(($order_model = $carFilterCatalogDTO->getOrderModel()) !== null, fn ($query) => $query->orderBy('name', $order_model === 'desc' ? 'desc' : 'asc'))
            ->when($carFilterCatalogDTO->getCategory(), fn ($query) => $query->whereHas('categories', fn ($query) => $query->whereIn('id', $carFilterCatalogDTO->getAllCategories())))
        ;

        $cars = collect([]);

        $paginateCount = $carFilterCatalogDTO->getPaginateCount();
        $page = $carFilterCatalogDTO->getPage();

        if ($paginateCount && $page) {
            $cars = Cache::tags(['cars', 'images', 'tags', 'categories'])->remember(sprintf('carWithFilter|%s', serialize([
                'filter' => $carFilterCatalogDTO
            ])), 3600, fn () => $query->paginate($paginateCount, page: $page));
        } else {
            $cars = Cache::tags(['cars', 'images', 'tags', 'categories'])->remember(sprintf('carWithFilter|%s', serialize([
                'filter' => $carFilterCatalogDTO
            ])), 3600, fn () => $query->get());
        }

        return $cars;
    }

    public function getNew(int $limit = null, array $relations = []): Collection
    {
        $query = Car::query()->with($relations)->where('is_new', '!=', false)->latest('updated_at')->when($limit !== null, fn ($query) => $query->limit($limit));

        return Cache::tags(['cars', 'images', 'tags', 'categories'])->remember(sprintf('new_cars|%s|%s', $limit, implode('|', $relations)), 3600, fn () => $query->get());
    }

    public function getCount(): int
    {
        return Car::count();
    }
}
