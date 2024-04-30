<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ResponseMediumEnum: int implements HasColor, HasLabel
{
    case EMAIL = 1;
    case DELIVERY = 2;

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::EMAIL => 'Correo Electrónico',
            self::DELIVERY => 'Entrega a domicilio'
        };
    }

    public static function getLabels(): array
    {
        return [
            self::EMAIL->getLabel(),
            self::DELIVERY->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::EMAIL->getLabel()],
            ['id' => 2, 'name' => self::DELIVERY->getLabel()],
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::EMAIL => 'info',
            self::DELIVERY => 'indigo',
        };
    }
}
