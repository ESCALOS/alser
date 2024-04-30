<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ClaimTypeEnum: int implements HasColor, HasLabel
{
    case COMPLAINT = 1;
    case CLAIM = 2;

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::COMPLAINT => 'Queja',
            self::CLAIM => 'Reclamo',
        };
    }

    public static function getLabels(): array
    {
        return [
            self::COMPLAINT->getLabel(),
            self::CLAIM->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::COMPLAINT->getLabel()],
            ['id' => 0, 'name' => self::CLAIM->getLabel()],
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::COMPLAINT => 'info',
            self::CLAIM => 'indigo',
        };
    }
}
