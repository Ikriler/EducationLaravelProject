<?php

namespace App\Contracts\Repositories;

use App\Models\Image;

interface ImagesRepositoryContract extends FlushCacheRepositoryContract
{
    public function create(string $diskPath, string $name): Image;

    public function findById(int $id): ?Image;

    public function delete(int $id);
}
