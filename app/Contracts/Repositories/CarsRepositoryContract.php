<?php

namespace App\Contracts\Repositories;

use App\Models\Car;
use App\DTO\CarFilterCatalogDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface CarsRepositoryContract extends FlushCacheRepositoryContract
{
    public function get(): Collection;

    public function getWithFilter(CarFilterCatalogDTO $carFilterCatalogDTO, array $relations = []): Collection|LengthAwarePaginator;

    public function getNew(int $limit = null, array $relations = []): Collection;

    public function update(Car $car, array $data): Car;

    public function delete(Car $car): Car;

    public function findById(int $car, array $relations = []): Car|null;

    public function create(array $data): Car;

    public function getCount(): int;
}
