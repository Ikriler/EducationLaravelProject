<?php

namespace App\Services;

use App\Contracts\Repositories\OrdersRepositoryContract;
use App\Contracts\Services\BasketServiceContract;
use App\Contracts\Services\OrdersServiceContract;
use App\Models\Basket;
use App\Models\Order;
use Illuminate\Support\Collection;

class OrdersService implements OrdersServiceContract
{
    public function __construct(
        private readonly OrdersRepositoryContract $ordersRepository,
        private readonly BasketServiceContract $basketService
    )
    {

    }

    public function getByUserId(int $user_id): Collection
    {
        return $this->ordersRepository->getByUserId($user_id);
    }

    public function create(Basket $basket): Order
    {
        $data = [
            'user_id' => $basket->user->id,
            'json_products' => json_encode($basket->basketPositions),
            'count' => $basket->count(),
            'amount' => $basket->calculateAmount(),
            'status' => Order::NOT_PAYED
        ];

        $order = $this->ordersRepository->create($data);

        $this->basketService->clear($basket->id);

        return $order;
    }
}

