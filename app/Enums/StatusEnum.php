<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasColor, HasLabel
{
    case PENDING = 'P';
    case IN_PROGRESS = 'IP';
    case COMPLETED = 'C';
    case REJECT = 'R';

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => 'Pendiente',
            self::IN_PROGRESS => 'En progreso',
            self::COMPLETED => 'Completado',
            self::REJECT => 'Rechazado'
        };
    }

    public static function getLabels(): array
    {
        return [
            self::PENDING->getLabel(),
            self::IN_PROGRESS->getLabel(),
            self::COMPLETED->getLabel(),
            self::REJECT->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 'P', 'name' => self::PENDING->getLabel()],
            ['id' => 'IP', 'name' => self::IN_PROGRESS->getLabel()],
            ['id' => 'C', 'name' => self::COMPLETED->getLabel()],
            ['id' => 'R', 'name' => self::REJECT->getLabel()],
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING => 'danger',
            self::IN_PROGRESS => 'warning',
            self::COMPLETED => 'success',
            self::REJECT => 'gray'
        };
    }
}
