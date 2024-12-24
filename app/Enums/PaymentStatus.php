<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: string implements HasLabel, HasColor
{
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case FAILED  = 'failed';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::SUCCESS => 'success',
            self::FAILED  => 'danger',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => __('Pending'),
            self::SUCCESS => __('Success'),
            self::FAILED  => __('Failed'),
        };
    }
}