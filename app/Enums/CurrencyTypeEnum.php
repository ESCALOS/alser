<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum CurrencyTypeEnum: string implements HasColor, HasLabel
{
    case SOL = 'SOLES';
    case DOLLAR = 'DÓLARES';

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
            self::SOL,
            self::DOLLAR,
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::SOL->value],
            ['id' => 2, 'name' => self::DOLLAR->value],
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
            self::SOL => 'info',
            self::DOLLAR => 'indigo',
        };
    }

    public static function getSelfById(int $id): ?self
    {
        return match ($id) {
            1 => self::SOL,
            2 => self::DOLLAR,
            default => null,
        };
    }
}
