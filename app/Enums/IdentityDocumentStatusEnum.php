<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum IdentityDocumentStatusEnum: string implements HasColor, HasLabel
{
    case PENDING = 'No hay';
    case UPLOADED = 'Pendiente en validar';
    case VALIDATED = 'Validado';
    case REJECTED = 'Rechazado';

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return $this->value;
    }

    public static function getLabels(): array
    {
        return [
            self::PENDING,
            self::UPLOADED,
            self::VALIDATED,
            self::REJECTED,
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::PENDING->value],
            ['id' => 2, 'name' => self::UPLOADED->value],
            ['id' => 3, 'name' => self::VALIDATED->value],
            ['id' => 4, 'name' => self::REJECTED->value],
        ];
    }

    public static function getValueById(int $id): string
    {
        $choices = self::getChoices();

        foreach ($choices as $choice) {
            if ($choice['id'] === $id) {
                return $choice['name'];
            }
        }

        return null;
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

    public static function getSelfById(int $id): ?self
    {
        return match ($id) {
            1 => self::PENDING,
            2 => self::UPLOADED,
            3 => self::VALIDATED,
            4 => self::REJECTED,
            default => null,
        };
    }

    public static function getIdBySelf(self $self): ?int
    {
        return match ($self) {
            self::PENDING => 1,
            self::UPLOADED => 2,
            self::VALIDATED => 3,
            self::REJECTED => 4,
            default => null,
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
