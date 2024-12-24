<?php

namespace App\Models\Content;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'parent_id', 'commentable_id', 'commentable_type', 'body', 'seen', 'approved', 'status'];

    public function scopeActive(Builder $query): void
    {
        $query->where('status', true);
    }

    public function scopeDeActive(Builder $query): void
    {
        $query->where('status', false);
    }

    public function scopeApproved(Builder $query): void
    {
        $query->where('approved', 'approved');
    }

    public function scopePending(Builder $query): void
    {
        $query->where('approved', 'pending');
    }

    public function scopeRejected(Builder $query): void
    {
        $query->where('approved', 'rejected');
    }

    public function scopeSeen(Builder $query): void
    {
        $query->where('seen', true);
    }

    public function scopeUnseen(Builder $query): void
    {
        $query->where('seen', false);
    }

    public function scopeReply(Builder $query): void
    {
        $query->whereNotNull('parent_id');
    }

    public function scopeComment(Builder $query): void
    {
        $query->whereNull('parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->with('replies');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function approvedReplies()
    {
        return $this->replies()
            ->approved()
            ->active()
            ->seen()
            ->get();
    }
}
