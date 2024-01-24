<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const NOT_PAYED = 0;
    const PAYED = 1;
    const ERROR_PAYED = 2;

    protected $fillable = [
        'user_id',
        'json_products',
        'count',
        'amount',
        'status'
    ];
}
