<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BasketPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'count',
        'basket_id',
        'amount'
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
