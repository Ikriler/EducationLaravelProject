<?php

namespace App\Services;

use App\Contracts\Repositories\BasketPositionsRepositoryContract;
use App\Contracts\Services\BasketPositionsServiceContract;

class BasketPositionsService implements BasketPositionsServiceContract
{
    public function __construct(
        private readonly BasketPositionsRepositoryContract $basketPositionsRepository
    )
    {

    }

    public function updateCount(int $count, int $basket_position_id, int $basket_id): bool
    {
        if ($count <= 0) {
            $this->basketPositionsRepository->delete($basket_position_id, $basket_id);
        }

        $data = [
            'count' => $count
        ];

        return $this->basketPositionsRepository->update($data, $basket_position_id);
    }
}

