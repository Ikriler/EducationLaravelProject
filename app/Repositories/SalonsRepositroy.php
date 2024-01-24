<?php

namespace App\Repositories;

use App\Contracts\Repositories\SalonsClientRepositoryContract;
use App\Contracts\Services\SalonsClientServiceContract;
use App\DTO\SalonDTO;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SalonsRepositroy implements SalonsClientRepositoryContract
{
    use FlushesCache;

    public function __construct(
        private readonly SalonsClientServiceContract $salonsClientService
    )
    {

    }

    protected function cacheTags(): array
    {
        return ['salons'];
    }

    public function getRandom(int $limit): Collection
    {
        try {
            return Cache::tags($this->cacheTags())->remember(
                'RandomSalons|' . $limit,
                300,
                function () use ($limit) {
                    return $this->getModelsCollection($this->salonsClientService->get($limit, true));
                }
            );
        } catch (RequestException $exception) {
            return Cache::tags($this->cacheTags())->remember(
                'RandomSalons|' . $limit,
                5,
                fn () => collect([])
            );
        }
    }

    public function getAll(): Collection
    {
        try {
            return Cache::tags($this->cacheTags())->remember(
                'salons',
                3600,
                function () {
                    return $this->getModelsCollection($this->salonsClientService->get());
                }
            );
        } catch (RequestException $exception) {
            return Cache::tags($this->cacheTags())->remember(
                'salons',
                5,
                fn () => collect([])
            );
        }
    }

    private function getModelsCollection(array $salonsArray): Collection
    {
        $salons = collect([]);

        foreach ($salonsArray as $salon) {
            $salons->push($this->createModelFromResponseItem($salon));
        }

        return $salons;
    }

    private function createModelFromResponseItem($salon): SalonDTO
    {
        return new SalonDTO(
            $salon['name'],
            $salon['image'],
            $salon['address'],
            $salon['phone'],
            $salon['work_hours'],
        );
    }
}
