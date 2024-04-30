<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum DocumentTypeEnum: int implements HasColor, HasLabel
{
    case ID = 1;
    case TAX_NUMBER = 2;
    case FOREIGN_CARD = 3;
    case PASSPORT = 4;

    /**
     * Devuelve el tipo de documento
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::TAX_NUMBER => 'RUC',
            self::ID => 'DNI',
            self::FOREIGN_CARD => 'Carnét de Extranjería',
            self::PASSPORT => 'Pasaporte',
        };
    }

    public static function getLabels(): array
    {
        return [
            self::ID->getLabel(),
            self::TAX_NUMBER->getLabel(),
            self::FOREIGN_CARD->getLabel(),
            self::PASSPORT->getLabel(),
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::ID->getLabel()],
            ['id' => 2, 'name' => self::TAX_NUMBER->getLabel()],
            ['id' => 3, 'name' => self::FOREIGN_CARD->getLabel()],
            ['id' => 4, 'name' => self::PASSPORT->getLabel()],
        ];
    }

    public static function getChoicesExceptRuc(): array
    {
        return [
            ['id' => 1, 'name' => self::ID->getLabel()],
            ['id' => 3, 'name' => self::FOREIGN_CARD->getLabel()],
            ['id' => 4, 'name' => self::PASSPORT->getLabel()],
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::ID => 'info',
            self::TAX_NUMBER => 'warning',
            self::FOREIGN_CARD => 'primary',
            self::PASSPORT => 'secondary',
        };
    }

    /**
     * Valida si el número de documento tiene la longitud correcta según el tipo
     *
     * @param  string  $documentNumber  Número de documento
     */
    public function validateNumberLength(string $documentNumber): bool
    {
        switch ($this) {
            case self::ID:
                return ctype_digit($documentNumber) && strlen($documentNumber) === 8;
            case self::TAX_NUMBER:
                return ctype_digit($documentNumber) && strlen($documentNumber) === 11;
            case self::FOREIGN_CARD:
            case self::PASSPORT:
                return strlen($documentNumber) <= 12;
            default:
                return false;
        }
    }

    public static function validateNumberLengthStatic(string $documentType, string $documentNumber): bool
    {
        switch ($documentType) {
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
