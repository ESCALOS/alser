<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum DocumentTypeEnum: string implements HasColor, HasLabel
{
    case TAX_NUMBER = 'RUC';
    case ID = 'DNI';
    case FOREIGN_CARD = 'Carnét de Extranjería';
    case PASSPORT = 'Pasaporte';

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getLabels(): array
    {
        return [
            self::ID,
            self::TAX_NUMBER,
            self::FOREIGN_CARD,
            self::PASSPORT,
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::ID => 'info',
            self::FOREIGN_CARD => 'indigo',
        };
    }

    /**
     * Valida si el número de documento tiene la longitud correcta según el tipo
     *
     * @param  string  $documentNumber  Número de documento
     */
    public function validateNumberDigits(string $documentNumber): bool
    {
        switch ($this) {
            case self::ID:
                return strlen($documentNumber) === 8;
            case self::TAX_NUMBER:
                return strlen($documentNumber) === 11;
            case self::FOREIGN_CARD:
            case self::PASSPORT:
                return strlen($documentNumber) <= 12;
            default:
                return false;
        }
    }
}
