<?php

namespace App\Models\Content;

use App\Models\GameNet\Game;
use App\Models\Shop\Product\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Tags\HasTags;

class Taxonomy extends Model
{
    use SoftDeletes;


    protected $fillable = ['name', 'description', 'meta_title', 'meta_description', 'image', 'slug', 'status'];

    public function scopeActive(Builder $query): void
    {
        $query->where('status', true);
    }

    public function scopeDeActive(Builder $query): void
    {
        $query->where('status', false);
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(related: Post::class, name: 'taxonomyable', table: 'taxonomyable');
    }

    public function products(): MorphToMany
    {
        return $this->morphedByMany(related: Product::class, name: 'taxonomyable', table: 'taxonomyable');
    }
}
