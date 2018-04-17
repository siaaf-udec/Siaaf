<?php

namespace App\Container\Financial\src\Constants;


class ConstantAddSubSubject
{
    const ADD         = 0;
    const SUBTRACT    = 1;

    /**
     * @return array
     */
    public static function getArrayForSelect()
    {
        return [
            self::ADD       => self::getString( self::ADD        ),
            self::SUBTRACT  => self::getString( self::SUBTRACT   ),
        ];
    }

    /**
     * @param null|string $key
     * @return string
     */
    public static function getString($key = null)
    {
        switch ($key) {
            case self::ADD :
                return 'Adicionar Materia';
                break;
            case self::SUBTRACT :
                return 'Cancelar Materia';
                break;
            default:
                return 'Sin Clasificación';
                break;
        }
    }
}