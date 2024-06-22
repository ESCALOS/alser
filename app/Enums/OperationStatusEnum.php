<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OperationStatusEnum: int implements HasColor, HasLabel
{
    case PENDING = 1;
    case UPLOADED = 2;
    case VALIDATED = 3;
    case CANCELLED_BY_USER = 4;
    case CANCELLED_BY_SYSTEM = 5;
    case REJECTED = 6;
    case WITHOUT_OPERATION = 7;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => 'Pendiente en ejecutar',
            self::UPLOADED => '# Op. registrado',
            self::VALIDATED => 'Validado',
            self::CANCELLED_BY_USER => 'Cancelado por el usuario',
            self::CANCELLED_BY_SYSTEM => 'Cancelado por el sistema',
            self::REJECTED => 'Rechazado',
            self::WITHOUT_OPERATION => 'Sin Operación'
        };
    }

    public static function getLabels(): array
    {
        return [
            self::PENDING->getLabel(),
            self::UPLOADED->getLabel(),
            self::VALIDATED->getLabel(),
            self::CANCELLED_BY_USER->getLabel(),
            self::CANCELLED_BY_SYSTEM->getLabel(),
            self::REJECTED->getLabel(),
            self::WITHOUT_OPERATION->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::PENDING->getLabel()],
            ['id' => 2, 'name' => self::UPLOADED->getLabel()],
            ['id' => 3, 'name' => self::VALIDATED->getLabel()],
            ['id' => 4, 'name' => self::CANCELLED_BY_USER->getLabel()],
            ['id' => 5, 'name' => self::CANCELLED_BY_SYSTEM->getLabel()],
            ['id' => 6, 'name' => self::REJECTED->getLabel()],
            ['id' => 7, 'name' => self::WITHOUT_OPERATION->getLabel()],
        ];
    }

    public function getIcon()
    {
        return match ($this) {
            self::PENDING => 's-clock',
            self::UPLOADED => 'o-ellipsis-horizontal-circle',
            self::VALIDATED => 's-check-circle',
            self::CANCELLED_BY_USER => 's-x-circle',
            self::CANCELLED_BY_SYSTEM => 's-x-circle',
            self::REJECTED => 's-x-circle',
            self::WITHOUT_OPERATION => 's-x-circle'
        };
    }

    public function getIconColor()
    {
        return match ($this) {
            self::PENDING => 'text-gray-500',
            self::UPLOADED => 'text-gray-500',
            self::VALIDATED => 'text-lime-500',
            self::CANCELLED_BY_USER => 'text-red-500',
            self::CANCELLED_BY_SYSTEM => 'text-red-500',
            self::REJECTED => 'text-red-500',
            self::WITHOUT_OPERATION => 'text-gray-500'
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING => 'info',
            self::UPLOADED => 'warning',
            self::VALIDATED => 'success',
            self::CANCELLED_BY_USER => 'danger',
            self::CANCELLED_BY_SYSTEM => 'danger',
            self::REJECTED => 'danger',
            self::WITHOUT_OPERATION => 'info'
        };
    }

    public function getTextColorTailwind()
    {
        return match ($this) {
            self::PENDING => 'text-gray-500',
            self::UPLOADED => 'text-amber-500',
            self::VALIDATED => 'text-green-500',
            self::CANCELLED_BY_USER => 'text-red-500',
            self::CANCELLED_BY_SYSTEM => 'text-red-500',
            self::REJECTED => 'text-red-500',
            self::WITHOUT_OPERATION => 'text-gray-500'
        };
    }
}
