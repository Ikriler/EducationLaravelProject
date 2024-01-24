<?php

namespace App\Contracts\Services;

use App\Models\Basket;
use App\Models\BasketPosition;

interface BasketServiceContract
{
    public function create(): Basket;

    public function addPosition(int $car_id, int $count, int $amount, int $basket_id): BasketPosition;

    public function removePosition(int $basket_position_id, int $basket_id): void;

    public function clear(int $basket_id): void;
}
