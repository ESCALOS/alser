<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum AccountTypeEnum: int implements HasColor, HasLabel
{
    case PERSONAL = 1;
    case BUSINESS = 2;

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::PERSONAL => 'Personal',
            self::BUSINESS => 'Empresarial',
        };
    }

    public static function getLabels(): array
    {
        return [
            self::PERSONAL->getLabel(),
            self::BUSINESS->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::PERSONAL->getLabel()],
            ['id' => 2, 'name' => self::BUSINESS->getLabel()],
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PERSONAL => 'info',
            self::BUSINESS => 'indigo',
        };
    }
}
