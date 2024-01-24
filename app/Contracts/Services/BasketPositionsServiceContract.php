<?php

namespace App\Contracts\Services;

interface BasketPositionsServiceContract
{
    public function updateCount(int $count, int $basket_position_id, int $basket_id): bool;
}

