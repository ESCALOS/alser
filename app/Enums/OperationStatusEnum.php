<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OperationStatusEnum: int implements HasColor, HasLabel
{
    case PENDING = 1;
    case UPLOADED = 2;
    case VALIDATED = 3;
    case REJECTED_BY_USER = 4;
    case REJECTED_BY_SYSTEM = 5;
    case WITHOUT_OPERATION = 6;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => 'Pendiente en ejecutar',
            self::UPLOADED => 'Voucher subido',
            self::VALIDATED => 'Validado',
            self::REJECTED_BY_USER => 'Cancelado por el usuario',
            self::REJECTED_BY_SYSTEM => 'Cancelado por el sistema',
            self::WITHOUT_OPERATION => 'Sin Operación'
        };
    }

    public static function getLabels(): array
    {
        return [
            self::PENDING->getLabel(),
            self::UPLOADED->getLabel(),
            self::VALIDATED->getLabel(),
            self::REJECTED_BY_USER->getLabel(),
            self::REJECTED_BY_SYSTEM->getLabel(),
            self::WITHOUT_OPERATION->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::PENDING->getLabel()],
            ['id' => 2, 'name' => self::UPLOADED->getLabel()],
            ['id' => 3, 'name' => self::VALIDATED->getLabel()],
            ['id' => 4, 'name' => self::REJECTED_BY_USER->getLabel()],
            ['id' => 5, 'name' => self::REJECTED_BY_SYSTEM->getLabel()],
            ['id' => 6, 'name' => self::WITHOUT_OPERATION->getLabel()],
        ];
    }

    public function getIcon()
    {
        return match ($this) {
            self::PENDING => 'm-clock',
            self::UPLOADED => 'm-clock',
            self::VALIDATED => 'm-check-circle',
            self::REJECTED_BY_USER => 'm-x-mark-circle',
            self::REJECTED_BY_SYSTEM => 'm-x-mark-circle',
            self::WITHOUT_OPERATION => 'm-x-mark-circle'
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING => 'info',
            self::UPLOADED => 'warning',
            self::VALIDATED => 'success',
            self::REJECTED_BY_USER => 'danger',
            self::REJECTED_BY_SYSTEM => 'danger',
            self::WITHOUT_OPERATION => 'info'
        };
    }

    public function getTextColorTailwind()
    {
        return match ($this) {
            self::PENDING => 'text-gray-500',
            self::UPLOADED => 'text-amber-500',
            self::VALIDATED => 'text-green-500',
            self::REJECTED_BY_USER => 'text-red-500',
            self::REJECTED_BY_SYSTEM => 'text-red-500',
            self::WITHOUT_OPERATION => 'text-gray-500'
        };
    }
}
