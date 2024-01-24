<?php

namespace App\Contracts\Services;

use App\Models\Basket;
use App\Models\Order;
use Illuminate\Support\Collection;

interface OrdersServiceContract
{
    public function getByUserId(int $user_id): Collection;

    public function create(Basket $basket): Order;
}
