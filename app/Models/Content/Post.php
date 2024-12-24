<?php

namespace App\Models\Content;

use App\Models\User;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'summary', 'body', 'meta_title', 'meta_description', 'image', 'cover', 'slug', 'commentable', 'status', 'published_at'];

    // Scopes

    public function scopeActive(Builder $query): void
    {
        $query->where('status', true);
    }

    public function scopeDeActive(Builder $query): void
    {
        $query->where('status', false);
    }

    public function scopeCommentable(Builder $query): void
    {
        $query->where('commentable', true);
    }

    public function scopeUnCommentable(Builder $query): void
    {
        $query->where('commentable', false);
    }

    // Relationships

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categoryable', table: 'categoryable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
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
