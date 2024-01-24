<?php

namespace App\Models;

use App\Contracts\HasTagsContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Article extends Model implements HasTagsContract
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'body',
        'published_at',
        'image_id',
    ];

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function imageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->image?->url ?: '/assets/images/no_image.png');
    }

}
