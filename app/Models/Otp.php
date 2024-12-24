<?php

namespace App\Models;

use App\Enums\OTPTarget;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Otp extends Model
{
    protected $fillable = ['user_id', 'token', 'code', 'login_id', 'type', 'auth_type', 'ip', 'agent', 'used_at', 'expired'];

    protected function casts(): array
    {
        return [
            'type' => OTPTarget::class,
            'used_at' => 'datetime'
        ];
    }

    // Scopes

    public function scopeNotExpired(Builder $query): void
    {
        $query->where('expired', false);
    }

    public function scopeExpired(Builder $query): void
    {
        $query->where('expired', true);
    }

    public function scopeMinutesIsPassed(Builder $query, $subMinutes): void
    {
        $query->where('created_at', '>=', Carbon::now()->subMinutes($subMinutes)->toDateTimeString());
    }

    public function scopeActive(Builder $query, $token, int $minutesIsPassed = 5): void
    {
        $query->where('token', $token)->notExpired()->minutesIsPassed($minutesIsPassed);
    }

    // Relationships

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
