<?php

namespace App\Models\Shop\Order;

use App\Enums\TransactionStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    protected $table    = 'transactions';
    protected $fillable = ['user_id', 'payable_id', 'payable_type', 'amount', 'type', 'transaction_id', 'reference_id', 'failed_message', 'status'];

    protected function casts(): array
    {
        return [
            'status' => TransactionStatus::class
        ];
    }

    public function scopeSuccess(Builder $query): void
    {
        $query->where('status', 'success');
    }

    public function scopeFailed(Builder $query): void
    {
        $query->where('status', 'failed');
    }

    public function scopeDeposited(Builder $query): void
    {
        $query->where('type', 'deposit');
    }

    public function scopeWithdrew(Builder $query): void
    {
        $query->where('type', 'withdraw');
    }

    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
