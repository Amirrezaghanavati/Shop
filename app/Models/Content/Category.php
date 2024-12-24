<?php

namespace App\Models\Content;

use App\Models\GameNet\Game;
use App\Models\Shop\Product\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Tags\HasTags;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['parent_id', 'name', 'slug', 'meta_title', 'meta_description', 'description', 'image', 'status'];

    public function scopeActive(Builder $query): void
    {
        $query->where('status', true);
    }

    public function scopeDeActive(Builder $query): void
    {
        $query->where('status', false);
    }

    public function scopeSubcategories(Builder $query): void
    {
        $query->whereNotNull('parent_id');
    }

    public function scopeParents(Builder $query): void
    {
        $query->whereNull('parent_id');
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany($this, 'parent_id')->with('subcategories');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo($this, 'parent_id')->with('parent');
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(related: Post::class, name: 'categoryable', table: 'categoryable');
    }

    public function products(): MorphToMany
    {
        return $this->morphedByMany(related: Product::class, name: 'categoryable', table: 'categoryable');
    }
}
