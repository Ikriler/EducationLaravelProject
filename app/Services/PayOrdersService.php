<?php

namespace App\Services;

use App\Contracts\Repositories\OrdersRepositoryContract;
use App\Contracts\Services\ApiPayOrderServiceContract;
use App\Contracts\Services\PayOrdersServiceContract;
use App\Models\Order;
use Exception;
use Illuminate\Http\Client\RequestException;

class PayOrdersService implements PayOrdersServiceContract
{
    public function __construct(
        private readonly ApiPayOrderServiceContract $apiPayOrderService,
        private readonly OrdersRepositoryContract $ordersRepository
    )
    {

    }

    public function payOrders(): void
    {
        $orders = $this->ordersRepository->getNotPayedOrders();

        foreach ($orders as $order) {
            try {
                if ($this->apiPayOrderService->pay($order->id, $order->amount)) {
                    $this->ordersRepository->changeStatus($order->id, Order::PAYED);
                }
            } catch (Exception $e) {
                $this->ordersRepository->changeStatus($order->id, Order::ERROR_PAYED);
            }
        }
    }
}

