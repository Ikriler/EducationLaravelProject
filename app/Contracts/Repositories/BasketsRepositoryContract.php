<?php

namespace App\Contracts\Repositories;

use App\Models\Basket;
use App\Models\Order;
use Illuminate\Support\Collection;

interface BasketsRepositoryContract extends FlushCacheRepositoryContract
{
    public function create(): Basket;

    public function update(array $data, int $basket_id): bool;
}
