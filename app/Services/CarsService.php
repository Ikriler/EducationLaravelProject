<?php

namespace App\Services;

use App\Contracts\HasTagsContract;
use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Repositories\TagsRepositoryContract;
use App\Contracts\Services\CarRemoverSerivceContract;
use App\Contracts\Services\ImagesServiceContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use Illuminate\Support\Collection;

class CarsService implements CarRemoverSerivceContract
{
    public function __construct(
        private readonly ImagesServiceContract $imagesService,
        private readonly CarsRepositoryContract $carsRepository)
    {

    }

    public function delete(int $id)
    {
        $car = $this->carsRepository->findById($id);

        if (! empty($car->image_id)) {
            $this->imagesService->deleteImage($car->image_id);
        }

        $this->carsRepository->delete($car);

        $this->carsRepository->flushCache();
    }

}
