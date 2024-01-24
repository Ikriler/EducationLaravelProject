<?php

namespace App\Models;

use App\Contracts\Repositories\BasketsRepositoryContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'count'
    ];

    public function basketPositions(): HasMany
    {
        return $this->hasMany(BasketPosition::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function count(): int
    {
        $count = $this->calculateCount();

        if (! $this->count !== $count) {
            $basketRepository = app(BasketsRepositoryContract::class);

            $basketRepository->update(['count' => $count], $this->id);
        }

        return $count;
    }

    private function calculateCount(): int
    {
        $count = 0;
        $this->basketPositions->map(function (BasketPosition $basketPosition) use (&$count) {
            $count += $basketPosition->count;
        });
        return $count;
    }

    public function calculateAmount(): int
    {
        $amount = 0;
        $this->basketPositions->map(function (BasketPosition $basketPosition) use (&$amount) {
            $amount += $basketPosition->amount * $basketPosition->count;
        });
        return $amount;
    }
}
