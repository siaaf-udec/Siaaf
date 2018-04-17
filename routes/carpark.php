<?php

/**
 * Parqueadero
 */

Route::group(['middleware' => ['auth']], function () {

//Rutas Usuarios Parqueadero

    Route::group(['prefix' => 'usuariosCarpark', 'middleware' => ['permission:ADMIN_CARPARK']], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros de ususarios
        Route::get('index', [
            'uses' => $controller . 'UsuariosController@index',
            'as' => 'parqueadero.usuariosCarpark.index',
        ]);

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros de ususarios por medio de petición ajax
        Route::get('index/ajax', [
            'uses' => $controller . 'UsuariosController@indexAjax',
            'as' => 'parqueadero.usuariosCarpark.index.ajax'             
        ]);

        //ruta que realiza la consulta de los usuarios registrados
        Route::get('tablaUsuarios', [   
            'uses' => $controller . 'UsuariosController@data',
            'as' => 'parqueadero.usuariosCarpark.tablaUsuarios'            
        ]);

        //Ruta que carga la información de dependencias ancladas a los usuarios
        Route::get('DependenciasUser', [
            'uses' => $controller . 'UsuariosController@listarDependencias',
            'as' => 'parqueadero.usuariosCarpark.listDependencias'
        ]);

        //Ruta que carga la información de estados anclados a los usuarios
        Route::get('EstadosUser', [
            'uses' => $controller . 'UsuariosController@listarEstados',
            'as' => 'parqueadero.usuariosCarpark.listEstados'
        ]);

        //ruta que conduce al controlador para mostrar el formulario para registrar un usuario
        Route::get('create', [
            'uses' => $controller . 'UsuariosController@create',  
            'as' => 'parqueadero.usuariosCarpark.create'
        ]);

        //ruta que conduce al controlador para alamacenar los datos del usuario en la base de datos
        Route::post('store', [
            'uses' => $controller . 'UsuariosController@store',   
            'as' => 'parqueadero.usuariosCarpark.store'
        ]);

        //ruta que conduce al controlador para ver el perfil de un usuario.
        Route::get('verPerfil/{id?}', [
            'uses' => $controller . 'UsuariosController@verPerfil',     
            'as' => 'parqueadero.usuariosCarpark.verPerfil'
        ]);

        //ruta que conduce al controlador para ver el perfil de un usuario.
        Route::get('editar/{id?}', [
            'uses' => $controller . 'UsuariosController@edit',     
            'as' => 'parqueadero.usuariosCarpark.edit'
        ]);

        //ruta que conduce al controlador para actulizar datos del usuario
        Route::post('update', [
            'uses' => $controller . 'UsuariosController@update',      
            'as' => 'parqueadero.usuariosCarpark.update'
        ]);

        //ruta que conduce al controlador para actulizar la foto de perfil del usuario
        Route::post('updateFotoUsuario/{id?}', [
            'uses' => $controller . 'UsuariosController@updateFotoUsuario',      
            'as' => 'parqueadero.usuariosCarpark.updateFotoUsuario'
        ]);

        //ruta que conduce al controlador para eliminar un registro de un usuario
        Route::delete('destroy/{id?}', [
            'uses' => $controller . 'UsuariosController@destroy', 
            'as' => 'parqueadero.usuariosCarpark.destroy'
        ]);


    });
///////////////FIN Rutas Usuarios Parqueadero//////////////////////////////////////

////////////////////Inicio Rutas para Motos //////////////////////////////////////
    Route::group(['prefix' => 'motosCarpark', 'middleware' => ['permission:ADMIN_CARPARK']], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros de motocicletas
        Route::get('index', [
            'uses' => $controller . 'MotosController@index',
            'as' => 'parqueadero.motosCarpark.index',
        ]);

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros de motocicletas por medio de petición ajax
        Route::get('index/ajax', [
            'uses' => $controller . 'MotosController@indexAjax',
            'as' => 'parqueadero.motosCarpark.index.ajax'             
        ]);

        //ruta que realiza la consulta de las motocicletas registradas
        Route::get('tablaMotos', [   
            'uses' => $controller . 'MotosController@tablaMotos',
            'as' => 'parqueadero.motosCarpark.tablaMotos'            
        ]);

        //ruta que conduce al controlador para mostrar el formulario para registrar una motocicleta
        Route::get('create/{id?}', [
            'uses' => $controller . 'MotosController@create',  
            'as' => 'parqueadero.motosCarpark.RegistrarMoto'
        ]);

        //ruta que conduce al controlador para alamacenar los datos de la motocicleta en la base de datos
        Route::post('store', [
            'uses' => $controller . 'MotosController@store',   
            'as' => 'parqueadero.motosCarpark.store'
        ]);

        //ruta que conduce al controlador para ver el perfil de una motocicleta.
        Route::get('verMoto/{id?}', [
            'uses' => $controller . 'MotosController@verMoto',     
            'as' => 'parqueadero.motosCarpark.verMoto'
        ]);

        //ruta que conduce al controlador para editar el perfil de una motocicleta.
        Route::get('editar/{id?}', [
            'uses' => $controller . 'MotosController@editar',     
            'as' => 'parqueadero.motosCarpark.editar'
        ]);

        //ruta que conduce al controlador para actulizar datos de la motocicleta
        Route::post('update', [
            'uses' => $controller . 'MotosController@update',      
            'as' => 'parqueadero.motosCarpark.update'
        ]);

        //ruta que conduce al controlador para actulizar la foto de perfil de la motocicleta
        Route::post('updateFotoMoto/{id?}', [
            'uses' => $controller . 'MotosController@updateFotoMoto',      
            'as' => 'parqueadero.motosCarpark.updateFotoMoto'
        ]);

        //ruta que conduce al controlador para actulizar la foto de la tarjeta de propiedad de la motocicleta
        Route::post('updateFotoPropiedad/{id?}', [
            'uses' => $controller . 'MotosController@updateFotoPropiedad',      
            'as' => 'parqueadero.motosCarpark.updateFotoPropiedad'
        ]);

        //ruta que conduce al controlador para actulizar la foto del soat de la motocicleta
        Route::post('UpdateFotoSOAT/{id?}', [
            'uses' => $controller . 'MotosController@UpdateFotoSOAT',      
            'as' => 'parqueadero.motosCarpark.UpdateFotoSOAT'
        ]);

        //ruta que conduce al controlador para eliminar un registro de una motocicleta
        Route::delete('destroy/{id?}', [
            'uses' => $controller . 'MotosController@destroy', 
            'as' => 'parqueadero.motosCarpark.destroy'
        ]);


    });
/////////////////////FIN Rutas Para Motos/////////////////////////////////////////

//////////////////// Inicio Rutas Para Las Dependencias/////////////////////////

    Route::group(['prefix' => 'dependenciasCarpark', 'middleware' => ['permission:ADMIN_CARPARK']], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan las dependencias
        Route::get('index', [
            'uses' => $controller . 'DependenciasController@index',
            'as' => 'parqueadero.dependenciasCarpark.index',
        ]);

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan las dependencias por medio de petición ajax
        Route::get('index/ajax', [
            'uses' => $controller . 'DependenciasController@indexAjax',
            'as' => 'parqueadero.dependenciasCarpark.index.ajax'             
        ]);

        //ruta que realiza la consulta de las dependencias registradas
        Route::get('tablaDependencias', [   
            'uses' => $controller . 'DependenciasController@tablaDependencias',
            'as' => 'parqueadero.dependenciasCarpark.tablaDependencias'
        ]);

        //ruta que conduce al controlador para mostrar el formulario para registrar una dependencia
        Route::get('create', [
            'uses' => $controller . 'DependenciasController@create',  
            'as' => 'parqueadero.dependenciasCarpark.create'
        ]);

        //ruta que conduce al controlador para alamacenar los datos de la dependencia
        Route::post('store', [
            'uses' => $controller . 'DependenciasController@store',   
            'as' => 'parqueadero.dependenciasCarpark.store'
        ]);
        
        //ruta que conduce al controlador para mostar el formulario para editar datos registrados
        Route::get('dependencia/edit/{id?}', [
            'uses' => $controller . 'DependenciasController@edit',     
            'as' => 'parqueadero.dependenciasCarpark.edit'
        ]);

        //ruta que conduce al controlador para actulizar datos de la dependencia
        Route::post('dependencia/update', [
            'uses' => $controller . 'DependenciasController@update',      
            'as' => 'parqueadero.dependenciasCarpark.update'
        ]);

    });

//////////////////// FIN Rutas Para Las Dependencias////////////////////////////

///////////////////////INICIO Rutas Para Los Reportes///////////////////////////

    Route::group(['prefix' => 'reportesCarpark', 'middleware' => ['permission:ADMIN_CARPARK']], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el reporte de las dependencias registradas
        Route::get('reporteDependencia', [
            'uses' => $controller . 'ReportesController@reporteDependencia',  
            'as' => 'parqueadero.reportesCarpark.reporteDependencia'
        ]);

        //ruta que conduce al controlador para descargar el reporte de las dependencias registradas
        Route::get('descargarReporteDependencia', [
            'uses' => $controller . 'ReportesController@descargarReporteDependencia',  
            'as' => 'parqueadero.reportesCarpark.DescargarReporteDependencia'
        ]);

        //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
        Route::get('reporteUsuariosRegistrados', [
            'uses' => $controller . 'ReportesController@reporteUsuariosRegistrados',  
            'as' => 'parqueadero.reportesCarpark.reporteUsuariosRegistrados'
        ]);

        //ruta que conduce al controlador para descargar el reporte de las dependencias registradas
        Route::get('descargarreporteUsuariosRegistrados', [
            'uses' => $controller . 'ReportesController@descargarreporteUsuariosRegistrados',  
            'as' => 'parqueadero.reportesCarpark.DescargarreporteUsuariosRegistrados'
        ]);

        //ruta que conduce al controlador para mostrar el reporte de las motocicletas registradas
        Route::get('reporteMotosRegistradas', [
            'uses' => $controller . 'ReportesController@reporteMotosRegistradas',  
            'as' => 'parqueadero.reportesCarpark.reporteMotosRegistradas'
        ]);

        //ruta que conduce al controlador para descargar el reporte de las las motocicletas registradas
        Route::get('descargarreporteMotosRegistradas', [
            'uses' => $controller . 'ReportesController@descargarreporteMotosRegistradas',  
            'as' => 'parqueadero.reportesCarpark.DescargarreporteMotosRegistradas'
        ]);

        //ruta que conduce al controlador para mostrar el reporte de las motocicletas que se encuentran dentro de la universidad
        Route::get('reporteMotosDentro', [
            'uses' => $controller . 'ReportesController@reporteMotosDentro',  
            'as' => 'parqueadero.reportesCarpark.ReporteMotosDentro'
        ]);

        //ruta que conduce al controlador para descargar el reporte de las motocicletas que se encuentran dentro de la universidad
        Route::get('descargarReporteMotosDentro', [
            'uses' => $controller . 'ReportesController@descargarReporteMotosDentro',  
            'as' => 'parqueadero.reportesCarpark.DescargarReporteMotosDentro'
        ]);

        //ruta que conduce al controlador para mostrar el reporte historico de las entradas y salidas de los usuarios y motocicletas
        Route::get('reporteHistorico', [
            'uses' => $controller . 'ReportesController@reporteHistorico',  
            'as' => 'parqueadero.reportesCarpark.ReporteHistorico'
        ]);

        //ruta que conduce al controlador para descargar el reporte historico de las entradas y salidas de los usuarios y motocicletas
        Route::get('descargarReporteHistorico', [
            'uses' => $controller . 'ReportesController@descargarReporteHistorico',  
            'as' => 'parqueadero.reportesCarpark.DescargarReporteHistorico'
        ]);

        //ruta que conduce al controlador para mostrar el reporte historico de las entradas y salidas de los usuarios y motocicletas filtrado por fechas
        Route::post('filtradoFecha', [
            'uses' => $controller . 'ReportesController@filtradoFecha', 
            'as' => 'parqueadero.reportesCarpark.filtradoFecha'
        ]);

        //ruta que conduce al controlador para descargar el reporte historico de las entradas y salidas de los usuarios y motocicletas filtrado por fechas
        Route::get('descargarFiltradoFecha/{limMinGET?}/{limMaxGET?}', [
            'uses' => $controller . 'ReportesController@descargarFiltradoFecha',
            'as' => 'parqueadero.reportesCarpark.DescargarfiltradoFecha'
        ]);

        //ruta que conduce al controlador para mostrar el reporte historico de las entradas y salidas de los usuarios y motocicletas filtrado por código
        Route::post('filtradoCodigo', [
            'uses' => $controller . 'ReportesController@filtradoCodigo', 
            'as' => 'parqueadero.reportesCarpark.filtradoCodigo'
        ]);

        //ruta que conduce al controlador para descargar el reporte historico de las entradas y salidas de los usuarios y motocicletas filtrado por código
        Route::get('/{id?}', [
            'uses' => $controller . 'ReportesController@descargarFiltradoCodigo', 
            'as' => 'parqueadero.reportesCarpark.DescargarfiltradoCodigo'
        ]);

        //ruta que conduce al controlador para mostrar el reporte historico de las entradas y salidas de los usuarios y motocicletas filtrado por placa
        Route::post('filtradoPlaca', [
            'uses' => $controller . 'ReportesController@filtradoPlaca', 
            'as' => 'parqueadero.reportesCarpark.filtradoPlaca'
        ]);

        //ruta que conduce al controlador para descargar el reporte historico de las entradas y salidas de los usuarios y motocicletas filtrado por placa
        Route::get('descargarFiltradoPlaca/{id?}', [
            'uses' => $controller . 'ReportesController@descargarFiltradoPlaca', 
            'as' => 'parqueadero.reportesCarpark.DescargarfiltradoPlaca'
        ]);

        //ruta que conduce al controlador para ver el reporte del perfil de un usuario registrado
        Route::get('reporteUsuario/{id?}', [
            'uses' => $controller . 'ReportesController@reporteUsuario',  
            'as' => 'parqueadero.reportesCarpark.reporteUsuario'
        ]);

        //ruta que conduce al controlador para descargar el reporte del perfil de un usuario registrado
        Route::get('descargarReporteUsuario/{id?}', [
            'uses' => $controller . 'ReportesController@descargarReporteUsuario', 
            'as' => 'parqueadero.reportesCarpark.descargarreporteUsuario'
        ]);

        //ruta que conduce al controlador para ver el reporte del perfil de una moto registrada
        Route::get('reporteMoto/{id?}', [
            'uses' => $controller . 'ReportesController@reporteMoto',  
            'as' => 'parqueadero.reportesCarpark.reporteMoto'
        ]);

        //ruta que conduce al controlador para descargar el reporte del perfil de una moto registrada
        Route::get('descargarReporteMoto/{id?}', [
            'uses' => $controller . 'ReportesController@descargarReporteMoto',  
            'as' => 'parqueadero.reportesCarpark.descargarreporteMoto'
        ]);

    });

///////////////////////FIN Rutas Para Los Reportes//////////////////////////////

////////////////////Inicio Rutas para Ingresos //////////////////////////////////////
    Route::group(['prefix' => 'ingresosCarpark', 'middleware' => ['permission:FUNC_CARPARK']], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros de ingresos
        Route::get('index', [
            'uses' => $controller . 'IngresosController@index',
            'as' => 'parqueadero.ingresosCarpark.index',
        ]);

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros de ingresos por medio de petición ajax
        Route::get('index/ajax', [
            'uses' => $controller . 'IngresosController@indexAjax',
            'as' => 'parqueadero.ingresosCarpark.index.ajax'             
        ]);

        //ruta que realiza la consulta de los ingresos registrados
        Route::get('tablaMotosDentro', [   
            'uses' => $controller . 'IngresosController@tablaMotosDentro',
            'as' => 'parqueadero.ingresosCarpark.tablaMotosDentro'      
        ]);

        //ruta que conduce al controlador para mostrar el formulario para registrar una acción de ingreso o salida
        Route::get('create', [
            'uses' => $controller . 'IngresosController@create', 
            'as' => 'parqueadero.ingresosCarpark.create'
        ]);

        //ruta que conduce al controlador para mostrar el formulario de verificación de información del usuario entrante o saliente
        Route::post('verificar', [
            'uses' => $controller . 'IngresosController@verificar',  
            'as' => 'parqueadero.ingresosCarpark.verificar'
        ]);

        //ruta que conduce al controlador para alamacenar los datos de ingreso y salida 
        Route::post('store', [
            'uses' => $controller . 'IngresosController@store',   
            'as' => 'parqueadero.ingresosCarpark.store'
        ]);

        //ruta que conduce al controlador para mostrar el formulario para registrar una acción y proceder a almacenarlos
        Route::get('confirmar/{id?}', [
            'uses' => $controller . 'IngresosController@confirmar',  
            'as' => 'parqueadero.ingresosCarpark.confirmar'
        ]);

        //ruta que conduce al controlador para mostrar el formulario de verificación de información del usuario entrante o saliente por medio de tarjeta RFID (python)
        Route::get('1e6548467c256f201b82f9f20dac907b/{id?}', [
            'uses' => $controller . 'IngresosController@confirmarTarjeta',  
            'as' => 'parqueadero.ingresosCarpark.1e6548467c256f201b82f9f20dac907b'
        ]);

        //ruta que conduce al controlador para alamacenar los datos de ingreso y salida desde la tarjeta RFID (python)
        Route::post('storeTarjeta', [
            'uses' => $controller . 'IngresosController@storeTarjeta',   
            'as' => 'parqueadero.ingresosCarpark.registroTarjeta'
        ]);

        //ruta que conduce al controlador para mostrar el formulario de verificación de información del usuario entrante o saliente por medio de tarjeta RFID y el reconocimiento de caracteres (python)
        Route::get('1e6548467c256f201b82f9f20dac907b/{id?}/{placa?}', [
            'uses' => $controller . 'IngresosController@confirmarTarjetaMasIA',  
            'as' => 'parqueadero.ingresosCarpark.1e6548467c256f201b82f9f20dac907b'
        ]);        

    });
///////////////////////FIN Rutas Para Los Ingresos//////////////////////////////

///////////////////////Rutas Para Los Historiales//////////////////////////////

    Route::group(['prefix' => 'historialesCarpark', 'middleware' => ['permission:ADMIN_CARPARK']], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros de uso del parqueadero
        Route::get('index', [
            'uses' => $controller . 'HistorialController@index',
            'as' => 'parqueadero.historialesCarpark.index',
        ]);

        //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros de uso del parqueadero por medio de ajax
        Route::get('index/ajax', [
            'uses' => $controller . 'HistorialController@indexAjax',
            'as' => 'parqueadero.historialesCarpark.index.ajax'             
        ]);

        //ruta que realiza la consulta de los historiales registradas
        Route::get('tablaHistoriales', [   
            'uses' => $controller . 'HistorialController@tablaHistoriales',
            'as' => 'parqueadero.dependenciasCarpark.tablaHistoriales'

        ]);

        //ruta que conduce al controlador para mostrar el formulario para filtrar reportes por fecha
        Route::get('filtrarFecha', [
            'uses' => $controller . 'HistorialController@filtrarFecha',  
            'as' => 'parqueadero.historialesCarpark.filtrarFecha'
        ]);

        //ruta que conduce al controlador para mostrar el formulario para filtrar reportes por código
        Route::get('filtrarCodigo', [
            'uses' => $controller . 'HistorialController@filtrarCodigo',  
            'as' => 'parqueadero.historialesCarpark.filtrarCodigo'
        ]);

        //ruta que conduce al controlador para mostrar el formulario para filtrar reportes por placa
        Route::get('filtrarPlaca', [
            'uses' => $controller . 'HistorialController@filtrarPlaca',  
            'as' => 'parqueadero.historialesCarpark.filtrarPlaca'
        ]);

    });
///////////////////////FIN Rutas Para Los Historiales//////////////////////////////

///////////////////////INICIO Rutas Para Los Correos//////////////////////////////

    Route::group(['prefix' => 'correosCarpark', 'middleware' => ['permission:FUNC_CARPARK']], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el botón de envio de correos de advertencia
        Route::get('cerrarParqueadero', [
            'uses' => $controller . 'CorreosController@cerrarParqueadero',
            'as' => 'parqueadero.correosCarpark.cerrarParqueadero',
        ]);

        //ruta que conduce al controlador para enviar los correos de advertencia
        Route::post('enviarMail', [
            'uses' => $controller . 'CorreosController@enviarMail',
            'as' => 'parqueadero.correosCarpark.enviarMail',
        ]);

    });
///////////////////////FIN Rutas Para Los Correos//////////////////////////////

});

