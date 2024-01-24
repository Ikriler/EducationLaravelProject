<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface SalonsClientRepositoryContract extends FlushCacheRepositoryContract
{
    public function getRandom(int $limit): Collection;

    public function getAll(): Collection;
}
