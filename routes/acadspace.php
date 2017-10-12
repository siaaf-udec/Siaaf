<?php
/**
 * Espacios Académicos
 */

//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'espacios.academicos.index',
    'uses' => function () {
        return view('acadspace.controlEstudiante');
    }
]);


$controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";


Route::get('/editActPrac/{id}', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.editActPrac', //Este es el alias de la ruta
    'uses' => $controller . 'SolicitudController@editActPrac'
]);

Route::resource('est', $controller . 'EstudiantesController', [   //ruta para el CRUD de estudiantes
    'names' => [ // 'método' => 'alias'
        'create' => 'espacios.academicos.est.create',
        'store' => 'espacios.academicos.est.store',
        'index' => 'espacios.academicos.est.index',
        'edit' => 'espacios.academicos.est.edit',
        'update' => 'espacios.academicos.est.update',
        'destroy' => 'espacios.academicos.est.destroy',
    ]
]);


Route::get('/editAct/{id}', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.editAct', //Este es el alias de la ruta
    'uses' => $controller . 'formatosController@editAct'
]);


Route::get('/edit2/{id}', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.edit2', //Este es el alias de la ruta
    'uses' => $controller . 'softwareController@eliminarSoftware'
]);

Route::get('/lissolicitudesAprob', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.lissolicitudesAprob', //Este es el alias de la ruta
    'uses' => $controller . 'SolicitudController@listarSolPrueba'
]);

Route::get('/solicitudesAprob', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.solicitudesAprob', //Este es el alias de la ruta
    'uses' => $controller . 'SolicitudController@data'
]);

Route::get('/solicitudesSoft', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.solicitudesSoft', //Este es el alias de la ruta
    'uses' => $controller . 'softwareController@show'
]);

Route::get('/solicitudesLista', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.mostrarSolicitudes', //Este es el alias de la ruta
    'uses' => $controller . 'SolicitudController@listarSolicitud'
]);

Route::get('/solicitudesListaLibre', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.mostrarSolicitudesLibre', //Este es el alias de la ruta
    'uses' => $controller . 'SolicitudController@listarSolicitud'
]);

Route::get('/solicitudesAprobadas', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.solicitudesAprobadas', //Este es el alias de la ruta
    'uses' => $controller . 'SolicitudController@listarSolicitudAprobada'
]);

Route::get('/misSolicitudes', [    //ruta para listar los docentes registrados.
    'as' => 'espacios.academicos.misSolicitudes', //Este es el alias de la ruta
    'uses' => $controller . 'SolicitudController@estadoSolicitudesRealizadas'
]);

Route::get('/descargarArchivo/{id}', [
    'as' => 'espacios.academicos.descargarArchivo',
    'uses' => $controller . 'formatosController@descargar_publicacion'
]);

Route::get('/listarporSec', [
    'as' => 'espacios.academicos.listarporSec',
    'uses' => $controller . 'formatosController@listarporSec'
]);

Route::get('/reportes', [
    'as' => 'espacios.academicos.reportes',
    'uses' => $controller . 'EstudiantesController@reportes'
]);

/*Route::get('reportes', function () {
    $data = [];
    $pdf = PDF::loadView('welcome', $data);
    return $pdf->download('invoice.pdf');
})->name('espacios.academicos.reportes');
*/
Route::get('reportesDoc', function () {
    $data = [];
    $pdf = PDF::loadView('acadspace.Reportes.reportesDocentes', $data);
    return $pdf->download('invoice.pdf');
})->name('espacios.academicos.reportesDoc');


/**CALENDARIO**/
Route::resource('acadcalendar', $controller . 'CalendarioController', [   //RUTA HORARIO
    'names' => [ // 'método' => 'alias'
        'create' => 'espacios.academicos.acadcalendar.create',
        'store' => 'espacios.academicos.acadcalendar.store',
        'index' => 'espacios.academicos.acadcalendar.index',
        'edit' => 'espacios.academicos.acadcalendar.edit',
        'show' => 'espacios.academicos.acadcalendar.show',
        'update' => 'espacios.academicos.acadcalendar.update',
        'destroy' => 'espacios.academicos.acadcalendar.destroy'
    ]
]);
//Ruta para guardar eventos en el calendario
Route::post('guardarEventos',
    array('as' => 'guardaEventos',
        'uses' => 'CalendarioController@create'));

Route::get('data/{sala?}', [ //Cargar datatable en la vista de calendario
    'uses' => $controller . 'CalendarioController@data',
    'as' => 'espacios.academicos.acadcalendar.data'
]);
Route::get('cargarSalasCalendario/{sala?}', [ //Cargar datatable en la vista de calendario
    'uses' => $controller . 'CalendarioController@cargarSalasCalendario',
    'as' => 'espacios.academicos.acadcalendar.cargarSalasCalendario'
]);
//Rutas asignadas para el calendario academico
Route::post('guardaEventos', [ //Almacenar eventos
    'uses' => $controller . 'CalendarioController@create',
    'as' => 'espacios.academicos.espacad.guardaeventos'
]);
Route::post('cargaEventos', [ //Cargar Eventos
    'as' => 'espacios.academicos.espacad.cargarEve',     //ruta que llama al controlador para mostrar los enventos y recordatorios guardados
    'uses' => $controller . 'CalendarioController@cargaEventos'
]);
Route::post('actualizaEventos', [ //Modificar eventos
    'uses' => $controller . 'CalendarioController@update',
    'as' => 'espacios.academicos.espacad.actualizaEventos'
]);
Route::post('eliminaEvento', [ //Eliminar eventos
    'uses' => $controller . 'CalendarioController@delete',
    'as' => 'espacios.academicos.espacad.eliminaEvento'
]);

/*RUTAS PARA MANEJAR EL FORMULARIO DE SOFTWARE*/
Route::group(['prefix' => 'soft'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    Route::get('index', [ //MOSTRAR FORMULARIO
        'uses' => $controller . 'softwareController@index',
        'as' => 'espacios.academicos.soft.index'
    ]);
    Route::post('crear', [ //CREAR SOFTWARE
        'uses' => $controller . 'softwareController@registroSoftware',
        'as' => 'espacios.academicos.soft.regsoft',
    ]);
    Route::get('listar', [ //CARGAR DATATABLE
        'uses' => $controller . 'softwareController@data',
        'as' => 'espacios.academicos.soft.data',
    ]);

    Route::delete('delete/{id?}', [ //ELIMINAR
        'uses' => $controller . 'softwareController@destroy',
        'as' => 'espacios.academicos.soft.destroy'
    ])->where(['id' => '[0-9]+']);

    Route::get('json', [ //Mostrar la vista
        'uses' => $controller . 'softwareController@cargarjson',
        'as' => 'espacios.academicos.soft.json'
    ]);
});


/*RUTAS PARA EL FORMULARIO DE SOLICITUD GRUPAL*/
Route::group(['prefix' => 'espacad'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'SolicitudController@index',
        'as' => 'espacios.academicos.espacad.index'
    ]);
    Route::get('index-ajax', [
        'uses' => $controller . 'SolicitudController@indexajax',
        'as' => 'espacios.academicos.espacad.indexajax'
    ]);
    Route::get('data', [ //Cargar datatable
        'uses' => $controller . 'SolicitudController@data',
        'as' => 'espacios.academicos.espacad.data'
    ]);
    Route::post('store', [ //Registro solicitud formulario
        'uses' => $controller . 'SolicitudController@store',
        'as' => 'espacios.academicos.espacad.store'
    ]);
    Route::get('create', [ //Mostrar la vista
        'uses' => $controller . 'SolicitudController@create',
        'as' => 'espacios.academicos.espacad.create'
    ]);
    Route::get('createlib', [ //Mostrar la vista
        'uses' => $controller . 'SolicitudController@createlib',
        'as' => 'espacios.academicos.espacad.createlib'
    ]);

    Route::post('registrosol', [ //Registro solicitud formulario
        'uses' => $controller . 'SolicitudController@registroSolicitudGrupal',
        'as' => 'espacios.academicos.espacad.registrosol'
    ]);
    /*APRENDIENDO*/
    Route::get('pruebat/{id?}', [
        'as' => 'espacios.academicos.espacad.pruebat',
        'uses' => $controller . 'SolicitudController@controladorX'
    ]);
    Route::get('alex', [ //Mostrar la vista
        'uses' => $controller . 'SolicitudController@alexis',
        'as' => 'espacios.academicos.espacad.alex'
    ]);

});


/*RUTAS PARA EL FORMULARIO DE EVALUACION DE SOLICITUDES AUXILIAR ACADEMICO*/
Route::group(['prefix' => 'evalsol'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'AuxiliarController@index',
        'as' => 'espacios.academicos.evalsol.index'
    ]);
    Route::get('cargarSalas/{espacio?}', [
        'uses' => $controller . 'AuxiliarController@cargarSalas',
        'as' => 'espacios.academicos.evalsol.cargarSalas'
    ]);
    Route::get('data/{espacio?}', [ //Cargar datatable
        'uses' => $controller . 'AuxiliarController@data',
        'as' => 'espacios.academicos.evalsol.data'
    ]);
    Route::get('cargarDataLibre/{espacio?}', [ //Cargar datatable
        'uses' => $controller . 'AuxiliarController@cargarDataLibre',
        'as' => 'espacios.academicos.evalsol.cargarDataLibre'
    ]);
    Route::post('store', [ //Registro solicitud formulario
        'uses' => $controller . 'AuxiliarController@store',
        'as' => 'espacios.academicos.evalsol.store'
    ]);
    Route::get('create', [ //Mostrar la vista
        'uses' => $controller . 'AuxiliarController@create',
        'as' => 'espacios.academicos.evalsol.create'
    ]);
    Route::post('aprobar', [ //Aprobar solicitud
        'uses' => $controller . 'AuxiliarController@aprobarSolicitud',
        'as' => 'espacios.academicos.evalsol.aprobarSol',
    ]);
    Route::post('reprobar', [ //Aprobar solicitud
        'uses' => $controller . 'AuxiliarController@agregarAnotacion',
        'as' => 'espacios.academicos.evalsol.reprobarSol',
    ]);
    Route::post('finalizar', [ //Aprobar solicitud
        'uses' => $controller . 'AuxiliarController@finalizarProceso',
        'as' => 'espacios.academicos.evalsol.finalizarProceso',
    ]);
    Route::get('indexFinal', [
        'uses' => $controller . 'AuxiliarController@indexFinal',
        'as' => 'espacios.academicos.evalsol.indexFinal'
    ]);
    Route::get('mostrarFinalizados/{espacio?}', [
        'uses' => $controller . 'AuxiliarController@mostrarFinalizados',
        'as' => 'espacios.academicos.evalsol.mostrarFinalizados',
    ]);
    Route::delete('delete/{id?}', [ //ELIMINAR
        'uses' => $controller . 'AuxiliarController@destroy',
        'as' => 'espacios.academicos.evalsol.destroy'
    ])->where(['id' => '[0-9]+']);
});

/*RUTAS PARA EL FORMULARIO DE FORMATOS ACADEMICOS*/
Route::group(['prefix' => 'formacad'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'formatosController@index',
        'as' => 'espacios.academicos.formacad.index'
    ]);
    Route::get('indexajax', [
        'uses' => $controller . 'formatosController@indexajax',
        'as' => 'espacios.academicos.formacad.indexajax'
    ]);
    Route::get('data', [ //Cargar datatable
        'uses' => $controller . 'formatosController@data',
        'as' => 'espacios.academicos.formacad.data'
    ]);
    Route::post('store', [ //Registro solicitud formulario
        'uses' => $controller . 'formatosController@store',
        'as' => 'espacios.academicos.formacad.store'
    ]);
    Route::get('create', [ //Mostrar la vista
        'uses' => $controller . 'formatosController@create',
        'as' => 'espacios.academicos.formacad.create'
    ]);
    Route::get('listSol', [
        'uses' => $controller . 'formatosController@listSol',
        'as' => 'espacios.academicos.formacad.listSol'
    ]);
    Route::get('datalistSol', [ //Cargar datatable
        'uses' => $controller . 'formatosController@dataListSol',
        'as' => 'espacios.academicos.formacad.datalistSol'
    ]);
    Route::get('edit/{id?}', [ //EDITAR
        'uses' => $controller . 'formatosController@edit',
        'as' => 'espacios.academicos.formacad.edit'
    ])->where(['id' => '[0-9]+']);

    Route::get('descargarArchivo/{id?}', [
        'uses' => $controller . 'formatosController@descargar_publicacion',
        'as' => 'espacios.academicos.descargarArchivo'
    ])->where(['id' => '[0-9]+']);

});

/*RUTAS PARA MANEJAR EL FORMULARIO DE REPORTES*/
Route::group(['prefix' => 'report'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    Route::get('index',[ //Pagina inicial y captura de rango de fechas
        'uses' => $controller.'ReporteController@index',
        'as' => 'espacios.academicos.report.index'
    ]);
    Route::get('cargarSalasReportes/{sala?}',[ //CARGAR SALAS
        'uses' => $controller.'ReporteController@cargarSalasReportes',
        'as' => 'espacios.academicos.report.cargarSalasReportes'
    ]);
    Route::post('repDoc', [ //CREAR REPORTE DOCENTE
        'uses' => $controller . 'ReporteController@reporDocente',
        'as'   => 'espacios.academicos.report.repDoc',
    ]);
    Route::get('repEst',[ //Pagina inicial y captura de rango de fechas
        'uses' => $controller.'ReporteController@repEst',
        'as' => 'espacios.academicos.report.indexPrueba'
    ]);
    Route::post('cargarRepEst',[ //CREAR REPORTE
        'uses' => $controller . 'ReporteController@cargarRepEst',
        'as'   => 'espacios.academicos.report.cargarRepEst',
    ]);

});

/*RUTAS PARA FUNCIONALIDAD AULAS*/
Route::group(['prefix' => 'aulas'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'AulasController@index',
        'as' => 'espacios.academicos.aulas.index'
    ]);
    Route::get('data', [ //Cargar datatable
        'uses' => $controller . 'AulasController@data',
        'as' => 'espacios.academicos.aulas.data'
    ]);

    Route::delete('delete/{id?}', [ //ELIMINAR
        'uses' => $controller . 'AulasController@destroy',
        'as' => 'espacios.academicos.aulas.destroy'
    ])->where(['id' => '[0-9]+']);

    Route::post('regisAula', [ //CREAR AULA
        'uses' => $controller . 'AulasController@regisAula',
        'as' => 'espacios.academicos.aulas.regisAula',
    ]);
});

/*RUTAS PARA FUNCIONALIDAD INCIDENTES*/
Route::group(['prefix' => 'incidente'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'IncidentesController@index',
        'as' => 'espacios.academicos.incidente.index'
    ]);
    Route::get('data', [ //Cargar datatable
        'uses' => $controller . 'IncidentesController@data',
        'as' => 'espacios.academicos.incidente.data'
    ]);

    Route::delete('delete/{id?}', [ //ELIMINAR
        'uses' => $controller . 'IncidentesController@destroy',
        'as' => 'espacios.academicos.incidente.destroy'
    ])->where(['id' => '[0-9]+']);

    Route::post('regisIncidente', [ //CREAR INCIDENTE
        'uses' => $controller . 'IncidentesController@regisIncidente',
        'as' => 'espacios.academicos.incidente.regisIncidente',
    ]);
});



