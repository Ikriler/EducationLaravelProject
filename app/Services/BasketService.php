<?php

namespace App\Services;

use App\Contracts\Repositories\BasketPositionsRepositoryContract;
use App\Contracts\Repositories\BasketsRepositoryContract;
use App\Contracts\Repositories\RolesRepositoryContract;
use App\Contracts\Services\BasketServiceContract;
use App\Contracts\Services\RolesServiceContract;
use App\Models\Basket;
use App\Models\BasketPosition;

class BasketService implements BasketServiceContract
{
    public function __construct(
        private readonly BasketsRepositoryContract $basketsRepository,
        private readonly BasketPositionsRepositoryContract $basketPositionsRepository
    )
    {

    }

    public function create(): Basket
    {
        return $this->basketsRepository->create();
    }

    public function addPosition(int $car_id, int $count, int $amount, int $basket_id): BasketPosition
    {
        $data = [
            'car_id' => $car_id,
            'count' => $count,
            'amount' => $amount,
            'basket_id' => $basket_id
        ];

        $basketPosition = $this->basketPositionsRepository->getByCarId($car_id);

        if ($basketPosition) {
            $this->basketPositionsRepository->update(['count' => $basketPosition->count + $count, 'amount' => $basketPosition->amount + $amount], $basketPosition->id);
            return $basketPosition;
        }

        return $this->basketPositionsRepository->create($data);
    }

    public function removePosition(int $basket_position_id, int $basket_id): void
    {
        $this->basketPositionsRepository->delete($basket_position_id, $basket_id);
    }

    public function clear(int $basket_id): void
    {
        $this->basketPositionsRepository->clear($basket_id);
    }
}
