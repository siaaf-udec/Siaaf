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

//Ruta para manejar Solicitudes
Route::group(['prefix' => 'solacad'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    /*RUTAS ASIGNADAS PARA SOLICITUD ROL DOCENTE*/
    Route::get('indexDoc', [ //Index ROL docente
        'uses' => $controller . 'SolicitudController@mostrarSolicitudesDocente',
        'as' => 'espacios.academicos.solacad.indexDoc'
    ]);
    Route::get('indexDocAjax', [
        'uses' => $controller . 'SolicitudController@mostrarSolicitudesDocenteAjax',
        'as' => 'espacios.academicos.solacad.indexDocAjax'
    ]);
    Route::get('crearGrupal', [ //Crear practica grupal
        'uses' => $controller . 'SolicitudController@crearSolicitudGrupal',
        'as' => 'espacios.academicos.solacad.crearGrupal'
    ]);
    Route::get('crearLibre', [ //Crear practica libre
        'uses' => $controller . 'SolicitudController@crearSolicitudLibre',
        'as' => 'espacios.academicos.solacad.crearLibre'
    ]);
    Route::post('registrarSolicitud', [ //Registro solicitudes
        'uses' => $controller . 'SolicitudController@registroSolicitud',
        'as' => 'espacios.academicos.solacad.registroSolicitud'
    ]);
    Route::get('data', [ //Cargar datatable rol docente
        'uses' => $controller . 'SolicitudController@cargarTablaDoc',
        'as' => 'espacios.academicos.solacad.data'
    ]);
    /*FIN RUTAS ASIGNADAS PARA SOLICITUD ROL DOCENTE*/
});

Route::get('reportesDoc', function () {
    $data = [];
    $pdf = PDF::loadView('acadspace.Reportes.reportesDocentes', $data);
    return $pdf->download('invoice.pdf');
})->name('espacios.academicos.reportesDoc');



/**RUTAS CALENDARIO**/
Route::get('acadcalendar', [ //Cargar datatable en la vista de calendario
    'uses' => $controller . 'CalendarioController@index',
    'as' => 'espacios.academicos.acadcalendar.index'
]);

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

/**FIN RUTAS CALENDARIO**/

/*RUTAS PARA MANEJAR EL FORMULARIO DE SOFTWARE*/
Route::group(['prefix' => 'soft'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    Route::get('index', [ //MOSTRAR FORMULARIO
        'uses' => $controller . 'SoftwareController@index',
        'as' => 'espacios.academicos.soft.index'
    ]);
    Route::post('crear', [ //CREAR SOFTWARE
        'uses' => $controller . 'SoftwareController@registroSoftware',
        'as' => 'espacios.academicos.soft.regsoft',
    ]);
    Route::get('listar', [ //CARGAR DATATABLE
        'uses' => $controller . 'SoftwareController@data',
        'as' => 'espacios.academicos.soft.data',
    ]);
    Route::delete('delete/{id?}', [ //ELIMINAR
        'uses' => $controller . 'SoftwareController@destroy',
        'as' => 'espacios.academicos.soft.destroy'
    ])->where(['id' => '[0-9]+']);

});


/*RUTAS PARA EL FORMULARIO DE EVALUACION DE SOLICITUDES AUXILIAR ACADEMICO*/
Route::group(['prefix' => 'evalsol'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'SolicitudController@mostrarSolicitudesAuxiliar',
        'as' => 'espacios.academicos.evalsol.index'
    ]);
    Route::get('indexFinal', [ //Mostrar solicitudes finalizadas
        'uses' => $controller . 'SolicitudController@mostrarSolicitudesFinalizadas',
        'as' => 'espacios.academicos.evalsol.indexFinal'
    ]);
    Route::get('cargarSalas/{espacio?}', [ //Cargar salas de acuerdo al espacio
        'uses' => $controller . 'SolicitudController@cargarSalas',
        'as' => 'espacios.academicos.evalsol.cargarSalas'
    ]);
    Route::get('data/{espacio?}', [ //Cargar datatable solicitudes grupales
        'uses' => $controller . 'SolicitudController@cargarTablaSolGrupal',
        'as' => 'espacios.academicos.evalsol.data'
    ]);
    Route::get('cargarDataLibre/{espacio?}', [ //Cargar datatable solicitudes libres
        'uses' => $controller . 'SolicitudController@cargarTablaSolLibre',
        'as' => 'espacios.academicos.evalsol.cargarDataLibre'
    ]);
    Route::post('aprobar', [ //Aprobar solicitud
        'uses' => $controller . 'SolicitudController@aprobarSolicitud',
        'as' => 'espacios.academicos.evalsol.aprobarSol',
    ]);

    Route::post('reprobar', [ //Reprobar solicitud
        'uses' => $controller . 'SolicitudController@agregarAnotacion',
        'as' => 'espacios.academicos.evalsol.reprobarSol',
    ]);

    Route::post('finalizar', [ //Aprobar solicitud
        'uses' => $controller . 'SolicitudController@finalizarProceso',
        'as' => 'espacios.academicos.evalsol.finalizarProceso',
    ]);

    Route::get('mostrarFinalizados/{espacio?}', [
        'uses' => $controller . 'SolicitudController@mostrarFinalizados',
        'as' => 'espacios.academicos.evalsol.mostrarFinalizados',
    ]);
    Route::delete('delete/{id?}', [ //ELIMINAR
        'uses' => $controller . 'SolicitudController@destroy',
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

/*RUTAS PARA MANEJAR EL FORMULARIO DE REPORTES*/
Route::group(['prefix' => 'report'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    Route::get('index',[ //Pagina inicial y captura de rango de fechas
        'uses' => $controller.'ReporteController@index',
        'as' => 'espacios.academicos.report.index'
    ]);

    Route::get('indexEst',[ //Pagina inicial y captura de rango de fechas
        'uses' => $controller.'ReporteController@repIndexEst',
        'as' => 'espacios.academicos.report.indexEst'
    ]);

    Route::get('indexCarr',[ //Pagina inicial y captura de rango de fechas rep carrera
        'uses' => $controller.'ReporteController@repIndexCarr',
        'as' => 'espacios.academicos.report.indexCarr'
    ]);

    Route::post('repDoc', [ //CREAR REPORTE DOCENTE
        'uses' => $controller . 'ReporteController@reporDocente',
        'as'   => 'espacios.academicos.report.repDoc',
    ]);

    Route::post('repEst', [ //CREAR REPORTE
        'uses' => $controller . 'ReporteController@cargarRepEst',
        'as'   => 'espacios.academicos.report.repEst',
    ]);
    Route::post('repCarr', [ //CREAR REPORTE CARRERAS
        'uses' => $controller . 'ReporteController@reporCarrera',
        'as'   => 'espacios.academicos.report.repCarr',
    ]);
    Route::get('DownloadRepEstudiante',[ //DESCARGAR REPORTE
        'uses' => $controller.'ReporteController@DownloadEstReporte',
        'as' => 'espacios.academicos.report.downReportEst'
    ]);
    Route::get('cargarSalasReportes/{espacio?}', [
        'uses' => $controller . 'ReporteController@cargarSalasReportes',
        'as' => 'espacios.academicos.report.cargarSalasReportes'
    ]);

});

/*RUTAS PARA MANEJAR LA ASISTENCIA*/
Route::group(['prefix' => 'asist'], function () {
    $controller = "\\App\\Container\\Acadspace\\Src\\Controllers\\";
    Route::get('asisEst',[ //Pagina inicial asistencia estudiantes
        'uses' => $controller.'AsistenciaController@asisEst',
        'as' => 'espacios.academicos.asist.asisEst'
    ]);
    Route::get('asisDoc',[ //Pagina inicial asistencia docentes
        'uses' => $controller.'AsistenciaController@asisDoc',
        'as' => 'espacios.academicos.asist.asisDoc'
    ]);
    Route::post('regisAsistDoc',[ //Registrar asistencia Docente
        'uses' => $controller.'AsistenciaController@regisAsistenciaDoc',
        'as' => 'espacios.academicos.asist.regisAsistDoc'
    ]);
    Route::post('regisAsistEst',[ //Registrar asistencia Docente
        'uses' => $controller.'AsistenciaController@regisAsistenciaEst',
        'as' => 'espacios.academicos.asist.regisAsistEst'
    ]);

    Route::get('cargarSalasAsitencia/{espacio?}', [
        'uses' => $controller . 'AsistenciaController@cargarSalasAsitencia',
        'as' => 'espacios.academicos.asist.cargarSalasAsitencia'
    ]);

});