<?php

namespace App\Repositories;

use App\Models\Basket;
use App\Contracts\Repositories\OrdersRepositoryContract;
use App\Models\Order;
use Illuminate\Support\Collection;

class OrdersRepository implements OrdersRepositoryContract
{
    use FlushesCache;

    protected function cacheTags(): array
    {
        return ['orders'];
    }

    public function getByUserId(int $user_id): Collection
    {
        return $this->getModel()->where('user_id', $user_id)->get();
    }

    public function create(array $data): Order
    {
        return $this->getModel()->create($data);
    }

    public function changeStatus(int $order_id, int $status): bool
    {
        return $this->getModel()->where('id', $order_id)->update(['status' => $status]);
    }

    public function getNotPayedOrders(): Collection
    {
        return $this->getModel()->where('status', '!=', Order::PAYED)->get();
    }

    public function getModel(): Order
    {
        return (new Order());
    }
}
