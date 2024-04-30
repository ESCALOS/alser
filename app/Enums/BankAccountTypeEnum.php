<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum BankAccountTypeEnum: int implements HasColor, HasLabel
{
    case SAVING = 1;
    case CHECKING = 2;

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::SAVING => 'Ahorros',
            self::CHECKING => 'Corriente'
        };
    }

    public static function getLabels(): array
    {
        return [
            self::SAVING->getLabel(),
            self::SAVING->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::SAVING->getLabel()],
            ['id' => 2, 'name' => self::CHECKING->getLabel()],
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::SAVING => 'info',
            self::CHECKING => 'indigo',
        };
    }
}
