<?php
/**
 * Audiovisuales
 */

Route::get('/', [
    'as'   => 'audiovisuales.index',
    'uses' => function () {
        return view('audiovisuals.example');
    },
]);

// RUTAS FUNCIONARIO
Route::group(['prefix' => 'funcionario'], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'FuncionarioController@index',
        'as'   => 'audiovisuales.funcionario.index',
    ]);
    Route::get('data', [
        'uses' => $controller . 'FuncionarioController@data',
        'as'   => 'funcionario.data',
    ]);
    Route::get('all/{id}', [
        'uses' => $controller . 'FuncionarioController@all',
        'as'   => 'funcionario.all',
    ]);
    Route::post('store', [
        'uses' => $controller . 'FuncionarioController@store',
        'as'   => 'funcionario.store',
    ]);
    Route::delete('delete/{id?}', [
        'uses' => $controller . 'FuncionarioController@destroy',
        'as'   => 'funcionario.destroy',
    ])->where(['id' => '[0-9]+']);
});
// RUTAS ADMINISTRADOR
Route::group(['prefix' => 'administrador'], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'AdministradorController@index',
        'as'   => 'audiovisuales.administrador.index',
    ]);
    Route::get('data', [
        'uses' => $controller . 'AdministradorController@data',
        'as'   => 'administrador.data',
    ]);
    Route::get('all/{id}', [
        'uses' => $controller . 'AdministradorController@all',
        'as'   => 'administrador.all',
    ]);
    Route::post('store', [
        'uses' => $controller . 'AdministradorController@store',
        'as'   => 'administrador.store',
    ]);
    Route::delete('delete/{id?}', [
        'uses' => $controller . 'AdministradorController@destroy',
        'as'   => 'administrador.destroy',
    ])->where(['id' => '[0-9]+']);
});
// RUTAS SUPERADMIN
Route::group(['prefix' => 'superAdmin'], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'SuperAdminController@index',
        'as'   => 'audiovisuales.superAdmin.index',
    ]);
});
// RUTAS ARTICULO
Route::group(['prefix' => 'articulo'], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'ArticuloController@index',
        'as'   => 'audiovisuales.articulo.index',
    ]);
});
//RUTAS FUNCIONES ADMINISTRADPR
Route::group(['prefix' => 'adminView'], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'AdminviewController@index',
        'as'   => 'audiovisuales.adminview.index',
    ]);
    Route::get('data', [
        'uses' => $controller . 'AdminviewController@data',
        'as'   => 'adminview.data',
    ]);
    Route::get('all/{id}', [
        'uses' => $controller . 'AdminviewController@all',
        'as'   => 'adminview.all',
    ]);
    Route::post('store', [
        'uses' => $controller . 'AdminviewController@store',
        'as'   => 'adminview.store',
    ]);
    Route::delete('delete/{id?}', [
        'uses' => $controller . 'AdminviewController@destroy',
        'as'   => 'adminview.destroy',
    ])->where(['id' => '[0-9]+']);
});
