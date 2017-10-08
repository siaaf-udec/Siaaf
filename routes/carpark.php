<?php

use App\Container\Carpark\src\Dependencias;
use App\Container\Carpark\src\Estados;
use App\Container\Carpark\src\Usuarios;
use App\Container\Carpark\src\Motos;
use App\Container\Carpark\src\Ingresos;
use App\Container\Carpark\src\Historiales;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

/**
 * Parqueadero
 */
//RUTA DE EJEMPLO
Route::get('/', [
    'as'   => 'parqueaderos.index',
    'uses' => function () {
        return view('carpark.example');
    },
]);

Route::group(['middleware' => ['auth']], function () {

//Rutas Usuarios Parqueadero//////////////////////////////////////////

    Route::group(['prefix' => 'usuariosCarpark'], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        Route::get('index', [
            'uses' => $controller . 'UsuariosController@index',
            'as'   => 'parqueadero.usuariosCarpark.index',
        ]);

        Route::get('index/ajax', [
            'uses' => $controller . 'UsuariosController@indexAjax',
            'as' => 'parqueadero.usuariosCarpark.index.ajax'             //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros
        ]);

        Route::get('tablaUsuarios', [   //ruta que realiza la consulta de los usuarios registrados
            'as' => 'parqueadero.usuariosCarpark.tablaUsuarios',
            'uses' => function (Request $request) {
                if ($request->ajax()) {
                    return Datatables::of(Usuarios::all())
                        ->addIndexColumn()
                        ->make(true);
                } else {
                    return response()->json([
                        'message' => 'Incorrect request',
                        'code' => 412
                    ], 412);
                }
            }

        ]);

        Route::get('DependenciasUser',[
            'uses' => $controller.'UsuariosController@listarDependencias',
            'as' => 'parqueadero.usuariosCarpark.listDependencias'
        ]);        

        Route::get('EstadosUser',[
            'uses' => $controller.'UsuariosController@listarEstados',
            'as' => 'parqueadero.usuariosCarpark.listEstados'
        ]);

        Route::get('create', [
            'uses' => $controller . 'UsuariosController@create',  //ruta que conduce al controlador para mostrar el formulario para registrar un usuario
            'as' => 'parqueadero.usuariosCarpark.create'
        ]);

        Route::post('store', [
            'uses' => $controller . 'UsuariosController@store',   //ruta que conduce al controlador para alamacenar los datos del usuario en la base de datos
            'as' => 'parqueadero.usuariosCarpark.store'
        ]);

        Route::get('verPerfil/{id?}', [
            'uses' => $controller . 'UsuariosController@verPerfil',     //ruta que conduce al controlador para ver el perfil de un usuario.
            'as' => 'parqueadero.usuariosCarpark.verPerfil'
        ]);

        Route::get('editar/{id?}', [
            'uses' => $controller . 'UsuariosController@edit',     //ruta que conduce al controlador para ver el perfil de un usuario.
            'as' => 'parqueadero.usuariosCarpark.edit'
        ]);

        Route::post('update', [
            'uses' => $controller . 'UsuariosController@update',      //ruta que conduce al controlador para actulizar datos del usuario
            'as' => 'parqueadero.usuariosCarpark.update'
        ]);

        Route::post('updateFotoUsuario/{id?}', [
            'uses' => $controller . 'UsuariosController@updateFotoUsuario',      //ruta que conduce al controlador para actulizar la foto de perfil del usuario
            'as' => 'parqueadero.usuariosCarpark.updateFotoUsuario'
        ]);

        Route::delete('destroy/{id?}', [
            'uses' => $controller . 'UsuariosController@destroy', //ruta que conduce al controlador para eliminar un registro de empleado
            'as' => 'parqueadero.usuariosCarpark.destroy'
        ]);

        
    });
///////////////FIN Rutas Usuarios Parqueadero//////////////////////////////////////

////////////////////Inicio Rutas para Motos //////////////////////////////////////
    Route::group(['prefix' => 'motosCarpark'], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        Route::get('index', [
            'uses' => $controller . 'MotosController@index',
            'as'   => 'parqueadero.motosCarpark.index',
        ]);

        Route::get('index/ajax', [
            'uses' => $controller . 'MotosController@indexAjax',
            'as' => 'parqueadero.motosCarpark.index.ajax'             //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros
        ]);

        Route::get('tablaMotos', [   //ruta que realiza la consulta de los vehículos registrados
            'as' => 'parqueadero.motosCarpark.tablaMotos',
            'uses' => function (Request $request) {
                if ($request->ajax()) {
                    return Datatables::of(Motos::all())
                        ->addIndexColumn()
                        ->make(true);
                } else {
                    return response()->json([
                        'message' => 'Incorrect request',
                        'code' => 412
                    ], 412);
                }
            }

        ]);

        Route::get('create/{id?}', [
            'uses' => $controller . 'MotosController@create',  //ruta que conduce al controlador para mostrar el formulario para registrar un usuario
            'as' => 'parqueadero.motosCarpark.RegistrarMoto'
        ]);

        Route::post('store', [
            'uses' => $controller . 'MotosController@store',   //ruta que conduce al controlador para alamacenar los datos del usuario en la base de datos
            'as' => 'parqueadero.motosCarpark.store'
        ]);
        
        Route::get('verMoto/{id?}', [
            'uses' => $controller . 'MotosController@verMoto',     //ruta que conduce al controlador para ver el perfil de un vehículo.
            'as' => 'parqueadero.motosCarpark.verMoto'
        ]);
        
        Route::get('editar/{id?}', [
            'uses' => $controller . 'MotosController@editar',     //ruta que conduce al controlador para ver el perfil de un usuario.
            'as' => 'parqueadero.motosCarpark.editar'
        ]);

        Route::post('update', [
            'uses' => $controller . 'MotosController@update',      //ruta que conduce al controlador para actulizar datos del usuario
            'as' => 'parqueadero.motosCarpark.update'
        ]);

        Route::post('updateFotoMoto/{id?}', [
            'uses' => $controller . 'MotosController@updateFotoMoto',      //ruta que conduce al controlador para actulizar la foto de perfil del vehículo
            'as' => 'parqueadero.motosCarpark.updateFotoMoto'
        ]);

        Route::post('updateFotoPropiedad/{id?}', [
            'uses' => $controller . 'MotosController@updateFotoPropiedad',      //ruta que conduce al controlador para actulizar la foto de la tarjeta de propiedad del vehículo
            'as' => 'parqueadero.motosCarpark.updateFotoPropiedad'
        ]);

        Route::post('UpdateFotoSOAT/{id?}', [
            'uses' => $controller . 'MotosController@UpdateFotoSOAT',      //ruta que conduce al controlador para actulizar la foto de la tarjeta de propiedad del vehículo
            'as' => 'parqueadero.motosCarpark.UpdateFotoSOAT'
        ]);    

        Route::delete('destroy/{id?}', [
            'uses' => $controller . 'MotosController@destroy', //ruta que conduce al controlador para eliminar un registro vehículo
            'as' => 'parqueadero.motosCarpark.destroy'
        ]);
        

    });
/////////////////////FIN Rutas Para Motos/////////////////////////////////////////

//////////////////// Inicio Rutas Para Las Dependencias/////////////////////////

    Route::group(['prefix' => 'dependenciasCarpark'], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        Route::get('index', [
            'uses' => $controller . 'DependenciasController@index',
            'as'   => 'parqueadero.dependenciasCarpark.index',
        ]);

        Route::get('tablaDependencias', [   //ruta que realiza la consulta de las dependencias registradas
            'as' => 'parqueadero.dependenciasCarpark.tablaDependencias',
            'uses' => function (Request $request) {
                if ($request->ajax()) {
                    return Datatables::of(Dependencias::all())
                        ->addIndexColumn()
                        ->make(true);
                } else {
                    return response()->json([
                        'message' => 'Incorrect request',
                        'code' => 412
                    ], 412);
                }
            }

        ]);

        Route::get('create', [
            'uses' => $controller . 'DependenciasController@create',  //ruta que conduce al controlador para mostrar el formulario para registrar una dependencia
            'as' => 'parqueadero.dependenciasCarpark.create'
        ]);    
        
        Route::post('store', [
            'uses' => $controller . 'DependenciasController@store',   //ruta que conduce al controlador para alamacenar los datos de la dependencia
            'as' => 'parqueadero.dependenciasCarpark.store'
        ]);

        Route::get('index/ajax', [
            'uses' => $controller . 'DependenciasController@indexAjax',
            'as' => 'parqueadero.dependenciasCarpark.index.ajax'             //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros
        ]);

        Route::get('dependencia/edit/{id?}', [
            'uses' => $controller . 'DependenciasController@edit',     //ruta que conduce al controlador para mostar el formulario para editar datos registrados
            'as' => 'parqueadero.dependenciasCarpark.edit'
        ]);

        Route::post('dependencia/update', [
            'uses' => $controller . 'DependenciasController@update',      //ruta que conduce al controlador para actulizar datos de la dependencia
            'as' => 'parqueadero.dependenciasCarpark.update'
        ]);        

    });

//////////////////// FIN Rutas Para Las Dependencias////////////////////////////

///////////////////////INICIO Rutas Para Los Reportes///////////////////////////

    Route::group(['prefix' => 'reportesCarpark'], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        Route::get('reporteDependencia', [
            'uses' => $controller . 'ReportesController@reporteDependencia',  //ruta que conduce al controlador para mostrar el reporte de las dependencias registradas
            'as' => 'parqueadero.reportesCarpark.reporteDependencia'
        ]);
        
        Route::get('DescargarReporteDependencia', [
            'uses' => $controller . 'ReportesController@DescargarReporteDependencia',  //ruta que conduce al controlador para descargar el reporte de las dependencias registradas
            'as' => 'parqueadero.reportesCarpark.DescargarReporteDependencia'
        ]); 

        Route::get('reporteUsuariosRegistrados', [
            'uses' => $controller . 'ReportesController@reporteUsuariosRegistrados',  //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
            'as' => 'parqueadero.reportesCarpark.reporteUsuariosRegistrados'
        ]);

        Route::get('DescargarreporteUsuariosRegistrados', [
            'uses' => $controller . 'ReportesController@DescargarreporteUsuariosRegistrados',  //ruta que conduce al controlador para descargar el reporte de las dependencias registradas
            'as' => 'parqueadero.reportesCarpark.DescargarreporteUsuariosRegistrados'
        ]); 

        Route::get('reporteMotosRegistradas', [
            'uses' => $controller . 'ReportesController@reporteMotosRegistradas',  //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
            'as' => 'parqueadero.reportesCarpark.reporteMotosRegistradas'
        ]);

        Route::get('DescargarreporteMotosRegistradas', [
            'uses' => $controller . 'ReportesController@DescargarreporteMotosRegistradas',  //ruta que conduce al controlador para descargar el reporte de las dependencias registradas
            'as' => 'parqueadero.reportesCarpark.DescargarreporteMotosRegistradas'
        ]); 
        
        Route::get('ReporteMotosDentro', [
            'uses' => $controller . 'ReportesController@ReporteMotosDentro',  //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
            'as' => 'parqueadero.reportesCarpark.ReporteMotosDentro'
        ]);

        Route::get('DescargarReporteMotosDentro', [
            'uses' => $controller . 'ReportesController@DescargarReporteMotosDentro',  //ruta que conduce al controlador para descargar el reporte de las dependencias registradas
            'as' => 'parqueadero.reportesCarpark.DescargarReporteMotosDentro'
        ]); 
        
        Route::get('ReporteHistorico', [
            'uses' => $controller . 'ReportesController@ReporteHistorico',  //ruta que conduce al controlador para mostrar el reporte de los usuarios registrados
            'as' => 'parqueadero.reportesCarpark.ReporteHistorico'
        ]);

        Route::get('DescargarReporteHistorico', [
            'uses' => $controller . 'ReportesController@DescargarReporteHistorico',  //ruta que conduce al controlador para descargar el reporte de las dependencias registradas
            'as' => 'parqueadero.reportesCarpark.DescargarReporteHistorico'
        ]); 
    });

///////////////////////FIN Rutas Para Los Reportes//////////////////////////////

////////////////////Inicio Rutas para Ingresos //////////////////////////////////////
    Route::group(['prefix' => 'ingresosCarpark'], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        Route::get('index', [
            'uses' => $controller . 'IngresosController@index',
            'as'   => 'parqueadero.ingresosCarpark.index',
        ]);

        Route::get('index/ajax', [
            'uses' => $controller . 'IngresosController@indexAjax',
            'as' => 'parqueadero.ingresosCarpark.index.ajax'             //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros
        ]);

        Route::get('tablaMotosDentro', [   //ruta que realiza la consulta de las dependencias registradas
            'as' => 'parqueadero.ingresosCarpark.tablaMotosDentro',
            'uses' => function (Request $request) {
                if ($request->ajax()) {
                    return Datatables::of(Ingresos::all())
                        ->addIndexColumn()
                        ->make(true);
                } else {
                    return response()->json([
                        'message' => 'Incorrect request',
                        'code' => 412
                    ], 412);
                }
            }

        ]);
        
        Route::get('create', [
            'uses' => $controller . 'IngresosController@create',  //ruta que conduce al controlador para mostrar el formulario para registrar una acción
            'as' => 'parqueadero.ingresosCarpark.create'
        ]); 
        
        Route::post('verificar', [
            'uses' => $controller . 'IngresosController@verificar',  //ruta que conduce al controlador para mostrar el formulario de verificación de información
            'as' => 'parqueadero.ingresosCarpark.verificar'
        ]);

        Route::post('store', [
            'uses' => $controller . 'IngresosController@store',   //ruta que conduce al controlador para alamacenar los datos de ingreso y salida
            'as' => 'parqueadero.ingresosCarpark.store'
        ]);
        
        Route::get('confirmar/{id?}', [
            'uses' => $controller . 'IngresosController@confirmar',  //ruta que conduce al controlador para mostrar el formulario para registrar una acción
            'as' => 'parqueadero.ingresosCarpark.confirmar'
        ]); 

    });
///////////////////////FIN Rutas Para Los Ingresos//////////////////////////////

///////////////////////Rutas Para Los Historiales//////////////////////////////

     Route::group(['prefix' => 'historialesCarpark'], function () {

        $controller = "\\App\\Container\\Carpark\\src\\Controllers\\";

        Route::get('index', [
            'uses' => $controller . 'HistorialController@index',
            'as'   => 'parqueadero.historialesCarpark.index',
        ]);

        Route::get('index/ajax', [
            'uses' => $controller . 'HistorialController@indexAjax',
            'as' => 'parqueadero.historialesCarpark.index.ajax'             //ruta que conduce al controlador para mostrar  la tabla donde se cargan registros
        ]);

        Route::get('tablaHistoriales', [   //ruta que realiza la consulta de las dependencias registradas
            'as' => 'parqueadero.dependenciasCarpark.tablaHistoriales',
            'uses' => function (Request $request) {
                if ($request->ajax()) {
                    return Datatables::of(Historiales::all())
                        ->addIndexColumn()
                        ->make(true);
                } else {
                    return response()->json([
                        'message' => 'Incorrect request',
                        'code' => 412
                    ], 412);
                }
            }

        ]);

    });
///////////////////////FIN Rutas Para Los Historiales//////////////////////////////
});

