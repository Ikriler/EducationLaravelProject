<?php

namespace App\DTO;

class ArticleFilterPublishedDTO
{
    private ?int $limit = null;
    private ?int $paginateCount = null;
    private ?int $page = null;

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setLimit(?int $limit): void
    {
        $this->limit = $limit;
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
}
