<?php

namespace App\Services;

use App\Contracts\Services\ApiPayOrderServiceContract;
use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\ErrorHandler\Debug;

class ApiPayOrderService implements ApiPayOrderServiceContract
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly string $user,
        private readonly string $password,
    )
    {

    }

    private function getClient(): PendingRequest
    {
        $client = Http::withOptions(['verify' => false])->withBasicAuth($this->user, $this->password)->baseUrl($this->baseUrl);
        return $client;
    }

    /**
     * @throw RequestException
     */
    public function pay(int $order_number, int $total_cost): bool
    {
        $parameters = [];

        $parameters['order_number'] = $order_number;
        $parameters['total_cost'] = $total_cost;

        return $this->getClient()->withQueryParameters($parameters)->post('order_payment')->throw()->body() === 'success';
    }
}

