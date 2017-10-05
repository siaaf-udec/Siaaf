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

        Route::get('create', [
            'uses' => $controller . 'UsuariosController@create',
            'as'   => 'usuariosCarpark.create',
        ]);

        Route::post('store', [
            'uses' => $controller . 'UsuariosController@store',
            'as'   => 'usuariosCarpark.store',
        ]);
    });
//FIN Rutas Usuarios Parqueadero//////////////////////////////////////

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

});
