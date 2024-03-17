<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ResponseMediumEnum: string implements HasColor, HasLabel
{
    case EMAIL = 'Correo Electrónico';
    case DELIVERY = 'Entrega a domicilio';

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
            self::EMAIL,
            self::DELIVERY,
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::EMAIL->value],
            ['id' => 2, 'name' => self::DELIVERY->value],
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
            self::EMAIL => 'info',
            self::DELIVERY => 'indigo',
        };
    }

    public static function getSelfById(int $id): ?self
    {
        return match ($id) {
            1 => self::EMAIL,
            2 => self::DELIVERY,
            default => null,
        };
    }
}
