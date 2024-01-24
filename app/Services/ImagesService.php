<?php

namespace App\Services;

use App\Contracts\HasTagsContract;
use App\Contracts\Repositories\ImagesRepositoryContract;
use App\Contracts\Repositories\TagsRepositoryContract;
use App\Contracts\Services\ImagesServiceContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use App\Models\Image;
use Illuminate\Http\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ImagesService implements ImagesServiceContract
{
    public function __construct(
        private readonly string $disk,
        private readonly ImagesRepositoryContract $imagesRepository)
    {

    }

    public function saveFile(File | string $file): string
    {
        if (! $file instanceof File) {
            $file = new File($file);
        }

        return $path = Storage::disk($this->disk)->putFile('' , $file);
    }

    public function createImage(File | string $file): Image
    {
        if (! $file instanceof File) {
            $file = new File($file);
        }

        return $this->imagesRepository->create($this->saveFile($file), $file->getFilename());
    }

    public function url(string $path): string
    {
        return Storage::disk($this->disk)->url($path);
    }

    public function deleteImage(Image | int $image)
    {
        if (! $image instanceof Image) {
            $image = $this->imagesRepository->findById($image);
            if (! $image) {
                return;
            }
        }

        Storage::disk($this->disk)->delete($image->path);

        $this->imagesRepository->delete($image->id);
    }
}
