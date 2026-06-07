<?php

namespace App\Enums;

/**
 * Tamaños de combos disponibles en Bocaditos Criollos.
 */
enum ComboSize: string
{
    case Tradicional = 'tradicional';
    case Bocado = 'bocado';
    case Adiciones = 'adiciones';

    /**
     * Retorna la etiqueta legible para cada tamaño.
     */
    public function label(): string
    {
        return match ($this) {
            self::Tradicional => 'Tradicional',
            self::Bocado      => 'Bocado',
            self::Adiciones   => 'Adición',
        };
    }

    /**
     * Retorna el emoji representativo para cada tamaño.
     */
    public function emoji(): string
    {
        return match ($this) {
            self::Tradicional => '🥟',
            self::Bocado      => '🌮',
            self::Adiciones   => '🥤',
        };
    }

    /**
     * Retorna todos los valores válidos como array de strings.
     *
     * @return string[]
     */
    public static function values(): array
    {
        return array_map(fn (self $case) => $case->value, self::cases());
    }

    /**
     * Valida si un string dado es un tamaño de combo válido.
     */
    public static function isValid(?string $value): bool
    {
        if ($value === null) {
            return true;
        }

        return in_array($value, self::values(), true);
    }
}
