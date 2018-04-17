<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 11/10/17
 * Time: 11:33 AM
 */

namespace App\Container\Financial\src\Constants;


class ConstantLabelClasses
{

    const SUCCESS_CLASS   = 'success';
    const INFO_CLASS      = 'info';
    const WARNING_CLASS   = 'warning';
    const DANGER_CLASS    = 'danger';
    const DEFAULT_CLASS   = 'default';

    /**
     * @param $state
     * @return string
     */
    public static function className($state)
    {
        switch ($state) {
            case 'RECHAZADO' :
                return self::WARNING_CLASS;
                break;
            case 'EN ESPERA DE PAGO' :
                return self::WARNING_CLASS;
                break;
            case 'EN ESPERA DE COMPLETAR PAGO MÍNIMO' :
                return self::WARNING_CLASS;
                break;
            case 'APROBADO' :
                return self::SUCCESS_CLASS;
                break;
            case 'PAGADO' :
                return self::SUCCESS_CLASS;
                break;
            case 'PENDIENTE' :
                return self::INFO_CLASS;
                break;
            case 'EN ESPERA DE COMPLETAR CUPO MÍNIMO' :
                return self::INFO_CLASS;
                break;
            case 'EN REVISIÓN' :
                return self::INFO_CLASS;
                break;
            case 'CANCELADO' :
                return self::DANGER_CLASS;
                break;
            default:
                return self::DEFAULT_CLASS;
                break;
        };
    }
}