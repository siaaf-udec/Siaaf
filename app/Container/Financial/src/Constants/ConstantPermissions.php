<?php

namespace App\Container\Financial\src\Constants;


class ConstantPermissions
{
    /*
     * -----------------------------------------
     *
     * Financial Module
     *
     * -----------------------------------------
     */
    const FINANCIAL_MODULE      =       'FINANCIAL_MODULE';

    /*
     * -----------------------------------------
     *
     * Resource Management
     *
     * Programs
     * Subjects
     * Costs
     * Status
     * File Type
     * Available Modules
     *
     * -----------------------------------------
     */

    const RESOURCE_MANAGEMENT   =       'FINANCIAL_RESOURCE_MANAGEMENT_MODULE';
    const PROGRAMS              =       'FINANCIAL_PROGRAMS_MANAGEMENT_MODULE';
    const SUBJECTS              =       'FINANCIAL_SUBJECTS_MANAGEMENT_MODULE';
    const COSTS                 =       'FINANCIAL_COSTS_MANAGEMENT_MODULE';
    const STATUS                =       'FINANCIAL_STATUS_MANAGEMENT_MODULE';
    const FILE_TYPE             =       'FINANCIAL_FILE_TYPE_MANAGEMENT_MODULE';
    const AVAILABLE_MODULES     =       'FINANCIAL_AVAILABLE_MODULES_MANAGEMENT_MODULE';

    /*
     * -----------------------------------------
     *
     * Files Management
     *
     * Upload Files
     * Approve Files
     *
     * -----------------------------------------
     */

    const FILES_MANAGEMENT      =       'FINANCIAL_FILE_MANAGEMENT_MODULE';
    const UPLOAD_FILES          =       'FINANCIAL_UPLOAD_FILES_MANAGEMENT_MODULE';
    const APPROVE_FILES         =       'FINANCIAL_APPROVE_FILES_MANAGEMENT_MODULE';

    /*
     * -----------------------------------------
     *
     * Requests Management
     *
     * Extension
     * Validation
     * Addition and Subtraction Subjects
     * Intersemestral
     *
     * -----------------------------------------
     */

    const REQUESTS_MANAGEMENT   =       'FINANCIAL_REQUESTS_MANAGEMENT_MODULE';
    const EXTENSION             =       'FINANCIAL_EXTENSION_MANAGEMENT_MODULE';
    const VALIDATION            =       'FINANCIAL_VALIDATION_MANAGEMENT_MODULE';
    const ADD_SUB_SUBJECTS      =       'FINANCIAL_ADDITION_SUBTRACTION_MANAGEMENT_MODULE';
    const INTERSEMESTRAL        =       'FINANCIAL_INTERSEMESTRAL_MANAGEMENT_MODULE';

    /*
     * -----------------------------------------
     *
     * Approvals Management
     *
     * Extension
     * Validation
     * Addition and Subtraction Subjects
     * Intersemestral
     *
     * -----------------------------------------
     */

    const APPROVALS_MANAGEMENT           =       'FINANCIAL_APPROVALS_MANAGEMENT_MODULE';
    const EXTENSION_APPROVAL             =       'FINANCIAL_EXTENSION_APPROVAL_MANAGEMENT_MODULE';
    const VALIDATION_APPROVAL            =       'FINANCIAL_VALIDATION_APPROVAL_MANAGEMENT_MODULE';
    const ADD_SUB_SUBJECTS_APPROVAL      =       'FINANCIAL_ADDITION_APPROVAL_SUBTRACTION_MANAGEMENT_MODULE';
    const INTERSEMESTRAL_APPROVAL        =       'FINANCIAL_INTERSEMESTRAL_APPROVAL_MANAGEMENT_MODULE';

    /*
     * -----------------------------------------
     *
     * Financial
     *
     * Petty Cash
     * Checks
     *
     * -----------------------------------------
     */
    const PETTY_CASH                    =       'FINANCIAL_PETTY_CASH_MODULE';
    const CHECKS                        =       'FINANCIAL_CHECKS_MODULE';

    /**
     * Retrieve an array with all ordered permissions
     *
     * @return array
     */
    public static function permissions()
    {
        return [
            'financial_module'          =>  [
                'name'          =>  self::FINANCIAL_MODULE,
                'display_name'  =>  'Módulo Financiero',
                'description'   =>  'Permite acceder a las herramientas del módulo financero.',
            ],
            'resource_management'       =>  [
                'name'          =>  self::RESOURCE_MANAGEMENT,
                'display_name'  =>  'Gestión de Recursos',
                'description'   =>  'Permite acceder a las herramientas de gestión de recursos del módulo financero.',
                'submodules'    =>  [
                    'programs'      =>  [
                        'name'          =>  self::PROGRAMS,
                        'display_name'  =>  'Gestión de Programas',
                        'description'   =>  'Permite acceder a las herramientas de gestión de programas del módulo financero.',
                    ],
                    'subjects'      =>  [
                        'name'          =>  self::SUBJECTS,
                        'display_name'  =>  'Gestión de Materias',
                        'description'   =>  'Permite acceder a las herramientas de gestión de materias del módulo financero.',
                    ],
                    'costs'         =>  [
                        'name'          =>  self::COSTS,
                        'display_name'  =>  'Gestión de Costos',
                        'description'   =>  'Permite acceder a las herramientas de gestión de costos del módulo financero.',
                    ],
                    'status'        =>  [
                        'name'          =>  self::STATUS,
                        'display_name'  =>  'Gestión de Estados',
                        'description'   =>  'Permite acceder a las herramientas de gestión de estados del módulo financero.',
                    ],
                    'file_types'    =>  [
                        'name'          =>  self::FILE_TYPE,
                        'display_name'  =>  'Gestión de Tipos de Archivos',
                        'description'   =>  'Permite acceder a las herramientas de gestión de tipos de archivos del módulo financero.',
                    ],
                    'available_module'    =>  [
                        'name'          =>  self::AVAILABLE_MODULES,
                        'display_name'  =>  'Gestión de Disponibilidad de Módulos',
                        'description'   =>  'Permite acceder a las herramientas de gestión de fechas disponibles para uso de cada módulo financiaro.',
                    ],
                ]
            ],
            'files_management'          =>  [
                'name'          =>  self::FILES_MANAGEMENT,
                'display_name'  =>  'Gestión de Archivos',
                'description'   =>  'Permite acceder a las herramientas de gestión de archivos del módulo financero.',
                'submodules'    =>  [
                    'upload_files'      =>  [
                        'name'          =>  self::UPLOAD_FILES,
                        'display_name'  =>  'Gestión de Carga de Archivos',
                        'description'   =>  'Permite acceder a las herramientas de gestión de carga de archivos del módulo financero.',
                    ],
                    'approve_files'     =>  [
                        'name'          =>  self::APPROVE_FILES,
                        'display_name'  =>  'Gestión de Aprobación de Archivos',
                        'description'   =>  'Permite acceder a las herramientas de gestión de aprobación de archivos del módulo financero.',
                    ],
                ]
            ],
            'request_management'        =>  [
                'name'          =>  self::REQUESTS_MANAGEMENT,
                'display_name'  =>  'Gestión de Solicitudes',
                'description'   =>  'Permite acceder a las herramientas de gestión de aprobación de solicitudes del módulo financero.',
                'submodules'    =>  [
                    'extension'         =>  [
                        'name'          =>  self::EXTENSION,
                        'display_name'  =>  'Gestión de Supletorios',
                        'description'   =>  'Permite acceder a las herramientas de gestión de supletorios del módulo financero.',
                    ],
                    'validation'        =>  [
                        'name'          =>  self::VALIDATION,
                        'display_name'  =>  'Gestión de Validaciones',
                        'description'   =>  'Permite acceder a las herramientas de gestión de validaciones del módulo financero.',
                    ],
                    'add_sub'           =>  [
                        'name'          =>  self::ADD_SUB_SUBJECTS,
                        'display_name'  =>  'Gestión de Adición o Cancelación de Materias',
                        'description'   =>  'Permite acceder a las herramientas de gestión de adición o cancelación de materias del módulo financero.',
                    ],
                    'intersemestral'           =>  [
                        'name'          =>  self::INTERSEMESTRAL,
                        'display_name'  =>  'Gestión de Intersemestrales',
                        'description'   =>  'Permite acceder a las herramientas de gestión de intersemestrales del módulo financero.',
                    ],
                ]
            ],
            'approval_management'       =>  [
                'name'          =>  self::APPROVALS_MANAGEMENT,
                'display_name'  =>  'Gestión de Solicitudes',
                'description'   =>  'Permite acceder a las herramientas de gestión de solicitudes del módulo financero.',
                'submodules'    =>  [
                    'extension'         =>  [
                        'name'          =>  self::EXTENSION_APPROVAL,
                        'display_name'  =>  'Gestión de Aprobaciones de Supletorios',
                        'description'   =>  'Permite acceder a las herramientas de gestión aprobaciones de de supletorios del módulo financero.',
                    ],
                    'validation'        =>  [
                        'name'          =>  self::VALIDATION_APPROVAL,
                        'display_name'  =>  'Gestión de Aprobaciones de Validaciones',
                        'description'   =>  'Permite acceder a las herramientas de gestión aprobaciones de de validaciones del módulo financero.',
                    ],
                    'add_sub'           =>  [
                        'name'          =>  self::ADD_SUB_SUBJECTS_APPROVAL,
                        'display_name'  =>  'Gestión de Aprobaciones de Adición o Cancelación de Materias',
                        'description'   =>  'Permite acceder a las herramientas de gestión de aprobaciones de adición o cancelación de materias del módulo financero.',
                    ],
                    'intersemestral'           =>  [
                        'name'          =>  self::INTERSEMESTRAL_APPROVAL,
                        'display_name'  =>  'Gestión de Aprobaciones de Intersemestrales',
                        'description'   =>  'Permite acceder a las herramientas de gestión de aprobaciones de intersemestrales del módulo financero.',
                    ],
                ]
            ],
            'petty_cash'                =>  [
                'name'          =>  self::PETTY_CASH,
                'display_name'  =>  'Gestion de Caja Menor',
                'description'   =>  'Permite acceder a las herramientas de gestión de caja menor del módulo financiero.',
            ],
            'checks'                    =>  [
                'name'          =>  self::CHECKS,
                'display_name'  =>  'Gestion de Cheques',
                'description'   =>  'Permite acceder a las herramientas de gestión de cheques del módulo financiero.',
            ],
        ];
    }

    /**
     * Get permissions attributes for modules and submodules
     *
     * @param null $permission
     * @param null $submodule
     * @return mixed
     */
    public static function getModulePermission( $permission, $submodule = null )
    {
        $array = self::permissions();
        if ( isset( $permission ) && isset( $submodule ) ) {
            return isset( $array[ $permission ]['submodules'][ $submodule ] ) ?
                          $array[ $permission ]['submodules'][ $submodule ] :
                          [];
        } elseif ( isset( $permission ) && !isset( $submodule ) ) {
            return isset( $array[ $permission ] ) ? $array[ $permission ] : [];
        } else {
            return $array;
        }
    }
}