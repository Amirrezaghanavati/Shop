<?php

namespace App\Models\Content;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MediaItem extends Model
{
    protected $fillable = ['mediable_id', 'mediable_type', 'media_id', 'order', 'type'];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
}
