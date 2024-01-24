<?php

namespace App\Repositories;

use App\Models\Basket;
use App\Contracts\Repositories\BasketPositionsRepositoryContract;
use App\Models\BasketPosition;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class BasketPositionsRepository implements BasketPositionsRepositoryContract
{
    use FlushesCache;

    protected function cacheTags(): array
    {
        return ['baskets', 'basket_positions'];
    }

    public function getByBasketId(int $basket_id): Collection
    {
        return $this->getModel()->where('basket_id', $basket_id)->get();
    }

    public function getByCarId(int $car_id): ?BasketPosition
    {
        return $this->getModel()->where('car_id', $car_id)->first();
    }

    public function getByBasketPositionId(int $basket_position_id): ?BasketPosition
    {
        return $this->getModel()->where('id', $basket_position_id)->first();
    }

    public function create(array $data): BasketPosition
    {
        return $this->getModel()->create($data);
    }

    public function update(array $data, int $basket_position_id): bool
    {
        return $this->getModel()->where('id', $basket_position_id)->update($data);
    }

    public function delete(int $basket_position_id, int $basket_id): void
    {
        $this->getModel()->where('id', $basket_position_id)->where('basket_id', $basket_id)->delete();
    }

    public function clear(int $basket_id): void
    {
        $this->getModel()->where('basket_id', $basket_id)->delete();
    }

    private function getModel(): BasketPosition
    {
        return new BasketPosition();
    }
}
