<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Traits\EnumeratesValues;

enum SaleStatus: int  implements HasLabel, HasIcon, HasColor
{
    case AVAILABLE   = 0;
    case UNAVAILABLE = 1;
    case COMING_SOON = 2;
    case CALL        = 3;

    public function getIcon(): ?string
    {
        return match ($this) {
            self::AVAILABLE   => 'heroicon-o-check-circle',
            self::UNAVAILABLE => 'heroicon-o-x-circle',
            self::COMING_SOON => 'heroicon-o-clock',
            self::CALL        => 'heroicon-o-phone',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::AVAILABLE   => __('Available'),
            self::UNAVAILABLE => __('Unavailable'),
            self::COMING_SOON => __('Coming soon'),
            self::CALL        => __('Call'),
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::AVAILABLE   => 'success',
            self::UNAVAILABLE => 'danger',
            self::COMING_SOON => 'info',
            self::CALL        => 'gray',
        };
    }
}
