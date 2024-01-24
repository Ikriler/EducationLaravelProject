<?php

namespace App\Contracts\Repositories;

use App\Models\Basket;
use App\Models\BasketPosition;
use App\Models\Order;
use Illuminate\Support\Collection;

interface BasketPositionsRepositoryContract extends FlushCacheRepositoryContract
{
    public function getByBasketId(int $basket_id): Collection;

    public function getByBasketPositionId(int $basket_position_id): ?BasketPosition;

    public function getByCarId(int $car_id): ?BasketPosition;

    public function create(array $data): BasketPosition;

    public function update(array $data, int $basket_position_id): bool;

    public function delete(int $basket_position_id, int $basket_id): void;

    public function clear(int $basket_id): void;
}
