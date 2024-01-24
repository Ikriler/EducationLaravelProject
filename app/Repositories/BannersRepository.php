<?php

namespace App\Repositories;

use App\Contracts\Repositories\BannersRepositroyContract;
use App\Models\Banner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class BannersRepository implements BannersRepositroyContract
{
    use FlushesCache;

    protected function cacheTags(): array
    {
        return ['banners'];
    }

    public function getRandom(int $limit, array $relations = []): Collection
    {
        return Cache::tags(['banners', 'images'])->remember(
            sprintf('getRandomBanners|%s|%s', $limit, implode('|', $relations)),
            3600,
            fn () => $this->getModel()->query()->with($relations)->orderByRaw("RAND()")->limit($limit)->get());
    }

    private function getModel(): Model
    {
        return new Banner();
    }
}
