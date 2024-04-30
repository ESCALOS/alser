<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ServiceEnum: int implements HasColor, HasLabel
{
    case CAMBIO_MONEDA = 1;
    case OTROS = 2;

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::CAMBIO_MONEDA => 'Cambio de moneda online',
            self::OTROS => 'Otro'
        };
    }

    public static function getLabels(): array
    {
        return [
            self::CAMBIO_MONEDA->getLabel(),
            self::OTROS->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::CAMBIO_MONEDA->getLabel()],
            ['id' => 2, 'name' => self::OTROS->getLabel()],
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::CAMBIO_MONEDA => 'info',
            self::OTROS => 'indigo',
        };
    }
}
