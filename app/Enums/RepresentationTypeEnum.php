<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum RepresentationTypeEnum: int implements HasColor, HasLabel
{
    case PODER = 1;
    case MANDATO = 2;
    case REGISTRAL = 3;

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::PODER => 'Poder',
            self::MANDATO => 'Mandato',
            self::REGISTRAL => 'Registral'
        };
    }

    public static function getLabels(): array
    {
        return [
            self::PODER->getLabel(),
            self::MANDATO->getLabel(),
            self::REGISTRAL->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::PODER->getLabel()],
            ['id' => 2, 'name' => self::MANDATO->getLabel()],
            ['id' => 3, 'name' => self::REGISTRAL->getLabel()],
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PODER => 'info',
            self::MANDATO => 'indigo',
            self::REGISTRAL => 'warning'
        };
    }
}
