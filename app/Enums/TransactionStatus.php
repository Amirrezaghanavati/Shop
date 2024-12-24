<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TransactionStatus: string implements HasLabel, HasColor
{
    case SUCCESS = 'success';
    case FAILED  = 'failed';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::SUCCESS => 'success',
            self::FAILED  => 'danger',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SUCCESS => __('Success'),
            self::FAILED  => __('Failed'),
        };
    }
}