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

    'locale'        => 'es',
    'select'        => 'Seleccionar',
    'loading'       => 'Cargando',

    'warning'       => '¡Advertencia!',
    'error'         => '¡Error!',
    'success'       => '¡Bien Hecho!',
    'info'          => 'Información',
    'remove'        => 'Remover',
    'pending'       => 'Pendiente',
    'approved'      => 'Aprobado',
    'create_some'   => 'Crear :attribute',
    'update_some'   => 'Actualizar :attribute',
    'delete_some'   => 'Eliminar :attribute',
    'all'           => 'All',
    'comments'      => 'Tienes un comentario|Tienes :num comentarios',

    'ask_if_approve'=> '¿Desea aprobar esta solictud?',
    'ask_if_reject' => '¿Desea rechazar esta solictud?',
    'in_review'     => '¿Desea actualizar el estado a revisión esta solictud?',

    'ask_if_create' => '¿Desea crear nuevos datos?',
    'processed'     => 'Datos procesados satisfactoriamente.',
    'processed_fail'=> 'No se han podido procesar los datos, intenta nuevamente.',

    'ask_if_update' => '¿Desea actualizar los datos seleccionados?',
    'updated_done'  => 'Se ha actualizado satisfactoriamente.',
    'updated_fail'  => 'No se pudo actualizar, intenta de nuevo.',

    'updated_fail_status'  => 'No se puede modificar un estado por defecto de la plataforma.',

    'ask_if_delete' => '¿Desea eliminar los datos seleccionados?',
    'deleted_done'  => 'Se ha eliminado satisfactoriamente.',
    'deleted_fail'  => 'No se pudo eliminar, intenta de nuevo.',

    'deleted_fail_status'  => 'No se puede eliminar el registro por que ha sido entregado.',
    'destroy_fail_status'  => 'No se puede eliminar un estado por defecto de la plataforma.',

    'ask_if_unsubscribe'=> '¿Desea desinscribirse de esta solicitud?',
    'unsubscribe_done'  => 'Se ha desinscrito satisfactoriamente.',
    'unsubscribe_fail'  => 'No se pudo desinscribir, intenta de nuevo.',

    'ask_if_subscribe'  => '¿Desea inscribirse de esta solicitud?',
    'subscribe_done'    => 'Se ha inscrito satisfactoriamente.',
    'subscribe_fail'    => 'No se pudo inscribir, intenta de nuevo.',

    'char'          => 'caracter|caracteres',
    'wait'          => 'Espera, por favor.',
    'file'          => 'Archivo :file',

    'messages'      => [
        'do_not_sent'           =>  'Este mensaje no se envió. Comprueba tu conexión a internet y haz click para intentarlo de nuevo.',
        'can_not_edit'          =>  'Lo sentimos no puede modificar esta solicitud',
        'request_in_process'    =>  'Lo sentimos, ya tienes una solicitud en proceso',
        'inter_processed_fail'  =>  'No se han podido procesar los datos, es posible que ya estes inscrito a este intersemestral de lo contrario intenta nuevamente.',
    ],

    'tooltip'      => [
        'add'       =>  'Añadir nuevo registro',
        'create'    =>  'Crear nuevo registro',
        'print'     =>  'Imprimir',
        'copy'      =>  'Copiar al portapapeles',
        'pdf'       =>  'Exportar a PDF',
        'excel'     =>  'Exportar a Excel',
        'csv'       =>  'Exportar a CSV',
        'show'      =>  'Mostrar u ocultar columnas',
        'paid'      =>  'Actualizar estado de pago',
        'reload'    =>  'Recargar',
        'comments'  =>  'Comentarios',
        'view'      =>  'Ver registro existente',
        'edit'      =>  'Editar registro existente',
        'delete'    =>  'Eliminar registro existente',
        'more'      =>  'Ver más',
        'previous'  =>  'Anterior',
        'next'      =>  'Siguiente',
        'call'      =>  'Llamar',
        'send_mail' =>  'Enviar E-mail',
    ],

    'dropzone'      => [
        'processing'                => 'Procesando Archivo.',
        'remove'                    => 'Quitar Archivo.',
        'server_error'              => 'Ha ocurrido un error e el servidor.',
        'one_file'                  => 'Debes cargar al menos un archivo.',
        'stored'                    => 'Almacenado',
        'stored_and_processing'     => 'El archivo se ha cargado satisfactoriamente. Un momento mientras se procesa.',
        'failed'                    => 'El archivo no se pudo procesar, intenta nuevamente.',
        'success'                   => 'El archivo :filename se ha procesado satisfactoriamente.',
        'replace'                   => 'Reemplazarás el archivo :filename',
        'file_type'                 => 'Tipo de solicitud: :request',
        'status'                    => 'Estado de la solicitud: :status',
    ],

    'http_status'   =>  [
        'error'         =>  'Error :status',
        'disconnected'  =>  'Comprueba tu conexión a internet y vuelve a intentarlo.',
        'unexpected'    =>  'Ocurrió un error inesperado. Intenta de nuevo más tarde.',
        '200'           =>  'Ok.',
        '400'           =>  'La solicitud contiene sintaxis errónea y no debería repetirse.',
        '401'           =>  'Usuario no autorizado, la autentificación ha fallado, por favor inicia sesión nuevamente.',
        '402'           =>  'Pago requerido, no se puede procesar esta solicitud.',
        '403'           =>  'Acceso denegado o prohibido.',
        '404'           =>  'No se encontró el recurso solicitado.',
        '405'           =>  'Método HTTP no permitido.',
        '406'           =>  'El servidor no es capaz de devolver los datos en ninguno de los formatos aceptados por el cliente.',
        '407'           =>  'Autenticación de Proxy Requerida.',
        '408'           =>  'Se agotó el tiempo de espera de la conexión.',
        '409'           =>  'La solicitud no pudo ser procesada debido a un conflicto con el estado actual del recurso.',
        '410'           =>  'El recurso solicitado ya no está disponible y no lo estará de nuevo.',
        '413'           =>  'Archivo demasiado grande para cargar.',
        '419'           =>  'Tiempo de espera de autenticación agotado.',
        '422'           =>  'La solicitud está bien formada pero no fue imposible seguirla debido a errores semánticos.',
        '500'           =>  'Error Interno del Servidor.',
        '503'           =>  'El servidor no puede responder a la petición del navegador porque está congestionado o está realizando tareas de mantenimiento.',
    ],
];