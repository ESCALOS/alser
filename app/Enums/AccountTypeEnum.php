<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum AccountTypeEnum: string implements HasColor, HasLabel
{
    case PERSONAL = 'Personal';
    case BUSINESS = 'Empresarial';

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
            self::PERSONAL,
            self::BUSINESS,
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::PERSONAL->value],
            ['id' => 2, 'name' => self::BUSINESS->value],
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
            self::PERSONAL => 'info',
            self::BUSINESS => 'indigo',
        };
    }

    public static function getSelfById(int $id): ?self
    {
        return match ($id) {
            1 => self::PERSONAL,
            2 => self::BUSINESS,
            default => null,
        };
    }
}
