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

         //ruta que conduce al controlador para actulizar datos del proyecto
         Route::post('update', [
            'uses' => $controller . 'ProyectosController@update',      
            'as' => 'calidadpcs.proyectosCalidad.update'
        ]);

    });

///////////////////////// FIN RUTAS PROYECTOS /////////////////////

//////////// INICIO RUTAS PROCESOS ///////////////////

    Route::group(['prefix' => 'procesosCalidad', 'middleware' => ['permission:ADMIN_CALIDADPCS']], function () {

        $controller = "\\App\\Container\\CalidadPcs\\src\\Controllers\\";

        //Etapas

        //ruta que conduce al controlador para mostrar la tabla donde se cargan registros de las etapas por medio de petición ajax
        Route::get('etapas/{id?}', [
            'uses' => $controller . 'ProcesosController@indexAjaxEtapa',
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
            'uses' => $controller . 'ProcesosController@indexAjax',
            'as' => 'calidadpcs.procesosCalidad.index.ajax'             
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

        //ruta que conduce al controlador para alamacenar los datos del proceso en la base de datos
        Route::post('storeProceso1', [
            'uses' => $controller . 'ProcesosController@storeProceso1',   
            'as' => 'calidadpcs.procesosCalidad.storeProceso1'
        ]);

        //ruta que realiza la consulta de los procesos registrados
        Route::get('tablaCronograma/{idProyecto?}', [   
            'uses' => $controller . 'ProcesosController@tablaCronograma',
            'as' => 'calidadpcs.procesosCalidad.tablaCronograma'            
        ]);

        //ruta que realiza la consulta de los procesos registrados
        Route::get('registrarActividad/{id?}/{idProyecto?}', [   
            'uses' => $controller . 'ProcesosController@registrarActividad',
            'as' => 'calidadpcs.procesosCalidad.registrarActividad'            
        ]);
    });
});

