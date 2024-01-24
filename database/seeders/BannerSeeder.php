<?php

namespace Database\Seeders;

use App\Contracts\Services\ImagesServiceContract;
use App\Models\Banner;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(ImagesServiceContract $imageService): void
    {
        foreach($this->banners() as $banner) {
            if(! empty($banner['image'])) {
                $image = $imageService->createImage(resource_path($banner['image']));
                $banner['image_id'] = $image->id;
            }
            unset($banner['image']);
            Banner::factory()->create($banner);
        }
    }

    public function banners(): array
    {
        return [
            [
                'href' => route('catalog'),
                'image' => '/assets/pictures/test_banner_1.jpg',
            ],
            [
                'href' => route('catalog'),
                'image' => 'assets/pictures/test_banner_2.jpg',
            ],
            [
                'href' => route('catalog'),
                'image' => 'assets/pictures/test_banner_3.jpg',
            ],
        ];
    }
}
