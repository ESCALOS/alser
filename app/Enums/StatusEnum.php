<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasColor, HasLabel
{
    case PENDING = 'Pendiente';
    case IN_PROGRESS = 'En progreso';
    case COMPLETED = 'Completado';
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
            self::PENDING,
            self::IN_PROGRESS,
            self::COMPLETED,
            self::REJECT,
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 'P', 'name' => self::PENDING->value],
            ['id' => 'IP', 'name' => self::IN_PROGRESS->value],
            ['id' => 'C', 'name' => self::COMPLETED->value],
            ['id' => 'R', 'name' => self::REJECT->value],
        ];
    }

    public static function getValueById(string $id): string
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
            self::PENDING => 'danger',
            self::IN_PROGRESS => 'warning',
            self::COMPLETED => 'success',
            self::REJECT => 'gray'
        };
    }

    public static function getSelfById(string $id): ?self
    {
        return match ($id) {
            'P' => self::PENDING,
            'IP' => self::IN_PROGRESS,
            'C' => self::COMPLETED,
            'R' => self::REJECT,
            default => null,
        };
    }
}
