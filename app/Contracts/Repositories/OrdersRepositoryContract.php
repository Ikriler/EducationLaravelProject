<?php

namespace App\Contracts\Repositories;

use App\Models\Order;
use Illuminate\Support\Collection;

interface OrdersRepositoryContract extends FlushCacheRepositoryContract
{
    public function getByUserId(int $user_id): Collection;

    public function create(array $data): Order;

    public function changeStatus(int $order_id, int $status): bool;

    public function getNotPayedOrders(): Collection;
}
