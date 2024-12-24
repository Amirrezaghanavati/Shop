<?php

namespace App\Enums;

use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethod: string implements HasLabel, HasIcon
{
    case ONLINE  = 'online';
    case OFFLINE = 'Offline';
    case CASH    = 'Cash';


    public function getLabel(): ?string
    {
        return match ($this) {
            self::ONLINE  => __('Online'),
            self::OFFLINE => __('Offline'),
            self::CASH    => __('Cash'),
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::ONLINE  => 'heroicon-o-credit-card',
            self::OFFLINE => 'heroicon-o-currency-dollar',
            self::CASH    => 'heroicon-o-banknotes',
        };
    }
}
