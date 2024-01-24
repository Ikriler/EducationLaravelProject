<?php

namespace App\Contracts\Repositories;

use App\Models\Car;
use App\DTO\CarFilterCatalogDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface BannersRepositroyContract extends FlushCacheRepositoryContract
{
    public function getRandom(int $limit, array $relations = []): Collection;
}
