<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ClaimTypeEnum: string implements HasColor, HasLabel
{
    case COMPLAINT = 'Queja';
    case CLAIM = 'Reclamo';

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
            self::COMPLAINT,
            self::CLAIM,
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::COMPLAINT->value],
            ['id' => 0, 'name' => self::CLAIM->value],
        ];
    }

    public static function getValueById(bool $id): string
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
            self::COMPLAINT => 'info',
            self::CLAIM => 'indigo',
        };
    }

    public static function getSelfById(int $id): ?self
    {
        return match ($id) {
            true => self::COMPLAINT,
            false => self::CLAIM,
            default => null,
        };
    }
}
