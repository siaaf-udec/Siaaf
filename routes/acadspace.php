<?php
/**
 * Espacios Académicos
 */

//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'espacios.academicos.index',
    'uses' => function(){
        return view('acadspace.controlEstudiante');
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

Route::get('/editActPrac/{id}', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.editActPrac', //Este es el alias de la ruta
    'uses' => $controller.'SolicitudController@editActPrac'
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

Route::get('/editAct/{id}', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.editAct', //Este es el alias de la ruta
    'uses' => $controller.'solFormAcadController@editAct'
]);



Route::resource('soft', $controller.'softwareController', [   //ruta para el CRUD de solicitudes de software
    'names' => [ // 'método' => 'alias'
        'create' => 'espacios.academicos.soft.create',
        'store' => 'espacios.academicos.soft.store',
        'index' => 'espacios.academicos.soft.index',
        'edit' => 'espacios.academicos.soft.edit',
        'edit2' => 'espacios.academicos.soft.edit2',
        'update' => 'espacios.academicos.soft.update',
        'destroy' => 'espacios.academicos.soft.destroy',
    ]
]);

Route::get('/edit2/{id}', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.edit2', //Este es el alias de la ruta
    'uses' => $controller.'softwareController@edit2'
]);

Route::get('/solicitudesSoft', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.solicitudesSoft', //Este es el alias de la ruta
    'uses' => $controller.'softwareController@show'
]);

Route::get('/solicitudesLista', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.mostrarSolicitudes', //Este es el alias de la ruta
    'uses' => $controller.'SolicitudController@listarSolicitud'
]);

Route::get('/solicitudesAprobadas', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.solicitudesAprobadas', //Este es el alias de la ruta
    'uses' => $controller.'SolicitudController@listarSolicitudAprobada'
]);

Route::get('/descargarArchivo/{id}', [
    'as' => 'espacios.academicos.descargarArchivo',
    'uses' => $controller.'solFormAcadController@descargar_publicacion'
]);

Route::get('/listarporSec', [
    'as' => 'espacios.academicos.listarporSec',
    'uses' => $controller.'solFormAcadController@listarporSec'
]);

Route::get('reportesEst', function () {
    $data = [];
    $pdf = PDF::loadView('welcome', $data);
    return $pdf->download('invoice.pdf');
})->name('espacios.academicos.reportesEst');

Route::get('reportesDoc', function () {
    $data = [];
    $pdf = PDF::loadView('acadspace.Reportes.reportesDocentes', $data);
    return $pdf->download('invoice.pdf');
})->name('espacios.academicos.reportesDoc');