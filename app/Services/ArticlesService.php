<?php

namespace App\Services;

use App\Contracts\HasTagsContract;
use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Repositories\TagsRepositoryContract;
use App\Contracts\Services\ArticleRemoverSerivceContract;
use App\Contracts\Services\CarRemoverSerivceContract;
use App\Contracts\Services\ImagesServiceContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use Illuminate\Support\Collection;

class ArticlesService implements ArticleRemoverSerivceContract
{
    public function __construct(
        private readonly ImagesServiceContract $imagesService,
        private readonly ArticlesRepositoryContract $articlesRepository)
    {

    }

    public function delete(int $id)
    {
        $car = $this->articlesRepository->findById($id);

        if (! empty($car->image_id)) {
            $this->imagesService->deleteImage($car->image_id);
        }

        $this->articlesRepository->delete($car);
    }

}
