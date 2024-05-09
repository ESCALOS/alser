<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum CurrencyTypeEnum: int implements HasColor, HasLabel
{
    case SOL = 1;
    case DOLLAR = 2;

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::SOL => 'Soles',
            self::DOLLAR => 'Dólares',
        };
    }

    public static function getLabels(): array
    {
        return [
            self::SOL->getLabel(),
            self::DOLLAR->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::SOL->getLabel()],
            ['id' => 2, 'name' => self::DOLLAR->getLabel()],
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::SOL => 'info',
            self::DOLLAR => 'indigo',
        };
    }
}
