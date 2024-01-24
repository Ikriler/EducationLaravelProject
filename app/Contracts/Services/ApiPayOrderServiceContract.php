<?php

namespace App\Contracts\Services;

interface ApiPayOrderServiceContract
{
    /**
     * @throw RequestException
     */
    public function pay(int $order_number, int $total_cost): bool;
}

