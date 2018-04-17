<?php

namespace App\Container\Financial\src\Constants;


class ConstantIntersemestralStatus
{
    const WAITING_QUOTA = 0;
    const WAITING_PAY   = 1;
    const PAID          = 2;
    const APPROVED      = 3;
    const REJECTED      = 4;

    /**
     * @return array
     */
    public static function getArrayForSelect()
    {
        return [
            self::WAITING_QUOTA => self::getString( self::WAITING_QUOTA ),
            self::WAITING_PAY   => self::getString( self::WAITING_PAY   ),
            self::PAID          => self::getString( self::PAID          ),
            self::APPROVED      => self::getString( self::APPROVED      ),
            self::REJECTED      => self::getString( self::REJECTED      ),
        ];
    }

    /**
     * @param null|string $key
     * @return string
     */
    public static function getString($key = null)
    {
        switch ($key) {
            case self::WAITING_QUOTA :
                return 'En espera de completar cupo mínimo requerido';
                break;
            case self::WAITING_PAY :
                return 'En espera de pago mínimo requerido';
                break;
            case self::PAID :
                return 'Pagado';
                break;
            case self::APPROVED :
                return 'Aprobado';
                break;
            case self::REJECTED :
                return 'Rechazado';
                break;
            default:
                return 'Sin Clasificación';
                break;
        }
    }
}