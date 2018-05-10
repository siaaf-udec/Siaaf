<?php

namespace App\Container\Financial\src\Constants;


class ConstantStatus
{

    const SENT              =   'ENVIADO';
    const APPROVED          =   'APROBADO';
    const PENDING           =   'PENDIENTE';
    const REJECTED          =   'RECHAZADO';
    const WAITING_PAY       =   'EN ESPERA DE PAGO';
    const PAID              =   'PAGADO';
    const CANCELED          =   'CANCELADO';
    const WAITING_QUOTA     =   'EN ESPERA DE COMPLETAR CUPO MÍNIMO';
    const WAITING_MIN_PAY   =   'EN ESPERA DE COMPLETAR PAGO MÍNIMO';
    const CHECKING          =   'EN REVISIÓN';

    const EXTENSION             =   'EXTENSION';
    const ADD_REMOVE_SUBJECTS   =   'ADD_REMOVE_SUBJECTS';
    const FILE                  =   'FILE';
    const INTERSEMESTER         =   'INTERSEMESTER';
    const VALIDATION            =   'VALIDATION';

    /**
     * Retrieve an array with status
     *
     * @param $type
     * @return array
     */
    public static function general( $type )
    {
        return [
            [
                status_name()   =>  self::SENT,
                status_type()   =>  $type
            ],
            [
                status_name()   =>  self::APPROVED,
                status_type()   =>  $type
            ],
            [
                status_name()   =>  self::REJECTED,
                status_type()   =>  $type
            ],
            [
                status_name()   =>  self::WAITING_PAY,
                status_type()   =>  $type
            ],
            [
                status_name()   =>  self::PAID,
                status_type()   =>  $type
            ],
            [
                status_name()   =>  self::CANCELED,
                status_type()   =>  $type
            ],
        ];
    }

    /**
     * Return extension status
     * 
     * @return array
     */
    public static function extension()
    {
        return self::general( self::EXTENSION );
    }

    /**
     * Return validation status
     * 
     * @return array
     */
    public static function validation()
    {
        return self::general( self::VALIDATION );
    }

    /**
     * Return addition subtraction status
     *
     * @return array
     */
    public static function additionSubtraction()
    {
        return self::general( self::ADD_REMOVE_SUBJECTS );
    }

    /**
     * Return file status
     *
     * @return array
     */
    public static function file()
    {
        return [
            [
                status_name()   =>  self::APPROVED,
                status_type()   =>  self::FILE
            ],
            [
                status_name()   =>  self::CANCELED,
                status_type()   =>  self::FILE
            ],
            [
                status_name()   =>  self::CHECKING,
                status_type()   =>  self::FILE
            ],
            [
                status_name()   =>  self::SENT,
                status_type()   =>  self::FILE
            ],
            [
                status_name()   =>  self::REJECTED,
                status_type()   =>  self::FILE
            ]
        ];
    }

    /**
     * Return intersemestral status
     *
     * @return array
     */
    public static function intersemestral()
    {
        return [
            [
                status_name()   =>  self::APPROVED,
                status_type()   =>  self::INTERSEMESTER
            ],
            [
                status_name()   =>  self::CANCELED,
                status_type()   =>  self::INTERSEMESTER
            ],
            [
                status_name()   =>  self::WAITING_QUOTA,
                status_type()   =>  self::INTERSEMESTER
            ],
            [
                status_name()   =>  self::WAITING_MIN_PAY,
                status_type()   =>  self::INTERSEMESTER
            ],
        ];
    }

    /**
     * Return all status
     *
     * @return array
     */
    public static function all()
    {
        return array_merge( self::extension(), self::validation(), self::additionSubtraction(), self::file(), self::intersemestral() );
    }
}