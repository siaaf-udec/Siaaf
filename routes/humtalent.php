<?php
/**
 * Talento Humano.
 */



Route::group(['middleware' => ['auth']], function () {

//Rutas para el manejo de los empleados
    Route::group(['prefix' => 'empleado', 'middleware' => ['permission:FUNC_RRHH']], function () {
        $controller = "\\App\\Container\\Humtalent\\src\\Controllers\\";
        Route::get('pdfContacto', [
            'uses' => $controller . 'EmpleadoController@reporteContactoEmpleados',
            'as' => 'talento.humano.empleado.pdfContacto'             //ruta que conduce al controlador para mostrar  el reporte referente a los datos de contacto de los empleados
        ]);
        Route::get('pdfDireccion', [
            'uses' => $controller . 'EmpleadoController@reporteDireccionEmpleados',
            'as' => 'talento.humano.empleado.pdfDireccion'             //ruta que conduce al controlador para mostrar  el reporte referente a los datos de dirección de los empleados
        ]);
        Route::get('pdfSalario1', [
            'uses' => $controller . 'EmpleadoController@reporteSalario1Empleados',
            'as' => 'talento.humano.empleado.pdfSalario1'             //ruta que conduce al controlador para mostrar  el reporte referente al salario de los empleados organizado por programa
        ]);
        Route::get('pdfSalario2', [
            'uses' => $controller . 'EmpleadoController@reporteSalario2Empleados',
            'as' => 'talento.humano.empleado.pdfSalario2'             ////ruta que conduce al controlador para mostrar  el reporte referente al salario de los empleados organizado por rol
        ]);
        Route::get('pdfAfiliaciones', [
            'uses' => $controller . 'EmpleadoController@reporteAfiliacionesEmpleados',
            'as' => 'talento.humano.empleado.pdfAfiliaciones'             //ruta que conduce al controlador para mostrar  el reporte referente a las afiliaciones de los empleados
        ]);
        Route::get('pdfEstado', [
            'uses' => $controller . 'EmpleadoController@reporteEstadoEmpleados',
            'as' => 'talento.humano.empleado.pdfEstado'             //ruta que conduce al controlador para mostrar  el reporte referente al estado de los empleados
        ]);
        Route::get('DownloadPdfContacto', [
            'uses' => $controller . 'EmpleadoController@downloadContactoReporte',
            'as' => 'talento.humano.empleado.DownloadPdfContacto'             //ruta que conduce al controlador para descargar el reporte de contacto
        ]);
        Route::get('DownloadPdfDireccion', [
            'uses' => $controller . 'EmpleadoController@downloadDireccionReporte',
            'as' => 'talento.humano.empleado.DownloadPdfDireccion'             //ruta que conduce al controlador para descargar el reporte de direccion
        ]);
        Route::get('DownloadPdfSalario1', [
            'uses' => $controller . 'EmpleadoController@downloadSalario1Reporte',
            'as' => 'talento.humano.empleado.DownloadPdfSalario1'             //ruta que conduce al controlador para descargar el reporte de salario organizado por programa
        ]);
        Route::get('DownloadPdfSalario2', [
            'uses' => $controller . 'EmpleadoController@downloadSalario2Reporte',
            'as' => 'talento.humano.empleado.DownloadPdfSalario2'             //ruta que conduce al controlador para descargar el reporte de salario organizado por rol
        ]);
        Route::get('DownloadPdfAfiliaciones', [
            'uses' => $controller . 'EmpleadoController@downloadAfiliacionesReporte',
            'as' => 'talento.humano.empleado.DownloadPdfAfiliaciones'             //ruta que conduce al controlador para descargar el reporte de afiliaciones
        ]);
        Route::get('DownloadPdfEstado', [
            'uses' => $controller . 'EmpleadoController@downloadEstadoReporte',
            'as' => 'talento.humano.empleado.DownloadPdfEstado'             //ruta que conduce al controlador para descargar el reporte de estado
        ]);
        Route::get('index', [
            'uses' => $controller . 'EmpleadoController@index',
            'as' => 'talento.humano.empleado.index'             //ruta que conduce al controlador para mostrar  la tabla donde se cargan los empleados registrados
        ]);
        Route::get('index/ajax', [
            'uses' => $controller . 'EmpleadoController@indexAjax',
            'as' => 'talento.humano.empleado.index.ajax'             //ruta que conduce al controlador para mostrar  la tabla donde se cargan los empleados reegistrados
        ]);
        Route::get('create', [
            'uses' => $controller . 'EmpleadoController@create',  //ruta que conduce al controlador para mostrar el formulario para registrar un empleado
            'as' => 'talento.humano.empleado.create'
        ]);
        Route::post('store', [
            'uses' => $controller . 'EmpleadoController@store',   //ruta que conduce al controlador para alamacenar los datos del empleado en la base de datos
            'as' => 'talento.humano.empleado.store'
        ]);
        Route::post('importUsers', [
            'uses' => $controller . 'EmpleadoController@importUsers',   //ruta que conduce al controlador para alamacenar los datos del empleado que tenga el archivo de excel
            'as' => 'talento.humano.empleado.importUsers'
        ]);
        Route::delete('empleado/destroy/{id?}', [
            'uses' => $controller . 'EmpleadoController@destroy', //ruta que conduce al controlador para eliminar un registro de empleado
            'as' => 'talento.humano.empleado.destroy'
        ]);
        Route::get('empleado/edit/{id?}', [
            'uses' => $controller . 'EmpleadoController@edit',     //ruta que conduce al controlador para mostar el formulario para editar datos registrados
            'as' => 'talento.humano.empleado.edit'
        ]);
        Route::post('empleado/update', [
            'uses' => $controller . 'EmpleadoController@update',      //ruta que conduce al controlador para actulizar datos del empleado
            'as' => 'talento.humano.empleado.update'
        ]);
        Route::get('tablaEmpleados', [   //ruta que realiza la consulta de los empleados registrados
            'as' => 'talento.humano.tablaEmpleados',
            'uses' =>$controller.'EmpleadoController@tablaEmpleados'
        ]);
        Route::get('tablaEmpleadosRetirados', [      //ruta que retorna la vista con el datatable para listar los empleados con estado retirado
            'as' => 'talento.humano.empleado.tablaEmpleadosRetirados',
            'uses' => function () {
                return view('humtalent.empleado.empleadosRetirados');
            }
        ]);
        Route::get('tablaEmpleadosRetirados/ajax', [      //ruta que retorna la vista con el datatable para listar los empleados con estado retirado
            'as' => 'talento.humano.empleado.tablaEmpleadosRetirados.ajax',
            'uses' => $controller . 'EmpleadoController@ajaxEmpleadosRetirados'
        ]);
        Route::get('editarRetirado/{id?}', [
            'uses' => $controller . 'EmpleadoController@editarEmpleadoRetirado',     //ruta que conduce al controlador para mostar el formulario para editar datos registrados
            'as' => 'talento.humano.empleado.editarRetirado'
        ]);
        Route::get('Reportes', [      //ruta que retorna la vista general de todos los reportes disponibles
            'as' => 'talento.humano.empleado.Reportes',
            'uses' => function () {
                return view('humtalent.reportes.ReporteVistaPrincipal');
            }
        ]);
        Route::get('vistaArchivo', [      //ruta que retorna la vista del registro a traves de excel
            'as' => 'talento.humano.empleado.regisArchivo',
            'uses' => function () {
                return view('humtalent.empleado.registroExcel');
            }
        ]);
        Route::get('empleadosRetirados', [ //ruta que realiza el datatable para consultar los empleados con estado de retirado
            'as' => 'talento.humano.empleado.empleadosRetirados',
            'uses' => $controller . 'EmpleadoController@empleadosRetirados'

        ]);
        Route::get('email', [
            'as' => 'talento.humano.empleado.email',
            'uses' => function () {
                return view('humtalent.empleado.enviarCorreoEmpleados');
            }
        ]);
        Route::post('enviarEmail', [
            'uses' => $controller . 'EmpleadoController@enviarEmail',
            'as' => 'talento.humano.empleado.enviarEmail'
        ]);
        Route::post('checkEmail',[
            'uses' => $controller.'EmpleadoController@verificarEmail',
            'as' => 'talento.humano.empleado.checkEmail'
        ]);

    });

//Rutas para el manejo de la documentación
    Route::group(['prefix' => 'document', 'middleware' => ['permission:FUNC_RRHH']], function () {
        $controller = "\\App\\Container\\Humtalent\\src\\Controllers\\";
        Route::get('pdfConsolidado', [
            'uses' => $controller . 'DocumentController@reporteConsolidadoEmpleados',
            'as' => 'talento.humano.document.pdfConsolidado'
        ]);
        Route::get('DownloadPdfConsolidado', [
            'uses' => $controller . 'DocumentController@downloadReporteConsolidadoEmpleados',
            'as' => 'talento.humano.document.DownloadPdfConsolidado'             //ruta que conduce al controlador para descargar el reporte de radicacion
        ]);
        Route::get('pdfRadicacion/{id?}', [
            'uses' => $controller . 'DocumentController@reporteRadicacionEmpleados',
            'as' => 'talento.humano.document.pdfRadicacion'             //ruta que conduce al controlador para mostrar  el reporte que tiene los documentos que el empleado ha radicado y los que le faltan
        ]);
        Route::get('DownloadPdfRadicacion/{id?}', [
            'uses' => $controller . 'DocumentController@downloadReporteRadicacionEmpleados',
            'as' => 'talento.humano.document.DownloadPdfRadicacion'             //ruta que conduce al controlador para descargar el reporte de radicacion
        ]);
        Route::get('index', [
            'uses' => $controller . 'DocumentController@index',   //ruta que conduce al controlador para mostrar  la tabla donde se cargan los documentos reegistrados
            'as' => 'talento.humano.document.index'
        ]);
        Route::get('index/ajax', [
            'uses' => $controller . 'DocumentController@indexAjax',   //ruta que conduce al controlador para mostrar  la tabla donde se cargan los documentos reegistrados
            'as' => 'talento.humano.document.index.ajax'
        ]);
        Route::get('create', [
            'uses' => $controller . 'DocumentController@create', //ruta que conduce al controlador para mostrar el formulario para registrar un documento
            'as' => 'talento.humano.document.create'
        ]);
        Route::post('store', [
            'uses' => $controller . 'DocumentController@store',  //ruta que conduce al controlador para alamacenar los datos del documento en la base de datos
            'as' => 'talento.humano.document.store'
        ]);
        Route::delete('document/destroy/{id?}', [
            'uses' => $controller . 'DocumentController@destroy',  //ruta que conduce al controlador para eliminar un registro
            'as' => 'talento.humano.document.destroy'
        ]);
        Route::get('document/edit/{id?}', [
            'uses' => $controller . 'DocumentController@edit', //ruta que conduce al controlador para mostar el formulario para editar datos registrados
            'as' => 'talento.humano.document.edit'
        ]);
        Route::post('update', [
            'uses' => $controller . 'DocumentController@update',   //ruta que conduce al controlador para actulizar datos del empleado
            'as' => 'talento.humano.document.update'
        ]);
        Route::get('tablaDocumentos', [   //ruta que realiza la consulta de los documentos registrados
            'as' => 'talento.humano.tablaDocumentos',
            'uses' => $controller . 'DocumentController@tablaDocumentos'
        ]);
        Route::get('buscarRadicar', [    //ruta para buscar los empleados  para hacer la radicación de documentos
            'as' => 'talento.humano.buscarRadicar', //Este es el alias de la ruta
            'uses' => function () {
                return view('humtalent.empleado.buscarEmpleado');
            }
        ]);
        Route::get('buscarRadicar/ajax', [    //ruta para buscar los empleados  para hacer la radicación de documentos
            'as' => 'talento.humano.buscarRadicar.ajax', //Este es el alias de la ruta
            'uses' => $controller . 'DocumentController@ajaxBuscarEmpleado'
        ]);
        Route::get('consultaDocsRadicados/{id?}/{tipo?}', [    //ruta para buscar los empleados  para hacer la radicación de documentos
            'as' => 'talento.humano.document.consultaDocsRadicados', //Este es el alias de la ruta
            'uses' => $controller . 'DocumentController@consultaDocsRadicados'
        ]);
        Route::post('listarDocsRad', [    //ruta listar los documentos requeridos y asociarlos a un empleado
            'as' => 'talento.humano.listarDocsRad', //Este es el alias de la ruta
            'uses' => $controller . 'DocumentController@listarDocsRad'
        ]);
        Route::post('radicarDocumentos', [    //ruta para  asociarlos los documentos requeridos a un empleado
            'as' => 'talento.humano.radicarDocumentos', //Este es el alias de la ruta
            'uses' => $controller . 'DocumentController@radicarDocumentos',

        ]);
        Route::post('afiliarEmpleado', [    //ruta para  asociarlos los documentos requeridos a un empleado
            'as' => 'talento.humano.afiliarEmpleado', //Este es el alias de la ruta
            'uses' => $controller . 'DocumentController@afiliarEmpleado'
        ]);
        Route::post('reiniciarRadicacion', [    //ruta para  asociarlos los documentos requeridos a un empleado
            'as' => 'talento.humano.reiniciarRadicacion', //Este es el alias de la ruta
            'uses' => $controller . 'DocumentController@reiniciarRadicacion'
        ]);
        Route::get('historialDocumentos/empleados', [    //ruta para listar  los empleados y realizar la consulta de documentación entregada
            'as' => 'talento.humano.historialDocumentos.empleados',
            'uses' => function () {
                return view('humtalent.empleado.listaEmpleados');
            }
        ]);
        Route::get('historialDocumentos/empleados/ajax', [    //ruta para listar  los empleados y realizar la consulta de documentación entregada
            'as' => 'talento.humano.historialDocumentos.empleados.ajax',
            'uses' => $controller . 'EmpleadoController@ajaxListaEmpleados'
        ]);
        Route::get('historialDocumentos/documentos/{id?}', [
            'uses' => $controller . 'DocumentController@tablaRadicados', //ruta que conduce al controlador para mostar el formulario para editar datos registrados
            'as' => 'talento.humano.historialDocumentos.documentos'
        ]);
        Route::get('historialDocumentos/documentosRadicados/{id?}', [
            'uses' => $controller . 'DocumentController@consultaRadicados', //ruta consulta los documentos registrados
            'as' => 'talento.humano.document.historialDocumentos.documentosRadicados'
        ]);
    });

//Rutas para el manejo de los eventos
    Route::group(['prefix' => 'evento', 'middleware' => ['permission:FUNC_RRHH']], function () {
        $controller = "\\App\\Container\\Humtalent\\src\\Controllers\\";
        Route::get('index', [
            'uses' => $controller . 'EventoController@index',   //ruta que conduce al controlador para mostrar  la tabla donde se cargan los eventos reegistrados
            'as' => 'talento.humano.evento.index'
        ]);
        Route::get('index/ajax', [
            'uses' => $controller . 'EventoController@indexAjax',   //ruta que conduce al controlador para mostrar  la tabla donde se cargan los eventos reegistrados
            'as' => 'talento.humano.evento.index.ajax'
        ]);
        Route::get('create', [
            'uses' => $controller . 'EventoController@create', //ruta que conduce al controlador para mostrar  el formulario de registro para los eventos
            'as' => 'talento.humano.evento.create'
        ]);
        Route::post('store', [
            'uses' => $controller . 'EventoController@store', //ruta que conduce al controlador para almacenar los  eventos
            'as' => 'talento.humano.evento.store'
        ]);
        Route::delete('evento/destroy/{id?}', [
            'uses' => $controller . 'EventoController@destroy', //ruta que conduce al controlador para eliminar los  eventos
            'as' => 'talento.humano.evento.destroy'
        ]);
        Route::get('edit/{id?}', [
            'uses' => $controller . 'EventoController@edit', //ruta que conduce al controlador para mostrar el formulario de edición de  los  eventos
            'as' => 'talento.humano.evento.edit'
        ]);
        Route::post('update', [
            'uses' => $controller . 'EventoController@update', //ruta que conduce al controlador para actualizar los datos de los  eventos
            'as' => 'talento.humano.evento.update'
        ]);
        Route::get('listaEventos', [   //ruta que realiza listar los eventos registrados
            'as' => 'talento.humano.listaEventos',
            'uses' => function () {
                return view('humtalent.eventos.listaEventos');
            }
        ]);
        Route::get('tablaEventos', [   //ruta que realiza la consulta de los eventos registrados
            'as' => 'talento.humano.tablaEventos',
            'uses' => $controller . 'EventoController@tablaEventos'
        ]);

        Route::get('asistentes/{id?}', [    //ruta para listar los empleados  asistentes a un evento seleccionado, recibe el id del evento seleccionado
            'as' => 'talento.humano.evento.asistentes', //Este es el alias de la ruta
            'uses' => $controller . 'EventoController@consultarAsistentes'
        ]);
        Route::get('tablaAsistentes/{id}', [   //ruta que realiza la consulta de los empleados asistentes a un evento, recibe el id del evento seleccionado
            'as' => 'talento.humano.tablaAsistentes',
            'uses' => $controller . 'EventoController@tablaAsistentes'
        ]);
        Route::get('posAsitentes/{id}', [   //ruta que realiza la consulta de los empleados que no esten registrados en el evento, recibe el id del evento seleccionado
            'as' => 'talento.humano.posAsitentes',
            'uses' => $controller . 'EventoController@posiblesAsistentes'
        ]);
        Route::get('regAsist/{id?}', [    //ruta para listar los empleados  para agregar asistentes a un evento seleccionado, recibe el id del evento seleccionado
            'as' => 'talento.humano.evento.regAsist', //Este es el alias de la ruta
            'uses' => $controller . 'EventoController@listaEmpleados'
        ]);
        Route::get('evento/regAsist/saveAsist/{id?}/{ced?}', [   //ruta que registrar los empleados asistentes a un evento, recibe el id del evento seleccionado y la cedula del empleado a registrar como asistente
            'as' => 'talento.humano.evento.regAsist.saveAsists',
            'uses' => $controller . 'EventoController@registrarAsistentes'
        ]);
        Route::post('evento/regAsist/regTotAsist/{id?}/{datos?}', [   //ruta que registrar los empleados asistentes a un evento, recibe el id del evento seleccionado y la cedula del empleado a registrar como asistente
            'as' => 'talento.humano.evento.regAsist.regTotAsist',
            'uses' => $controller . 'EventoController@registrarTodosAsistentes'
        ]);
        Route::get('evento/asistentes/deleteAsist/{id?}/{ced?}', [   //ruta que eliminar un asistente a un evento, recibe la cedula  del empleado seleccionado y el id del evento
            'as' => 'talento.humano.evento.asistentes.deleteAsist',
            'uses' => $controller . 'EventoController@deleteAsistentes'
        ]);

    });

//rutas para el manejo de las inducciones
    Route::group(['prefix' => 'induccion', 'middleware' => ['permission:FUNC_RRHH']], function () {
        $controller = "\\App\\Container\\Humtalent\\src\\Controllers\\";

        Route::get('tablaInduccion', [    //ruta para mostrar una lista de los empleados nuevos
            'as' => 'talento.humano.Tinduccion', //Este es el alias de la ruta
            'uses' => function () {
                return view('humtalent.inducciones.tablaEmpleadosNuevos');
            }
        ]);
        Route::get('tablaInduccion/ajax', [    //ruta para mostrar una lista de los empleados nuevos
            'as' => 'talento.humano.Tinduccion.ajax', //Este es el alias de la ruta
            'uses' => $controller . 'InduccionController@ajaxEmpleadosNuevos'
        ]);

        Route::get('tablaEmpleadosNuevos', [   //ruta para realizar la cosnulta de los empleados nuevos
            'as' => 'talento.humano.tablaEmpleadosNuevos',
            'uses' => $controller . 'InduccionController@listarEmpleadosNuevos'
        ]);

        Route::get('procesoInduccion/{id?}', [    //ruta que muestra el proceso de inducción o re-inducción para un empleado nuevo.
            'as' => 'talento.humano.procesoInduccion', //Este es el alias de la ruta
            'uses' => $controller . 'InduccionController@index'
        ]);

        Route::post('store', [   //ruta para registrar el proceso de inducción para un empleado
            'as' => 'talento.humano.induccion.store',
            'uses' => $controller . 'InduccionController@store'
        ]);
    });

//rutas para el Calendario.
    Route::group(['prefix' => 'calendario', 'middleware' => ['permission:FUNC_RRHH']], function () {
        $controller = "\\App\\Container\\Humtalent\\src\\Controllers\\";
        Route::get('index', [
            'uses' => $controller . 'CalendarioController@index',   //ruta que conduce al controlador para mostrar  el calendario
            'as' => 'talento.humano.calendario.index'
        ]);
        Route::get('getEvent', [
            'as' => 'talento.humano.calendario.getEvent',     //ruta que llama al controlador para mostrar los enventos y recordatorios guardados
            'uses' => $controller . 'CalendarioController@getEvent'
        ]);
        Route::post('storeNotification', [   //ruta para registrar un recordatorio nuevo
            'as' => 'talento.humano.calendario.storeNotification',
            'uses' => $controller . 'CalendarioController@store'
        ]);
        Route::post('storeDateNotification', [   //ruta para registrar la fecha de notificación de los eventos o recordatoriso
            'as' => 'talento.humano.calendario.storeDateNotification',
            'uses' => $controller . 'CalendarioController@storeDate'
        ]);
        Route::post('updateDateNotification', [   //ruta para actualizar las fechas de los recordatorios o eventos.
            'as' => 'talento.humano.calendario.updateDateNotification',
            'uses' => $controller . 'CalendarioController@updateDateNotification'
        ]);
        Route::post('updateNotification', [   //ruta para actualizar los recordatorios o notificaciones
            'as' => 'talento.humano.calendario.updateNotification',
            'uses' => $controller . 'CalendarioController@updateNotification'
        ]);
        Route::post('updateEvent', [   //ruta para actualizar los eventos desde el calendario
            'as' => 'talento.humano.calendario.updateEvent',
            'uses' => $controller . 'CalendarioController@updateEvent'
        ]);
        Route::post('storeDateEvent', [   //ruta para registrar la fecha de los eventos desde el calendario
            'as' => 'talento.humano.calendario.storeDateEvent',
            'uses' => $controller . 'CalendarioController@storeDateEvent'
        ]);
        Route::post('deleteNotification', [   //ruta para eliminar ya sea un evento o una notificación
            'as' => 'talento.humano.calendario.deleteNotification',
            'uses' => $controller . 'CalendarioController@deleteNotification'
        ]);

    });
//rutas para el manejo del modulo de permisos e incapacidades para los empleados.
    Route::group(['prefix' => 'permisos', 'middleware' => ['permission:FUNC_RRHH']], function () {
        $controller = "\\App\\Container\\Humtalent\\src\\Controllers\\";
        Route::get('listaEmpleados', [    //ruta para mostrar una lista de los empleados
            'as' => 'talento.humano.permisos.listaEmpleados',
            'uses' => function () {
                return view('humtalent.permisos.listaEmpleados');
            }
        ]);
        Route::get('listaEmpleados/ajax', [    //ruta para mostrar una lista de los empleados
            'as' => 'talento.humano.permisos.listaEmpleados.ajax',
            'uses' => $controller . 'PermisosController@ajaxListaEmpleados'
        ]);
        Route::get('tablaPermisos/{id?}', [    //ruta para mostrar la tabla de los permisos.
            'as' => 'talento.humano.permisos.tablaPermisos',
            'uses' => $controller . 'PermisosController@listaPermisos'
        ]);
        Route::post('store', [   //ruta para registrar permisos nuevos a un empleado
            'as' => 'talento.humano.permisos.store',
            'uses' => $controller . 'PermisosController@store'
        ]);
        Route::get('consultaPermisos/{id?}', [
            'uses' => $controller . 'PermisosController@consultaPermisos', //ruta para consultar los permisos registrados
            'as' => 'talento.humano.permisos.consultaPermisos'
        ]);
        Route::get('PdfPermisos/{id?}', [
            'uses' => $controller . 'PermisosController@ReportePermisosEmpleados', //ruta para mostrar el reporte de los permisos de cada empleado
            'as' => 'talento.humano.permisos.reporte'
        ]);
        Route::get('DownloadPdfPermisos/{id?}', [
            'uses' => $controller . 'PermisosController@downloadReportePermisosEmpleados', //ruta para cdescargar el reporte de permisos
            'as' => 'talento.humano.permisos.Downloadreporte'
        ]);
        Route::post('update', [   //ruta para actualizar los permisos
            'as' => 'talento.humano.permisos.update',
            'uses' => $controller . 'PermisosController@update'
        ]);
        Route::delete('destroy/{id?}', [
            'uses' => $controller . 'PermisosController@destroy', //ruta para eliminar un permiso registrado
            'as' => 'talento.humano.permisos.destroy'
        ]);

    });
//grupo de rutas para generar, activar y/o descativar notificaciones
    Route::group(['prefix' => 'notificaciones', 'middleware' => ['permission:FUNC_RRHH']], function () {
        $controller = "\\App\\Container\\Humtalent\\src\\Controllers\\";

        Route::get('listaEmpleadosDocumentosCompletos', [  //ruta que realiza la consulta para cargar la tabla de los empleados con documentos completos
            'as' => 'talento.humano.notificaciones.listaEmpleadosDocumentosCompletos',
            'uses' => $controller . 'EmpleadoController@listaEmpleadosDocumentosCompletos'
        ]);

        Route::get('listaEmpleadosDocumentosIncompletos', [   //ruta que realiza la consulta para cargar la tabla de los empleados con documentos incompletos
            'as' => 'talento.humano.notificaciones.listaEmpleadosDocumentosIncompletos',
            'uses' => $controller . 'EmpleadoController@listaEmpleadosDocumentosIncompletos'
        ]);

        Route::get('consultarDocsRadicados/{id?}/{tipoRad?}', [   //ruta para consultar los documentos registrados
            'uses' => $controller . 'DocumentController@consultaDocsRadicados',
            'as' => 'talento.humano.notificaciones.consultarDocsRadicados'
        ]);

        Route::get('empleadosDocumentosCompletos', [  //ruta que dirige al blade para mostrar la tabla de los empleados con documentos completos generadas por las notificaciones
            'as' => 'humtalent.empleado.notificaciones.empleadosDocumentosCompletos',
            'uses' => function () {
                return view('humtalent.empleado.empleadosDocumentosCompletos');
            }
        ]);
        Route::get('empleadosDocumentosCompletos/ajax', [  //ruta que dirige al blade para mostrar la tabla de los empleados con documentos completos generadas por las notificaciones
            'as' => 'humtalent.empleado.notificaciones.empleadosDocumentosCompletos.ajax',
            'uses' => $controller . 'CalendarioController@ajaxEmpleadosDocumentosCompletos'
        ]);

        Route::get('empleadosDocumentosIncompletos', [   //ruta que dirige al blade para mostrar la tabla de los empleados con documentos incompletos generadas por las notificaciones
            'as' => 'humtalent.empleado.notificaciones.empleadosDocumentosIncompletos',
            'uses' => function () {
                return view('humtalent.empleado.empleadosDocumentosIncompletos');
            }
        ]);
        Route::get('empleadosDocumentosIncompletos/ajax', [   //ruta que dirige al blade para mostrar la tabla de los empleados con documentos incompletos generadas por las notificaciones
            'as' => 'humtalent.empleado.notificaciones.empleadosDocumentosIncompletos.ajax',
            'uses' => $controller . 'CalendarioController@ajaxEmpleadosDocumentosIncompletos'
        ]);
        Route::post('desactivarDocumentosIncompletos', [      //ruta que desactiva las notificaciones de documentos incompletos, recibe como parametro el tipo de notificacion (documentos incompletos)
            'as' => 'humtalent.notificaciones.desactivarDocumentosIncompletos',
            'uses' => $controller . 'CalendarioController@desactivarNotificaciones'
        ]);

        Route::post('activarDocumentosIncompletos', [         //ruta que activa las notificaciones de documentos incompletos, recibe como parametro el tipo de notificacion (documentos incompletos)
            'as' => 'humtalent.notificaciones.activarDocumentosIncompletos',
            'uses' => $controller . 'CalendarioController@activarNotificaciones'
        ]);

        Route::post('desactivarDocumentosCompletos', [        //ruta que desactiva las notificaciones de documentos completos, recibe como parametro el tipo de notificacion (documentos completos)
            'as' => 'humtalent.notificaciones.desactivarDocumentosCompletos',
            'uses' => $controller . 'CalendarioController@desactivarNotificaciones'
        ]);

        Route::post('activarDocumentosCompletos', [       //ruta que activa las notificaciones de documentos completos, recibe como parametro el tipo de notificacion (documentos completos)
            'as' => 'humtalent.notificaciones.activarDocumentosCompletos',
            'uses' => $controller . 'CalendarioController@activarNotificaciones'
        ]);

        //rutas directas a las tablas mostradas por las notificaciones.
        Route::get('empleadosDocumentosCompletos', [  //ruta que muestra las tablas de empleados con documentación completa desde el menu
            'as' => 'talento.humano.notificaciones.empleadosDocumentosCompletos',
            'uses' => $controller . 'CalendarioController@documentacionCompleta'
        ]);

        Route::get('empleadosDocumentosIncompletos', [          //ruta que muestra las tablas de empleados con documentación incompleta desde el menu
            'as' => 'talento.humano.notificaciones.empleadosDocumentosIncompletos',
            'uses' => $controller . 'CalendarioController@documentacionIncompleta'
        ]);
    });
});
