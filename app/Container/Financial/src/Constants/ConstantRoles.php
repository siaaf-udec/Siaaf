<?php

namespace App\Container\Financial\src\Constants;


class ConstantRoles
{

    const FINANCIAL_ADMIN_ROLE      = 'financial_administrator';
    const FINANCIAL_TEACHER_ROLE    = 'financial_teacher';
    const FINANCIAL_STUDENT_ROLE    = 'financial_student';
    const FINANCIAL_SECRETARY_ROLE  = 'financial_secretary';


    /**
     * Return an array with roles names
     *
     * @return array
     */
    public static function getRoleNames()
    {
        return [
            1 => self::FINANCIAL_ADMIN_ROLE,
            2 => self::FINANCIAL_TEACHER_ROLE,
            3 => self::FINANCIAL_STUDENT_ROLE,
            4 => self::FINANCIAL_SECRETARY_ROLE,
        ];
    }

    /**
     * Return the roles array tu use in Seeders
     *
     * @return array
     */
    public static function getRoles()
    {
        return [
          [
              'name' => self::FINANCIAL_ADMIN_ROLE,
              'display_name' => 'Financiero',
              'description' => 'Acceso administrativo al Módulo Financiero.',
          ], [
              'name' => self::FINANCIAL_TEACHER_ROLE,
              'display_name' => 'Docente',
              'description' => 'Acceso administrativo al Módulo Financiero.',
          ], [
              'name' => self::FINANCIAL_STUDENT_ROLE,
              'display_name' => 'Estudiante',
              'description' => 'Acceso a solicitudes del Módulo Financiero.',
          ], [
              'name' => self::FINANCIAL_SECRETARY_ROLE,
              'display_name' => 'Secretaria',
              'description' => 'Acceso administrativo al Módulo Financiero.',
          ],
        ];
    }
}