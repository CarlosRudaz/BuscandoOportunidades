<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

enum TipoActividad
{
    case A_DOMICILIO;
    case EN_EL_DIA;
    case JORNAL;
    case QUINCENA;
    case MENSUAL;

    public static function in_randomOrder()
    {
        $todos = self::todosLosTipos();
        shuffle($todos);
        return $todos;
    }

    public static function todosLosTipos(): array
    {
        return self::cases();
    }

    public static function getJornal(): TipoActividad
    {
        return self::JORNAL;
    }

    public static function getMensual(): TipoActividad
    {
        return self::MENSUAL;
    }
}
