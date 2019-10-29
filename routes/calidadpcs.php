<?php

/**
 * Calidad
 */

Route::group(['middleware' => ['auth']], function () {

    //Rutas Usuarios Calidad Pcs

    Route::group(['prefix' => 'usuariosCalidadPcs', 'middleware' => ['permission:ADMIN_CALIDADPCS']], function () {

        $controller = "\\App\\Container\\CalidadPcs\\src\\Controllers\\";

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros de ususarios
        Route::get('index', [
            'uses' => $controller . 'UsuariosController@index',
            'as' => 'calidadpcs.usuariosCalidadPcs.index',
        ]);

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros de ususarios por medio de petición ajax
        Route::get('index/ajax', [
            'uses' => $controller . 'UsuariosController@indexAjax',
            'as' => 'calidadpcs.usuariosCalidadPcs.index.ajax'
        ]);

        //ruta que realiza la consulta de los usuarios registrados
        Route::get('tablaUsuarios', [
            'uses' => $controller . 'UsuariosController@data2',
            'as' => 'calidadpcs.usuariosCalidadPcs.tablaUsuarios'
        ]);

        //ruta que conduce al controlador para mostrar el formulario para registrar un usuario utilizando la camara para tomar fotos
        Route::get('create2', [
            'uses' => $controller . 'UsuariosController@create2',
            'as' => 'calidadpcs.usuariosCalidadPcs.create2'
        ]);

        //ruta que conduce al controlador para alamacenar los datos del usuario en la base de datos
        Route::post('store', [
            'uses' => $controller . 'UsuariosController@store',
            'as' => 'calidadpcs.usuariosCalidadPcs.store'
        ]);

        //ruta que conduce al controlador para ver el perfil de un usuario.
        Route::get('editar/{id?}', [
            'uses' => $controller . 'UsuariosController@edit',
            'as' => 'calidadpcs.usuariosCalidadPcs.edit'
        ]);

        //ruta que conduce al controlador para actulizar datos del usuario
        Route::post('update', [
            'uses' => $controller . 'UsuariosController@update',
            'as' => 'calidadpcs.usuariosCalidadPcs.update'
        ]);

        //ruta que conduce al controlador para eliminar un registro de un usuario
        Route::delete('destroy/{id?}', [
            'uses' => $controller . 'UsuariosController@destroy',
            'as' => 'calidadpcs.usuariosCalidadPcs.destroy'
        ]);
    });
    ///////////////FIN Rutas Usuarios //////////////////////////////////////

    /////////// INICIO RUTAS PROYECTOS ////////////////

    Route::group(['prefix' => 'Proyectos', 'middleware' => ['permission:ADMIN_CALIDADPCS']], function () {

        $controller = "\\App\\Container\\CalidadPcs\\src\\Controllers\\";

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros de proyectos
        Route::get('index', [
            'uses' => $controller . 'ProyectosController@index',
            'as' => 'calidadpcs.proyectosCalidad.index',
        ]);

        //ruta que conduce al controlador para mostrar la tabla donde se cargan registros de proyectos por medio de petición ajax
        Route::get('index/ajax', [
            'uses' => $controller . 'ProyectosController@indexAjax',
            'as' => 'calidadpcs.proyectosCalidad.index.ajax'
        ]);

        //ruta que realiza la consulta de los proyectos registrados
        Route::get('tablaProyectos/{id?}', [
            'uses' => $controller . 'ProyectosController@tablaProyectos',
            'as' => 'calidadpcs.proyectosCalidad.tablaProyectos'
        ]);

        //ruta que conduce al controlador para mostrar el formulario para registrar un proyecto
        Route::get('create/{id?}', [
            'uses' => $controller . 'ProyectosController@create',
            'as' => 'calidadpcs.proyectosCalidad.RegistrarProyecto'
        ]);

        //ruta que conduce al controlador para alamacenar los datos del proyecto en la base de datos
        Route::post('store', [
            'uses' => $controller . 'ProyectosController@store',
            'as' => 'calidadpcs.proyectosCalidad.store'
        ]);

        //ruta que conduce al controlador para ver el perfil de un proyecto.
        Route::get('editar/{id?}', [
            'uses' => $controller . 'ProyectosController@edit',
            'as' => 'calidadpcs.proyectosCalidad.edit'
        ]);

         //ruta que conduce al controlador para ver el perfil de un proyecto.
         Route::get('update', [
            'uses' => $controller . 'ProyectosController@update',
            'as' => 'calidadpcs.proyectosCalidad.update'
        ]);

        //ruta que conduce al controlador para actulizar datos del proyecto
        Route::delete('delete/{id?}', [
            'uses' => $controller . 'ProyectosController@delete',
            'as' => 'calidadpcs.proyectosCalidad.delete'
        ]);
    });

    ///////////////////////// FIN RUTAS PROYECTOS /////////////////////

    //////////// INICIO RUTAS PROCESOS ///////////////////

    Route::group(['prefix' => 'procesosCalidad', 'middleware' => ['permission:ADMIN_CALIDADPCS']], function () {

        $controller = "\\App\\Container\\CalidadPcs\\src\\Controllers\\";

        //Etapas

        //ruta que conduce al controlador para mostrar la tabla donde se cargan registros de las etapas por medio de petición ajax
        Route::get('etapas/{id?}', [
            'uses' => $controller . 'ProcesosController@indexTablaAjaxEtapa',
            'as' => 'calidadpcs.procesosCalidad.etapas'
        ]);

        //ruta que realiza la consulta de las etapas registrados
        Route::get('tablaEtapas', [
            'uses' => $controller . 'ProcesosController@tablaEtapas',
            'as' => 'calidadpcs.procesosCalidad.tablaEtapas'
        ]);

        //Procesos

        //ruta que conduce al controlador para mostrar la tabla donde se cargan registros de los procesos
        Route::get('index', [
            'uses' => $controller . 'ProcesosController@index',
            'as' => 'calidadpcs.procesosCalidad.index',
        ]);

        //ruta que conduce al controlador para mostrar la tabla donde se cargan registros de procesos por medio de petición ajax
        Route::get('index/ajax/{idEtapa?}/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@indexAjaxProcesos',
            'as' => 'calidadpcs.procesosCalidad.indexAjaxProcesos'
        ]);

        //ruta que realiza la consulta de los procesos registrados
        Route::get('tablaProcesos/{id?}', [
            'uses' => $controller . 'ProcesosController@tablaProcesos',
            'as' => 'calidadpcs.procesosCalidad.tablaProcesos'
        ]);

        //Informacion de cada proceso - Formularios

        //ruta que conduce al controlador para mostrar el formulario para registrar un proceso especifico
        Route::get('formularios/{id?}/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@formulario',
            'as' => 'calidadpcs.procesosCalidad.formularios'
        ]);

        //ruta que conduce al controlador para mostrar el formulario para registrar un proceso especifico
        Route::get('editarFormularios/{id?}/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@editarFormulario',
            'as' => 'calidadpcs.procesosCalidad.editarFormularios'
        ]);

        

        

        //ruta que realiza la consulta de los procesos registrados
        Route::get('registrarActividad/{id?}/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@registrarActividad',
            'as' => 'calidadpcs.procesosCalidad.registrarActividad'
        ]);


        // 
        // PROCESO  #1
        // 

        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso', [
            'uses' => $controller . 'ProcesosController@storeProceso',
            'as' => 'calidadpcs.procesosCalidad.storeProceso'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('updateProceso1', [
            'uses' => $controller . 'ProcesosController@updateProceso1',
            'as' => 'calidadpcs.procesosCalidad.updateProceso1'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeObjetivo', [
            'uses' => $controller . 'ProcesosController@storeObjetivo',
            'as' => 'calidadpcs.procesosCalidad.storeObjetivo'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('updateObjetivo', [
            'uses' => $controller . 'ProcesosController@updateObjetivo',
            'as' => 'calidadpcs.procesosCalidad.updateObjetivo'
        ]);
        //ruta que conduce al controlador para eliminar un registro de una motocicleta
        Route::delete('deleteObjetivo/{id?}', [
            'uses' => $controller . 'ProcesosController@deleteObjetivo',
            'as' => 'calidadpcs.procesosCalidad.deleteObjetivo'
        ]);


        // 
        // PROCESO #2
        // 

        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso2', [
            'uses' => $controller . 'ProcesosController@storeProceso2',
            'as' => 'calidadpcs.procesosCalidad.storeProceso2'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('updateProceso2', [
            'uses' => $controller . 'ProcesosController@updateProceso2',
            'as' => 'calidadpcs.procesosCalidad.updateProceso2'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeRequerimiento', [
            'uses' => $controller . 'ProcesosController@storeRequerimiento',
            'as' => 'calidadpcs.procesosCalidad.storeRequerimiento'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('updateRequerimiento', [
            'uses' => $controller . 'ProcesosController@updateRequerimiento',
            'as' => 'calidadpcs.procesosCalidad.updateRequerimiento'
        ]);
        //ruta que conduce al controlador para eliminar un registro de una motocicleta
        Route::delete('deleteRequerimiento/{id?}', [
            'uses' => $controller . 'ProcesosController@deleteRequerimiento',
            'as' => 'calidadpcs.procesosCalidad.deleteRequerimiento'
        ]);
        //ruta que realiza la consulta de los requerimientos registrados de ese proyecto
        Route::get('tablaRequerimientos/{id?}', [
            'uses' => $controller . 'ProcesosController@tablaRequerimientos',
            'as' => 'calidadpcs.procesosCalidad.tablaRequermientos'
        ]);
        

        // 
        //PROCESO #3
        // 
        //ruta que realiza la consulta de los procesos registrados
        Route::get('tablaCronograma/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaCronograma',
            'as' => 'calidadpcs.procesosCalidad.tablaCronograma'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso3', [
            'uses' => $controller . 'ProcesosController@storeProceso3',
            'as' => 'calidadpcs.procesosCalidad.storeProceso3'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso3_1', [
            'uses' => $controller . 'ProcesosController@storeProceso3_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso3_1'
        ]);
        Route::post('updateProceso3', [
            'uses' => $controller . 'ProcesosController@updateProceso3',
            'as' => 'calidadpcs.procesosCalidad.updateProceso3'
        ]);

        //
        // PROCESO #4
        //  
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaCostosInfomacion', [
            'uses' => $controller . 'ProcesosController@tablaCostosInformacion',
            'as' => 'calidadpcs.procesosCalidad.tablaCostosInformacion'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso4', [
            'uses' => $controller . 'ProcesosController@storeProceso4',
            'as' => 'calidadpcs.procesosCalidad.storeProceso4'
        ]);
        //ruta que realiza la consulta de los requerimientos registrados de ese proyecto
        Route::get('tablaCostos/{id?}', [
            'uses' => $controller . 'ProcesosController@tablaCostos',
            'as' => 'calidadpcs.procesosCalidad.tablaCostos'
        ]);
        //ruta que conduce al controlador para eliminar un registro de una motocicleta
        Route::delete('destroyCosto/{id?}', [
            'uses' => $controller . 'ProcesosController@destroyCosto',
            'as' => 'calidadpcs.procesosCalidad.destroyCosto'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso4_1', [
            'uses' => $controller . 'ProcesosController@storeProceso4_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso4_1'
        ]);


        // 
        // PROCESO #5
        // 
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaGestionCalidad/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaGestionCalidad',
            'as' => 'calidadpcs.procesosCalidad.tablaGestionCalidad'
        ]);

        Route::get('agregarEntrega/{id?}', [
            'uses' => $controller . 'ProcesosController@agregarEntrega',
            'as' => 'calidadpcs.procesosCalidad.agregarEntrega'
        ]);
        Route::post('updateProceso5/{id?}', [
            'uses' => $controller . 'ProcesosController@updateProceso5',
            'as' => 'calidadpcs.procesosCalidad.updateProceso5'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso5', [
            'uses' => $controller . 'ProcesosController@storeProceso5',
            'as' => 'calidadpcs.procesosCalidad.storeProceso5'
        ]);

        // 
        //  PROCESO $6
        // 
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaGestionRecursos/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaGestionRecursos',
            'as' => 'calidadpcs.procesosCalidad.tablaGestionRecursos'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso6', [
            'uses' => $controller . 'ProcesosController@storeProceso6',
            'as' => 'calidadpcs.procesosCalidad.storeProceso6'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso6_1', [
            'uses' => $controller . 'ProcesosController@storeProceso6_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso6_1'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('updateProceso6', [
            'uses' => $controller . 'ProcesosController@updateProceso6',
            'as' => 'calidadpcs.procesosCalidad.updateProceso6'
        ]);
        //ruta que conduce al controlador para eliminar un registro de una motocicleta
        Route::delete('deleteProceso6/{id?}', [
            'uses' => $controller . 'ProcesosController@deleteProceso6',
            'as' => 'calidadpcs.procesosCalidad.deleteProceso6'
        ]);

        // 
        // PROCESO #7
        // 
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaGestionComunicacion/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaGestionComunicacion',
            'as' => 'calidadpcs.procesosCalidad.tablaGestionComunicacion'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso7', [
            'uses' => $controller . 'ProcesosController@storeProceso7',
            'as' => 'calidadpcs.procesosCalidad.storeProceso7'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso7_1', [
            'uses' => $controller . 'ProcesosController@storeProceso7_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso7_1'
        ]);
         //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
         Route::post('updateProceso7', [
            'uses' => $controller . 'ProcesosController@updateProceso7',
            'as' => 'calidadpcs.procesosCalidad.updateProceso7'
        ]);
        //ruta que conduce al controlador para eliminar un registro de una motocicleta
        Route::delete('deleteProceso7/{id?}', [
            'uses' => $controller . 'ProcesosController@deleteProceso7',
            'as' => 'calidadpcs.procesosCalidad.deleteProceso7'
        ]);

        /**
         * 
         * PROCESO #8
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaGestionRiesgos/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaGestionRiesgos',
            'as' => 'calidadpcs.procesosCalidad.tablaGestionRiesgos'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso8', [
            'uses' => $controller . 'ProcesosController@storeProceso8',
            'as' => 'calidadpcs.procesosCalidad.storeProceso8'
        ]);
        Route::post('storeProceso8_1', [
            'uses' => $controller . 'ProcesosController@storeProceso8_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso8_1'
        ]);
         //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
         Route::post('updateProceso8', [
            'uses' => $controller . 'ProcesosController@updateProceso8',
            'as' => 'calidadpcs.procesosCalidad.updateProceso8'
        ]);
        //ruta que conduce al controlador para eliminar un registro de una motocicleta
        Route::delete('deleteProceso8/{id?}', [
            'uses' => $controller . 'ProcesosController@deleteProceso8',
            'as' => 'calidadpcs.procesosCalidad.deleteProceso8'
        ]);

        /**
         * 
         * 
         * PROCESO #9
         * 
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaGestionAdquisiciones/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaGestionAdquisiciones',
            'as' => 'calidadpcs.procesosCalidad.tablaGestionAdquisiciones'
        ]);
        Route::post('storeProceso9', [
            'uses' => $controller . 'ProcesosController@storeProceso9',
            'as' => 'calidadpcs.procesosCalidad.storeProceso9'
        ]);
        Route::post('storeProceso9_1', [
            'uses' => $controller . 'ProcesosController@storeProceso9_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso9_1'
        ]);
         //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
         Route::post('updateProceso9', [
            'uses' => $controller . 'ProcesosController@updateProceso9',
            'as' => 'calidadpcs.procesosCalidad.updateProceso9'
        ]);
        //ruta que conduce al controlador para eliminar un registro de una motocicleta
        Route::delete('deleteProceso9/{id?}', [
            'uses' => $controller . 'ProcesosController@deleteProceso9',
            'as' => 'calidadpcs.procesosCalidad.deleteProceso9'
        ]);

        /**
         * 
         * 
         * PRCOESO #10
         * 
         * 
         */
        Route::post('storeProceso10', [
            'uses' => $controller . 'ProcesosController@storeProceso10',
            'as' => 'calidadpcs.procesosCalidad.storeProceso10'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('updateProceso10', [
            'uses' => $controller . 'ProcesosController@updateProceso10',
            'as' => 'calidadpcs.procesosCalidad.updateProceso10'
        ]);

        /**
         * 
         * 
         * 
         * PROCESO #11
         * 
         * 
         */
        Route::post('storeProceso11', [
            'uses' => $controller . 'ProcesosController@storeProceso11',
            'as' => 'calidadpcs.procesosCalidad.storeProceso11'
        ]);
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('updateProceso11', [
            'uses' => $controller . 'ProcesosController@updateProceso11',
            'as' => 'calidadpcs.procesosCalidad.updateProceso11'
        ]);

        /**
         * 
         * PROCESO #12
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaEquipo/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaEquipo',
            'as' => 'calidadpcs.procesosCalidad.tablaEquipo'
        ]);
        Route::post('storeProceso12', [
            'uses' => $controller . 'ProcesosController@storeProceso12',
            'as' => 'calidadpcs.procesosCalidad.storeProceso12'
        ]);
        Route::post('storeProceso12_1', [
            'uses' => $controller . 'ProcesosController@storeProceso12_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso12_1'
        ]);

        /**
         * 
         * PROCESO # 13
         * 
         */
        Route::post('storeProceso13', [
            'uses' => $controller . 'ProcesosController@storeProceso13',
            'as' => 'calidadpcs.procesosCalidad.storeProceso13'
        ]);
        Route::get('info13/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@info13',
            'as' => 'calidadpcs.procesosCalidad.info13'
        ]);
         //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
         Route::post('updateProceso13', [
            'uses' => $controller . 'ProcesosController@updateProceso13',
            'as' => 'calidadpcs.procesosCalidad.updateProceso13'
        ]);
        /**
         * 
         * PROCESO #14
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaAdquisiciones/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaAdquisiciones',
            'as' => 'calidadpcs.procesosCalidad.tablaAdquisiciones'
        ]);
        Route::post('storeProceso14', [
            'uses' => $controller . 'ProcesosController@storeProceso14',
            'as' => 'calidadpcs.procesosCalidad.storeProceso14'
        ]);
        Route::post('storeProceso14_1', [
            'uses' => $controller . 'ProcesosController@storeProceso14_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso14_1'
        ]);

        /**
         * 
         * PROCESO #15
         * 
         */
        Route::post('storeProceso15', [
            'uses' => $controller . 'ProcesosController@storeProceso15',
            'as' => 'calidadpcs.procesosCalidad.storeProceso15'
        ]);
         //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
         Route::post('updateProceso15', [
            'uses' => $controller . 'ProcesosController@updateProceso15',
            'as' => 'calidadpcs.procesosCalidad.updateProceso15'
        ]);

        /**
         * 
         * PROCESO #16
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaproceso16/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaproceso16',
            'as' => 'calidadpcs.procesosCalidad.tablaproceso16'
        ]);
        Route::post('storeProceso16', [
            'uses' => $controller . 'ProcesosController@storeProceso16',
            'as' => 'calidadpcs.procesosCalidad.storeProceso16'
        ]);
        Route::post('storeProceso16_1', [
            'uses' => $controller . 'ProcesosController@storeProceso16_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso16_1'
        ]);
        
        /**
         * 
         * PROCESO #17
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaproceso17/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaproceso17',
            'as' => 'calidadpcs.procesosCalidad.tablaproceso17'
        ]);
        Route::post('storeProceso17', [
            'uses' => $controller . 'ProcesosController@storeProceso17',
            'as' => 'calidadpcs.procesosCalidad.storeProceso17'
        ]);
        Route::post('storeProceso17_1', [
            'uses' => $controller . 'ProcesosController@storeProceso17_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso17_1'
        ]);

        /**
         * 
         * PROCESO #18
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaproceso18/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaproceso18',
            'as' => 'calidadpcs.procesosCalidad.tablaproceso18'
        ]);
        Route::post('storeProceso18', [
            'uses' => $controller . 'ProcesosController@storeProceso18',
            'as' => 'calidadpcs.procesosCalidad.storeProceso18'
        ]);
        Route::post('storeProceso18_1', [
            'uses' => $controller . 'ProcesosController@storeProceso18_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso18_1'
        ]);
        
        /**
         * 
         * PROCESO #19
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaproceso19/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaproceso19',
            'as' => 'calidadpcs.procesosCalidad.tablaproceso19'
        ]);
        Route::post('storeProceso19', [
            'uses' => $controller . 'ProcesosController@storeProceso19',
            'as' => 'calidadpcs.procesosCalidad.storeProceso19'
        ]);
        Route::post('storeProceso19_1', [
            'uses' => $controller . 'ProcesosController@storeProceso19_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso19_1'
        ]);

        /**
         * 
         * PROCESO #20
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso20', [
            'uses' => $controller . 'ProcesosController@storeProceso20',
            'as' => 'calidadpcs.procesosCalidad.storeProceso20'
        ]);
        Route::get('info20/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@info20',
            'as' => 'calidadpcs.procesosCalidad.info20'
        ]);
         //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
         Route::post('updateProceso20', [
            'uses' => $controller . 'ProcesosController@updateProceso20',
            'as' => 'calidadpcs.procesosCalidad.updateProceso20'
        ]);

        /**
         * 
         * PROCESO #21
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaproceso21/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaproceso21',
            'as' => 'calidadpcs.procesosCalidad.tablaproceso21'
        ]);
        Route::post('storeProceso21', [
            'uses' => $controller . 'ProcesosController@storeProceso21',
            'as' => 'calidadpcs.procesosCalidad.storeProceso21'
        ]);
        Route::post('storeProceso21_1', [
            'uses' => $controller . 'ProcesosController@storeProceso21_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso21_1'
        ]);

        /**
         * 
         * PROCESO #22
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaproceso22/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaproceso22',
            'as' => 'calidadpcs.procesosCalidad.tablaproceso22'
        ]);
        Route::post('storeProceso22', [
            'uses' => $controller . 'ProcesosController@storeProceso22',
            'as' => 'calidadpcs.procesosCalidad.storeProceso22'
        ]);
        Route::post('storeProceso22_1', [
            'uses' => $controller . 'ProcesosController@storeProceso22_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso22_1'
        ]);

        /**
         * 
         * PROCESO #23
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaproceso23/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaproceso23',
            'as' => 'calidadpcs.procesosCalidad.tablaproceso23'
        ]);
        Route::post('storeProceso23', [
            'uses' => $controller . 'ProcesosController@storeProceso23',
            'as' => 'calidadpcs.procesosCalidad.storeProceso23'
        ]);
        Route::post('storeProceso23_1', [
            'uses' => $controller . 'ProcesosController@storeProceso23_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso23_1'
        ]);

        /**
         * 
         * PROCESO #24
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso24', [
            'uses' => $controller . 'ProcesosController@storeProceso24',
            'as' => 'calidadpcs.procesosCalidad.storeProceso24'
        ]);
        Route::get('info24/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@info24',
            'as' => 'calidadpcs.procesosCalidad.info24'
        ]);
         //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
         Route::post('updateProceso24', [
            'uses' => $controller . 'ProcesosController@updateProceso24',
            'as' => 'calidadpcs.procesosCalidad.updateProceso24'
        ]);

        /**
         * 
         * PROCESO #25
         * 
         */
        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::get('tablaproceso25/{idProyecto?}', [
            'uses' => $controller . 'ProcesosController@tablaproceso25',
            'as' => 'calidadpcs.procesosCalidad.tablaproceso25'
        ]);
        Route::post('storeProceso25', [
            'uses' => $controller . 'ProcesosController@storeProceso25',
            'as' => 'calidadpcs.procesosCalidad.storeProceso25'
        ]);
        Route::post('storeProceso25_1', [
            'uses' => $controller . 'ProcesosController@storeProceso25_1',
            'as' => 'calidadpcs.procesosCalidad.storeProceso25_1'
        ]);
        Route::post('finalizarProyecto', [
            'uses' => $controller . 'ProcesosController@finalizarProyecto',
            'as' => 'calidadpcs.procesosCalidad.finalizarProyecto'
        ]);

    });

    Route::group(['prefix' => 'reportesCalidad', 'middleware' => ['permission:ADMIN_CALIDADPCS']], function () {

        $controller = "\\App\\Container\\CalidadPcs\\src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
        Route::get('reporteEtapaUno/{idProyecto?}', [
            'uses' => $controller . 'ReportesController@reporteEtapaUno',  
            'as' => 'calidadpcs.reportesCalidad.reporteEtapaUno'
        ]);
        //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
        Route::get('descargaReporteEtapaUno/{idProyecto?}', [
            'uses' => $controller . 'ReportesController@descargaReporteEtapaUno',  
            'as' => 'calidadpcs.reportesCalidad.descargaReporteEtapaUno'
        ]);

        //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
        Route::get('reporteEtapaPlanificacion/{idProyecto?}', [
            'uses' => $controller . 'ReportesController@reporteEtapaPlanificacion',  
            'as' => 'calidadpcs.reportesCalidad.reporteEtapaPlanificacion'
        ]);
        //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
        Route::get('descargaReporteEtapaPlanificacion/{idProyecto?}', [
            'uses' => $controller . 'ReportesController@descargaReporteEtapaPlanificacion',  
            'as' => 'calidadpcs.reportesCalidad.descargaReporteEtapaPlanificacion'
        ]);

          //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
          Route::get('reporteEtapaEjecucion/{idProyecto?}', [
            'uses' => $controller . 'ReportesController@reporteEtapaEjecucion',  
            'as' => 'calidadpcs.reportesCalidad.reporteEtapaEjecucion'
        ]);
        //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
        Route::get('descargaReporteEtapaEjecucion/{idProyecto?}', [
            'uses' => $controller . 'ReportesController@descargaReporteEtapaEjecucion',  
            'as' => 'calidadpcs.reportesCalidad.descargaReporteEtapaEjecucion'
        ]);

          //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
          Route::get('reporteEtapaMonitoreo/{idProyecto?}', [
            'uses' => $controller . 'ReportesController@reporteEtapaMonitoreo',  
            'as' => 'calidadpcs.reportesCalidad.reporteEtapaMonitoreo'
        ]);
        //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
        Route::get('descargaReporteEtapaMonitoreo/{idProyecto?}', [
            'uses' => $controller . 'ReportesController@descargaReporteEtapaMonitoreo',  
            'as' => 'calidadpcs.reportesCalidad.descargaReporteEtapaMonitoreo'
        ]);


    });
});
