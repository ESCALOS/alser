<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TransactionTypeEnum: int implements HasColor, HasLabel
{
    case PURCHASE = 1;
    case SALE = 2;

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::PURCHASE => 'Compra',
            self::SALE => 'Venta',
        };
    }

    public static function getLabels(): array
    {
        return [
            self::PURCHASE->getLabel(),
            self::SALE->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::PURCHASE->getLabel()],
            ['id' => 2, 'name' => self::SALE->getLabel()],
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PURCHASE => 'success',
            self::SALE => 'warning',
        };
    }
}
