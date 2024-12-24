<?php

namespace App\Models\Shop\Product;

use App\Enums\PanelType;
use App\Enums\Status;
use App\Models\Content\Category;
use App\Models\Content\Comment;
use App\Models\Content\MediaItem;
use App\Models\Content\Taxonomy;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ProductObserver::class)]
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'latin_name', 'summary', 'description', 'meta_title', 'meta_description', 'image', 'cover', 'published_at', 'status'];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'status'       => Status::class
        ];
    }

    // Scopes

    public function scopeActive(Builder $query): void
    {
        $query->where('status', true);
    }

    public function scopeDeActive(Builder $query): void
    {
        $query->where('status', false);
    }

    // Relationships

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categoryable', table: 'categoryable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function skus(): HasMany
    {
        return $this->hasMany(Sku::class);
    }

    public function taxonomies(): MorphToMany
    {
        return $this->morphToMany(Taxonomy::class, 'taxonomyable', table: 'taxonomyable');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(MediaItem::class, 'mediable')->orderBy('order');
    }

}
