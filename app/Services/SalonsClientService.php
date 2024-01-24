<?php

namespace App\Services;

use App\Contracts\Services\SalonsClientServiceContract;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class SalonsClientService implements SalonsClientServiceContract
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

    public function get(?int $limit = null, bool $in_random_order = false): array
    {
        $parameters = [];

        if ($limit) $parameters['limit'] = $limit;
        if ($in_random_order) $parameters[] = 'in_random_order';

        return $this->getClient()->withQueryParameters($parameters)->get("salons")->throw()->json();
    }
}
