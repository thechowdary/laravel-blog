<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'is_published'
    ];

    /**
     * @var array<string>
     */
    protected $appends = [
        'image_url',
    ];

    public function imageUrl(): Attribute
    {
        return Attribute::get(fn () => asset(Storage::url($this->image)));
    }

    public function scopePublished(Builder $query)
    {
        return $query->whereNotNull('is_published');
    }

    public function scopeDraft(Builder $query)
    {
        return $query->whereNull('is_published');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
