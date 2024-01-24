<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CarResource extends JsonResource
{
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'body' => $this->body,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'car_body_id' => $this->car_body_id
        ];
    }
}
