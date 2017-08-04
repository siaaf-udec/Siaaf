<?php
/**
 * Espacios Académicos
 */

//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'espacios.academicos.index',
    'uses' => function(){
        return view('acadspace.example');
    }
]);

$controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";


Route::resource('espacad', $controller.'SolicitudController', [   //ruta para el CRUD de solicitudes
    'names' => [ // 'método' => 'alias'
        'create' => 'espacios.academicos.espacad.create',
        'store' => 'espacios.academicos.espacad.store',
        'index' => 'espacios.academicos.espacad.index',
        'edit' => 'espacios.academicos.espacad.edit',
        'update' => 'espacios.academicos.espacad.update',
        'destroy' => 'espacios.academicos.espacad.destroy'
    ]
]);

Route::resource('est', $controller.'EstudiantesController', [   //ruta para el CRUD de empleados
    'names' => [ // 'método' => 'alias'
        'create' => 'espacios.academicos.est.create',
        'store' => 'espacios.academicos.est.store',
        'index' => 'espacios.academicos.est.index',
        'edit' => 'espacios.academicos.est.edit',
        'update' => 'espacios.academicos.est.update',
        'destroy' => 'espacios.academicos.est.destroy',
    ]
]);

Route::resource('formacad', $controller.'solFormAcadController', [   //ruta para el CRUD de empleados
    'names' => [ // 'método' => 'alias'
        'create' => 'espacios.academicos.formacad.create',
        'store' => 'espacios.academicos.formacad.store',
        'index' => 'espacios.academicos.formacad.index',
        'show' => 'espacios.academicos.formacad.show',
        'edit' => 'espacios.academicos.formacad.edit',
        'update' => 'espacios.academicos.formacad.update',
        'destroy' => 'espacios.academicos.formacad.destroy',
    ]
]);

Route::get('/solicitudesLista', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.mostrarSolicitudes', //Este es el alias de la ruta
    'uses' => $controller.'SolicitudController@listarSolicitud'
]);

Route::get('/descargarArchivo/{id}', [
    'as' => 'espacios.academicos.descargarArchivo',
    'uses' => $controller.'solFormAcadController@descargar_publicacion'
]);
