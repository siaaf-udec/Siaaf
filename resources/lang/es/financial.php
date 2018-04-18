<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Validation Language Lines
      |--------------------------------------------------------------------------
      |
      | The following language lines contain the default error messages used by
      | the validator class. Some of these rules have multiple versions such
      | such as the size rules. Feel free to tweak each of these messages.
      |
      */
    'management'    =>  [
        'programs'  => [
            'title' =>  '| Gestión de Programas',
            'index' => [
                'title'         => 'Programas',
                'description'   => 'gestión de programas de la universidad.',
            ],
            'create'=> [
                'title'         => 'Crear Programa',
                'description'   => 'añadir nuevo programas a la universidad.',
            ],
            'table' => [
                'program_name'  =>  'Nombre del Programa',
                'actions'       =>  'Acciones',
            ]
        ],
        'status'  => [
            'title' =>  '| Gestión de Estados',
            'index' => [
                'title'         => 'Estados',
                'description'   => 'gestión de estados para asignar a las solicitudes.',
            ],
        ],
        'costs'  => [
            'title' =>  '| Gestión de Costos',
            'index' => [
                'title'         => 'Costos',
                'description'   => 'gestión de costos para asignar a las solicitudes.',
            ],
        ],
        'file_type'  => [
            'title' =>  '| Gestión de Tipos de Archivos',
            'index' => [
                'title'         => 'Tipos de Archivos',
                'description'   => 'gestión de tipos de archivos para asignar a las solicitudes.',
            ],
        ],
        'subjects'  => [
            'title' =>  '| Gestión de Materias',
            'index' => [
                'title'         => 'Materias',
                'description'   => 'gestión y asignación de materias de la universidad.',
            ],
            'create'=> [
                'title'         => 'Crear Materia',
                'description'   => 'añadir nueva materia a la universidad.',
            ],
            'assign'=> [
                'title'         => 'Asignar Materia',
                'description'   => 'asignar materia a un prorama y docente de la universidad.',
            ],
            'assigned'=> [
                'title'         => 'Materias Asignadas',
                'description'   => 'gestión de materias asignadas a proramas y docentes de la universidad.',
            ],
            'table' => [
                'subject_code'      =>  'Código',
                'subject_name'      =>  'Materia',
                'subject_credits'   =>  'Créditos',
                'actions'           =>  'Acciones',
            ],
            'table_assigned' => [
                'program_name'      =>  'Programa',
                'subject_code'      =>  'Código',
                'subject_name'      =>  'Materia',
                'subject_credits'   =>  'Créditos',
                'teacher'           =>  'Docente',
                'actions'           =>  'Acciones',
            ]
        ],
    ],

    'files'         =>  [
        'upload'        =>  [
            'title' =>  '| Cargar Archivos',
            'index' =>  [
                'title'         =>  'Cargar Archivos',
                'description'   =>  'para validación de archivos Icetex y Fraccionamiento de matrícula.',
                'files'         =>  [
                    'description'   =>  'Antes de realizar la respectiva entrega física de los documentos, 
                                         recuerda adjuntar en un archivo PDF los documentos requeridos para
                                         la opción seleccionada que encontrarás en el siguiente link.',
                    'icon'          => asset('assets/pages/scripts/financial/images/pdf.png'),
                ],
            ]
        ],
        'management'    =>  [
            'title'     =>  '| Aprobar Archivos',
            'index'     =>  [
                'title'         =>  'Aprobar Archivos',
                'description'   =>  'para validación de archivos Icetex y Fraccionamiento de matrícula.',
            ],
            'chart'         =>  [
                'title'         =>  'Icetex y Fraccionamiento de Matrículas',
                'description'   =>  'Resultado de aprobaciones semestrales',
                'yaxis'         =>  'Estudiantes aprobados'
            ],
        ],
        'show'          =>  [
            'title'     =>  'Solicitud de aprobación',
            'table'     =>  [
                'name'          =>  'Archivo',
                'created_at'    =>  'Fecha de solicitud',
                'semester'      =>  'Semestre',
                'status'        =>  'Estado de la solicitud',
                'request_type'  =>  'Tipo de Solicitud',
                'user'          =>  'Usuario',
            ]
        ]
    ],

    'extension'     =>  [
        'title'             =>  ' | Supletorios',
        'index'             => [
            'title'         => 'Solicitudes',
            'description'   => 'solicitudes de supletorios.',
        ],
        'create'            => [
            'title'         => 'Crear Solicitudes',
            'description'   => 'crear solicitud de supletorio.',
        ],
        'edit'              => [
            'title'         => 'Editar Solicitudes',
            'description'   => 'modificar de supletorio.',
        ],
        'show'              => [
            'title'         => 'Ver Solicitudes',
            'description'   => 'descripción del supletorio.',
        ],

        'empty_title'       =>  'No hay solicitudes',
        'empty_text'        =>  'No hay solicitudes pendientes.',

        'table'             =>  [
            'subject_code'          =>  'Código',
            'subject_name'          =>  'Materia',
            'subject_credits'       =>  'Créditos',
            'subject_program'       =>  'Programa',
            'total_cost'            =>  'Costo Total',
            'status'                =>  'Estado',
            'cost'                  =>  'Costo Unitatio',
            'teacher'               =>  'Docente',
            'phone'                 =>  'Teléfono',
            'email'                 =>  'Email',
            'approval_date'         =>  'Fecha de Aprobación',
            'approved_by'           =>  'Aprobado por',
            'realization_date'      =>  'Fecha de Supletorio',
            'student'               =>  'Estudiante',
            'created_at'            =>  'Fecha de Solicitud',
            'actions'               =>  'Acciones',
        ],
    ],

    'add-sub'       =>  [
        'title'             =>  ' | Adición y Cancelación de Materias',
        'index'             => [
            'title'         => 'Solicitudes',
            'description'   => 'solicitudes de adición o cancelación de materias.',
        ],
        'create'            => [
            'title'         => 'Crear Solicitud',
            'description'   => 'crear solicitud de adición o cancelación de materias.',
        ],
        'edit'              => [
            'title'         => 'Editar Solicitud',
            'description'   => 'modificar adición o cancelación de materias.',
        ],
        'show'              => [
            'title'         => 'Ver Solicitud',
            'description'   => 'descripción adición o cancelación de materias.',
        ],
        'actions'           =>  [
            'addition'      =>  'Añadir Materia',
            'subtract'      =>  'Cancelar Materia',
        ],
    ],

    'validation'    =>  [
        'title'             =>  ' | Validaciones',
        'index'             => [
            'title'         => 'Solicitudes',
            'description'   => 'solicitudes de validaciones.',
        ],
        'create'            => [
            'title'         => 'Crear Solicitud',
            'description'   => 'crear solicitud de validación.',
        ],
        'edit'              => [
            'title'         => 'Editar Solicitud',
            'description'   => 'modificar validación.',
        ],
        'show'              => [
            'title'         => 'Ver Solicitud',
            'description'   => 'descripción de validación.',
        ],
    ],

    'intersemestral'    =>  [
        'title'             =>  ' | Intersemestral',
        'index'             => [
            'title'         => 'Solicitudes',
            'description'   => 'solicitudes de intersemestral.',
            'available'     => 'Intersemestrales Disponibles'
        ],
        'create'            => [
            'title'         => 'Crear Solicitud',
            'description'   => 'crear solicitud de intersemestral.',
        ],
        'edit'              => [
            'title'         => 'Editar Solicitud',
            'description'   => 'modificar intersemestral.',
        ],
        'show'              => [
            'title'         => 'Ver Solicitud',
            'description'   => 'descripción de intersemestral.',
        ],
    ],

    'approval'      =>  [
        'title' =>  ' | Aprobaciones',
        'index'     =>  [
            'title'         =>  'Aprobaciones',
            'description'   =>  'gestión de solicitudes.'
        ],
    ],

    'generic'       =>  [
        'empty'                 =>  'Sin Datos',
        'loading'               =>  'Cargando...',
        'comments'              =>  '{0} No hay cometarios.|{1} Tienes un comentario.|[2,*] Tienes :num comentarios.',
        'comment'               =>  'comentario',
        'leave_a_comment'       =>  'Deja un comentario',
        'sure_delete'           =>  '¿Estás seguro de eliminar este elemento?',
        'requests'              =>  'Solicitudes',
        'teacher_data'          =>  'Datos del Docente',
        'atudent_data'          =>  'Datos del Estudiante',
        'secretary_data'        =>  'Datos de la Secretaria',
        'requests_data'         =>  'Datos de la Solicitud',
        'table'                 =>  [
            'id'                =>  '#',

            'subscribed'        =>  'Inscritos',
            'paid_bar'          =>  'Pagado',

            'paid'              =>  'Estado del pago',

            'subject_action'    =>  'Adición/Cancelación',
            'subject_code'      =>  'Código Materia',
            'subject_name'      =>  'Nombre Materia',
            'subject_credits'   =>  'Créditos',

            'program_name'      =>  'Programa',
            'status_name'       =>  'Estado',

            'teacher_name'      =>  'Docente',
            'secretary_name'    =>  'Aprobado por',
            'student_name'      =>  'Estudiante',
            'phone'             =>  'Teléfono',
            'email'             =>  'E-mail',

            'cost'              =>  'Costo Unitario',
            'total_cost'        =>  'Costo Total',

            'approval_date'     =>  'Fecha de Aprobación',
            'realization_date'  =>  'Fecha de Realización',
            'created_at'        =>  'Fecha de Solicitud',
            'updated_at'        =>  'Fecha de Actualización',
            'deleted_at'        =>  'Fecha de Eliminación',

            'actions'           =>  'Acciones',
        ]
    ],

    'placeholder'   =>  [
        'comment'   =>  'Escribe un comentario aquí.',
        'program'   =>  'Escribe el nombre del programa aquí.',
    ],

    'help-text'     =>  [
        'program'           =>  'Escribe el nombre del programa aquí.',
        'cost'              =>  'Escribe el costo aquí.',
        'valid_until'       =>  'Escribe la fecha válida hasta.',
        'status'            =>  'Escribe el nombre del estado aquí.',
        'subject'           =>  'Escribe el nombre de la materia aquí.',
        'code'              =>  'Escribe el código de la materia aquí.',
        'credits'           =>  'Escribe la cantidad de créditos de la materia aquí.',
        'search'            =>  'Escribe texto aquí para realizar la búsqueda.',
        'tree'              =>  'Si deseas modificar o eliminar alguno de los estados creados, da click derecho sobre el elemento para mostrar el menú contextual y realizar la acción deseada.',
        'percent'           =>  ':percent completado.'
    ],

    'buttons'       =>  [
        'save'          =>  'Guardar',
        'unsubscribe'   =>  'Desinscribirse',
        'subscribe'     =>  'Suscribirse',
        'rename'        =>  'Renombrar',
        'view'          =>  'Ver',
        'here'          =>  'Aquí',
        'refresh'       =>  'Recargar',
        'cancel'        =>  'Cancelar',
        'apply'         =>  'Solicitar',
        'delete'        =>  'Eliminar',
        'actions'       =>  'Accciones',
        'add'           =>  'Añadir',
        'paid'          =>  'Actualizar Pago',
        'send'          =>  'Enviar',
        'edit'          =>  'Editar',
        'approve'       =>  'Aprobar',
        'reject'        =>  'Rechazar',
        'close'         =>  'Cerrar',
        'yes'           =>  'Si',
        'no'            =>  'No',
        'ok'            =>  'Ok',
    ],

    'email'         =>  [
        'file'      =>  [
            'title'     =>  'Solicitud de aprobación de archivos',
            'message'   =>  'Se ha procesado el archivo :filename satisfactoriamente, recibirás una respuesta pronto con las instrucciones para continuar el proceso.',
            'button'    =>  'Revisar solicitud',
        ],
        'request'   =>  [
            'title'     =>  'Se ha creado una solicitud de :request',
            'message'   =>  'A continuación los detalles de la solicitud:',
            'button'    =>  'Revisar solicitud',
        ]
    ],

    'status_type'   =>  [
        'file'                  =>  status_type_file(),
        'extension'             =>  status_type_extension(),
        'validation'            =>  status_type_validation(),
        'intersemester'         =>  status_type_intersemestral(),
        'addition_subtraction'  =>  status_type_addition_subtraction(),
    ],
];