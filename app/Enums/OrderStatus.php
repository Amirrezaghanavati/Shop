<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: int implements HasLabel, HasColor, HasIcon
{
    case PENDING   = 0;
    case CONFIRMED = 1;
    case CANCELLED = 2;
    case EXPIRED   = 3;
    case RETURNED  = 4;

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING   => 'warning',
            self::CONFIRMED => 'success',
            self::CANCELLED => 'danger',
            self::EXPIRED   => 'gray',
            self::RETURNED  => 'info',
        };
    }


    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING   => __('Pending'),
            self::CONFIRMED => __('Confirmed'),
            self::CANCELLED => __('Cancelled'),
            self::EXPIRED   => __('Expired'),
            self::RETURNED  => __('Returned'),
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PENDING   => 'heroicon-o-clock',
            self::CONFIRMED => 'heroicon-o-check-circle',
            self::CANCELLED => 'heroicon-o-x-circle',
            self::EXPIRED   => 'heroicon-o-exclamation-circle',
            self::RETURNED  => 'heroicon-o-arrow-uturn-left',
        };
    }
}
