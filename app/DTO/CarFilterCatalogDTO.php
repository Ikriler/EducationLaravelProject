<?php

namespace App\DTO;

use App\Models\Category;
use Illuminate\Support\Collection;

class CarFilterCatalogDTO
{
    private ?string $model = null;
    private ?int $price_from = null;
    private ?int $price_to = null;
    private ?string $order_price = null;
    private ?string $order_model = null;
    private ?int $paginateCount = null;
    private ?int $page = null;
    private ?Category $category = null;
    private ?Collection $allCategories = null;

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): void
    {
        $this->model = $model;
    }

    public function getPriceFrom(): ?int
    {
        return $this->price_from;
    }

    public function setPriceFrom(?int $price_from): void
    {
        $this->price_from = $price_from;
    }

    public function getPriceTo(): ?int
    {
        return $this->price_to;
    }

    public function setPriceTo(?int $price_to): void
    {
        $this->price_to = $price_to;
    }

    public function getOrderPrice(): ?string
    {
        return $this->order_price;
    }

    public function setOrderPrice(?string $order_price): void
    {
        $order_price = $order_price === 'desc' ? 'desc' : 'asc';

        $this->order_price = $order_price;
    }


    public function getOrderModel(): ?string
    {
        return $this->order_model;
    }

    public function setOrderModel(?string $order_model): void
    {
        $order_model = $order_model === 'desc' ? 'desc' : 'asc';

        $this->order_model = $order_model;
    }

    public function getPaginateCount(): ?int
    {
        return $this->paginateCount;
    }

    public function setPaginateCount(?int $paginateCount): void
    {
        $this->paginateCount = $paginateCount;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): void
    {
        $this->page = $page;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    public function getAllCategories(): ?Collection
    {
        return $this->allCategories;
    }

    public function setAllCategories(?Collection $allCategories): void
    {
        $this->allCategories = $allCategories;
    }
}
