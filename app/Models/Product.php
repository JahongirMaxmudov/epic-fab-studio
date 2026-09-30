<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'title',
        'slug',
        'tagline',
        'fab_url',
        'price',
        'version_compatibility',
        'featured_image',
        'video_url',
        'gallery_images',
        'blocks',
        'is_published',
        'is_featured',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'gallery_images' => 'array',
            'blocks' => 'array',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'price' => 'decimal:2',
            'views_count' => 'integer',
        ];
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->where('is_approved', true)->latest();
    }

    public function allComments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }
}
