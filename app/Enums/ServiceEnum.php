<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ServiceEnum: string implements HasColor, HasLabel
{
    case CAMBIO_MONEDA = 'Cambio de moneda online';
    case OTROS = 'Otro';

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
            self::CAMBIO_MONEDA,
            self::OTROS,
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::CAMBIO_MONEDA->value],
            ['id' => 2, 'name' => self::OTROS->value],
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

        return 'Value not found';
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::CAMBIO_MONEDA => 'info',
            self::OTROS => 'indigo',
        };
    }

    public static function getSelfById(int $id): ?self
    {
        return match ($id) {
            1 => self::CAMBIO_MONEDA,
            2 => self::OTROS,
            default => null,
        };
    }
}
