<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gateway extends Model
{
    use SoftDeletes;

    protected $fillable = ['driver', 'merchant_id', 'callback_url', 'description', 'mode', 'currency', 'image', 'status'];

    public function scopeActive(Builder $query): void
    {
        $query->where('status', true);
    }

    public function scopeDeActive(Builder $query): void
    {
        $query->where('status', false);
    }
}
