<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum IdentityDocumentStatusEnum: string implements HasColor, HasLabel
{
    case PENDING = 'Pendiente';
    case UPLOADED = 'Subido';
    case VALIDATED = 'Validado';
    case REJECT = 'Rechazado';

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
            self::UPLOADED,
            self::PENDING,
            self::VALIDATED,
            self::REJECT,
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::UPLOADED->value],
            ['id' => 2, 'name' => self::PENDING->value],
            ['id' => 3, 'name' => self::VALIDATED->value],
            ['id' => 4, 'name' => self::REJECT->value],
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
            self::UPLOADED => 'info',
            self::PENDING => 'warning',
            self::VALIDATED => 'primary',
            self::REJECT => 'secondary',
        };
    }

    public static function getSelfById(int $id): ?self
    {
        return match ($id) {
            1 => self::UPLOADED,
            2 => self::PENDING,
            3 => self::VALIDATED,
            4 => self::REJECT,
            default => null,
        };
    }
}
