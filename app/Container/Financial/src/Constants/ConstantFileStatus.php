<?php

namespace App\Container\Financial\src\Constants;


class ConstantFileStatus
{
    const PENDING       = 0;
    const APPROVED      = 1;
    const REJECTED      = 2;

    /**
     * @return array
     */
    public static function getArrayForSelect()
    {
        return [
            self::PENDING   => self::getString( self::PENDING    ),
            self::APPROVED  => self::getString( self::APPROVED   ),
            self::REJECTED  => self::getString( self::REJECTED   ),
        ];
    }

    /**
     * @param null|string $key
     * @return string
     */
    public static function getString($key = null)
    {
        switch ($key) {
            case self::PENDING :
                return 'Pendiente de Revisíón';
                break;
            case self::APPROVED :
                return 'Aprobado';
                break;
            case self::REJECTED :
                return 'Rechazados';
                break;
            default:
                return 'Sin Clasificación';
                break;
        }
    }
}