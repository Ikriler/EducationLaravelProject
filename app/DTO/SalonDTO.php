<?php

namespace App\DTO;

class SalonDTO
{
    public readonly ?string $image;

    public function __construct(
        public readonly ?string $name,
        string $image,
        public readonly ?string $address,
        public readonly ?string $phone,
        public readonly ?string $work_hours,
    )
    {
        $this->image = '/'. ltrim($image, '/');
    }
}
