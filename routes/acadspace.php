<?php
/**
 * Espacios Académicos
 */

Route::group(['middleware' => ['auth']], function () {

    $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";
    //Ruta para manejar Solicitudes
    Route::group(['prefix' => 'solacad', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";
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


    /*RUTAS PARA MANEJAR EL FORMULARIO DE SOFTWARE*/
    Route::group(['prefix' => 'soft', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";
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
    Route::group(['prefix' => 'evalsol', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";
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
    Route::group(['prefix' => 'formacad', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";
        Route::get('index', [
            'uses' => $controller . 'formatosController@index',
            'as' => 'espacios.academicos.formacad.index'
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

        Route::get('descargarArchivo/{id?}', [//DESCARGAR
            'uses' => $controller . 'formatosController@descargarPublicacion',
            'as' => 'espacios.academicos.descargarArchivo'
        ])->where(['id' => '[0-9]+']);

        Route::delete('delete/{id?}', [ //ELIMINAR
            'uses' => $controller . 'formatosController@destroy',
            'as' => 'espacios.academicos.formacad.destroy'
        ])->where(['id' => '[0-9]+']);
    });

    /*RUTAS PARA FUNCIONALIDAD AULAS*/
    Route::group(['prefix' => 'aulas', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";
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
        Route::post('verificarAula',[
            'uses' => $controller.'AulasController@verificarAula',
            'as' => 'espacios.academicos.aulas.verificarAula'
        ]);
    });

    /*RUTAS PARA FUNCIONALIDAD INCIDENTES*/
    Route::group(['prefix' => 'incidente', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";
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
    Route::group(['prefix' => 'report', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";
        Route::get('indexDoc', [ //Pagina inicial y captura de rango de fechas reporte docente
            'uses' => $controller . 'ReporteController@reporteIndexDoc',
            'as' => 'espacios.academicos.report.index'
        ]);

        Route::get('indexEst', [ //Pagina inicial y captura de rango de fechas
            'uses' => $controller . 'ReporteController@reporteIndexEst',
            'as' => 'espacios.academicos.report.indexEst'
        ]);

        Route::get('indexCarr', [ //Pagina inicial y captura de rango de fechas rep carrera
            'uses' => $controller . 'ReporteController@reporteIndexCarr',
            'as' => 'espacios.academicos.report.indexCarr'
        ]);

        Route::post('repDoc', [ //CREAR REPORTE DOCENTE
            'uses' => $controller . 'ReporteController@reporDocente',
            'as' => 'espacios.academicos.report.repDoc',
        ]);

        Route::post('repEst', [ //CREAR REPORTE
            'uses' => $controller . 'ReporteController@cargarRepEst',
            'as' => 'espacios.academicos.report.repEst',
        ]);
        Route::post('repCarr', [ //CREAR REPORTE CARRERAS
            'uses' => $controller . 'ReporteController@reporCarrera',
            'as' => 'espacios.academicos.report.repCarr',
        ]);
        Route::get('descargarRepEst/{fech1}/{fech2}/{labNum}', [
            'uses' => $controller.'ReporteController@descargarReporteEst',
            'as' => 'espacios.academicos.report.descargarRepEst'
        ]);
        Route::get('descargarRepDoc/{fech1}/{fech2}/{labNum}/{aula}', [
            'uses' => $controller.'ReporteController@descargarReporteDoc',
            'as' => 'espacios.academicos.report.descargarRepDoc'
        ]);
        Route::get('descargarRepCarrera/{fech1}/{fech2}/{carr}/{carrera}', [
            'uses' => $controller.'ReporteController@descargarReporteCarrera',
            'as' => 'espacios.academicos.report.descargarRepCarrera'
        ]);
        Route::get('DownloadRepEstudiante', [ //DESCARGAR REPORTE
            'uses' => $controller . 'ReporteController@DownloadEstReporte',
            'as' => 'espacios.academicos.report.downReportEst'
        ]);
        Route::get('cargarSalasReportes/{espacio?}', [
            'uses' => $controller . 'ReporteController@cargarSalasReportes',
            'as' => 'espacios.academicos.report.cargarSalasReportes'
        ]);
    });

    /*RUTAS PARA MANEJAR LA ASISTENCIA*/
    Route::group(['prefix' => 'asist', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";
        Route::get('asisEst', [ //Pagina inicial asistencia estudiantes
            'uses' => $controller . 'AsistenciaController@asisEst',
            'as' => 'espacios.academicos.asist.asisEst'
        ]);
        Route::get('asisDoc', [ //Pagina inicial asistencia docentes
            'uses' => $controller . 'AsistenciaController@asisDoc',
            'as' => 'espacios.academicos.asist.asisDoc'
        ]);
        Route::get('asisInv', [ //Pagina inicial asistencia invitados
            'uses' => $controller . 'AsistenciaController@asisInvitado',
            'as' => 'espacios.academicos.asist.asisInv'
        ]);
        Route::post('regisAsistInv', [ //Registrar asistencia invitado-externo
            'uses' => $controller . 'AsistenciaController@regisAsistInv',
            'as' => 'espacios.academicos.asist.regisAsistInv'
        ]);
        Route::post('regisAsistDoc', [ //Registrar asistencia Docente
            'uses' => $controller . 'AsistenciaController@regisAsistenciaDoc',
            'as' => 'espacios.academicos.asist.regisAsistDoc'
        ]);
        Route::post('regisAsistEst', [ //Registrar asistencia Estudiante
            'uses' => $controller . 'AsistenciaController@regisAsistenciaEst',
            'as' => 'espacios.academicos.asist.regisAsistEst'
        ]);

        Route::get('cargarSalasAsitencia/{espacio?}', [
            'uses' => $controller . 'AsistenciaController@cargarSalasAsitencia',
            'as' => 'espacios.academicos.asist.cargarSalasAsitencia'
        ]);
        Route::post('verificarEstudiante',[
            'uses' => $controller.'AsistenciaController@verificarEstudiante',
            'as' => 'espacios.academicos.asist.verificarEstudiante'
        ]);
        Route::post('verificarDocente',[
            'uses' => $controller.'AsistenciaController@verificarDocente',
            'as' => 'espacios.academicos.asist.verificarDocente'
        ]);
    });


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

    /*INICIO SEGUNDA FASE ESPACIOS ACADEMICOS*/

    /*RUTAS PARA FUNCIONALIDAD Articulo*/
    Route::group(['prefix' => 'articulo', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";
        Route::get('index', [
            'uses' => $controller . 'ArticuloController@index',
            'as' => 'espacios.academicos.articulo.index'
        ]);
        Route::get('data', [ //Cargar datatable
            'uses' => $controller . 'ArticuloController@data',
            'as' => 'espacios.academicos.articulo.data'
        ]);

        Route::post('regisArticulo', [ //Registrar Articulo
            'uses' => $controller . 'ArticuloController@regisArticulo',
            'as' => 'espacios.academicos.articulo.regisArticulo'
        ]);

        Route::get('edit/{id?}', [ //EDITAR
            'uses' => $controller . 'formatosController@edit',
            'as' => 'espacios.academicos.articulo.edit'
        ])->where(['id' => '[0-9]+']);

        Route::delete('delete/{id?}', [ //ELIMINAR
            'uses' => $controller . 'ArticuloController@destroy',
            'as' => 'espacios.academicos.articulo.destroy'
        ])->where(['id' => '[0-9]+']);
    });

    /*FIN FUNCIONALIDAD Articulo*/

    /*RUTAS PARA LECTOR QR*/
    Route::group(['prefix' => 'lectorqr', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";
        Route::get('index', [
            'uses' => $controller . 'LectorqrController@index',
            'as' => 'espacios.academicos.lectorqr.index'
        ]);
        Route::get('cargarSalas/{espacio?}', [
            'uses' => $controller . 'LectorqrController@cargarSalas',
            'as' => 'espacios.academicos.lectorqr.cargarSalas'
        ]);

    });

    //FIN RUTAS LECTOR QR

    /*RUTAS FUNCIONALIDAD CATEGORIA*/

    Route::group(['prefix' => 'categoria', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";

        Route::get('index', [
            'uses' => $controller . 'CategoriaController@index',
            'as' => 'espacios.academicos.categoria.index'
        ]);

        Route::get('data', [ //Cargar datatable
            'uses' => $controller . 'CategoriaController@data',
            'as' => 'espacios.academicos.categoria.data'
        ]);

        Route::post('regisCategoria', [ //Registrar Categoria
            'uses' => $controller . 'CategoriaController@regisCategoria',
            'as' => 'espacios.academicos.categoria.regisCategoria'
        ]);
        
        Route::get('editarCategoria/{id?}',[   //Editar Categoria
            'as' => 'espacios.academicos.categoria.editarCategoria', 
            'uses' => $controller.'CategoriaController@editarCategoria'
        ]);

        Route::post('modificarCategoria/{id?}',[   //Modificar Categoria
            'uses' => $controller.'CategoriaController@modificarCategoria',
            'as' => 'espacios.academicos.categoria.modificarCategoria'
        ]);

        Route::delete('delete/{id?}', [ //Eliminar Categoria
            'uses' => $controller . 'CategoriaController@destroy',
            'as' => 'espacios.academicos.categoria.destroy'
        ])->where(['id' => '[0-9]+']);
    });


    /*FIN FUNCIONALIDAD CATEGORIA*/

    /*RUTAS FUNCIONALIDAD PROCEDENCIA*/

    Route::group(['prefix' => 'procedencia', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";

        Route::get('index', [
            'uses' => $controller . 'ProcedenciaController@index',
            'as' => 'espacios.academicos.procedencia.index'
        ]);

        Route::get('data', [ //Cargar datatable
            'uses' => $controller . 'ProcedenciaController@data',
            'as' => 'espacios.academicos.procedencia.data'
        ]);

        Route::post('regisProcedencia', [ //Registrar Procedencia
            'uses' => $controller . 'ProcedenciaController@regisProcedencia',
            'as' => 'espacios.academicos.procedencia.regisProcedencia',
        ]);

        Route::get('editarProcedencia/{id?}',[   //Editar Procedencia
            'as' => 'espacios.academicos.procedencia.editarProcedencia', 
            'uses' => $controller.'ProcedenciaController@editarProcedencia'
        ]);

        Route::post('modificarProcedencia/{id?}',[   //Modificar Procedencia
            'uses' => $controller.'ProcedenciaController@modificarProcedencia',
            'as' => 'espacios.academicos.procedencia.modificarProcedencia'
        ]);

        Route::delete('delete/{id?}', [ //Eliminar Procedencia
            'uses' => $controller . 'ProcedenciaController@destroy',
            'as' => 'espacios.academicos.procedencia.destroy'
        ])->where(['id' => '[0-9]+']);
    });

    /*FIN FUNCIONALIDAD PROCEDENCIA*/

    /*RUTAS FUNCIONALIDAD MARCA*/

    Route::group(['prefix' => 'marca', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";

        Route::get('index', [
            'uses' => $controller . 'MarcaController@index',
            'as' => 'espacios.academicos.marca.index'
        ]);

        Route::get('data', [ //Cargar datatable
            'uses' => $controller . 'MarcaController@data',
            'as' => 'espacios.academicos.marca.data'
        ]);

        Route::post('regisMarca', [ //Registrar Marca
            'uses' => $controller . 'MarcaController@regisMarca',
            'as' => 'espacios.academicos.marca.regisMarca',
        ]);

        Route::get('editarMarca/{id?}',[   //Editar Marca
            'as' => 'espacios.academicos.marca.editarMarca', 
            'uses' => $controller.'MarcaController@editarMarca'
        ]);

        Route::post('modificarMarca/{id?}',[   //Modificar Marca
            'uses' => $controller.'MarcaController@modificarMarca',
            'as' => 'espacios.academicos.marca.modificarMarca'
        ]);

        Route::delete('delete/{id?}', [ //Eliminar Marca
            'uses' => $controller . 'MarcaController@destroy',
            'as' => 'espacios.academicos.marca.destroy'
        ])->where(['id' => '[0-9]+']);
    });

    /*FIN FUNCIONALIDAD MARCA*/


    /*RUTAS FUNCIONALIDAD TIPOS DE MANTENIMIENTOS*/

    Route::group(['prefix' => 'tiposmant', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";

        Route::get('index', [
            'uses' => $controller . 'TiposMantController@index',
            'as' => 'espacios.academicos.tiposmant.index'
        ]);

        Route::get('data', [ //Cargar datatable
            'uses' => $controller . 'TiposMantController@data',
            'as' => 'espacios.academicos.tiposmant.data'
        ]);

        Route::post('regisTipo', [ //Registrar Tipo
            'uses' => $controller . 'TiposMantController@regisTipo',
            'as' => 'espacios.academicos.tiposmant.regisTipo',
        ]);

        Route::delete('delete/{id?}', [ //Eliminar Tipo
            'uses' => $controller . 'TiposMantController@destroy',
            'as' => 'espacios.academicos.tiposmant.destroy'
        ])->where(['id' => '[0-9]+']);
    });

    /*FIN FUNCIONALIDAD TIPOS DE MANTENIMIENTOS*/

    /*RUTAS FUNCIONALIDAD MANTENIMIENTOS*/

    Route::group(['prefix' => 'mantenimiento', 'middleware' => ['permission:FUNC_ESPA']], function () {
        $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";

        Route::get('index', [
            'uses' => $controller . 'MantenimientoController@index',
            'as' => 'espacios.academicos.mantenimiento.index'
        ]);

        Route::get('data', [ //Cargar datatable
            'uses' => $controller . 'MantenimientoController@data',
            'as' => 'espacios.academicos.mantenimiento.data'
        ]);

        Route::post('regisMantenimiento', [ //Registrar
            'uses' => $controller . 'MantenimientoController@regisMantenimiento',
            'as' => 'espacios.academicos.mantenimiento.regisMantenimiento',
        ]);

        Route::delete('delete/{id?}', [ //Eliminar
            'uses' => $controller . 'MantenimientoController@destroy',
            'as' => 'espacios.academicos.mantenimiento.destroy'
        ])->where(['id' => '[0-9]+']);
    });

    /*FIN FUNCIONALIDAD MANTENIMIENTOS*/

        /*RUTAS FUNCIONALIDAD HOJA DE VIDA*/

        Route::group(['prefix' => 'hojavida', 'middleware' => ['permission:FUNC_ESPA']], function () {
            $controller = "\\App\\Container\\Acadspace\\src\\Controllers\\";

            Route::get('index/{id?}', [
                'uses' => $controller .'HojavidaController@index',
                'as' => 'espacios.academicos.hojavida.index'
            ]);

            Route::post('regisHojavida', [ //Registrar
                'uses' => $controller . 'HojavidaController@regisHojavida',
                'as' => 'espacios.academicos.hojavida.regisHojavida',
            ]);

        });

        /*FIN FUNCIONALIDAD HOJA DE VIDA*/

});
