<?php

namespace App\Contracts\Services;

use App\Contracts\HasTagsContract;
use App\Models\Image;
use Illuminate\Http\File;
use Illuminate\Support\Collection;

interface ImagesServiceContract
{
    public function saveFile(File | string $file): string;

    public function createImage(File | string $file): Image;

    public function url(string $path): string;

    public function deleteImage(Image | int $image);
}
