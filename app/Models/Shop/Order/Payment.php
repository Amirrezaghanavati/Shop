<?php

namespace App\Models\Shop\Order;

use App\Enums\PaymentConfirmation;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Payment extends Model
{
    protected $fillable = ['user_id', 'transaction_id', 'payable_id', 'payable_type', 'method', 'status', 'confirmed'];

    protected function casts(): array
    {
        return [
            'method'    => PaymentMethod::class,
            'status'    => PaymentStatus::class,
        ];
    }

    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
