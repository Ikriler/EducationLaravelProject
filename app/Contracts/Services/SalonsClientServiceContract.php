<?php

namespace App\Contracts\Services;

use Illuminate\Support\Collection;

interface SalonsClientServiceContract
{
    /**
     * @throw RequestException
     */
    public function get(?int $limit = null, bool $in_random_order = false): array;
}
