<?php

namespace App\Repositories;

use App\Contracts\Repositories\ImagesRepositoryContract;
use App\Models\Image;
use Illuminate\Support\Facades\Cache;

class ImagesRepository implements ImagesRepositoryContract
{
    use FlushesCache;

    public function __construct(private readonly Image $model)
    {

    }

    protected function cacheTags(): array
    {
        return ['images'];
    }

    public function create(string $diskPath, string $name): Image
    {
        $image = $this->getModel()->create(['path' => $diskPath, 'name' => $name]);

        $this->flushCache();

        return $image;
    }

    private function getModel(): Image
    {
        return $this->model;
    }

    public function findById(int $id): ?Image
    {
        return Cache::tags(['images'])->remember("imageById|{$id}", 3600, fn () => $this->getModel()->find($id));
    }

    public function delete(int $id)
    {
        $status = $this->getModel()->where('id', $id)->delete();

        $this->flushCache();

        return $status;
    }
}
