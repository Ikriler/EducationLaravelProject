<?php

namespace App\Repositories;

use App\Models\Basket;
use App\Contracts\Repositories\BasketsRepositoryContract;

class BasketsRepository implements BasketsRepositoryContract
{
    use FlushesCache;

    protected function cacheTags(): array
    {
        return ['baskets'];
    }

    public function create(): Basket
    {
        return $this->getModel()->factory()->create();
    }

    public function update(array $data, int $basket_id): bool
    {
        return $this->getModel()->where('id', $basket_id)->update($data);
    }

    private function getModel(): Basket
    {
        return new Basket();
    }
}
