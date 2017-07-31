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
        'as'   => 'funcionario.index',
    ]);
    Route::get('listing', [
        'uses' => $controller . 'FuncionarioController@listing',
        'as'   => 'funcionario.listing',
    ]);
    Route::get('all/{id}', [
        'uses' => $controller . 'FuncionarioController@all',
        'as'   => 'funcionario.all',
    ]);
    Route::put('update/{id?}', [
        'uses' => $controller . 'FuncionarioController@update',
        'as'   => 'funcionario.update',
    ])->where(['id' => '[0-9]+']);

    Route::delete('delete/{id?}', [
        'uses' => $controller . 'FuncionarioController@destroy',
        'as'   => 'funcionario.delete',
    ])->where(['id' => '[0-9]+']);

    Route::post('create', [
        'uses' => $controller . 'FuncionarioController@store',
        'as'   => 'funcionario.create',
    ]);
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
