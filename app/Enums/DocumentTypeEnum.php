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

    public static function getLabels(): array
    {
        return [
            self::ID,
            self::TAX_NUMBER,
            self::FOREIGN_CARD,
            self::PASSPORT,
        ];
    }

    public static function getChoices(): array
    {
        return [
            ['id' => 1, 'name' => self::ID->value],
            ['id' => 2, 'name' => self::TAX_NUMBER->value],
            ['id' => 3, 'name' => self::FOREIGN_CARD->value],
            ['id' => 4, 'name' => self::PASSPORT->value],
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
            self::ID => 'info',
            self::TAX_NUMBER => 'warning',
            self::FOREIGN_CARD => 'primary',
            self::PASSPORT => 'secondary',
        };
    }

    public static function getSelfById(int $id): ?self
    {
        return match ($id) {
            1 => self::ID,
            2 => self::TAX_NUMBER,
            3 => self::FOREIGN_CARD,
            4 => self::PASSPORT,
            default => null,
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
