<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PdfPEPStatusEnum: int implements HasColor, HasLabel
{
    case PENDING = 1;
    case UPLOADED = 2;
    case VALIDATED = 3;
    case REJECTED = 4;

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => 'Sin documento',
            self::UPLOADED => 'Pendiente en validar',
            self::VALIDATED => 'Validado',
            self::REJECTED => 'Rechazado'
        };
    }

    public static function getLabels(): array
    {
        return [
            self::PENDING->getLabel(),
            self::UPLOADED->getLabel(),
            self::VALIDATED->getLabel(),
            self::REJECTED->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::PENDING->getLabel()],
            ['id' => 2, 'name' => self::UPLOADED->getLabel()],
            ['id' => 3, 'name' => self::VALIDATED->getLabel()],
            ['id' => 4, 'name' => self::REJECTED->getLabel()],
        ];
    }

    public function getIcon()
    {
        return match ($this) {
            self::PENDING => 'm-clock',
            self::UPLOADED => 'm-clock',
            self::VALIDATED => 'm-check-circle',
            self::REJECTED => 'm-x-mark-circle',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING => 'info',
            self::UPLOADED => 'warning',
            self::VALIDATED => 'success',
            self::REJECTED => 'danger',
        };
    }

    public function getTextColorTailwind()
    {
        return match ($this) {
            self::PENDING => 'text-gray-500',
            self::UPLOADED => 'text-amber-500',
            self::VALIDATED => 'text-green-500',
            self::REJECTED => 'text-red-500'
        };
    }
}
