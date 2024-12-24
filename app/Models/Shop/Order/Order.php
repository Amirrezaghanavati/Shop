<?php

namespace App\Models\Shop\Order;

use App\Enums\OrderStatus;
use App\Models\Location\Address;
use App\Models\Shop\Gateway;
use App\Models\Shop\Product\Sku;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Order extends Model
{
    protected $fillable = ['user_id', 'address_id', 'payment_id', 'transaction_id', 'gateway_id', 'payment_object', 'price', 'note', 'status', 'deleted_at'];

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class
        ];
    }

    public function scopePending(Builder $query): void
    {
        $query->where('status', OrderStatus::PENDING);
    }

    public function scopeConfirmed(Builder $query): void
    {
        $query->where('status', OrderStatus::CONFIRMED);
    }

    public function scopeCancelled(Builder $query): void
    {
        $query->where('status', OrderStatus::CANCELLED);
    }

    public function scopeReturned(Builder $query): void
    {
        $query->where('status', OrderStatus::RETURNED);
    }

    public function scopeExpired(Builder $query): void
    {
        $query->where('status', 'expired');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class)->with('sku');
    }
}
