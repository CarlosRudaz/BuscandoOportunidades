<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static EMPRENDEDOR()
 * @method static static EMPLEADOR()
 * @method static static OPERADOR()
 * @method static static ADMINISTRADOR()
 * @method static static ROOT()
 *
 */
final class TiposUsuarios extends Enum
{
    const EMPRENDEDOR       = 0;
    const EMPLEADOR         = 1;
    const OPERADOR          = 2;
    const ADMINISTRADOR     = 3;
    const ROOT              = 99;

    /**
     * Tipos de usuarios que se pueden registrar manualmente
     * @var array
     */
    public static array $REGISTRABLE = [
        self::ADMINISTRADOR,
        self::OPERADOR,
    ];

    public static array $ADMIN_GROUP = [
        self::ADMINISTRADOR,
        self::ROOT
    ];

    public function isAdmin():bool
    {
        return in_array($this->value, TiposUsuarios::$ADMIN_GROUP);
    }

    public function isOperador():bool
    {
        return $this->value === self::OPERADOR;
    }

    public function isEmprendedor():bool
    {
        return $this->value === self::EMPRENDEDOR;
    }

    public function isSuperUser(): bool
    {
        return $this->value === self::ROOT;
    }

    public static function getRandomValue(): mixed
    {
        $value = parent::getRandomValue();
        return is_array($value) ? self::getRandomValue() : $value;
    }
}
